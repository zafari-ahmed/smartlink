<?php

class WarningLetterController extends Controller
{
	public function actionEdit($id)
	{
		$data['letter'] = CustomerPlotsWarningLetters::model()->findByPk($id);
		$this->render('edit',$data);
	}

	public function actionIndex()
	{
		$data['warningLetters'] = CustomerPlotsWarningLetters::model()->findAll();
		$this->render('index',$data);
	}

	public function actionUpdate()
	{
		$letter = CustomerPlotsWarningLetters::model()->findByPk($_POST['id']);
		if($letter){
			$letter->createdOn = @$_POST['createdOn'];
			$letter->tracking_id = @$_POST['tracking_id'];
			$letter->received_by = @$_POST['received_by'];
			$letter->received_on = @$_POST['received_on'];
			$letter->save(false);
			Yii::app()->user->setFlash('success','Warning letter has been updated.');
	        $this->redirect(Yii::app()->baseUrl.'/warningletter');	
		} else{
			Yii::app()->user->setFlash('error','No Warning Letter is found');
	        $this->redirect(Yii::app()->baseUrl.'/warningletter');	
		}
	}

	public function actionDelete($id){
		$letter = CustomerPlotsWarningLetters::model()->findByPk($id);
		if($letter){
			$letter->delete();
			Yii::app()->user->setFlash('success','Warning letter deleted successfully.');
	        $this->redirect(Yii::app()->baseUrl.'/warningletter');				
		} else{
			Yii::app()->user->setFlash('error','No Warning Letter is found');
	        $this->redirect(Yii::app()->baseUrl.'/warningletter');
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