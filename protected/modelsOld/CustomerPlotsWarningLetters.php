<?php

/**
 * This is the model class for table "customer_plots_warning_letters".
 *
 * The followings are the available columns in table 'customer_plots_warning_letters':
 * @property integer $id
 * @property integer $booking_id
 * @property integer $warning_letter
 * @property string $reference_number
 * @property string $createdOn
 * @property string $tracking_id
 * @property string $received_by
 * @property string $received_on
 */
class CustomerPlotsWarningLetters extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'customer_plots_warning_letters';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('booking_id, warning_letter, reference_number, createdOn', 'required'),
			array('booking_id, warning_letter', 'numerical', 'integerOnly'=>true),
			array('reference_number, tracking_id, received_by', 'length', 'max'=>255),
			array('received_on', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, booking_id, warning_letter, reference_number, createdOn, tracking_id, received_by, received_on', 'safe', 'on'=>'search'),
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
			'booking' => array(self::BELONGS_TO, 'CustomerPlots', 'booking_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'booking_id' => 'Booking',
			'warning_letter' => 'Warning Letter',
			'reference_number' => 'Reference Number',
			'createdOn' => 'Created On',
			'tracking_id' => 'Tracking',
			'received_by' => 'Received By',
			'received_on' => 'Received On',
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
		$criteria->compare('booking_id',$this->booking_id);
		$criteria->compare('warning_letter',$this->warning_letter);
		$criteria->compare('reference_number',$this->reference_number,true);
		$criteria->compare('createdOn',$this->createdOn,true);
		$criteria->compare('tracking_id',$this->tracking_id,true);
		$criteria->compare('received_by',$this->received_by,true);
		$criteria->compare('received_on',$this->received_on,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CustomerPlotsWarningLetters the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
