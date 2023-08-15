<?php

class UserController extends Controller
{
	public function actionAdd()
	{
		$data['types'] = UserTypes::model()->findAll('id > 2');
		$this->render('add',$data);
	}

	public function actionEdit($id)
	{
		$data['user'] = Users::model()->findByPk($id);
		$data['types'] = UserTypes::model()->findAll('id > 2');
		$this->render('edit',$data);
	}

	public function actionIndex()
	{
		$data['users'] = Users::model()->findAll('user_type_id != 1');
		$this->render('index',$data);
	}



	public function actionChangepassword()
	{
		$userModel = Yii::app()->session->get('userModel');
		$data['users'] = Users::model()->findByPk($userModel['id']);
		$this->render('changepassword',$data);
	}


	public function actionSavepassword()
	{
		$userModel = Yii::app()->session->get('userModel');
		$user = Users::model()->findByPk($userModel['id']);
		if($_POST['username'] == $user->username){
			$user->password = md5($_POST['password']);
			$user->save(false);
			Yii::app()->user->setFlash('success','User update successfully.');
            $this->redirect(Yii::app()->baseUrl.'/user/changepassword');
		} else{
			Yii::app()->user->setFlash('danger','Username not matched.');
            $this->redirect(Yii::app()->baseUrl.'/user/changepassword');
		}
	}

	public function actionUpdate()
	{
		if($_POST['first_name']){
			$Users = Users::model()->findByPk($_POST['id']);
			$Users->attributes = $_POST;
			$Users->status = 1;
			$Users->save(false);
			Yii::app()->user->setFlash('success','User update successfully.');
            $this->redirect(Yii::app()->baseUrl.'/user');
		}
	}

	public function actionSave(){
		if($_POST['first_name']){
			$Users = new Users;
			$Users->attributes = $_POST;
			$Users->password = md5($_POST['password']);
			$Users->status = 1;
			$Users->save(false);
			Yii::app()->user->setFlash('success','User add successfully.');
            $this->redirect(Yii::app()->baseUrl.'/user');
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