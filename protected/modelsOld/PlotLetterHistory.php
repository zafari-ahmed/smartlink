<?php

/**
 * This is the model class for table "plot_letter_history".
 *
 * The followings are the available columns in table 'plot_letter_history':
 * @property integer $id
 * @property integer $customer_plot_id
 * @property string $letter_type
 * @property string $letter_voucher_number
 * @property string $createdOn
 *
 * The followings are the available model relations:
 * @property CustomerPlots $customerPlot
 */
class PlotLetterHistory extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'plot_letter_history';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('customer_plot_id', 'numerical', 'integerOnly'=>true),
			array('letter_type, letter_voucher_number', 'length', 'max'=>255),
			array('createdOn', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, customer_plot_id, letter_type, letter_voucher_number, createdOn', 'safe', 'on'=>'search'),
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
			'customerPlot' => array(self::BELONGS_TO, 'CustomerPlots', 'customer_plot_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'customer_plot_id' => 'Customer Plot',
			'letter_type' => 'Letter Type',
			'letter_voucher_number' => 'Letter Voucher Number',
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
		$criteria->compare('customer_plot_id',$this->customer_plot_id);
		$criteria->compare('letter_type',$this->letter_type,true);
		$criteria->compare('letter_voucher_number',$this->letter_voucher_number,true);
		$criteria->compare('createdOn',$this->createdOn,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PlotLetterHistory the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
