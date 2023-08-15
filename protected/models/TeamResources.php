<?php

/**
 * This is the model class for table "team_resources".
 *
 * The followings are the available columns in table 'team_resources':
 * @property string $id
 * @property string $name
 * @property string $employee_code
 * @property string $date_of_joining
 * @property string $cnic
 * @property string $contact_number
 * @property string $email
 * @property string $medical_condition
 * @property string $blood_group
 * @property string $emergency_contact_number
 * @property string $emergency_email
 * @property string $company_id
 * @property string $image
 * @property string $rfid
 * @property string $training_date
 * @property string $training_certificate
 * @property string $training_date_expiry
 * @property string $qualification
 * @property string $team_category_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 *
 * The followings are the available model relations:
 * @property FaultyAssets[] $faultyAssets
 * @property HseViolationRecorded[] $hseViolationRecordeds
 * @property HseViolations[] $hseViolations
 * @property IncidentReports[] $incidentReports
 * @property MessageCenters[] $messageCenters
 * @property TaskCenters[] $taskCenters
 * @property TeamResourceAssets[] $teamResourceAssets
 * @property TeamCategories $teamCategory
 */
class TeamResources extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'team_resources';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, employee_code, cnic, contact_number, email, blood_group, emergency_contact_number, emergency_email, company_id', 'length', 'max'=>255),
			array('date_of_joining, medical_condition, image, rfid, training_date, training_certificate, training_date_expiry, qualification, team_category_id, created_at, updated_at, deleted_at', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, employee_code, date_of_joining, cnic, contact_number, email, medical_condition, blood_group, emergency_contact_number, emergency_email, company_id, image, rfid, training_date, training_certificate, training_date_expiry, qualification, team_category_id, created_at, updated_at, deleted_at', 'safe', 'on'=>'search'),
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
			'faultyAssets' => array(self::HAS_MANY, 'FaultyAssets', 'team_id'),
			'hseViolationRecordeds' => array(self::HAS_MANY, 'HseViolationRecorded', 'team_id'),
			'hseViolations' => array(self::HAS_MANY, 'HseViolations', 'team_id'),
			'incidentReports' => array(self::HAS_MANY, 'IncidentReports', 'team_id'),
			'messageCenters' => array(self::HAS_MANY, 'MessageCenters', 'sent_to'),
			'taskCenters' => array(self::HAS_MANY, 'TaskCenters', 'sent_to'),
			'teamResourceAssets' => array(self::HAS_MANY, 'TeamResourceAssets', 'team_resource_id'),
			'teamCategory' => array(self::BELONGS_TO, 'TeamCategories', 'team_category_id'),
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
			'employee_code' => 'Employee Code',
			'date_of_joining' => 'Date Of Joining',
			'cnic' => 'Cnic',
			'contact_number' => 'Contact Number',
			'email' => 'Email',
			'medical_condition' => 'Medical Condition',
			'blood_group' => 'Blood Group',
			'emergency_contact_number' => 'Emergency Contact Number',
			'emergency_email' => 'Emergency Email',
			'company_id' => 'Company',
			'image' => 'Image',
			'rfid' => 'Rfid',
			'training_date' => 'Training Date',
			'training_certificate' => 'Training Certificate',
			'training_date_expiry' => 'Training Date Expiry',
			'qualification' => 'Qualification',
			'team_category_id' => 'Team Category',
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
		$criteria->compare('employee_code',$this->employee_code,true);
		$criteria->compare('date_of_joining',$this->date_of_joining,true);
		$criteria->compare('cnic',$this->cnic,true);
		$criteria->compare('contact_number',$this->contact_number,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('medical_condition',$this->medical_condition,true);
		$criteria->compare('blood_group',$this->blood_group,true);
		$criteria->compare('emergency_contact_number',$this->emergency_contact_number,true);
		$criteria->compare('emergency_email',$this->emergency_email,true);
		$criteria->compare('company_id',$this->company_id,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('rfid',$this->rfid,true);
		$criteria->compare('training_date',$this->training_date,true);
		$criteria->compare('training_certificate',$this->training_certificate,true);
		$criteria->compare('training_date_expiry',$this->training_date_expiry,true);
		$criteria->compare('qualification',$this->qualification,true);
		$criteria->compare('team_category_id',$this->team_category_id,true);
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
	 * @return TeamResources the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
