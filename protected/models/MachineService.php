<?php

/**
 * This is the model class for table "machine_service".
 *
 * The followings are the available columns in table 'machine_service':
 * @property integer $service_id
 * @property string $asset_code
 * @property string $service_date
 * @property string $equipment_meter_reading
 * @property string $checklist
 * @property string $special_note
 */
class MachineService extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'machine_service';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('service_id, asset_code, service_date, equipment_meter_reading, checklist, special_note', 'required'),
			array('service_id', 'numerical', 'integerOnly'=>true),
			array('asset_code, service_date, equipment_meter_reading, checklist', 'length', 'max'=>32),
			array('special_note', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('service_id, asset_code, service_date, equipment_meter_reading, checklist, special_note', 'safe', 'on'=>'search'),
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
			'service_id' => 'Service',
			'asset_code' => 'Asset Code',
			'service_date' => 'Service Date',
			'equipment_meter_reading' => 'Equipment Meter Reading',
			'checklist' => 'Checklist',
			'special_note' => 'Special Note',
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

		$criteria->compare('service_id',$this->service_id);
		$criteria->compare('asset_code',$this->asset_code,true);
		$criteria->compare('service_date',$this->service_date,true);
		$criteria->compare('equipment_meter_reading',$this->equipment_meter_reading,true);
		$criteria->compare('checklist',$this->checklist,true);
		$criteria->compare('special_note',$this->special_note,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MachineService the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
