<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Expense Report</h1>
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
                    <form role="form" method="POST" action="<?php echo Yii::app()->baseUrl?>/expenses/reportsearch">
                        <!-- <div class="col-lg-12"> -->
                            <div class="form-group col-lg-3" >
                                <label>Start Date</label>
                                <input class="form-control calender" name="start_date" value="<?php echo @$_POST['start_date']?>" autocomplete="off" required>
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>
                            <div class="form-group col-lg-3">
                                <label>End Date</label>
                                <input class="form-control calender" name="end_date" value="<?php echo @$_POST['end_date']?>" autocomplete="off"  required>
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>

                            <div class="form-group col-lg-3">
                                <label>Expense Type</label>
                                <select name="expense_type" id="expense_type" class="form-control" required>
                                    <option value="">Please select expense type</option>
                                    <?php foreach($this->expenseType(1,true) as $id=>$mode):?>
                                        <option value="<?php echo $id?>" <?php echo ($type==$id)?'selected':''?>><?php echo @$mode?></option>
                                    <?php endforeach;?>
                                    
                                    <!-- <option value="2" <?php //echo ($type==2)?'selected':''?>>Site</option>
                                    <option value="3" <?php //echo ($type==3)?'selected':''?>>Sewrage</option>
                                    <option value="4" <?php //echo ($type==4)?'selected':''?>>Road</option>
                                    <option value="5" <?php //echo ($type==5)?'selected':''?>>Marketing</option>
                                    <option value="6" <?php //echo ($type==6)?'selected':''?>>Boundry</option>
                                    <option value="7" <?php //echo ($type==7)?'selected':''?>>Gardening</option>
                                    <option value="8" <?php //echo ($type==8)?'selected':''?>>Office Setup</option>
                                    <option value="9" <?php //echo ($type==9)?'selected':''?>>Office Running</option>
                                    <option value="10" <?php //echo ($type==10)?'selected':''?>>Agent Commission</option>
                                    <option value="11" <?php //echo ($type==11)?'selected':''?>>Donation</option>
                                    <option value="12" <?php //echo ($type==12)?'selected':''?>>Qadir Personal</option> -->
                                </select>


                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>
                            <div class="form-group col-lg-3">
                                <label>Paid To</label>
                                <input list="browsers" class="form-control" type="text" name="paid_to" id="paid_to" placeholder="Paid To" required>
                                <datalist id="browsers">
                                  <?php foreach(@$paid_to_list as $pt):?>
                                  <option value="<?php echo @$pt->paid_to?>">
                                  <?php endforeach;?>
                                </datalist>

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
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Expense Report
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables">
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
                        <?php $total = 0;if(@$expenses){ foreach(@$expenses as $expense):?>
                            <tr>
                                <td><?php echo $expense->expense_type?></td>
                                <td><?php echo $expense->description?></td>
                                <td><?php echo 'Rs. '.$expense->amount?></td>
                                <?php $total = $total + (($expense->status==1)?($expense->amount):0);?>
                                <td><?php echo $expense->user->first_name.''.$expense->user->last_name?></td>
                                <td><?php echo date('d M,o h:ia',strtotime($expense->createdOn))?></td>
                                <td><?php echo ($expense->status==0)?'<span class="label label-danger">Rejected</span>':'<span class="label label-success">Approved</span>'?>&nbsp;<a class="deleteExpense" href="<?php echo Yii::app()->baseUrl?>/expenses/delete/<?php echo $expense->id?>"><span class="aLink label label-danger">Delete</span></a>&nbsp;</td>
                                <td><?php echo ($expense->status==1)?'-':$expense->reason?></td>
                            </tr>
                       <?php endforeach;}?>

                       <tr>
                           <td colspan="2"><b>Total:</b></td>
                           <td colspan="5"><b><?php echo 'Rs. '.number_format($total)?></b></td>
                       </tr>                      
                    </tbody>
                </table>

                <?php if(isset($model)){?>
                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables">
                    <th>Total Records</th>
                    <th>Total Amount</th>
                    <tr style="font-weight: bold;">
                       <td><?php echo (@$paymentmode)?(count(@$model).' '.ucwords(@$paymentmode->mode).'(s)'):count(@$model).' Records'?></td>
                       <td><?php echo 'Rs. '.number_format(@$total)?></td>
                   </tr>
               </table>
                <?php }?>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>