<?php

class BookingController extends Controller
{
	public function actionAdd($id='')
	{
		$phaseId = Yii::app()->session->get('userModel')['phase_id'];
		$data['categories'] = PlotCategories::model()->findAll();
		$data['sizes'] = PlotSizes::model()->findAll();
		$data['paymentSchedules'] = PaymentSchedules::model()->findAll();
		//$data['plots'] = Plots::model()->findAll();
		$data['blocks'] = Plots::model()->findAll(array(
                    'select'=>'t.block_number',
                    'distinct'=>true,
                    'condition'=>"phase_id=$phaseId",
                ));
		$sql = 'SELECT * FROM `payment_modes` GROUP BY mode ORDER BY id ASC ; ';
        $paymentModes = Yii::app()->db->createCommand($sql)->queryAll();
        $objectPayment = new stdClass();
		foreach ($paymentModes as $key => $value)
		{
		    $objectPayment->$key = (object) $value;
		}
        $data['paymentmodes'] = $objectPayment;//PaymentModes::model()->findAll('amount = 0');
		$data['currentPlot']  = '';
		if($id){
			$data['currentPlot'] = Plots::model()->findByPk($id);
			//$data['paymentmodes'] = PaymentModes::model()->findAll('plot_size_id = :size',array(':size'=>$data['currentPlot']->size_id));
		}
		$data['agents'] = Agents::model()->findAll('status = 1 AND parent_id IS NULL');
		$data['agentsub'] = Agents::model()->findAll('status = 1 AND parent_id IS NOT NULL');
		$data['accounts'] = Accounts::model()->findAll('is_visible = 1');
		$data['charges'] = DevelopmentCharges::model()->findAll();
		$criteria = new CDbCriteria();
		$criteria->addCondition("phase_id = $phaseId");
		$criteria->order = "t.transaction_number DESC";

		$data['lastTrans'] = CustomerPlotTransactions::model()->find($criteria);
		$this->render('add',$data);
	}

	public function actionSave(){
		$uploadFolder = getcwd() . '/uploads/booking/';
		if(isset($_POST['preview'])){
			
			$plot = Plots::model()->findByPk($_POST['plot_id']);
			$customer = new CustomerPreviews;
			$customer->attributes = $_POST;
			$customer->phase_id = Yii::app()->session->get('userModel')['phase_id'];
			$customer->status = 1;
			if($customer->save(false)){
				$customer_plot = new CustomerPlotsPreview;
				$customer_plot->attributes = $_POST;
				if($plot->agentReserve){
					$customer_plot->is_agent = 1;
					$customer_plot->agent_id = $plot->agentReserve[0]->agent_id;
				}
				$customer_plot->user_id = Yii::app()->session['userModel']['id'];
				$customer_plot->customer_id = $customer->id;
				$customer_plot->createdOn =  @$_POST['createdOn'];
				$customer_plot->updatedBy = Yii::app()->session['userModel']['first_name'].' '.Yii::app()->session['userModel']['last_name'];
				$customer_plot->status = 1;
				$customer_plot->is_special = $_POST['is_special'];
				$customer_plot->blocked = 0;
				$customer_plot->phase_id = Yii::app()->session->get('userModel')['phase_id'];
				if($_FILES['plot']['name']){
					
			        $fileName = time().'_'.$_FILES['plot']['name'];
			        $orig_fileName = $_FILES['plot']['name'];
			        move_uploaded_file($_FILES['plot']['tmp_name'], $uploadFolder.$fileName);
					$customer_plot->agent_cnic = $fileName; 
				}
				$customer_plot->save(false);
			}
			//update plot
			$plot = Plots::model()->findByPk($_POST['plot_id']);
			if($_POST['is_special']){
				$plot->total = $this->getPaymentScheduleTotal($_POST['plot_type'],$_POST['is_special']);
			}
			if($_POST['discount']){
				$plot->discount = $_POST['discount'];
			}
			$plot->save(false);
			$this->redirect(Yii::app()->baseUrl.'/bookingpreview/preview/'.$customer_plot->id);
			return false;
		}
		
		if($_POST['plot_id']){
			$CP = CustomerPlots::model()->find('plot_id = :id AND status = 1',array(':id'=>$_POST['plot_id']));
			$plot = Plots::model()->findByPk($_POST['plot_id']);
			if(!$CP){
				$customer = new Customers;
				$customer->attributes = $_POST;
				$customer->phase_id = Yii::app()->session->get('userModel')['phase_id'];
				$customer->status = 1;
				if($customer->save(false)){
					$customer_plot = new CustomerPlots;
					$customer_plot->attributes = $_POST;
					if($plot->agentReserve){
						$customer_plot->is_agent = 1;
						$customer_plot->agent_id = $plot->agentReserve[0]->agent_id;
					}
					$customer_plot->user_id = Yii::app()->session['userModel']['id'];
					$customer_plot->customer_id = $customer->id;
					$customer_plot->createdOn =  @$_POST['createdOn'];
					$customer_plot->updatedBy = Yii::app()->session['userModel']['first_name'].' '.Yii::app()->session['userModel']['last_name'];
					$customer_plot->status = 1;
					$customer_plot->is_special = $_POST['is_special'];
					$customer_plot->blocked = 0;
					$customer_plot->phase_id = Yii::app()->session->get('userModel')['phase_id'];
					if($_FILES['plot']['name']){
						
				        $fileName = time().'_'.$_FILES['plot']['name'];
				        $orig_fileName = $_FILES['plot']['name'];
				        move_uploaded_file($_FILES['plot']['tmp_name'], $uploadFolder.$fileName);
						$customer_plot->agent_cnic = $fileName; 
					}
					$customer_plot->save(false);


					//update plot
					$plot = Plots::model()->findByPk($_POST['plot_id']);
					if($_POST['is_special']){
						$plot->total = $this->getPaymentScheduleTotal($_POST['plot_type'],$_POST['is_special']);
					}
					if($_POST['discount']){
						$plot->discount = $_POST['discount'];
					}
					$plot->status = 1;
					$plot->save(false);

					//plot transaction
					if(isset($_POST['mode_id']) && !empty($_POST['mode_id'][0])){
						foreach($_POST['mode_id'] as $ind => $modes){
								if(!empty($modes)){
									$plot = new CustomerPlotTransactions;
									$plot->customer_id = $customer->id;
									$plot->plot_id = @$customer_plot->id;
									$plot->plot_payment_mode_id = $modes;
									$plot->transaction_number = $_POST['transaction'][$ind];
									$plot->transaction_type = $_POST['transaction_type'][$ind];
									$plot->amount = $_POST['amount'][$ind];
									$plot->transaction_type = 'cash';
									$plot->comment = @$_POST['t_comment'][$ind];
									$plot->createdOn =  @$_POST['t_date'][$ind];
									$plot->createdBy = Yii::app()->session['userModel']['first_name'].' '.Yii::app()->session['userModel']['last_name'];
									$plot->updatedBy = Yii::app()->session['userModel']['first_name'].' '.Yii::app()->session['userModel']['last_name'];
									$plot->status = 1;
									$plot->phase_id = Yii::app()->session->get('userModel')['phase_id'];
									$plot->save(false);
									$transactionNumber = $_POST['transaction'][$ind];
								}
						}

						$cplots = CustomerPlots::model()->findByPk($customer_plot->id);
						$cplots->status = 1;
						$cplots->save(false);
						if(!empty($_POST['discount'])){
							$plot = Plots::model()->findByPk($cplots->plot_id);
							$plot->discount = $_POST['discount'];
							$plot->save(false);
						}

						$plot_number = 'ARC-'.$cplots->plot->block_number.'-'.$cplots->plot->plot_number.', Block No: '.$cplots->plot->block_number.' Plot No:'.$cplots->plot->plot_number;
						$total = array_sum(@$_POST['amount']);
						
					}

					$msg = "Dear ".ucfirst($customer_plot->customer->name).", \nWe’re pleased to inform you that the Plot ".$customer_plot->plot->plot_type.'-'.$customer_plot->plot->plot_number." in Block ".$customer_plot->plot->block_number.", has been booked.\nPlease receive your file from ESSA Housing Head office after 3 working days.\n\nThankyou for choosing Kainat city, for your dream land.\n\nFor any queries and further assistance please call at 021-37440935";
					//@$this->sendSMS($customer_plot->customer->mobile,$msg); 

					Yii::app()->user->setFlash('success','Plot has been booked to customer.');
					$this->redirect(Yii::app()->baseUrl.'/booking');
				}
			} else{
				Yii::app()->user->setFlash('success','Plot has been already be booked to a customer.');
            	$this->redirect(Yii::app()->baseUrl.'/booking');
			}
		} else{
			Yii::app()->user->setFlash('danger','Something went wrong');
            $this->redirect(Yii::app()->baseUrl.'/booking');
		}
	}

