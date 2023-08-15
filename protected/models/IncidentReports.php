<?php

/**
 * This is the model class for table "incident_reports".
 *
 * The followings are the available columns in table 'incident_reports':
 * @property string $id
 * @property string $incident_category_id
 * @property string $team_id
 * @property string $asset_id
 * @property string $incident_date
 * @property string $incident_time
 * @property string $any_damages_in_incident
 * @property string $details_of_damages_if_any
 * @property integer $any_physical_injury_occurred_in_incident
 * @property string $physical_injury_intensity_level
 * @property string $response_to_incident
 * @property string $investigation_report_status
 * @property string $created_at
 * @property string $updated_at
 *
 * The followings are the available model relations:
 * @property IncidentCategories $incidentCategory
 * @property TeamResources $team
 */
class IncidentReports extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'incident_reports';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('any_physical_injury_occurred_in_incident', 'numerical', 'integerOnly'=>true),
			array('physical_injury_intensity_level', 'length', 'max'=>6),
			array('investigation_report_status', 'length', 'max'=>9),
			array('incident_category_id, team_id, asset_id, incident_date, incident_time, any_damages_in_incident, details_of_damages_if_any, response_to_incident, created_at, updated_at', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, incident_category_id, team_id, asset_id, incident_date, incident_time, any_damages_in_incident, details_of_damages_if_any, any_physical_injury_occurred_in_incident, physical_injury_intensity_level, response_to_incident, investigation_report_status, created_at, updated_at', 'safe', 'on'=>'search'),
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
			'incidentCategory' => array(self::BELONGS_TO, 'IncidentCategories', 'incident_category_id'),
			'team' => array(self::BELONGS_TO, 'TeamResources', 'team_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'incident_category_id' => 'Incident Category',
			'team_id' => 'Team',
			'asset_id' => 'Asset',
			'incident_date' => 'Incident Date',
			'incident_time' => 'Incident Time',
			'any_damages_in_incident' => 'Any Damages In Incident',
			'details_of_damages_if_any' => 'Details Of Damages If Any',
			'any_physical_injury_occurred_in_incident' => 'Any Physical Injury Occurred In Incident',
			'physical_injury_intensity_level' => 'Physical Injury Intensity Level',
			'response_to_incident' => 'Response To Incident',
			'investigation_report_status' => 'Investigation Report Status',
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
		$criteria->compare('incident_category_id',$this->incident_category_id,true);
		$criteria->compare('team_id',$this->team_id,true);
		$criteria->compare('asset_id',$this->asset_id,true);
		$criteria->compare('incident_date',$this->incident_date,true);
		$criteria->compare('incident_time',$this->incident_time,true);
		$criteria->compare('any_damages_in_incident',$this->any_damages_in_incident,true);
		$criteria->compare('details_of_damages_if_any',$this->details_of_damages_if_any,true);
		$criteria->compare('any_physical_injury_occurred_in_incident',$this->any_physical_injury_occurred_in_incident);
		$criteria->compare('physical_injury_intensity_level',$this->physical_injury_intensity_level,true);
		$criteria->compare('response_to_incident',$this->response_to_incident,true);
		$criteria->compare('investigation_report_status',$this->investigation_report_status,true);
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
	 * @return IncidentReports the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
