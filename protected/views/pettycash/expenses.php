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
                            <th>Desc</th>
                            <th>Amount</th>
                            <th>Mode</th>
                            <th>Paid To</th>
                            <th>Cr. By</th>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php $total = 0;if($expenses){ foreach($expenses as $expense):?>
                       		<tr>
                                <td class="hidden"><?php echo $expense->id?></td>
                                <!-- <td><?php //echo $this->getExpenseRegNo($expense->id)?></td> -->
	                            <td><?php echo substr($expense->description, 0, 150);?></td>
	                            <td><?php echo 'Rs. '.number_format($expense->amount)?></td>
                                <?php $total = $total + (($expense->status==1)?($expense->amount):0);?>
                                <td><?php echo @$expense->payment_mode?></td>
                                <td><?php echo ucfirst(@$expense->paid_to)?></td>
                                <td><?php echo @$expense->user->first_name.''.@$expense->user->last_name?></td>

	                            <td><?php echo date('d M,o H:i',strtotime($expense->createdOn))?></td>
	                            <td>
                                    <span class="label label-success">Approved</span>
                                    <?php if($userModel['user_type']['id'] ==1 || $userModel['user_type']['id'] == 5) {?>
                                        <a class="deleteExpense" href="<?php echo Yii::app()->baseUrl?>/pettycash/delete/id/<?php echo $expense->id?>"><span class="aLink label label-danger">Delete</span></a>
                                        
                                    <?php } ?>
                                    
                                </td>
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