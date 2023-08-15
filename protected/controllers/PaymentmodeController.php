<?php

class PaymentmodeController extends Controller
{
	public function actionAdd()
	{
		$this->render('add');
	}

	public function actionEdit($id)
	{
		$data['paymentmode'] = PaymentModes::model()->findByPk($id);
		$this->render('edit',$data);
	}

	public function actionIndex()
	{
		//$data['paymentmodes'] = PaymentModes::model()->findAll('amount != 0',array('order'=>'plot_size_id ASC'));
		$data['plotSizes'] = PlotSizes::model()->findAll();
		$this->render('index',$data);
	}

	public function actionUpdate()
	{
		$paymentmode = PaymentModes::model()->findByPk($_POST['id']);
		if($paymentmode){
			$paymentmode->amount = $_POST['amount'];
			$paymentmode->discount = isset($_POST['discount'])?$_POST['discount']:0;
			$paymentmode->save(false);
			Yii::app()->user->setFlash('success','Payment mode has been updated.');
            $this->redirect(Yii::app()->baseUrl.'/paymentmode');
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