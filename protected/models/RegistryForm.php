<?php

/**
 * RegistryForm class.
 * RegistryForm is the data structure for keeping
 * registry form data. It is used by the 'registry' action of 'UserController'.
 */
class RegistryForm extends CFormModel
{
	public $title_id;
	public $first_name;
	public $middle_name;
	public $last_name;
	public $passport_number;
	public $driving_license_number;
	public $email;
	public $password;
	public $password_repeat;
	
	public $verifyCode;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			// email, password are required
			array('email, password, password_repeat', 'required'),
			// email has to be a valid email address
			array('email', 'email'),
			// verifyCode needs to be entered correctly
			array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements()),
			// email, password are validate
			array('password, password_repeat', 'validate_passwords'),
			array('email', 'validate_email'),
			
			array('id, title_id, first_name, middle_name, last_name, type_id, passport_number, driving_license_number, email, password, date_create, date_update', 'safe'),
		
		);
	}

	/**
	 * Declares customized attribute labels.
	 * If not declared here, an attribute would have a label that is
	 * the same as its name with the first letter in upper case.
	 */
	public function attributeLabels()
	{
		return array(
			'verifyCode'=>'Verification Code',
		);
	}
	
	/**
	 * Check passwords.
	 * This is the 'validate_passwords' validator as declared in rules().
	 */
	public function validate_passwords($attribute,$params)
	{
		if (strlen($this->password) < 6)
			$this->addError('password','Password length should be more than 6 symbols');
		
		if ($this->password !== $this->password_repeat)
			$this->addError('password_repeat','Passwords are not the same');
	}
	
	/**
	 * Check email.
	 * This is the 'validate_email' validator as declared in rules().
	 */
	public function validate_email($attribute,$params)
	{
		$users = new Users;
		if ($users->findEmail($this->email))
			$this->addError('email','This email address is already in use');
	}	
	
	/**
	 * Create new user in the model.
	 * @return boolean whether registry is successful
	 */
	public function registry()
	{
		$new_user = new Users;
		
		$new_user->title_id 				= $this->title_id;
		$new_user->first_name 				= $this->first_name;
		$new_user->middle_name 				= $this->middle_name;
		$new_user->last_name 				= $this->last_name;
		$new_user->passport_number 			= $this->passport_number;
		$new_user->driving_license_number 	= $this->driving_license_number;
		$new_user->email 					= $this->email;
		$new_user->password 				= $new_user->hashPassword($this->password);
		$new_user->date_create 				= Yii::app()->dateFormatter->format('yyyy-MM-dd H:m:ss', time());
		$new_user->date_update				= Yii::app()->dateFormatter->format('yyyy-MM-dd H:m:ss', time());
		
		if ($new_user->save(false))
		{
			$role = new UserRole;
			$role->user_id = $new_user->id;
			$role->role_id = 1;
			$role->save(false);
			
			$login_user = new LoginForm;
			
			$login_user->email = $this->email;
			$login_user->password = $this->password;
			
			if ($login_user->login())
				return true;
			
			return false;
		}
		
		return false;
	}
}