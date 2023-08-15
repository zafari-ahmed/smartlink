<?php

/**
 * This is the model class for table "customer_plot_transfers".
 *
 * The followings are the available columns in table 'customer_plot_transfers':
 * @property integer $id
 * @property integer $old_customer_id
 * @property integer $new_customer_id
 * @property integer $plot_id
 * @property string $amount
 * @property integer $account_id
 * @property string $createdOn
 * @property integer $status
 * @property string $updatedBy
 *
 * The followings are the available model relations:
 * @property Customers $newCustomer
 */
class CustomerPlotTransfers extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'customer_plot_transfers';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('old_customer_id, new_customer_id, plot_id, amount, account_id, createdOn, status, updatedBy', 'required'),
			array('old_customer_id, new_customer_id, plot_id, account_id, status', 'numerical', 'integerOnly'=>true),
			array('amount, updatedBy', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, old_customer_id, new_customer_id, plot_id, amount, account_id, createdOn, status, updatedBy', 'safe', 'on'=>'search'),
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
			'newCustomer' => array(self::BELONGS_TO, 'Customers', 'new_customer_id'),
			'oldCustomer' => array(self::BELONGS_TO, 'Customers', 'old_customer_id'),
			'booking' => array(self::BELONGS_TO, 'Plots', 'plot_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'old_customer_id' => 'Old Customer',
			'new_customer_id' => 'New Customer',
			'plot_id' => 'Plot',
			'amount' => 'Amount',
			'account_id' => 'Account',
			'createdOn' => 'Created On',
			'status' => 'Status',
			'updatedBy' => 'Updated By',
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
		$criteria->compare('old_customer_id',$this->old_customer_id);
		$criteria->compare('new_customer_id',$this->new_customer_id);
		$criteria->compare('plot_id',$this->plot_id);
		$criteria->compare('amount',$this->amount,true);
		$criteria->compare('account_id',$this->account_id);
		$criteria->compare('createdOn',$this->createdOn,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('updatedBy',$this->updatedBy,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CustomerPlotTransfers the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
