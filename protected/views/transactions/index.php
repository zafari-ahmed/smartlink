<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><?php echo ($status==0)?'Cancelled':'All'?> Transactions</h1>
        <?php
            foreach(Yii::app()->user->getFlashes() as $key => $message) {
                echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'.$message.'</div>';
            }
        ?>
    </div>
    <!-- /.col-lg-12 -->
</div>
<?php $userModel = Yii::app()->session->get('userModel');?>
<!-- /.row -->
<div class="row">
    <!-- <div class="col-lg-12"> -->
        
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <?php echo ($status==0)?'Cancelled':'All'?> Transactions
                <span class="pull-right">
                    <a href="<?php echo Yii::app()->baseUrl.'/booking/reportalltransaction/status/'.$status?>"><span class="label label-success">CSV Download</span></a>
                        &nbsp;
                    <a href="javascript:void(0)" id="report2btn"><span class="label label-success">Print</span></a>
                </span>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body" id="tableBody">
                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables">
                    <thead>
                        <tr>
                            <th class="hide">#</th>
                            <th>Plot #</th>
                            <th>Client Name</th>
                            <th>Transaction #</th>
                            <th>Transaction Type</th>
                            <th>Payment Mode</th>
                            <th>Amount</th>
                            <th>Remarks</th>
                            <th>Created On</th>
                            <th>Created By</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        <?php $total = 0;$deleteClass = 'color: white;background-color: #283747;';if(@$trasactions){ foreach($trasactions as $data):?>

                            <?php 
                            $color = '';
                            if($data->status==0 || $data->plot->status==0){
                                $color = 'color: #283747;background-color: #AEB6BF;';
                            }

                            if($data->status==0 && (isset($data->reason) && $data->reason !='')){
                                $color = 'color: #000;background-color: #f19488!important;font-weight: bold;';
                            }
                            
                            ?>
                            <tr style="<?php echo $color?>">
                                <td class="hidden"><?php echo (int) $data->transaction_number?></td>
                                <td><a href="<?php echo Yii::app()->baseUrl?>/booking/viewbooking/<?php echo $data->plot->id?>"><?php echo @$data->plot->plot->block_number.'-'.@$data->plot->plot->plot_type.'-'.@$data->plot->plot->plot_number?>*</a></td>
                                <td><?php echo $data->customer->name?></td>
                                <td><?php echo ($this->startsWith($data->transaction_number, '#'))?$data->transaction_number:'#'.ltrim($data->transaction_number,0)?></td>
                                <td><?php echo @ucfirst($data->transaction_type)#d9534f?></td>
                                <td>
                                    <?php $typeMsg = 'transaction';if(isset($data->plot_payment_mode_id)){?> 
                                    <?php echo ucfirst(@$data->plotPaymentMode->mode)?>
                                    <?php $typeMsg = 'transaction';?>
                                    <?php } else {?>
                                    <?php echo ucfirst(@$data->plot_payment_mode)?>
                                    <?php $typeMsg = 'other';?>
                                    <?php }?>
                                </td>
                                <td><?php echo 'Rs. '.number_format($data->amount)?></td>
                                <?php if($status==1){
                                        //if($data->status == 1 &&  $data->plot->status==1){?>
                                	       <?php $total = $total + $data->amount?>
                            	       <?php //}?>
                                <?php } else{?>
                                    <?php //$total = $total + $data->amount?>
                                <?php }?>
                                <td><?php echo $data->comment?></td>
                                <td><?php echo date('d M,Y',strtotime($data->createdOn))?></td>
                                
                                <td>
                                	<?php echo $data->createdBy?>
                                	<?php if($data->status == 0 || $data->plot->status==0){?>
                                		<br/>Reason: <?php echo isset($data->plot_payment_mode_id)?@$data->reason:@$data->monthlyDate?>
                                	<?php } ?>
                                </td>
                                <td>
                                    
                                    <a target="_blank" href="<?php echo Yii::app()->baseUrl?>/booking/dublicateinvoice/plot/<?php echo $data->plot->id?>/transaction/<?php echo str_replace('#', '', ltrim($data->transaction_number,0))?>"><span class="label label-success">Print</span></a>&nbsp;

                                    <?php if($status !=0){?>
                                        <a target="_blank" class="performTask" href="<?php echo Yii::app()->baseUrl?>/api/messages/type/<?php echo $typeMsg?>/id/<?php echo str_replace('#', '', $data->transaction_number)?>"><span title="<?php echo $this->getTransactionMessage(str_replace('#', '', $data->transaction_number),$typeMsg)?>" class="label label-primary">Transaction Message</span></a>
                                    <?php }?>
                                   
                                </td>
                                
                            </tr>
                       <?php endforeach;}?>
                       
                    </tbody>
                </table>
                <hr/>
                <h3 class="hide">Extra Transactions</h3>
                <table width="100%" class="table table-striped table-bordered table-hover hide" id="dataTables">
                    <thead>
                        <tr>
                            <th class="hide">#</th>
                            <th>Plot #</th>
                            <th>Client Name</th>
                            <th>Transaction #</th>
                            <th>Transaction Type</th>
                            <th>Payment Mode</th>
                            <th>Amount</th>
                            <th>Remarks</th>
                            <th>Created On</th>
                            <th>Created By</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $totalExtra = 0;$deleteClass = 'color: white;background-color: #283747;';if(@$trasactionsExtra){ foreach($trasactionsExtra as $data):?>
                            <tr style="<?php echo ($data->status==0 || $data->plot->status==0)?'color: #283747;background-color: #AEB6BF;':''?>">
                                <td class="hidden"><?php echo $data->id?></td>
                                <td><a href="<?php echo Yii::app()->baseUrl?>/booking/viewbooking/<?php echo $data->plot->id?>"><?php echo @$data->plot->plot->block_number.'-'.@$data->plot->plot->plot_type.'-'.@$data->plot->plot->plot_number?>*</a></td>
                                <td><?php echo $data->plot->customer->name?></td>
                                <td><?php echo ($this->startsWith($data->transaction_number, '#'))?$data->transaction_number:'#'.ltrim($data->transaction_number,0)?></td>
                                <td><?php echo @ucfirst($data->transaction_type)#d9534f?></td>
                                <td><?php echo @ucfirst($data->plot_payment_mode)?></td>
                                <td><?php echo 'Rs. '.number_format($data->amount)?></td>
                                <?php if($data->status == 1 &&  $data->plot->status==1){?>
                                    <?php $totalExtra = $totalExtra + $data->amount?>
                                <?php }?>
                                <td><?php echo $data->comment?></td>
                                <td><?php echo date('d M,Y',strtotime($data->createdOn))?></td>
                                
                                <td>
                                    <?php echo $data->createdBy?>
                                    <?php if($data->status == 0 || $data->plot->status==0){?>
                                        <br/>Reason: <?php echo $data->monthlyDate?>
                                    <?php } ?>
                                </td>
                                <td>
                                    
                                    <a target="_blank" href="<?php echo Yii::app()->baseUrl?>/booking/dublicateinvoice/plot/<?php echo $data->plot->id?>/transaction/<?php echo str_replace('#', '', ltrim($data->transaction_number,0))?>"><span class="label label-success">Print</span></a>&nbsp;

                                    <?php if($status !=0){?>
                                        <a target="_blank" class="performTask" href="<?php echo Yii::app()->baseUrl?>/api/messages/type/transaction/id/<?php echo str_replace('#', '', $data->transaction_number)?>"><span title="<?php echo $this->getTransactionMessage(str_replace('#', '', $data->transaction_number))?>" class="label label-primary">Transaction Message</span></a>
                                    <?php }?>
                                </td>
                                
                            </tr>
                       <?php endforeach;}?>
                       
                    </tbody>
                </table>

                <?php if(isset($trasactions)){?>
                <table width="100%" class="table table-striped table-bordered table-hover" id="report2table">
                    <th>Total Amount</th>
                    <!-- <th>Extra Total Amount</th> -->
                    <tr style="font-weight: bold;">
                       <td><?php echo 'Rs. '.number_format(@$total)?></td>
                      <!--  <td><?php //echo 'Rs. '.number_format(@$totalExtra)?></td> -->
                   </tr>
               </table>
                <?php }?>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
<!-- </div> -->

<script type="text/javascript">
    $(document).on('click', '#report2btn', function (e) {
       var divToPrint=document.getElementById("tableBody");
       newWin= window.open("");
       var heading = '<div><h3>Kainat City<span style="margin-left:25%">Kainat City</span><span style="float:right">Dated: <?php echo @$_POST['start_date']?> / <?php echo @$_POST['end_date']?></span></h3></div>';
       newWin.document.write('<style>table, th, td {border: 1px solid black;}</style>'+heading+divToPrint.outerHTML);
       newWin.print();
       newWin.close();
    });

</script>