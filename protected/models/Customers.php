<?php

/**
 * This is the model class for table "customers".
 *
 * The followings are the available columns in table 'customers':
 * @property string $id
 * @property string $country_id
 * @property string $name
 * @property integer $legal_type_id
 * @property string $incorporation_number
 * @property string $ntn_number
 * @property string $strn_number
 * @property string $email
 * @property string $password
 * @property string $allowed_user
 * @property string $current_user
 * @property string $unique_reference_id
 * @property string $billed_by
 * @property string $domain_url
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 */
class Customers extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'customers';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('legal_type_id, status', 'numerical', 'integerOnly'=>true),
			array('name, incorporation_number, ntn_number, strn_number, email, password, allowed_user, current_user, billed_by, domain_url', 'length', 'max'=>255),
			array('country_id, created_at, updated_at', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, country_id, name, legal_type_id, incorporation_number, ntn_number, strn_number, email, password, allowed_user, current_user, unique_reference_id, billed_by, domain_url, status, created_at, updated_at', 'safe', 'on'=>'search'),
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
			'country' => array(self::BELONGS_TO, 'Countries', 'country_id'),
			'devices' => array(self::HAS_MANY, 'CustomerDevices', 'customer_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'country_id' => 'Country',
			'name' => 'Name',
			'legal_type_id' => 'Legal Type',
			'incorporation_number' => 'Incorporation Number',
			'ntn_number' => 'Ntn Number',
			'strn_number' => 'Strn Number',
			'email' => 'Email',
			'password' => 'Password',
			'allowed_user' => 'Allowed User',
			'current_user' => 'Current User',
			'unique_reference_id' => 'Unique Reference',
			'billed_by' => 'Billed By',
			'domain_url' => 'Domain Url',
			'status' => 'Status',
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
		$criteria->compare('country_id',$this->country_id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('legal_type_id',$this->legal_type_id);
		$criteria->compare('incorporation_number',$this->incorporation_number,true);
		$criteria->compare('ntn_number',$this->ntn_number,true);
		$criteria->compare('strn_number',$this->strn_number,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('allowed_user',$this->allowed_user,true);
		$criteria->compare('current_user',$this->current_user,true);
		$criteria->compare('unique_reference_id',$this->unique_reference_id,true);
		$criteria->compare('billed_by',$this->billed_by,true);
		$criteria->compare('domain_url',$this->domain_url,true);
		$criteria->compare('status',$this->status);
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
	 * @return Customers the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
