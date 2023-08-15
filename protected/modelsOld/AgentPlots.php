<?php

/**
 * This is the model class for table "agent_plots".
 *
 * The followings are the available columns in table 'agent_plots':
 * @property integer $id
 * @property integer $agent_id
 * @property integer $plot_id
 * @property integer $payment_schedule_id
 * @property string $discount
 * @property string $commission
 * @property string $createdOn
 */
class AgentPlots extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'agent_plots';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('commission', 'required'),
			array('agent_id, plot_id', 'numerical', 'integerOnly'=>true),
			array('discount, commission', 'length', 'max'=>255),
			array('createdOn', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, agent_id, plot_id, payment_schedule_id, discount, commission, createdOn', 'safe', 'on'=>'search'),
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
			'plot' => array(self::BELONGS_TO, 'Plots', 'plot_id'),
			'agent' => array(self::BELONGS_TO, 'Agents', 'agent_id'),
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
			'agent_id' => 'Agent',
			'plot_id' => 'Plot',
			'payment_schedule_id' => 'Payment Schedule',
			'discount' => 'Discount',
			'commission' => 'Commission',
			'createdOn' => 'Created On',
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
		$criteria->compare('agent_id',$this->agent_id);
		$criteria->compare('plot_id',$this->plot_id);
		$criteria->compare('payment_schedule_id',$this->payment_schedule_id);
		$criteria->compare('discount',$this->discount,true);
		$criteria->compare('commission',$this->commission,true);
		$criteria->compare('createdOn',$this->createdOn,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AgentPlots the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
