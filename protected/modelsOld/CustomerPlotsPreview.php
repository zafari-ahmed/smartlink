<?php

/**
 * This is the model class for table "customer_plots_preview".
 *
 * The followings are the available columns in table 'customer_plots_preview':
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
 * @property integer $charge_id
 * @property string $total_penalty
 * @property integer $phase_id
 *
 * The followings are the available model relations:
 * @property Plots $plot
 * @property ReminderLetters[] $reminderLetters
 */
class CustomerPlotsPreview extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'customer_plots_preview';
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
			array('customer_id, plot_id, status, is_agent, agent_percentage, agent_id, is_special, blocked, user_id, monthlyMonths, charge_id, phase_id', 'numerical', 'integerOnly'=>true),
			array('updatedBy, agent_name, agent_cnic, total_penalty', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, customer_id, plot_id, createdOn, status, updatedBy, is_agent, agent_name, agent_cnic, agent_percentage, agent_id, is_special, blocked, user_id, monthlyMonths, charge_id, total_penalty, phase_id', 'safe', 'on'=>'search'),
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
			'customer' => array(self::BELONGS_TO, 'CustomerPreviews', 'customer_id'),
			'plot' => array(self::BELONGS_TO, 'Plots', 'plot_id'),
			'reminderLetters' => array(self::HAS_MANY, 'ReminderLetters', 'booking_id'),
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
			'charge_id' => 'Charge',
			'total_penalty' => 'Total Penalty',
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
		$criteria->compare('charge_id',$this->charge_id);
		$criteria->compare('total_penalty',$this->total_penalty,true);
		$criteria->compare('phase_id',$this->phase_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CustomerPlotsPreview the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
