<?php

/**
 * This is the model class for table "service_reports".
 *
 * The followings are the available columns in table 'service_reports':
 * @property integer $id
 * @property string $service_date
 * @property integer $asset_id
 * @property string $pending_service_job_number
 * @property string $machine_meter_hours_when_serviced
 * @property string $machine_in_operatable_conditon
 * @property string $lead_technician
 * @property string $assistant_technician
 * @property string $equipment_running_hours
 * @property string $was_the_machine_in_alive
 * @property string $was_type_of_service_was_done
 * @property string $technical_observation
 * @property string $created_at
 * @property string $updated_at
 */
class ServiceReports extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'service_reports';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('asset_id', 'numerical', 'integerOnly'=>true),
			array('pending_service_job_number, machine_meter_hours_when_serviced, machine_in_operatable_conditon, lead_technician, assistant_technician, equipment_running_hours, was_the_machine_in_alive, was_type_of_service_was_done, technical_observation', 'length', 'max'=>255),
			array('service_date, created_at, updated_at', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, service_date, asset_id, pending_service_job_number, machine_meter_hours_when_serviced, machine_in_operatable_conditon, lead_technician, assistant_technician, equipment_running_hours, was_the_machine_in_alive, was_type_of_service_was_done, technical_observation, created_at, updated_at', 'safe', 'on'=>'search'),
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
			'service_date' => 'Service Date',
			'asset_id' => 'Asset',
			'pending_service_job_number' => 'Pending Service Job Number',
			'machine_meter_hours_when_serviced' => 'Machine Meter Hours When Serviced',
			'machine_in_operatable_conditon' => 'Machine In Operatable Conditon',
			'lead_technician' => 'Lead Technician',
			'assistant_technician' => 'Assistant Technician',
			'equipment_running_hours' => 'Equipment Running Hours',
			'was_the_machine_in_alive' => 'Was The Machine In Alive',
			'was_type_of_service_was_done' => 'Was Type Of Service Was Done',
			'technical_observation' => 'Technical Observation',
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
		$criteria->compare('service_date',$this->service_date,true);
		$criteria->compare('asset_id',$this->asset_id);
		$criteria->compare('pending_service_job_number',$this->pending_service_job_number,true);
		$criteria->compare('machine_meter_hours_when_serviced',$this->machine_meter_hours_when_serviced,true);
		$criteria->compare('machine_in_operatable_conditon',$this->machine_in_operatable_conditon,true);
		$criteria->compare('lead_technician',$this->lead_technician,true);
		$criteria->compare('assistant_technician',$this->assistant_technician,true);
		$criteria->compare('equipment_running_hours',$this->equipment_running_hours,true);
		$criteria->compare('was_the_machine_in_alive',$this->was_the_machine_in_alive,true);
		$criteria->compare('was_type_of_service_was_done',$this->was_type_of_service_was_done,true);
		$criteria->compare('technical_observation',$this->technical_observation,true);
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
	 * @return ServiceReports the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
