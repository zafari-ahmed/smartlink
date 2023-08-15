<?php

/**
 * This is the model class for table "inventories".
 *
 * The followings are the available columns in table 'inventories':
 * @property string $id
 * @property integer $inventory_number
 * @property string $description
 * @property string $shelf_life
 * @property string $cost_per_unit
 * @property string $assets
 * @property string $frequency_type
 * @property integer $replacement_interval
 * @property integer $delivery_time
 * @property integer $purchased_from
 * @property integer $quantity
 * @property string $purchase_date
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 */
class Inventories extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'inventories';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('inventory_number, replacement_interval, delivery_time, purchased_from, quantity', 'numerical', 'integerOnly'=>true),
			array('shelf_life, cost_per_unit', 'length', 'max'=>10),
			array('frequency_type', 'length', 'max'=>13),
			array('description, assets, purchase_date, created_at, updated_at, deleted_at', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, inventory_number, description, shelf_life, cost_per_unit, assets, frequency_type, replacement_interval, delivery_time, purchased_from, quantity, purchase_date, created_at, updated_at, deleted_at', 'safe', 'on'=>'search'),
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
			'inventory_number' => 'Inventory Number',
			'description' => 'Description',
			'shelf_life' => 'Shelf Life',
			'cost_per_unit' => 'Cost Per Unit',
			'assets' => 'Assets',
			'frequency_type' => 'Frequency Type',
			'replacement_interval' => 'Replacement Interval',
			'delivery_time' => 'Delivery Time',
			'purchased_from' => 'Purchased From',
			'quantity' => 'Quantity',
			'purchase_date' => 'Purchase Date',
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
		$criteria->compare('inventory_number',$this->inventory_number);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('shelf_life',$this->shelf_life,true);
		$criteria->compare('cost_per_unit',$this->cost_per_unit,true);
		$criteria->compare('assets',$this->assets,true);
		$criteria->compare('frequency_type',$this->frequency_type,true);
		$criteria->compare('replacement_interval',$this->replacement_interval);
		$criteria->compare('delivery_time',$this->delivery_time);
		$criteria->compare('purchased_from',$this->purchased_from);
		$criteria->compare('quantity',$this->quantity);
		$criteria->compare('purchase_date',$this->purchase_date,true);
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
	 * @return Inventories the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
