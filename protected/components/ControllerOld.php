<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();

	public function checkSession() {
        if (!isset(Yii::app()->session['userModel'])) {
            $previousUrl=Yii::app()->request->urlReferrer;
            Yii::app()->session['urlReferer']=$previousUrl;
            //echo "<body onLoad='artificialbody()'></body>";
            //return false;
            //exit();
            Yii::app()->user->setFlash('error','Please Login the get back to the previous page');
            $this->redirect(Yii::app()->params['AppUrl']);
            //$this->redirect(Yii::app()->request->urlReferrer);
        }
	}

	public function sendSMS($number,$mesage){
		//$number = '03312326877';
		$msg = 'https://pk.eocean.us/APIManagement/API/RequestAPI?user=essahousing&pwd=AK9ljP9TxuVLasn1EG8kDSZHIbttGCs3Eq2Ig7UMjwcDqM70ki%2beXwp77lZ472ePWg%3d%3d&sender=EssaHousing&reciever='.$number.'&msg-data='.rawurlencode($mesage).'&response=string';

		$msg1 = 'https://pk.eocean.us/APIManagement/API/RequestAPI?user=essahousing&pwd=AK9ljP9TxuVLasn1EG8kDSZHIbttGCs3Eq2Ig7UMjwcDqM70ki%2beXwp77lZ472ePWg%3d%3d&sender=EssaHousing&reciever=03122249841&msg-data='.rawurlencode($mesage).'&response=string';


		$msg2 = 'https://pk.eocean.us/APIManagement/API/RequestAPI?user=essahousing&pwd=AK9ljP9TxuVLasn1EG8kDSZHIbttGCs3Eq2Ig7UMjwcDqM70ki%2beXwp77lZ472ePWg%3d%3d&sender=EssaHousing&reciever=03222400467&msg-data='.rawurlencode($mesage).'&response=string';


		//Try using %0A in the URL, just like you've used %20 instead of the space character.
		// use key 'http' even if you send the request to https://...
		$options = array(
		  'http' => array(
		    'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
		    'method'  => 'GET',
		  ),
		);
		//echo $mesage.'</br>';
		$context  = @stream_context_create($options);
		$result = @file_get_contents($msg, false, $context);
		//@var_dump($result); 

		// $context  = @stream_context_create($options);
		// $result = @file_get_contents($msg1, false, $context);
		// @var_dump($result); 

		// $context  = @stream_context_create($options);
		// $result = @file_get_contents($msg2, false, $context);
		// @var_dump($result); 
	}


	public function startsWith($haystack, $needle)
	{
	     $length = strlen($needle);
	     return (substr($haystack, 0, $length) === $needle);
	}

	public function removeWith($haystack, $needle)
	{
	     $length = strlen($needle);
	     return (substr($haystack, 0, $length) === $needle);
	}


	public function Percentage($total,$percentage,$view = 1){
		if($view == 1){
			return number_format((@$percentage / 100) * @$total);
		} else{
			return (@$percentage / 100) * @$total;
		}
	}

	public function getBookingRegNo($id,$isShowOld=false,$lockID = 400){
		$booking = CustomerPlots::model()->findByPk($id);
		$plotDetail = [];
		if($booking){
			$plotDetail = CustomerPlots::model()->findAll('plot_id = :plot AND status != 0',array(':plot'=>$booking->plot_id),array('order'=>'id desc'));	
		}
		$bookingPaymentCount = CustomerPlots::model()->count('id < :id AND is_special = :special',array(':id'=>$id,':special'=>$booking->is_special));	
		
		//echo '<pre>';print_r($bookingPaymentCount);exit;
		
		$paymentSchedule = PaymentSchedules::model()->find(array('order'=>'id desc'));
		if($isShowOld){
				if($booking->special){
					return $booking->special->name.'/'.(sprintf('%03d',$bookingPaymentCount+1)).'/KC';
				} else{
					return $paymentSchedule->name.'/'.(sprintf('%03d',$bookingPaymentCount+1)).'/KC';
				}
		} else{
			if(count($plotDetail) > 1){
				$bookingFirst = CustomerPlots::model()->findByPk($plotDetail[0]->id);
				$bookingPaymentCount = CustomerPlots::model()->count('id < :id AND is_special = :special',array(':id'=>$plotDetail[0]->id,':special'=>$bookingFirst->is_special));
				if($bookingFirst->special){
					return $bookingFirst->special->name.'/'.(sprintf('%03d',$bookingPaymentCount+1)).'/KC';
				} else{
					return $paymentSchedule->name.'/'.(sprintf('%03d',$bookingPaymentCount+1)).'/KC';
				}
			} else{
				if($booking->special){
					return $booking->special->name.'/'.(sprintf('%03d',$bookingPaymentCount+1)).'/KC';
				} else{
					return $paymentSchedule->name.'/'.(sprintf('%03d',$bookingPaymentCount+1)).'/KC';
				}
			}
		}
		
	}

	public function getWarningLetterNo($id){
		//Regno/ST-I/WL-I
		$booking = CustomerPlots::model()->findByPk($id);
		$wmCount = CustomerPlotsWarningLetters::model()->count('booking_id=:id',array(':id'=>$id));
		$modes = [
			1=>'I',
			2=>'II',
			3=>'III',
			4=>'IV',
			5=>'V',
			6=>'VI',
			7=>'VII',
			8=>'VIII',
			9=>'IX',
			10=>'X',
			11=>'XI',
			12=>'XII'
		];
		if($booking && $booking->plot->customerPlotTransfers){
			return $this->getBookingRegNo($id).'/ST-'.($booking->plot->customerPlotTransfersCount).'/WL-'.$modes[$wmCount+1];
		} else{
			return $this->getBookingRegNo($id).'/WL-'.$modes[$wmCount+1];
		}
	}

	public function getExpenseRegNo($id, $type='expense'){
		$expensePaymentCount = $pettyCashPaymentCount = 0;
		if($type=='expense'){
			$expense = Expenses::model()->findByPk($id);
			$pettyCashPaymentCount = PettyCashExpenses::model()->count('createdOn < :id AND expense_type = :type',array(':id'=>$expense->createdOn,':type'=>$expense->expense_type));	
			$expensePaymentCount = Expenses::model()->count('id < :id AND expense_type = :type',array(':id'=>$id,':type'=>$expense->expense_type));	
		}

		if($type=='pettyCash'){
			$expense = PettyCashExpenses::model()->findByPk($id);
			$expensePaymentCount = Expenses::model()->count('createdOn < :id AND expense_type = :type',array(':id'=>$expense->createdOn,':type'=>$expense->expense_type));	
			$pettyCashPaymentCount = PettyCashExpenses::model()->count('id < :id AND expense_type = :type',array(':id'=>$id,':type'=>$expense->expense_type));	
			
		}
		
		$totalCount = $expensePaymentCount + $pettyCashPaymentCount;
		
		
		$modes = [
			1=>'I',
			2=>'II',
			3=>'III',
			4=>'IV',
			5=>'V',
			6=>'VI',
			7=>'VII',
			8=>'VIII',
			9=>'IX',
			10=>'X',
			11=>'XI',
			12=>'XII',
			13=>'XIII',
			14=>'XIV',
			15=>'XV'
		];
		//return $pettyCashPaymentCount;
		return 'EXP/'.$modes[$expense->expense_type].'-'.(sprintf('%03d',$totalCount+1)).'/KC';
		
	}


	public function documentTypes(){
		$types = ['CNIC-Front','CNIC-Back','NADRA Verification Form','Thumb Image','Nominee CNIC-Front','Nominee CNIC-Back'];
		return $types;
	}

	public function paymentScheduleModes(){
		$types = ['Booking','Confirmation','Allocation','Monthly','Yearly','Possession'];
		return $types;
	}

	public function PlotUpdatedTotal($id){
		$plot = Plots::model()->findByPk($id);
		$plotTotal = $plot->total;
        
        if($plot->is_corner == 1){
            $cornerCharger = $this->Percentage($plotTotal,$plot->is_corner_amount,0);
            $plotTotal = $plotTotal + $cornerCharger;
        }

        if($plot->is_park_facing == 1){
            $parkFacing = $this->Percentage($plotTotal,$plot->is_park_facing_amount,0);
            $plotTotal = $plotTotal + $parkFacing;
        }

        if($plot->is_west_open == 1){
            $westOpen = $this->Percentage($plotTotal,$plot->is_west_open_amount,0);
            $plotTotal = $plotTotal + $westOpen;
        }

        $plotTotal = $plotTotal-$plot->discount;
        return 'PKR '.number_format($plotTotal);
	}

	public function getPaymentScheduleTotal($type,$id){
		$paySch = PaymentSchedulePaymentModes::model()->findAll('payment_schedule_id = :id AND plot_type = :type',array(
			':id'=> $id,
			':type' =>strtolower($type)
		));
		$total = 0;
		if($paySch){
			foreach($paySch as $a){
				$total = $total + $a->amount;
			}
		}
		return $total;
	}

	public function plotTotalCancel($id,$number_format = true,$is_total = true){
		$plot = Plots::model()->findByPk($id);
		$total = 0;
		if($is_total){
			$total += $plot->total;	
		}
		
		/*if($plot->is_road_facing == 1){
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
		}*/
		if($number_format){
			return number_format($total);	
		} else{
			return $total;
		}
		
	}




	public function Getplotamountsafter3steps($booking){
		$booking = CustomerPlots::model()->findByPk($booking->id);
		return $booking->customerPlotTransactionSumWithout3;

	}

	public function expenseType($id,$onlyModes = false){
		$modes = [
			1=>'Survayour',
			2=>'Site',
			3=>'Sewrage',
			4=>'Road',
			5=>'Marketing',
			6=>'Boundry',
			7=>'Gardening',
			8=>'Office Setup',
			9=>'Office Running',
			10=>'Agent Commission',
			11=>'Donation',
			12=>'Qadir Personal',
			13=>'Assets',
			14=>'Loan',
			15=>'Petty Cash Load',
			16=>'Petty Cash Expense'
		];
		if($onlyModes){
			return $modes;
		} else{
			return $modes[$id];	
		}
		
	}

	public function discountedPlotCostOfLand($id){
		$plot = Plots::model()->findByPk($id);
		if($plot->discount){
			return $plot->total-$plot->discount;	
		} else{
			return $plot->total;
		}
	}

	public function discountedPlotCostOfLandAndExtra($id){
		$plot = Plots::model()->findByPk($id);
		$costOfLand = $plotTotal = 0;
		if($plot->discount){
			$costOfLand = $plot->total-$plot->discount;	
		} else{
			$costOfLand = $plot->total;
		}
		$plotTotal = $costOfLand + $this->plotExtra($plot->id,false,true,true);
		return $plotTotal;
	}

	public function numberToRoman($num)  
	{ 
	    // Be sure to convert the given parameter into an integer
	    $n = intval($num);
	    $result = ''; 
	 
	    // Declare a lookup array that we will use to traverse the number: 
	    $lookup = array(
	        'M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 
	        'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 
	        'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1
	    ); 
	 
	    foreach ($lookup as $roman => $value)  
	    {
	        // Look for number of matches
	        $matches = intval($n / $value); 
	 
	        // Concatenate characters
	        $result .= str_repeat($roman, $matches); 
	 
	        // Substract that from the number 
	        $n = $n % $value; 
	    } 

	    return $result; 
	} 
}