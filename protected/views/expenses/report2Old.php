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
                            <div class="form-group col-lg-2" >
                                <label>Start Date</label>
                                <input class="form-control calender" name="start_date" value="<?php echo isset($_POST['start_date'])?@$_POST['start_date']:'2021-01-01'?>" autocomplete="off" required>
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>
                            <div class="form-group col-lg-2">
                                <label>End Date</label>
                                <input class="form-control calender" name="end_date" value="<?php echo isset($_POST['end_date'])?@$_POST['end_date']:date('Y-m-d');?>" autocomplete="off"  required>
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>

                            <div class="form-group col-lg-3">
                                <label>Expense Type</label>
                                <select name="expense_type" id="expense_type" class="form-control" required>
                                    <option value="">Please select expense type</option>
                                    <option value="0" selected>All</option>
                                    <?php foreach($this->expenseType(1,true) as $id=>$mode):?>
                                        <option value="<?php echo $id?>" <?php echo (@$_POST['expense_type']==$id)?'selected':''?>><?php echo @$mode?></option>
                                    <?php endforeach;?>
                                    <!-- <option value="1" <?php //echo (@$_POST['expense_type']==1)?'selected':''?>>Survayour</option>
                                    <option value="2" <?php //echo (@$_POST['expense_type']==2)?'selected':''?>>Site</option>
                                    <option value="3" <?php //echo (@$_POST['expense_type']==3)?'selected':''?>>Sewrage</option>
                                    <option value="4" <?php //echo (@$_POST['expense_type']==4)?'selected':''?>>Road</option>
                                    <option value="5" <?php //echo (@$_POST['expense_type']==5)?'selected':''?>>Marketing</option>
                                    <option value="6" <?php //echo (@$_POST['expense_type']==6)?'selected':''?>>Boundry</option>
                                    <option value="7" <?php //echo (@$_POST['expense_type']==7)?'selected':''?>>Gardening</option>
                                    <option value="8" <?php //echo (@$_POST['expense_type']==8)?'selected':''?>>Office Setup</option>
                                    <option value="9" <?php //echo (@$_POST['expense_type']==9)?'selected':''?>>Office Running</option>
                                    <option value="10" <?php //echo (@$_POST['expense_type']==10)?'selected':''?>>Agent Commission</option>
                                    <option value="11" <?php //echo (@$_POST['expense_type']==11)?'selected':''?>>Donation</option>
                                    <option value="12" <?php //echo (@$_POST['expense_type']==12)?'selected':''?>>Qadir Personal</option> -->
                                </select>
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>
                            <div class="form-group col-lg-2">
                                <label>Paid To</label>
                                <input list="browsers" class="form-control" type="text" name="paid_to" id="paid_to" placeholder="Paid To" required>
                                <datalist id="browsers">
                                    <option value="All" selected>
                                  <?php foreach(@$paid_to_list as $pt):?>
                                  <option value="<?php echo @$pt->paid_to?>">
                                  <?php endforeach;?>
                                </datalist>
                            </div>

                            <div class="form-group col-lg-2" >
                                <label>Payment Mode</label>
                                <select name="payment_mode" id="payment_mode" class="form-control" required>
                                    <option value="">Please select payment mode</option>
                                    <option value="All" selected>All</option>
                                    <option value="cash" <?php echo (@$_POST['payment_mode']=='cash')?'selected':''?>>Cash</option>
                                    <option value="cheque" <?php echo (@$_POST['payment_mode']=='cheque')?'selected':''?>>Cheque</option>
                                    <option value="payorder" <?php echo (@$_POST['payment_mode']=='payorder')?'selected':''?>>PayOrder</option>
                                    <option value="debit voucher" <?php echo (@$_POST['payment_mode']=='debit voucher')?'selected':''?>>Debit Voucher</option>
                                    <option value="adjustment" <?php echo (@$_POST['payment_mode']=='adjustment')?'selected':''?>>Adjustment</option>
                                </select>
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>

                            <div class="form-group col-lg-2">
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
                <span class="pull-right">
                    <a href="<?php echo Yii::app()->baseUrl?>/expenses/reportall"><span class="label label-success">CSV Download</span></a>
                    &nbsp;
                    <a href="javascript:void(0)" id="report2btn"><span class="label label-success">Print</span></a>
                </span>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <table width="100%" class="table table-striped table-bordered table-hover" id="report2table">
                    <thead>
                        <tr>
                            <th>Expense #</th>
                            <th>Expense Type</th>
                            <th>Particulars</th>
                            <th>Amount</th>
                            <th>Mode</th>
                            <th>Bank</th>
                            <th>Paid To</th>
                            <th>CNIC/NTN</th>
                            <th>Ref No.</th>
                            <th>User</th>
                            <th>CreatedOn</th>
                            <th class="noPrint">Status</th>
                            <th class="noPrint">Reason</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $total = 0;if(@$expenses){ foreach(@$expenses as $expense):?>
                            <tr style="<?php echo ($expense->status==0)?'background-color: gray;':''?>" class="<?php echo ($expense->status==0)?'noPrint':''?>">
                                <td><?php echo $this->getExpenseRegNo($expense->id,'expense')?></td>
                                <td><?php echo $this->expenseType(@$expense->expense_type)?></td>
                                <td><?php echo $expense->description?></td>
                                <td><?php echo 'Rs. '.$expense->amount?></td>
                                <?php if($expense->status == 1){?>
                                    <?php $total = $total + $expense->amount;?>
                                <?php }?>
                                <td><?php echo @$expense->payment_mode?></td>
                                <td><?php echo @$expense->bank?></td>
                                <td><?php echo ucfirst(@$expense->paid_to)?></td>
                                <td><?php echo @$expense->cnic?></td>
                                <td><?php echo @$expense->number?></td>
                                <td><?php echo @$expense->user->first_name.''.@$expense->user->last_name?></td>
                                <td><?php echo date('d M,o h:ia',strtotime($expense->createdOn))?></td>
                                <?php

                                $status = '<span class="label label-warning">Pending</span>';
                                if($expense->status == 0){
                                    $status = '<span class="label label-danger">Rejected</span>';
                                }

                                if($expense->status == 1){
                                    $status = '<span class="label label-success">Approved</span>';
                                }
                                
                                ?>
                                <td class="noPrint"><?php echo $status?></td>
                                <td class="noPrint"><?php echo ($expense->status==1)?'-':$expense->reason?></td>
                            </tr>
                       <?php endforeach;}?>

                       <!-- <tr>
                           <td colspan="2"><b>Total:</b></td>
                           <td colspan="9"><b><?php //echo 'Rs. '.number_format($total)?></b></td>
                       </tr>   -->                    
                    </tbody>
                </table>
                <table width="100%" class="table table-striped table-bordered table-hover" id="report2table" style="bottom: 0%;position: fixed;background-color: #ddd;width: 60%;
                ">
                        <tr>
                           <td colspan="2"><b>Total:</b></td>
                           <td colspan="9"><b><?php echo 'Rs. '.number_format($total)?></b></td>
                       </tr>                      
                    </tbody>
                </table>
                <?php if(isset($model)){?>
                <table width="100%" class="table table-striped table-bordered table-hover" id="report2table" style="bottom: 0%;position: fixed;background-color: #ddd;width: 60%;
                ">
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

<script type="text/javascript">
    $(document).on('click', '#report2btn', function (e) {
       var divToPrint=document.getElementById("report2table");
       newWin= window.open("");
       newWin.document.write('<style>.noPrint{display:none}table, th, td {border: 1px solid black;}</style>'+divToPrint.outerHTML);
       newWin.print();
       newWin.close();
    });

</script>