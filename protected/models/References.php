<?php

/**
 * This is the model class for table "references".
 *
 * The followings are the available columns in table 'references':
 * @property string $id
 * @property string $account_name
 * @property integer $legal_type_id
 * @property string $incorporation_number
 * @property string $ntn_number
 * @property string $strn_number
 * @property string $set_commision_percentage
 * @property string $reference_user_account
 * @property string $reference_user_password
 * @property string $bank_name
 * @property string $iban
 * @property string $devices_sold
 * @property string $revenue
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 */
class References extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'references';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('legal_type_id, status', 'numerical', 'integerOnly'=>true),
			array('account_name, incorporation_number, ntn_number, strn_number, set_commision_percentage, reference_user_account, reference_user_password, bank_name, iban, devices_sold, revenue', 'length', 'max'=>255),
			array('created_at, updated_at', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, account_name, legal_type_id, incorporation_number, ntn_number, strn_number, set_commision_percentage, reference_user_account, reference_user_password, bank_name, iban, devices_sold, revenue, status, created_at, updated_at', 'safe', 'on'=>'search'),
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
			'legalType' => array(self::BELONGS_TO, 'LegalTypes', 'legal_type_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'account_name' => 'Account Name',
			'legal_type_id' => 'Legal Type',
			'incorporation_number' => 'Incorporation Number',
			'ntn_number' => 'Ntn Number',
			'strn_number' => 'Strn Number',
			'set_commision_percentage' => 'Set Commision Percentage',
			'reference_user_account' => 'Reference User Account',
			'reference_user_password' => 'Reference User Password',
			'bank_name' => 'Bank Name',
			'iban' => 'Iban',
			'devices_sold' => 'Devices Sold',
			'revenue' => 'Revenue',
			'status' => 'Status',
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
		$criteria->compare('account_name',$this->account_name,true);
		$criteria->compare('legal_type_id',$this->legal_type_id);
		$criteria->compare('incorporation_number',$this->incorporation_number,true);
		$criteria->compare('ntn_number',$this->ntn_number,true);
		$criteria->compare('strn_number',$this->strn_number,true);
		$criteria->compare('set_commision_percentage',$this->set_commision_percentage,true);
		$criteria->compare('reference_user_account',$this->reference_user_account,true);
		$criteria->compare('reference_user_password',$this->reference_user_password,true);
		$criteria->compare('bank_name',$this->bank_name,true);
		$criteria->compare('iban',$this->iban,true);
		$criteria->compare('devices_sold',$this->devices_sold,true);
		$criteria->compare('revenue',$this->revenue,true);
		$criteria->compare('status',$this->status);
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
	 * @return References the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
