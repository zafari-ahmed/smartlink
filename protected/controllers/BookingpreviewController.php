<?php

class BookingpreviewController extends Controller
{
	public function actionPreview($id)
	{
		$data['booking'] = CustomerPlotsPreview::model()->findByPk($id);
		$this->renderPartial('preview',$data);
	}

	public function actionDuplicate($id)
	{
		$data['booking'] = CustomerPlots::model()->findByPk($id);
		$this->renderPartial('previewDup',$data);
	}

	public function actionFile($id)
	{
		$data['booking'] = CustomerPlots::model()->findByPk($id);
		$this->layout = 'ledger';
		$this->render('fullattachfile',$data);
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