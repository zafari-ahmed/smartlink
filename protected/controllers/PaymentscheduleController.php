<?php

class PaymentscheduleController extends Controller
{
	public function init()
	{
	    if(!isset(Yii::app()->session['userModel']))
	    {
	        $this->redirect(Yii::app()->baseUrl.'/');
	    }
	}

	public function actionAdd()
	{
		$phaseId = Yii::app()->session->get('userModel')['phase_id'];
		$data['types'] = Plots::model()->findAll(array(
                    'select'=>'t.plot_type',
                    'distinct'=>true,
                    'condition'=>"phase_id=$phaseId",
                ));
		$data['total'] = PaymentSchedules::model()->count();
		$this->render('add',$data);
	}


	public function actionCustomschedule($id)
	{
		$phaseId = Yii::app()->session->get('userModel')['phase_id'];
		$data['types'] = Plots::model()->findAll(array(
                    'select'=>'t.plot_type',
                    'distinct'=>true,
                    'condition'=>"phase_id=$phaseId",
                ));
		$data['total'] = PaymentSchedules::model()->count();
		$data['booking'] = $booking =  CustomerPlots::model()->findByPk($id);
		$paymentmodes = PaymentSchedulePaymentModes::model()->findAll('payment_schedule_id = :id AND plot_type = :type',array(':id'=>$booking->paymentSchedule->id,':type'=>strtolower($booking->plot->plot_type)));
		if($paymentmodes){
			foreach($paymentmodes as $pmodes){
				$data['paymentmodes'][$pmodes->mode] = $pmodes->attributes; 
			}
		}
		if($booking->customerpaymentSchedule){
		    $modesCustom = CustomPaymentSchedulePaymentModes::model()->findAll($booking->id);
		    foreach($modesCustom as $pmodes){
		    	$data['paymentmodesNew'][$pmodes->mode] = $pmodes->attributes; 
		    }
		}
		$this->render('customAdd',$data);
	}

	public function actionEdit($id)
	{
		$phaseId = Yii::app()->session->get('userModel')['phase_id'];
		$data['types'] = Plots::model()->findAll(array(
                    'select'=>'t.plot_type',
                    'distinct'=>true,
                    'condition'=>"phase_id=$phaseId",
                ));
		$data['total'] = PaymentSchedules::model()->count();
		$data['PaymentSchedule'] = PaymentSchedules::model()->findByPk($id);
		$this->render('edit',$data);
	}

	public function actionUpdate()
	{
		//echo '<pre>';print_r($_POST);exit;
		$paymentSchedule = PaymentSchedules::model()->findByPk($_POST['id']);
		if($paymentSchedule){
			$paymentSchedule->name = $_POST['name'];
			$paymentSchedule->save();
			//PaymentSchedulePaymentModes::model()->deleteAll('payment_schedule_id = :id',array(':id'=>$paymentSchedule->id));
			foreach($_POST['payment'] as $mode=>$plotTypes):
				foreach($plotTypes as $type=>$amount):
					$psm = PaymentSchedulePaymentModes::model()->findByPk($amount['id']);
					$psm->payment_schedule_id = $paymentSchedule->id;
					$psm->plot_type = $type;
					$psm->mode = $mode;
					$psm->amount = $amount['amount'];
					$psm->save();
				endforeach;
			endforeach;
		}
		Yii::app()->user->setFlash('success','Payment Schedule updated successfully.');
        $this->redirect(Yii::app()->baseUrl.'/paymentschedule');
	}

	public function actionIndex()
	{
		$phaseId = Yii::app()->session->get('userModel')['phase_id'];
		$data['types'] = Plots::model()->findAll(array(
            'select'=>'t.plot_type',
            'distinct'=>true,
            'condition'=>"phase_id=$phaseId",
        ));
		$data['payments'] = PaymentSchedules::model()->findAll();
		$this->render('index',$data);		
	}

	public function actionSave()
	{
		if($_POST['name']){
			$ps = new PaymentSchedules;
			$ps->name = $_POST['name'];
			$ps->createdOn = date('Y-m-d H:i:s');
			if($ps->save()){
				foreach($_POST['payment'] as $mode=>$plotTypes):
					foreach($plotTypes as $type=>$amount):
						$psm = new PaymentSchedulePaymentModes;
						$psm->payment_schedule_id = $ps->id;
						$psm->plot_type = $type;
						$psm->mode = $mode;
						$psm->amount = $amount;
						$psm->save();
					endforeach;
				endforeach;
			}
			Yii::app()->user->setFlash('success','Payment Schedule add successfully.');
            $this->redirect(Yii::app()->baseUrl.'/paymentschedule');
		}		
	}

	public function actionSavecustom()
	{
		if($_POST['booking_id']){
			$cp = CustomerPlots::model()->findByPk($_POST['booking_id']);
			if($cp){
				$cp->monthlyMonths = $_POST['monthlyMonths'];
				$cp->monthlyYearlies = $_POST['monthlyYearlies'];
				$cp->save(false);
				CustomPaymentSchedulePaymentModes::model()->deleteAll('booking_id = :id',array(':id'=>$_POST['booking_id']));
				if($_POST['payment']['booking'] > 0){
					foreach($_POST['payment'] as $mode=>$amount):
						$psm = new CustomPaymentSchedulePaymentModes;	
						$psm->booking_id = $_POST['booking_id'];
						$psm->mode = $mode;
						$psm->amount = $amount;
						$psm->save();
					endforeach;
				}	
			}
			
			Yii::app()->user->setFlash('success','Custom Payment Schedule updated successfully.');
            $this->redirect(Yii::app()->baseUrl.'/booking/viewbooking/'.$_POST['booking_id']);
		}		
	}

}