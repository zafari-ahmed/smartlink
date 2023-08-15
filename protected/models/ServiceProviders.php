<?php

/**
 * This is the model class for table "service_providers".
 *
 * The followings are the available columns in table 'service_providers':
 * @property integer $id
 * @property string $external_vendor_number
 * @property string $contact_person
 * @property string $email_address
 * @property string $phone_number
 * @property string $created_at
 * @property string $updated_at
 */
class ServiceProviders extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'service_providers';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('external_vendor_number, contact_person, email_address, phone_number', 'length', 'max'=>255),
			array('created_at, updated_at', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, external_vendor_number, contact_person, email_address, phone_number, created_at, updated_at', 'safe', 'on'=>'search'),
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
			'external_vendor_number' => 'External Vendor Number',
			'contact_person' => 'Contact Person',
			'email_address' => 'Email Address',
			'phone_number' => 'Phone Number',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('external_vendor_number',$this->external_vendor_number,true);
		$criteria->compare('contact_person',$this->contact_person,true);
		$criteria->compare('email_address',$this->email_address,true);
		$criteria->compare('phone_number',$this->phone_number,true);
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
	 * @return ServiceProviders the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
