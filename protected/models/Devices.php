<?php

/**
 * This is the model class for table "devices".
 *
 * The followings are the available columns in table 'devices':
 * @property string $id
 * @property string $name
 * @property string $customer_id
 * @property string $android_master_mac_address
 * @property string $pcb_controller_bluetooth_name
 * @property string $device_category
 * @property string $synchronised_asset_code
 * @property string $installation_date
 * @property string $date_of_supply
 * @property integer $status
 * @property string $created_at
 */
class Devices extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'devices';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('status', 'numerical', 'integerOnly'=>true),
			array('name, android_master_mac_address, pcb_controller_bluetooth_name, device_category, synchronised_asset_code', 'length', 'max'=>255),
			array('customer_id, installation_date, date_of_supply, created_at', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, customer_id, android_master_mac_address, pcb_controller_bluetooth_name, device_category, synchronised_asset_code, installation_date, date_of_supply, status, created_at', 'safe', 'on'=>'search'),
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
			'name' => 'Name',
			'customer_id' => 'Customer',
			'android_master_mac_address' => 'Android Master Mac Address',
			'pcb_controller_bluetooth_name' => 'Pcb Controller Bluetooth Name',
			'device_category' => 'Device Category',
			'synchronised_asset_code' => 'Synchronised Asset Code',
			'installation_date' => 'Installation Date',
			'date_of_supply' => 'Date Of Supply',
			'status' => 'Status',
			'created_at' => 'Created At',
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
		$criteria->compare('customer_id',$this->customer_id,true);
		$criteria->compare('android_master_mac_address',$this->android_master_mac_address,true);
		$criteria->compare('pcb_controller_bluetooth_name',$this->pcb_controller_bluetooth_name,true);
		$criteria->compare('device_category',$this->device_category,true);
		$criteria->compare('synchronised_asset_code',$this->synchronised_asset_code,true);
		$criteria->compare('installation_date',$this->installation_date,true);
		$criteria->compare('date_of_supply',$this->date_of_supply,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('created_at',$this->created_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Devices the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
