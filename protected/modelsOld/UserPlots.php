<?php

/**
 * This is the model class for table "user_plots".
 *
 * The followings are the available columns in table 'user_plots':
 * @property integer $id
 * @property integer $user_id
 * @property integer $plot_id
 * @property string $createdOn
 * @property integer $status
 * @property string $updatedBy
 *
 * The followings are the available model relations:
 * @property Plots $plot
 * @property Users $user
 */
class UserPlots extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user_plots';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, plot_id, createdOn, status, updatedBy', 'required'),
			array('user_id, plot_id, status', 'numerical', 'integerOnly'=>true),
			array('updatedBy', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, plot_id, createdOn, status, updatedBy', 'safe', 'on'=>'search'),
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('plot_id',$this->plot_id);
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
	 * @return UserPlots the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
