<?php

/**
 * This is the model class for table "hse_violation_recorded".
 *
 * The followings are the available columns in table 'hse_violation_recorded':
 * @property string $id
 * @property string $violation_category_id
 * @property string $team_id
 * @property string $created_at
 * @property string $updated_at
 *
 * The followings are the available model relations:
 * @property TeamResources $team
 * @property ViolationCategories $violationCategory
 */
class HseViolationRecorded extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'hse_violation_recorded';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('violation_category_id, team_id', 'required'),
			array('created_at, updated_at', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, violation_category_id, team_id, created_at, updated_at', 'safe', 'on'=>'search'),
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
			'team' => array(self::BELONGS_TO, 'TeamResources', 'team_id'),
			'violationCategory' => array(self::BELONGS_TO, 'ViolationCategories', 'violation_category_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'violation_category_id' => 'Violation Category',
			'team_id' => 'Team',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('violation_category_id',$this->violation_category_id,true);
		$criteria->compare('team_id',$this->team_id,true);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('updated_at',$this->updated_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return HseViolationRecorded the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
