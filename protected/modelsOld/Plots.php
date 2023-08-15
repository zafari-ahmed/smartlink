<?php

/**
 * This is the model class for table "plots".
 *
 * The followings are the available columns in table 'plots':
 * @property integer $id
 * @property string $block_number
 * @property integer $category_id
 * @property integer $size_id
 * @property string $plot_number
 * @property string $length
 * @property string $width
 * @property string $description
 * @property string $plot_type
 * @property integer $is_road_facing
 * @property double $is_road_facing_amount
 * @property integer $is_corner
 * @property double $is_corner_amount
 * @property integer $is_park_facing
 * @property integer $is_park_facing_amount
 * @property integer $is_west_open
 * @property integer $is_west_open_amount
 * @property integer $total
 * @property double $discount
 * @property integer $phase_id
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property CustomerPlots[] $customerPlots
 */
class Plots extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'plots';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('block_number, category_id, size_id, plot_number, is_road_facing, is_road_facing_amount, is_corner, is_corner_amount, is_park_facing, is_park_facing_amount, is_west_open, is_west_open_amount, total, discount, status', 'required'),
			array('category_id, size_id, is_road_facing, is_corner, is_park_facing, is_park_facing_amount, is_west_open, is_west_open_amount, total, phase_id, status', 'numerical', 'integerOnly'=>true),
			array('is_road_facing_amount, is_corner_amount, discount', 'numerical'),
			array('block_number, plot_number, length, width, description, plot_type', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, block_number, category_id, size_id, plot_number, length, width, description, plot_type, is_road_facing, is_road_facing_amount, is_corner, is_corner_amount, is_park_facing, is_park_facing_amount, is_west_open, is_west_open_amount, total, discount, phase_id, status', 'safe', 'on'=>'search'),
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
			'customerPlots' => array(self::HAS_MANY, 'CustomerPlots', 'plot_id','condition'=>'customerPlots.status=1'),
			'customerPlotsOld' => array(self::HAS_MANY, 'CustomerPlotsPreview', 'plot_id'),
			'customerPlotsCount' => array(self::STAT, 'CustomerPlots', 'plot_id'),
			'customerPlotTransfersCount' => array(self::STAT, 'CustomerPlotTransfers', 'plot_id'),
			'customerPlotTransfers' => array(self::HAS_MANY, 'CustomerPlotTransfers', 'plot_id', 'order'=>'createdOn ASC'),
			'customerPlotTransfersSum' => array(self::STAT, 'CustomerPlotTransfers', 'plot_id', 'order'=>'createdOn ASC','select'=>'SUM(amount)'),
			'customerPlotTransfersRecent' => array(self::HAS_MANY, 'CustomerPlotTransfers', 'plot_id', 'order'=>'createdOn DESC','limit'=>1),
			'plotAmountDistributors' => array(self::HAS_MANY, 'PlotAmountDistributors', 'plot_id'),
			'category' => array(self::BELONGS_TO, 'PlotCategories', 'category_id'),
			'size' => array(self::BELONGS_TO, 'PlotSizes', 'size_id'),
			'agentReserve' => array(self::HAS_MANY, 'AgentPlots', 'plot_id'),
			'plotSitePlans' => array(self::HAS_MANY, 'PlotSitePlans', 'plot_id'),
			'plotBoundries' => array(self::HAS_MANY, 'PlotBoundries', 'plot_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'block_number' => 'Block Number',
			'category_id' => 'Category',
			'size_id' => 'Size',
			'plot_number' => 'Plot Number',
			'length' => 'Length',
			'width' => 'Width',
			'description' => 'Description',
			'plot_type' => 'Plot Type',
			'is_road_facing' => 'Is Road Facing',
			'is_road_facing_amount' => 'Is Road Facing Amount',
			'is_corner' => 'Is Corner',
			'is_corner_amount' => 'Is Corner Amount',
			'is_park_facing' => 'Is Park Facing',
			'is_park_facing_amount' => 'Is Park Facing Amount',
			'is_west_open' => 'Is West Open',
			'is_west_open_amount' => 'Is West Open Amount',
			'total' => 'Total',
			'discount' => 'Discount',
			'phase_id' => 'Phase',
			'status' => 'Status',
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
		$criteria->compare('block_number',$this->block_number,true);
		$criteria->compare('category_id',$this->category_id);
		$criteria->compare('size_id',$this->size_id);
		$criteria->compare('plot_number',$this->plot_number,true);
		$criteria->compare('length',$this->length,true);
		$criteria->compare('width',$this->width,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('plot_type',$this->plot_type,true);
		$criteria->compare('is_road_facing',$this->is_road_facing);
		$criteria->compare('is_road_facing_amount',$this->is_road_facing_amount);
		$criteria->compare('is_corner',$this->is_corner);
		$criteria->compare('is_corner_amount',$this->is_corner_amount);
		$criteria->compare('is_park_facing',$this->is_park_facing);
		$criteria->compare('is_park_facing_amount',$this->is_park_facing_amount);
		$criteria->compare('is_west_open',$this->is_west_open);
		$criteria->compare('is_west_open_amount',$this->is_west_open_amount);
		$criteria->compare('total',$this->total);
		$criteria->compare('discount',$this->discount);
		$criteria->compare('phase_id',$this->phase_id);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Plots the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
