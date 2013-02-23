<?php

class UserController extends Controller
{
	
	public $layout='column1';
	
	/**
	 * Default page.
	 */
	public function actionIndex()
	{
		$this->render('index');
	}

	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
		);
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}
		
	/**
	 * Registration page.
	 */
	public function actionRegistry()
	{
		$model = new RegistryForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='registry-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		
		// collect user input data
		if(isset($_POST['RegistryForm']))
		{
			$model->attributes=$_POST['RegistryForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->registry())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		
		$this->render('registry', array('model' => $model));
	}

	/**
	 * Profile page.
	 */
	public function actionProfile()
	{
		$this->render('profile', array('user' => Yii::app()->user->getUser()));
	}
	
}