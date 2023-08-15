<?php

/**
 * This is the model class for table "maintenances".
 *
 * The followings are the available columns in table 'maintenances':
 * @property string $id
 * @property string $asset_code
 * @property string $last_service_date
 * @property integer $running_hours
 * @property integer $current_hours
 * @property integer $interval
 * @property string $created_at
 * @property string $updated_at
 */
class Maintenances extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'maintenances';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('asset_code, last_service_date, running_hours, current_hours, interval', 'required'),
			array('running_hours, current_hours, interval', 'numerical', 'integerOnly'=>true),
			array('asset_code', 'length', 'max'=>255),
			array('created_at, updated_at', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, asset_code, last_service_date, running_hours, current_hours, interval, created_at, updated_at', 'safe', 'on'=>'search'),
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
			'asset_code' => 'Asset Code',
			'last_service_date' => 'Last Service Date',
			'running_hours' => 'Running Hours',
			'current_hours' => 'Current Hours',
			'interval' => 'Interval',
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
		$criteria->compare('asset_code',$this->asset_code,true);
		$criteria->compare('last_service_date',$this->last_service_date,true);
		$criteria->compare('running_hours',$this->running_hours);
		$criteria->compare('current_hours',$this->current_hours);
		$criteria->compare('interval',$this->interval);
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
	 * @return Maintenances the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
