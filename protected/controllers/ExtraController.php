<?php

class ExtraController extends Controller
{
	public function actionAdd()
	{
		$this->render('add');
	}

	public function actionEdit($id)
	{
		$data['extra'] = PlotSizes::model()->findByPk($id);	
		$this->render('edit',$data);
	}

	public function actionIndex()
	{
		$data['extras'] = Extras::model()->findAll();
		$this->render('index',$data);
	}

	public function actionSave(){
		if($_POST['name']){
			//$sizes = PlotSizes::model()->findAll('size = :size',array(':size'=>$_POST['size']));
			//if(empty($sizes)){
				$plot = new Extras;
				$plot->attributes = $_POST;
				$plot->save(false);	
				Yii::app()->user->setFlash('success','Plot Plan has been saved.');
			// } else{
			// 	Yii::app()->user->setFlash('error','Same Plot Size.');
			// }
			
			
            $this->redirect(Yii::app()->baseUrl.'/extra');
		}
	}

	public function actionUpdate()
	{
		if($_POST['id']){
			$plot = PlotSizes::model()->findByPk($_POST['id']);
			$plot->attributes = $_POST;
			$plot->save(false);
			Yii::app()->user->setFlash('success','Plot size has been Updated.');
            $this->redirect(Yii::app()->baseUrl.'/sizes');
		}
	}

	public function Percentage($total,$percentage,$view = 1){
		if($view == 1){
			return number_format((@$percentage / 100) * @$total);
		} else{
			return (@$percentage / 100) * @$total;
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