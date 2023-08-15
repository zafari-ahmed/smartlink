<?php

class MessageController extends Controller
{
	public function actionAdd()
	{
		$this->render('add');
	}

	public function actionSave()
	{
		$numbers = explode(',', $_POST['number']);
		foreach ($numbers as $number) {
				$number = str_replace('-','', $number);
				$message = $_POST['message'];
				$url = 'https://pk.eocean.us/APIManagement/API/RequestAPI?user=essahousing&pwd=AIWek1Cq5NojxZGlHDwnSvkuNTa4k6GZ1eE1nRMPxrn4aFGVzxFR2TvOuol3ZlVyFw%3d%3d&sender=EssaHousing&reciever='.@$number.'&msg-data='.rawurlencode($message).'&response=string';
				$sms = @file_get_contents($url);	
		}
		Yii::app()->user->setFlash('success','Message send succussfully.');
		$this->redirect(Yii::app()->baseUrl.'/message/add');
	}


	public function actionUpload()
	{
		$this->render('upload');
	}

	public function actionUploadsave(){
		$numbers = Yii::app()->db->createCommand()
			    ->select('name,mobile')
			    ->from('customers c')
			    ->where("mobile !=''")
			    ->group('name')
			    ->queryAll();
		$message = $_POST['message'];
		$test = isset($_POST['test'])?true:false;
		if($test){
			$numbers = [];
			$numbers[0] = ['name'=>'Bilal','mobile'=>'03122249841'];
			$numbers[1] = ['name'=>'Aamir','mobile'=>'03222400467'];
			$numbers[2] = ['name'=>'Zafar','mobile'=>'03312326877'];
		}
		if($numbers){
			foreach($numbers as $number){
				$num = str_replace('-','', $number['mobile']);
				$name = ucfirst($number['name']);
				$updatedMsg = "Dear $name,\n".$message;
				$this->sendSMS($num,$updatedMsg);
			}
			$this->sendSMS('03122249841','Bulk Message activity completed.');
		}
		Yii::app()->user->setFlash('success','Message send succussfully.');
		$this->redirect(Yii::app()->baseUrl.'/message/upload');
	}

	public function actionAllmessages()
	{
		$this->render('allmessage');
	}

	public function actionRunallmessage(){
		$numbers = Yii::app()->db->createCommand()
			    ->select('c.name,c.mobile,p.block_number,p.plot_number,p.plot_type')
			    ->from('customer_plots cp')
			    ->join('plots p','p.id=cp.plot_id')
			    ->join('customers c','c.id=cp.customer_id')
			    ->queryAll();
		$message = $_POST['messagetorun'];
		$test = isset($_POST['test'])?true:false;
		if($test){
			$numbers = [];
			$numbers[] = ['name'=>'Bilal','mobile'=>'03122249841','block_number' => 'B','plot_number' => '65','plot_type' => 'R'];
			$numbers[] = ['name'=>'Aamir','mobile'=>'03222400467','block_number' => 'B','plot_number' => '65','plot_type' => 'R'];
			$numbers[] = ['name'=>'Zafar','mobile'=>'03312326877', 'block_number' => 'B','plot_number' => '65','plot_type' => 'R'];
		}

		if($message=='payment_reminder'){
			if($numbers){
				foreach($numbers as $number){
					$num = str_replace('-','', $number['mobile']);
					$plot = $number['plot_type'].'-'.$number['plot_number'];
					$block = $number['block_number'];
					$updatedMsg = "Dear ".ucfirst($number['name']).",\nThis is to inform you that monthly installments of your plot ".$plot." in Block ".$block." of KAINAT CITY, Scheme 45 has been started from May 2022. \nPlease pay your monthly installment of May/June(If Any) before 10 June 2022. \nKindly ignore if you have paid your May/June 2022 installment. \nFor details, please call 021-37440935";
					$this->sendSMS($num,$updatedMsg);
				}

				$this->sendSMS('03122249841','Payment Reminder message activity completed.');

			}
		}
		Yii::app()->user->setFlash('success','Reminder messages send succussfully.');
		$this->redirect(Yii::app()->baseUrl.'/message/allmessages');
	}


	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}