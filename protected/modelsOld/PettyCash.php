<?php

/**
 * This is the model class for table "petty_cash".
 *
 * The followings are the available columns in table 'petty_cash':
 * @property integer $id
 * @property integer $expense_id
 * @property double $amount
 * @property string $description
 * @property string $reference_number
 * @property integer $phase_id
 * @property integer $created_by
 * @property string $createdOn
 *
 * The followings are the available model relations:
 * @property Expenses $expense
 */
class PettyCash extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'petty_cash';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('amount, description, created_by, createdOn', 'required'),
			array('expense_id, phase_id, created_by', 'numerical', 'integerOnly'=>true),
			array('amount', 'numerical'),
			array('reference_number', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, expense_id, amount, description, reference_number, phase_id, created_by, createdOn', 'safe', 'on'=>'search'),
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
			'expense' => array(self::BELONGS_TO, 'Expenses', 'expense_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'expense_id' => 'Expense',
			'amount' => 'Amount',
			'description' => 'Description',
			'reference_number' => 'Reference Number',
			'phase_id' => 'Phase',
			'created_by' => 'Created By',
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
		$criteria->compare('expense_id',$this->expense_id);
		$criteria->compare('amount',$this->amount);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('reference_number',$this->reference_number,true);
		$criteria->compare('phase_id',$this->phase_id);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('createdOn',$this->createdOn,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PettyCash the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
