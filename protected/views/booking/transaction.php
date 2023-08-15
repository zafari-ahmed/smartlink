<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Transactions</h1>
        <?php
            foreach(Yii::app()->user->getFlashes() as $key => $message) {
                echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'.$message.'</div>';
            }
        ?>
    </div>
    <!-- /.col-lg-12 -->
</div>
<input type="hidden" id="extraLastTrans" value="<?php echo sprintf('%04d', @$extraLastTrans->transaction_number+1)?>">
<input type="hidden" id="LastTrans" value="<?php echo sprintf('%04d',@$lastTrans->transaction_number+1)?>">
<?php $userModel = Yii::app()->session->get('userModel');?>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Plot Transaction

            </div>
            <div class="panel-body">
                <div class="row">
                    <form role="form" method="POST" action="<?php echo Yii::app()->baseUrl?>/booking/savetransaction">
                        <input class="form-control" type="hidden" name="customer_id" value="<?php echo $booking->customer->id?>">
                        <input class="form-control" type="hidden" name="plot_id"  id="plot_id" value="<?php echo $booking->id?>">
                        <?php /*?>
                        <!-- <div class="col-lg-12"> -->
                            <div class="form-group col-lg-4" >
                                <label>Plot Payment Mode</label>
                                <select name="size_id" id="size_id" class="form-control" required>
                                    <option value="">Please select plot payment mode</option>
                                    <?php foreach(@$paymentmodes as $mode):?>
                                        <option value="<?php echo $mode->id?>"><?php echo $mode->mode?></option>
                                    <?php endforeach;?>
                                </select>
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>
                            <div class="form-group col-lg-4">
                                <label>Amount</label>
                                <input class="form-control" disabled="" name="amount" id="amount" placeholder="Amount">
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>
                            <div class="form-group col-lg-4" style="padding-right: 0px;">
                                <label>Discount</label>
                                <input class="form-control" name="discount" id="discount" placeholder="Discount">
                                
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>
                        <!-- </div> -->
                        <?php */?>
                        <div class="col-lg-12  form-group">
                            <!-- <label>Full Payment Discount (%)</label>
                            <label class="radio-inline">
                                <input type="number" class="form-control" name="discount" placeholder="Discount Percent" autocomplete="off">
                            </label> -->
                            <span class="pull-right"><a href="javascript:void(0)"><button type="button" class="btn btn-success btn-sm" id="addNewPayment">Add Another</button></a></span>
                        </div>
                        <div class="col-lg-12 form-group" id="paymentModeBox">
                            <div class="modeSBox">
                                <div class="col-lg-4" style="padding-left: 0px;">
                                    <label>Plot Payment Mode</label>
                                    <select name="mode[]" id="mode" class="form-control modesS" required>
                                        <option value="">Please select plot payment mode</option>
                                        <?php foreach(@$paymentmodes as $mode):?>
                                            <option value="<?php echo $mode['id']?>" rel="<?php echo $mode['amount']-$mode['total']?>"><?php echo $mode['mode']?></option>
                                        <?php endforeach;?>
                                        <option value="development">Development</option>
                                        <option value="penalty">Penalty</option>
                                        <option value="transfer_fee">Transfer Fee</option>
                                        <option value="lease_charges">Lease Charges</option>
                                        <option value="others">Others</option>
                                        <?php /*if( $booking->customerPlotPlanTransactionsDevlopment || $userModel['user_type']['id'] == 1 ){?>
                                            <option value="development">Development</option>
                                        <?php }*/ ?>
                                        <!-- <option value="full_payment">Full Payment</option> -->
                                    </select>
                                    <!-- <p class="help-block">Example block-level help text here.</p> -->
                                </div>
                                <div class="form-group col-lg-3">
                                    <label>Amount</label>
                                    <input type="number" class="form-control numbersOnly" name="amount[]" placeholder="Amount" autocomplete="off" min="1">
                                </div>
                                <div class="form-group col-lg-3">
                                    <label>Transaction Number <?php //echo $lastTrans->transaction_number?></label>
                                    <?php if($userModel['user_type']['id'] == 1 ){?>
                                    <input type="number" class="form-control" name="transaction[]" placeholder="Transaction Number" autocomplete="off" value="<?php echo sprintf('%04d',@$lastTrans->transaction_number+1)?>">
                                    <?php } else{ ?>
                                    <input type="number" class="form-control" name="transaction[]" placeholder="Transaction Number" readonly autocomplete="off" value="<?php echo sprintf('%04d',@$lastTrans->transaction_number+1)?>">
                                    <?php } ?>
                                </div>

                                <div class="form-group col-lg-3">
                                <label>Transaction Type</label>
                                <select name="transaction_type[]" id="transaction_type" class="form-control" required>
                                    <option value="">Please select transaction type</option>
                                    <option value="cash">Cash</option>
                                    <option value="cheque">Cheque</option>
                                    <option value="online">Online</option>
                                    <option value="PayOrder">PayOrder</option>
                                    <option value="DebitVoucher">DebitVoucher</option>
                                </select>
                                </div>
                            
                                <div class="form-group col-lg-3" style="padding-left: 0px;">
                                    <label>Bank</label>
                                    <!-- <input class="form-control" id="bank" name="bank" placeholder="Bank" autocomplete="off"> -->
                                    <select name="bank[]" id="bank" class="form-control">
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
                                <div class="form-group col-lg-3" style="padding-right: 0px;">
                                    <label>Bank Branch</label>
                                    <input class="form-control" id="branch" name="branch[]" placeholder="Bank Branch" autocomplete="off">
                                </div>
                                <div class="form-group col-lg-3" style="padding-right: 0px;">
                                    <label>Reference Number</label>
                                    <input class="form-control" id="reference_number" name="reference_number[]" placeholder="Reference Number" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="col-md-12">
                                <hr/>
                            </div>
                            <div class="form-group">
                                <label>Comment</label>
                                <textarea class="form-control" rows="3" name="comment" placeholder="Comments"></textarea>
                            </div>
                            <?php //if($userModel['user_type_id'] == 1){?>
                            <div class="form-group col-lg-6" style="padding-left: 0px;">
                                <label>Created Date</label>
                                <input class="form-control calender"  name="createdOn" placeholder="Created Date" autocomplete="off" value="<?php echo date('Y-m-d')?>">
                            </div>
                            <?php /*} else {?>
                                <input   name="createdOn" type="hidden" value="<?php echo date('Y-m-d')?>">
                            <?php }*/ ?>
                            <div class="form-group col-lg-6" style="padding-left: 0px;">
                                <label>Another Number</label>
                                <input class="form-control"  name="another_number" placeholder="Another Number" autocomplete="off">
                            </div>
                            <!-- <div class="form-group">
                                <label>Checkboxes</label>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="">Checkbox 1
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="">Checkbox 2
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="">Checkbox 3
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Inline Checkboxes</label>
                                <label class="checkbox-inline">
                                    <input type="checkbox">1
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox">2
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox">3
                                </label>
                            </div>
                            <div class="form-group">
                                <label>Radio Buttons</label>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>Radio 1
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">Radio 2
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="optionsRadios" id="optionsRadios3" value="option3">Radio 3
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Inline Radio Buttons</label>
                                <label class="radio-inline">
                                    <input type="radio" name="optionsRadiosInline" id="optionsRadiosInline1" value="option1" checked>1
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="optionsRadiosInline" id="optionsRadiosInline2" value="option2">2
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="optionsRadiosInline" id="optionsRadiosInline3" value="option3">3
                                </label>
                            </div> -->
                            <input type="hidden" name="lastTransactionId" id="lastTransactionId" value="<?php echo @$booking->customerPlotTransactionslast[0]->id?>">
                            <input type="hidden" name="lastTransactionIdNew" value="<?php echo @$lastTransactionIdNew?>">
                            <input type="hidden" name="lastDevTransactionId" id="lastDevTransactionId" value="<?php echo @$booking->customerPlotPlanTransactionslast[0]->id?>">
                            <div class="col-lg-12" style="padding-left: 0px;">
                                <button type="submit" class="btn btn-success" id="transactionBtn">Submit</button>
                            </div>
                            
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

