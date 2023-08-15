<?php

/**
 * This is the model class for table "customer_plot_transactions".
 *
 * The followings are the available columns in table 'customer_plot_transactions':
 * @property integer $id
 * @property integer $customer_id
 * @property integer $plot_id
 * @property integer $plot_payment_mode_id
 * @property integer $transaction_number
 * @property string $reference_number
 * @property double $amount
 * @property string $transaction_type
 * @property string $bank
 * @property string $branch
 * @property string $comment
 * @property string $reason
 * @property string $createdOn
 * @property string $createdBy
 * @property string $updatedBy
 * @property integer $status
 * @property string $monthlyDate
 * @property integer $phase_id
 */
class CustomerPlotTransactions extends CActiveRecord
{
	public $total;
	public $modes;
	public $p_modes;
	public $sum;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'customer_plot_transactions';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('customer_id, plot_id, plot_payment_mode_id, transaction_number, reference_number, amount, transaction_type, bank, branch, comment, createdOn, createdBy, updatedBy, status', 'required'),
			array('customer_id, plot_id, plot_payment_mode_id, transaction_number, status, phase_id', 'numerical', 'integerOnly'=>true),
			array('amount', 'numerical'),
			array('reference_number, transaction_type, bank, branch, createdBy, updatedBy, monthlyDate', 'length', 'max'=>255),
			array('reason', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, customer_id, plot_id, plot_payment_mode_id, transaction_number, reference_number, amount, transaction_type, bank, branch, comment, reason, createdOn, createdBy, updatedBy, status, monthlyDate, phase_id', 'safe', 'on'=>'search'),
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
			'customer' => array(self::BELONGS_TO, 'Customers', 'customer_id'),
			//'plotPaymentMode' => array(self::BELONGS_TO, 'PaymentModes', 'plot_payment_mode_id'),
			'plotPaymentMode' => array(self::BELONGS_TO, 'PaymentSchedulePaymentModes', 'plot_payment_mode_id'),
			'plot' => array(self::BELONGS_TO, 'CustomerPlots', 'plot_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'customer_id' => 'Customer',
			'plot_id' => 'Plot',
			'plot_payment_mode_id' => 'Plot Payment Mode',
			'transaction_number' => 'Transaction Number',
			'reference_number' => 'Reference Number',
			'amount' => 'Amount',
			'transaction_type' => 'Transaction Type',
			'bank' => 'Bank',
			'branch' => 'Branch',
			'comment' => 'Comment',
			'reason' => 'Reason',
			'createdOn' => 'Created On',
			'createdBy' => 'Created By',
			'updatedBy' => 'Updated By',
			'status' => 'Status',
			'monthlyDate' => 'Monthly Date',
			'phase_id' => 'Phase',
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
		$criteria->compare('customer_id',$this->customer_id);
		$criteria->compare('plot_id',$this->plot_id);
		$criteria->compare('plot_payment_mode_id',$this->plot_payment_mode_id);
		$criteria->compare('transaction_number',$this->transaction_number);
		$criteria->compare('reference_number',$this->reference_number,true);
		$criteria->compare('amount',$this->amount);
		$criteria->compare('transaction_type',$this->transaction_type,true);
		$criteria->compare('bank',$this->bank,true);
		$criteria->compare('branch',$this->branch,true);
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('reason',$this->reason,true);
		$criteria->compare('createdOn',$this->createdOn,true);
		$criteria->compare('createdBy',$this->createdBy,true);
		$criteria->compare('updatedBy',$this->updatedBy,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('monthlyDate',$this->monthlyDate,true);
		$criteria->compare('phase_id',$this->phase_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CustomerPlotTransactions the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
