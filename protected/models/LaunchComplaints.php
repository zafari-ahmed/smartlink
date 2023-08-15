<?php

/**
 * This is the model class for table "launch_complaints".
 *
 * The followings are the available columns in table 'launch_complaints':
 * @property integer $id
 * @property integer $asset_id
 * @property string $complaint_job_number
 * @property integer $reportinng_user_reference_code
 * @property string $complain_date
 * @property string $complain_type
 * @property integer $meter_hours_when_complain_launched
 * @property string $complain_description
 * @property string $created_at
 * @property string $updated_at
 */
class LaunchComplaints extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'launch_complaints';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('asset_id, reportinng_user_reference_code, meter_hours_when_complain_launched', 'numerical', 'integerOnly'=>true),
			array('complaint_job_number, complain_type', 'length', 'max'=>255),
			array('complain_date, complain_description, created_at, updated_at', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, asset_id, complaint_job_number, reportinng_user_reference_code, complain_date, complain_type, meter_hours_when_complain_launched, complain_description, created_at, updated_at', 'safe', 'on'=>'search'),
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
			'asset_id' => 'Asset',
			'complaint_job_number' => 'Complaint Job Number',
			'reportinng_user_reference_code' => 'Reportinng User Reference Code',
			'complain_date' => 'Complain Date',
			'complain_type' => 'Complain Type',
			'meter_hours_when_complain_launched' => 'Meter Hours When Complain Launched',
			'complain_description' => 'Complain Description',
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
		$criteria->compare('asset_id',$this->asset_id);
		$criteria->compare('complaint_job_number',$this->complaint_job_number,true);
		$criteria->compare('reportinng_user_reference_code',$this->reportinng_user_reference_code);
		$criteria->compare('complain_date',$this->complain_date,true);
		$criteria->compare('complain_type',$this->complain_type,true);
		$criteria->compare('meter_hours_when_complain_launched',$this->meter_hours_when_complain_launched);
		$criteria->compare('complain_description',$this->complain_description,true);
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
	 * @return LaunchComplaints the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
