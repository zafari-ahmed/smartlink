<!-- <div class="col-lg-12">
	<div class="col-lg-4 infoDiv"><p>Heading</p></div>
	<div class="col-lg-4 infoDiv"><p>Heading</p></div>
	<div class="col-lg-4 infoDiv"><span class="pull-right"><p>Date</p></span></div>
</div> -->
<?php $netTotalCheck = $this->plotDiscount($booking->plot->id,false) - intval($booking->customerPlotTransactionSum)?>
<?php $plotInfo = $this->actionPlotdetailJson($booking->plot->id);?>


<?php

$plotttt = json_decode($plotInfo);
?>
<div class="col-lg-12">
	<div class="col-lg-4 infoDiv">
        <p style="    text-align: center;"><b>Kainat City</b></p>
        <div class="row">
    		<div class="col-lg-12"><b><PRE class="preClass">CUSTOMER INFORMATION</PRE></b></div>
    		<div class="col-lg-12">
    			<div class="table-responsive">
                    <table class="table table-responsive" style="FONT-SIZE: 12PX;">
                        <tbody>
                            <tr>
                                <td class="tbBold">Booking ID: </td>
                                <td><?php echo $this->getBookingRegNo(@$booking->id)?></td>
                                
                            </tr>
                            <tr>
                                <td class="tbBold">Name: </td>
                                <td><?php echo @$booking->customer->name?></td>
                                
                            </tr>
                            <tr>
                                <td class="tbBold"><?php echo @$booking->agent_name?>: </td>
                                <td><?php echo @$booking->customer->father_husband_name?></td>
                                
                            </tr>
                            <tr>
                                <td class="tbBold">Address: </td>
                                <td style="font-size: 11px"><?php echo @$booking->customer->address?></td>
                            </tr>
                            <tr>
                                <td class="tbBold">Mobile: </td>
                                <td><?php echo @$booking->customer->mobile?></td>
                            </tr>
                            <tr>
                                <td class="tbBold">Off Phone: </td>
                                <td><?php echo @$booking->customer->office?></td>
                            </tr>
                            <tr>
                                <td class="tbBold">CNIC: </td>
                                <td><?php echo @$booking->customer->cnic?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
    		</div>
        </div>
	</div>
	<div class="col-lg-4 infoDiv">
        <p>&nbsp;</p>
        <div class="row">
    		<div class="col-lg-12"><b><PRE class="preClass">PLOT INFORMATION</PRE></b></div>
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table table-responsive" style="FONT-SIZE: 12PX;"> 
                        <tbody>
                            <tr>
                                <td class="tbBold">Computer ID: </td>
                                <td><?php echo @$booking->id?></td>
                                
                            </tr>
                            <tr>
                                <td class="tbBold">Block: </td>
                                <td><?php echo @$booking->plot->block_number?></td>
                                
                            </tr>
                            <tr>
                                <td class="tbBold">Plot : </td>
                                <td><?php echo @$booking->plot->plot_number.'-'.@$booking->plot->plot_type?></td>
                                
                            </tr>
                            <tr>
                                <td class="tbBold">Category: </td>
                                <td><?php echo @$booking->plot->category->name?></td>
                            </tr>
                            <tr>
                                <td class="tbBold">Plot Size : </td>
                                <td><?php echo @$booking->plot->size->size?></td>
                                
                            </tr>
                            <tr>
                                <?php if(count($plotttt) > 1){?>
                                    <td class="tbBold">Booking/Transfer Date: </td>
                                    <td><?php echo date('d M,Y', strtotime(@$plotttt[0]->createdOn)).' / '.date('d M,Y', strtotime(@$booking->createdOn))?></td>
                                    <?php $booking->createdOn = $plotttt[0]->createdOn;?>
                                <?php } else{?>
                                    <td class="tbBold">Booking Date: </td>
                                    <td><?php echo date('d M,Y', strtotime(@$booking->createdOn))?></td>
                                <?php }?>
                            </tr>
                            <tr>
                                <td class="tbBold">File Status: </td>
                                <td><span class="bookingStatus"><?php echo (@$booking->status==1)?(($netTotalCheck>0)?'Booked':'Full Paid <span class="bookingStatus" style="font-size: 9px;">(Land Cost)</span>'):'Pending'?></span></td>
                            </tr>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
	</div>
    <div class="col-lg-4 infoDiv">
        <p><b>Booking Date: <?php echo date('d M,Y' ,strtotime(@$booking->createdOn))?></b></p>
        <div class="row">
            <div class="col-lg-12"><b><PRE class="preClass">COST INFORMATION</PRE></b></div>
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table table-responsive" style="FONT-SIZE: 12PX;">
                        <tbody>

                            
                            <tr>
                                <td class="tbBold">Payment Schedule: </td>
                                <td><span class="bookingStatus"><?php echo @$booking->special->name?></span></td>
                            </tr>
                            <tr>
                                <td class="tbBold">Total: </td>
                                <td><?php echo 'Rs. '.number_format($booking->plot->total)?></td>
                            </tr>
                            <?php if($booking->plot->discount!=0){?>
                            <tr>
                                <td class="tbBold">Discount: </td>
                                <td><?php echo 'Rs. '.number_format($booking->plot->discount)?></td>
                            </tr>
                            
                            <tr>
                                <td class="tbBold">Discounted Total: </td>
                                <td><?php echo 'Rs. '.number_format($booking->plot->total-$booking->plot->discount)?></td>
                            </tr>
                            <?php }?>
                            <tr>
                                <td class="tbBold">Extra: <br/><span style="font-size:08px">
                                    <?php echo ($booking->plot->is_road_facing==1)?'Road Facing, ':''?>
                                    <?php echo ($booking->plot->is_corner==1)?'Corner, ':''?>
                                    <?php echo ($booking->plot->is_park_facing==1)?'Park Facing, ':''?>
                                    <?php echo ($booking->plot->is_west_open==1)?'West Open, ':''?>
                                </span></td>
                                <td><?php //echo 'Rs. '.@$this->plotTotal(@$booking->plot->id,true,false)?></td>
                                
                            </tr>
                            <!-- <tr>
                                <td class="tbBold">Transfer Charges: </td>
                                <td>0<?php //echo @$booking->plot->plot_number?></td>
                            </tr>
                            <tr>
                                <td class="tbBold">Size Difference: </td>
                                <td>0<?php //echo @$booking->plot->plot_number?></td>
                            </tr>
                            <tr>
                                <td class="tbBold">Less Discount: </td>
                                <td>0<?php //echo @$booking->plot->plot_number?></td>
                            </tr> -->
                            <tr>
                                <td class="tbBold">Total: </td>
                                <td><?php echo 'Rs. '.@$this->plotTotal($booking->plot->id,true,true)?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
	<?php /*?>
    <div class="col-lg-4 infoDiv">
        <p><b>Booking Date: <?php echo date('d M,Y' ,strtotime(@$booking->createdOn))?></b></p>
        <div class="row">
    		<div class="col-lg-12"><b><PRE class="preClass">COST INFORMATION</PRE></b></div>
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table table-responsive" style="FONT-SIZE: 12PX;">
                        <tbody>
                            <tr>
                                <td class="tbBold">Plot Amount: </td>
                                <td><?php echo 'Rs. '.@number_format($booking->plot->total)?></td>
                                
                            </tr>
                            <tr>
                                <td class="tbBold">Dev. Amount: </td>
                                <td>0<?php //echo @$booking->plot->plot_number?></td>
                                
                            </tr>
                            <tr>
                                <td class="tbBold">Extra Amount: <br/><span style="font-size:08px">
                                    <?php echo ($booking->plot->is_road_facing==1)?'Road Facing, ':''?>
                                    <?php echo ($booking->plot->is_corner==1)?'Corner, ':''?>
                                    <?php echo ($booking->plot->is_park_facing==1)?'Park Facing, ':''?>
                                    <?php echo ($booking->plot->is_west_open==1)?'West Open, ':''?>
                                </span></td>
                                <td><?php echo 'Rs. '.@$this->plotTotal(@$booking->plot->id,true,false)?></td>
                                
                            </tr>
                            <tr>
                                <td class="tbBold">Transfer Charges: </td>
                                <td>0<?php //echo @$booking->plot->plot_number?></td>
                            </tr>
                            <tr>
                                <td class="tbBold">Size Difference: </td>
                                <td>0<?php //echo @$booking->plot->plot_number?></td>
                            </tr>
                            <tr>
                                <td class="tbBold">Less Discount: </td>
                                <td>0<?php //echo @$booking->plot->plot_number?></td>
                            </tr>
                            <tr>
                                <td class="tbBold">Total: </td>
                                <td><?php echo 'Rs. '.@$this->plotTotal($booking->plot->id,true,true)?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
	</div>
    <?php */?>
    <!-- <div class="col-lg-5 well" style="margin-left: 2%;">a</div>
    <div class="col-lg-5 well" style="position:relative;right: -13%;">b</div> -->
    
    <span class="col-lg-12" style="padding-left: 1%;padding-right: 1%;"><h5 class="heading">Dues Summary</h5></span>
    
    <div class="" >
        <table class="table table-hover dataTable no-footer duesTable" border=2 id="duesTable" style="FONT-SIZE: 11PX;margin-bottom: 0px;"> 
            <thead>
                <tr>
                    <th colspan="2" style="background-color: lightgrey!important;">Payment Mode</th>
                    <th style="background-color: lightgrey!important;">Due Date</th>
                    <th style="background-color: lightgrey!important;">Due Amount</th>
                    <th style="background-color: lightgrey!important;">Received Amount</th>
                    <th style="background-color: lightgrey!important;">Balance Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php if($booking->customerPlotTransactionsTotal){ $total = 0; $balance = 0; $received = 0;?>
                    <?php foreach($booking->customerPlotTransactionsTotal as $index=>$cptotal):?>
                     <tr style="    font-size: 13px;">
                        <td colspan="2"><b>Full Payment</b></td>
                        <td>-</td>
                        <td><?php echo ($index == 0)?('Rs. '.@$this->plotTotal($booking->plot->id,true,true)):'Rs. '.number_format($balance)?></td>
                        <?php $total = ($index == 0)?($total + $this->plotTotal($booking->plot->id,false,true)):($total + 0)?>
                        <td><?php echo 'Rs. '.number_format($cptotal->amount)?></td>
                        <?php $received = $received + $cptotal->amount?>
                        <td><?php echo 'Rs. '.number_format($total-$received)?></td>
                        <?php $balance = $total-$received?>
                    </tr>
                <?php endforeach;?>
                <?php } else {?>
                    <?php $total = 0; $balance = 0; $received = 0;foreach($modes as $mode): $rowBalance = 0;
                    $cpt = CustomerPlotTransactions::model()->findAll('plot_id = :id AND plot_payment_mode_id = :modeid',array(':id'=>$booking->id,':modeid'=>$mode->id)); 
                    $cpDetail = PaymentModes::model()->find('plot_size_id = :id AND lower(mode) = :mode',array(':id'=>$booking->plot->size->id,':mode'=>strtolower($mode->mode)));
                    //$cpDetail = PaymentModes::model()->find('lower(mode) = :mode',array(':mode'=>strtolower($mode->mode)));
                    //print_r($booking->plot->size->id);
                    //print_r($cpDetail);exit;
                    //if($cpt) {?>
                    <tr style="    font-size: 12px;">
                        <td><?php echo @$mode->mode?></td>
                        <?php if(strtolower(@$mode->mode) == 'monthly'){?>
                            <?php if($netTotalCheck > 0){?>
                                <td><?php //echo ( strtolower(@$mode->mode) == 'monthly')? '40 / '.(count($cpt)) .' = '.(40-(count($cpt))) : '' ?></td>
                            <?php } else{?>
                                <td><?php //echo ( strtolower(@$mode->mode) == 'monthly')? '40 ' : '' ?></td>
                            <?php }?>        
                            
                        <?php } else if(strtolower(@$mode->mode) == 'extra'){?>
                            <td><?php echo 'Rs. '.@$this->plotTotal(@$booking->plot->id,true,false)?></td>
                        <?php } else{?>
                            <td></td>
                        <?php } ?>
                        <td><?php echo $this->actionGetModeDueDate(@$booking, @$booking->createdOn,strtolower(@$mode->mode))?></td>
                        <?php 
                            $var_sum = CustomerPlotTransactions::model()->findBySql('select sum(`amount`) as `total` from customer_plot_transactions WHERE plot_id = :id AND plot_payment_mode_id = :modeid', array(':id'=>$booking->id,':modeid'=>$mode->id));
                        ?>
                        <?php if(strtolower(@$mode->mode) == 'monthly'){?>
                            <?php  

                                if($booking->monthlyMonths==36){
                                    $m = 36;
                                }

                                if($booking->monthlyMonths==40){
                                    $m = 40;
                                }
                                if($booking->monthlyMonths==60){
                                    $m = 55;
                                }

                                $Aamount = (($booking->plot->total/2)/$m)

                            ?>
                            <td><?php echo 'Rs. '.number_format(@$Aamount*$m)//(($booking->monthlyMonths)?$booking->monthlyMonths:40))?></td>
                            <?php $total = $total + (@$Aamount*$m);?>
                        <?php } else if(strtolower(@$mode->mode) == 'extra'){?>
                            <td><?php echo 'Rs. '.@$this->plotTotal(@$booking->plot->id,true,false)?></td>
                            <?php $total = $total + $this->plotTotal(@$booking->plot->id,false,false);?>
                        <?php } else{ ?>
                            <td><?php echo ($cpDetail)?'Rs. '.number_format(@$cpDetail->amount):'-' ?></td>
                            <?php $total = $total + @$cpDetail->amount;?>
                        <?php } ?>

                        <td><?php echo ($var_sum->total)?'Rs. '.@number_format(@$var_sum->total):'-';?></td>
                        <?php $received = $received + ((@$var_sum->total)?$var_sum->total:0); ?>
                        
                        <?php if(strtolower(@$mode->mode) == 'monthly'){?>
                            <?php  

                                if($booking->monthlyMonths==36){
                                    $m = 36;
                                }

                                if($booking->monthlyMonths==40){
                                    $m = 40;
                                }
                                if($booking->monthlyMonths==60){
                                    $m = 55;
                                }

                                $Aamount = (($booking->plot->total/2)/$m)

                            ?>

                            <?php $rowBalance = (@$Aamount * $m) - (($var_sum)?$var_sum->total:0);?>
                            <td><?php echo ($cpDetail || $var_sum->total )?'Rs. '.number_format(@$rowBalance):'-'?></td>
                            <?php $balance = $balance + @$rowBalance;?>
                        <?php } else if(strtolower(@$mode->mode) == 'full payment'){?>
                            <?php $rowBalance = @$var_sum->total;?>
                            <td><?php echo ($cpDetail || $var_sum->total )?'Rs. '.number_format(@$rowBalance):'-'?></td>
                            <?php $balance = $balance + @$rowBalance;?>
                        <?php } else if(strtolower(@$mode->mode) == 'extra'){?>
                            <?php $rowBalance = $this->plotTotal(@$booking->plot->id,false,false) - (($var_sum)?$var_sum->total:0);?>
                            <td><?php echo 'Rs. '.number_format($rowBalance)?></td>
                            <?php $balance = $balance + @$rowBalance;?>
                        <?php } else{?>
                            <?php $rowBalance = @$cpDetail->amount - @$var_sum->total;?>
                            <td><?php echo ($cpDetail || $var_sum->total )?'Rs. '.number_format(@$rowBalance):'-'?></td>
                            <?php $balance = $balance + @$rowBalance;?>
                        <?php } ?>
                        
                    </tr> 
                <?php endforeach; }?>
                <!-- <tr style="    font-size: 12px;">
                    <td>Development Charges</td>
                    <td></td>
                    <td>27 Nov,2021</td>
                    <td>Rs. 24,000</td>
                    <td>-</td>
                    <td>Rs. 24,000</td>
                    </tr> -->
                <!--Discount rou-->
                <?php if($this->plotDiscount($booking->plot->id,false)>0){?>
                <tr style="font-size: 12px;">
                        <td>Plot Discount</td>
                        <td><?php echo 'Rs. -'.$this->plotDiscount($booking->plot->id);?></td>
                        <td>-</td>
                        <td>-<?php //echo 'Rs. -'.$this->plotDiscount($booking->plot->id);?></td>
                        <td>-<?php //echo 'Rs. -'.$this->plotDiscount($booking->plot->id);?></td>
                        <td><?php echo 'Rs. -'.$this->plotDiscount($booking->plot->id);?></td>
                        <?php $balance = $balance - $this->plotDiscount($booking->plot->id,false)?>
                    </tr>
                <?php }?>

                <tr class="total" style="background-color: lightgrey!important;color: #000;font-weight: bold;">
                    <td colspan="3" style="background-color: lightgrey!important;"><b>Total</b></td>
                    <td style="background-color: lightgrey!important;"><?php echo 'Rs. '.number_format(@$total)?></td>
                    <td style="background-color: lightgrey!important;"><?php echo 'Rs. '.number_format(@$received)?></td>
                    <td style="background-color: lightgrey!important;"><?php echo 'Rs. '.number_format(@$balance)?></td>                    
                </tr>
            </tbody>
        </table>
    </div>


    <!--<span class="col-lg-12" style="padding-left: 1%;padding-right: 1%;"><h5 class="heading">Development Charges Summary</h5></span>
    
    <div class="" >
        <table class="table table-hover dataTable no-footer duesTable" border=2 id="duesTable" style="FONT-SIZE: 11PX;margin-bottom: 0px;"> 
            <thead>
                <tr>
                    <th colspan="2" style="background-color: lightgrey!important;">Payment Mode</th>
                    <th style="background-color: lightgrey!important;">Due Amount</th>
                    <th style="background-color: lightgrey!important;">Received Amount</th>
                    <th style="background-color: lightgrey!important;">Balance Amount</th>
                </tr>
            </thead>
            <tbody>
                
                <?php /*$total = 0; $balance = 0; $received = 0;$rowBalance = 0;
                    $cpt = CustomerPlotExtraTransactions::model()->findAll('plot_id = :id',array(':id'=>$booking->id)); ?>

                    <?php 
                        $var_sum = CustomerPlotExtraTransactions::model()->findBySql('select sum(`amount`) as `total` from customer_plot_extra_transactions WHERE plot_id = :id', array(':id'=>$booking->id));*/
                    ?>
                    <tr style="    font-size: 12px;">
                        <td>Development</td>
                        <td></td>
                        <td><?php //echo "Rs. ".$this->getCharges($booking->id)?></td>
                        <td><?php //echo "Rs. ".(($var_sum->total > 0)?$var_sum->total:0)?></td>
                        <td><?php //echo "Rs. ".number_format($this->getCharges($booking->id,false)-$var_sum->total)?></td>
                        
                    </tr> 
            </tbody>
        </table>
    </div>-->
    
    <span class="col-lg-12" style="padding-left: 1%;padding-right: 1%;margin-bottom: 0px"><h5 class="heading" >Receipts Detail</h5></span>
    
        <div class="" >
            <table class="table table-hover dataTable no-footer duesTable" style="FONT-SIZE: 11PX;margin-bottom: 0px;">
                <thead>
                    <tr>
                        <th style="background-color: lightgrey!important;">Date</th>
                        <th style="background-color: lightgrey!important;">Receipt No.</th>
                        <th style="background-color: lightgrey!important;">Payment Mode</th>
                        <th style="background-color: lightgrey!important;">Payment Type</th>
                        <th style="background-color: lightgrey!important;">Bank/Branch</th>
                        <th style="background-color: lightgrey!important;">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $exTotal = 0;if($booking->customerPlotTransactions) { foreach($booking->customerPlotTransactions as $cpt):?>
                         <tr style="    font-size: 13px;">
                            <td><?php echo date('d M,Y' ,strtotime(@$cpt->createdOn))?></td>
                            <td><?php echo ($this->startsWith($cpt->transaction_number, '#'))?$cpt->transaction_number:'#'.$cpt->transaction_number?></td>
                            <td><?php echo $cpt->plotPaymentMode->mode?></td>
                            <td><?php echo $cpt->transaction_type?></td>
                            <td><?php echo ($cpt->bank)?$cpt->bank.' / '.$cpt->bank:''?></td>
                            <td><?php echo 'Rs. '.number_format($cpt->amount)?></td>
                            <?php $exTotal = $exTotal + $cpt->amount?> 
                            
                        </tr>
                    <?php endforeach;} ?>
                        <tr class="total" style="background-color: lightgrey!important;color: #000;font-weight: bold;">
                            <td colspan="5" style="background-color: lightgrey!important;">Total</td>
                            <td style="background-color: lightgrey!important;"><?php echo 'Rs. '.number_format($exTotal)?></td>
                        </tr>
                </tbody>
            </table>
        </div>
    </div>
    </div>
</div>