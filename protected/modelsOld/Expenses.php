<?php

/**
 * This is the model class for table "expenses".
 *
 * The followings are the available columns in table 'expenses':
 * @property integer $id
 * @property string $expense_type
 * @property integer $account_id
 * @property string $description
 * @property double $amount
 * @property integer $user_id
 * @property integer $status
 * @property string $reason
 * @property string $number
 * @property string $createdOn
 * @property integer $phase_id
 * @property integer $booking_id
 * @property string $payment_mode
 * @property string $paid_to
 * @property string $bank
 * @property string $cnic
 */
class Expenses extends CActiveRecord
{
	public $total_sum;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'expenses';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('expense_type, description, amount, user_id, status, reason, createdOn', 'required'),
			array('account_id, user_id, status, phase_id, booking_id', 'numerical', 'integerOnly'=>true),
			array('amount', 'numerical'),
			array('expense_type, number, payment_mode, paid_to, bank, cnic', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, expense_type, account_id, description, amount, user_id, status, reason, number, createdOn, phase_id, booking_id, payment_mode, paid_to, bank, cnic', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
			'account' => array(self::BELONGS_TO, 'Accounts', 'account_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'expense_type' => 'Expense Type',
			'account_id' => 'Account',
			'description' => 'Description',
			'amount' => 'Amount',
			'user_id' => 'User',
			'status' => 'Status',
			'reason' => 'Reason',
			'number' => 'Number',
			'createdOn' => 'Created On',
			'phase_id' => 'Phase',
			'booking_id' => 'Booking',
			'payment_mode' => 'Payment Mode',
			'paid_to' => 'Paid To',
			'bank' => 'Bank',
			'cnic' => 'Cnic',
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
		$criteria->compare('expense_type',$this->expense_type,true);
		$criteria->compare('account_id',$this->account_id);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('amount',$this->amount);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('status',$this->status);
		$criteria->compare('reason',$this->reason,true);
		$criteria->compare('number',$this->number,true);
		$criteria->compare('createdOn',$this->createdOn,true);
		$criteria->compare('phase_id',$this->phase_id);
		$criteria->compare('booking_id',$this->booking_id);
		$criteria->compare('payment_mode',$this->payment_mode,true);
		$criteria->compare('paid_to',$this->paid_to,true);
		$criteria->compare('bank',$this->bank,true);
		$criteria->compare('cnic',$this->cnic,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Expenses the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
