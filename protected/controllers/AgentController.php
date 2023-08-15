<?php

class AgentController extends Controller
{
	public function actionAdd()
	{
		$data['parents'] = Agents::model()->findAll('parent_id IS NULL');
		$this->render('add',$data);
	}

	public function actionEdit($id)
	{
		$data['parents'] = Agents::model()->findAll('parent_id IS NULL');
		$phaseId = Yii::app()->session->get('userModel')['phase_id'];
		$data['blocks'] = Plots::model()->findAll(array(
            'select'=>'t.block_number',
            'distinct'=>true,
            'condition'=>"phase_id=$phaseId",
        ));
		$data['agent'] = Agents::model()->findByPk($id);
		if($data['agent']){
			$this->render('edit',$data);	
		} else{
			Yii::app()->user->setFlash('error','Something went wrong');
            $this->redirect(Yii::app()->baseUrl.'/agent');
		}
		
	}

	public function actionIndex()
	{
		$data['users'] = Agents::model()->findAll(array('order'=>'parent_id ASC'));
		$this->render('index',$data);		
	}

	public function actionSave()
	{
		if($_POST['name']){
			$Users = new Agents;
			$Users->attributes = $_POST;
			$Users->status = 1;
			$Users->save(false);
			Yii::app()->user->setFlash('success','Agent add successfully.');
            $this->redirect(Yii::app()->baseUrl.'/agent');
		}
	}

	public function actionUpdate()
	{
		//echo '<pre>';print_r($_POST);exit;
		if($_POST['name']){
			$Users = Agents::model()->findByPk($_POST['id']);
			$Users->attributes = $_POST;
			$Users->status = 1;
			$Users->save(false);
			if($_POST['plot_number']){
				//AgentPlots::model()->deleteAll('agent_id = :id',array(':id'=>$_POST['id']));
				foreach($_POST['plot_number'] as $plots){
					if($plots){
						$model = new AgentPlots;
						$model->agent_id = $_POST['id'];
						$model->plot_id = $plots;
						$model->createdOn = date('Y-m-d');
						$model->payment_schedule_id = null;
						$model->discount = 0;
						$model->commission = 0;
						$model->save(false);
					}
				}
			}
			Yii::app()->user->setFlash('success','Agent update successfully.');
            $this->redirect(Yii::app()->baseUrl.'/agent/edit/'.$_POST['id']);
		}
	}

	public function actionDeleteagentplot($id){
		$agentPlot = AgentPlots::model()->findByPk($id);
		if($agentPlot){
			$agentId = $agentPlot->agent_id;
			$agentPlot->delete();
			Yii::app()->user->setFlash('danger','Agent Reserve Plot deleted  successfully.');
        	$this->redirect(Yii::app()->baseUrl.'/agent/edit/'.$agentId);
		} else{
			Yii::app()->user->setFlash('danger','No Any agent reserve plot found');
        	$this->redirect(Yii::app()->request->referrer);
		}
		
		

	}