<div id="paymentModeBoxHidden" class="hide">
    <div class="modeSBox">
        <div class="col-lg-12">
            <hr/>
        </div>
        <div class="col-lg-4" style="padding-left: 0px;">
            <label>Plot Payment Mode</label>
            <select name="mode[]" id="mode" class="form-control modesS" required>
                <option value="">Please select plot payment mode</option>
                <?php foreach(@$paymentmodes as $mode):?>
                    <option value="<?php echo $mode['id']?>" rel="<?php echo $mode['amount']-$mode['total']?>"><?php echo $mode['mode']?></option>
                <?php endforeach;?>
                <option value="development">Development</option>
                <option value="penalty">Penalty</option>
                <option value="transfer_fee">Transfer Fee</option>
                <option value="lease_charges">Lease Charges</option>
                <option value="others">Others</option>
            </select>
            <!-- <p class="help-block">Example block-level help text here.</p> -->
        </div>
        <div class="form-group col-lg-3">
            <label>Amount</label>
            <input type="number" class="form-control numbersOnly" name="amount[]" placeholder="Amount" required min="1">
        </div>
        <div class="form-group col-lg-3">
            <label>Transaction Number</label>
            <?php if($userModel['user_type']['id'] == 1 ){?>
            <input type="number" class="form-control" name="transaction[]" placeholder="Transaction Number" autocomplete="off" value="<?php echo sprintf('%04d',@$lastTrans->transaction_number+1)?>">
            <?php } else{ ?>
            <input type="number" class="form-control" name="transaction[]" placeholder="Transaction Number" readonly autocomplete="off" value="<?php echo sprintf('%04d',@$lastTrans->transaction_number+1)?>">
            <?php } ?>
        </div>
        <div class="form-group col-lg-3">
            <label>Transaction Type</label>
            <select name="transaction_type[]" id="transaction_type" class="form-control" required>
                <option value="">Please select transaction type</option>
                <option value="cash">Cash</option>
                <option value="cheque">Cheque</option>
                <option value="online">Online</option>
                <option value="PayOrder">PayOrder</option>
                <option value="DebitVoucher">DebitVoucher</option>
            </select>
        </div>
        
        <div class="form-group col-lg-3" style="padding-left: 0px;">
            <label>Bank</label>
            <!-- <input class="form-control" id="bank" name="bank" placeholder="Bank" autocomplete="off"> -->
            <select name="bank[]" id="bank" class="form-control">
                <option value="">Please select Bank</option>
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
                <option value="Other">Other</option>
            </select>
        </div>
        <div class="form-group col-lg-3" style="padding-right: 0px;">
            <label>Bank Branch</label>
            <input class="form-control" id="branch" name="branch[]" placeholder="Bank Branch" autocomplete="off">
        </div>
        <div class="form-group col-lg-3" style="padding-right: 0px;">
            <label>Reference Number</label>
            <input class="form-control" id="reference_number" name="reference_number[]" placeholder="Reference Number" autocomplete="off">
        </div>
    </div>
</div>

<div id="paymentModeDevBoxHidden" class="hide">
    <div class="modeSBox">
        <div class="col-lg-4" style="padding-left: 0px;">
            <label>Plot Payment Mode</label>
            <select name="mode[]" id="mode" class="form-control modesS" required>
                <option value="">Please select plot payment mode</option>
                <option value="development">Development</option>
            </select>
            <!-- <p class="help-block">Example block-level help text here.</p> -->
        </div>
        <div class="form-group col-lg-3">
            <label>Amount</label>
            <input class="form-control numbersOnly" name="amount[]" placeholder="Amount" required>
        </div>
        <div class="form-group col-lg-3">
            <label>Transaction Number</label>
            <?php if($userModel['user_type']['id'] == 1 ){?>
            <input type="number" class="form-control" name="transaction[]" placeholder="Transaction Number" autocomplete="off" value="<?php echo sprintf('%04d',@$lastTrans->transaction_number+1)?>">
            <?php } else{ ?>
            <input type="number" class="form-control" name="transaction[]" placeholder="Transaction Number" readonly autocomplete="off" value="<?php echo sprintf('%04d',@$lastTrans->transaction_number+1)?>">
            <?php } ?>
        </div>
    </div>
</div>
            