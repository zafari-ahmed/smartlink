<?php

class CertificateController extends Controller
{
	public function actionGenerate()
	{
		$data['customerPlot'] = CustomerPlots::model()->findByPk($_POST['booking_id']);
		$data['duplicate'] = isset($_POST['duplicate'])?1:0;
		if($_POST['certificate']=='confirm'){
			$this->renderPartial('form1',$data);
		}
		if($_POST['certificate']=='allo-let'){
			$this->renderPartial('form3',$data);
		}

		if($_POST['certificate']=='confirm-2'){
			$this->renderPartial('form1-2',$data);
		}
		if($_POST['certificate']=='confirm-2-back'){
			$this->renderPartial('form1-2-back',$data);
		}

		if($_POST['certificate']=='allo-let-2'){
			$this->renderPartial('form3-2',$data);
		}
		if($_POST['certificate']=='allo-let-2-back'){
			$this->renderPartial('form3-2-back',$data);
		}
		
		if($_POST['certificate']=='allo-cer'){
			$this->renderPartial('form1',$data);
		}
		if($_POST['certificate']=='poss'){
			$this->renderPartial('form1',$data);
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