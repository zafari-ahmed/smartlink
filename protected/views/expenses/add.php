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
                Add New Expense
            </div>
            <div class="panel-body">
                <div class="row">
                    <form role="form" method="POST" action="<?php echo Yii::app()->baseUrl?>/expenses/save">
                        <!-- <div class="col-lg-12"> -->
                            <div class="form-group col-lg-4" >
                                <label>Head of A/c</label>
                                <?php $type=0;$disabled='';if(@$_GET['booking_id']) {
                                    $type = 10;
                                    $disabled = 'readonly';
                                }?>
                                <select name="expense_type" id="expense_type" class="form-control" required <?php echo $disabled?>>
                                    <option value="">Please select expense type</option>
                                    <option value="1" <?php echo ($type==1)?'selected':''?>>Survayour</option>
                                    <option value="2" <?php echo ($type==2)?'selected':''?>>Site</option>
                                    <option value="3" <?php echo ($type==3)?'selected':''?>>Sewrage</option>
                                    <option value="4" <?php echo ($type==4)?'selected':''?>>Road</option>
                                    <option value="5" <?php echo ($type==5)?'selected':''?>>Marketing</option>
                                    <option value="6" <?php echo ($type==6)?'selected':''?>>Boundry</option>
                                    <option value="7" <?php echo ($type==7)?'selected':''?>>Gardening</option>
                                    <option value="8" <?php echo ($type==8)?'selected':''?>>Office Setup</option>
                                    <option value="9" <?php echo ($type==9)?'selected':''?>>Office Running</option>
                                    <option value="10" <?php echo ($type==10)?'selected':''?>>Agent Commission</option>
                                    <option value="11" <?php echo ($type==11)?'selected':''?>>Donation</option>
                                    <option value="12" <?php echo ($type==12)?'selected':''?>>Qadir Personal</option>
                                    <option value="13" <?php echo ($type==13)?'selected':''?>>Assets</option>
                                    <option value="14" <?php echo ($type==14)?'selected':''?>>Loan</option>
                                    <option value="15" <?php echo ($type==15)?'selected':''?>>Petty Cash Load</option>
                                </select>
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>
                            <div class="form-group col-lg-3" >
                                <label>Payment Mode</label>
                                <select name="payment_mode" id="payment_mode" class="form-control" required>
                                    <option value="">Please select payment mode</option>
                                    <option value="cash">Cash</option>
                                    <option value="cheque">Cheque</option>
                                    <option value="payorder">PayOrder</option>
                                    <!-- <option value="debit voucher">Debit Voucher</option>
                                    <option value="adjustment">Adjustment</option> -->
                                </select>
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>

                            <div class="form-group col-lg-3" style="padding-left: 0px;">
                                    <label>Bank</label>
                                    <!-- <input class="form-control" id="bank" name="bank" placeholder="Bank" autocomplete="off"> -->
                                    <select name="bank" id="bank" class="form-control">
                                        <option value="">Please select Bank</option>
                                        <option value="Other">Other</option>
                                        <option value="Habib Bank Limited">Habib Bank Limited</option>
                                        <option value="Alied Bank Limited">Alied Bank Limited</option>
                                        <option value="Bank Al Habib Limited">Bank Al Habib Limited</option>
                                        <option value="Habib Metropolitan Bank">Habib Metropolitan Bank</option>
                                        <option value="Dubai Bank Islami">Dubai Bank Islami</option>
                                        <option value="Bank Islami">Bank Islami</option>
                                        <option value="Standard Chartered Bank">Standard Chartered Bank</option>
                                        <option value="Bank Of Punjab">Bank Of Punjab</option>
                                        <option value="Meezan Bank Limited">Meezan Bank Limited</option>
                                        <option value="Soneri Bank">Soneri Bank</option>
                                        <option value="National Bank of Pakistan">National Bank of Pakistan</option>
                                        <option value="United Bank Limited">United Bank Limited</option>
                                        <option value="Askari Bank">Askari Bank</option>
                                        <option value="Faysal Bank">Faysal Bank</option>
                                        <option value="Silk Bank">Silk Bank</option>
                                        <option value="Bank Alfalah">Bank Alfalah</option>
                                        <option value="City Bank">City Bank</option>
                                        <option value="JS Bank">JS Bank</option>
                                        <option value="Muslim Commercial Bank">Muslim Commercial Bank</option>
                                        <option value="Sindh Bank">Sindh Bank</option>
                                        <option value="Bank of khyber">Bank of khyber</option>
                                        <option value="Bank of Azad & Jamu Kashmir">Bank of Azad & Jamu Kashmir</option>
                                        <option value="Samba Bank">Samba Bank</option>
                                        <option value="Summit Bank">Summit Bank</option>
                                        
                                    </select>
                                </div>
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
                            
                            <?php if(@$_GET['booking_id']) {?>
                            <div class="form-group col-lg-3">
                                <label>Booking Reg No</label>
                                <input class="form-control" type="text" value="<?php echo $this->getBookingRegNo(@$booking->id)?>" disabled>
                                <input type="hidden" name="booking_id" value="<?php echo @$booking->id?>">
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>
                            <?php }?>
                            <div class="form-group col-lg-3">
                                <label>Amount</label>
                                <input class="form-control" type="number" name="amount" id="amount" placeholder="Amount" required="">
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>
                            <div class="form-group col-lg-4">
                                <label>Reference Number</label>
                                <input class="form-control" type="number" name="number" id="amount" placeholder="Reference Number">
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
                            <div class="form-group col-lg-4">
                                <label>CNIC/NTN</label>
                                <input class="form-control cnic" type="text" name="cnic" id="cnic" placeholder="CNIC/NTN">
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>
                            <div class="form-group col-lg-4" >
                                <label>Expense Date</label>
                                <input class="form-control calender" name="createdOn" autocomplete="off" required value="<?php echo date('Y-m-d')?>">
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>
                            <?php if(@$_GET['booking_id']) {
                                $messageDesc = 'Booking agent commission for Plot *'.($booking->plot->block_number.'-'.$booking->plot->plot_type.'-'.$booking->plot->plot_number).'*';
                            } else{
                                $messageDesc = '';
                            }?>
                            <div class="form-group col-lg-12">
                                <label>Expense Particulars</label>
                                <textarea class="form-control" rows="3" name="description" placeholder="Expense Particulars" required><?php echo @$messageDesc?></textarea>
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
            