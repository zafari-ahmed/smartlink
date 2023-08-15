<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Bookings Sale Summary</h1>
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
                All Bookings Summary<br/>
                <span style="margin-top: -5px;"><a href="<?php echo Yii::app()->baseUrl?>/booking"><span class="label label-info btn-sm">All</span></a></span>
                <?php foreach($paymentSchedules as $ps): $active = (@$_GET['payment']==$ps->id)?'success':'info'?>
                    <span style="margin-top: -5px;"><a href="<?php echo Yii::app()->baseUrl?>/booking?payment=<?php echo $ps->id?>"><span class="label label-<?php echo $active?> btn-sm"><?php echo $ps->name?></span></a></span>
                <?php endforeach;?>
                <br/>
                <span style="margin-top: -5px;"><a href="<?php echo Yii::app()->baseUrl?>/booking?flag_status=1"><span class="label label-<?php echo (@$_GET['flag_status']==1)?'success':'warning'?> btn-sm">File Completed</span></a></span>

                <span style="margin-top: -5px;"><a href="<?php echo Yii::app()->baseUrl?>/booking?flag_status=2"><span class="label label-<?php echo (@$_GET['flag_status']==2)?'success':'warning'?> btn-sm">Received By Customer</span></a></span>

                <br/>
                <span style="margin-top: -5px;"><a href="<?php echo Yii::app()->baseUrl?>/booking?documentFlag=1"><span class="label label-<?php echo (@$_GET['documentFlag']==1)?'success':'warning'?> btn-sm">Completed Documents</span></a></span>

                
                <span class="pull-right" style="margin-top: -5px;"><a href="<?php echo Yii::app()->baseUrl?>/booking/reportallsales" target="_blank"><button type="button" class="btn btn-success btn-sm">Report</button></a></span>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables">
                    <thead>
                        <tr>
                            <th class="hide">#</th>
                            <th>Plot #</th>
                            <th>Customer Name</th>
                            <th>Reg. No.</th>
                            <th>Cost of Land</th>
                            <th>Discount</th>
                            <th>Total Cost of Land</th>
                            <th>Extra Charges</th>
                            <th>Plot Total</th>
                            <th>Paid Total</th>
                            <th>Balance</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $col = $dis = $tcol = $ext = $plt = $pt = $bal = 0; $list = true;if($bookings){ foreach($bookings as $booking):
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
                                <td><?php echo $booking->customer->name?></td>
                                <td><?php echo $this->getBookingRegNo($booking->id)?></td>
                                <td><?php echo 'Rs. '. $booking->plot->total//'Rs. '.number_format($booking->plot->total)?></td>
                                <?php $col = $col + $booking->plot->total;?>

                                <td><?php echo 'Rs. '. number_format($booking->plot->discount)?></td>
                                <?php $dis = $dis + $booking->plot->discount; ?>

                                <?php if($booking->plot->discount){
                                    $plotTotalText = $booking->plot->total-$booking->plot->discount;
                                } else {
                                    $plotTotalText = $booking->plot->total;
                                } ?>
                                <td><?php echo 'Rs. '.number_format($booking->plot->total-$booking->plot->discount)?></td>
                                <?php $tcol = $tcol + ($booking->plot->total-$booking->plot->discount)?>


                                <td><?php echo 'Rs. '.number_format($this->plotExtra($booking->plot->id,false,true,true))?></td>
                                <?php $ext = $ext + $this->plotExtra($booking->plot->id,false,true,true); ?>

                                <?php $plotTotalText = $plotTotalText + $this->plotExtra($booking->plot->id,false,true,true);?>


                                <td><?php echo 'Rs. '.number_format($plotTotalText)?></td>
                                <?php $plt = $plt + $plotTotalText; ?>

                                <td><?php echo 'Rs. '.number_format($booking->customerPlotTransactionSum)?></td>
                                <?php $pt = $pt + $booking->customerPlotTransactionSum; ?>
                                
                                <td><?php echo 'Rs. '.number_format($plotTotalText-$booking->customerPlotTransactionSum)?></td>
                                <?php $bal = $bal + ($plotTotalText-$booking->customerPlotTransactionSum); ?>
	                        </tr>
                            <?php }?>
                       <?php endforeach;}?>
                    </tbody>
                </table>
                <table width="100%" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th class="hide">#</th>
                            <th colspan="2">Total</th>
                            <th>Cost of Land</th>
                            <th>Discount</th>
                            <th>Total Cost of Land</th>
                            <th>Extra Charges</th>
                            <th>Plot Total</th>
                            <th>Paid Total</th>
                            <th>Balance</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="font-weight: bold;">
                            <td colspan="2">Total</td>
                            <td><?php echo 'PKR '.number_format($col)?></td>
                            <td><?php echo 'PKR '.number_format($dis)?></td>
                            <td><?php echo 'PKR '.number_format($tcol)?></td>
                            <td><?php echo 'PKR '.number_format($ext)?></td>
                            <td><?php echo 'PKR '.number_format($plt)?></td>
                            <td><?php echo 'PKR '.number_format($pt)?></td>
                            <td><?php echo 'PKR '.number_format($bal)?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>