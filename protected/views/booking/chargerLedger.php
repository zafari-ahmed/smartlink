<!-- <div class="col-lg-12">
	<div class="col-lg-4 infoDiv"><p>Heading</p></div>
	<div class="col-lg-4 infoDiv"><p>Heading</p></div>
	<div class="col-lg-4 infoDiv"><span class="pull-right"><p>Date</p></span></div>
</div> -->
<?php $netTotalCheck = ($this->plotTotal($booking->plot->id,false) - intval(@$booking->customerPlotTransactionSum)) - intval($this->plotDiscount($booking->plot->id,false))?>
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
                                <td class="tbBold">File ID: </td>
                                <td><?php echo @$booking->id?></td>
                                
                            </tr>
                            <tr>
                                <td class="tbBold">Name: </td>
                                <td><?php echo @$booking->customer->name?></td>
                                
                            </tr>
                            <tr>
                                <td class="tbBold">S/o, W/o, D/o: </td>
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
        <p style="    text-align: center;"><b>Development Charges</b></p>
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
                                <td class="tbBold">Plot No. : </td>
                                <td><?php echo @$booking->plot->plot_number?></td>
                                
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
                                <td class="tbBold">Booking Date: </td>
                                <td><?php echo date('d M,Y', strtotime(@$booking->createdOn))?></td>
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
    <!-- <div class="col-lg-5 well" style="margin-left: 2%;">a</div>
    <div class="col-lg-5 well" style="position:relative;right: -13%;">b</div> -->
    <?php $modes = PaymentModes::model()->findAll('amount = 0 AND id != 37');?>
    
    <span class="col-lg-12" style="padding-left: 1%;padding-right: 1%;"><h5 class="heading">Dues Summary</h5></span>
    
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
                    <?php $total = 0; $balance = 0; $received = 0;$rowBalance = 0;
                    //$cpt = CustomerPlotTransactions::model()->findAll('plot_id = :id AND plot_payment_mode_id = :modeid',array(':id'=>$booking->id,':modeid'=>$mode->id)); 
                    //$cpDetail = PaymentModes::model()->find('plot_size_id = :id AND lower(mode) = :mode',array(':id'=>$booking->plot->size->id,':mode'=>strtolower($mode->mode)));
                    //if($cpt) {?>
                    <tr style="    font-size: 12px;">
                        <td colspan="2">Development Charges</td>
                        <td><?php echo 'Rs. '.$this->getCharges($booking->id)?></td>
                        <td><?php echo 'Rs. '.number_format(@$booking->customerPlotExtraTransactionSum)?></td>
                        <?php
                            $rem = $this->getCharges($booking->id,false) - $booking->customerPlotExtraTransactionSum;
                        ?>
                        <td><?php echo 'Rs. '.number_format(@$rem)?></td>                        
                    </tr> 
            </tbody>
        </table>
    </div>
    
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
                    <?php $exTotal = 0; if($booking->customerPlotExtraTransaction) { foreach($booking->customerPlotExtraTransaction as $cpt):?>
                         <tr style="    font-size: 13px;">
                            <td><?php echo date('d M,Y' ,strtotime(@$cpt->createdOn))?></td>
                            <td><?php echo ($this->startsWith($cpt->transaction_number, '#'))?$cpt->transaction_number:'#'.$cpt->transaction_number?></td>
                            <td><?php echo $cpt->plot_payment_mode?></td>
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