	public function actionDelete($id){
		if($id){
			$Users = Agents::model()->findByPk($id);
			if($Users->status == 0){
				$Users->status = 1;	
			} else{
				$Users->status = 0;
			}
			$Users->save(false);
			Yii::app()->user->setFlash('success','Agent Update successfully.');
            $this->redirect(Yii::app()->baseUrl.'/agent');
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
        
        if(@$plot->is_corner == 1){
            $cornerCharger = $this->Percentage($plotTotal,$plot->is_corner_amount,0);
            $plotTotal = $plotTotal + $cornerCharger;
        }

        if(@$plot->is_park_facing == 1){
            $parkFacing = $this->Percentage($plotTotal,$plot->is_park_facing_amount,0);
            $plotTotal = $plotTotal + $parkFacing;
        }

        if(@$plot->is_west_open == 1){
            $westOpen = $this->Percentage($plotTotal,$plot->is_west_open_amount,0);
            $plotTotal = $plotTotal + $westOpen;
        }

        if($number_format){
			return number_format($plotTotal);	
		} else{
			return $plotTotal;
		}
		
	}

	public function actionAgentreport($id){
		$agent = Agents::model()->findByPk($id);
		// $list = array (
	    //     array('Agent Name','Agent Parent','Plot #','Agent Total Comission','Agent Paid Comission','Plot Paid Total','Plot Attributes','Status'),
	    // );
	    $list = array (
	        array('Block #','Plot Type','Plot #','Customer Name','Mobile Number','Booking Date','Installment Start Date','Booking','Confirmation','Allocation','Paid Month','Due Months','Due Monthly Amount','Paid Yearly','Due Yearly','Due Yearly Amount','Total Amount Due',"Dealer",'Sub Dealer','Total Comission','Recieved Commission','Balance Commission','Booking Status'),
	    );

	    $count = 1;
        if($agent->agentReserves){ 
        	foreach($agent->agentReserves as $res):
	        	$netTotal = intval(@$res->plot->customerPlots[0]->customerPlotTransactionSum);
		        $list[$count][] = @$res->plot->block_number;
		        $list[$count][] = @$res->plot->plot_type;
		        $list[$count][] = @$res->plot->plot_number;
		        $list[$count][] = @$res->plot->customerPlots[0]->customer->name;
		        $list[$count][] = @$res->plot->customerPlots[0]->customer->mobile;
		        $list[$count][] = date('d M, Y',strtotime(@$res->plot->customerPlots[0]->createdOn));
		        $list[$count][] = date('d M, Y',strtotime(@$res->plot->customerPlots[0]->monthly_start_date));

		        $det = $this->getPlotLedgerDetail2(@$res->plot->customerPlots[0]->id);
				$list[$count][] = @$det['html']['boking'];
				$list[$count][] = @$det['html']['confirmation'];
				$list[$count][] = @$det['html']['allocation'];
				$list[$count][] = $this->getPlotLedgerDetailSingle(@$res->plot->customerPlots[0]->id,'monthly',true);
				$list[$count][] = @$det['html']['months'];
				$list[$count][] = @$det['html']['monthly'];

				$list[$count][] = $this->getPlotLedgerDetailSingle(@$res->plot->customerPlots[0]->id,'yearly',true);
				$list[$count][] = @$det['html']['years'];
				$list[$count][] = @$det['html']['yearly'];
				$list[$count][] = @$det['amount'];

		        $list[$count][] = @$agent->agentParent->name;
				$list[$count][] = @$agent->name;
				$list[$count][] = @$res->plot->customerPlots[0]->agent_percentage;
				$list[$count][] = @$res->plot->customerPlots[0]->agent_commision_sum;
				$list[$count][] = @$res->plot->customerPlots[0]->agent_percentage-@$res->plot->customerPlots[0]->agent_commision_sum;

				$ssta = [];
				if(@$res->plot->customerPlots[0]->customerPlotTransactionSum >= $this->discountedPlotCostOfLand(@$res->plot->id)) {
                $ssta[] = 'Cost of Land Paid';
                }

                if(@$res->plot->customerPlots[0]->customerPlotTransactionSum >= $this->discountedPlotCostOfLandAndExtra($res->plot->id)){
                $ssta[] = 'Plot Total Paid';
               	}

				$list[$count][] = implode(',', $ssta);
		        $count++;
		    endforeach;
		}

	    $fName = 'agentPlotDetails'.date('dMY-h:i').'.csv';
		$fp = fopen($fName, 'w');
      	foreach ($list as $fields) {
          fputcsv($fp, $fields);
      	}

      	$filename = getcwd().'/'.$fName;
      	header("Content-type: text/csv");
		header("Content-disposition: attachment; filename = $fName");
		readfile($filename);

	}

	public function plotExtra($id,$number_format = true,$is_total = true,$withside = true){
		$plot = Plots::model()->findByPk($id);
		$plotTotalExtra = 0;
		$plotTotalOrg = $plot->total;
		if($plot->discount > 0){
			$plotTotalOrg = $plot->total - $plot->discount;	
		}
		
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

	public function getPlotLedgerDetail($id){
		$checkMonth = explode('-',date('M-Y',strtotime(date('Y-m-d')."+0 month")));
		$booking = CustomerPlots::model()->findByPk($id);
		$paymentmodes = PaymentSchedulePaymentModes::model()->findAll('payment_schedule_id = :id AND plot_type = :type',array(':id'=>$booking->paymentSchedule->id,':type'=>strtolower($booking->plot->plot_type)));

		$netTotalCheck = $this->plotDiscount($booking->plot->id,false) - intval($booking->customerPlotTransactionSum);

		$allocationTotal = 0;
		$allocationSum = 0;
		$total = 0; 
		$balance = 0; 
		$received = 0;
		$monthlyCount = 0;
		//echo '<pre>';
		// print_r($booking);
		//print_r($paymentmodes);exit;
		$finalTotal = 0;
		$html = '';
		$final = [];
		foreach($paymentmodes as $modes): $rowBalance = 0;
			
			$cpt = CustomerPlotTransactions::model()->findAll('status = 1 AND plot_id = :id AND plot_payment_mode_id = :modeid',array(':id'=>$booking->id,':modeid'=>$modes->id));
			$var_sum = CustomerPlotTransactions::model()->findBySql('select sum(`amount`) as `total` from customer_plot_transactions WHERE status = 1 AND plot_id = :id AND plot_payment_mode_id = :modeid', array(':id'=>$booking->id,':modeid'=>$modes->id));
			$checkValue = false;
			if($modes->mode=='booking'){
				if($modes->amount != $var_sum->total){
					$divideVal = $modes->amount - $var_sum->total;
			    	//$html .= '<b>'.$this->actionGetModeDueDate(@$booking, @$booking->createdOn,strtolower(@$modes->mode),round($checkValue)).'-->'.$modes->mode.'---->'.floor($divideVal).'</b></br/>';
			    	//break;
			    	$dddd = $this->actionGetModeDueDate(@$booking, @$booking->createdOn,strtolower(@$modes->mode),round($checkValue));
				    $html .= '<p>Booking &nbsp;<b>Total: '.number_format(floor($divideVal),'2','.',',').'</b></p>';
					$finalTotal += number_format(floor($divideVal),'2','.','');
					//break;
				}
			}
			if($modes->mode=='confirmation'){
				if($modes->amount != $var_sum->total){
					$divideVal = $modes->amount - $var_sum->total;
			    	//$html .= '<b>'.$this->actionGetModeDueDate(@$booking, @$booking->createdOn,strtolower(@$modes->mode),round($checkValue)).'-->'.$modes->mode.'---->'.floor($divideVal).'</b></br/>';
			    	//break;
			    	$dddd = $this->actionGetModeDueDate(@$booking, @$booking->createdOn,strtolower(@$modes->mode),round($checkValue));
			    	$html .= '<p>Confirmation &nbsp;<b>Total: '.number_format(floor($divideVal),'2','.',',').'</b></p>';	
			    	$finalTotal += number_format(floor($divideVal),'2','.','');
					//break;
				}
			}
			if($modes->mode=='allocation'){
				if($modes->amount != $var_sum->total){
					$divideVal = $modes->amount - $var_sum->total;
			    	//$html .= '<b>'.$this->actionGetModeDueDate(@$booking, @$booking->createdOn,strtolower(@$modes->mode),round($checkValue)).'-->'.$modes->mode.'---->'.floor($divideVal).'</b></br/>';
			    	//break;
			    	$dddd = $this->actionGetModeDueDate(@$booking, @$booking->createdOn,strtolower(@$modes->mode),round($checkValue));
			    	$html .= '<p>Allocation &nbsp;<b>Total: '.number_format(floor($divideVal),'2','.',',').'</b></p>';
			    	$finalTotal += number_format(floor($divideVal),'2','.','');
			    	//break;
				}
			}
			if($modes->mode=='monthly'){
				if($modes->amount > 0){
					$modes->amount = $modes->amount;
				} else{
					$modes->amount = 1;
				}
			    
			    $divideVal = (($var_sum->total/number_format(($modes->amount/36),'2','.','')));	
			    $floorVal = floor($divideVal);
			    $fractionVal = $divideVal - $floorVal;
			    $checkValue =  floor(($var_sum->total/number_format(($modes->amount/36),'2','.','')));

			    if($checkValue != 36){
				    	if($netTotalCheck > 0){
				        	if($checkValue!=0){
				                $checkValuePaid = $checkValue-1;
				            }
				        }
					$prev = 0;
					if($fractionVal!=0){
						$prev = number_format((1-$fractionVal) * number_format(($modes->amount/36),'2','.',''),'2','.','');
					}
				    $checkValueMonthly = $checkValue-1;
				    $html .= "<p><b>".$this->getDateDiff(date('d M, Y'),date('d M, Y',strtotime(date("Y-m-d", strtotime($booking->monthly_start_date)) . "+$checkValueMonthly months")))."</b>&nbsp;";
				    $monthlyCount = $this->getDateDiff(date('d M, Y'),date('d M, Y',strtotime(date("Y-m-d", strtotime($booking->monthly_start_date)) . "+$checkValueMonthly months")));
				    $ccc = $this->getDateDiff(date('d M, Y'),date('d M, Y',strtotime(date("Y-m-d", strtotime($booking->monthly_start_date)) . "+$checkValueMonthly months")));
				    
				    $ccc = ($prev > 0)?$ccc-1:$ccc;
                    $cccC = ($ccc < 0)?0:$ccc;
				    
				    if($fractionVal!=0){
				        $dueTotal = ((1-$fractionVal) * number_format(($modes->amount/36),'2','.','')) + ($ccc * number_format(($modes->amount/36),'2','.',''));
				    } else{
				    	$dueTotal = number_format($ccc * number_format(($modes->amount/36),'2','.',''),'2','.',',');
				    }
				    $dueTotal = str_replace(',','',$dueTotal);
				    $dueTotal = ($ccc < 0)?0:$dueTotal;
				    //$dddd = $this->actionGetModeDueDate(@$booking, @$booking->monthly_start_date,strtolower(@$modes->mode),round($ccc));
				    //if (strpos($dddd, $checkMonth[0]) !== false && strpos($dddd, $checkMonth[1]) !== false) { 
						if(@$dueTotal){
							$html .= 'Monthly Installment &nbsp;<b>Total: '.number_format($dueTotal,'2','.',',').'</b></p>';	
							$finalTotal += number_format($dueTotal,'2','.','');
						} else{
							$html .= '0';
							$finalTotal += 0;
						}
					//} else{ 
						//$html .= '0';
						//$finalTotal += 0;
					//}
				}
			    /*if($checkValue != 36){ 
                	if($netTotalCheck > 0){
                            if($checkValue!=0){
                                $checkValue = $checkValue-1;
                                //$html .= '<b>Paid Upto: '.date('M, Y',strtotime(date("Y-m-d", strtotime($booking->monthly_start_date)) . "+$checkValue months")).'</b><br/>';
                            }}
                    if($fractionVal!=0){
                    		//$html .= '<b>Previos Balance: '.number_format((1-$fractionVal) * number_format(($modes->amount/36),'2','.',''),'2','.','').'<b></br>';
                    }
                    $checkValueMonthly = $checkValue-1;
                    //$html .= '<b>Due Months '.$this->getDateDiff(date('d M, Y'),date('d M, Y',strtotime(date("Y-m-d", strtotime($booking->monthly_start_date)) . "+$checkValueMonthly months"))).'</b></br>';
                    $ccc = $this->getDateDiff(date('d M, Y'),date('d M, Y',strtotime(date("Y-m-d", strtotime($booking->monthly_start_date)) . "+$checkValueMonthly months")));
                    if($fractionVal!=0){
                        $dueTotal = ((1-$fractionVal) * number_format(($modes->amount/36),'2','.','')) + ($ccc * number_format(($modes->amount/36),'2','.',''));
                        //$html .= '<b>Total: '.number_format($dueTotal,'2','.',',').'</b></br>';
                    }
                    $ce = $checkValue+$ccc;
                    //$html .= '<b>Next Monthly Installment: '.$this->actionGetModeDueDate(@$booking, @$booking->monthly_start_date,strtolower(@$modes->mode),round($ce)).'</b><br/>';
                	//break;
                	$dddd = $this->actionGetModeDueDate(@$booking, @$booking->monthly_start_date,strtolower(@$modes->mode),round($ce));
				    if (strpos($dddd, $checkMonth[0]) !== false && strpos($dddd, $checkMonth[1]) !== false) { 
						if(@$dueTotal){
							$html .= '<p>Monthly Installment</p><br/><b>Total: '.number_format($dueTotal,'2','.',',').'</b></br>';	
							$finalTotal = number_format($dueTotal,'2','.','');
						} else{
							$html .= '0';
							$finalTotal = 0;
						}
					} else{ 
						$html .= '0';
						$finalTotal = 0;
					}

					//break;*/
                //}
			}
			if($modes->mode=='yearly'){
				if($modes->amount > 0){
					$modes->amount = $modes->amount;
				} else{
					$modes->amount = 1;
				}
				$dueTotal = 0;
			    $divideVal = (($var_sum->total/number_format(($modes->amount/6),'2','.','')));
			    $floorVal = floor($divideVal);
			    $fractionVal = $divideVal - $floorVal;
			    $checkValue =  floor(($var_sum->total/number_format(($modes->amount/6),'2','.','')));


			    if($checkValue != 6){
                    if($netTotalCheck > 0){
	                	   if($checkValue!=0){
	                    	    $checkValuee = ($checkValue==1)?1:($checkValue*6)-1;
	                        	//$html .= '<b>Paid Upto: '.date('M, Y',strtotime(date("Y-m-d", strtotime(date('Y-m-d',strtotime(date("Y-m-d", strtotime($booking->monthly_start_date)) . "-1 months")))) . "+$checkValuee months")).'</b><br/>';
	                    }
	                }
	                if($fractionVal!=0){
	                	//$html .= '<b>Previos Balance: '.number_format((1-$fractionVal) * number_format(($modes->amount/6),'2','.',''),'2','.','').'<b></br>';
	                }
	                $checkValuee = ($checkValue==1 && $checkValue==0)?1:($checkValue*6)-1;
	                //$html .= '<b>Due Half Yearly '.floor($this->getDateDiff(date('d M, Y'),date('d M, Y',strtotime(date("Y-m-d", strtotime($booking->monthly_start_date)) . "+$checkValuee months")))/6).'<b></br>';

	                $ccc = floor($this->getDateDiff(date('d M, Y'),date('d M, Y',strtotime(date("Y-m-d", strtotime($booking->monthly_start_date)) . "+$checkValuee months")))/6);

	                
	                $html .= "<p><b>".$ccc."</b>&nbsp;";
	                if($fractionVal!=0){
                        $ccc = $ccc-1;
                        $cccC = ($ccc < 0)?0:$ccc;
                    } else{
                    	$cccC = $ccc;
                    }
	                if($fractionVal!=0){
	                    $dueTotal = ((1-$fractionVal) * number_format(($modes->amount/6),'2','.','')) + ($cccC * number_format(($modes->amount/6),'2','.',''));
	                    //$html .= '<b>Total: '.number_format($dueTotal,'2','.',',').'</b></br>';
	                } else{
	                	$dueTotal = ($cccC * number_format(($modes->amount/6),'2','.',''));
	                }
	                
                    $ce = (($checkValue==1 && $checkValue==0)?1:$checkValue*6)+$ccc;
                    //$html .= '<b>Next Half Yearly: '.$this->actionGetModeDueDate(@$booking, date('Y-m-d',strtotime(date("Y-m-d", strtotime($booking->monthly_start_date)) . "-1 months")),strtolower(@$modes->mode),round($ce)).'</b><br/>';

                    //break;
                    $dddd = $this->actionGetModeDueDate(@$booking, date('Y-m-d',strtotime(date("Y-m-d", strtotime($booking->monthly_start_date)) . "-1 months")),strtolower(@$modes->mode),round($ce));
                    $dueTotal = str_replace(',','',$dueTotal);
				    $dueTotal = ($ccc < 0)?0:$dueTotal;
				    //if (strpos($dddd, $checkMonth[0]) !== false && strpos($dddd, $checkMonth[1]) !== false) { 
						if(@$dueTotal){
							$html .= 'Half Yearly &nbsp;<b>Total: '.number_format($dueTotal,'2','.',',').'</b></p>';
							$finalTotal += number_format($dueTotal,'2','.','');	
						} else{
							$html .= '0';
							$finalTotal += 0;
						}
					//} else{ 
						//$html .= '';
						//$finalTotal += 0;
					//}
					//break;
	            }
			}

			if($modes->mode=='possession'){

			}
		endforeach;
		$final['html'] = $html;
		$final['amount'] = $finalTotal;
		$final['monthlyCount'] = $monthlyCount;
		return $final;
	}

	public function plotDiscount($id,$number_format = true){
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

	public function getDateDiff($curDate,$lastDate){
		$curDate = substr($curDate,3);
		$lastDate = substr($lastDate,3);
		//echo $curDate.''.$lastDate;
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
		//echo $curDate.'----'.$lastDate;
		if(strtotime($curDate) > strtotime($lastDate)){
			$d1 = new DateTime($lastDate);
			$d2 = new DateTime($curDate);
			$interval = $d2->diff($d1);
			//return ($interval->m) + ($interval->y * 12);
			return ($interval->m) + ($interval->y * 12) + (int)(@$interval->d/28);
		} else{
			return 0;
		}		
	}

	public function actionGetModeDueDate($booking,$date,$mode,$checkValue=false){
		$months = $booking->monthlyMonths;
		switch ($mode) {
			case 'booking':
				return date('d M, Y',strtotime(date("Y-m-d", strtotime($date)) . "+7 days"));
				break;
			case 'allocation':
				return date('d M, Y',strtotime(date("Y-m-d", strtotime($date)) . "+67 days"));
				break;
			case 'confirmation':
				return date('d M, Y',strtotime(date("Y-m-d", strtotime($date)) . "+37 days"));
				break;
			case 'monthly':
				if($checkValue || $checkValue==0){
					$checkValue = ($checkValue!=0)?($checkValue + 1):1;
					return date('10 M, Y',strtotime(date("Y-m-d", strtotime($date)) . "+$checkValue months"));	
				} else{
					return date('10 M, Y',strtotime(date("Y-m-d", strtotime($date)) . "+1 months"));
				}
				break;
			case 'yearly':
				if($checkValue || $checkValue==0){
					$checkValue = ($checkValue!=0)?($checkValue+6):1*6;
					return date('d M, Y',strtotime(date("Y-m-d", strtotime($date)) . "+$checkValue months"));	
				} else{
					return date('d M, Y',strtotime(date("Y-m-d", strtotime($date)) . "+6 months"));
				}
				break;
			case 'demarcation':
				return date('d M, Y',strtotime(date("Y-m-d", strtotime($date)) . "+0 months"));
				break;
			case 'possession':
				return '-';//date('d M, Y',strtotime(date("Y-m-d", strtotime($date)) . "+0 months"));
				break;

			case 'bookingMonthly':
				return date('d M, Y',strtotime(date("Y-m-d", strtotime($date)) . "+0 months"));
			break;
			default:
				return '-';
				break;
		}
	}

	public function getPlotLedgerDetailSingle($id,$mode,$csv=false,$invoiceTransactionId = NULL){
		$booking = CustomerPlots::model()->findByPk($id);
		$html = '-';
		if($booking){
			$paymentmodes = PaymentSchedulePaymentModes::model()->findAll('payment_schedule_id = :id AND plot_type = :type',array(':id'=>$booking->paymentSchedule->id,':type'=>strtolower($booking->plot->plot_type)));

			$netTotalCheck = $this->plotDiscount($booking->plot->id,false) - intval($booking->customerPlotTransactionSum);

			$allocationTotal = 0;
			$allocationSum = 0;
			$total = 0; 
			$balance = 0; 
			$received = 0;
			//echo '<pre>';
			// print_r($booking);
			//print_r($paymentmodes);exit;
			$html = '';
			foreach($paymentmodes as $modes): $rowBalance = 0;
				
				$cpt = CustomerPlotTransactions::model()->findAll('status = 1 AND plot_id = :id AND plot_payment_mode_id = :modeid',array(':id'=>$booking->id,':modeid'=>$modes->id));
				$var_sum = CustomerPlotTransactions::model()->findBySql('select sum(`amount`) as `total` from customer_plot_transactions WHERE status = 1 AND plot_id = :id AND plot_payment_mode_id = :modeid', array(':id'=>$booking->id,':modeid'=>$modes->id));

				$checkValue = false;
				if($modes->mode=='booking' && $modes->mode == $mode){
					if($modes->amount != $var_sum->total){
						$divideVal = $modes->amount - $var_sum->total;
				    	$html .= '<b>'.$this->actionGetModeDueDate(@$booking, @$booking->createdOn,strtolower(@$modes->mode),round($checkValue)).'-->'.$modes->mode.'---->'.floor($divideVal).'</b></br/>';break;
					}
				}
				if($modes->mode=='confirmation' && $modes->mode == $mode){
					if($modes->amount != $var_sum->total){
						$divideVal = $modes->amount - $var_sum->total;
				    	$html .= '<b>'.$this->actionGetModeDueDate(@$booking, @$booking->createdOn,strtolower(@$modes->mode),round($checkValue)).'-->'.$modes->mode.'---->'.floor($divideVal).'</b></br/>';break;
					}
				}
				if($modes->mode=='allocation' && $modes->mode == $mode){
					if($modes->amount != $var_sum->total){
						$divideVal = $modes->amount - $var_sum->total;
				    	$html .= '<b>'.$this->actionGetModeDueDate(@$booking, @$booking->createdOn,strtolower(@$modes->mode),round($checkValue)).'-->'.$modes->mode.'---->'.floor($divideVal).'</b></br/>';break;
					}
				}
				if($modes->mode=='monthly' && $modes->mode == $mode){

					if($invoiceTransactionId){
						$var_sum = CustomerPlotTransactions::model()->findBySql('select sum(`amount`) as `total` from customer_plot_transactions WHERE status = 1 AND plot_id = :id AND plot_payment_mode_id = :modeid AND id <= :invoice', array('invoice'=>$invoiceTransactionId,':id'=>$booking->id,':modeid'=>$modes->id));
					} else{
						$var_sum = CustomerPlotTransactions::model()->findBySql('select sum(`amount`) as `total` from customer_plot_transactions WHERE status = 1 AND plot_id = :id AND plot_payment_mode_id = :modeid', array(':id'=>$booking->id,':modeid'=>$modes->id));
					}

					if($modes->amount > 0){
						$modes->amount = $modes->amount;
					} else{
						$modes->amount = 1;
					}

				    $divideVal = (($var_sum->total/number_format(($modes->amount/36),'2','.','')));
				    $floorVal = floor($divideVal);
				    $fractionVal = $divideVal - $floorVal;
				    $checkValue =  floor(($var_sum->total/number_format(($modes->amount/36),'2','.','')));
				    $isDetailShowMonthly = 1;

				    if($var_sum->total >= $modes->amount){
				    	$checkValuePaid = $checkValue-1;
				    	$html .= ' 36 out of 36 Monthly installments, <b>Paid Upto: '.date('M, Y',strtotime(date("Y-m-d", strtotime($booking->monthly_start_date)) . "+$checkValuePaid months")).'</b><br/>';
				    	$isDetailShowMonthly = 0;
				    }
				    if($checkValue != 36 && $isDetailShowMonthly == 1){
	                	if($netTotalCheck > 0){
	                        if($checkValue!=0){
	                            $checkValuePaid = $checkValue-1;
	                            $html .= $checkValue.' out of 36 Monthly installments, <b>Paid Upto: '.date('M, Y',strtotime(date("Y-m-d", strtotime($booking->monthly_start_date)) . "+$checkValuePaid months")).'</b><br/>';
	                        } else{
	                        	$checkValuePaid = $checkValue-1;
	                        	$html .= $checkValue.' out of 36 Monthly installments, <b>Paid Upto: '.date('M, Y',strtotime(date("Y-m-d", strtotime($booking->monthly_start_date)) . "+$checkValuePaid+1 months")).'</b><br/>';
	                        }
	                        if($csv){
	                        	$html = $checkValue;
	                        }
	                    }
	                    break;
	                }
				}
				if($modes->mode=='yearly' && $modes->mode == $mode){
					//$var_sum = CustomerPlotTransactions::model()->findBySql('select sum(`amount`) as `total` from customer_plot_transactions WHERE status = 1 AND plot_id = :id AND plot_payment_mode_id = :modeid AND id <= :invoice', array('invoice'=>$invoiceTransactionId,':id'=>$booking->id,':modeid'=>$modes->id));

					if($invoiceTransactionId){
						$var_sum = CustomerPlotTransactions::model()->findBySql('select sum(`amount`) as `total` from customer_plot_transactions WHERE status = 1 AND plot_id = :id AND plot_payment_mode_id = :modeid AND id <= :invoice', array('invoice'=>$invoiceTransactionId,':id'=>$booking->id,':modeid'=>$modes->id));
					} else{
						$var_sum = CustomerPlotTransactions::model()->findBySql('select sum(`amount`) as `total` from customer_plot_transactions WHERE status = 1 AND plot_id = :id AND plot_payment_mode_id = :modeid', array(':id'=>$booking->id,':modeid'=>$modes->id));
					}

					if($modes->amount>0){
						$divideVal = (($var_sum->total/number_format(($modes->amount/6),'2','.','')));	
					} else{
						$divideVal = (($var_sum->total/1));
					}
				    
				    $floorVal = floor($divideVal);
				    $fractionVal = $divideVal - $floorVal;
				    if($modes->amount>0){
					    $checkValue =  floor(($var_sum->total/number_format(($modes->amount/6),'2','.','')));
					} else{
						$checkValue =  floor(($var_sum->total/1));
					}
				    $isDetailShowYearly = 1;


				    if($var_sum->total >= $modes->amount){
				    	$checkValuePaid = 48;
				    	$html .= ' 6 out of 6 Half Yearly installments, <b>Paid Upto: '.date('M, Y',strtotime(date("Y-m-d", strtotime(date('Y-m-d',strtotime(date("Y-m-d", strtotime($booking->monthly_start_date)) . "-1 months")))) . "+$checkValuePaid months")).'</b><br/>';
				    	$isDetailShowYearly = 0;
				    }
				    if($checkValue != 6 && $isDetailShowYearly == 1){
	                    if($netTotalCheck > 0){

	                        // if($checkValue!=0){
	                        //     //echo $booking->monthly_start_date.'--'.$checkValue;exit;
	                        //     //$checkValuePaid = $checkValue-1;
	                        //     $checkValuePaid = ($checkValue==1)?6:($checkValue*6)-1;
	                        //     $html .= $checkValue.' out of 6 Half Yearly installments, <b>Paid Upto: '.date('M, Y',strtotime(date("Y-m-d", strtotime($booking->monthly_start_date)) . "+$checkValuePaid months")).'</b><br/>';
	                        // } else{
	                        // 	//$checkValuePaid = $checkValue-1;
	                        // 	$checkValuePaid = ($checkValue==1)?6:($checkValue*6)-1;
	                        // 	$html .= $checkValue.' out of 6 Half Yearly installments, <b>Paid Upto: '.date('M, Y',strtotime(date("Y-m-d", strtotime($booking->monthly_start_date)) . "+$checkValuePaid+1 months")).'</b><br/>';
	                        // }
	                        //$checkValuePaid = ($checkValue==1)?6:($checkValue*6)-1;
	                        $checkValuePaid = (($checkValue==1)?6:$checkValue*6);
	                        if($checkValue!=0){
	                        	$ddd = date('M, Y',strtotime(date("Y-m-d", strtotime(date('Y-m-d',strtotime(date("Y-m-d", strtotime($booking->monthly_start_date)) . "-1 months")))) . "+$checkValuePaid months"));
	                        } else{
	                        	$ddd = date('M, Y',strtotime(date("Y-m-d", strtotime(date('Y-m-d',strtotime(date("Y-m-d", strtotime($booking->monthly_start_date)))))) . "+$checkValuePaid months"));
	                        }
	                        $html .= $checkValue.' out of 6 Half Yearly installments, <b>Paid Upto: '.$ddd.'</b><br/>';
	                        
	                        if($csv){
	                        	$html = $checkValue;
	                        }
	                    }
		            }
				}

				if($modes->mode=='possession'){

				}
			endforeach;
		}
		
		return $html;
	}

	public function getPlotLedgerDetail2($id){
		$checkMonth = explode('-',date('M-Y',strtotime(date('Y-m-d')."+0 month")));
		$booking = CustomerPlots::model()->findByPk($id);
		$paymentmodes = PaymentSchedulePaymentModes::model()->findAll('payment_schedule_id = :id AND plot_type = :type',array(':id'=>$booking->paymentSchedule->id,':type'=>strtolower($booking->plot->plot_type)));

		$netTotalCheck = $this->plotDiscount($booking->plot->id,false) - intval($booking->customerPlotTransactionSum);

		$allocationTotal = 0;
		$allocationSum = 0;
		$total = 0; 
		$balance = 0; 
		$received = 0;
		
		$finalTotal = 0;
		$html = [];
		$final = [];
		foreach($paymentmodes as $modes): $rowBalance = 0;
			
			$cpt = CustomerPlotTransactions::model()->findAll('status = 1 AND plot_id = :id AND plot_payment_mode_id = :modeid',array(':id'=>$booking->id,':modeid'=>$modes->id));
			$var_sum = CustomerPlotTransactions::model()->findBySql('select sum(`amount`) as `total` from customer_plot_transactions WHERE status = 1 AND plot_id = :id AND plot_payment_mode_id = :modeid', array(':id'=>$booking->id,':modeid'=>$modes->id));
			$checkValue = false;
			if($modes->mode=='booking'){
				if($modes->amount != $var_sum->total){
					$divideVal = $modes->amount - $var_sum->total;
			    	
			    	$dddd = $this->actionGetModeDueDate(@$booking, @$booking->createdOn,strtolower(@$modes->mode),round($checkValue));
				    $html['boking']= number_format(floor($divideVal),'2','.',',');
					$finalTotal += number_format(floor($divideVal),'2','.','');
				}
			}
			if($modes->mode=='confirmation'){
				if($modes->amount != $var_sum->total){
					$divideVal = $modes->amount - $var_sum->total;
			    	$dddd = $this->actionGetModeDueDate(@$booking, @$booking->createdOn,strtolower(@$modes->mode),round($checkValue));
			    	$html['confirmation'] = number_format(floor($divideVal),'2','.',',');	
			    	$finalTotal += number_format(floor($divideVal),'2','.','');
				}
			}
			if($modes->mode=='allocation'){
				if($modes->amount != $var_sum->total){
					$divideVal = $modes->amount - $var_sum->total;
			    	
			    	$dddd = $this->actionGetModeDueDate(@$booking, @$booking->createdOn,strtolower(@$modes->mode),round($checkValue));
			    	$html['allocation'] = number_format(floor($divideVal),'2','.',',');
			    	$finalTotal += number_format(floor($divideVal),'2','.','');
			    	
				}
			}
			if($modes->mode=='monthly'){
				if($modes->amount > 0){
					$modes->amount = $modes->amount;
				} else{
					$modes->amount = 1;
				}
			    
			    $divideVal = (($var_sum->total/number_format(($modes->amount/36),'2','.','')));	
			    $floorVal = floor($divideVal);
			    $fractionVal = $divideVal - $floorVal;
			    $checkValue =  floor(($var_sum->total/number_format(($modes->amount/36),'2','.','')));

			    if($checkValue != 36){
				    	if($netTotalCheck > 0){
				        	if($checkValue!=0){
				                $checkValuePaid = $checkValue-1;
				            }
				        }
					$prev = 0;
					if($fractionVal!=0){
						$prev = number_format((1-$fractionVal) * number_format(($modes->amount/36),'2','.',''),'2','.','');
					}
				    $checkValueMonthly = $checkValue-1;
				    $html['months']= $this->getDateDiff(date('d M, Y'),date('d M, Y',strtotime(date("Y-m-d", strtotime($booking->monthly_start_date)) . "+$checkValueMonthly months")));
				    $ccc = $this->getDateDiff(date('d M, Y'),date('d M, Y',strtotime(date("Y-m-d", strtotime($booking->monthly_start_date)) . "+$checkValueMonthly months")));
				    
				    $ccc = ($prev > 0)?$ccc-1:$ccc;
                    $cccC = ($ccc < 0)?0:$ccc;
				    
				    if($fractionVal!=0){
				        $dueTotal = ((1-$fractionVal) * number_format(($modes->amount/36),'2','.','')) + ($ccc * number_format(($modes->amount/36),'2','.',''));
				    } else{
				    	$dueTotal = number_format($ccc * number_format(($modes->amount/36),'2','.',''),'2','.',',');
				    }
				    $dueTotal = str_replace(',','',$dueTotal);
				    $dueTotal = ($ccc < 0)?0:$dueTotal;
				    
						if(@$dueTotal){
							$html['monthly'] = number_format($dueTotal,'2','.',',');	
							$html['monthlyAddi'] = number_format($dueTotal,'2','.','');	
							$finalTotal += number_format($dueTotal,'2','.','');
						} else{
							$html['monthly'] = 0;
							$finalTotal += 0;
						}
					
				}
			    
			}
			if($modes->mode=='yearly'){
				if($modes->amount > 0){
					$modes->amount = $modes->amount;
				} else{
					$modes->amount = 1;
				}
				$dueTotal = 0;
			    $divideVal = (($var_sum->total/number_format(($modes->amount/6),'2','.','')));
			    $floorVal = floor($divideVal);
			    $fractionVal = $divideVal - $floorVal;
			    $checkValue =  floor(($var_sum->total/number_format(($modes->amount/6),'2','.','')));


			    if($checkValue != 6){
                    if($netTotalCheck > 0){
	                	   if($checkValue!=0){
	                    	    $checkValuee = ($checkValue==1)?1:($checkValue*6)-1;
	                        	//$html .= '<b>Paid Upto: '.date('M, Y',strtotime(date("Y-m-d", strtotime(date('Y-m-d',strtotime(date("Y-m-d", strtotime($booking->monthly_start_date)) . "-1 months")))) . "+$checkValuee months")).'</b><br/>';
	                    }
	                }
	                if($fractionVal!=0){
	                	//$html .= '<b>Previos Balance: '.number_format((1-$fractionVal) * number_format(($modes->amount/6),'2','.',''),'2','.','').'<b></br>';
	                }
	                $checkValuee = ($checkValue==1 && $checkValue==0)?1:($checkValue*6)-1;
	                //$html .= '<b>Due Half Yearly '.floor($this->getDateDiff(date('d M, Y'),date('d M, Y',strtotime(date("Y-m-d", strtotime($booking->monthly_start_date)) . "+$checkValuee months")))/6).'<b></br>';

	                $ccc = floor($this->getDateDiff(date('d M, Y'),date('d M, Y',strtotime(date("Y-m-d", strtotime($booking->monthly_start_date)) . "+$checkValuee months")))/6);

	                
	                $html['years'] = $ccc;
	                if($fractionVal!=0){
                        $ccc = $ccc-1;
                        $cccC = ($ccc < 0)?0:$ccc;
                    } else{
                    	$cccC = $ccc;
                    }
	                if($fractionVal!=0){
	                    $dueTotal = ((1-$fractionVal) * number_format(($modes->amount/6),'2','.','')) + ($cccC * number_format(($modes->amount/6),'2','.',''));
	                    //$html .= '<b>Total: '.number_format($dueTotal,'2','.',',').'</b></br>';
	                } else{
	                	$dueTotal = ($cccC * number_format(($modes->amount/6),'2','.',''));
	                }
	                
                    $ce = (($checkValue==1 && $checkValue==0)?1:$checkValue*6)+$ccc;
                    //$html .= '<b>Next Half Yearly: '.$this->actionGetModeDueDate(@$booking, date('Y-m-d',strtotime(date("Y-m-d", strtotime($booking->monthly_start_date)) . "-1 months")),strtolower(@$modes->mode),round($ce)).'</b><br/>';

                    //break;
                    $dddd = $this->actionGetModeDueDate(@$booking, date('Y-m-d',strtotime(date("Y-m-d", strtotime($booking->monthly_start_date)) . "-1 months")),strtolower(@$modes->mode),round($ce));
                    $dueTotal = str_replace(',','',$dueTotal);
				    $dueTotal = ($ccc < 0)?0:$dueTotal;
				    //if (strpos($dddd, $checkMonth[0]) !== false && strpos($dddd, $checkMonth[1]) !== false) { 
						if(@$dueTotal){
							$html['yearly'] = number_format($dueTotal,'2','.',',');
							$html['yearlyAddi'] = number_format($dueTotal,'2','.','');	
							$finalTotal += number_format($dueTotal,'2','.','');	
						} else{
							$html['yearly'] = 0;
							$finalTotal += 0;
						}
					//} else{ 
						//$html .= '';
						//$finalTotal += 0;
					//}
					//break;
	            }
			}

			if($modes->mode=='possession'){

			}
		endforeach;
		$final['html'] = $html;
		$final['amount'] = $finalTotal;
		return $final;
	}
}