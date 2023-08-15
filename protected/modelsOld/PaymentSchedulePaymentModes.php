<?php

/**
 * This is the model class for table "payment_schedule_payment_modes".
 *
 * The followings are the available columns in table 'payment_schedule_payment_modes':
 * @property integer $id
 * @property integer $payment_schedule_id
 * @property string $plot_type
 * @property string $mode
 * @property integer $amount
 *
 * The followings are the available model relations:
 * @property PaymentSchedules $paymentSchedule
 */
class PaymentSchedulePaymentModes extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'payment_schedule_payment_modes';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('payment_schedule_id, plot_type, mode, amount', 'required'),
			array('payment_schedule_id, amount', 'numerical', 'integerOnly'=>true),
			array('plot_type, mode', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, payment_schedule_id, plot_type, mode, amount', 'safe', 'on'=>'search'),
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
			'paymentSchedule' => array(self::BELONGS_TO, 'PaymentSchedules', 'payment_schedule_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'payment_schedule_id' => 'Payment Schedule',
			'plot_type' => 'Plot Type',
			'mode' => 'Mode',
			'amount' => 'Amount',
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
		$criteria->compare('payment_schedule_id',$this->payment_schedule_id);
		$criteria->compare('plot_type',$this->plot_type,true);
		$criteria->compare('mode',$this->mode,true);
		$criteria->compare('amount',$this->amount);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PaymentSchedulePaymentModes the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
