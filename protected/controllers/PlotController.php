<?php

class PlotController extends Controller
{
	public function actionAdd()
	{
		$data['categories'] = PlotCategories::model()->findAll();
		$data['sizes'] = PlotSizes::model()->findAll();
		$this->render('add',$data);
	}

	public function actionSave(){
		if($_POST['plot_number']){
			//$plotCheck = Plots::model()->find('plot_number=:plot AND block_number = :block',array(':plot'=>$_POST['plot_number'],':block'=>$_POST['block_number']));
			//if(!$plotCheck){
				$plot = new Plots;
				$plot->attributes = $_POST;
				$plot->is_road_facing_amount = 10;
				$plot->is_corner_amount = 10;
				$plot->is_park_facing_amount = 10;
				$plot->is_west_open_amount = 10;
				$plot->is_corner = isset($_POST['is_corner'])?1:0;
				$plot->is_park_facing = isset($_POST['is_park_facing'])?1:0;
				$plot->is_west_open = isset($_POST['is_west_open'])?1:0;
				$plot->is_road_facing = isset($_POST['is_road_facing'])?1:0;
				$plot->phase_id = Yii::app()->session->get('userModel')['phase_id'];
				$plot->status = 0;
				$plot->save(false);
				if($_FILES['site_plan']['name']){
					PlotSitePlans::model()->deleteAll("plot_id = $plot->id");
					$uploadFolder = getcwd() . '/uploads/plot/site_plan/';
					$fileName = time().'_'.$_FILES['site_plan']['name'];
			        move_uploaded_file($_FILES['site_plan']['tmp_name'], $uploadFolder.$fileName);
			        $psp = new PlotSitePlans;
					$psp->plot_id = $plot->id;
					$psp->site_plan = $fileName;
					$psp->image = 'null';
					$psp->save(false);
				}
				if($_POST['north']){
					PlotBoundries::model()->deleteAll("plot_id = $plot->id");
					$pb = new PlotBoundries;
					$pb->plot_id = $plot->id;
					$pb->north = $_POST['north'];
					$pb->west = $_POST['west'];
					$pb->south = $_POST['south'];
					$pb->east = $_POST['east'];
					$pb->save(false);
				}
				Yii::app()->user->setFlash('success','Plot has been saved.');
	            $this->redirect(Yii::app()->baseUrl.'/plot');	
			// } else{
			// 	Yii::app()->user->setFlash('error','Plot already saved.');
	  //           $this->redirect(Yii::app()->baseUrl.'/plot');
			// }
			
		}
	}

	public function Percentage($total,$percentage,$view = 1){
		if($view == 1){
			return number_format((@$percentage / 100) * @$total);
		} else{
			return (@$percentage / 100) * @$total;
		}
		
	}

	public function plotTotal($id,$number_format = true,$is_total = true){
		$plot = Plots::model()->findByPk($id);
		$total = 0;
		if($is_total){
			$total += $plot->total;	
		}
		
		if($plot->is_road_facing == 1){
			$total += $this->Percentage($plot->total,$plot->is_road_facing_amount,0);
		}
		if($plot->is_park_facing == 1){
			$total += $this->Percentage($plot->total,$plot->is_park_facing_amount,0);	
		}
		if($plot->is_corner == 1){
			$total += $this->Percentage($plot->total,$plot->is_corner_amount,0);
		}
		if($plot->is_west_open == 1){
			$total += $this->Percentage($plot->total,$plot->is_west_open_amount,0);
		}
		if($number_format){
			return number_format($total);	
		} else{
			return $total;
		}
		
	}

	public function plotDiscount($id,$number_format = true){
		$plot = Plots::model()->findByPk($id);
		$totalDiscount = 0;
		
		$total = $this->plotTotal($id,false);
		$totalDiscount = $this->Percentage($total,$plot->discount,0);
		//$total = $total - $totalDiscount;
		if($number_format){
			return number_format($totalDiscount);	
		} else{
			return $totalDiscount;
		}
		
	}

	public function actionIndex()
	{	$phaseId = Yii::app()->session->get('userModel')['phase_id'];
		if(isset($_GET['status'])){
			$s = $_GET['status'];
			$data['plots'] = Plots::model()->findAll("status = $s AND phase_id = $phaseId");
		} else{
			$data['plots'] = Plots::model()->findAll("phase_id = $phaseId");
		}
		
		$this->render('index',$data);
	}

