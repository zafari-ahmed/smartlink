<?php

class ReferenceController extends Controller
{
	public function actionAdd()
	{
		$data['countries'] = Countries::model()->findAll();
		$data['legalTypes'] = LegalTypes::model()->findAll();
		$this->render('add',$data);
	}

	public function actionEdit($id)
	{

		$data['reference'] = References::model()->findByPk($id);
		$data['countries'] = Countries::model()->findAll();
		$data['legalTypes'] = LegalTypes::model()->findAll();
		$this->render('edit',$data);
	}

	public function actionView($id)
	{
		$data['reference'] = References::model()->findByPk($id);
		$data['countries'] = Countries::model()->findAll();
		$data['legalTypes'] = LegalTypes::model()->findAll();
		$this->render('view',$data);
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
		if($_POST['id']){
			$customer = References::model()->findByPk($_POST['id']);
			$customer->attributes = $_POST;
			$customer->status = 1;
			$customer->created_at =  date('Y-m-d H:i:s');
			$customer->updated_at =  date('Y-m-d H:i:s');
			$customer->save(false);
			Yii::app()->user->setFlash('success','Reference updated successfully.');
            $this->redirect(Yii::app()->baseUrl.'/reference');
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