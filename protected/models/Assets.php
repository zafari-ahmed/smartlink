<?php

/**
 * This is the model class for table "assets".
 *
 * The followings are the available columns in table 'assets':
 * @property string $id
 * @property string $asset_code
 * @property string $asset_cat
 * @property string $manufacturer
 * @property string $model
 * @property string $image
 * @property string $tech_description
 * @property integer $yom
 * @property string $serial_no
 * @property string $meter_hours
 * @property string $power_source
 * @property string $device_id
 * @property string $eq_certification
 * @property string $cert_expiry_date
 * @property string $asset_purchase_date
 * @property string $purchase_condition
 * @property string $purchase_cost
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 *
 * The followings are the available model relations:
 * @property TeamResourceAssets[] $teamResourceAssets
 */
class Assets extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'assets';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('asset_code, asset_cat', 'required'),
			array('yom', 'numerical', 'integerOnly'=>true),
			array('asset_code, asset_cat, manufacturer, model, image, tech_description, serial_no, meter_hours, power_source, device_id, eq_certification, purchase_condition, purchase_cost', 'length', 'max'=>255),
			array('cert_expiry_date, asset_purchase_date, created_at, updated_at, deleted_at', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, asset_code, asset_cat, manufacturer, model, image, tech_description, yom, serial_no, meter_hours, power_source, device_id, eq_certification, cert_expiry_date, asset_purchase_date, purchase_condition, purchase_cost, created_at, updated_at, deleted_at', 'safe', 'on'=>'search'),
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
			'teamResourceAssets' => array(self::HAS_MANY, 'TeamResourceAssets', 'asset_id'),
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
			'asset_cat' => 'Asset Cat',
			'manufacturer' => 'Manufacturer',
			'model' => 'Model',
			'image' => 'Image',
			'tech_description' => 'Tech Description',
			'yom' => 'Yom',
			'serial_no' => 'Serial No',
			'meter_hours' => 'Meter Hours',
			'power_source' => 'Power Source',
			'device_id' => 'Device',
			'eq_certification' => 'Eq Certification',
			'cert_expiry_date' => 'Cert Expiry Date',
			'asset_purchase_date' => 'Asset Purchase Date',
			'purchase_condition' => 'Purchase Condition',
			'purchase_cost' => 'Purchase Cost',
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
		$criteria->compare('asset_code',$this->asset_code,true);
		$criteria->compare('asset_cat',$this->asset_cat,true);
		$criteria->compare('manufacturer',$this->manufacturer,true);
		$criteria->compare('model',$this->model,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('tech_description',$this->tech_description,true);
		$criteria->compare('yom',$this->yom);
		$criteria->compare('serial_no',$this->serial_no,true);
		$criteria->compare('meter_hours',$this->meter_hours,true);
		$criteria->compare('power_source',$this->power_source,true);
		$criteria->compare('device_id',$this->device_id,true);
		$criteria->compare('eq_certification',$this->eq_certification,true);
		$criteria->compare('cert_expiry_date',$this->cert_expiry_date,true);
		$criteria->compare('asset_purchase_date',$this->asset_purchase_date,true);
		$criteria->compare('purchase_condition',$this->purchase_condition,true);
		$criteria->compare('purchase_cost',$this->purchase_cost,true);
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
	 * @return Assets the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