	// public function actionAddtransaction($id){
	// 	$phaseId = Yii::app()->session->get('userModel')['phase_id'];
	// 	$booking = CustomerPlots::model()->findByPk($id);
	// 	$sizeId = $booking->plot->size->id;
	// 	if($booking){
	// 		$data['booking'] = $booking;			
	// 		$data['paymentmodes'] = PaymentSchedulePaymentModes::model()->findAll('payment_schedule_id = :id AND plot_type = :type',array(':id'=>$booking->paymentSchedule->id,':type'=>strtolower($booking->plot->plot_type)));
	// 	}
	// 	$criteria = new CDbCriteria();
	// 	$criteria->addCondition("phase_id = $phaseId");
	// 	$criteria->order = "t.transaction_number DESC";

	// 	$data['lastTrans'] = CustomerPlotTransactions::model()->find($criteria);
	// 	$data['extraLastTrans'] = CustomerPlotExtraTransactions::model()->find($criteria);
	// 	$this->render('transaction',$data);
	// }

	public function actionAddtransaction($id){
		$phaseId = Yii::app()->session->get('userModel')['phase_id'];
		$booking = CustomerPlots::model()->findByPk($id);
		$sizeId = $booking->plot->size->id;
		if($booking){
			$data['booking'] = $booking;			
			$paymentmodes = PaymentSchedulePaymentModes::model()->findAll('payment_schedule_id = :id AND plot_type = :type',array(':id'=>$booking->paymentSchedule->id,':type'=>strtolower($booking->plot->plot_type)));
			if($paymentmodes){
				foreach($paymentmodes as $pm){
					$sql = "SELECT SUM(amount) as total  FROM `customer_plot_transactions` WHERE `plot_payment_mode_id` = ".$pm->id." AND plot_id = $id";
					$result = Yii::app()->db->createCommand($sql)->queryRow();
					$data['paymentmodes'][$pm->id]['id'] = $pm->id;
					$data['paymentmodes'][$pm->id]['mode'] = $pm->mode;
					$data['paymentmodes'][$pm->id]['amount'] = $pm->amount;
					$data['paymentmodes'][$pm->id]['total'] = ($result['total'])?$result['total']:0;
				}
			}
		}
		//echo '<pre>';print_r($data['paymentmodes']);exit;
		$criteria = new CDbCriteria();
		$criteria->addCondition("phase_id = $phaseId");
		$criteria->order = "t.transaction_number DESC";

		$data['lastTrans'] = CustomerPlotTransactions::model()->find($criteria);
		$data['extraLastTrans'] = CustomerPlotExtraTransactions::model()->find($criteria);
		$this->render('transaction',$data);
	}

	public function actionAddplantransaction($id){
		$booking = CustomerPlots::model()->findByPk($id);
		if($booking){
			$data['booking'] = CustomerPlots::model()->findByPk($id);
			//$data['paymentmodes'] = PaymentModes::model()->findAll('plot_size_id = :size',array(':size'=>$booking->plot->size_id));
			$data['paymentmodes'] = Extras::model()->findAll();
		}

		$data['lastTrans'] = CustomerPlotExtraTransactions::model()->find(array('order'=>'transaction_number DESC'));
		$this->render('plantransaction',$data);
	}

	public function actionChangeblockedstatus($id){
		$booking = CustomerPlots::model()->findByPk($id);
		if($booking){
			if($booking->blocked==2){
				$booking->blocked = 0;
				$booking->status = 1;
			} else{
				$booking->blocked = 2;
				$booking->status = 1;
				$booking->is_open = 1;
			}
			$booking->save(false);
		}
		Yii::app()->user->setFlash('success','Booking has been Updated');
		$this->redirect(Yii::app()->request->urlReferrer);
	}

	
	public function actionIndex()
	{
		$phaseId = Yii::app()->session->get('userModel')['phase_id'];
		// $params = $_GET;
		// array_shift($params);
		// $params = http_build_query($params);
		$data['paymentSchedules'] = PaymentSchedules::model()->findAll();

		$criteria = new CDbCriteria();
		$criteria->addCondition("t.status != 3 AND t.status != 0 AND t.phase_id = $phaseId");
		$criteria->order = "t.id DESC";
		
		if(array_key_exists('payment', $_GET)){
			$s = $_GET['payment'];
			$data['payment'] = $_GET['payment'];
			$criteria->addCondition("t.is_special = $s");
		}

		if(array_key_exists('flag_status', $_GET)){
			$s = $_GET['flag_status'];
			$data['flag_status'] = $_GET['flag_status'];
			$criteria->addCondition("t.flag_status = $s");
		}

		if(array_key_exists('plot_type', $_GET)){
			$s = $_GET['plot_type'];
			$data['plot_type'] = $_GET['plot_type'];
			$criteria->addCondition("plot.plot_type = $s");
		}
		$data['bookings'] = CustomerPlots::model()->with('plot')->findAll($criteria);

		// if(isset($_GET['payment'])){
		// 	$s = $_GET['payment'];
		// 	$data['payment'] = $_GET['payment'];
		// 	$data['bookings'] = CustomerPlots::model()->with('plot')->findAll("t.status != 3 AND t.status != 0 AND t.is_special = $s AND t.phase_id = $phaseId",array('order'=>'id DESC'));
		// } elseif(isset($_GET['flag_status'])){
		// 	$s = $_GET['flag_status'];
		// 	$data['flag_status'] = $_GET['flag_status'];
		// 	$data['bookings'] = CustomerPlots::model()->with('plot')->findAll("t.status != 3 AND t.status != 0 AND t.flag_status = $s AND t.phase_id = $phaseId",array('order'=>'id DESC'));
		// } else{
		// 	$data['bookings'] = CustomerPlots::model()->with('plot')->findAll("t.status != 3 AND t.status != 0 AND t.blocked = 0 AND t.phase_id = $phaseId",array('order'=>'id DESC'));
		// }

		$this->render('index',$data);
	}

