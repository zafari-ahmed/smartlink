<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Bookings</h1>
        <?php
            foreach(Yii::app()->user->getFlashes() as $key => $message) {
                echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'.$message.'</div>';
            }
        ?>
    </div>
    <!-- /.col-lg-12 -->
</div>
<?php $userModel = Yii::app()->session->get('userModel'); ?>
<?php 
    $params = $_GET;
    array_shift($params);
    $params = http_build_query($params);
?>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                All Bookings<br/>
                <span style="margin-top: -5px;"><a href="<?php echo Yii::app()->baseUrl?>/booking"><span class="label label-info btn-sm">All</span></a></span>
                <?php foreach($paymentSchedules as $ps): $active = (@$_GET['payment']==$ps->id)?'success':'info'?>
                    <span style="margin-top: -5px;"><a href="<?php echo Yii::app()->baseUrl?>/booking?payment=<?php echo $ps->id?>"><span class="label label-<?php echo $active?> btn-sm"><?php echo $ps->name?></span></a></span>
                <?php endforeach;?>
                <br/>
                <span style="margin-top: -5px;"><a href="<?php echo Yii::app()->baseUrl?>/booking?flag_status=1"><span class="label label-<?php echo (@$_GET['flag_status']==1)?'success':'warning'?> btn-sm">File Completed</span></a></span>

                <span style="margin-top: -5px;"><a href="<?php echo Yii::app()->baseUrl?>/booking?flag_status=2"><span class="label label-<?php echo (@$_GET['flag_status']==2)?'success':'warning'?> btn-sm">Received By Customer</span></a></span>

                <br/>
                <span style="margin-top: -5px;"><a href="<?php echo Yii::app()->baseUrl?>/booking?documentFlag=1"><span class="label label-<?php echo (@$_GET['documentFlag']==1)?'success':'warning'?> btn-sm">Completed Documents</span></a></span>

                <?php if($userModel['user_type']['id'] == 1 || $userModel['user_type']['id'] == 5){?>
                <span class="pull-right" style="margin-top: -5px;"><a href="<?php echo Yii::app()->baseUrl?>/booking/reportall" target="_blank"><button type="button" class="btn btn-success btn-sm">Report</button></a></span>
                <?php }?>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables">
                    <thead>
                        <tr>
                            <th class="hide">#</th>
                            <th>Plot #</th>
                            <th>Reg. No.</th>
                            <th>Name</th>
                            <th>CNIC</th>
                            <th>Contact</th>
                            <th>Status</th>
                            <th>Action</th>
                            <th>Payments</th>
                            <th>Discount</th>
                            <th>Dealer</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $list = true;if($bookings){ foreach($bookings as $booking):
                        if($documentFlag){
                            if($booking->CPDCount == 6){
                                $list = true;
                            } else{
                                $list = false;    
                            }
                            
                        } else{
                            $list = true;
                        }
                        
                        if($list){
                        $trasferred = 0;
                        if($booking->plot->customerPlotTransfers){
                            $trasferred = 1;
                        }
                        $netTotal = intval(@$booking->customerPlotTransactionSum);
                        $complete = ($this->plotTotal($booking->plot->id) == number_format($netTotal))?1:0;

                        ?>
                       		<tr>
                                <td class="hidden"><?php echo $booking->id?></td>
	                            
                                <td><a href="<?php echo Yii::app()->baseUrl?>/booking/viewbooking/<?php echo $booking->id?>"><?php echo '*'.$booking->plot->block_number.'-'.$booking->plot->plot_type.'-'.$booking->plot->plot_number?>*</a></td>
                                <td><?php echo $this->getBookingRegNo($booking->id)?></td>
                                <td><?php echo $booking->customer->name?></td>
	                            <td><?php echo $booking->customer->cnic?></td>
	                            <td><?php echo $booking->customer->mobile?></td>
                                <?php if($booking->blocked != 1 && $booking->blocked != 2){?> 
                                    <?php if(empty($booking->customerPlotCancelled)){?>
                                    <td><?php echo ($booking->status==1)?(($complete==0)?'<span class="aLink label label-primary">Booked '.(($trasferred==1)?'(Transferred)':'').'</span>':'<span class="aLink label label-success">Completed</span>'):'<span class="aLink label label-danger">Temporary Booked</span>'?>
                                        
                                        <?php if($booking->customerPlotTransactionSum >= $this->discountedPlotCostOfLand($booking->plot->id)) {?>
                                    <span class="label label-warning" style="text-decoration: none;">Cost of Land Paid</span>
                                    <?php }?>

                                    <?php if($booking->customerPlotTransactionSum >= $this->discountedPlotCostOfLandAndExtra($booking->plot->id)) {?>
                                    <br/><span class="label label-success" style="text-decoration: none;">Plot Total Paid</span>
                                    <?php }?>
                                    </td>
                                    <?php } else{ ?>
                                        <td><span class="aLink label label-danger">Cancelled</span></td>
                                    <?php } ?>
                                <?php } else {?>
                                    <td><span class="aLink label label-danger">Blocked</span></td>
                                        <?php /*if($booking->is_open==0){?>
                                                <td><span class="aLink label label-danger">Blocked</span></td>
                                            <?php } else {?>
                                                <td><span class="aLink label label-success">Open</span></td>
                                            <?php }*/ ?>
                                <?php }?>
                                <td>
                                    <a href="<?php echo Yii::app()->baseUrl?>/booking/viewbooking/<?php echo $booking->id?>"><span class="aLink label label-info">View</span></a>&nbsp;
                                <?php if($userModel['user_type']['id'] == 1){?>
                                    <?php if($booking->flag_status==2){?>
                                        <span class="aLink label label-success">Received By Customer</span>&nbsp;
                                    <?php } else if($booking->flag_status==1){?>
                                        <a href="<?php echo Yii::app()->baseUrl?>/api/setbookingflag/view/0/flag/2/booking/<?php echo $booking->id?>"><span class="flagLink label label-primary">Rec By Customer?</span></a>&nbsp;
                                    <?php } else{?>
                                        <a href="<?php echo Yii::app()->baseUrl?>/api/setbookingflag/view/0/flag/1/booking/<?php echo $booking->id?>"><span class="flagLink label label-danger">File Complete?</span></a>&nbsp;
                                    <?php } ?>
                                <?php }?>
                                    <?php if(empty($booking->customerPlotCancelled)){?>
                                        
                                        <a href="<?php echo Yii::app()->baseUrl?>/booking/editbooking/<?php echo $booking->id?>"><span class="aLink label label-info">Edit</span></a>&nbsp;
                                        <a href="<?php echo Yii::app()->baseUrl?>/booking/addtransaction/<?php echo $booking->id?>"><span class="aLink label label-success">Add Transaction</span></a>
                                    <?php } ?>
                                </td>
                                
                                <td><?php echo 'Rs. '.$this->plotTotal($booking->plot->id).' / Rs. '.number_format($netTotal);?></td>
                                <td><?php echo 'Rs. '.$this->plotTotalDiscount($booking->plot->id)?></td>
                                <td><?php echo ($booking->agent_id)?@$booking->agent->name.'('.@$booking->agent->agentParent->name.')':'-'?></td>
	                        </tr>
                            <?php }?>
                       <?php endforeach;}?>
                    </tbody>
                </table>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>