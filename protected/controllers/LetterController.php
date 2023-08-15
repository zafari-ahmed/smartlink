<?php

class LetterController extends Controller
{
	public function actionReminder()
	{
		if(!empty($_POST['booking_id'])){
			$model = new ReminderLetters;
			$model->attributes = $_POST;
			$model->createdOn = date('Y-m-d H:i:s');
			$model->save();
			
			if($_POST['reminder'] == 3){
				$cp = CustomerPlots::model()->findByPk($_POST['booking_id']);
				if($cp->blocked==2){
					$cp->blocked = 2;	
					$cp->is_open = 0;	
					$cp->save(false);	
				} else{
					$cp->blocked = 1;	
					$cp->save(false);
				}
				
			}
			
			
			$this->redirect(Yii::app()->baseUrl.'/letter/view/booking_id/'.$model->booking_id.'/id/'.$model->id);
		}
	}

	public function actionView($booking_id,$id)
	{
		$data['letter'] = ReminderLetters::model()->find('booking_id = :booking AND id = :id',array('booking'=>$booking_id,':id'=>$id));
		$this->layout = 'letter';
		$this->render('reminder',$data);
	}

	public function Percentage($total,$percentage,$view = 1){
		if($view == 1){
			return number_format((@$percentage / 100) * @$total);
		} else{
			return (@$percentage / 100) * @$total;
		}
		
	}

	public function actionTransferedletter($id)
	{	
		//$data['cancelled'] = CustomerPlotCancelled::model()->findAll(array('group'=>'booking_id'));
		$this->layout = 'letter';
		$data['transfered'] = CustomerPlotTransfers::model()->findByPk($id);
		$data['netTotal'] = intval($data['transfered']->booking->customerPlots[0]->customerPlotTransactionSum) + intval($this->plotDiscount($data['transfered']->booking->customerPlots[0]->plot->id,false));//
		$this->render('three',$data);
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
	    $digits = array('', 'hundred','thousand','lakh', 'crore');
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
	    return ($Rupees ? $Rupees . ' Only ' : '') . $paise;
	}


	public function actionDevelopment(){
		$data['sizes'] = PlotSizes::model()->findAll();
		$criteria = new CDbCriteria();
		$criteria->order = "id DESC";
		$data['bookings'] = CustomerPlots::model()->findAll($criteria);


		$this->render('development',$data);
	}

	public function actionDevelopmentletter(){
		if(isset($_POST['plot_id']) && !empty($_POST['plot_id'])){
			$cps = CustomerPlots::model()->findAll('id = :id',array(':id'=>$_POST['plot_id']));
			$type = 'plot';
		}
		if(isset($_POST['size_id']) && !empty($_POST['size_id'])){
			$cps = CustomerPlots::model()->with('plot')->findAll('plot.size_id = :id AND t.status = 1',array(':id'=>$_POST['size_id']));	
			$type = 'size';
		}
		$data['links'] = [];
		foreach($cps as $cp){
			$data['links'][] = Yii::app()->params['AppUrl'].'/letter/dev/id/'.$cp->id.'/type/'.$type.'/amount/'.$_POST['amount'];
			//echo Yii::app()->request->baseUrl.'/letter/dev/id/'.$cp->id.'/type/'.$type.'/amount/'.$_POST['amount'];
		}

		$data['booking'] = $cps[0];
		$data['reminder'] = 1;
		$data['amount'] = $_POST['amount'];
		//$data['d'] = json_encode($data['links']);
		$this->layout = '';
		$this->renderPartial('links',$data);

	}

	public function actionDev($id,$type,$amount){
		$data = [];
		$data['booking'] = CustomerPlots::model()->findByPk($id);
		$data['amount'] = $amount;
		$this->layout = 'letterDev';
		$this->render('developmentLetter',$data);
	}


	public function actionDevelopmentsingle(){
		$this->redirect($this->actionDev($_POST['booking_id'],'size',$_POST['amount']));
	}

	
}