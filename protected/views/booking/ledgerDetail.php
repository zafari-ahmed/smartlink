<?php $userModel = Yii::app()->session->get('userModel');?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Upcoming Payments (<?php echo $checkMonth?>)</h1>
        <?php
            foreach(Yii::app()->user->getFlashes() as $key => $message) {
                echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'.$message.'</div>';
            }
        ?>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading" style="height: 55px;">
                Upcoming Payments (<?php echo $checkMonth?>)
               <span class="pull-right" style="display:inline-flex;">
                    <input type="text" class="form-control calender" id="reminder_date" value="<?php echo date('Y-m-d')?>">&nbsp;&nbsp;
                    <a id="sendRemiderMsg" href="#"><span class="label label-success">Send Message</span></a>&nbsp;
                    <a id="sendWarningMsg" href="#"><span class="label label-warning">Send Warning Message</span></a>&nbsp;
                    <a id="getCsvReport" href="#"><span class="label label-info">CSV Report</span></a>&nbsp;
                    <a id="getWarningLetter" href="#"><span class="label label-danger">Warning Letters</span></a>&nbsp;
                </span><br/>
                
                <span style="margin-top: -5px;"><a href="<?php echo Yii::app()->baseUrl?>/booking/getledgerdetail"><span class="label label-warning btn-sm">All</span></a></span>
                &nbsp;
                <span style="margin-top: -5px;"><a href="<?php echo Yii::app()->baseUrl?>/booking/getledgerdetail?remaining=1"><span class="label label-<?php echo (@$_GET['remaining']==1)?'success':'warning'?> btn-sm">Remaining Dues > 0</span></a></span>

                &nbsp;
                <span style="margin-top: -5px;"><a href="<?php echo Yii::app()->baseUrl?>/booking/getledgerdetail?monthlyCount=1"><span class="label label-<?php echo (@$_GET['monthlyCount']==1)?'success':'warning'?> btn-sm">Monthly Dues > 3</span></a></span>

                &nbsp;
                <span style="margin-top: -5px;"><a href="<?php echo Yii::app()->baseUrl?>/booking/getledgerdetail?remanmonthly=1"><span class="label label-<?php echo (@$_GET['remanmonthly']==1)?'success':'warning'?> btn-sm">Remaining >0 & Monthly <= 3</span></a></span>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body" id="tableBody">
                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables" style="margin-bottom:10%">
                    <thead>
                        <tr>
                            <th class="hide">#</th>
                            <th><input type="checkbox" id="select-all" /></th>
                            <th>Plot #</th>
                            <th>Cutomer Name</th>
                            <th>Mobile Number</th>
                            <th>Booking Date</th>
                            <th>UpComing Type</th>
                            <th>UpComing Payment</th>
                            <th>Booking Ledger</th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php $total = 0;if($result){ foreach($result as $res)://echo '<pre>';print_r($res);exit;?>
                       		<tr>
                                <td class="hidden"><?php echo $res['id']?></td>
                                <?php //if($res['customer']['mobile'] !=''){?>
                                    <td><input type="checkbox" name="bookingId" value="<?php echo $res['id'].'*'.@$res['amount'].'*'.@$res['monthlyCount']?>"></td>
                                <?php /*} else {?>
                                    <td>&nbsp;</td>
                                <?php }*/ ?>
	                            <td><a href="<?php echo Yii::app()->baseUrl?>/booking/viewbooking/<?php echo $res['id']?>"><?php echo '*'.$res['plot']['block_number'].'-'.$res['plot']['plot_type'].'-'.$res['plot']['plot_number']?>*</a></td>
                                <td><?php echo $res['customer']['name']//$this->getBookingRegNo($res['id'])?></td>
                                <td><?php echo $res['customer']['mobile']?></td>
                                <td><?php echo $res['createdOn']?></td>
                                <td><?php echo $res['ledger']?></td>
                                <td><b><?php echo 'PKR '.number_format($res['amount'],2,'.',',')?></b></td>
                                <?php $total = $total + $res['amount'];?>
                                <td>
                                    <a target="_blank" href="<?php echo Yii::app()->baseUrl.'/booking/bookingledger/'.$res['id']?>"><span class="label label-success">Booking Ledger</span></a>&nbsp;<br/>
                                    <?php if($res['flag_status']==2){?>
                                        <span class="aLink label label-success">Received By Customer</span>&nbsp;
                                    <?php } ?>
                                    <?php if($res['flag_status']==1){?>
                                        <span class="aLink label label-warning">File Complete</span>&nbsp;
                                    <?php } ?>
                                    <?php if($res['flag_status']==0){?>
                                        <span class="aLink label label-danger">File Incomplete</span>&nbsp;
                                    <?php } ?>

                                    <?php if($res['customerPlotTransactionSum'] >= $this->discountedPlotCostOfLand($res['plot']['id'])) {?>
                                    <span class="label label-success" style="text-decoration: none;">Cost of Land Paid</span>
                                    <?php }?>

                                    <?php if($res['customerPlotTransactionSum'] >= $this->discountedPlotCostOfLandAndExtra($res['plot']['id'])) {?>
                                    <br/><span class="label label-success" style="text-decoration: none;">Plot Total Paid</span>
                                    <?php }?>
                                </td>
	                        </tr>
                       <?php endforeach;}?>
                       <!-- <tr>
                           <td colspan="3"><center><b>Total</b></center></td>
                           <td><b><?php //echo number_format($total,2,'.',',')?></b></td>
                       </tr> -->
                    </tbody>
                </table>
                <table width="100%" class="table table-striped table-bordered table-hover" style="bottom: 0;
    position: fixed;
    background-color: #ddd;
    width: 30%;">
                    <thead>
                        <th><center><b>Total Record</b></center></th>
                        <th><center><b>Total Amount</b></center></th>
                    </thead>
                    <tbody>
                        <tr>
                            <td><center><b><?php echo count($result)?></b></center></td>
                            <td><center><b><?php echo number_format($total)?></b></center></td>
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


<form id="reminderMsgForm" method="POST" action="<?php echo Yii::app()->baseUrl?>/booking/sendupcomingmessage">
    <input type="hidden" name="booking_id_value" id="booking_id_reminder">
    <input type="hidden" name="reminder_date_value" id="reminder_date_value">
</form>


<form id="warningMsgForm" method="POST" action="<?php echo Yii::app()->baseUrl?>/booking/sendwarningmessage">
    <input type="hidden" name="booking_warning_id_value" id="booking_warning_id_value">
    <input type="hidden" name="warning_msg_date_value" id="warning_msg_date_value">
</form>

<form id="csvForm" method="POST" action="<?php echo Yii::app()->baseUrl?>/booking/csvReport">
    <input type="hidden" name="booking_id_csv" id="booking_id_csv">
</form>

<form id="warningLetterForm" method="POST" action="<?php echo Yii::app()->baseUrl?>/booking/warningLetter">
    <input type="hidden" name="booking_id_warning" id="booking_id_warning">
    <input type="hidden" name="warning_date_value" id="warning_date_value">
</form>
<script type="text/javascript">
    $(document).on('click', '#report2btn', function (e) {
       var divToPrint=document.getElementById("tableBody");
       newWin= window.open("");
       var heading = '<div><h3>Kainat City<span style="margin-left:25%">Kainat City</span><span style="float:right">All Dealers</h3></div>';
       newWin.document.write('<style>table, th, td {border: 1px solid black;} .dnone{display:none}</style>'+heading+divToPrint.outerHTML);
       newWin.print();
       newWin.close();
    });

</script>