<?php

/**
 * This is the model class for table "personal_access_tokens".
 *
 * The followings are the available columns in table 'personal_access_tokens':
 * @property string $id
 * @property string $tokenable_type
 * @property string $tokenable_id
 * @property string $name
 * @property string $token
 * @property string $abilities
 * @property string $last_used_at
 * @property string $created_at
 * @property string $updated_at
 */
class PersonalAccessTokens extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'personal_access_tokens';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('tokenable_type, tokenable_id, name, token', 'required'),
			array('tokenable_type, name', 'length', 'max'=>255),
			array('token', 'length', 'max'=>64),
			array('abilities, last_used_at, created_at, updated_at', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, tokenable_type, tokenable_id, name, token, abilities, last_used_at, created_at, updated_at', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'tokenable_type' => 'Tokenable Type',
			'tokenable_id' => 'Tokenable',
			'name' => 'Name',
			'token' => 'Token',
			'abilities' => 'Abilities',
			'last_used_at' => 'Last Used At',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('tokenable_type',$this->tokenable_type,true);
		$criteria->compare('tokenable_id',$this->tokenable_id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('token',$this->token,true);
		$criteria->compare('abilities',$this->abilities,true);
		$criteria->compare('last_used_at',$this->last_used_at,true);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('updated_at',$this->updated_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PersonalAccessTokens the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
