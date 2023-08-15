<?php

/**
 * This is the model class for table "job_completion_reports".
 *
 * The followings are the available columns in table 'job_completion_reports':
 * @property integer $id
 * @property integer $complaint_job_number
 * @property string $job_completion_on_report_number
 * @property string $job_completion_on_attempt_date
 * @property integer $machine_meter_hours
 * @property integer $machine_in_operatable_condition
 * @property string $actions_taken_to_eliminate_the_concern_of_customer
 * @property string $all_parts_replaced_as_per_last_inspection
 * @property integer $spare_parts_receiving_date
 * @property integer $problem_resolved_after_taking_actions
 * @property integer $lead_technician
 * @property integer $assistant_technician
 * @property string $created_at
 * @property string $updated_at
 */
class JobCompletionReports extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'job_completion_reports';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('complaint_job_number, machine_meter_hours, machine_in_operatable_condition, spare_parts_receiving_date, problem_resolved_after_taking_actions, lead_technician, assistant_technician', 'numerical', 'integerOnly'=>true),
			array('job_completion_on_report_number', 'length', 'max'=>255),
			array('job_completion_on_attempt_date, actions_taken_to_eliminate_the_concern_of_customer, all_parts_replaced_as_per_last_inspection, created_at, updated_at', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, complaint_job_number, job_completion_on_report_number, job_completion_on_attempt_date, machine_meter_hours, machine_in_operatable_condition, actions_taken_to_eliminate_the_concern_of_customer, all_parts_replaced_as_per_last_inspection, spare_parts_receiving_date, problem_resolved_after_taking_actions, lead_technician, assistant_technician, created_at, updated_at', 'safe', 'on'=>'search'),
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
			'complaint_job_number' => 'Complaint Job Number',
			'job_completion_on_report_number' => 'Job Completion On Report Number',
			'job_completion_on_attempt_date' => 'Job Completion On Attempt Date',
			'machine_meter_hours' => 'Machine Meter Hours',
			'machine_in_operatable_condition' => 'Machine In Operatable Condition',
			'actions_taken_to_eliminate_the_concern_of_customer' => 'Actions Taken To Eliminate The Concern Of Customer',
			'all_parts_replaced_as_per_last_inspection' => 'All Parts Replaced As Per Last Inspection',
			'spare_parts_receiving_date' => 'Spare Parts Receiving Date',
			'problem_resolved_after_taking_actions' => 'Problem Resolved After Taking Actions',
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
		$criteria->compare('complaint_job_number',$this->complaint_job_number);
		$criteria->compare('job_completion_on_report_number',$this->job_completion_on_report_number,true);
		$criteria->compare('job_completion_on_attempt_date',$this->job_completion_on_attempt_date,true);
		$criteria->compare('machine_meter_hours',$this->machine_meter_hours);
		$criteria->compare('machine_in_operatable_condition',$this->machine_in_operatable_condition);
		$criteria->compare('actions_taken_to_eliminate_the_concern_of_customer',$this->actions_taken_to_eliminate_the_concern_of_customer,true);
		$criteria->compare('all_parts_replaced_as_per_last_inspection',$this->all_parts_replaced_as_per_last_inspection,true);
		$criteria->compare('spare_parts_receiving_date',$this->spare_parts_receiving_date);
		$criteria->compare('problem_resolved_after_taking_actions',$this->problem_resolved_after_taking_actions);
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
	 * @return JobCompletionReports the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
