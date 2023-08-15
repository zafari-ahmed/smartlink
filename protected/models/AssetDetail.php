<?php

/**
 * This is the model class for table "asset_detail".
 *
 * The followings are the available columns in table 'asset_detail':
 * @property string $id
 * @property string $asset_code
 * @property string $speed
 * @property string $current
 * @property string $temperature
 * @property string $shock
 * @property string $interval
 * @property string $latitude
 * @property string $longitude
 * @property string $switchAsset
 * @property string $created_at
 * @property string $updated_at
 */
class AssetDetail extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'asset_detail';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('asset_code, speed, current, temperature, shock, interval, latitude, longitude', 'required'),
			array('asset_code, speed, current, temperature, shock, interval, latitude, longitude, switchAsset', 'length', 'max'=>255),
			array('created_at, updated_at', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, asset_code, speed, current, temperature, shock, interval, latitude, longitude, switchAsset, created_at, updated_at', 'safe', 'on'=>'search'),
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
			'speed' => 'Speed',
			'current' => 'Current',
			'temperature' => 'Temperature',
			'shock' => 'Shock',
			'interval' => 'Interval',
			'latitude' => 'Latitude',
			'longitude' => 'Longitude',
			'switchAsset' => 'Switch Asset',
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
		$criteria->compare('speed',$this->speed,true);
		$criteria->compare('current',$this->current,true);
		$criteria->compare('temperature',$this->temperature,true);
		$criteria->compare('shock',$this->shock,true);
		$criteria->compare('interval',$this->interval,true);
		$criteria->compare('latitude',$this->latitude,true);
		$criteria->compare('longitude',$this->longitude,true);
		$criteria->compare('switchAsset',$this->switchAsset,true);
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
	 * @return AssetDetail the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
