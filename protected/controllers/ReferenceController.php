<?php

class ReferenceController extends Controller
{
	public function actionAdd()
	{
		$data['legalTypes'] = LegalTypes::model()->findAll();
		$this->render('add',$data);
	}

	public function actionEdit()
	{
		$this->render('edit');
	}

	public function actionIndex()
	{
		$data['references'] = References::model()->findAll();
		$this->render('index',$data);
	}

	public function actionSave()
	{
		if($_POST['account_name']){
			$customer = new References;
			$customer->attributes = $_POST;
			$customer->status = 1;
			$customer->devices_sold =  0;
			$customer->created_at =  date('Y-m-d H:i:s');
			$customer->updated_at =  date('Y-m-d H:i:s');
			$customer->save(false);
			Yii::app()->user->setFlash('success','Reference added successfully.');
            $this->redirect(Yii::app()->baseUrl.'/reference');
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