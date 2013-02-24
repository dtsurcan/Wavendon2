<?php

/**
 * This is the model class for table "{{user_copies_of_driving}}".
 *
 * The followings are the available columns in table '{{user_copies_of_driving}}':
 * @property integer $id
 * @property string $date_create
 * @property integer $user_id
 * @property string $link
 *
 * The followings are the available model relations:
 * @property Users $user
 */
class UserCopiesOfDriving extends CActiveRecord
{
	public $link;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UserCopiesOfDriving the static model class
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
		return '{{user_copies_of_driving}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('date_create, user_id, link', 'required'),
			array('user_id', 'numerical', 'integerOnly'=>true),
			array('link', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, date_create, user_id, link', 'safe', 'on'=>'search'),
			
			array('link', 'file', 'types'=>'jpg, gif, png'),
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
			'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'date_create' => 'Date Create',
			'user_id' => 'User',
			'link' => 'Copy of driving',
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
		$criteria->compare('date_create',$this->date_create,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('link',$this->link,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Check if user want delete his image.
	 * @return boolean
	 */
	public function checkId($image_id, $user_id)
	{
		$image = null;
		if ($image_id == null)
			return true;

		$image = $this->findByPk($image_id);
		if ($image == null || $image->user_id != $user_id)
			return false;

		return true;
	}
}