	public function getcharges($id,$number_format=true){
		$booking = CustomerPlots::model()->findByPk($id);
		if($booking){
			if($booking->charge_id == ''){
				$dd = DevelopmentCharges::model()->find(array('order'=>'id DESC'));
				$booking->charge_id = $dd->id;
				$booking->save(false);
			}
			if($number_format){
				return number_format(intval($booking->plot->size->size)*@$booking->charge->charge);	
			} else{
				return intval($booking->plot->size->size)*@$booking->charge->charge;
			}
			
		} else{
			return 0;
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


	

	public function actionViewbooking($id)
	{
		$data['booking'] = CustomerPlots::model()->findByPk($id);
		$data['extra'] = Extras::model()->count();
		if($data['booking']){
			$this->render('view',$data);	
		} else{
			$this->redirect(Yii::app()->baseUrl.'/site/error');
		}
		
	}


	public function actionEditbooking($id)
	{
		$data['paymentSchedules'] = PaymentSchedules::model()->findAll();
		$data['categories'] = PlotCategories::model()->findAll();
		$data['sizes'] = PlotSizes::model()->findAll();
		$data['plots'] = Plots::model()->findAll();
		$data['paymentmodes'] = PaymentModes::model()->findAll('amount = 0');
		$data['booking'] = $booking =  CustomerPlots::model()->findByPk($id);
		$data['paymentmodes'] = PaymentSchedulePaymentModes::model()->findAll('payment_schedule_id = :id AND plot_type = :type',array(':id'=>$booking->paymentSchedule->id,':type'=>strtolower($booking->plot->plot_type)));

		$data['agents'] = Agents::model()->findAll();
		$data['agentDetail'] = Agents::model()->findByPk($booking->agent_id);
		$data['accounts'] = Accounts::model()->findAll();
		$data['charges'] = DevelopmentCharges::model()->findAll();
		$this->render('edit',$data);
	}

	public function getDocument($id,$type){
		$data = CustomerPlotDocuments::model()->find('type=:type AND customer_plot_id = :plot',array(':type'=>$type,':plot'=>$id));
		if($data){
			return $data->file;
		}
	}


	public function actionUpdate(){
		//echo '<pre>';print_r($_POST);exit;
		$uploadFolder = getcwd() . '/uploads/booking/';
		if($_POST['plot_id']){
			$customer_plot = CustomerPlots::model()->findByPk($_POST['id']);
			$customer = Customers::model()->findByPk($customer_plot->customer_id);
			$customer->attributes = $_POST;
			$customer->status = 1;
			$customer->save(false);
			if($customer){
				// if(!isset($_POST['is_special'])){
				// 	$_POST['is_special'] = '';
				// }
				$customer_plot->attributes = $_POST;
				$customer_plot->status = 1;
				$customer_plot->customer_id = $customer->id;
				$customer_plot->updatedBy = Yii::app()->session['userModel']['first_name'].' '.Yii::app()->session['userModel']['last_name'];

				if($_FILES['plot']['name']['pp']){
					$fileName = time().'_'.$_FILES['plot']['name']['pp'];
			        move_uploaded_file($_FILES['plot']['tmp_name']['pp'], $uploadFolder.$fileName);
			        $customer_plot->agent_cnic = $fileName;
				}
				$customer_plot->save(false);

				//update plot
				$plot = Plots::model()->findByPk($_POST['plot_id']);
				if($_POST['discount']){
					$plot->discount = $_POST['discount'];	
				}
				$plot->status = 1;
				$plot->save(false);



				//plot document
				if($_FILES['plot']['name']['documents']){
					foreach($_FILES['plot']['name']['documents'] as $index=>$documents){
						if($documents){
							$fileName = time().'_'.$_FILES['plot']['name']['documents'][$index];
					        $orig_fileName = $_FILES['plot']['name'];
					        move_uploaded_file($_FILES['plot']['tmp_name']['documents'][$index], $uploadFolder.$fileName);
					        $document = CustomerPlotDocuments::model()->find("type = :type AND customer_plot_id = :plot",array(
					        	':type'=>$index,
					        	':plot'=>$_POST['id']
					        ));
					        if($document){
					        	$document->delete();
					        }
					        $cpd = new CustomerPlotDocuments;
							$cpd->customer_plot_id = $_POST['id'];
							$cpd->type = $index;
							$cpd->file = $fileName;
							$cpd->save();
						}
					}
				}

				//plot transaction
				// if(isset($_POST['edit_payment_row'])){
				// 	foreach($_POST['edit_payment_row'] as $ind=>$transID){
				// 		$plotTrans = CustomerPlotTransactions::model()->findByPk($transID);
				// 		if($plotTrans){
				// 			$plotTrans->status = 0;
				// 			$plotTrans->reason = $_POST['reason'][$ind];
				// 			$plotTrans->save(false);
				// 		}
				// 	}
				// }
				
				if(isset($_POST['mode_id'])){
					foreach($_POST['mode_id'] as $ind => $modes){
						$plot = CustomerPlotTransactions::model()->findByPk($_POST['transaction_id'][$ind]);
						if($plot){
							if($_POST['t_reason'][$ind] == ''){
								$plot->customer_id = $customer->id;
								$plot->plot_id = @$customer_plot->id;
								$plot->plot_payment_mode_id = $modes;
								$plot->transaction_number = $_POST['transaction'][$ind];
								$plot->amount = $_POST['amount'][$ind];
								$plot->transaction_type = $_POST['t_type'][$ind];
								$plot->bank = @$_POST['t_bank'][$ind];
								$plot->branch = @$_POST['t_branch'][$ind];
								$plot->comment = @$_POST['t_comment'][$ind];
								$plot->reference_number = @$_POST['t_reference_number'][$ind];
								$plot->createdOn =  @$_POST['t_date'][$ind];
								$plot->phase_id = Yii::app()->session->get('userModel')['phase_id'];
								$plot->updatedBy = Yii::app()->session['userModel']['first_name'].' '.Yii::app()->session['userModel']['last_name'];
								$plot->status = 1;
								$plot->save(false);	
							} else{
								$plot->reason = @$_POST['t_reason'][$ind];
								$plot->status = 0;
								$plot->save(false);
							}
							
						}
					}

					$cplots = CustomerPlots::model()->findByPk($customer_plot->id);
					$cplots->status = 1;
					$cplots->save(false);
				}

				if(isset($_POST['mode_development'])){
					foreach($_POST['mode_development'] as $ind => $modes){
						if(!empty($modes)){
							///$plot = new CustomerPlotTransactions;
							
							$plot = CustomerPlotExtraTransactions::model()->findByPk($_POST['develop_transaction_id'][$ind]);
							if($plot){
								if($_POST['develop_transaction'][$ind] != ''){
									$plot->customer_id = $customer->id;
									$plot->plot_id = @$customer_plot->id;
									$plot->transaction_number = $_POST['develop_transaction'][$ind];
									$plot->amount = $_POST['amount'][$ind];
									$plot->transaction_type = $_POST['t_type'][$ind];
									$plot->bank = @$_POST['t_bank'][$ind];
									$plot->branch = @$_POST['t_branch'][$ind];
									$plot->comment = @$_POST['t_comment'][$ind];
									$plot->reference_number = @$_POST['t_reference_number'][$ind];
									$plot->createdOn =  @$_POST['t_date'][$ind];
									$plot->monthlyDate =  @$_POST['t_monthlyDate'][$ind];
									$plot->phase_id = Yii::app()->session->get('userModel')['phase_id'];
									$plot->updatedBy = Yii::app()->session['userModel']['first_name'].' '.Yii::app()->session['userModel']['last_name'];
									$plot->status = 1;
									$plot->save(false);	
								} else{
									if($plot->delete()){
										$error = '';
										foreach ($plot->getErrors() as $key => $value) {
											$error = $value[0];
										}
										echo json_encode(array('code'=>400,'message'=>$error,'data'=>NULL));
									}
								}
								
							}
							
						}
					}
				}
				Yii::app()->user->setFlash('success','Booking has been Updated');
			}
            $this->redirect(Yii::app()->baseUrl.'/booking/viewbooking/'.$_POST['id']);
		}
	}

	public function Percentage($total,$percentage,$view = 1){
		if($view == 1){
			return number_format((@$percentage / 100) * @$total);
		} else{
			return (@$percentage / 100) * @$total;
		}
		
	}

	public function plotTotal($id,$number_format = true,$is_total = true,$withside = true){
		$plot = Plots::model()->findByPk($id);
		$plotTotal = 0;
		if($is_total){
			$plotTotal += @$plot->total;	
		}

		// if($withside){
		// 	if($plot->is_road_facing == 1){
		// 		$total += $this->Percentage($plot->total,$plot->is_road_facing_amount,0);
		// 	}
		// 	if($plot->is_park_facing == 1){
		// 		$total += $this->Percentage($plot->total,$plot->is_park_facing_amount,0);	
		// 	}
		// 	if($plot->is_corner == 1){
		// 		$total += $this->Percentage($plot->total,$plot->is_corner_amount,0);
		// 	}
		// 	if($plot->is_west_open == 1){
		// 		$total += $this->Percentage($plot->total,$plot->is_west_open_amount,0);
		// 	}
		// }
		// if($number_format){
		// 	return number_format($total);	
		// } else{
		// 	return $total;
		// }

		//$plot = Plots::model()->findByPk($id);
		//$plotTotal = $plot->total;
        
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

        if($number_format){
			return number_format($plotTotal);	
		} else{
			return $plotTotal;
		}
		
	}

	public function plotTotalDiscount($id,$number_format = true){
		$plot = Plots::model()->findByPk($id);
		$totalDiscount = 0;
		if($plot->discount){
			$totalDiscount = $plot->discount;
		}
	
		return number_format($totalDiscount);	

	}

	public function plotDiscount($id,$number_format = true){
		// $plot = Plots::model()->findByPk($id);
		// $totalDiscount = 0;
		
		// $total = $this->plotTotal($id,false,true,false);
		// $totalDiscount = $this->Percentage($total,$plot->discount,0);
		// //$total = $total - $totalDiscount;
		// if($number_format){
		// 	return number_format($totalDiscount);	
		// } else{
		// 	return $totalDiscount;
		// }
		$plot = Plots::model()->findByPk($id);
		$totalDiscount = 0;
		if($plot->discount){
			$totalDiscount = $plot->discount;
		}
		$total = $this->plotTotal($id,false,true,false);
		$totalDiscount = $total - $totalDiscount;
		if($number_format){
			return number_format($totalDiscount);	
		} else{
			return $totalDiscount;
		}
		
	}

	public function actionprintinvoice($id,$last=''){
		$data['booking'] = CustomerPlots::model()->findByPk($id);
		$size_id = $data['booking']->plot->size_id;
		$totalPayment = ($this->plotTotal($data['booking']->plot->id,false) - $this->plotDiscount($data['booking']->plot->id,false));

		$data['totalPayment'] = (( 50 / 100) * @$totalPayment);
		//$data['lastMonthly'] = $data['booking']->customerPlotTransactionsMonthly;
		$data['link'] = Yii::app()->baseUrl.'/booking/viewbooking/'.$id;
		$data['transaction'] = CustomerPlotTransactions::model()->findAll("id > :lastId AND plot_id = $id",array(':lastId'=>$last));
		$data['lastMonthly'] = CustomerPlotTransactions::model()->count("id <= :lastId AND plot_id = $id AND plot_payment_mode_id = 34",array(':lastId'=>$last));
		$paymentmode = [];
		foreach($data['transaction'] as $index=>$transact):
            // $paymentModeInfo = PaymentModes::model()->find('plot_size_id = :id AND mode =:mode',array(':id'=>@$size_id,':mode'=>$transact->plotPaymentMode->mode));
            // if($paymentModeInfo){
            // 	$paymentmode[$transact->plotPaymentMode->id] = $paymentModeInfo->amount;
            // }
        endforeach;
        $data['paymentmode'] = $paymentmode;
        
		$this->renderpartial('printInvoice',$data);
	}


	public function actionprintdevelopmentinvoice($id,$last=''){
		$data['booking'] = CustomerPlots::model()->findByPk($id);
		$size_id = $data['booking']->plot->size_id;
		$totalPayment = ($this->plotTotal($data['booking']->plot->id,false) - $this->plotDiscount($data['booking']->plot->id,false));

		$data['totalPayment'] = (( 50 / 100) * @$totalPayment);
		//$data['lastMonthly'] = $data['booking']->customerPlotTransactionsMonthly;
		$data['link'] = Yii::app()->baseUrl.'/booking/viewbooking/'.$id;
		$data['transaction'] = CustomerPlotExtraTransactions::model()->findAll("id > :lastId AND plot_id = $id",array(':lastId'=>$last));
		$data['lastMonthly'] = CustomerPlotExtraTransactions::model()->count("id <= :lastId AND plot_id = $id",array(':lastId'=>$last));
		$paymentmode = [];
		foreach($data['transaction'] as $index=>$transact):
            $paymentmode['development'] = 0;
        endforeach;
        $data['paymentmode'] = $paymentmode;
        
		$this->renderpartial('printInvoiceDev',$data);
	}


	public function actionprintplaninvoice($id,$last=''){
		$data['booking'] = CustomerPlots::model()->findByPk($id);
		$size_id = $data['booking']->plot->size_id;
		$totalPayment = ($this->plotTotal($data['booking']->plot->id,false) - $this->plotDiscount($data['booking']->plot->id,false));

		$data['totalPayment'] = (( 50 / 100) * @$totalPayment);
		//$data['lastMonthly'] = $data['booking']->customerPlotTransactionsMonthly;
		$data['link'] = Yii::app()->baseUrl.'/booking/viewbooking/'.$id;
		$data['transaction'] = CustomerPlotExtraTransactions::model()->findAll("id > :lastId AND plot_id = $id",array(':lastId'=>$last));
		$data['lastMonthly'] = CustomerPlotExtraTransactions::model()->count("id <= :lastId AND plot_id = $id AND plot_payment_mode_id = 34",array(':lastId'=>$last));
		$paymentmode = [];
		foreach($data['transaction'] as $index=>$transact):
            $paymentModeInfo = Extras::model()->find('mode =:mode',array(':mode'=>$transact->plotPaymentMode->mode));
            if($paymentModeInfo){
            	$paymentmode[$transact->plotPaymentMode->id] = $paymentModeInfo->amount;
            }
        endforeach;
        $data['paymentmode'] = $paymentmode;
        
		$this->renderpartial('printInvoice',$data);
	}

	public function actionSavetransaction(){

		$phaseId = Yii::app()->session->get('userModel')['phase_id'];
		if(isset($_POST['mode'])){
				$checkTr = CustomerPlotTransactions::model()->findAll('phase_id = :phase AND transaction_number = :tr',array(':phase'=>$phaseId,':tr'=>$_POST['transaction'][0]));
				if($checkTr){
					Yii::app()->user->setFlash('error','Duplicate transaction number. Please try again.');
	        		$this->redirect(Yii::app()->baseUrl.'/booking/addtransaction/'.$_POST['plot_id']);
				}
				$amount = '';
				foreach($_POST['mode'] as $ind => $modes){
						$plot = new CustomerPlotTransactions;
						$plot->customer_id = @$_POST['customer_id'];
						$plot->plot_id = @$_POST['plot_id'];
						$plot->plot_payment_mode_id = $modes;
						$plot->transaction_number = $_POST['transaction'][$ind];
						$plot->amount = $_POST['amount'][$ind];
						$plot->monthlyDate = @$_POST['monthlyDate'][$ind];
						$plot->transaction_type = @$_POST['transaction_type'][$ind];
						$plot->reference_number = $_POST['reference_number'][$ind];
						$plot->comment =  @$_POST['comment'];
						$plot->bank =  @$_POST['bank'][$ind];
						$plot->branch =  @$_POST['branch'][$ind];
						$plot->createdOn =  @$_POST['createdOn'];
						$plot->phase_id = $phaseId;
						$plot->createdBy = Yii::app()->session['userModel']['first_name'].' '.Yii::app()->session['userModel']['last_name'];
						$plot->updatedBy = Yii::app()->session['userModel']['first_name'].' '.Yii::app()->session['userModel']['last_name'];
						$plot->status = 1;
						$plot->save(false);
						//$m = PaymentModes::model()->findByPk($modes);
						if($modes=='monthly'){
							$amount = 'Rs. '.array_sum($_POST['amount']).' of '.ucfirst($modes).' Installments '; 	
						} elseif($modes=='booking'){
							$amount .= 'Rs. '.($_POST['amount'][$ind]).' of '.ucfirst($modes).', '; 
						} elseif($modes=='allocation'){
							$amount .= 'Rs. '.($_POST['amount'][$ind]).' of '.ucfirst($modes).', '; 
						} elseif($modes=='confirmation'){
							$amount .= 'Rs. '.($_POST['amount'][$ind]).' of '.ucfirst($modes).', '; 
						} else{
							$amount .= 'Rs. '.$_POST['amount'][$ind].' of '.ucfirst($modes).', '; 
						}
						
						$transactionNumber = $_POST['transaction'][$ind];
				}


				$cplots = CustomerPlots::model()->findByPk($_POST['plot_id']);
				if($cplots->blocked != 2){
					$cplots->status = 1;
					$cplots->blocked = 0;
					$cplots->save(false);	
				} else{
					$cplots->is_open = 1;
					$cplots->save(false);	
				}
				
				
				$total = array_sum(@$_POST['amount']);

				$msg = "Dear ".ucfirst($cplots->customer->name).",\nThankyou for Paying Amount(PKR): ".number_format($total)."/= against your Plot ".$cplots->plot->plot_type."-".$cplots->plot->plot_number." in Block ".$cplots->plot->block_number.".\n\nFor any queries and further assistance please call at 021-37440935";


				//@$this->sendSMS($cplots->customer->mobile,$msg); 
				//another number msg
				// if(!empty($_POST['another_number'])){
				// 	$number2 = $_POST['another_number'];
				// 	@$this->sendSMS($number2,$msg); 
				// }
			//}
			
		}
		
		$l = Yii::app()->baseUrl.'/booking/printinvoice/id/'.$_POST['plot_id'].'/last/'.$_POST['lastTransactionId'];
		$this->redirect($l, array('target'=>'_blank'));
		//Yii::app()->user->setFlash('success','Plot transaction successfully.');
        //$this->redirect(Yii::app()->baseUrl.'/booking/viewbooking/'.$_POST['plot_id']);
	}



	public function actionSaveplantransaction(){

		if(isset($_POST['mode'])){
			$checkTr = CustomerPlotExtraTransactions::model()->findAll('transaction_number = :tr',array(':tr'=>$_POST['transaction'][0]));
			// $q = new CDbCriteria( array(
			//     'condition' => "transaction_number = ':tr'",      // DON'T do it this way!
			//     'params'    => array(':tr' => str_replace(' ', '', $_POST['transaction'][0]))
			// ) );

			//$checkTr = CustomerPlotTransactions::model()->findAll($q); 
			if($checkTr){
				Yii::app()->user->setFlash('error','Duplicate transaction number. Please try again.');
        		$this->redirect(Yii::app()->baseUrl.'/booking/addplantransaction/'.$_POST['plot_id']);
			}
			$amount = '';
			foreach($_POST['mode'] as $ind => $modes){
					$plot = new CustomerPlotExtraTransactions;
					$plot->customer_id = @$_POST['customer_id'];
					$plot->plot_id = @$_POST['plot_id'];
					$plot->plot_payment_mode_id = $modes;
					$plot->transaction_number = $_POST['transaction'][$ind];
					$plot->amount = $_POST['amount'][$ind];
					$plot->monthlyDate = $_POST['monthlyDate'][$ind];
					$plot->transaction_type = @$_POST['transaction_type'];
					$plot->reference_number = $_POST['reference_number'];
					$plot->comment =  @$_POST['comment'];
					$plot->bank =  @$_POST['bank'];
					$plot->branch =  @$_POST['branch'];
					$plot->createdOn =  @$_POST['createdOn'];
					$plot->phase_id = Yii::app()->session->get('userModel')['phase_id'];
					$plot->createdBy = Yii::app()->session['userModel']['first_name'].' '.Yii::app()->session['userModel']['last_name'];
					$plot->updatedBy = Yii::app()->session['userModel']['first_name'].' '.Yii::app()->session['userModel']['last_name'];
					$plot->status = 1;
					$plot->save(false);
			}			
		}
		// $l = Yii::app()->baseUrl.'/booking/printinvoice/id/'.$_POST['plot_id'].'/last/'.$_POST['lastTransactionId'];
		// $this->redirect($l, array('target'=>'_blank'));
		Yii::app()->user->setFlash('success','Plot plan transaction successfully.');
        $this->redirect(Yii::app()->baseUrl.'/booking/viewbooking/'.$_POST['plot_id']);
	}

	public function actionBookingLedger($id)
	{
		$data['booking'] = CustomerPlots::model()->findByPk($id);
		$this->layout = 'ledger';
		$this->render('ledger',$data);
	}
	public function actionChargesLedger($id)
	{
		$data['booking'] = CustomerPlots::model()->findByPk($id);
		$this->layout = 'ledger';
		$this->render('chargerLedger',$data);
	}


	// public function actionGetModeDueDate($booking,$date,$mode){
	// 	$months = $booking->monthlyMonths;
	// 	switch ($mode) {
	// 		case 'booking':
	// 			return date('d M, Y',strtotime(date("Y-m-d", strtotime($date))));
	// 			exit;
	// 			break;
	// 		case 'allocation':
	// 			return date('d M, Y',strtotime(date("Y-m-d", strtotime($date)) . "+1 months"));
	// 			break;
	// 		case 'confirmation':
	// 			return date('d M, Y',strtotime(date("Y-m-d", strtotime($date)) . "+2 months"));
	// 			break;
	// 		case 'monthly':
	// 			return date('d M, Y',strtotime(date("Y-m-d", strtotime($date)) . "+3 months"));
	// 			break;
	// 		case 'demarcation':
	// 			if($months==36){
	// 				$m = 36;
	// 			}
	// 			if($months==40){
	// 				$m = 44;
	// 			}
	// 			if($months==60){
	// 				$m = 59;
	// 			}
	// 			return date('d M, Y',strtotime(date("Y-m-d", strtotime($date)) . "+$m months"));
	// 			break;
	// 		case 'possession':
	// 			if($months==36){
	// 				$m = 36;
	// 			}
	// 			if($months==40){
	// 				$m = 45;
	// 			}
	// 			if($months==60){
	// 				$m = 60;
	// 			}
	// 			return date('d M, Y',strtotime(date("Y-m-d", strtotime($date)) . "+$m months"));
	// 			break;

			
	// 		default:
	// 			return '-';
	// 			break;
	// 	}
	// }

	public function getDateDiff($curDate,$lastDate){
		$curDate = substr($curDate,3);
		$lastDate = substr($lastDate,3);
		$monthArray = array(
			'Jan'=>"01",
			'Feb'=>"02",
			'Mar'=>"03",
			'Apr'=>"04",
			'May'=>"05",
			'Jun'=>"06",
			'Jul'=>"07",
			'Aug'=>"08",
			'Sep'=>"09",
			'Oct'=>"10",
			'Nov'=>"11",
			'Dec'=>"12",
		);
		$curDateExp = explode(', ', $curDate);
		$curDate = '01-'.@$monthArray[@$curDateExp[0]].'-'.@$curDateExp[1];

		$lastDateExp = explode(', ', $lastDate);
		$lastDate = '01-'.@$monthArray[@$lastDateExp[0]].'-'.@$lastDateExp[1];
		

		$d1 = new DateTime($lastDate);
		$d2 = new DateTime($curDate);

		// @link http://www.php.net/manual/en/class.dateinterval.php
		$interval = $d2->diff($d1);

		return $interval->format('%m')+1;
	}


	public function actionGetModeDueDate($booking,$date,$mode,$checkValue=false){
		$months = $booking->monthlyMonths;
		switch ($mode) {
			case 'booking':
				return date('d M, Y',strtotime(date("Y-m-d", strtotime($date))));
				break;
			case 'allocation':
				return date('d M, Y',strtotime(date("Y-m-d", strtotime($date)) . "+0 months"));
				break;
			case 'confirmation':
				return date('d M, Y',strtotime(date("Y-m-d", strtotime($date)) . "+0 months"));
				break;
			case 'monthly':
				if($checkValue || $checkValue==0){
					$checkValue = ($checkValue!=0)?($checkValue + 1):0;
					return date('d M, Y',strtotime(date("Y-m-d", strtotime($date)) . "+$checkValue months"));	
				} else{
					return date('d M, Y',strtotime(date("Y-m-d", strtotime($date)) . "+1 months"));
				}
				break;
			case 'yearly':
				if($checkValue || $checkValue==0){
					$checkValue = ($checkValue!=0)?($checkValue + 1)*6:1*6;
					return date('d M, Y',strtotime(date("Y-m-d", strtotime($date)) . "+$checkValue months"));	
				} else{
					return date('d M, Y',strtotime(date("Y-m-d", strtotime($date)) . "+1 months"));
				}
				break;
			case 'demarcation':
				return date('d M, Y',strtotime(date("Y-m-d", strtotime($date)) . "+0 months"));
				break;
			case 'possession':
				return date('d M, Y',strtotime(date("Y-m-d", strtotime($date)) . "+0 months"));
				break;

			
			default:
				return '-';
				break;
		}
	}


	public function plotExtra($id,$number_format = true,$is_total = true,$withside = true){
		$plot = Plots::model()->findByPk($id);
		$plotTotalExtra = 0;
		$plotTotalOrg = $plot->total;
		if($plot->is_corner == 1){
            $cornerCharger = $this->Percentage($plotTotalOrg,$plot->is_corner_amount,0);
            $plotTotalOrg  = $plotTotalOrg + $cornerCharger;
            $plotTotalExtra += $cornerCharger;
        }

        if($plot->is_park_facing == 1){
            $parkFacing = $this->Percentage($plotTotalOrg,$plot->is_park_facing_amount,0);
            $plotTotalOrg  = $plotTotalOrg + $parkFacing;
            $plotTotalExtra += $parkFacing;
        }

        if($plot->is_west_open == 1){
            $westOpen = $this->Percentage($plotTotalOrg,$plot->is_west_open_amount,0);
            $plotTotalOrg  = $plotTotalOrg + $westOpen;
            $plotTotalExtra += $westOpen;
        }

        if($number_format){
			return number_format($plotTotalExtra);	
		} else{
			return $plotTotalExtra;
		}

	}

	public function actionDublicateinvoice($plot,$transaction){
		$phaseId = Yii::app()->session->get('userModel')['phase_id'];
		$data['transaction'] = CustomerPlotTransactions::model()->findAll("status=1 AND phase_id = $phaseId AND plot_id = $plot AND transaction_number = :key",array(':key'=>$transaction));
		//echo '<pre>';print_r($data);exit;
		$lastId = @$data['transaction'][0]->id;
		$data['lastMonthly'] = CustomerPlotTransactions::model()->count("phase_id = $phaseId AND id < :lastId AND plot_id = $plot AND plot_payment_mode_id = 34",array(':lastId'=>$lastId));
		$data['link'] = Yii::app()->baseUrl.'/booking/viewbooking/'.$plot;
		$data['booking'] = CustomerPlots::model()->findByPk($plot);	
		$this->renderpartial('printInvoice',$data);
	}

	public function actionDublicateextrainvoice($type,$plot,$transaction){
		$data['transaction'] = CustomerPlotExtraTransactions::model()->findAll("plot_id = $plot AND transaction_number LIKE :key",array(':key'=>"%".$transaction."%"));
		$lastId = @$data['transaction'][0]->id;
		$data['lastMonthly'] = CustomerPlotTransactions::model()->count("id < :lastId AND plot_id = $plot AND plot_payment_mode_id = 34",array(':lastId'=>$lastId));
		$data['link'] = Yii::app()->baseUrl.'/booking/viewbooking/'.$plot;
		$data['booking'] = CustomerPlots::model()->findByPk($plot);	
		$data['type'] = $type;
		$this->renderpartial('printExtraInvoice',$data);
	}

	public function actionReportall(){
		$phaseId = Yii::app()->session->get('userModel')['phase_id'];
		$list = array (
	        array('Block #','Plot #','Name','CNIC','Mobile #','Booking Date','Total Amout','Paid Amout','Dealer','Status'),
	    );
      		
      	$bookings = CustomerPlots::model()->findAll("phase_id = $phaseId AND status=1");
        $count = 1;
        foreach($bookings as $booking):
        	$trasferred = 0;
            if($booking->plot->customerPlotTransfers){
                $trasferred = 1;
            }
            $netTotal = intval(@$booking->customerPlotTransactionSum);
            $complete = ($this->plotTotal($booking->plot->id) == number_format($netTotal))?1:0;


	        $list[$count][] = @$booking->plot->block_number;
	        $list[$count][] = @$booking->plot->plot_number;
	        $list[$count][] = @$booking->customer->name;
            $list[$count][] = @$booking->customer->cnic;
            $list[$count][] = @$booking->customer->mobile;
            $list[$count][] = date('d M,o',strtotime(@$booking->createdOn));
            $list[$count][] = 'Rs. '.$this->plotTotal(@$booking->plot->id);
			$list[$count][] = 'Rs. '.number_format(@$booking->customerPlotTransactionSum);
			$list[$count][] = ($booking->agent_id)?$booking->agent->name:'-';
			if($booking->blocked == 2){
				$list[$count][] = 'Blocked / Open';
			} else if($booking->blocked != 1){
                if(empty($booking->customerPlotCancelled)){
                	$list[$count][] = ($booking->status==1)?(($complete==0)?'Booked '.(($trasferred==1)?'(Transferred)':''):'Completed'):'Temporary Booked';
                } else{
                    $list[$count][] = 'Cancelled';
                }
            } else {
                $list[$count][] = 'Blocked';
            }
			$count++;
        endforeach;

		$fp = fopen('allbookings.csv', 'w');
      	foreach ($list as $fields) {
          fputcsv($fp, $fields);
      	}

      	$filename = getcwd().'/allbookings.csv';
      	header("Content-type: text/csv");
		header("Content-disposition: attachment; filename = allbookings.csv");
		readfile($filename);
	}


	public function actionReportalltransaction(){

		$phaseId = Yii::app()->session->get('userModel')['phase_id'];
		$list = array (
	        array('Sr #','Receipt No','Client Name','Block #','Plot #','Size','Status','Total','Date','Transaction','bank','Reference Number'),
	    );
      		
      	//$bookings = CustomerPlotTransactions::model()->with('plotPaymentMode')->findAll(array('select'=>'t.* ,SUM(t.amount) as total,GROUP_CONCAT( payment_modes.mode SEPARATOR ',') as modes','group'=>'t.transaction_number','order'=>'t.transaction_number ASC'));
		$model = new CustomerPlotTransactions;
      	$bookings = $model::model()->findAllBySQL("SELECT * ,SUM(t.amount) as total,GROUP_CONCAT( DISTINCT p.mode ORDER BY p.id SEPARATOR ',') as modes FROM `customer_plot_transactions` t LEFT JOIN payment_modes p ON p.id = t.plot_payment_mode_id  WHERE status = 1 AND phase_id = $phaseId GROUP BY transaction_number ORDER BY `transaction_number` ASC");

        $count = 1;
        foreach($bookings as $tt):
        	$list[$count][] = @$count;
	        $list[$count][] = @$tt->transaction_number;
	        $list[$count][] = @$tt->plot->customer->name;
            $list[$count][] = @$tt->plot->plot->block_number;
	        $list[$count][] = @$tt->plot->plot->plot_number;
	        $list[$count][] = @$tt->plot->plot->size->size;
            $list[$count][] = @$tt->modes;
            $list[$count][] = 'Rs '.@$tt->total;
            $list[$count][] = date('d M,o',strtotime(@$tt->createdOn));
            $list[$count][] = $tt->transaction_type;
            $list[$count][] = ($tt->transaction_type!='cash')?$tt->bank.' - '.$tt->branch:'-';
            $list[$count][] = ($tt->transaction_type!='cash')?$tt->reference_number:'-';
			$count++;
		endforeach;

		$fp = fopen('alltransactions.csv', 'w');
      	foreach ($list as $fields) {
          fputcsv($fp, $fields);
      	}

      	$filename = getcwd().'/alltransactions.csv';
      	header("Content-type: text/csv");
		header("Content-disposition: attachment; filename = alltransactions.csv");
		readfile($filename);
	}



	public function actionReportalldevtransaction(){

		$phaseId = Yii::app()->session->get('userModel')['phase_id'];
		$list = array (
	        array('Sr #','Receipt No','Client Name','Block #','Plot #','Size','Status','Total','Date','Transaction','bank','Reference Number'),
	    );
      		
      	//$bookings = CustomerPlotTransactions::model()->with('plotPaymentMode')->findAll(array('select'=>'t.* ,SUM(t.amount) as total,GROUP_CONCAT( payment_modes.mode SEPARATOR ',') as modes','group'=>'t.transaction_number','order'=>'t.transaction_number ASC'));
		$model = new CustomerPlotExtraTransactions;
      	$bookings = $model::model()->findAllBySQL("SELECT * ,SUM(t.amount) as total FROM `customer_plot_extra_transactions` t  WHERE status = 1 AND phase_id = $phaseId GROUP BY transaction_number ORDER BY `transaction_number` ASC");
      	
        $count = 1;
        foreach($bookings as $tt):
        	$list[$count][] = @$count;
	        $list[$count][] = @$tt->transaction_number;
	        $list[$count][] = @$tt->plot->customer->name;
            $list[$count][] = @$tt->plot->plot->block_number;
	        $list[$count][] = @$tt->plot->plot->plot_number;
	        $list[$count][] = @$tt->plot->plot->size->size;
            $list[$count][] = @$tt->modes;
            $list[$count][] = 'Rs '.@$tt->total;
            $list[$count][] = date('d M,o',strtotime(@$tt->createdOn));
            $list[$count][] = $tt->transaction_type;
            $list[$count][] = ($tt->transaction_type!='cash')?$tt->bank.' - '.$tt->branch:'-';
            $list[$count][] = ($tt->transaction_type!='cash')?$tt->reference_number:'-';
			$count++;
		endforeach;

		$fp = fopen('alldevtransactions.csv', 'w');
      	foreach ($list as $fields) {
          fputcsv($fp, $fields);
      	}

      	$filename = getcwd().'/alldevtransactions.csv';
      	header("Content-type: text/csv");
		header("Content-disposition: attachment; filename = alldevtransactions.csv");
		readfile($filename);
	}

	public function Getplotamountsafter3steps($booking){
		$booking = CustomerPlots::model()->findByPk($booking->id);
		return $booking->customerPlotTransactionSumWithout3;

	}


	public function actionCancel($id){
		$data = array();
		$data['booking'] = $booking = CustomerPlots::model()->findByPk($id);
		$booking = CustomerPlots::model()->findByPk($id);
		$plotTotal = $this->plotTotalCancel($booking->plot->id,false);
		$plotBookingSum = $booking->customerPlotTransactionSum;
		if(!empty(Yii::app()->request->getParam('percentage'))){
			$perc = Yii::app()->request->getParam('percentage');
		} else{
			$perc = 25;
		}
		$plotTotalPercentage = $this->percentage($plotTotal,$perc,0);
		$data['total'] = $this->plotDiscount($booking->plot->id);
		$data['plotBookingSum'] = $plotBookingSum;
		$data['plotTotalPercentage'] = $plotTotalPercentage; 
		
		$this->render('cancel',$data);
	}


	public function actionTransferamount($id,$to){
		$data = array();
		$data['bookings'] = CustomerPlots::model()->findAll('status != 3 AND status != 0');
		$booking = CustomerPlots::model()->findByPk($id);
		$destBooking = CustomerPlots::model()->findByPk($to);
		$data['booking'] = $booking;
		$data['to'] = $to;
		$data['id'] = $id;
		$data['destBooking'] = $destBooking;
		$plotTotal = $this->plotTotalCancel($booking->plot->id,false);
		$plotBookingSum = $booking->customerPlotTransactionSum;
		if(!empty(Yii::app()->request->getParam('percentage'))){
			$perc = Yii::app()->request->getParam('percentage');
		} else{
			$perc = 25;
		}
		$plotTotalPercentage = $this->percentage($plotTotal,$perc,0);
		$data['total'] = $plotTotal;
		$data['plotBookingSum'] = $plotBookingSum;
		$data['plotTotalPercentage'] = $plotTotalPercentage; 
		$data['paymentmodes'] = PaymentModes::model()->findAll('amount = 0');
		if($plotBookingSum >= $plotTotalPercentage){
			$data['almirajPercentage'] = $this->percentage($plotTotal,5,0);
			$data['remainingAmount'] = $this->getplotamountsafter3steps($booking);
			$data['cancelReturn'] = 1;
		} else{
			$data['almirajPercentage'] = 0;
			$data['remainingAmount'] = 0;
			$data['cancelReturn'] = 0;
		} 
		$data['perc'] = $perc;
		$this->render('transferAmount',$data);
	}


	public function actionTransferamountsubmit(){
		$booking = CustomerPlots::model()->findByPk($_POST['source_id']);
		$booking->status = 0;
		$booking->save(false);
		$booking->plot->status = 0;
		$booking->plot->save(false);

		$model = new CustomerPlotCancelled;
		$model->booking_id = $_POST['source_id'];
		$model->account_id = 0;
		$model->amount = 0;
		$model->createdOn = date('Y-m-d');
		$model->save(false);


		$transactionNumbers = array_unique($_POST['transaction']);
		$transactionsOld = [];
		if(!empty($transactionNumbers)){
			foreach($transactionNumbers as $transactionNumber){
				$transactions = CustomerPlotTransactions::model()->find('transaction_number LIKE :key',array(':key'=>"%".$transactionNumber."%"));
				if($transactions){
					$transactionsOld[$transactionNumber] = $transactions->attributes;
					//$transactions->delete();
					$transactions->status = 0;
					$transactions->save(false);
				}
			}
		}
		if($_POST['transaction']){
			foreach($_POST['transaction'] as $index=>$transaction){
				if($_POST['amount'][$index] > 0){
					$plot = new CustomerPlotTransactions;
					$plot->customer_id = @$transactionsOld[$transaction]['customer_id'];
					$plot->plot_id = @$_POST['destination_id'];
					$plot->plot_payment_mode_id = $_POST['mode'][$index];
					$plot->transaction_number = $transaction;
					$plot->amount = $_POST['amount'][$index];
					$plot->monthlyDate = @$transactionsOld[$transaction]['monthlyDate'];
					$plot->transaction_type = @$transactionsOld[$transaction]['transaction_type'];
					$plot->reference_number = @$transactionsOld[$transaction]['reference_number'];
					$plot->comment =  @$transactionsOld[$transaction]['comment'];
					$plot->bank =  @$transactionsOld[$transaction]['bank'];
					$plot->branch =  @$transactionsOld[$transaction]['branch'];
					$plot->createdOn =  @$transactionsOld[$transaction]['createdOn'];
					$plot->createdBy = @$transactionsOld[$transaction]['createdBy'];
					$plot->updatedBy = @$transactionsOld[$transaction]['updatedBy'];
					$plot->status = 1;
					$plot->save(false);	
				}
			}
		}
		echo 'done';
	}


	public function actionCancelsubmit(){
		$cancelledBooking  = CustomerPlotCancelled::model()->find('booking_id = :booking',array(':booking'=>$_POST['booking_id']));
		if(!$cancelledBooking){
			$model = new CustomerPlotCancelled;
			$model->booking_id = $_POST['booking_id'];
			$model->reason = $_POST['reason'].'<br/>Cancelled by '.Yii::app()->session['userModel']['first_name'].' '.Yii::app()->session['userModel']['last_name'];
			$model->amount = $_POST['amount'];
			$model->createdOn = $_POST['cancel_date'];
			$model->save(false);

			$booking = CustomerPlots::model()->findByPk($_POST['booking_id']);
			$booking->plot->status = 0;
			$booking->plot->save(false);

			$booking->status = 0;
			$booking->save(false);
			Yii::app()->user->setFlash('success','Plot cancelled successfully.');
	        $this->redirect(Yii::app()->baseUrl.'/booking/viewbooking/'.$_POST['booking_id']);	
		} else{
			Yii::app()->user->setFlash('danger','Booking already cancelled.');
	        $this->redirect(Yii::app()->baseUrl.'/booking/viewbooking/'.$_POST['booking_id']);
		}
		
	}



	public function actionTransfer($id){
		$data = array();
		$data['booking'] = CustomerPlots::model()->findByPk($id);
		$this->render('transfer',$data);
	}


	public function actionTransfersubmit(){
		$booking = CustomerPlots::model()->findByPk($_POST['booking_id']);
		if($booking){
			$customer = new Customers;
			$customer->attributes = $_POST;
			$customer->status = 1;
			if($customer->save(false)){
				$customer_plot = new CustomerPlots;
				$customer_plot->plot_id = $booking->plot_id;
				$customer_plot->customer_id = $customer->id;
				$customer_plot->createdOn =  @$_POST['createdOn'];
				$customer_plot->status=  1;
				$customer_plot->updatedBy = Yii::app()->session['userModel']['first_name'].' '.Yii::app()->session['userModel']['last_name'];
				$customer_plot->save(false);

				//update plot
				$plot = Plots::model()->findByPk($booking->plot_id);
				$plot->status = 1;
				$plot->save(false);


				//customerPlotTransactions
				if($booking->customerPlotTransactions){
					foreach ($booking->customerPlotTransactions as $key => $value) {
						$customerTran = New CustomerPlotTransactions;
						$customerTran->attributes = $value->attributes;
						$customerTran->customer_id = $customer->id;
						$customerTran->plot_id = $customer_plot->id;
						$customerTran->status = 1;
						$customerTran->save(false);

						//old transaction
						$value->status = 0;
						$value->save(false);
					}
				}

				//customerPlotTransactions
				if($booking->customerPlotExtraTransaction){
					foreach ($booking->customerPlotExtraTransaction as $key => $value) {
						$customerTran = New CustomerPlotExtraTransactions;
						$customerTran->attributes = $value->attributes;
						$customerTran->customer_id = $customer->id;
						$customerTran->plot_id = $customer_plot->id;
						$customerTran->status = 1;
						$customerTran->save(false);

						//old transaction
						$value->status = 0;
						$value->save(false);
					}
				}
				$booking->status = 3;
				$booking->save(false);



				//transfer entry
				$cpt = new CustomerPlotTransfers;
				$cpt->old_customer_id = $booking->customer_id;
				$cpt->new_customer_id = $customer->id;
				$cpt->plot_id = $booking->plot_id;
				$cpt->amount = '10000';
				$cpt->account_id = '';
				$cpt->createdOn = date("Y-m-d");
				$cpt->status = 1;
				$cpt->updatedBy = Yii::app()->session['userModel']['first_name'].' '.Yii::app()->session['userModel']['last_name'];;
				$cpt->save(false);

				Yii::app()->user->setFlash('success','Plot Transfer successfully.');
	        	$this->redirect(Yii::app()->baseUrl.'/booking/viewbooking/'.$customer_plot->id);	
			} else{
				Yii::app()->user->setFlash('danger','Plot Transfer  cancelled.');
	 		    $this->redirect(Yii::app()->baseUrl.'/booking/viewbooking/'.$booking->id);
			}
			
		}
		
	}

	public function actionPlotdetail($id){
		$data = array();
		$data['plot'] = Plots::model()->findByPk($id);
		$criteria = new CDbCriteria();
		$criteria->addCondition('plot_id = :plot');
		$criteria->params = array(':plot' =>$id);				
		$criteria->order = "id DESC";

		$data['booking'] = CustomerPlots::model()->findAll($criteria);
		//echo '<pre>';print_r($data);exit;
		$this->render('viewDetail',$data);
	}


	public function actionPlotdetailJson($id){
		$data = array();
		$data['plot'] = Plots::model()->findByPk($id);
		$criteria = new CDbCriteria();
		$criteria->addCondition('plot_id = :plot');
		$criteria->params = array(':plot' =>$id);				
		$criteria->order = "id ASC";

		$result = [];
		$bookings = CustomerPlots::model()->findAll($criteria);
		foreach($bookings as $booking){
			$result[] = $booking->attributes;
		}
		return json_encode($result);
	}




	public function GetPaymentMode($id){
		$data = PaymentModes::model()->findByPk($id);
		return $data->mode;
	}



	public function actionGetmonths($id,$edit=false){
		$booking = CustomerPlots::model()->findByPk($id);
		$date1 = strtotime(date('Y-m-d',strtotime($booking->createdOn)));
		
		//$date2 = strtotime(date('Y-m-d',strtotime($booking->customerPlotTransactionslast[0]->createdOn)));
		$date2 = strtotime(date('Y-m-d'));

		//echo '<pre>';print_r($date1);exit;

		$total = $this->plotTotal($booking->plot->id,false);
		$cleared = $booking->customerPlotTransactionSum;
		//echo date('Y-m-d',strtotime($booking->createdOn)).'<br/>';
		if($total != $cleared){
			//print_r($booking->customerPlotTransactionslast[0]->createdOn);
		}

		$transactionsNormal = $booking->customerPlotTransactions;
		//$transactionsPenalty = $booking->customerPlotPlanTransactionsPenalty;

		//$transactionsAll = array_merge($transactionsNormal,$transactionsPenalty);

		$dates = [];
		if($transactionsNormal){
			foreach($transactionsNormal as $cp){
				//$dates[] = date('Y-m-d',strtotime($cp->createdOn));
				if($cp->monthlyDate){
					$dates[date('Y-m',strtotime($cp->monthlyDate))]['mode'] = $this->GetPaymentMode($cp->plot_payment_mode_id).''.(($cp->monthlyDate!='')?' ('.$cp->monthlyDate.')':'');
					$dates[date('Y-m',strtotime($cp->monthlyDate))]['modeID'] = $cp->plot_payment_mode_id;
					$dates[date('Y-m',strtotime($cp->monthlyDate))]['transaction'] = (($this->startsWith($cp->transaction_number, '#'))?$cp->transaction_number:'#'.$cp->transaction_number);
					$dates[date('Y-m',strtotime($cp->monthlyDate))]['type'] = $cp->transaction_type;
					$dates[date('Y-m',strtotime($cp->monthlyDate))]['amount'] = ('Rs. '.number_format($cp->amount));
					$dates[date('Y-m',strtotime($cp->monthlyDate))]['date'] = (date('d M,Y',strtotime($cp->monthlyDate)));
					$dates[date('Y-m',strtotime($cp->monthlyDate))]['by'] = $cp->createdBy;
				} elseif(isset($cp->plot_payment_mode)){
					$dates[date('Y-m',strtotime($cp->createdOn))]['mode'] = $cp->plot_payment_mode.''.(($cp->monthlyDate!='')?' ('.$cp->monthlyDate.')':'');
					$dates[date('Y-m',strtotime($cp->createdOn))]['modeID'] = @$cp->plot_payment_mode;
				} else{
					$dates[date('Y-m',strtotime($cp->createdOn))]['mode'] = ($this->GetPaymentMode($cp->plot_payment_mode_id)).''.(($cp->monthlyDate!='')?' ('.$cp->monthlyDate.')':'');	
					$dates[date('Y-m',strtotime($cp->createdOn))]['modeID'] = $cp->plotPaymentMode->id;
				}
				

				$dates[date('Y-m',strtotime($cp->createdOn))]['transaction'] = (($this->startsWith($cp->transaction_number, '#'))?$cp->transaction_number:'#'.$cp->transaction_number);
				$dates[date('Y-m',strtotime($cp->createdOn))]['type'] = $cp->transaction_type;
				$dates[date('Y-m',strtotime($cp->createdOn))]['amount'] = ('Rs. '.number_format($cp->amount));
				$dates[date('Y-m',strtotime($cp->createdOn))]['date'] = (date('d M,Y',strtotime($cp->createdOn)));
				$dates[date('Y-m',strtotime($cp->createdOn))]['by'] = $cp->createdBy;
			}
		}
		//echo '<pre>';
		
		$table = '';
		$amoutPr = 0;
		while ($date1 <= $date2) {
			$datesss = date('Y-m', $date1);
		if(array_key_exists($datesss, $dates)){
		  	//echo date('Y-m', $date1) . "<br/>";	
		  	$table .='<tr>';
                $table .='<td>'.@$dates[$datesss]['mode'].'</td>';
                $table .='<td>'.@$dates[$datesss]['transaction'].'</td>';
                $table .='<td>'.@$dates[$datesss]['type'].'</td>';
                $table .='<td>'.@$dates[$datesss]['amount'].'</td>';
                $table .='<td>'.@$dates[$datesss]['date'].'</td>';
                $table .='<td>'.@$dates[$datesss]['by'].'</td>';
            $table .='</tr>';
            
                $tablePr ='<td>'.@$dates[$datesss]['mode'].'</td>';
                $tablePr .='<td>'.@$dates[$datesss]['transaction'].'</td>';
                $tablePr .='<td>'.@$dates[$datesss]['type'].'</td>';
                $tablePr .='<td>'.@$dates[$datesss]['amount'].'</td>';
                $amoutPr = @$dates[$datesss]['amount'];
                $modePr = @$dates[$datesss]['modeID'];
            
		  } else{
		  	if($edit){
		  		$table .= '<tr style="background-color: #d9534f;color:#fff;font-weight:bold">'.@$tablePr.'<td>'.date('Y-m-10', $date1).'</td><td><input class="form-control numbersOnly" value="0" name="amount[]" placeholder="Penality Amount" autocomplete="off"><input type="hidden" name="penalityValue[]" value="'.$amoutPr.'"/><input type="hidden" name="penalityMode[]" value="'.$modePr.'"/><input type="hidden" name="month[]" value="'.(date('Y-m-10', $date1)).'"/></td></tr>';
		  	} else{
		  		$table .= '<tr style="background-color: #d9534f;color:#fff;font-weight:bold">'.@$tablePr.'<td>'.date('Y-m-10', $date1).'</td><td></td></tr>';
		  	}
		  	
		  }
		  
		  $date1 = strtotime('+1 month', $date1);
		}

		
		$data['tablee'] = $table;
		$data['booking'] = $booking;
		$data['edit'] = $edit;
		$this->render('getMonths',$data);
		
	}

	public function actionsavepenality(){
		$penalities = array_filter($_POST['amount']);

		$result = [];
		if($penalities){
			$i = 0;
			foreach($penalities as $index=>$penality){
				$amountReal = str_replace('Rs. ','',str_replace(',','', $_POST['penalityValue'][$index]));
				$result[$i]['final'] = $penality;
				$result[$i]['month'] = $_POST['month'][$index];
				$result[$i]['penalty'] = $amountReal;
				$result[$i]['modeID'] = $_POST['penalityMode'][$index];
				$i++;
			}
		}
		//echo '<pre>';print_r($result);exit;
		$data['lists'] = $result;
		$data['booking'] = CustomerPlots::model()->findByPk($_POST['booking_id']);
		$data['paymentmodes'] = PaymentModes::model()->findAll('amount = 0');
		$data['lastTrans'] = CustomerPlotTransactions::model()->find(array('order'=>'transaction_number DESC'));
		$criteria = new CDbCriteria();
		$criteria->addCondition('t.plot_payment_mode = :mode');
		$criteria->params = array(':mode'=>'penalty');
		$criteria->order = "t.id DESC";
		$data['extraLastTrans'] = CustomerPlotExtraTransactions::model()->find($criteria);
		$this->render('penaltyInvoice',$data);
	}

	public function actionsavetransactionpenalty(){
		if($_POST['transaction']){
			foreach($_POST['transaction'] as $index=>$transaction){
				$plot = new CustomerPlotExtraTransactions;
				$plot->customer_id = @$_POST['customer_id'];
				$plot->plot_id = @$_POST['plot_id'];
				$plot->plot_payment_mode = $_POST['mode'][$index];
				$plot->transaction_number = $transaction;
				$plot->amount = $_POST['amount'][$index];
				$plot->monthlyDate = @$_POST['month'][$index];
				$plot->transaction_type = @$_POST['transaction_type'];
				$plot->reference_number = @$_POST['reference_number'];
				$plot->comment =  @$_POST['comment'];
				$plot->bank =  @$_POST['bank'];
				$plot->branch =  @$_POST['branch'];
				//$plot->createdOn =  @$_POST['month'][$index];
				$plot->createdOn =  @$_POST['createdOn'];
				$plot->createdBy = @Yii::app()->session['userModel']['first_name'].' '.Yii::app()->session['userModel']['last_name'];
				$plot->updatedBy = @Yii::app()->session['userModel']['first_name'].' '.Yii::app()->session['userModel']['last_name'];
				$plot->status = 1;
				$plot->save(false);
			}
		}
		if(isset($_POST['wantSave']) && $_POST['wantSave']==1){
			if($_POST['normalTransaction']){
				foreach($_POST['normalTransaction']['mode'] as $index=>$transactionMode){
					$plot = new CustomerPlotTransactions;
					$plot->customer_id = @$_POST['customer_id'];
					$plot->plot_id = @$_POST['plot_id'];
					$plot->plot_payment_mode_id = $transactionMode;
					$plot->transaction_number = $_POST['normalTransaction']['transaction'][$index];
					$plot->amount = $_POST['normalTransaction']['amount'][$index];
					$plot->monthlyDate = @$_POST['normalTransaction']['month'][$index];
					$plot->transaction_type = @$_POST['transaction_type'];
					$plot->reference_number = @$_POST['reference_number'];
					$plot->comment =  @$_POST['comment'];
					$plot->bank =  @$_POST['bank'];
					$plot->branch =  @$_POST['branch'];
					$plot->createdOn =  @$_POST['createdOn'];
					$plot->createdBy = @Yii::app()->session['userModel']['first_name'].' '.Yii::app()->session['userModel']['last_name'];
					$plot->updatedBy = @Yii::app()->session['userModel']['first_name'].' '.Yii::app()->session['userModel']['last_name'];
					$plot->status = 1;
					$plot->save(false);
				}
			}	
		}

		//update plot
		$plot = Plots::model()->findByPk($_POST['plot_id']);
		$plot->status = 1;
		$plot->save(false);
		
		Yii::app()->user->setFlash('success','Penalty Add successfully.');
	    $this->redirect(Yii::app()->baseUrl.'/booking/viewbooking/'.$_POST['plot_id']);	
	}


	public function actionLetters()
	{	
		//$data['cancelled'] = CustomerPlotCancelled::model()->findAll(array('group'=>'booking_id'));
		//$data['plots'] = CustomerPlots::model()->findAll();
		
		$data['plots'] = ReminderLetters::model()->findAll(array('order'=>'booking_id  ASC'));
		$this->render('letters',$data);
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