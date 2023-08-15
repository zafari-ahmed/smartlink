<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Expenses</h1>
        <?php
            foreach(Yii::app()->user->getFlashes() as $key => $message) {
                echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'.$message.'</div>';
            }
        ?>
    </div>
    <!-- /.col-lg-12 -->
</div>

<?php $userModel = Yii::app()->session->get('userModel'); ?>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                All Expenses
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables">
                    <thead>
                        <tr>
                            <th class="hide">#</th>
                            <th>#</th>
                            <th>H.O.A</th>
                            <th>Desc</th>
                            <th>Amount</th>
                            <th>Mode</th>
                            <th>Bank</th>
                            <th>Ref.</th>
                            <th>Paid To</th>
                            <th>CNIC/NTN</th>
                            <th>Cr. By</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Reason</th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php $total = $PCETotal = $PCTotal = 0;if($expenses){ foreach($expenses as $expense):?>
                       		<tr>
                                <td class="hidden"><?php echo $expense->createdOn?></td>
                                <?php if(isset($expense->account_id)){?>
                                    <td><?php echo $this->getExpenseRegNo($expense->id,'expense')?></td>
                                    
                                    <?php if($expense->expense_type != 15){?>
                                        <?php $total = $total + (($expense->status==1)?($expense->amount):0);?>
                                    <?php }?>
                                
                                <?php } else{?>
                                    <td><?php echo $this->getExpenseRegNo($expense->id,'pettyCash')?></td>
                                    <?php $PCETotal = $PCETotal + (($expense->status==1)?($expense->amount):0);?>
                                <?php }?>
                                
	                            <td><?php echo ucfirst($this->expenseType(@$expense->expense_type))?></td>
                                <td><?php echo substr($expense->description, 0, 150);?></td>
	                            <td><?php echo 'Rs. '.number_format($expense->amount)?></td>
                                
                                <td><?php echo @$expense->payment_mode?></td>
                                <td><?php echo @isset($expense->bank)?$expense->bank:'-'?></td>
                                <td><?php echo isset($expense->number)?('*'.$expense->number.'*'):''?></td>
                                <td><?php echo ucfirst(@$expense->paid_to)?></td>
                                <td><?php echo isset($expense->cnic)?$expense->cnic:''?></td>
                                <td><?php echo @$expense->user->first_name.''.@$expense->user->last_name?></td>

	                            <td><?php echo date('d M,o H:i',strtotime($expense->createdOn))?></td>
	                            <td>
                                    <?php if($expense->status==0){?>
                                    <span class="label label-danger">Rejected</span>
                                    <?php } ?>
                                    <?php if($expense->status==1){?>
                                    <span class="label label-success">Approved</span>
                                    <?php if($userModel['user_type']['id'] == 1 ||  $userModel['user_type']['id'] == 5){?>
                                            <?php if(isset($expense->account_id)){?>
                                                <a class="deleteExpense" href="<?php echo Yii::app()->baseUrl?>/expenses/delete/status/0/id/<?php echo $expense->id?>"><span class="aLink label label-danger">Reject</span></a>
                                            <?php } ?>
                                    <?php }} ?>


                                    <?php if(isset($expense->account_id)){?>
                                        <?php if($expense->status==2){?>
                                        <span class="label label-warning">Pending</span><br/>
                                        <?php if($userModel['user_type']['id'] == 1 ||  $userModel['user_type']['id'] == 5){?>
                                        <a class="deleteExpense" href="<?php echo Yii::app()->baseUrl?>/expenses/delete/status/1/id/<?php echo $expense->id?>"><span class="aLink label label-success">Approve</span></a><br/>
                                        <a class="deleteExpense" href="<?php echo Yii::app()->baseUrl?>/expenses/delete/status/0/id/<?php echo $expense->id?>"><span class="aLink label label-danger">Reject</span></a>
                                        <?php }} ?>
                                        <?php if($userModel['user_type']['id'] ==1 || $userModel['user_type']['id'] == 5) {?>
                                            <a class="deleteExpense" href="<?php echo Yii::app()->baseUrl?>/expenses/delete/status/<?php echo $expense->status?>/id/<?php echo $expense->id?>"><span class="aLink label label-danger">Delete</span></a>
                                            
                                        <?php } ?>
                                        &nbsp;<a href="<?php echo Yii::app()->baseUrl?>/expenses/edit/<?php echo $expense->id?>"><span class="aLink label label-warning">Edit</span></a>
                                        <?php if($expense->status!=2){?>
                                        <a target="_blank" href="<?php echo Yii::app()->baseUrl?>/expenses/expenseinvoice/<?php echo $expense->id?>"><span class="aLink label label-success">Print</span></a>
                                        <?php } ?>
                                    <?php } else{?>
                                        <!-- <a class="deleteExpense" href="<?php //echo Yii::app()->baseUrl?>/pettycash/delete/id/<?php //echo $expense->id?>"><span class="aLink label label-danger">Delete</span></a> -->

                                        <?php if($expense->status==2){?>
                                        <span class="label label-warning">Pending</span><br/>
                                        <?php if($userModel['user_type']['id'] == 1 ||  $userModel['user_type']['id'] == 5){?>
                                        <a class="deleteExpense" href="<?php echo Yii::app()->baseUrl?>/pettycash/delete/status/1/id/<?php echo $expense->id?>"><span class="aLink label label-success">Approve</span></a><br/>
                                        <a class="deleteExpense" href="<?php echo Yii::app()->baseUrl?>/pettycash/delete/status/0/id/<?php echo $expense->id?>"><span class="aLink label label-danger">Reject</span></a>
                                        <?php }} ?>
                                        <?php if($userModel['user_type']['id'] ==1 || $userModel['user_type']['id'] == 5) {?>
                                            <a class="deleteExpense" href="<?php echo Yii::app()->baseUrl?>/pettycash/delete/status/2/id/<?php echo $expense->id?>"><span class="aLink label label-danger">Delete</span></a>
                                            
                                        <?php } ?>
                                        &nbsp;<a href="<?php echo Yii::app()->baseUrl?>/pettycash/edit/<?php echo $expense->id?>"><span class="aLink label label-warning">Edit</span></a>
                                        <?php if($expense->status!=2){?>
                                        <a target="_blank" href="<?php echo Yii::app()->baseUrl?>/expenses/expenseinvoice/id/<?php echo $expense->id?>/type/pettyCash"><span class="aLink label label-success">Print</span></a>
                                        <?php } ?>
                                    <?php } ?>
                                </td>
                                <td><?php echo ($expense->status==1)?'-':$expense->reason?></td>
	                        </tr>
                       <?php endforeach;}?>
                    </tbody>
                </table>

                <?php if($userModel['user_type']['id'] == 1 ||  $userModel['user_type']['id'] == 5){?>
                    <table width="100%" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Petty Cash</th>
                                <th>P.C Expense</th>
                                <th>P.C Remaining</th>
                                <th>Expense</th>
                            </tr>
                            <tr>
                                <?php
                                $command = Yii::app()->db->createCommand("SELECT sum(e.amount) FROM petty_cash pc JOIN expenses e ON pc.expense_id = e.id WHERE e.status = 1");
                                $PCTotal = $command->queryScalar();
                                ?>
                                <th><?php echo 'PKR '.number_format($PCTotal).' /='?></th>
                                <th><?php echo 'PKR '.number_format($PCETotal).' /='?></th>
                                <th><?php echo 'PKR '.number_format($PCTotal-$PCETotal).' /='?></th>
                                <th><?php echo 'PKR '.number_format($total).' /='?></th>
                            </tr>
                        </thead>
                    </table>
                <?php }?>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>