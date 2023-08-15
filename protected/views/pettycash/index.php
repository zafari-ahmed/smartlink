<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Petty Cash</h1>
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
                All Petty Cash
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
                       <?php $total = 0;if($expenses){ foreach($expenses as $expense):?>
                       		<tr>
                                <td class="hidden"><?php echo $expense->expense->id?></td>
                                <td><?php echo $this->getExpenseRegNo($expense->expense->id)?></td>
	                            <td><?php echo ucfirst($this->expenseType(@$expense->expense->expense_type))?></td>
                                <td><?php echo substr($expense->expense->description, 0, 150);?></td>
	                            <td><?php echo 'Rs. '.number_format($expense->expense->amount)?></td>
                                <?php $total = $total + (($expense->expense->status==1)?($expense->expense->amount):0);?>
                                <td><?php echo @$expense->expense->payment_mode?></td>
                                <td><?php echo @$expense->expense->bank?></td>
                                <td><?php echo '*'.@$expense->expense->number.'*'?></td>
                                <td><?php echo ucfirst(@$expense->expense->paid_to)?></td>
                                <td><?php echo @$expense->expense->cnic?></td>
                                <td><?php echo @$expense->expense->user->first_name.''.@$expense->expense->user->last_name?></td>

	                            <td><?php echo date('d M,o H:i',strtotime($expense->expense->createdOn))?></td>
	                            <td>
                                    <?php if($expense->expense->status==0){?>
                                    <span class="label label-danger">Rejected</span>
                                    <?php } ?>
                                    <?php if($expense->expense->status==1){?>
                                    <span class="label label-success">Approved</span>
                                    <?php if($userModel['user_type']['id'] == 1 ||  $userModel['user_type']['id'] == 5){?>
                                    <a class="deleteExpense" href="<?php echo Yii::app()->baseUrl?>/expenses/delete/status/0/id/<?php echo $expense->expense->id?>"><span class="aLink label label-danger">Reject</span></a>
                                    <?php }} ?>
                                    <?php if($expense->expense->status==2){?>
                                    <span class="label label-warning">Pending</span><br/>
                                    <?php if($userModel['user_type']['id'] == 1 ||  $userModel['user_type']['id'] == 5){?>
                                    <a class="deleteExpense" href="<?php echo Yii::app()->baseUrl?>/expenses/delete/status/1/id/<?php echo $expense->expense->id?>"><span class="aLink label label-success">Approve</span></a><br/>
                                    <a class="deleteExpense" href="<?php echo Yii::app()->baseUrl?>/expenses/delete/status/0/id/<?php echo $expense->expense->id?>"><span class="aLink label label-danger">Reject</span></a>
                                    <?php }} ?>
                                    <?php if($userModel['user_type']['id'] ==1 || $userModel['user_type']['id'] == 5) {?>
                                        <a class="deleteExpense" href="<?php echo Yii::app()->baseUrl?>/expenses/delete/status/<?php echo $expense->expense->status?>/id/<?php echo $expense->expense->id?>"><span class="aLink label label-danger">Delete</span>
                                        
                                    <?php } ?>
                                    </a>&nbsp;<a href="<?php echo Yii::app()->baseUrl?>/expenses/edit/<?php echo $expense->expense->id?>"><span class="aLink label label-warning">Edit</span></a>
                                    <?php if($expense->expense->status!=2){?>
                                    <a target="_blank" href="<?php echo Yii::app()->baseUrl?>/expenses/expenseinvoice/<?php echo $expense->expense->id?>"><span class="aLink label label-success">Print</span></a>
                                    <?php } ?>
                                </td>
                                <td><?php echo ($expense->expense->status==1)?'-':$expense->expense->reason?></td>
	                        </tr>
                       <?php endforeach;}?>
                    </tbody>
                </table>

                <table width="100%" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Total</th>
                            <th><?php echo 'PKR '.number_format($total).' /='?></th>
                        </tr>
                    </thead>
                </table>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>