<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Expenses</h1>
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
                Update Expense
            </div>
            <div class="panel-body">
                <div class="row">
                    <form role="form" method="POST" action="<?php echo Yii::app()->baseUrl?>/expenses/update">
                        <input class="form-control" type="hidden" name="id" value="<?php echo @$expense->id?>">
                        <!-- <div class="col-lg-12"> -->
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
                            <div class="form-group col-lg-3" >
                                <label>Payment Mode</label>
                                <select name="payment_mode" id="payment_mode" class="form-control" required>
                                    <option value="">Please select payment mode</option>
                                    <option <?php echo ($expense->payment_mode=='cash')?'selected':''?> value="cash">Cash</option>
                                    <option <?php echo ($expense->payment_mode=='cheque')?'selected':''?> value="cheque">Cheque</option>
                                    <option <?php echo ($expense->payment_mode=='payorder')?'selected':''?> value="payorder">PayOrder</option>
                                    <!-- <option <?php //echo ($expense->payment_mode=='debit voucher')?'selected':''?> value="debit voucher">Debit Voucher</option>
                                    <option <?php //echo ($expense->payment_mode=='adjustment')?'selected':''?> value="adjustment">Adjustment</option> -->
                                </select>
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>

                            <div class="form-group col-lg-3" style="padding-left: 0px;">
                                    <label>Bank</label>
                                    <!-- <input class="form-control" id="bank" name="bank" placeholder="Bank" autocomplete="off"> -->
                                    <select name="bank" id="bank" class="form-control">
                                        <option value="">Please select Bank</option>
                                        <option <?php echo ($expense->bank=='Other')?'selected':''?> value="Other">Other</option>
                                        <option <?php echo ($expense->bank=='Habib Bank Limited')?'selected':''?> value="Habib Bank Limited">Habib Bank Limited</option>
                                        <option <?php echo ($expense->bank=='Alied Bank Limited')?'selected':''?> value="Alied Bank Limited">Alied Bank Limited</option>
                                        <option <?php echo ($expense->bank=='Bank Al Habib Limited')?'selected':''?> value="Bank Al Habib Limited">Bank Al Habib Limited</option>
                                        <option <?php echo ($expense->bank=='Habib Metropolitan Bank')?'selected':''?> value="Habib Metropolitan Bank">Habib Metropolitan Bank</option>
                                        <option <?php echo ($expense->bank=='Dubai Bank Islami')?'selected':''?> value="Dubai Bank Islami">Dubai Bank Islami</option>
                                        <option <?php echo ($expense->bank=='Bank Islami')?'selected':''?> value="Bank Islami">Bank Islami</option>
                                        <option <?php echo ($expense->bank=='Standard Chartered Bank')?'selected':''?> value="Standard Chartered Bank">Standard Chartered Bank</option>
                                        <option <?php echo ($expense->bank=='Bank Of Punjab')?'selected':''?> value="Bank Of Punjab">Bank Of Punjab</option>
                                        <option <?php echo ($expense->bank=='Meezan Bank Limited')?'selected':''?> value="Meezan Bank Limited">Meezan Bank Limited</option>
                                        <option <?php echo ($expense->bank=='Soneri Bank')?'selected':''?> value="Soneri Bank">Soneri Bank</option>
                                        <option <?php echo ($expense->bank=='National Bank of Pakistan')?'selected':''?> value="National Bank of Pakistan">National Bank of Pakistan</option>
                                        <option <?php echo ($expense->bank=='United Bank Limited')?'selected':''?> value="United Bank Limited">United Bank Limited</option>
                                        <option <?php echo ($expense->bank=='Askari Bank')?'selected':''?> value="Askari Bank">Askari Bank</option>
                                        <option <?php echo ($expense->bank=='Faysal Bank')?'selected':''?> value="Faysal Bank">Faysal Bank</option>
                                        <option <?php echo ($expense->bank=='Silk Bank')?'selected':''?> value="Silk Bank">Silk Bank</option>
                                        <option <?php echo ($expense->bank=='Bank Alfalah')?'selected':''?> value="Bank Alfalah">Bank Alfalah</option>
                                        <option <?php echo ($expense->bank=='City Bank')?'selected':''?> value="City Bank">City Bank</option>
                                        <option <?php echo ($expense->bank=='JS Bank')?'selected':''?> value="JS Bank">JS Bank</option>
                                        <option <?php echo ($expense->bank=='Muslim Commercial Bank')?'selected':''?> value="Muslim Commercial Bank">Muslim Commercial Bank</option>
                                        <option <?php echo ($expense->bank=='Sindh Bank')?'selected':''?> value="Sindh Bank">Sindh Bank</option>
                                        <option <?php echo ($expense->bank=='Bank of khyber')?'selected':''?> value="Bank of khyber">Bank of khyber</option>
                                        <option <?php echo ($expense->bank=='Bank of Azad & Jamu Kashmir')?'selected':''?> value="Bank of Azad & Jamu Kashmir">Bank of Azad & Jamu Kashmir</option>
                                        <option <?php echo ($expense->bank=='Samba Bank')?'selected':''?> value="Samba Bank">Samba Bank</option>
                                        <option <?php echo ($expense->bank=='Summit Bank')?'selected':''?> value="Summit Bank">Summit Bank</option>
                                        
                                    </select>
                                </div>
                            <div class="form-group col-lg-3">
                                <label>Amount</label>
                                <input class="form-control" type="number" name="amount" id="amount" placeholder="Amount" required="" value="<?php echo @$expense->amount?>">
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>
                            <div class="form-group col-lg-4">
                                <label>Reference Number</label>
                                <input class="form-control" type="number" name="number" id="amount" placeholder="Reference Number" value="<?php echo @$expense->number?>">
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
                            <div class="form-group col-lg-4">
                                <label>CNIC/NTN</label>
                                <input class="form-control cnic" type="text" name="cnic" id="cnic" placeholder="CNIC/NTN" value="<?php echo @$expense->cnic?>">
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>
                            <div class="form-group col-lg-4" >
                                <label>Expense Date</label>
                                <input class="form-control calender" name="createdOn" autocomplete="off" required value="<?php echo @$expense->createdOn?>">
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>
                            <div class="form-group col-lg-12">
                                <label>Expense Particulars</label>
                                <textarea class="form-control" rows="3" name="description" placeholder="Expense Particulars" required><?php echo @$expense->description?></textarea>
                                <p class="help-block">* Add <code>&lt;br/&gt;</code> for multiple numbers.</p>
                            </div>

                            

                            <input name="status" type="hidden" value="2" >
                            <div class="col-lg-12">
                                <button type="submit" class="btn btn-success">Update</button>
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
            