	public function actionView($id)
	{
		$data['plot'] = Plots::model()->findByPk($id);
		$this->render('view',$data);
	}


	public function actionEdit($id)
	{
		$data['plot'] = Plots::model()->findByPk($id);
		$data['categories'] = PlotCategories::model()->findAll();
		$data['sizes'] = PlotSizes::model()->findAll();
		$this->render('edit',$data);
	}

	public function actionUpdate(){
		//echo '<pre>';print_r($_POST);exit;
		if($_POST['plot_number']){
			$plot = Plots::model()->findByPk($_POST['id']);
			$plot->attributes = $_POST;
			$plot->is_corner = isset($_POST['is_corner'])?1:0;
			$plot->is_park_facing = isset($_POST['is_park_facing'])?1:0;
			$plot->is_west_open = isset($_POST['is_west_open'])?1:0;
			$plot->is_road_facing = isset($_POST['is_road_facing'])?1:0;
			$plot->phase_id = Yii::app()->session->get('userModel')['phase_id'];
			$plot->save(false);
			if($_FILES['site_plan']['name']){
				PlotSitePlans::model()->deleteAll("plot_id = $plot->id");
				$uploadFolder = getcwd() . '/uploads/plot/site_plan/';
				$fileName = time().'_'.$_FILES['site_plan']['name'];
		        move_uploaded_file($_FILES['site_plan']['tmp_name'], $uploadFolder.$fileName);
		        $psp = new PlotSitePlans;
				$psp->plot_id = $plot->id;
				$psp->site_plan = $fileName;
				$psp->image = 'null';
				$psp->save(false);
			}
			if($_POST['north']){
				PlotBoundries::model()->deleteAll("plot_id = $plot->id");
				$pb = new PlotBoundries;
				$pb->plot_id = $plot->id;
				$pb->north = $_POST['north'];
				$pb->west = $_POST['west'];
				$pb->south = $_POST['south'];
				$pb->east = $_POST['east'];
				$pb->save(false);
			}
			Yii::app()->user->setFlash('success','Plot has been Updated.');
            $this->redirect(Yii::app()->baseUrl.'/plot');
		}
	}

	public function actionGetpaymentschedule($id,$booking){
		$this->layout = 'ledger';
		$data['plot'] = Plots::model()->findByPk($id);
		$data['booking'] = CustomerPlotsPreview::model()->findByPk($booking);
		$data['is_orig'] = '0';
		$this->render('payment_schedule',$data);

	}

	public function actionGetpaymentscheduleOrig($id,$booking){
		$this->layout = 'ledger';
		$data['plot'] = Plots::model()->findByPk($id);
		$data['booking'] = CustomerPlots::model()->findByPk($booking);
		$data['is_orig'] = '1';
		$this->render('payment_schedule',$data);

	}

	public function getIndianCurrency(float $number)
	{
	    $decimal = round($number - ($no = floor($number)), 2) * 100;
	    $hundred = null;
	    $digits_length = strlen($no);
	    $i = 0;
	    $str = array();
	    $words = array(0 => '', 1 => 'one', 2 => 'two',
	        3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',
	        7 => 'seven', 8 => 'eight', 9 => 'nine',
	        10 => 'ten', 11 => 'eleven', 12 => 'twelve',
	        13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
	        16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',
	        19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',
	        40 => 'forty', 50 => 'fifty', 60 => 'sixty',
	        70 => 'seventy', 80 => 'eighty', 90 => 'ninety');
	    $digits = array('', 'hundred','thousand','lac', 'crore');
	    while( $i < $digits_length ) {
	        $divider = ($i == 2) ? 10 : 100;
	        $number = floor($no % $divider);
	        $no = floor($no / $divider);
	        $i += $divider == 10 ? 1 : 2;
	        if ($number) {
	            $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
	            $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
	            $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
	        } else $str[] = null;
	    }
	    $Rupees = implode('', array_reverse($str));
	    $paise = ($decimal) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
	    return ($Rupees ? $Rupees . ' Rupees Only ' : '') . $paise;
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}