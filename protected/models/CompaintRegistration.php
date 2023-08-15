<?php

/**
 * This is the model class for table "compaint_registration".
 *
 * The followings are the available columns in table 'compaint_registration':
 * @property integer $complain_id
 * @property string $emp_code
 * @property string $asset_id
 * @property string $type
 * @property string $title
 * @property string $description
 * @property string $prioriy
 * @property string $complaint_date
 */
class CompaintRegistration extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'compaint_registration';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('complain_id, emp_code, asset_id, type, title, description, prioriy, complaint_date', 'required'),
			array('complain_id', 'numerical', 'integerOnly'=>true),
			array('emp_code, asset_id, type, title, description, prioriy, complaint_date', 'length', 'max'=>32),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('complain_id, emp_code, asset_id, type, title, description, prioriy, complaint_date', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'complain_id' => 'Complain',
			'emp_code' => 'Emp Code',
			'asset_id' => 'Asset',
			'type' => 'Type',
			'title' => 'Title',
			'description' => 'Description',
			'prioriy' => 'Prioriy',
			'complaint_date' => 'Complaint Date',
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

		$criteria->compare('complain_id',$this->complain_id);
		$criteria->compare('emp_code',$this->emp_code,true);
		$criteria->compare('asset_id',$this->asset_id,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('prioriy',$this->prioriy,true);
		$criteria->compare('complaint_date',$this->complaint_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CompaintRegistration the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
