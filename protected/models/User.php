<?php

/**
 * @property integer $id
 * @property string $screenName
 * @property string $oauthProvider
 * @property string $oauthKey1
 * @property string $oauthKey2
 * @property string $createTime
 * @property string $updateTime
 */
class User extends CActiveRecord
{

	/**
	 * @return User the static model class
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
		return 'User';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('screenName',				'required'),
			array('screenName',				'length', 'max'=>255),
			array('oauthKey1, oauthKey2',	'length', 'max'=>64),

			array('id, screenName, oauthProvider, oauthKey1, oauthKey2, ', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array();
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id'			=> 'ID',
			'screenName'	=> 'Nick',
			'oauthProvider'	=> 'OAuth provider',
			'oauthKey1'		=> 'OAuth key1',
			'oauthKey2'		=> 'OAuth key2',
			'createTime'	=> 'Create Time',
			'updateTime'	=> 'Update Time',
		);
	}

	/**
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('id',			$this->id);
		$criteria->compare('screenName',	$this->screenName, true);
		$criteria->compare('oauthProvider',	$this->oauthProvider, true);
		$criteria->compare('oauthKey1',		$this->oauthKey1, true);
		$criteria->compare('oauthKey2',		$this->oauthKey2, true);
		$criteria->compare('createTime',	$this->createTime, true);
		$criteria->compare('updateTime',	$this->updateTime, true);

		return new CActiveDataProvider('User', array(
			'criteria'=>$criteria,
		));
	}



	public function behaviors()
	{
		return array(
			'CTimestampBehavior' => array(
				'class' => 'zii.behaviors.CTimestampBehavior',
				'createAttribute' => 'createTime',
				'updateAttribute' => 'updateTime',
			)
		);
	}

}
