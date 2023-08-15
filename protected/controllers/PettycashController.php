<?php

class PettycashController extends Controller
{
	public function actionAdd()
	{
		$data['accounts'] = Accounts::model()->findAll();
		$data['phases'] = Phases::model()->findAll();
		$criteria = new CDbCriteria();
		$criteria->group = "paid_to";
		$data['paid_to_list'] = PettyCashExpenses::model()->findAll($criteria);
		$this->render('add',$data);
	}

	public function actionEdit($id)
	{
		$data['accounts'] = Accounts::model()->findAll();
		$data['phases'] = Phases::model()->findAll();
		$criteria = new CDbCriteria();
		$criteria->group = "paid_to";
		$data['paid_to_list'] = PettyCashExpenses::model()->findAll($criteria);
		$data['expense'] = PettyCashExpenses::model()->findByPk($id);
		
		$this->render('edit',$data);
		
	}

	public function actionUpdate(){
		if($_POST['id']){
			$pettyCash = PettyCashExpenses::model()->findByPk($_POST['id']);
			$pettyCash->attributes = $_POST;
			$pettyCash->user_id = Yii::app()->session['userModel']['id'];
			$pettyCash->createdOn = date('Y-m-d H:i:s');
			$pettyCash->status = 2;
			$pettyCash->save(false);
			Yii::app()->user->setFlash('success','Expense update successfully.');
            $this->redirect(Yii::app()->baseUrl.'/expenses');
		}
	}

	public function actionIndex()
	{
		$userModel = Yii::app()->session->get('userModel');
		$criteria = new CDbCriteria();
		$phaseId = Yii::app()->session->get('userModel')['phase_id'];
		$criteria->addCondition("phase_id = $phaseId");
		$criteria->order = "createdOn DESC";
		$data['expenses'] = PettyCash::model()->findAll($criteria);
		
		$this->render('index',$data);
	}

	public function actionExpenses()
	{
		$userModel = Yii::app()->session->get('userModel');
		$criteria = new CDbCriteria();
		$phaseId = Yii::app()->session->get('userModel')['phase_id'];
		$criteria->addCondition("phase_id = $phaseId");
		$criteria->order = "createdOn DESC";
		$data['expenses'] = PettyCashExpenses::model()->findAll($criteria);
		//echo '<pre>';print_r($data['expenses']);exit;
		$this->render('expenses',$data);
	}

	public function actionSave()
	{
		if($_POST['description']){
			$expense = new PettyCashExpenses;
			$expense->attributes = $_POST;
			$expense->user_id = Yii::app()->session['userModel']['id'];
			$expense->createdOn = $_POST['createdOn'].' '.date('H:i:s');
			$expense->status = 2;
			$expense->save(false);
			Yii::app()->user->setFlash('success','Petty Cash Expense add successfully.');
            $this->redirect(Yii::app()->baseUrl.'/expenses');
		}
	}

	// public function actionDelete($id)
	// {
	// 	$expense = PettyCashExpenses::model()->findByPk($id);
	// 	$expense->delete();
	// 	Yii::app()->user->setFlash('success','Petty Cash Expense deleted successfully.');
    //     //$this->redirect(Yii::app()->baseUrl.'/pettycash/expenses');
    //     $this->redirect(Yii::app()->baseUrl.'/expenses');
		
	// }

	public function actionDelete($status,$id)
	{
		// $expense = PettyCashExpenses::model()->findByPk($id);
		// $expense->status = $status;
		// $expense->reason = 'Not Approved';
		// $expense->save(false);
		// Yii::app()->user->setFlash('success','Expense update successfully.');
  		// $this->redirect(Yii::app()->baseUrl.'/expenses');

		if($status==1){
			$expense = PettyCashExpenses::model()->findByPk($id);
			$expense->status = 1;
			$expense->save(false);
			$url  = Yii::app()->baseUrl.'/expenses/expenseinvoice/id/'.$id.'/type/pettyCash';
			//Yii::app()->user->setFlash('success','Expense update successfully.');
			$this->redirect($url);
		}
		if($status!=1){
			$data['expense'] = PettyCashExpenses::model()->findByPk($id);
			$data['status'] = 0;
			$this->render('delete',$data);
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