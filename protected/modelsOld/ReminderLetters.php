<?php

/**
 * This is the model class for table "reminder_letters".
 *
 * The followings are the available columns in table 'reminder_letters':
 * @property integer $id
 * @property integer $booking_id
 * @property integer $amount
 * @property integer $days
 * @property string $penalty
 * @property integer $reminder
 * @property string $createdOn
 *
 * The followings are the available model relations:
 * @property CustomerPlots $booking
 */
class ReminderLetters extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'reminder_letters';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('booking_id, amount, days, reminder, createdOn', 'required'),
			array('booking_id, amount, days, reminder', 'numerical', 'integerOnly'=>true),
			array('penalty', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, booking_id, amount, days, penalty, reminder, createdOn', 'safe', 'on'=>'search'),
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
			'amount' => 'Amount',
			'days' => 'Days',
			'penalty' => 'Penalty',
			'reminder' => 'Reminder',
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
		$criteria->compare('booking_id',$this->booking_id);
		$criteria->compare('amount',$this->amount);
		$criteria->compare('days',$this->days);
		$criteria->compare('penalty',$this->penalty,true);
		$criteria->compare('reminder',$this->reminder);
		$criteria->compare('createdOn',$this->createdOn,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ReminderLetters the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
