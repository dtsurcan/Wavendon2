<?php

/**
 * This is the model class for table "{{users}}".
 *
 * The followings are the available columns in table '{{users}}':
 * @property integer $id
 * @property integer $title_id
 * @property string $first_name
 * @property string $middle_name
 * @property string $last_name
 * @property integer $type_id
 * @property string $passport_number
 * @property string $driving_license_number
 * @property string $email
 * @property string $password
 * @property string $date_create
 * @property string $date_update
 *
 * The followings are the available model relations:
 * @property UserCopiesOfDriving[] $userCopiesOfDrivings
 * @property UserCopiesOfPassport[] $userCopiesOfPassports
 * @property UserNotes[] $userNotes
 * @property UserPhotos[] $userPhotoses
 * @property UserTitles $title
 * @property UserTypes $type
 */
class Users extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Users the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{users}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('email, password, date_create, date_update', 'required'),
			array('title_id, type_id', 'numerical', 'integerOnly'=>true),
			array('first_name, middle_name, last_name, passport_number, driving_license_number, email, password', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title_id, first_name, middle_name, last_name, type_id, passport_number, driving_license_number, email, password, date_create, date_update', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'userCopiesOfDrivings' => array(self::HAS_MANY, 'UserCopiesOfDriving', 'user_id'),
			'userCopiesOfPassports' => array(self::HAS_MANY, 'UserCopiesOfPassport', 'user_id'),
			'userNotes' => array(self::HAS_MANY, 'UserNotes', 'user_id'),
			'userPhotoses' => array(self::HAS_MANY, 'UserPhotos', 'user_id'),
			'title' => array(self::BELONGS_TO, 'UserTitles', 'title_id'),
			'type' => array(self::BELONGS_TO, 'UserTypes', 'type_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title_id' => 'Title',
			'first_name' => 'First Name',
			'middle_name' => 'Middle Name',
			'last_name' => 'Last Name',
			'type_id' => 'Type',
			'passport_number' => 'Passport Number',
			'driving_license_number' => 'Driving License Number',
			'email' => 'Email',
			'password' => 'Password',
			'date_create' => 'Date Create',
			'date_update' => 'Date Update',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('title_id',$this->title_id);
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('middle_name',$this->middle_name,true);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('type_id',$this->type_id);
		$criteria->compare('passport_number',$this->passport_number,true);
		$criteria->compare('driving_license_number',$this->driving_license_number,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('date_create',$this->date_create,true);
		$criteria->compare('date_update',$this->date_update,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Checks if the given password is correct.
	 * @param string the password to be validated
	 * @return boolean whether the password is valid
	 */
	public function validatePassword($password)
	{
		var_dump(crypt($password,$this->generateSalt()));
		var_dump($this->password);
		
		return crypt($password,$this->password)===$this->password;
	}
		
	/**
	 * Search any email address.
	 * @return boolean whether email is find
	 */
	public function findEmail($email)
	{
		 if (!is_null($this->findByAttributes(array('email'=>$email)))) return true; else return false;;
	}
	
	/**
	 * Generates the password hash.
	 * @param string password
	 * @return string hash
	 */
	public function hashPassword($password)
	{
		return crypt($password, $this->generateSalt());
	}

	/**
	 * Generates a salt that can be used to generate a password hash.
	 *
	 * The {@link http://php.net/manual/en/function.crypt.php PHP `crypt()` built-in function}
	 * requires, for the Blowfish hash algorithm, a salt string in a specific format:
	 *  - "$2a$"
	 *  - a two digit cost parameter
	 *  - "$"
	 *  - 22 characters from the alphabet "./0-9A-Za-z".
	 *
	 * @param int cost parameter for Blowfish hash algorithm
	 * @return string the salt
	 */
	protected function generateSalt($cost=10)
	{
		if(!is_numeric($cost)||$cost<4||$cost>31){
			throw new CException(Yii::t('Cost parameter must be between 4 and 31.'));
		}
		// Get some pseudo-random data from mt_rand().
		$rand='';
		for($i=0;$i<8;++$i)
			$rand.=pack('S',mt_rand(0,0xffff));
		// Add the microtime for a little more entropy.
		$rand.=microtime();
		// Mix the bits cryptographically.
		$rand=sha1($rand,true);
		// Form the prefix that specifies hash algorithm type and cost parameter.
		$salt='$2a$'.str_pad((int)$cost,2,'0',STR_PAD_RIGHT).'$';
		// Append the random salt string in the required base64 format.
		$salt.=strtr(substr(base64_encode($rand),0,22),array('+'=>'.'));
		return $salt;
	}
}