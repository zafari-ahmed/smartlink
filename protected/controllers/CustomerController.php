<?php

class CustomerController extends Controller
{
	public function actionAdd()
	{
		$data['countries'] = Countries::model()->findAll();
		$data['references'] = References::model()->findAll();
		$data['legalTypes'] = LegalTypes::model()->findAll();
		$this->render('add',$data);
	}

	public function actionEdit($id)
	{
		$data['countries'] = Countries::model()->findAll();
		$data['customer'] = Customers::model()->findByPk($id);
		$data['legalTypes'] = LegalTypes::model()->findAll();
		$data['references'] = References::model()->findAll();
		$this->render('edit',$data);
	}


	public function actionView($id)
	{
		$data['countries'] = Countries::model()->findAll();
		$data['customer'] = Customers::model()->findByPk($id);
		$data['legalTypes'] = LegalTypes::model()->findAll();
		$data['references'] = References::model()->findAll();
		$data['customerDevices'] = CustomerDevices::model()->findAll("customer_id = ".$id);
		$this->render('view',$data);
	}

	public function actionIndex()
	{
		$data['customers'] = Customers::model()->findAll();
		$this->render('index',$data);
	}

	public function actionSave()
	{
		if($_POST['name']){
			$customer = new Customers;
			$customer->attributes = $_POST;
			$customer->status = 1;
			$customer->allowed_user = 1;
			$customer->current_user = Yii::app()->session['userModel']['first_name'].' '.Yii::app()->session['userModel']['last_name'];
			$customer->unique_reference_id =  !empty($_POST['unique_reference_id'])?$_POST['unique_reference_id']:NULL;
			$customer->created_at =  date('Y-m-d H:i:s');
			$customer->updated_at =  date('Y-m-d H:i:s');
			$customer->save(false);
			Yii::app()->user->setFlash('success','Customer added successfully.');
            $this->redirect(Yii::app()->baseUrl.'/customer');
		}
	}

	public function actionCustomerdevice($id)
	{
		$data['customers'] = Customers::model()->findAll();
		$data['devices'] = Devices::model()->findAll();
		$data['customerDevices'] = CustomerDevices::model()->findAll("customer_id = ".$id);
		$data['customer_id'] = $id;
		$this->render('customer_devices',$data);
	}

	public function actionsaveDevices(){
		if($_POST['device_id']){
			$deviceId = $_POST['device_id'];
			$customerId = $_POST['customer_id'];
			if(CustomerDevices::model()->count("device_id = $deviceId AND customer_id = $customerId") > 0){
				Yii::app()->user->setFlash('success','Device already added in customer portal.');
	            $this->redirect(Yii::app()->baseUrl.'/customer/customerdevice/'.$_POST['customer_id']);	
			} else{
				$customer = new CustomerDevices;
				$customer->attributes = $_POST;
				$customer->status = 1;
				$customer->created_at =  date('Y-m-d H:i:s');
				$customer->save(false);
				Yii::app()->user->setFlash('success','Customer Device added successfully.');
	            $this->redirect(Yii::app()->baseUrl.'/customer/customerdevice/'.$_POST['customer_id']);	
			}
			
		}
	}

	public function actiondeletecustomerdevice($id){
		$customerDevice = CustomerDevices::model()->findByPk($id);
		if($customerDevice){
			$customerId = $customerDevice->customer_id;
			$customerDevice->delete();
			Yii::app()->user->setFlash('success','Customer Device deleted successfully.');
            $this->redirect(Yii::app()->baseUrl.'/customer/customerdevice/'.$customerId);
		}

	}

	public function actionUpdate()
	{
		if($_POST['id']){
			$customer = Customers::model()->findByPk($_POST['id']);
			$customer->attributes = $_POST;
			$customer->current_user = Yii::app()->session['userModel']['first_name'].' '.Yii::app()->session['userModel']['last_name'];
			$customer->unique_reference_id =  substr(microtime(), 2, 5);;
			$customer->updated_at =  date('Y-m-d H:i:s');
			$customer->save(false);
			Yii::app()->user->setFlash('success','Customer updated successfully.');
            $this->redirect(Yii::app()->baseUrl.'/customer');
		}
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