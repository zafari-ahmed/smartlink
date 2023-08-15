<?php $userModel = Yii::app()->session->get('userModel');?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">DetailReport</h1>
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
            <div class="panel-heading">
                Filter
            </div>
            <div class="panel-body">
                <div class="row">
                    <form role="form" method="POST" action="<?php echo Yii::app()->baseUrl?>/report/search6">
                        <!-- <div class="col-lg-12"> -->
                            <div class="form-group col-lg-4" >
                                <label>Start Date</label>
                                <input class="form-control calender" name="start_date" value="<?php echo @$_POST['start_date']?>" autocomplete="off">
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>
                            <div class="form-group col-lg-4">
                                <label>End Date</label>
                                <input class="form-control calender" name="end_date" value="<?php echo @$_POST['end_date']?>" autocomplete="off">
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>

                            <div class="form-group col-lg-3">
                                <button type="submit" class="btn btn-success" style="margin-top: 9%;">Submit</button>
                            </div>
                        <!-- </div> -->
                            
                        </form>
                    </div>
                    <!-- /.col-lg-6 (nested) -->
                </div>
                <!-- /.row (nested) -->
            </div>
            <!-- /.panel-body -->
        </div>
<?php
$mainTotal = 0;
$totalR = [];
$totalP = [];
?>
    <?php if(@$model){?>
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Account(s) Report
                <span class="pull-right"><a href="javascript:void(0)" id="report2btn"><span class="label label-success">Print</span></a></span>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body" id="tableBody">
                <table width="100%" class="table table-striped table-bordered table-hover" id="report2table" style="font-size: 12px">
                    <thead>
                        <tr>
                            <th>Plot #</th>
                            <th>Client Name</th>
                            <th>Trans. #</th>
                            <th>Trans. Type</th>
                            <th>Payment Mode</th>
                            <th>Amount</th>
                            <?php $accTotal = [];foreach($accounts as $account):?>
                                <th><?php echo ucwords($account->name)?></th>
                                <?php $accTotal[$account->id] = 0;?>
                            <?php endforeach;?>
                            
                            <th>Created On</th>
                            <th>Created By</th>
                            <!-- <th>Action</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php $agent=0;$aTotal=0;$dtotal = 0;$expenseTotal = 0;if(@$model){ foreach($model as $data):?>
                            <tr class="hide">
                                <td><a href="<?php echo Yii::app()->baseUrl?>/booking/viewbooking/<?php echo $data->plot->id?>"><?php echo @$data->plot->plot->block_number.' / '.@$data->plot->plot->plot_number?></a></td>
                                <td><?php echo $data->plot->customer->name?></td>
                                <td><?php echo ($this->startsWith($data->transaction_number, '#'))?$data->transaction_number:'#'.$data->transaction_number?></td>
                                <td><?php echo @$data->transaction_type?></td>
                                <td><?php echo @$data->plotPaymentMode->mode?></td>

                                <td><?php echo 'Rs. '.number_format($data->amount)?></td>
                                <?php $aTotal = $aTotal + $data->amount;?>
                                
                                <?php foreach($accounts as $account): if(strtolower($data->plotPaymentMode->mode) != 'monthly' && strtolower($data->plotPaymentMode->mode) != 'extra' && strtolower($data->plotPaymentMode->mode) != 'demarcation' && strtolower($data->plotPaymentMode->mode) != 'possession'){?>
                                
                                    <?php if($data->plot->is_special != 0 && $data->plot->is_special != ''){
                                            if($account->id == $data->plot->is_special){
                                                echo '<td>Rs. '.number_format($data->amount).'</td>';
                                                $accTotal[$account->id] = $accTotal[$account->id] + $data->amount;
                                            } else{
                                                echo '<td>-</td>';
                                            }
                                    } else {
                                    $agent = $this->Percentage($data->amount,$account->percentage,0)?>

                                    <?php if($account->is_distributed==1){?>
                                        <?php if($data->plot->is_agent == 1) {?>
                                                <?php 
                                                    $agentRs = @$this->DealerPercentage(@$data->plot->agent,@$data->amount,@$data->plot->agent->percentage,0,@$data->plotPaymentMode);
                                                    $accRs = $this->Percentage(@$data->amount,@$account->percentage,0);
                                                ?>
                                            <td><?php echo 'Rs. '.number_format($accRs-$agentRs)?></td>
                                            <?php $accTotal[$account->id] = $accTotal[$account->id] + ($accRs-$agentRs);?>
                                        <?php } else{?>
                                            <td><?php echo 'Rs. '.$this->Percentage($data->amount,$account->percentage)?></td>
                                            <?php $accTotal[$account->id] = $accTotal[$account->id] + $this->Percentage($data->amount,$account->percentage,0);?>
                                        <?php } ?>
                                        
                                    <?php } else if($account->is_installment != 1){?>
                                        <td><?php echo 'Rs. '.$this->Percentage($data->amount,$account->percentage)?></td>
                                        <?php $accTotal[$account->id] = $accTotal[$account->id] + $this->Percentage($data->amount,$account->percentage,0);?>
                                    <?php } else{echo '<td>-</td>';} ?>

                                    
                                
                                <?php } } else{ if($account->is_distributed == 0 && $account->is_installment == 1){?>
                                
                                        <td><?php echo 'Rs. '.number_format($data->amount)?></td>
                                        <?php $accTotal[$account->id] = $accTotal[$account->id] + $data->amount;?>
                                
                                <?php } else{ echo '<td>-</td>';}} endforeach;?>
                                

                                <td>
                                    <?php if($data->plot->agent_id && strtolower($data->plotPaymentMode->mode) != 'monthly' && strtolower($data->plotPaymentMode->mode) != 'extra' && strtolower($data->plotPaymentMode->mode) != 'demarcation' && strtolower($data->plotPaymentMode->mode) != 'possession'){ 

                                        if($data->plotPaymentMode->is_distribute == 1){
                                            echo 'Rs. '.$this->DealerPercentage(@$data->plot->agent,@$data->amount,$data->plot->agent->percentage,1,@$data->plotPaymentMode).' - '.@$data->plot->agent->name;    
                                            $dtotal = $dtotal + $this->DealerPercentage(@$data->plot->agent,@$data->amount,@$data->plot->agent->percentage,0,@$data->plotPaymentMode);
                                        } else{ echo '-';}
                                        
                                    } ?>
                                </td>
                                <td><?php 
                                    if(strtolower($data->plotPaymentMode->mode) != 'monthly' && strtolower($data->plotPaymentMode->mode) != 'extra' && strtolower($data->plotPaymentMode->mode) != 'demarcation' && strtolower($data->plotPaymentMode->mode) != 'possession'){
                                        
                                        if($data->plot->is_special != 0 && $data->plot->is_special != ''){
                                                if($data->plot->is_special == 2){
                                                    echo 'Rs. '.number_format($data->amount);
                                                    $expenseTotal = $expenseTotal + $data->amount;
                                                }
                                        } else {
                                            echo 'Rs. '.number_format(($data->amount/count($partners)) - @$this->DealerPercentage(@$data->plot->agent,@$data->amount,@$data->plot->agent->percentage,0,@$data->plotPaymentMode));
                                            
                                            $ex = ($data->amount/count($partners)) - @$this->DealerPercentage(@$data->plot->agent,@$data->amount,@$data->plot->agent->percentage,0,@$data->plotPaymentMode);
                                            
                                            $expenseTotal = $expenseTotal + $ex;
                                        }
                                    }
                                    ?></td>


                                
                                <td><?php echo date('d M,Y',strtotime($data->createdOn))?></td>
                                <td><?php echo $data->createdBy?></td>
                                <!-- <td><?php //echo ($data->status==0)?'<span class="label label-danger">Pending</span>':'<span class="label label-success">Paid</span>'?></td> -->
                            </tr>
                       <?php endforeach;}?>
                       <tr>
                           <td colspan="5"><b>Total:</b></td>
                           <td><b><?php echo 'Rs. '.@number_format($aTotal)?></b></td>
                            <?php foreach($accounts as $account):?>
                                <td><b><?php echo 'Rs. '.number_format($accTotal[$account->id])?></b></td>
                            <?php endforeach;?>
                            <td><b><?php echo 'Rs. '.@number_format($dtotal)?></b></td>
                            <td><b><?php echo 'Rs. '.@number_format($expenseTotal)?></b></td>
                            <td colspan="3"></td>
                       </tr>
                        <?php if(@$cancelled){ foreach(@$cancelled as $cancel): if($cancel->booking){?>
                            <tr class="hide">
                               <td><a href="<?php echo Yii::app()->baseUrl?>/plot/view/<?php echo @$cancel->booking->plot->id?>"><?php echo @$cancel->booking->plot->block_number.' / '.@$cancel->booking->plot->plot_number?></a></td>
                               
                                <td colspan="4" style="text-align: center;"><b>Cancelled</b></td>
                                <td></td>
                                <td><?php echo @($cancel->account_id==1)?'Rs. '.number_format($cancel->amount):0?></td>
                                <?php if(@$cancel->account_id == 1){ 
                                    $accTotal[1] = $accTotal[1] - round($cancel->amount);
                                }?>
                                <td></td>
                                <td><?php echo @($cancel->account_id==3)?'Rs. '.number_format($cancel->amount):0?></td>
                                <?php if(@$cancel->account_id == 3){ 
                                    $accTotal[3] = $accTotal[3] - round($cancel->amount);
                                }?>
                                <td></td>
                                <td><?php echo @($cancel->account_id==4)?'Rs. '.number_format($cancel->amount):0?></td>
                                <?php if(@$cancel->account_id == 4){ 
                                    $expenseTotal = $expenseTotal - round($cancel->amount);
                                }?>
                                <td><?php echo date('d M,Y',strtotime($cancel->createdOn))?></td>
                                <td><?php //echo ucwords($userModel['first_name'].' '.$userModel['last_name'])?></td>
                           </tr>
                        <?php }endforeach;?>
                       <tr>
                           <td colspan="5"><b>Total:</b></td>
                           <td><b><?php echo 'Rs. '.@number_format($aTotal)?></b></td>
                            <?php foreach($accounts as $account):?>
                                <td><b><?php echo 'Rs. '.number_format($accTotal[$account->id])?></b></td>
                            <?php endforeach;?>
                            <td><b><?php echo 'Rs. '.@number_format($dtotal)?></b></td>
                            <td><b><?php echo 'Rs. '.@number_format($expenseTotal)?></b></td>
                            <td colspan="3"></td>
                       </tr>
                        <?php }?>
                    </tbody>
                </table>

                <?php if(@$transactions) { foreach(@$transactions['transactions'] as $key=>$transaction){ ?>
                        <h3><?php echo ucfirst($key)?></h3>
                        <table width="100%" class="table table-striped table-bordered table-hover" id="report2table">
                            <thead>
                                <tr>
                                    <th>Plot #</th>
                                    <th>Client Name</th>
                                    <th>Transaction #</th>
                                    <th>Transaction Type</th>
                                    <th>Payment Mode</th>
                                    <th>Amount</th>
                                    <th>Created On</th>
                                    <th>Created By</th>
                                    <!-- <th>Action</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php $total = 0;if(@$transaction){ foreach($transaction as $data): if(isset($data['plot'])){?>
                                    <tr class="hide">
                                        <td><a href="<?php echo Yii::app()->baseUrl?>/booking/viewbooking/<?php echo $data['id']?>"><?php echo @$data['plot']?></a></td>
                                        <?php array_push($totalP, $data['plot']); ?>
                                        <td><?php echo @$data['customer_name']?></td>
                                        <td><?php echo @$data['transaction_number']?></td>
                                        <?php array_push($totalR, $data['transaction_number']); ?>
                                        <td><?php echo @$data['transaction_type']?></td>
                                        <td><?php echo ucfirst(@$data['plot_payment_mode'])?></td>
                                        <td><?php echo @$data['amount']?></td>
                                        <?php //$mainTotal = $mainTotal + $data['amount']?>
                                        <td><?php echo @$data['createdOn']?></td>
                                        <td><?php echo @$data['createdBy']?></td>
                                    </tr>
                               <?php } endforeach;} ?>
                               <tr>
                                   <td colspan="5">
                                       <b>Total</b>
                                   </td>
                                   <td colspan="3"><b><?php echo 'Rs. '.number_format($transaction['total'])?></b></td>
                                   <?php $mainTotal = $transaction['total']?>
                               </tr>
                            </tbody>
                        </table>
                <?php } }?>


                <table width="100%" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Expense Type</th>
                            <th>Description</th>
                            <th>Amount</th>
                            <th>User</th>
                            <th>CreatedOn</th>
                            <th>Status</th>
                            <th>Reason</th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php $expTotal = 0;if($expenses){ foreach($expenses as $expense):?>
                            <tr >
                                <td><?php echo $expense->expense_type?></td>
                                <td><?php echo $expense->description?></td>
                                <td><?php echo 'Rs. '.$expense->amount?></td>
                                <?php $expTotal = $expTotal + (($expense->status==1)?($expense->amount):0);?>
                                <td><?php echo @$expense->user->first_name.''.@$expense->user->last_name?></td>
                                <td><?php echo date('d M,o H:i',strtotime($expense->createdOn))?></td>
                                <td><?php echo ($expense->status==0)?'<span class="label label-danger">Rejected</span>':'<span class="label label-success">Approved</span>'?>&nbsp;<?php if($userModel['user_type']['id'] ==1) {?><a class="deleteExpense" href="<?php echo Yii::app()->baseUrl?>/expenses/delete/<?php echo $expense->id?>"><span class="aLink label label-danger">Delete</span></a>&nbsp;<?php } ?></td>
                                <td><?php echo ($expense->status==1)?'-':$expense->reason?></td>
                            </tr>
                       <?php endforeach;}?>

                       <tr>
                           <td colspan="2"><b>Total:</b></td>
                           <td colspan="5"><b><?php echo 'Rs. '.number_format($expTotal)?></b></td>
                       </tr>
                    </tbody>
                </table>



                <table width="100%" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Income Amount</th>
                            <th>Expense Amount</th>
                            <th>Remaining</th>
                        </tr>
                    </thead>
                    <tbody>
                       <tr>
                           <td><?php echo 'Rs. '.@number_format($aTotal)?></td>
                           <td><?php echo 'Rs. '.@number_format($expTotal)?></td>
                           <td><?php echo 'Rs. '.@number_format($aTotal-$expTotal)?></td>
                       </tr>
                    </tbody>
                </table>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <?php }?>
    <!-- /.col-lg-12 -->
</div>

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