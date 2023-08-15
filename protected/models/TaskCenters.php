<?php

/**
 * This is the model class for table "task_centers".
 *
 * The followings are the available columns in table 'task_centers':
 * @property string $id
 * @property string $sent_by
 * @property string $sent_to
 * @property string $task
 * @property string $send_date
 * @property string $receiving_date
 * @property string $response_date
 * @property string $reply
 * @property integer $is_read
 * @property string $created_at
 * @property string $updated_at
 *
 * The followings are the available model relations:
 * @property Users $sentBy
 * @property TeamResources $sentTo
 */
class TaskCenters extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'task_centers';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('is_read', 'numerical', 'integerOnly'=>true),
			array('sent_by, sent_to, task, send_date, receiving_date, response_date, reply, created_at, updated_at', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, sent_by, sent_to, task, send_date, receiving_date, response_date, reply, is_read, created_at, updated_at', 'safe', 'on'=>'search'),
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
			'sentBy' => array(self::BELONGS_TO, 'Users', 'sent_by'),
			'sentTo' => array(self::BELONGS_TO, 'TeamResources', 'sent_to'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'sent_by' => 'Sent By',
			'sent_to' => 'Sent To',
			'task' => 'Task',
			'send_date' => 'Send Date',
			'receiving_date' => 'Receiving Date',
			'response_date' => 'Response Date',
			'reply' => 'Reply',
			'is_read' => 'Is Read',
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
		$criteria->compare('sent_by',$this->sent_by,true);
		$criteria->compare('sent_to',$this->sent_to,true);
		$criteria->compare('task',$this->task,true);
		$criteria->compare('send_date',$this->send_date,true);
		$criteria->compare('receiving_date',$this->receiving_date,true);
		$criteria->compare('response_date',$this->response_date,true);
		$criteria->compare('reply',$this->reply,true);
		$criteria->compare('is_read',$this->is_read);
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
	 * @return TaskCenters the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
