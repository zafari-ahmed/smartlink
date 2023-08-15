<!-- <div class="col-lg-12">
	<div class="col-lg-4 infoDiv"><p>Heading</p></div>
	<div class="col-lg-4 infoDiv"><p>Heading</p></div>
	<div class="col-lg-4 infoDiv"><span class="pull-right"><p>Date</p></span></div>
</div> -->
<?php $netTotalCheck = $this->plotDiscount($booking->plot->id,false) - intval($booking->customerPlotTransactionSum)?>
<?php //$plotInfo = $this->actionPlotdetailJson($booking->plot->id);?>
<style type="text/css">
    .pagebreak { 
        page-break-before: always; 
    } /* page-break-after works, as well */
    .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th{
        vertical-align: inherit!important;
    }
</style>
<style media="print">
    .btnn{
        display: none;
    }
</style>
<?php
$modes = PaymentSchedulePaymentModes::model()->findAll('payment_schedule_id = :id AND plot_type = :type',array(':id'=>$booking->is_special,':type'=>strtolower($booking->plot->plot_type)));

if($booking->customerpaymentSchedule){
    $modes = CustomPaymentSchedulePaymentModes::model()->findAll('booking_id = :id',array(':id'=>$booking->id));    
}
//$plotttt = json_decode($plotInfo);
?>
<div class="col-lg-12 infoBox">
    <p style="text-align: center;"><b><?php echo Yii::app()->name ?> - Booking Ledger</b><br/><b>Printing Date: <?php echo date('d M,Y')?></b></p>
	<div class="col-lg-4 infoDiv">
        <p style="text-align: center;">&nbsp;</p>
        <div class="row">
    		<div class="col-lg-12"><b><PRE class="preClass">CUSTOMER INFO.</PRE></b></div>
    		<div class="col-lg-12">
    			<div class="table-responsive">
                    <table class="table table-responsive" style="FONT-SIZE: 12PX;">
                        <tbody>
                            <tr>
                                <td class="tbBold">Reg No.: </td>
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
                            <?php /*?>
                            <tr>
                                <td class="tbBold">Address: </td>
                                <td style="font-size: 11px"><?php echo @$booking->customer->address?></td>
                            </tr>
                            <tr>
                                <td class="tbBold">Mobile: </td>
                                <td><?php echo @$booking->customer->mobile?></td>
                            </tr>
                            <!-- <tr>
                                <td class="tbBold">Off Phone: </td>
                                <td><?php //echo @$booking->customer->office?></td>
                            </tr> -->
                            <tr>
                                <td class="tbBold">CNIC: </td>
                                <td><?php echo @$booking->customer->cnic?></td>
                            </tr>
                            <?php */?>
                        </tbody>
                    </table>
                </div>
    		</div>
        </div>
	</div>
	<div class="col-lg-4 infoDiv">
        <p>&nbsp;</p>
        <div class="row">
    		<div class="col-lg-12"><b><PRE class="preClass">PLOT INFO.</PRE></b></div>
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table table-responsive" style="FONT-SIZE: 12PX;"> 
                        <tbody>
                            <tr>
                                <td class="tbBold">Computer ID: </td>
                                <td><?php echo @$booking->id?></td>
                                
                            </tr>
                            <!-- <tr>
                                <td class="tbBold">Block : </td>
                                <td><?php //echo @$booking->plot->block_number?></td>
                                
                            </tr> -->
                            <tr>
                                <td class="tbBold">Plot Detail : </td>
                                <td><?php echo @$booking->plot->block_number.'-'.@$booking->plot->plot_type.'-'.@$booking->plot->plot_number?></td>
                                
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
                                <?php /*if(count($plotttt) > 1){?>
                                    <td class="tbBold">Booking/Transfer Date: </td>
                                    <td><?php echo date('d M,Y', strtotime(@$plotttt[0]->createdOn)).' / '.date('d M,Y', strtotime(@$booking->createdOn))?></td>
                                    <?php $booking->createdOn = $plotttt[0]->createdOn;?>
                                <?php } else{*/?>
                                    <!-- <td class="tbBold">Booking Date: </td>
                                    <td><?php //echo date('d M,Y', strtotime(@$booking->createdOn))?></td> -->
                                <?php //}?>
                            </tr>
                            <tr>
                                <td class="tbBold">File Status: </td>
                                <td><span><?php echo (@$booking->status==1)?(($netTotalCheck>0)?'Booked':'Full Paid <span class="" style="font-size: 9px;">(Land Cost)</span>'):'Pending'?></span><br/>
                                    <?php if($booking->customerPlotTransactionSum >= $this->discountedPlotCostOfLand($booking->plot->id)) {?>
                                    <span class="label label-success" style="text-decoration: none;">Cost of Land Paid</span>
                                    <?php }?>

                                    <?php if($booking->customerPlotTransactionSum >= $this->discountedPlotCostOfLandAndExtra($booking->plot->id)) {?>
                                    <br/><span class="label label-success" style="text-decoration: none;">Plot Total Paid</span>
                                    <?php }?>
                                </td>
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
            <div class="col-lg-12"><b><PRE class="preClass">COST INFO.</PRE></b></div>
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table table-responsive" style="FONT-SIZE: 12PX;">
                        <tbody>

                            
                            <tr>
                                <td class="tbBold">Payment Schedule: </td>
                                <td><span><?php echo @$booking->special->name?></span></td>
                            </tr>
                            <tr>
                                <td class="tbBold">Only Cost of Land: </td>
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
                            <tr class="hide">
                                <td class="tbBold">Extra: <br/><span style="font-size:08px">
                                    <?php echo ($booking->plot->is_road_facing==1)?'Road Facing, ':''?>
                                    <?php echo ($booking->plot->is_corner==1)?'Corner, ':''?>
                                    <?php echo ($booking->plot->is_park_facing==1)?'Park Facing, ':''?>
                                    <?php echo ($booking->plot->is_west_open==1)?'West Open, ':''?>
                                </span></td>
                                <td><?php //echo 'Rs. '.@$this->plotTotal(@$booking->plot->id,true,false)?></td>
                                
                            </tr>
                            <tr class="hide">
                                <td class="tbBold">Total: </td>
                                <td><?php echo 'Rs. '.@$this->plotTotal($booking->plot->id,true,true)?></td>
                            </tr>
                            <tr>
                                <td class="tbBold">Booking Date: </td>
                                <td><?php echo date('d M,Y', strtotime(@$booking->createdOn))?></td>
                            </tr>
                            <tr >
                                <td class="tbBold">Installment Start Date: </td>
                                <td><?php echo date("d M, Y", strtotime($booking->monthly_start_date))?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="col-lg-12 infoBox">
    <div class="col-lg-6 infoDivv">
        <div class="row">
            <div class="col-lg-12"><b><PRE class="preClass">PLOT ATTRIBUTES</PRE></b></div>
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table table-responsive" style="FONT-SIZE: 12PX;">
                        <tbody>
                            <tr>
                                <td class="tbBold">Corner</td>
                                <td><?php echo ($booking->plot->is_corner==1)?'<span class="label label-success" style="text-decoration: none;">YES</span>':'<span class="label label-danger" style="text-decoration: none;">No</span>'?></td>
                                
                            </tr>
                            <tr>
                                <td class="tbBold">Park Facing</td>
                                <td><?php echo ($booking->plot->is_park_facing==1)?'<span class="label label-success" style="text-decoration: none;">YES</span>':'<span class="label label-danger" style="text-decoration: none;">No</span>'?></td>
                                
                            </tr>
                            <tr>
                                <td class="tbBold">West Open</td>
                                <td><?php echo ($booking->plot->is_west_open==1)?'<span class="label label-success" style="text-decoration: none;">YES</span>':'<span class="label label-danger" style="text-decoration: none;">No</span>'?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 infoDivv">
        <div class="row">
            <div class="col-lg-12"><b><PRE class="preClass">PAYMENT BREAKUP (PKR)</PRE></b></div>
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table table-responsive" style="FONT-SIZE: 12PX;">
                        <tbody>
                            <?php if($modes){
                                foreach($modes as $index=>$mode): ?>
                                    <?php
                                        if($mode->mode == 'monthly'){
                                            $mode->mode = 'Monthly (<span class="calc">36x'.(number_format((float)$mode->amount/36, 1, '.', '')).'/=)</span>';
                                            $modeAmount = round($mode->amount);
                                            //echo ucfirst($mode->mode).':'.' <span>'.number_format($modeAmount).'/=</span>, ';    
                                            //echo '<label>'.ucfirst($mode->mode).'&nbsp;&nbsp;&nbsp;<span class="label label-success" style="text-decoration: none;">'.number_format($modeAmount).'/=</span></label><br/>';
                                            echo '<tr><td class="tbBold">'.ucfirst($mode->mode).'</td><td><span class="label label-success" style="text-decoration: none;">'.number_format(round($modeAmount)).'/=</span></td></tr>';
                                        } else if($mode->mode == 'yearly'){
                                            $mode->mode = 'Half Yearly (<span class="calc">6x'.(number_format((float)$mode->amount/6, 1, '.', '')).'/=)</span>';
                                            if($booking->plot->discount > 0) {
                                                $modeAmount = round($mode->amount);
                                                //echo '<label>'.ucfirst($mode->mode).'&nbsp;&nbsp;&nbsp;<span class="label label-success" style="text-decoration: none;">'.number_format($modeAmount).'/=</span></label><br/>';

                                                echo '<tr><td class="tbBold">'.ucfirst($mode->mode).'</td><td><span class="label label-success" style="text-decoration: none;">'.number_format(round($modeAmount)).'/=</span></td></tr>';
                                            } else{
                                                $modeAmount = round($mode->amount);
                                                //echo '<label>'.ucfirst($mode->mode).'&nbsp;&nbsp;&nbsp;<span class="label label-success" style="text-decoration: none;">'.number_format($modeAmount).'/=</span></label><br/>';
                                                echo '<tr><td class="tbBold">'.ucfirst($mode->mode).'</td><td><span class="label label-success" style="text-decoration: none;">'.number_format(round($modeAmount)).'/=</span></td></tr>';
                                            }
                                        } else if($mode->mode == 'possession'){
                                            if($booking->plot->discount > 0) {
                                                $modeAmount = round($mode->amount);
                                                $discount = $booking->plot->discount;
                                                $finalAmount = $modeAmount - $discount;
                                                //echo ucfirst($mode->mode).':'.' <span>'.number_format($finalAmount).'/=</span>, ';    
                                                //echo '<label>'.ucfirst($mode->mode).'&nbsp;&nbsp;&nbsp;<span class="label label-success" style="text-decoration: none;">'.number_format($finalAmount).'/=</span></label><br/>';

                                                echo '<tr><td class="tbBold">'.ucfirst($mode->mode).'</td><td><span class="label label-success" style="text-decoration: none;">'.number_format($finalAmount).'/=</span></td></tr>';
                                            } else{
                                                $modeAmount = round($mode->amount);
                                                //echo ucfirst($mode->mode).':'.' <span>'.number_format($modeAmount).'/=</span>, ';    
                                                echo '<tr><td class="tbBold">'.ucfirst($mode->mode).'</td><td><span class="label label-success" style="text-decoration: none;">'.number_format($modeAmount).'/=</span></td></tr>';
                                            }
                                            
                                        } else{
                                            echo '<tr><td class="tbBold">'.ucfirst($mode->mode).'</td><td><span class="label label-success" style="text-decoration: none;">'.number_format(round($mode->amount)).'/=</span></td></tr>';
                                        }
                                    ?>
                                    
                                    <?php /*?>
                                    if($mode->mode == 'booking'){
                                        echo '<label>'.ucfirst($mode->mode).'&nbsp;&nbsp;&nbsp;<span class="label label-success" style="text-decoration: none;">'.number_format(round($mode->amount)).'/=</span></label><br/>';
                                    //echo ucfirst($mode->mode).':'.' <span>'.number_format(round($mode->amount)).'/=</span>, ';    
                                    }

                                    if($mode->mode == 'confirmation'){
                                        //echo ucfirst($mode->mode).':'.' <span>'.number_format(round($mode->amount)).'/=</span>, ';    
                                        echo '<label>'.ucfirst($mode->mode).'&nbsp;&nbsp;&nbsp;<span class="label label-success" style="text-decoration: none;">'.number_format(round($mode->amount)).'/=</span></label><br/>';
                                    }

                                    if($mode->mode == 'allocation'){
                                        //echo ucfirst($mode->mode).':'.' <span>'.number_format(round($mode->amount)).'/=</span>, ';    
                                        echo '<label>'.ucfirst($mode->mode).'&nbsp;&nbsp;&nbsp;<span class="label label-success" style="text-decoration: none;">'.number_format(round($mode->amount)).'/=</span></label><br/>';
                                    }

                                    if($mode->mode == 'monthly'){
                                        $mode->mode = 'Monthly (<span class="calc">36x'.(number_format((float)$mode->amount/36, 1, '.', '')).'/=)</span>';
                                        $modeAmount = round($mode->amount);
                                        //echo ucfirst($mode->mode).':'.' <span>'.number_format($modeAmount).'/=</span>, ';    
                                        echo '<label>'.ucfirst($mode->mode).'&nbsp;&nbsp;&nbsp;<span class="label label-success" style="text-decoration: none;">'.number_format($modeAmount).'/=</span></label><br/>';
                                    }

                                    if($mode->mode == 'yearly'){
                                        $mode->mode = 'Half Yearly (<span class="calc">6x'.(number_format((float)$mode->amount/6, 1, '.', '')).'/=)</span>';
                                        if($booking->plot->discount > 0) {
                                            $modeAmount = round($mode->amount);
                                            //$discount = $plot->discount;
                                            //$finalAmount = $modeAmount - $discount;
                                            //echo ucfirst($mode->mode).':'.' <span>'.number_format($modeAmount).'/=</span>, ';    
                                            echo '<label>'.ucfirst($mode->mode).'&nbsp;&nbsp;&nbsp;<span class="label label-success" style="text-decoration: none;">'.number_format($modeAmount).'/=</span></label><br/>';
                                        } else{
                                            $modeAmount = round($mode->amount);
                                            //echo ucfirst($mode->mode).':'.' <span>'.number_format($modeAmount).'/=</span>, ';    
                                            echo '<label>'.ucfirst($mode->mode).'&nbsp;&nbsp;&nbsp;<span class="label label-success" style="text-decoration: none;">'.number_format($modeAmount).'/=</span></label><br/>';
                                        }
                                        
                                    }
                                    if($mode->mode == 'possession'){
                                        if($booking->plot->discount > 0) {
                                            $modeAmount = round($mode->amount);
                                            $discount = $booking->plot->discount;
                                            $finalAmount = $modeAmount - $discount;
                                            //echo ucfirst($mode->mode).':'.' <span>'.number_format($finalAmount).'/=</span>, ';    
                                            echo '<label>'.ucfirst($mode->mode).'&nbsp;&nbsp;&nbsp;<span class="label label-success" style="text-decoration: none;">'.number_format($finalAmount).'/=</span></label><br/>';
                                        } else{
                                            $modeAmount = round($mode->amount);
                                            //echo ucfirst($mode->mode).':'.' <span>'.number_format($modeAmount).'/=</span>, ';    
                                            echo '<label>'.ucfirst($mode->mode).'&nbsp;&nbsp;&nbsp;<span class="label label-success" style="text-decoration: none;">'.number_format($modeAmount).'/=</span></label><br/>';
                                        }
                                        
                                    } */
                                    
                                    
                                endforeach;
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12 hide">
        <b>PLOT ATTRIBUTES:</b> <span class="customSpan"><?php //echo number_format($extraCost).'/='?></span><br>
        <span class="customSpan">
        <label>Corner&nbsp;&nbsp;&nbsp;<?php echo ($booking->plot->is_corner==1)?'<span class="label label-success" style="text-decoration: none;">YES</span>':'<span class="label label-danger" style="text-decoration: none;">No</span>'?></label>
        </span>
        <span class="customSpan">
        <label>Park Facing&nbsp;&nbsp;&nbsp;<?php echo ($booking->plot->is_park_facing==1)?'<span class="label label-success" style="text-decoration: none;">YES</span>':'<span class="label label-danger" style="text-decoration: none;">No</span>'?></label>
        </span>

        <span class="customSpan">
        <label>West Open&nbsp;&nbsp;&nbsp;<?php echo ($booking->plot->is_west_open==1)?'<span class="label label-success" style="text-decoration: none;">YES</span>':'<span class="label label-danger" style="text-decoration: none;">No</span>'?></label>
        </span>
    </div>
    <br/><br/>
    <div class="col-lg-12 hide">
        <b>PAYMENT BREAKUP (PKR)</b><br/>
            <?php if($modes){
                foreach($modes as $index=>$mode):
                    
                    if($index==4){
                        echo '<br>';
                    } 

                    if($mode->mode == 'booking'){
                        echo '<label>'.ucfirst($mode->mode).'&nbsp;&nbsp;&nbsp;<span class="label label-success" style="text-decoration: none;">'.number_format(round($mode->amount)).'/=</span></label><br/>';
                    //echo ucfirst($mode->mode).':'.' <span>'.number_format(round($mode->amount)).'/=</span>, ';    
                    }

                    if($mode->mode == 'confirmation'){
                        //echo ucfirst($mode->mode).':'.' <span>'.number_format(round($mode->amount)).'/=</span>, ';    
                        echo '<label>'.ucfirst($mode->mode).'&nbsp;&nbsp;&nbsp;<span class="label label-success" style="text-decoration: none;">'.number_format(round($mode->amount)).'/=</span></label><br/>';
                    }

                    if($mode->mode == 'allocation'){
                        //echo ucfirst($mode->mode).':'.' <span>'.number_format(round($mode->amount)).'/=</span>, ';    
                        echo '<label>'.ucfirst($mode->mode).'&nbsp;&nbsp;&nbsp;<span class="label label-success" style="text-decoration: none;">'.number_format(round($mode->amount)).'/=</span></label><br/>';
                    }

                    if($mode->mode == 'monthly'){
                        $mode->mode = 'Monthly (<span class="calc">36x'.(number_format((float)$mode->amount/36, 1, '.', '')).'/=)</span>';
                        $modeAmount = round($mode->amount);
                        //echo ucfirst($mode->mode).':'.' <span>'.number_format($modeAmount).'/=</span>, ';    
                        echo '<label>'.ucfirst($mode->mode).'&nbsp;&nbsp;&nbsp;<span class="label label-success" style="text-decoration: none;">'.number_format($modeAmount).'/=</span></label><br/>';
                    }

                    if($mode->mode == 'yearly'){
                        $mode->mode = 'Half Yearly (<span class="calc">6x'.(number_format((float)$mode->amount/6, 1, '.', '')).'/=)</span>';
                        if($booking->plot->discount > 0) {
                            $modeAmount = round($mode->amount);
                            //$discount = $plot->discount;
                            //$finalAmount = $modeAmount - $discount;
                            //echo ucfirst($mode->mode).':'.' <span>'.number_format($modeAmount).'/=</span>, ';    
                            echo '<label>'.ucfirst($mode->mode).'&nbsp;&nbsp;&nbsp;<span class="label label-success" style="text-decoration: none;">'.number_format($modeAmount).'/=</span></label><br/>';
                        } else{
                            $modeAmount = round($mode->amount);
                            //echo ucfirst($mode->mode).':'.' <span>'.number_format($modeAmount).'/=</span>, ';    
                            echo '<label>'.ucfirst($mode->mode).'&nbsp;&nbsp;&nbsp;<span class="label label-success" style="text-decoration: none;">'.number_format($modeAmount).'/=</span></label><br/>';
                        }
                        
                    }
                    if($mode->mode == 'possession'){
                        if($booking->plot->discount > 0) {
                            $modeAmount = round($mode->amount);
                            $discount = $booking->plot->discount;
                            $finalAmount = $modeAmount - $discount;
                            //echo ucfirst($mode->mode).':'.' <span>'.number_format($finalAmount).'/=</span>, ';    
                            echo '<label>'.ucfirst($mode->mode).'&nbsp;&nbsp;&nbsp;<span class="label label-success" style="text-decoration: none;">'.number_format($finalAmount).'/=</span></label><br/>';
                        } else{
                            $modeAmount = round($mode->amount);
                            //echo ucfirst($mode->mode).':'.' <span>'.number_format($modeAmount).'/=</span>, ';    
                            echo '<label>'.ucfirst($mode->mode).'&nbsp;&nbsp;&nbsp;<span class="label label-success" style="text-decoration: none;">'.number_format($modeAmount).'/=</span></label><br/>';
                        }
                        
                    } 
                    
                    
                endforeach;
            } ?>
    </div>
</div>

<div class="pagebreak"></div>
<br/>
<div class="col-lg-12 infoBox">
    <p style="text-align: center;"><b><?php echo Yii::app()->name ?> - Booking Ledger</b><br/><b>Printing Date: <?php echo date('d M,Y')?></b><span class="btnn" style="float:right;"><a target="_blank" href="<?php echo Yii::app()->baseUrl?>/booking/bookingledger/<?php echo $booking->id?>?type=dues"><span class="label label-success" style="text-decoration: none;font-size: 15px;">Print</span></a></span></p>
    <div class="col-lg-4 infoDiv">
        <p style="text-align: center;">&nbsp;</p>
        <div class="row">
            <div class="col-lg-12"><b><PRE class="preClass">CUSTOMER INFO.</PRE></b></div>
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table table-responsive" style="FONT-SIZE: 12PX;">
                        <tbody>
                            <tr>
                                <td class="tbBold">Reg No.: </td>
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
                            <?php /*?>
                            <tr>
                                <td class="tbBold">Address: </td>
                                <td style="font-size: 11px"><?php echo @$booking->customer->address?></td>
                            </tr>
                            <tr>
                                <td class="tbBold">Mobile: </td>
                                <td><?php echo @$booking->customer->mobile?></td>
                            </tr>
                            <!-- <tr>
                                <td class="tbBold">Off Phone: </td>
                                <td><?php //echo @$booking->customer->office?></td>
                            </tr> -->
                            <tr>
                                <td class="tbBold">CNIC: </td>
                                <td><?php echo @$booking->customer->cnic?></td>
                            </tr>
                            <?php */?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 infoDiv">
        <p>&nbsp;</p>
        <div class="row">
            <div class="col-lg-12"><b><PRE class="preClass">PLOT INFO.</PRE></b></div>
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table table-responsive" style="FONT-SIZE: 12PX;"> 
                        <tbody>
                            <tr>
                                <td class="tbBold">Computer ID: </td>
                                <td><?php echo @$booking->id?></td>
                                
                            </tr>
                            <!-- <tr>
                                <td class="tbBold">Block : </td>
                                <td><?php //echo @$booking->plot->block_number?></td>
                                
                            </tr> -->
                            <tr>
                                <td class="tbBold">Plot Detail : </td>
                                <td><?php echo @$booking->plot->block_number.'-'.@$booking->plot->plot_type.'-'.@$booking->plot->plot_number?></td>
                                
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
                                <?php /*if(count($plotttt) > 1){?>
                                    <td class="tbBold">Booking/Transfer Date: </td>
                                    <td><?php echo date('d M,Y', strtotime(@$plotttt[0]->createdOn)).' / '.date('d M,Y', strtotime(@$booking->createdOn))?></td>
                                    <?php $booking->createdOn = $plotttt[0]->createdOn;?>
                                <?php } else{*/?>
                                    <!-- <td class="tbBold">Booking Date: </td>
                                    <td><?php //echo date('d M,Y', strtotime(@$booking->createdOn))?></td> -->
                                <?php //}?>
                            </tr>
                            <tr>
                                <td class="tbBold">File Status: </td>
                                <td><span><?php echo (@$booking->status==1)?(($netTotalCheck>0)?'Booked':'Full Paid <span class="" style="font-size: 9px;">(Land Cost)</span>'):'Pending'?></span><br/>
                                    <?php if($booking->customerPlotTransactionSum >= $this->discountedPlotCostOfLand($booking->plot->id)) {?>
                                    <span class="label label-success" style="text-decoration: none;">Cost of Land Paid</span>
                                    <?php }?>

                                    <?php if($booking->customerPlotTransactionSum >= $this->discountedPlotCostOfLandAndExtra($booking->plot->id)) {?>
                                    <br/><span class="label label-success" style="text-decoration: none;">Plot Total Paid</span>
                                    <?php }?>
                                </td>
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
            <div class="col-lg-12"><b><PRE class="preClass">COST INFO.</PRE></b></div>
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table table-responsive" style="FONT-SIZE: 12PX;">
                        <tbody>

                            
                            <tr>
                                <td class="tbBold">Payment Schedule: </td>
                                <td><span><?php echo @$booking->special->name?></span></td>
                            </tr>
                            <tr>
                                <td class="tbBold">Only Cost of Land: </td>
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
                            <tr class="hide">
                                <td class="tbBold">Extra: <br/><span style="font-size:08px">
                                    <?php echo ($booking->plot->is_road_facing==1)?'Road Facing, ':''?>
                                    <?php echo ($booking->plot->is_corner==1)?'Corner, ':''?>
                                    <?php echo ($booking->plot->is_park_facing==1)?'Park Facing, ':''?>
                                    <?php echo ($booking->plot->is_west_open==1)?'West Open, ':''?>
                                </span></td>
                                <td><?php //echo 'Rs. '.@$this->plotTotal(@$booking->plot->id,true,false)?></td>
                                
                            </tr>
                            <tr class="hide">
                                <td class="tbBold">Total: </td>
                                <td><?php echo 'Rs. '.@$this->plotTotal($booking->plot->id,true,true)?></td>
                            </tr>
                            <tr>
                                <td class="tbBold">Booking Date: </td>
                                <td><?php echo date('d M,Y', strtotime(@$booking->createdOn))?></td>
                            </tr>
                            <tr >
                                <td class="tbBold">Installment Start Date: </td>
                                <td><?php echo date("d M, Y", strtotime($booking->monthly_start_date))?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<br/>
<div class="col-lg-12 infoBox" style="margin-top: -5%!important;">
	<span class="col-lg-12 dueBox" style="text-align:center;"><h5 class="heading">Dues Summary</h5></span>
    <div class="" style="margin-top:-5%">
        <table class="table table-hover dataTable no-footer duesTable" border=1 id="duesTable" style="FONT-SIZE: 11PX;margin-bottom: 0px;"> 
            <thead>
                <tr>
                    <th style="background-color: lightgrey!important;line-height: 15px!important;">Payment Mode</th>
                    <th style="background-color: lightgrey!important;line-height: 15px!important;">Due Date</th>
                    <th style="background-color: lightgrey!important;line-height: 15px!important;">Total Amount</th>
                    <th style="background-color: lightgrey!important;line-height: 15px!important;">Received Amount</th>
                    <th style="background-color: lightgrey!important;line-height: 15px!important;">Balance Amount</th>
                </tr>
            </thead>
            <tbody>
<?php $paymentmodes = PaymentSchedulePaymentModes::model()->findAll('payment_schedule_id = :id AND plot_type = :type',array(':id'=>$booking->paymentSchedule->id,':type'=>strtolower($booking->plot->plot_type)));
if($booking->customerpaymentSchedule){
    $modesCustom = CustomPaymentSchedulePaymentModes::model()->findAll($booking->id); 
    $modesC = [];
    array_map(function($item) use(&$modesC){
        $modesC[$item->mode] = $item;
    }, $modesCustom);
    $asd = [];
    foreach($paymentmodes as $ind => $cpm){
        $x = new stdClass();
        $x->id = $cpm->id;
        $x->mode = $cpm->mode;
        $x->amount = $modesC[$cpm->mode]->amount;    
        $asd[] = $x;  
    }   

    $paymentmodes = $asd;
}
?>
                    <?php $allocationTotal = 0;$allocationSum = 0;$total = 0; $balance = 0; $received = 0;
                    foreach($paymentmodes as $modes): $rowBalance = 0;
                    $cpt = CustomerPlotTransactions::model()->findAll('plot_id = :id AND plot_payment_mode_id = :modeid',array(':id'=>$booking->id,':modeid'=>$modes->id)); 
                    ?>
                    <tr style="font-size: 12px;">
                        <!--Mode-->
                        <td style="line-height: 15px!important;">
                            <?php echo $this->getModesName(@$modes->mode)?>                              
                        </td>
<?php 
$var_sum = CustomerPlotTransactions::model()->findBySql('select sum(`amount`) as `total` from customer_plot_transactions WHERE status = 1 AND plot_id = :id AND plot_payment_mode_id = :modeid', array(':id'=>$booking->id,':modeid'=>$modes->id));
if($modes->mode=='allocation'){
    $allocationTotal = $modes->amount;
    $allocationSum = $var_sum->total;
}
?> 
<?php $checkValue = false;?>
<?php if($modes->mode=='monthly'){
    $divideVal = (($var_sum->total/number_format(($modes->amount/36),'2','.','')));
    $floorVal = floor($divideVal);
    $fractionVal = $divideVal - $floorVal;
    $checkValue =  floor(($var_sum->total/number_format(($modes->amount/36),'2','.','')));
    $isDetailShowMonthly = 1;
} ?>  
<?php if($modes->mode=='yearly'){
    //$checkValue =  floor(($var_sum->total/number_format(($modes->amount/6),'2','.','')));
    $divideVal = (($var_sum->total/number_format(($modes->amount/6),'2','.','')));
    $floorVal = floor($divideVal);
    $fractionVal = $divideVal - $floorVal;
    $checkValue =  floor(($var_sum->total/number_format(($modes->amount/6),'2','.','')));
    $isDetailShowYearly = 1;
} ?>                        
                        <!--Mode Next Column-->
                        <?php if(strtolower(@$modes->mode) == 'monthly'){?>
                            <?php if($netTotalCheck > 0){?>
                                <td class="hide"><?php echo '<p>'.$checkValue.' out of 36 monthly installments,</p>';
                                    if($checkValue!=0){
                                        //$checkValue = $checkValue-1;
                                        //echo '<p><b>Paid Upto: '.date('M, Y',strtotime(date("Y-m-d", strtotime($booking->monthly_start_date)) . "+$checkValue months")).'</p></b>';
                                    }//echo ( strtolower(@$modes->mode) == 'monthly')? '36 / '.$checkValue .' = '.(36-$checkValue) : '' ?></td>
                            <?php } else{?>
                                <td><?php //echo ( strtolower(@$modes->mode) == 'monthly')? '36 ' : '' ?></td>
                            <?php }?>        
                            
                        <?php } else if(strtolower(@$modes->mode) == 'yearly'){?>
                            <?php if($netTotalCheck > 0){?>
                                <td class="hide"><?php echo '<p>'.$checkValue.' out of 6 yearly installments,</p>';
                                        if($checkValue!=0){
                                        //$checkValuee = ($checkValue==1)?6:($checkValue*6)-1;
                                        //echo '<p><b>Paid Upto: '.date('M, Y',strtotime(date("Y-m-d", strtotime($booking->monthly_start_date)) . "+$checkValuee months")).'</p></b>';
                                    };//echo ( strtolower(@$modes->mode) == 'yearly')? '6 / '.($checkValue) .' = '.(6-$checkValue) : '' ?></td>
                            <?php } else{?>
                                <td><?php //echo ( strtolower(@$modes->mode) == 'yearly')? '6 ' : '' ?></td>
                            <?php }?>
                        <?php } else{?>
                            <td class="hide"><?php //echo $modes->mode?></td>
                        <?php } ?>

                        <!--Due Date-->
                        <?php if($modes->mode=='monthly'){?>
                        <td>
                            <?php if($var_sum->total >= $modes->amount){?>
                                <table class="table table-hover dataTable no-footer duesTable" border="2" id="duesTable" style="FONT-SIZE: 09PX;margin-bottom: 0px;">
                                  <tbody>
                                    <tr>
                                      <td colspan="2" style="text-align: center;line-height: 15px!important;">
                                        <?php echo '<p><b>36</b> out of <b>36</b> monthly installments,';
                                            $checkValuePaid = $checkValue-1;
                                            echo '&nbsp;&nbsp;<br/><b>Paid Upto: '.date('M, Y',strtotime(date("Y-m-d", strtotime($booking->monthly_start_date)) . "+$checkValuePaid months")).'</p></b>';
                                        ?>
                                    </td>
                                    </tr>
                                  </tbody>
                                </table>
                            <?php $isDetailShowMonthly = 0;}?>

                            <?php if($checkValue != 36 && $isDetailShowMonthly == 1){?>
                            <table class="table table-hover dataTable no-footer duesTable" border=2 id="duesTable" style="FONT-SIZE: 09PX;margin-bottom: 0px;">
                                <tr class="hide">
                                    <td>Start Month</td>
                                    <td><b><?php echo date('M, o',strtotime($booking->monthly_start_date));?></b></td>
                                </tr>
                                
                                <?php if($netTotalCheck > 0){?>
                                    <td colspan="2" style="text-align: center;line-height: 15px!important;"><?php echo '<p><b>'.$checkValue.'</b> out of <b>36</b> monthly installments,';
                                        if($checkValue!=0){
                                            $checkValuePaid = $checkValue-1;
                                            echo '&nbsp;&nbsp;<br/><b>Paid Upto: '.date('M, Y',strtotime(date("Y-m-d", strtotime($booking->monthly_start_date)) . "+$checkValuePaid months")).'</p></b>';
                                        }}?>
                                    </td>
                                <?php $prev = 0;if($fractionVal!=0){?>
                                <tr>
                                    <td>Previous Balance(<?php echo date('M, Y',strtotime(date("Y-m-d", strtotime($booking->monthly_start_date)) . "+$checkValue months"))?>)</td>
                                    <td><b><?php echo $prev = number_format((1-$fractionVal) * number_format(($modes->amount/36),'2','.',''),'2','.','')?></b></td>
                                </tr>
                                <?php }?>
                                <tr>
                                    <td>Due Months</td>
                                    <?php $checkValueMonthly = $checkValue-1;//($fractionVal!=0)?$checkValue+1:$checkValue;?>
                                    <td><b><?php echo $this->getDateDiff(date('d M, Y'),date('d M, Y',strtotime(date("Y-m-d", strtotime($booking->monthly_start_date)) . "+$checkValueMonthly months")))?> Month(s)</b></td>
                                </tr>
                                <tr>
                                    <?php $ccc = $this->getDateDiff(date('d M, Y'),date('d M, Y',strtotime(date("Y-m-d", strtotime($booking->monthly_start_date)) . "+$checkValueMonthly months")));?>

                                    <?php $ccc = ($prev > 0)?$ccc-1:$ccc?>
                                    <?php $cccC = ($ccc < 0)?0:$ccc?>
                                    <td style="line-height: 5px!important;"><p>Next Due Monthly Installment</p><p><span>(<?php echo number_format(($modes->amount/36),'2','.','')." x $cccC  "?>)</span></p></td>
                                    <td><b><?php echo number_format($cccC * number_format(($modes->amount/36),'2','.',''),'2','.',',')?></b></td>
                                </tr>
                                
                                <?php if($fractionVal!=0){?>
                                    <tr>
                                    <td>Total Monthly Installment Due</td>
                                    <?php $dueTotal = ((1-$fractionVal) * number_format(($modes->amount/36),'2','.','')) + ($ccc * number_format(($modes->amount/36),'2','.',''));?>
                                    <?php if($ccc < 0){?>
                                        <td><b>0</b></td>
                                    <?php } else {?>
                                        <td><b><?php echo number_format($dueTotal,'2','.',',')?></b></td>
                                    <?php }?>
                                    
                                </tr>
                                <?php }?>
                                <tr>
                                    <td>Next Monthly Installment</td>
                                    <?php $ce = 0;//$checkValue+$ccc; ?>
                                    <td><b><?php echo date('10 M, Y');//$this->actionGetModeDueDate(@$booking, @$booking->monthly_start_date,strtolower(@$modes->mode),round($ce))?></b></td>
                                </tr>
                            </table>
                            <?php } ?>
                        </td>
                        <!--Due Amount-->
                        <?php } elseif($modes->mode=='yearly'){?>
                            <td>

                                <?php if($var_sum->total >= $modes->amount){?>
                                <table class="table table-hover dataTable no-footer duesTable" border="2" id="duesTable" style="FONT-SIZE: 09PX;margin-bottom: 0px;">
                                  <tbody>
                                    <tr>
                                        <td colspan="2" style="text-align: center;line-height: 15px!important;"><?php echo '<p><b>6</b> out of <b>6</b> half yearly installments,';
                                                $checkValuee = 48;
                                                echo '&nbsp;&nbsp;<br/><b>Paid Upto: '.date('M, Y',strtotime(date("Y-m-d", strtotime(date('Y-m-d',strtotime(date("Y-m-d", strtotime($booking->monthly_start_date)) . "-1 months")))) . "+$checkValuee months")).'</p></b>';
                                            ?>
                                        </td>
                                    </tr>
                                  </tbody>
                                </table>
                            <?php $isDetailShowYearly = 0;}?>


                            <?php if($checkValue != 6 && $isDetailShowYearly == 1){?>
                                <table class="table table-hover dataTable no-footer duesTable" border=2 id="duesTable" style="FONT-SIZE: 09PX;margin-bottom: 0px;">
                                <tr class="hide">
                                    <td>Start Month</td>
                                    <td><b><?php echo date('M, o',strtotime($booking->monthly_start_date));?></b></td>
                                </tr>
                                <?php if($netTotalCheck > 0){?>
                                <td colspan="2" style="text-align: center;line-height: 15px!important;">
                                    <?php echo '<p><b>'.$checkValue.'</b> out of <b>6</b> half yearly installments,';
                                        if($checkValue!=0){
                                            $checkValuee = ($checkValue==1)?6:($checkValue*6);
                                            echo '&nbsp;&nbsp;<br/><b>Paid Upto: '.date('M, Y',strtotime(date("Y-m-d", strtotime(date('Y-m-d',strtotime(date("Y-m-d", strtotime($booking->monthly_start_date)) . "-1 months")))) . "+$checkValuee months")).'</p></b>';
                                        } else{
                                            $checkValuee = ($checkValue==1)?6:($checkValue*6);
                                            echo '&nbsp;&nbsp;<br/><b>Paid Upto: '.date('M, Y',strtotime(date("Y-m-d", strtotime(date('Y-m-d',strtotime(date("Y-m-d", strtotime($booking->monthly_start_date)))))) . "+$checkValuee months")).'</p></b>';
                                        }
                                } ?>
                                </td>
                                <?php $prev = 0; if($fractionVal!=0){?>
                                <tr>
                                    <?php if($checkValue==0){?>
                                        <?php $checkValuee = (($checkValue==0)?6:$checkValue*6); ?>
                                    <?php } else {?>
                                    <?php $checkValuee = ($checkValue==1)?12:($checkValue*6);?>
                                    <?php }?>
                                    <td>Previous Balance(<?php echo date('M, Y',strtotime(date("Y-m-d", strtotime(date('Y-m-d',strtotime(date("Y-m-d", strtotime($booking->monthly_start_date)) . "-1 months")))) . "+$checkValuee months"))?>)</td>



                                    <?php //$checkValuee = ($checkValue==1)?12:($checkValue*6);?>
                                    <!-- <td>Previos Balance(<?php //echo date('M, Y',strtotime(date("Y-m-d", strtotime($booking->monthly_start_date)) . "+$checkValuee months"))?>)</td> -->
                                    <td><b><?php echo $prev = number_format((1-$fractionVal) * number_format(($modes->amount/6),'2','.',''),'2','.','')?></b></td>
                                </tr>
                                <?php }?>
                                <tr>
                                    <td>Due Half Yearly</td>
                                    <?php $checkValuee = ($checkValue==1 && $checkValue==0)?1:($checkValue*6)-1;?>
                                    <td><b><?php echo floor($this->getDateDiff(date('d M, Y'),date('d M, Y',strtotime(date("Y-m-d", strtotime($booking->monthly_start_date)) . "+$checkValuee months")))/6)?> Half Yearly(s)</b></td>
                                </tr>
                                <tr>
                                    <?php //$ccc = $this->getDateDiff(date('d M, o'),$this->actionGetModeDueDate(@$booking, @$booking->monthly_start_date,'bookingMonthly',round($checkValue)));?>
                                    <?php $checkValuee = ($checkValue==1 && $checkValue==0)?1:($checkValue*6)-1;?>
                                    <?php $ccc = floor($this->getDateDiff(date('d M, Y'),date('d M, Y',strtotime(date("Y-m-d", strtotime($booking->monthly_start_date)) . "+$checkValuee months")))/6);?>

                                    <?php //if($fractionVal!=0){?>
                                        <?php ///$ccc = ($prev > 0)?$ccc-1:$ccc?>
                                        <?php //$cccC = ($ccc < 0)?0:$ccc?>
                                    <?php //} else{
                                        //$cccC = $ccc;
                                    //}?>

                                    <?php $ccc = ($prev > 0)?$ccc-1:$ccc?>
                                    <?php $cccC = ($ccc < 0)?0:$ccc?>

                                    <td style="line-height: 5px!important;"><p>Next Due Half Yearly</p><p><span>(<?php echo number_format(($modes->amount/6),'2','.','')." x $cccC  "?>)</span></p></td>
                                    <td><b><?php echo number_format($cccC * number_format(($modes->amount/6),'2','.',''),'2','.',',')?></b></td>
                                </tr>

                                <?php if($fractionVal!=0){?>
                                <tr>
                                    <td>Total Half Yearly Due</td>
                                    <?php
                                    //if($fractionVal!=0){
                                        //$ccc = $ccc-1;
                                        //$cccC = ($ccc < 0)?0:$ccc;
                                    //} else{
                                        //$cccC = $ccc;
                                    //}
                                    ?>
                                    <?php $dueTotal = ((1-$fractionVal) * number_format(($modes->amount/6),'2','.','')) + ($cccC * number_format(($modes->amount/6),'2','.',''));?>
                                    <?php if($ccc < 0){?>
                                        <td><b>0</b></td>
                                    <?php } else {?>
                                        <td><b><?php echo number_format($dueTotal,'2','.',',')?></b></td>
                                    <?php }?>
                                </tr>
                                <?php }?>
                                
                                <tr>
                                    <td>Next Half Yearly</td>
                                    <?php $ce = (($checkValue==1 || $checkValue==0)?6:$checkValue*6); ?>
                                    <td><b><?php echo $this->actionGetModeDueDate(@$booking, date('Y-m-d',strtotime(date("Y-m-d", strtotime($booking->monthly_start_date))."-1 months")),strtolower(@$modes->mode),round($ce))?></b></td>
                                </tr>
                            </table>
                                <?php }?>
                            
                        </td>
                        <?php } else{ ?>
                        <td><?php echo $this->actionGetModeDueDate(@$booking, @$booking->createdOn,strtolower(@$modes->mode),round($checkValue))?></td>
                        <?php }?>
                        <td><?php echo 'Rs. '.number_format(@$modes->amount) ?>
                            
                            
                        </td>
                        <?php $total = $total + @$modes->amount;?>

                        <!--Rec Amount-->
                        <td><?php echo (@$var_sum->total)?'Rs. '.@number_format(@$var_sum->total):'-';?></td>
                        <?php $received = $received + ((@$var_sum->total)?$var_sum->total:0); ?>
                        <?php $rowBalance = @$modes->amount - @$var_sum->total;?>
                        
                        <!--Balance Amount-->
                         <td><?php echo (@$var_sum->total )?'Rs. '.number_format(@$rowBalance):'Rs. '.number_format($modes->amount)?></td>
                        <?php $balance = $balance + @$rowBalance;?>
                    </tr> 
                <?php endforeach; ?>
                <?php /*?>
                <tr style="font-size: 12px;">
                    <td>Plot Extra</td>
                    <td>-</td>
                    <td><?php echo 'Rs. '.$this->plotExtra($booking->plot->id,true,true,true);?></td>
                    <?php $total = $total + $this->plotExtra($booking->plot->id,false,true,true);?>
                    <td>-</td>
                    <td><?php echo 'Rs. '.$this->plotExtra($booking->plot->id,true,true,true);?></td>
                    <?php $balance = $balance + $this->plotExtra($booking->plot->id,false,true,true)?>
                </tr>
                <?php */?>
                <?php if($booking->plot->discount > 0 ){?>
                    <tr style="font-size: 12px;">
                        <td>Plot Discount</td>
                        <td>-</td>
                        <td><?php echo 'Rs. -'.number_format($booking->plot->discount);?></td>
                        <?php $total = $total - $booking->plot->discount?>
                        <td>-</td>
                        <td><?php echo 'Rs. -'.number_format($booking->plot->discount);?></td>
                        <?php $balance = $balance - $booking->plot->discount?>
                    </tr>
                <?php }?>

                <tr class="total" style="background-color: lightgrey!important;color: #000;font-weight: bold;">
                    <td colspan="2" style="background-color: lightgrey!important;"><b>Only Cost of Land</b></td>
                    <td style="background-color: lightgrey!important;line-height: 15px!important;"><?php echo 'Rs. '.number_format(@$total)?></td>
                    <td style="background-color: lightgrey!important;line-height: 15px!important;"><?php echo 'Rs. '.number_format(@$received)?></td>
                    <td style="background-color: lightgrey!important;line-height: 15px!important;"><?php echo 'Rs. '.number_format(@$balance)?></td>                    
                </tr>
                <!-- Plot Extra -->
                <tr style="font-size: 12px;">
                    <td>Plot Extra Charges: <br/><span style="font-size:08px">
                        <?php echo ($booking->plot->is_road_facing==1)?'Road Facing, ':''?>
                        <?php echo ($booking->plot->is_corner==1)?'Corner, ':''?>
                        <?php echo ($booking->plot->is_park_facing==1)?'Park Facing, ':''?>
                        <?php echo ($booking->plot->is_west_open==1)?'West Open, ':''?>
                    </span></td>
                    <td>-</td>
                    <td><?php echo 'Rs. '.$this->plotExtra($booking->plot->id,true,true,true);?></td>
                    <?php $total = $total + $this->plotExtra($booking->plot->id,false,true,true);?>
                    <td>-</td>
                    <td><?php echo 'Rs. '.$this->plotExtra($booking->plot->id,true,true,true);?></td>
                    <?php $balance = $balance + $this->plotExtra($booking->plot->id,false,true,true)?>
                </tr>

                <!-- transfer Charges -->
                <tr style="font-size: 12px;">
                    <td>Transfer Charges</td>
                    <td>-</td>
                    <td><?php echo 'Rs.'. number_format($booking->plot->customerPlotTransfersSum)?></td>
                    <td><?php echo 'Rs.'. number_format($booking->customerPlotPlanTransactionsTransfersSum)?></td>
                    <td><?php echo 'Rs.'. number_format($booking->plot->customerPlotTransfersSum-$booking->customerPlotPlanTransactionsTransfersSum)?></td>
                </tr>
                <!-- Development Charges -->
                <tr style="font-size: 12px;">
                    <td>Development Charges</td>
                    <td>TBA</td>
                    <td><?php echo 'Rs.'. number_format($booking->customerPlotPlanTransactionsDevlopmentSum)?></td>
                    <td><?php echo 'Rs.'. number_format($booking->customerPlotPlanTransactionsDevlopmentSum)?></td>
                    <td><?php echo 'Rs.'. number_format($booking->customerPlotPlanTransactionsDevlopmentSum)?></td>
                </tr>

                <!-- Development Charges -->
                <tr style="font-size: 12px;">
                    <td>Penalty Charges</td>
                    <td>TBA</td>
                    <td><?php echo 'Rs.'. number_format($booking->customerPlotPlanTransactionsPenaltySum)?></td>
                    <td><?php echo 'Rs.'. number_format($booking->customerPlotPlanTransactionsPenaltySum)?></td>
                    <td><?php echo 'Rs.'. number_format($booking->customerPlotPlanTransactionsPenaltySum)?></td>
                </tr>

                <!-- Other Charges -->
                <tr style="font-size: 12px;">
                    <td>Other Charges</td>
                    <td>TBA</td>
                    <td><?php echo 'Rs.'. number_format($booking->customerPlotPlanTransactionsOthersSum)?></td>
                    <td><?php echo 'Rs.'. number_format($booking->customerPlotPlanTransactionsOthersSum)?></td>
                    <td><?php echo 'Rs.'. number_format($booking->customerPlotPlanTransactionsOthersSum)?></td>
                </tr>
            </tbody>
        </table>
        <p><span>*TBA - To Be Annouced</span></p>
    </div>
</div>
    <div class="pagebreak"></div>
    <p style="page-break-before: always"></p>
    <br/>
    <?php ?>
    <!-- Transaction Detail -->
    <div class="col-lg-12 infoBox">
        <p style="text-align: center;"><b><?php echo Yii::app()->name ?> - Booking Ledger</b><br/><b>Printing Date: <?php echo date('d M,Y')?></b><a class="btnn" target="_blank" href="<?php echo Yii::app()->baseUrl?>/booking/bookingledger/<?php echo $booking->id?>?type=transactions"><span style="float:right;"><span class="label label-success" style="text-decoration: none;font-size: 15px;">Print</span></span></a></p>
        <div class="col-lg-4 infoDiv">
            <p style="text-align: center;">&nbsp;</p>
            <div class="row">
                <div class="col-lg-12"><b><PRE class="preClass">CUSTOMER INFO.</PRE></b></div>
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table class="table table-responsive" style="FONT-SIZE: 12PX;">
                            <tbody>
                                <tr>
                                    <td class="tbBold">Reg No.: </td>
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
                                <?php /*?>
                                <tr>
                                    <td class="tbBold">Address: </td>
                                    <td style="font-size: 11px"><?php echo @$booking->customer->address?></td>
                                </tr>
                                <tr>
                                    <td class="tbBold">Mobile: </td>
                                    <td><?php echo @$booking->customer->mobile?></td>
                                </tr>
                                <!-- <tr>
                                    <td class="tbBold">Off Phone: </td>
                                    <td><?php //echo @$booking->customer->office?></td>
                                </tr> -->
                                <tr>
                                    <td class="tbBold">CNIC: </td>
                                    <td><?php echo @$booking->customer->cnic?></td>
                                </tr>
                                <?php */?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 infoDiv">
            <p>&nbsp;</p>
            <div class="row">
                <div class="col-lg-12"><b><PRE class="preClass">PLOT INFO.</PRE></b></div>
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table class="table table-responsive" style="FONT-SIZE: 12PX;"> 
                            <tbody>
                                <tr>
                                    <td class="tbBold">Computer ID: </td>
                                    <td><?php echo @$booking->id?></td>
                                    
                                </tr>
                                <!-- <tr>
                                    <td class="tbBold">Block : </td>
                                    <td><?php //echo @$booking->plot->block_number?></td>
                                    
                                </tr> -->
                                <tr>
                                    <td class="tbBold">Plot Detail : </td>
                                    <td><?php echo @$booking->plot->block_number.'-'.@$booking->plot->plot_type.'-'.@$booking->plot->plot_number?></td>
                                    
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
                                    <?php /*if(count($plotttt) > 1){?>
                                        <td class="tbBold">Booking/Transfer Date: </td>
                                        <td><?php echo date('d M,Y', strtotime(@$plotttt[0]->createdOn)).' / '.date('d M,Y', strtotime(@$booking->createdOn))?></td>
                                        <?php $booking->createdOn = $plotttt[0]->createdOn;?>
                                    <?php } else{*/?>
                                        <!-- <td class="tbBold">Booking Date: </td>
                                        <td><?php //echo date('d M,Y', strtotime(@$booking->createdOn))?></td> -->
                                    <?php //}?>
                                </tr>
                                <tr>
                                <td class="tbBold">File Status: </td>
                                <td><span><?php echo (@$booking->status==1)?(($netTotalCheck>0)?'Booked':'Full Paid <span class="" style="font-size: 9px;">(Land Cost)</span>'):'Pending'?></span><br/>
                                    <?php if($booking->customerPlotTransactionSum >= $this->discountedPlotCostOfLand($booking->plot->id)) {?>
                                    <span class="label label-success" style="text-decoration: none;">Cost of Land Paid</span>
                                    <?php }?>

                                    <?php if($booking->customerPlotTransactionSum >= $this->discountedPlotCostOfLandAndExtra($booking->plot->id)) {?>
                                    <br/><span class="label label-success" style="text-decoration: none;">Plot Total Paid</span>
                                    <?php }?>
                                </td>
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
                <div class="col-lg-12"><b><PRE class="preClass">COST INFO.</PRE></b></div>
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table class="table table-responsive" style="FONT-SIZE: 12PX;">
                            <tbody>

                                
                                <tr>
                                    <td class="tbBold">Payment Schedule: </td>
                                    <td><span><?php echo @$booking->special->name?></span></td>
                                </tr>
                                <tr>
                                    <td class="tbBold">Only Cost of Land: </td>
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
                                <tr class="hide">
                                    <td class="tbBold">Extra: <br/><span style="font-size:08px">
                                        <?php echo ($booking->plot->is_road_facing==1)?'Road Facing, ':''?>
                                        <?php echo ($booking->plot->is_corner==1)?'Corner, ':''?>
                                        <?php echo ($booking->plot->is_park_facing==1)?'Park Facing, ':''?>
                                        <?php echo ($booking->plot->is_west_open==1)?'West Open, ':''?>
                                    </span></td>
                                    <td><?php //echo 'Rs. '.@$this->plotTotal(@$booking->plot->id,true,false)?></td>
                                    
                                </tr>
                                <tr class="hide">
                                    <td class="tbBold">Total: </td>
                                    <td><?php echo 'Rs. '.@$this->plotTotal($booking->plot->id,true,true)?></td>
                                </tr>
                                <tr>
                                    <td class="tbBold">Booking Date: </td>
                                    <td><?php echo date('d M,Y', strtotime(@$booking->createdOn))?></td>
                                </tr>
                                <tr >
                                    <td class="tbBold">Installment Start Date: </td>
                                    <td><?php echo date("d M, Y", strtotime($booking->monthly_start_date))?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br/>
    <div class="col-lg-12 infoBox">
    <span class="col-lg-12" style="text-align:center;"><h5 class="heading" >All Transaction Detail(s)</h5></span>
    <div class="" style="margin-top:-4%">
        <table class="table table-hover dataTable no-footer duesTable" border=1 style="FONT-SIZE: 11PX;margin-bottom: 0px;">
            <thead>
                <tr>
                    <th style="background-color: lightgrey!important;line-height: 15px!important;">Date</th>
                    <th style="background-color: lightgrey!important;line-height: 15px!important;">Receipt No.</th>
                    <th style="background-color: lightgrey!important;line-height: 15px!important;">Payment Mode</th>
                    <th style="background-color: lightgrey!important;line-height: 15px!important;">Payment Type</th>
                    <th style="background-color: lightgrey!important;line-height: 15px!important;">Bank/Branch</th>
                    <th style="background-color: lightgrey!important;line-height: 15px!important;">Remarks</th>
                    <th style="background-color: lightgrey!important;line-height: 15px!important;">Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php $exTotal = $exTTotal = 0;if($booking->customerPlotTransactions) { foreach($booking->customerPlotTransactions as $cpt): if($cpt->status == 1) {?>
                     <tr style="    font-size: 13px;">
                        <td style="line-height: 15px!important;"><?php echo date('d M,Y' ,strtotime(@$cpt->createdOn))?></td>
                        <td><?php echo ($this->startsWith($cpt->transaction_number, '#'))?$cpt->transaction_number:'#'.ltrim($cpt->transaction_number,0)?></td>
                        <td><?php echo $cpt->plotPaymentMode->mode?></td>
                        <td><?php echo $cpt->transaction_type?></td>
                        <td style="line-height: 15px!important;"><?php echo ($cpt->bank)?$cpt->bank.' / '.$cpt->bank:''?></td>
                        <td style="line-height: 15px!important;"><?php echo @$cpt->comment?></td>
                        <td style="line-height: 15px!important;"><?php echo 'Rs. '.number_format($cpt->amount)?></td>
                        <?php $exTotal = $exTotal + $cpt->amount?> 
                        
                    </tr>
                <?php } endforeach;} ?>
                    <tr class="total" style="background-color: lightgrey!important;color: #000;font-weight: bold;">
                        <td colspan="6" style="background-color: lightgrey!important;">Total</td>
                        <td style="background-color: lightgrey!important;line-height: 15px!important;"><?php echo 'Rs. '.number_format($exTotal)?></td>
                    </tr>
                    <tr><td colspan='7' style="text-align: center;font-weight: bold;">Extra Transactions</td></tr>
                    <?php if($booking->customerPlotPlanTransactionsAll) { $exTTotal = 0;foreach($booking->customerPlotPlanTransactionsAll as $cpt):?>
                     <tr style="    font-size: 13px;">
                        <td style="line-height: 15px!important;"><?php echo date('d M,Y' ,strtotime(@$cpt->createdOn))?></td>
                        <td><?php echo ($this->startsWith($cpt->transaction_number, '#'))?$cpt->transaction_number:'#'.$cpt->transaction_number?></td>
                        <td><?php echo $cpt->plot_payment_mode?></td>
                        <td><?php echo $cpt->transaction_type?></td>
                        <td style="line-height: 15px!important;"><?php echo ($cpt->bank)?$cpt->bank.' / '.$cpt->bank:''?></td>
                        <td style="line-height: 15px!important;"><?php echo @$cpt->comment?></td>
                        <td style="line-height: 15px!important;"><?php echo 'Rs. '.number_format($cpt->amount)?></td>
                        <?php $exTTotal = $exTTotal + $cpt->amount?> 
                        
                    </tr>
                <?php endforeach;} ?>
                <tr class="total" style="background-color: lightgrey!important;color: #000;font-weight: bold;">
                        <td colspan="6" style="background-color: lightgrey!important;">Total</td>
                        <td style="background-color: lightgrey!important;line-height: 15px!important;"><?php echo 'Rs. '.number_format($exTTotal)?></td>
                    </tr>
            </tbody>
        </table>
    </div>
</div>
    