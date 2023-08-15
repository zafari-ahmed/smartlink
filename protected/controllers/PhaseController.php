<?php

class PhaseController extends Controller
{
	public function actionAdd()
	{
		$this->render('add');
	}

	public function actionEdit($id)
	{
		$data['agent'] = Phases::model()->findByPk($id);
		$this->render('edit',$data);
	}

	public function actionIndex()
	{
		$data['phases'] = Phases::model()->findAll();
		$this->render('index',$data);		
	}

	public function actionSave()
	{
		if($_POST['phase']){
			$Users = new Phases;
			$Users->attributes = $_POST;
			$Users->created_at = date('Y-m-d H:i:s');
			$Users->save(false);
			Yii::app()->user->setFlash('success','Phase add successfully.');
            $this->redirect(Yii::app()->baseUrl.'/phase');
		}
	}

	public function actionUpdate()
	{
		if($_POST['phase']){
			$Users = Phases::model()->findByPk($_POST['id']);
			$Users->attributes = $_POST;
			$Users->created_at = date('Y-m-d H:i:s');
			$Users->save(false);
			Yii::app()->user->setFlash('success','Phase update successfully.');
            $this->redirect(Yii::app()->baseUrl.'/phase');
		}
	}

	public function actionDelete($id){
		if($id){
			$users = Phases::model()->findByPk($id);
			if($users){
				$users->delete();	
			}
			
			Yii::app()->user->setFlash('success','Phase Update successfully.');
            $this->redirect(Yii::app()->baseUrl.'/phase');
		}
	}


	public function actionsetphase($phase_id){
		$userModel = Yii::app()->session->get('userModel');
		$userModel['phase_id'] = $phase_id;
		Yii::app()->session->add('userModel',$userModel);
		Yii::app()->user->setFlash('success','Phase changed successfully.');
        $this->redirect(Yii::app()->baseUrl.'/dashboard');

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