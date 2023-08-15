<?php

/**
 * This is the model class for table "hsc_checklist_logs".
 *
 * The followings are the available columns in table 'hsc_checklist_logs':
 * @property string $id
 * @property string $hsc_checklist_master_log_id
 * @property integer $checklist_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 *
 * The followings are the available model relations:
 * @property HscChecklistMasterLogs $hscChecklistMasterLog
 */
class HscChecklistLogs extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'hsc_checklist_logs';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('created_at, updated_at', 'required'),
			array('checklist_id', 'numerical', 'integerOnly'=>true),
			array('hsc_checklist_master_log_id, deleted_at', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, hsc_checklist_master_log_id, checklist_id, created_at, updated_at, deleted_at', 'safe', 'on'=>'search'),
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
			'hscChecklistMasterLog' => array(self::BELONGS_TO, 'HscChecklistMasterLogs', 'hsc_checklist_master_log_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'hsc_checklist_master_log_id' => 'Hsc Checklist Master Log',
			'checklist_id' => 'Checklist',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
			'deleted_at' => 'Deleted At',
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
		$criteria->compare('hsc_checklist_master_log_id',$this->hsc_checklist_master_log_id,true);
		$criteria->compare('checklist_id',$this->checklist_id);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('updated_at',$this->updated_at,true);
		$criteria->compare('deleted_at',$this->deleted_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return HscChecklistLogs the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
