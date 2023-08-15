<?php

/**
 * This is the model class for table "user_plot_transactions".
 *
 * The followings are the available columns in table 'user_plot_transactions':
 * @property integer $id
 * @property integer $user_id
 * @property integer $plot_id
 * @property string $transaction_number
 * @property double $amount
 * @property string $transaction_type
 * @property string $comment
 * @property string $createdOn
 * @property string $createdBy
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property Plots $plot
 * @property Users $user
 */
class UserPlotTransactions extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user_plot_transactions';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, plot_id, transaction_number, amount, transaction_type, comment, createdOn, createdBy, status', 'required'),
			array('user_id, plot_id, status', 'numerical', 'integerOnly'=>true),
			array('amount', 'numerical'),
			array('transaction_number, transaction_type, createdBy', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, plot_id, transaction_number, amount, transaction_type, comment, createdOn, createdBy, status', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User',
			'plot_id' => 'Plot',
			'transaction_number' => 'Transaction Number',
			'amount' => 'Amount',
			'transaction_type' => 'Transaction Type',
			'comment' => 'Comment',
			'createdOn' => 'Created On',
			'createdBy' => 'Created By',
			'status' => 'Status',
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('plot_id',$this->plot_id);
		$criteria->compare('transaction_number',$this->transaction_number,true);
		$criteria->compare('amount',$this->amount);
		$criteria->compare('transaction_type',$this->transaction_type,true);
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('createdOn',$this->createdOn,true);
		$criteria->compare('createdBy',$this->createdBy,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UserPlotTransactions the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
