<?php

/**
 * This is the model class for table "booking_penalty_transactions".
 *
 * The followings are the available columns in table 'booking_penalty_transactions':
 * @property integer $id
 * @property integer $booking_id
 * @property string $payment_mode
 * @property string $transaction_number
 * @property string $transaction_type
 * @property string $amount
 * @property string $date
 * @property string $createdBy
 * @property string $monthlyDate
 */
class BookingPenaltyTransactions extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'booking_penalty_transactions';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('booking_id, payment_mode, transaction_number, transaction_type, amount, date, createdBy, monthlyDate', 'required'),
			array('booking_id', 'numerical', 'integerOnly'=>true),
			array('payment_mode, transaction_number, transaction_type, amount, createdBy', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, booking_id, payment_mode, transaction_number, transaction_type, amount, date, createdBy, monthlyDate', 'safe', 'on'=>'search'),
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
			'booking_id' => 'Booking',
			'payment_mode' => 'Payment Mode',
			'transaction_number' => 'Transaction Number',
			'transaction_type' => 'Transaction Type',
			'amount' => 'Amount',
			'date' => 'Date',
			'createdBy' => 'Created By',
			'monthlyDate' => 'Monthly Date',
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
		$criteria->compare('booking_id',$this->booking_id);
		$criteria->compare('payment_mode',$this->payment_mode,true);
		$criteria->compare('transaction_number',$this->transaction_number,true);
		$criteria->compare('transaction_type',$this->transaction_type,true);
		$criteria->compare('amount',$this->amount,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('createdBy',$this->createdBy,true);
		$criteria->compare('monthlyDate',$this->monthlyDate,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BookingPenaltyTransactions the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
