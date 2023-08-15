<?php

/**
 * This is the model class for table "accounts".
 *
 * The followings are the available columns in table 'accounts':
 * @property integer $id
 * @property string $name
 * @property string $account_number
 * @property string $bank
 * @property string $branch
 * @property integer $percentage
 * @property integer $is_distributed
 * @property integer $is_installment
 * @property integer $is_visible
 * @property string $createdOn
 */
class Accounts extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'accounts';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, account_number, bank, branch, percentage, is_distributed, is_installment, is_visible, createdOn', 'required'),
			array('percentage, is_distributed, is_installment, is_visible', 'numerical', 'integerOnly'=>true),
			array('name, account_number, bank, branch', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, account_number, bank, branch, percentage, is_distributed, is_installment, is_visible, createdOn', 'safe', 'on'=>'search'),
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
			'plotAmountDistributors' => array(self::HAS_MANY, 'PlotAmountDistributors', 'account_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'account_number' => 'Account Number',
			'bank' => 'Bank',
			'branch' => 'Branch',
			'percentage' => 'Percentage',
			'is_distributed' => 'Is Distributed',
			'is_installment' => 'Is Installment',
			'is_visible' => 'Is Visible',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('account_number',$this->account_number,true);
		$criteria->compare('bank',$this->bank,true);
		$criteria->compare('branch',$this->branch,true);
		$criteria->compare('percentage',$this->percentage);
		$criteria->compare('is_distributed',$this->is_distributed);
		$criteria->compare('is_installment',$this->is_installment);
		$criteria->compare('is_visible',$this->is_visible);
		$criteria->compare('createdOn',$this->createdOn,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Accounts the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
