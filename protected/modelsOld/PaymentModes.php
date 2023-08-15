<?php

/**
 * This is the model class for table "payment_modes".
 *
 * The followings are the available columns in table 'payment_modes':
 * @property integer $id
 * @property string $mode
 * @property string $amount
 * @property string $discount
 * @property integer $amount_type
 * @property integer $plot_size_id
 * @property integer $is_distribute
 *
 * The followings are the available model relations:
 * @property CustomerPlotTransactions[] $customerPlotTransactions
 * @property PlotSizes $plotSize
 */
class PaymentModes extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'payment_modes';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('mode, amount, discount, amount_type, is_distribute', 'required'),
			array('amount_type, plot_size_id, is_distribute', 'numerical', 'integerOnly'=>true),
			array('mode, amount, discount', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, mode, amount, discount, amount_type, plot_size_id, is_distribute', 'safe', 'on'=>'search'),
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
			'customerPlotTransactions' => array(self::HAS_MANY, 'CustomerPlotTransactions', 'plot_payment_mode_id'),
			'plotSize' => array(self::BELONGS_TO, 'PlotSizes', 'plot_size_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'mode' => 'Mode',
			'amount' => 'Amount',
			'discount' => 'Discount',
			'amount_type' => 'Amount Type',
			'plot_size_id' => 'Plot Size',
			'is_distribute' => 'Is Distribute',
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
		$criteria->compare('mode',$this->mode,true);
		$criteria->compare('amount',$this->amount,true);
		$criteria->compare('discount',$this->discount,true);
		$criteria->compare('amount_type',$this->amount_type);
		$criteria->compare('plot_size_id',$this->plot_size_id);
		$criteria->compare('is_distribute',$this->is_distribute);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PaymentModes the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
