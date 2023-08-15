<?php

/**
 * This is the model class for table "customer_plots".
 *
 * The followings are the available columns in table 'customer_plots':
 * @property integer $id
 * @property integer $customer_id
 * @property integer $plot_id
 * @property string $createdOn
 * @property integer $status
 * @property string $updatedBy
 * @property integer $is_agent
 * @property string $agent_name
 * @property string $agent_cnic
 * @property integer $agent_percentage
 * @property integer $agent_id
 * @property integer $is_special
 * @property integer $blocked
 * @property integer $user_id
 * @property integer $monthlyMonths
 * @property integer $monthlyYearlies
 * @property integer $charge_id
 * @property string $total_penalty
 * @property integer $phase_id
 * @property integer $flag_status
 * @property string $reason
 * @property string $monthly_start_date
 */
class CustomerPlots extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'customer_plots';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('customer_id, plot_id, createdOn, status, updatedBy, is_agent, agent_name, agent_cnic, agent_percentage, is_special, blocked, charge_id', 'required'),
			array('customer_id, plot_id, status, is_agent, agent_percentage, agent_id, is_special, blocked, user_id, monthlyMonths, monthlyYearlies, charge_id, phase_id, flag_status', 'numerical', 'integerOnly'=>true),
			array('updatedBy, agent_name, agent_cnic, total_penalty, reason', 'length', 'max'=>255),
			array('monthly_start_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, customer_id, plot_id, createdOn, status, updatedBy, is_agent, agent_name, agent_cnic, agent_percentage, agent_id, is_special, blocked, user_id, monthlyMonths, monthlyYearlies, charge_id, total_penalty, phase_id, flag_status, reason, monthly_start_date', 'safe', 'on'=>'search'),
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
			'customerPlotTransactionslast' => array(self::HAS_MANY, 'CustomerPlotTransactions', 'plot_id', 'order'=>'id DESC','limit'=>1),
			'customerPlotTransactionsMonthly' => array(self::STAT, 'CustomerPlotTransactions', 'plot_id', 'select'=>'COUNT(*)','condition'=>'plot_payment_mode_id = 34'),
			'customerPlotTransactions' => array(self::HAS_MANY, 'CustomerPlotTransactions', 'plot_id', 'order'=>'createdOn ASC'),
			'customerPlotPlanTransactions' => array(self::HAS_MANY, 'CustomerPlotExtraTransactions', 'plot_id', 'order'=>'createdOn ASC'),
			

			'customerPlotPlanTransactionsDevlopment' => array(self::HAS_MANY, 'CustomerPlotExtraTransactions', 'plot_id','condition'=>'plot_payment_mode= "development" ', 'order'=>'createdOn ASC'),
			'customerPlotPlanTransactionsDevlopmentSum' => array(self::STAT, 'CustomerPlotExtraTransactions', 'plot_id','select'=>'SUM(amount)','condition'=>'plot_payment_mode= "development" ', 'order'=>'createdOn ASC'),

			'customerPlotPlanTransactionsPenalty' => array(self::HAS_MANY, 'CustomerPlotExtraTransactions', 'plot_id','condition'=>'plot_payment_mode = "penalty"', 'order'=>'createdOn ASC'),
			'customerPlotPlanTransactionsPenaltySum' => array(self::STAT, 'CustomerPlotExtraTransactions', 'plot_id','select'=>'SUM(amount)','condition'=>'plot_payment_mode = "penalty"', 'order'=>'createdOn ASC'),

			'customerPlotPlanTransactionsOthers' => array(self::HAS_MANY, 'CustomerPlotExtraTransactions', 'plot_id','condition'=>'plot_payment_mode = "others"', 'order'=>'createdOn ASC'),
			'customerPlotPlanTransactionsOthersSum' => array(self::STAT, 'CustomerPlotExtraTransactions', 'plot_id','select'=>'SUM(amount)','condition'=>'plot_payment_mode = "others"', 'order'=>'createdOn ASC'),

			'customerPlotPlanTransactionsTransfersSum' => array(self::STAT, 'CustomerPlotExtraTransactions', 'plot_id','select'=>'SUM(amount)','condition'=>'plot_payment_mode = "transfer_fee"', 'order'=>'createdOn ASC'),

			'customerPlotPlanTransactionsAll' => array(self::HAS_MANY, 'CustomerPlotExtraTransactions', 'plot_id', 'order'=>'createdOn ASC'),

			'customerPlotPlanTransactionslast' => array(self::HAS_MANY, 'CustomerPlotExtraTransactions', 'plot_id', 'order'=>'id DESC','limit'=>1),
			'customerPlotTransactionsToday' => array(self::HAS_MANY, 'CustomerPlotTransactions', 'plot_id', 'condition'=>"createdOn LIKE '%".(date('Y-m-d'))."%'",'order'=>'createdOn ASC'),
			'customerPlotTransactionsTotal' => array(self::HAS_MANY, 'CustomerPlotTransactions', 'plot_id', 'condition'=>'plot_payment_mode_id = 37'),
			'customerPlotTransactionSum' => array(self::STAT, 'CustomerPlotTransactions', 'plot_id', 'select'=>'SUM(amount)','condition'=>'status = 1'),
			'customerPlotTransactionSumTransfer' => array(self::STAT, 'CustomerPlotTransactions', 'plot_id', 'select'=>'SUM(amount)','condition'=>'status = 0'),
			'customerPlotExtraTransaction' => array(self::HAS_MANY, 'CustomerPlotExtraTransactions', 'plot_id'),
			'customerPlotExtraTransactionSum' => array(self::STAT, 'CustomerPlotExtraTransactions', 'plot_id', 'select'=>'SUM(amount)'),
			'customerPlotTransactionSumWithout3' => array(self::STAT, 'CustomerPlotTransactions', 'plot_id', 'select'=>'SUM(amount)','condition'=>'plot_payment_mode_id != 31 AND plot_payment_mode_id != 32 AND plot_payment_mode_id != 33'),
			'reminderLetters' => array(self::HAS_MANY, 'ReminderLetters', 'booking_id'),
			'reminderLettersCount' => array(self::STAT, 'ReminderLetters', 'booking_id'),
			'customer' => array(self::BELONGS_TO, 'Customers', 'customer_id'),
			'plot' => array(self::BELONGS_TO, 'Plots', 'plot_id'),
			'agent' => array(self::BELONGS_TO, 'Agents', 'agent_id'),
			
			'special' => array(self::BELONGS_TO, 'PaymentSchedules', 'is_special'),
			'paymentSchedule' => array(self::BELONGS_TO, 'PaymentSchedules', 'is_special'),
			
			'customerpaymentSchedule' => array(self::HAS_MANY, 'CustomPaymentSchedulePaymentModes', 'booking_id'),
			'customerSpecialpaymentSchedule' => array(self::HAS_MANY, 'CustomPaymentSchedulePaymentModes', 'booking_id'),
			
			'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
			'charge' => array(self::BELONGS_TO, 'DevelopmentCharges', 'charge_id'),
			'customerPlotCancelled' => array(self::HAS_MANY, 'CustomerPlotCancelled', 'booking_id'),
			'customerPlotDocuments' => array(self::HAS_MANY, 'CustomerPlotDocuments', 'customer_plot_id'),
			'CPDCount' => array(self::STAT, 'CustomerPlotDocuments', 'customer_plot_id'),

			'agent_commision' => array(self::HAS_MANY, 'Expenses', 'booking_id'),
			'agent_commision_sum' => array(self::STAT, 'Expenses', 'booking_id','select'=>'SUM(amount)'),

			'warningLetters' => array(self::HAS_MANY, 'CustomerPlotsWarningLetters', 'booking_id'),

			
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
			'createdOn' => 'Created On',
			'status' => 'Status',
			'updatedBy' => 'Updated By',
			'is_agent' => 'Is Agent',
			'agent_name' => 'Agent Name',
			'agent_cnic' => 'Agent Cnic',
			'agent_percentage' => 'Agent Percentage',
			'agent_id' => 'Agent',
			'is_special' => 'Is Special',
			'blocked' => 'Blocked',
			'user_id' => 'User',
			'monthlyMonths' => 'Monthly Months',
			'monthlyYearlies' => 'Monthly Yearlies',
			'charge_id' => 'Charge',
			'total_penalty' => 'Total Penalty',
			'phase_id' => 'Phase',
			'flag_status' => 'Flag Status',
			'reason' => 'Reason',
			'monthly_start_date' => 'Monthly Start Date',
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
		$criteria->compare('createdOn',$this->createdOn,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('updatedBy',$this->updatedBy,true);
		$criteria->compare('is_agent',$this->is_agent);
		$criteria->compare('agent_name',$this->agent_name,true);
		$criteria->compare('agent_cnic',$this->agent_cnic,true);
		$criteria->compare('agent_percentage',$this->agent_percentage);
		$criteria->compare('agent_id',$this->agent_id);
		$criteria->compare('is_special',$this->is_special);
		$criteria->compare('blocked',$this->blocked);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('monthlyMonths',$this->monthlyMonths);
		$criteria->compare('monthlyYearlies',$this->monthlyYearlies);
		$criteria->compare('charge_id',$this->charge_id);
		$criteria->compare('total_penalty',$this->total_penalty,true);
		$criteria->compare('phase_id',$this->phase_id);
		$criteria->compare('flag_status',$this->flag_status);
		$criteria->compare('reason',$this->reason,true);
		$criteria->compare('monthly_start_date',$this->monthly_start_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CustomerPlots the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
