<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property string $id
 * @property string $name
 * @property string $code
 * @property string $user_id
 * @property string $password
 * @property string $dob
 * @property string $nic_number
 * @property string $address
 * @property string $contact_number_home
 * @property string $contact_number_emergency
 * @property string $contact_number_mobile
 * @property string $email
 * @property string $status
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 *
 * The followings are the available model relations:
 * @property MessageCenters[] $messageCenters
 * @property TaskCenters[] $taskCenters
 */
class Users extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, code, password, email, status', 'required'),
			array('name, code, user_id, password, nic_number, address, contact_number_home, contact_number_emergency, contact_number_mobile, email, status', 'length', 'max'=>255),
			array('dob, created_at, updated_at, deleted_at', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, code, user_id, password, dob, nic_number, address, contact_number_home, contact_number_emergency, contact_number_mobile, email, status, created_at, updated_at, deleted_at', 'safe', 'on'=>'search'),
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
			'messageCenters' => array(self::HAS_MANY, 'MessageCenters', 'sent_by'),
			'taskCenters' => array(self::HAS_MANY, 'TaskCenters', 'sent_by'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'code' => 'Code',
			'user_id' => 'User',
			'password' => 'Password',
			'dob' => 'Dob',
			'nic_number' => 'Nic Number',
			'address' => 'Address',
			'contact_number_home' => 'Contact Number Home',
			'contact_number_emergency' => 'Contact Number Emergency',
			'contact_number_mobile' => 'Contact Number Mobile',
			'email' => 'Email',
			'status' => 'Status',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
			'deleted_at' => 'Deleted At',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('dob',$this->dob,true);
		$criteria->compare('nic_number',$this->nic_number,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('contact_number_home',$this->contact_number_home,true);
		$criteria->compare('contact_number_emergency',$this->contact_number_emergency,true);
		$criteria->compare('contact_number_mobile',$this->contact_number_mobile,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('updated_at',$this->updated_at,true);
		$criteria->compare('deleted_at',$this->deleted_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Users the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
