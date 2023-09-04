<?php

class DeviceController extends Controller
{
	public function actionAdd()
	{
		$this->render('add');
	}

	public function actionEdit()
	{
		$this->render('edit');
	}

	public function actionIndex()
	{
		$data['devices'] = Devices::model()->findAll(array('order'=>'id DESC'));
		$this->render('index',$data);		
	}

	public function actionSave()
	{

		if($_POST['device_category']){
			$Devices = new Devices;
			$Devices->attributes = $_POST;
			$Devices->status = 1;
			$Devices->created_at =  date('Y-m-d');
			$Devices->save(false);
			Yii::app()->user->setFlash('success','Device added successfully.');
            $this->redirect(Yii::app()->baseUrl.'/device');
		}

	}

	public function actionUpdate()
	{
		$this->render('update');
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