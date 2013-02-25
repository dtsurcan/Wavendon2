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
		$copy_driving = new UserCopiesOfDriving;
		$copy_passport = new UserCopiesOfPassport;
		$photos = new UserPhotos;
		
		// Save copy of driving.
		if(isset($_POST['UserCopiesOfDriving']))
        	$this->saveImage($copy_driving, $_POST['UserCopiesOfDriving'], 'copy/driving');
     
		// Save copy of passport.
		if(isset($_POST['UserCopiesOfPassport']))
        	$this->saveImage($copy_passport, $_POST['UserCopiesOfPassport'], 'copy/passport');		 
		
		// Save photos.
		if(isset($_POST['UserPhotos']))
        	$this->saveImage($photos, $_POST['UserPhotos'], 'photos');
		
		$dataCopiesOfDriving = new CActiveDataProvider('UserCopiesOfDriving', array(
		    'criteria'=>array(
		    		'condition'=>'user_id = :user_id',
		        	'params'=>array(':user_id'=>Yii::app()->user->getUser()->id),
				),
			));
		
		$dataCopiesOfPassport = new CActiveDataProvider('UserCopiesOfPassport', array(
		    'criteria'=>array(
		    	'condition'=>'user_id = :user_id',
		        'params'=>array(':user_id'=>Yii::app()->user->getUser()->id),
		    ),));
		
		$dataPhotos = new CActiveDataProvider('UserPhotos', array(
		    'criteria'=>array(
		    	'condition'=>'user_id = :user_id',
		        'params'=>array(':user_id'=>Yii::app()->user->getUser()->id),
		    ),));
				
		$this->render('profile', array(
			'user' 					=> Yii::app()->user->getUser(), 
			'copy_driving' 			=> $copy_driving, 
			'copy_passport' 		=> $copy_passport, 
			'photos' 				=> $photos, 
			'dataCopiesOfDriving' 	=> $dataCopiesOfDriving,
			'dataCopiesOfPassport'	=> $dataCopiesOfPassport,
			'dataPhotos' 			=> $dataPhotos,
		));
	}
	
	/**
	 * Save image.
	 */
	private function saveImage($model, $post, $url)
	{
		$model->attributes = $post;
		if($model->validate())
		{
            $model->link = CUploadedFile::getInstance($model,'link');
			@mkdir('images/'.$url.'/'.Yii::app()->user->getUser()->id, 0777, true);			
            $model->link->saveAs('images/'.$url.'/'.Yii::app()->user->getUser()->id.'/'.$model->link->name);
            $model->link = $model->link->name;
			$model->date_create = Yii::app()->dateFormatter->format('yyyy-MM-dd H:m:ss', time());
			$model->user_id = Yii::app()->user->getUser()->id;
			 
			if($model->save()) {
            	$this->refresh();
            }			
        } 
	}
	
	/**
	 * Remove image.
	 */
	public function actionRemoveImage()
	{
		if(!Yii::app()->user->hasRole('Admin, Tenant, Guarantor, Landlord, User'))
	    	CommonUtils::ajaxNotLoggedIn();
		
		$image_ids = isset($_POST['ids']) ? $_POST['ids'] : null;
		$type = isset($_POST['type']) ? $_POST['type'] : null;
		
		switch ($type) {
			case 'delete-driving-form':
				$model = new UserCopiesOfDriving;
				break;
			case 'delete-passport-form':
				$model = new UserCopiesOfPassport;
				break;
			case 'delete-photos-form':
				$model = new UserPhotos;
				break;
		}
		
		if (!Yii::app()->user->hasRole('Admin'))
			if (!isset($model) || !$model->checkIds(explode(',', $image_ids), Yii::app()->user->getUser()->id))
	    		CommonUtils::ajaxIncorrectRequest();
		
		if (!$model->removeImages(explode(',', $image_ids)))
			CommonUtils::ajaxError('Failed to remove image.');	
				
		CommonUtils::ajaxOK(array('resp'=>'ok'));
	}

	/**
	 * Update user info.
	 */
	public function actionUpdate()
	{
	  	if(Yii::app()->request->isPostRequest) 
	  	{	        	
	        $model = Yii::app()->user->getUser();
			
			$post[$_POST['name']] = $_POST['value'];
	        $model->attributes = $post;
			$model->date_update	= Yii::app()->dateFormatter->format('yyyy-MM-dd H:m:ss', time());
			
			if ($_POST['name'] == 'note')
				$model->date_note_update = Yii::app()->dateFormatter->format('yyyy-MM-dd H:m:ss', time());
			
	        if($model->save(false)) {
	            echo CJSON::encode(array('id' => $model->title_id));
	        } else {
	            $errors = array_map(function($v){ return join(', ', $v); }, $model->getErrors());
	            echo CJSON::encode(array('errors' => $errors));
	        }
	    } else {
	      throw new CHttpException(400, 'Invalid request');  
    	}
	}
}