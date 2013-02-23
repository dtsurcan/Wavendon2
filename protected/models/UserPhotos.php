<?php

/**
 * This is the model class for table "{{user_photos}}".
 *
 * The followings are the available columns in table '{{user_photos}}':
 * @property integer $id
 * @property string $date_create
 * @property integer $user_id
 * @property string $link
 * @property integer $primary
 *
 * The followings are the available model relations:
 * @property Users $user
 */
class UserPhotos extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UserPhotos the static model class
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
		return '{{user_photos}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('date_create, user_id, link', 'required'),
			array('user_id, primary', 'numerical', 'integerOnly'=>true),
			array('link', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, date_create, user_id, link, primary', 'safe', 'on'=>'search'),
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
			'link' => 'Link',
			'primary' => 'Primary',
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
		$criteria->compare('primary',$this->primary);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}