<?php

/**
 * This is the model class for table "newcustomers".
 *
 * The followings are the available columns in table 'newcustomers':
 * @property integer $id
 * @property string $name
 * @property string $father_husband_name
 * @property string $gender
 * @property string $occupation
 * @property string $dob
 * @property string $cnic
 * @property string $address
 * @property string $phone
 * @property string $office
 * @property string $mobile
 * @property string $email
 * @property string $nominee_name
 * @property string $nominee_relation
 * @property string $nominee_cnic
 * @property string $image
 * @property integer $status
 * @property string $createdOn
 */
class Newcustomers extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'newcustomers';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, father_husband_name, gender, occupation, dob, cnic, address, phone, office, mobile, email, nominee_name, nominee_relation, nominee_cnic, image, status, createdOn', 'required'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('name, father_husband_name, gender, occupation, cnic, address, phone, office, mobile, email, nominee_name, nominee_relation, nominee_cnic, image', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, father_husband_name, gender, occupation, dob, cnic, address, phone, office, mobile, email, nominee_name, nominee_relation, nominee_cnic, image, status, createdOn', 'safe', 'on'=>'search'),
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
			'name' => 'Name',
			'father_husband_name' => 'Father Husband Name',
			'gender' => 'Gender',
			'occupation' => 'Occupation',
			'dob' => 'Dob',
			'cnic' => 'Cnic',
			'address' => 'Address',
			'phone' => 'Phone',
			'office' => 'Office',
			'mobile' => 'Mobile',
			'email' => 'Email',
			'nominee_name' => 'Nominee Name',
			'nominee_relation' => 'Nominee Relation',
			'nominee_cnic' => 'Nominee Cnic',
			'image' => 'Image',
			'status' => 'Status',
			'createdOn' => 'Created On',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('father_husband_name',$this->father_husband_name,true);
		$criteria->compare('gender',$this->gender,true);
		$criteria->compare('occupation',$this->occupation,true);
		$criteria->compare('dob',$this->dob,true);
		$criteria->compare('cnic',$this->cnic,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('office',$this->office,true);
		$criteria->compare('mobile',$this->mobile,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('nominee_name',$this->nominee_name,true);
		$criteria->compare('nominee_relation',$this->nominee_relation,true);
		$criteria->compare('nominee_cnic',$this->nominee_cnic,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('createdOn',$this->createdOn,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Newcustomers the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
