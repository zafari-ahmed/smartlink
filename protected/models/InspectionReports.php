<?php

/**
 * This is the model class for table "inspection_reports".
 *
 * The followings are the available columns in table 'inspection_reports':
 * @property integer $id
 * @property integer $launch_complaint_id
 * @property string $inspection_report_number
 * @property string $inspection_date
 * @property integer $machine_meter_hours
 * @property integer $machine_in_operatable_condition
 * @property integer $error_codes
 * @property string $technical_diagnosis
 * @property string $actions_required_to_eliminate_the_concern_of_customer
 * @property integer $spare_parts_to_be_replaced
 * @property integer $was_the_issue_resolved_temporarily
 * @property integer $lead_technician
 * @property integer $assistant_technician
 * @property string $created_at
 * @property string $updated_at
 */
class InspectionReports extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'inspection_reports';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('launch_complaint_id, machine_meter_hours, machine_in_operatable_condition, error_codes, spare_parts_to_be_replaced, was_the_issue_resolved_temporarily, lead_technician, assistant_technician', 'numerical', 'integerOnly'=>true),
			array('inspection_report_number', 'length', 'max'=>255),
			array('inspection_date, technical_diagnosis, actions_required_to_eliminate_the_concern_of_customer, created_at, updated_at', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, launch_complaint_id, inspection_report_number, inspection_date, machine_meter_hours, machine_in_operatable_condition, error_codes, technical_diagnosis, actions_required_to_eliminate_the_concern_of_customer, spare_parts_to_be_replaced, was_the_issue_resolved_temporarily, lead_technician, assistant_technician, created_at, updated_at', 'safe', 'on'=>'search'),
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
			'launch_complaint_id' => 'Launch Complaint',
			'inspection_report_number' => 'Inspection Report Number',
			'inspection_date' => 'Inspection Date',
			'machine_meter_hours' => 'Machine Meter Hours',
			'machine_in_operatable_condition' => 'Machine In Operatable Condition',
			'error_codes' => 'Error Codes',
			'technical_diagnosis' => 'Technical Diagnosis',
			'actions_required_to_eliminate_the_concern_of_customer' => 'Actions Required To Eliminate The Concern Of Customer',
			'spare_parts_to_be_replaced' => 'Spare Parts To Be Replaced',
			'was_the_issue_resolved_temporarily' => 'Was The Issue Resolved Temporarily',
			'lead_technician' => 'Lead Technician',
			'assistant_technician' => 'Assistant Technician',
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
		$criteria->compare('launch_complaint_id',$this->launch_complaint_id);
		$criteria->compare('inspection_report_number',$this->inspection_report_number,true);
		$criteria->compare('inspection_date',$this->inspection_date,true);
		$criteria->compare('machine_meter_hours',$this->machine_meter_hours);
		$criteria->compare('machine_in_operatable_condition',$this->machine_in_operatable_condition);
		$criteria->compare('error_codes',$this->error_codes);
		$criteria->compare('technical_diagnosis',$this->technical_diagnosis,true);
		$criteria->compare('actions_required_to_eliminate_the_concern_of_customer',$this->actions_required_to_eliminate_the_concern_of_customer,true);
		$criteria->compare('spare_parts_to_be_replaced',$this->spare_parts_to_be_replaced);
		$criteria->compare('was_the_issue_resolved_temporarily',$this->was_the_issue_resolved_temporarily);
		$criteria->compare('lead_technician',$this->lead_technician);
		$criteria->compare('assistant_technician',$this->assistant_technician);
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
	 * @return InspectionReports the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
