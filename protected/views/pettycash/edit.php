<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Petty Cash Expenses</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<?php
$phaseId = Yii::app()->session->get('userModel')['phase_id'];
?>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Edit PettyCash Expense
            </div>
            <div class="panel-body">
                <div class="row">
                    <form role="form" method="POST" action="<?php echo Yii::app()->baseUrl?>/pettycash/update">
                        <!-- <div class="col-lg-12"> -->
                            <input class="form-control" type="hidden" name="id" value="<?php echo @$expense->id?>">
                            <div class="form-group col-lg-4" >
                                <label>Head of A/c</label>
                                <select name="expense_type" id="expense_type" class="form-control" required>
                                    <option value="">Please select expense type</option>
                                    <option value="1" <?php echo ($expense->expense_type==1)?'selected':''?>>Survayour</option>
                                    <option value="2" <?php echo ($expense->expense_type==2)?'selected':''?>>Site</option>
                                    <option value="3" <?php echo ($expense->expense_type==3)?'selected':''?>>Sewrage</option>
                                    <option value="4" <?php echo ($expense->expense_type==4)?'selected':''?>>Road</option>
                                    <option value="5" <?php echo ($expense->expense_type==5)?'selected':''?>>Marketing</option>
                                    <option value="6" <?php echo ($expense->expense_type==6)?'selected':''?>>Boundry</option>
                                    <option value="7" <?php echo ($expense->expense_type==7)?'selected':''?>>Gardening</option>
                                    <option value="8" <?php echo ($expense->expense_type==8)?'selected':''?>>Office Setup</option>
                                    <option value="9" <?php echo ($expense->expense_type==9)?'selected':''?>>Office Running</option>
                                    <option value="10" <?php echo ($expense->expense_type==10)?'selected':''?>>Agent Commission</option>
                                    <option value="11" <?php echo ($expense->expense_type==11)?'selected':''?>>Donation</option>
                                    <option value="12" <?php echo ($expense->expense_type==12)?'selected':''?>>Qadir Personal</option>
                                    <option value="13" <?php echo ($expense->expense_type==13)?'selected':''?>>Assets</option>
                                    <option value="14" <?php echo ($expense->expense_type==14)?'selected':''?>>Loan</option>
                                    <option value="15" <?php echo ($expense->expense_type==15)?'selected':''?>>Petty Cash Load</option>
                                </select>
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>
                            <input name="payment_mode" type="hidden" value="petty cash">
                            <!-- <div class="form-group col-lg-3" >
                                <label>Payment Mode</label>
                                <select name="payment_mode" id="payment_mode" class="form-control" required>
                                    <option value="">Please select payment mode</option>
                                    <option value="cash">Cash</option>
                                    <option value="cheque">Cheque</option>
                                    <option value="payorder">PayOrder</option>
                                    <option value="debit voucher">Debit Voucher</option>
                                    <option value="adjustment">Adjustment</option>
                                </select>
                                
                            </div> -->

                            <div class="form-group col-lg-2 hide" >
                                <label>Phase ID</label>
                                <select name="phase_id" id="phase_id" class="form-control" required>
                                    <option value="">Please select phase</option>
                                    <?php foreach($phases as $acc):?>
                                        <option value="<?php echo $acc->id?>" <?php echo ($acc->id == $phaseId)?'selected':''?>><?php echo $acc->phase?></option>
                                    <?php endforeach;?>
                                    <!-- <option value="charity">Charity</option>
                                    <option value="charity">Charity</option> -->
                                </select>
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>
                            
                            <div class="form-group col-lg-3">
                                <label>Amount</label>
                                <input class="form-control" type="number" name="amount" id="amount" placeholder="Amount" required="" value="<?php echo @$expense->amount?>">
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>
                            <div class="form-group col-lg-3">
                                <label>Paid To</label>
                                <input list="browsers" class="form-control" type="text" name="paid_to" id="paid_to" placeholder="Paid To" required value="<?php echo @$expense->paid_to?>">
                                <datalist id="browsers">
                                  <?php foreach(@$paid_to_list as $pt):?>
                                  <option <?php echo ($expense->paid_to==@$pt->paid_to)?'selected':''?> value="<?php echo @$pt->paid_to?>">
                                  <?php endforeach;?>
                                </datalist>

                            </div>
                            <<div class="form-group col-lg-4" >
                                <label>Expense Date</label>
                                <input class="form-control calender" name="createdOn" autocomplete="off" required value="<?php echo @$expense->createdOn?>">
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>
                            <div class="form-group col-lg-12">
                                <label>Expense Particulars</label>
                                <textarea class="form-control" rows="3" name="description" placeholder="Expense Particulars" required><?php echo @$expense->description?></textarea>
                                <p class="help-block">* Add <code>&lt;br/&gt;</code> for multiple numbers.</p>
                            </div>

                            


                            <div class="col-lg-12">
                                <button type="submit" class="btn btn-success">Submit</button>
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
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
            