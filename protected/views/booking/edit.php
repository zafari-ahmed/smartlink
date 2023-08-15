<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Bookings</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<?php
$class='hide';
$userModel = Yii::app()->session->get('userModel');
if($userModel['user_type']['id'] == 1){
    $class = '';
}
?>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                New Plot Booking
            </div>
            <div class="panel-body">
                <div class="row">
                	<form role="form" method="POST" action="<?php echo Yii::app()->baseUrl?>/booking/update" enctype="multipart/form-data">
	                	<!-- <div class="col-lg-12"> -->
                            <div class="col-lg-12">
                                <input type="hidden" name="id" value="<?php echo @$booking->id?>">
                                <input type="hidden" name="plot_id" value="<?php echo @$booking->plot->id?>">
                                <input type="hidden" name="block_number" value="<?php echo @$booking->plot->block_number?>">
                                <input type="hidden" name="size_id" value="<?php echo @$booking->plot->size_id?>">

    	                		<div class="form-group col-lg-3">
                                    <label>Block #</label>
                                    <input class="form-control" disabled="" placeholder="Block #" value="<?php echo @$booking->plot->block_number?>">
                                    <!-- <p class="help-block">Example block-level help text here.</p> -->
                                </div>

                                <div class="form-group col-lg-3">
                                    <label>Plot Type</label>
                                    <input class="form-control" disabled="" placeholder="Block #" value="<?php echo @$booking->plot->plot_type?>">
                                    <!-- <p class="help-block">Example block-level help text here.</p> -->
                                </div>

                                <div class="form-group col-lg-3" >
                                    <label>Plot #</label>
                                    <select  class="form-control select2" disabled="">
                                    	<option value="">Please plot #</option>
                                    	<?php foreach($plots as $plot):?>
                                    		<option value="<?php echo $plot->id?>" <?php echo (@$booking->plot->id == $plot->id)?'selected':''?>><?php echo $plot->plot_number?></option>
                                    	<?php endforeach;?>
                                    </select>
                                    <!-- <p class="help-block">Example block-level help text here.</p> -->
                                </div>
                                
                                <div class="form-group col-lg-3" style="padding-right: 0px;">
                                    <label>Category</label>
                                    <!-- <input class="form-control" disabled="" name="category_id" id="category_id" placeholder="Plot Category"> -->
                                    <select  class="form-control" disabled="">
                                    	<option value="">Please select plot category</option>
                                    	<?php foreach($categories as $category):?>
                                    		<option value="<?php echo $category->id?>" <?php echo (@$booking->plot->category_id == $category->id)?'selected':''?>><?php echo $category->name?></option>
                                    	<?php endforeach;?>
                                    </select>
                                    <!-- <p class="help-block">Example block-level help text here.</p> -->
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group col-lg-3">
                                    <label>Size</label>
                                    <!-- <input class="form-control" disabled="" name="size_id" id="size_id" placeholder="Plot Size"> -->
                                    <select class="form-control" disabled="">
                                    	<option value="">Please select plot size</option>
                                    	<?php foreach($sizes as $size):?>
                                    		<option value="<?php echo $size->id?>" <?php echo (@$booking->plot->size_id == $size->id)?'selected':''?>><?php echo $size->size?></option>
                                    	<?php endforeach;?>
                                    </select>
                                    <!-- <p class="help-block">Example block-level help text here.</p> -->
                                </div>

                                <div class="form-group col-lg-3">
                                    <label>Monthly Plan</label>
                                    <!-- <input class="form-control" disabled="" name="size_id" id="size_id" placeholder="Plot Size"> -->
                                    <select class="form-control" name="monthlyMonths" readonly>
                                            <option value="36" <?php echo ($booking->monthlyMonths==36)?'selected':''?>>36</option>
                                    </select>
                                    <!-- <p class="help-block">Example block-level help text here.</p> -->
                                </div>

                                <div class="form-group col-lg-3 <?php echo $class?>">
                                    <label>Plot Discount</label>
                                    <input class="form-control" id="discount" name="discount" placeholder="Plot Discount" value="<?php echo $booking->plot->discount?>">
                                </div>

                                <div class="form-group col-lg-3 hide">
                                    <label>Development Charges</label>
                                    <!-- <input class="form-control" disabled="" name="size_id" id="size_id" placeholder="Plot Size"> -->
                                    <select name="charge_id" id="charge_id" class="form-control">
                                        <?php foreach($charges as $key => $charge):?>
                                            <option value="<?php echo $charge->id?>" <?php echo ($booking->charge_id == $charge)? "selected" : "";?>><?php echo $charge->charge?></option>
                                        <?php endforeach;?>
                                    </select>
                                    <!-- <p class="help-block">Example block-level help text here.</p> -->
                                </div>
                            </div>
                            <div class="col-lg-12 <?php echo $class?>">
                                <div class="form-group col-lg-3">
                                    <label>Dealer</label>
                                    <!-- <input class="form-control" disabled="" name="size_id" id="size_id" placeholder="Plot Size"> -->
                                    <select class="form-control">
                                        <option value="">Please select dealer</option>
                                        <?php foreach($agents as $agent):?>
                                            <option value="<?php echo $agent->id?>" <?php echo (@$agentDetail->parent_id == $agent->id)?'selected':''?>><?php echo $agent->name?></option>
                                        <?php endforeach;?>
                                    </select>
                                    <!-- <p class="help-block">Example block-level help text here.</p> -->
                                </div>
                                <div class="form-group col-lg-3">
                                    <label>Sub Dealer</label>
                                    <!-- <input class="form-control" disabled="" name="size_id" id="size_id" placeholder="Plot Size"> -->
                                    <select name="agent_id" class="form-control" >
                                        <option value="">Please select dealer</option>
                                        <?php foreach($agents as $agent):?>
                                            <option value="<?php echo $agent->id?>" <?php echo (@$booking->agent_id == $agent->id)?'selected':''?>><?php echo $agent->name?></option>
                                        <?php endforeach;?>
                                    </select>
                                    <!-- <p class="help-block">Example block-level help text here.</p> -->
                                </div>
                                <div class="form-group col-lg-3">
                                    <label>Agent Commission</label>
                                    <input class="form-control" name="agent_percentage" placeholder="Agent Commission" value="<?php echo @$booking->agent_percentage?>">
                                    <!-- <p class="help-block">Example block-level help text here.</p> -->
                                </div>
                                <div class="form-group col-lg-3">
                                    <label>Payment Schedule</label>
                                    <select class="form-control" name="is_special" id="is_special" readonly disabled>
                                        <?php foreach($paymentSchedules as $index=>$paymentS):?>
                                            <option value="<?php echo $paymentS->id?>" <?php echo ($paymentS->id==$booking->is_special)?'selected':''?>><?php echo $paymentS->name?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                                <div class="form-group col-lg-3">
                                    <label>Monthly Start Date</label>
                                    <input class="form-control calender" id="monthly_start_date" name="monthly_start_date" placeholder="Monthly Start Date" value="<?php echo $booking->monthly_start_date?>">
                                </div>

                            </div>
	                	<!-- </div> -->
                        
	                    <div class="col-lg-12">
                            <hr/>
                            <div class="form-group">
                                <label>Name: Mr./Mrs./Ms.</label>
                                <input class="form-control" id="name" name="name" placeholder="Name:Mr./Mrs./Ms." value="<?php echo @$booking->customer->name?>">
                            </div>
                            <div class="form-group">
                                <label>Gender</label>
                                <label class="radio-inline">
                                    <input type="radio" name="gender" id="gender" value="Male" <?php echo (@$booking->customer->gender=='Male')?'checked':''?>>Male
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="gender" id="gender" value="Female" <?php echo (@$booking->customer->gender=='Female')?'checked':''?>>Female
                                </label>
                            </div>
                            
                            <div class="form-group">
                                <label>Type</label>
                                <label class="radio-inline">
                                    <input type="radio" name="agent_name" id="agent_name" value="S/O" <?php echo (@$booking->agent_name=='S/O')?'checked':''?>>S/O
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="agent_name" id="agent_name" value="D/O" <?php echo (@$booking->agent_name=='D/O')?'checked':''?>>D/O
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="agent_name" id="agent_name" value="W/O" <?php echo (@$booking->agent_name=='W/O')?'checked':''?>>W/O
                                </label>
                            </div>

                            <div class="form-group">
                                <label>Father/Husband Name</label>
                                <input class="form-control" id="father_husband_name" name="father_husband_name" placeholder="Father/Husband Name" value="<?php echo @$booking->customer->father_husband_name?>">
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>
                            <div class="form-group col-lg-6" style="padding-left: 0px;">
                                <label>Occupation</label>
                                <input class="form-control" id="occupation" name="occupation" placeholder="Occupation" value="<?php echo @$booking->customer->occupation?>">
                            </div>
                            <div class="form-group col-lg-6" style="padding-right: 0px;">
                                <label>Date of Birth</label>
                                <input class="form-control calender" id="dob" name="dob" placeholder="Date of Birth" value="<?php echo ($booking->customer->dob!='0000-00-00')?$booking->customer->dob:date('Y-m-d')?>">
                            </div>
                            <div class="form-group">
                                <label>CNIC</label>
                                <input class="form-control cnic" id="cnic" name="cnic" placeholder="CNIC" value="<?php echo @$booking->customer->cnic?>">
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <textarea class="form-control" rows="3" name="address" placeholder="Postal/Residental Address"><?php echo @$booking->customer->address?></textarea>
                            </div>
                            <!-- <div class="col-lg-12 form-group"> -->
		                		<div class="form-group col-lg-4" style="padding-left: 0px;">
	                                <label>Res Phone #</label>
	                                <input class="form-control numbersOnly" name="phone" placeholder="Res Phone #" maxlength="20" value="<?php echo @$booking->customer->phone?>">
	                                <!-- <p class="help-block">Example block-level help text here.</p> -->
	                            </div>
	                            <div class="form-group col-lg-4">
	                                <label>Office Phone #</label>
	                                <input class="form-control numbersOnly" name="office" placeholder="Office Phone #" maxlength="20" value="<?php echo @$booking->customer->office?>">
	                                <!-- <p class="help-block">Example block-level help text here.</p> -->
	                            </div>
	                            <div class="form-group col-lg-4" style="padding-right: 0px;">
	                                <label>Mobile Phone #</label>
	                                <input class="form-control numbersOnly" name="mobile" placeholder="Mobile Phone #" maxlength="20" value="<?php echo @$booking->customer->mobile?>">
	                                <!-- <p class="help-block">Example block-level help text here.</p> -->
	                            </div>
		                	<!-- </div> -->
		                	<div class="form-group">
                                <label>Email</label>
                                <input class="form-control" id="email" name="email" placeholder="Email" type="email" value="<?php echo @$booking->customer->email?>">
                            </div>
                            <div class="form-group" >
                                <label>Scanned Image (Allottee Passport Size)</label>
                                <input type="file" class="form-control" name="plot[pp]" id="plot" placeholder="Upload CSV">
                                <img src="<?php echo Yii::app()->baseUrl.'/uploads/booking/'.$booking->agent_cnic?>" alt="..." class="img-thumbnail" style="width: 15%;">
                            </div>

                            <?php foreach($this->documentTypes() as $types):?>
                                <?php $fileType = strtolower(str_replace(' ','-',$types)) ?>
                                <div class="form-group" >
                                    <label>Scanned Image (<?php echo $types?>)</label>
                                    <input type="file" class="form-control" name="plot[documents][<?php echo $fileType?>]">
                                    <?php if($fileType != 'nadra-verification-form') {?>
                                        <img src="<?php echo Yii::app()->baseUrl.'/uploads/booking/'.$this->getDocument($booking->id,$fileType)?>" alt="..." class="img-thumbnail" style="width: 15%;">
                                    <?php } else{?> 
                                        <a href="<?php echo Yii::app()->baseUrl.'/uploads/booking/'.$this->getDocument($booking->id,$fileType)?>" target="_blank">Nadra Verification Form</a>
                                    <?php } ?>
                                </div>
                            <?php endforeach;?>
                            <hr/>
                            <!-- <div class="col-lg-12 form-group"> -->
	                            <div class="form-group col-lg-6" style="padding-left: 0px;">
	                                <label>Nominee's Name</label>
	                                <input class="form-control" id="nominee_name" name="nominee_name" placeholder="Nominee's Name" value="<?php echo @$booking->customer->nominee_name?>">
	                            </div>
	                            <div class="form-group col-lg-6" style="padding-right: 0px;">
	                                <label>Relation</label>
	                                <input class="form-control" id="nominee_relation" name="nominee_relation" placeholder="Relation" value="<?php echo @$booking->customer->nominee_relation?>">
	                            </div>
	                        <!-- </div> -->
	                        <div class="form-group">
                                <label>Nominee's CNIC</label>
                                <input class="form-control cnic" id="nominee_cnic" name="nominee_cnic" placeholder="Nominee's cnic" value="<?php echo @$booking->customer->nominee_cnic?>">
                            </div>
                            <div class="form-group col-lg-6" style="padding-left: 0px;">
                                <label>Booking Date</label>
                                <input class="form-control calender"  name="createdOn" placeholder="Created Date" value="<?php echo date('Y-m-d',strtotime($booking->createdOn))?>">
                            </div>
                            <div class="clearfix"></div>
                            <hr/>
                            <h3>Transaction Detail <span style="font-size: 11px;font-weight: bold;">(add reason for delete transaction)</span></h3>
                            
                            <?php if($booking->customerPlotTransactions){ foreach( $booking->customerPlotTransactions as $ind => $cpt):?>
                            <div class="col-lg-12 form-group paymentModeBox" style="padding-left: 0px;" id="paymentModeBox_<?php echo $cpt->id?>">
                                <input name="transaction_id[]" value="<?php echo $cpt->id?>" type="hidden">
                                <div class="form-group col-lg-1" style="margin-right: -5%;">
                                    <input name="edit_payment_row"  value="<?php echo $cpt->id?>" type="checkbox" style="margin-top:30%" class="edit_payment_row">
                                </div>
                                <div class="col-lg-1" style="padding-left: 0px;">
                                    <label>Mode</label>
                                    <select name="mode_id[]"  class="form-control">
                                        <option value="0">Please select plot payment mode</option>
                                        <?php if(@$paymentmodes) { foreach($paymentmodes as $pm){?>
                                            <option value="<?php echo $pm->id?>" <?php echo ($cpt->plot_payment_mode_id==$pm->id)?'selected':''?>><?php echo $pm->mode?></option>
                                        <?php } }?>
                                    </select>
                                    <!-- <p class="help-block">Example block-level help text here.</p> -->
                                </div>
                                <div class="form-group col-lg-1">
                                    <label>Amount</label>
                                    <input class="form-control numbersOnly" name="amount[]" placeholder="Amount" value="<?php echo round($cpt->amount,2)?>" autocomplete="off">
                                </div>
                                <div class="form-group col-lg-1">
                                    <label>Trans. #</label>
                                    <input class="form-control" name="transaction[]" placeholder="Transaction Number" value="<?php echo $cpt->transaction_number?>" autocomplete="off" readonly>
                                </div>
                                <div class="form-group col-lg-1">
                                    <label>Trans. Type</label>
                                    <select name="t_type[]"  class="form-control">
                                        <option value="">Please select transaction type</option>                                        
                                            <option value="cash" <?php echo ($cpt->transaction_type=='cash')?'selected':''?>>Cash</option>
                                            <option value="cheque" <?php echo ($cpt->transaction_type=='cheque')?'selected':''?>>Cheque</option>
                                            <option value="online" <?php echo ($cpt->transaction_type=='online')?'selected':''?>>Online</option>
                                            <option value="PayOrder" <?php echo ($cpt->transaction_type=='PayOrder')?'selected':''?>>PayOrder</option>
                                            <option value="DebitVoucher" <?php echo ($cpt->transaction_type=='DebitVoucher')?'selected':''?>>DebitVoucher</option>
                                        
                                    </select>
                                </div>
                                <div class="form-group col-lg-1">
                                    <label>Bank</label>
                                    <!-- <input class="form-control" name="t_bank[]" placeholder="Bank" value="<?php echo $cpt->bank?>" autocomplete="off"> -->
                                    <select name="t_bank[]" id="t_bank" class="form-control">
                                        <option value="">Please select Bank</option>
                                        <option <?php echo ($cpt->bank=='Habib Bank Limited')?'selected':''?> value="Habib Bank Limited">Habib Bank Limited</option>
                                        <option <?php echo ($cpt->bank=='Alied Bank Limited')?'selected':''?> value="Alied Bank Limited">Alied Bank Limited</option>
                                        <option <?php echo ($cpt->bank=='Bank Al Habib Limited')?'selected':''?> value="Bank Al Habib Limited">Bank Al Habib Limited</option>
                                        <option <?php echo ($cpt->bank=='Habib Metropolitan Bank')?'selected':''?> value="Habib Metropolitan Bank">Habib Metropolitan Bank</option>
                                        <option <?php echo ($cpt->bank=='Dubai Bank Islami')?'selected':''?> value="Dubai Bank Islami">Dubai Bank Islami</option>
                                        <option <?php echo ($cpt->bank=='Bank Islami')?'selected':''?> value="Bank Islami">Bank Islami</option>
                                        <option <?php echo ($cpt->bank=='Standard Chartered Bank')?'selected':''?> value="Standard Chartered Bank">Standard Chartered Bank</option>
                                        <option <?php echo ($cpt->bank=='Bank Of Punjab')?'selected':''?> value="Bank Of Punjab">Bank Of Punjab</option>
                                        <option <?php echo ($cpt->bank=='Meezan Bank Limited')?'selected':''?> value="Meezan Bank Limited">Meezan Bank Limited</option>
                                        <option <?php echo ($cpt->bank=='Soneri Bank')?'selected':''?> value="Soneri Bank">Soneri Bank</option>
                                        <option <?php echo ($cpt->bank=='National Bank of Pakistan')?'selected':''?> value="National Bank of Pakistan">National Bank of Pakistan</option>
                                        <option <?php echo ($cpt->bank=='United Bank Limited')?'selected':''?> value="United Bank Limited">United Bank Limited</option>
                                        <option <?php echo ($cpt->bank=='Askari Bank')?'selected':''?> value="Askari Bank">Askari Bank</option>
                                        <option <?php echo ($cpt->bank=='Faysal Bank')?'selected':''?> value="Faysal Bank">Faysal Bank</option>
                                        <option <?php echo ($cpt->bank=='Silk Bank')?'selected':''?> value="Silk Bank">Silk Bank</option>
                                        <option <?php echo ($cpt->bank=='Bank Alfalah')?'selected':''?> value="Bank Alfalah">Bank Alfalah</option>
                                        <option <?php echo ($cpt->bank=='City Bank')?'selected':''?> value="City Bank">City Bank</option>
                                        <option <?php echo ($cpt->bank=='JS Bank')?'selected':''?> value="JS Bank">JS Bank</option>
                                        <option <?php echo ($cpt->bank=='Muslim Commercial Bank')?'selected':''?> value="Muslim Commercial Bank">Muslim Commercial Bank</option>
                                        <option <?php echo ($cpt->bank=='Sindh Bank')?'selected':''?> value="Sindh Bank">Sindh Bank</option>
                                        <option <?php echo ($cpt->bank=='Bank of khyber')?'selected':''?> value="Bank of khyber">Bank of khyber</option>
                                        <option <?php echo ($cpt->bank=='Bank of Azad & Jamu Kashmir')?'selected':''?> value="Bank of Azad & Jamu Kashmir">Bank of Azad & Jamu Kashmir</option>
                                        <option <?php echo ($cpt->bank=='Samba Bank')?'selected':''?> value="Samba Bank">Samba Bank</option>
                                        <option <?php echo ($cpt->bank=='Summit Bank')?'selected':''?> value="Summit Bank">Summit Bank</option>
                                        <option <?php echo ($cpt->bank=='Other')?'selected':''?> value="Other">Other</option>
                                    </select>
                                </div>
                                
                                <div class="form-group col-lg-1">
                                    <label>Ref.</label>
                                    
                                    <input class="form-control" name="t_reference_number[]" placeholder="Reference Number" value="<?php echo $cpt->reference_number?>" autocomplete="off"> 
                                </div>
                                <div class="form-group col-lg-2">
                                    <label>Comment</label>
                                    <textarea class="form-control" rows="3" name="t_comment[]" placeholder="Comments"><?php echo $cpt->comment?></textarea>
                                </div>
                                <div class="form-group col-lg-2">
                                    <label>Reason</label>
                                    <textarea class="form-control" rows="3" name="t_reason[]" placeholder="Reason"><?php echo $cpt->reason?></textarea>
                                </div>
                                <div class="form-group col-lg-1">
                                    <label>Date</label>
                                    <input class="form-control calender" name="t_date[]" placeholder="Transaction Date" value="<?php echo date('Y-m-d',strtotime($cpt->createdOn))?>" autocomplete="off">
                                </div>
                            </div>
                            <?php endforeach;}?>

                            <hr/>
                            <h3>Extra Transaction Detail <span style="font-size: 11px;font-weight: bold;">(add reason for delete transaction)</span></h3>
                            
                            <?php if($booking->customerPlotPlanTransactionsAll){ foreach( $booking->customerPlotPlanTransactionsAll as $ind => $cpt):?>
                            <div class="col-lg-12 form-group paymentModeBox" style="padding-left: 0px;" id="paymentModeBox_<?php echo $cpt->id?>">
                                <input name="extra_transaction_id[]" value="<?php echo $cpt->id?>" type="hidden">
                                <div class="form-group col-lg-1" style="margin-right: -5%;">
                                    <input name="edit_payment_row"  value="<?php echo $cpt->id?>" type="checkbox" style="margin-top:30%" class="edit_payment_row">
                                </div>
                                <div class="col-lg-1" style="padding-left: 0px;">
                                    <label>Mode</label>
                                    <input class="form-control numbersOnly" name="extra_mode[]" placeholder="Amount" value="<?php echo $cpt->plot_payment_mode?>" autocomplete="off">
                                    <!-- <p class="help-block">Example block-level help text here.</p> -->
                                </div>
                                <div class="form-group col-lg-1">
                                    <label>Amount</label>
                                    <input class="form-control numbersOnly" name="extra_amount[]" placeholder="Amount" value="<?php echo round($cpt->amount,2)?>" autocomplete="off">
                                </div>
                                <div class="form-group col-lg-1">
                                    <label>#</label>
                                    <input class="form-control" name="extra_transaction[]" placeholder="Transaction Number" value="<?php echo trim($cpt->transaction_number,0)?>" autocomplete="off" readonly>
                                </div>
                                <div class="form-group col-lg-1">
                                    <label>Type</label>
                                    <select name="extra_t_type[]"  class="form-control">
                                        <option value="">Please select transaction type</option>                                        
                                            <option value="cash" <?php echo ($cpt->transaction_type=='cash')?'selected':''?>>Cash</option>
                                            <option value="cheque" <?php echo ($cpt->transaction_type=='cheque')?'selected':''?>>Cheque</option>
                                            <option value="online" <?php echo ($cpt->transaction_type=='online')?'selected':''?>>Online</option>
                                            <option value="PayOrder" <?php echo ($cpt->transaction_type=='PayOrder')?'selected':''?>>PayOrder</option>
                                            <option value="DebitVoucher" <?php echo ($cpt->transaction_type=='DebitVoucher')?'selected':''?>>DebitVoucher</option>
                                        
                                    </select>
                                </div>
                                <div class="form-group col-lg-1">
                                    <label>Bank</label>
                                    <!-- <input class="form-control" name="t_bank[]" placeholder="Bank" value="<?php echo $cpt->bank?>" autocomplete="off"> -->
                                    <select name="extra_t_bank[]" id="t_bank" class="form-control">
                                        <option value="">Please select Bank</option>
                                        <option <?php echo ($cpt->bank=='Habib Bank Limited')?'selected':''?> value="Habib Bank Limited">Habib Bank Limited</option>
                                        <option <?php echo ($cpt->bank=='Alied Bank Limited')?'selected':''?> value="Alied Bank Limited">Alied Bank Limited</option>
                                        <option <?php echo ($cpt->bank=='Bank Al Habib Limited')?'selected':''?> value="Bank Al Habib Limited">Bank Al Habib Limited</option>
                                        <option <?php echo ($cpt->bank=='Habib Metropolitan Bank')?'selected':''?> value="Habib Metropolitan Bank">Habib Metropolitan Bank</option>
                                        <option <?php echo ($cpt->bank=='Dubai Bank Islami')?'selected':''?> value="Dubai Bank Islami">Dubai Bank Islami</option>
                                        <option <?php echo ($cpt->bank=='Bank Islami')?'selected':''?> value="Bank Islami">Bank Islami</option>
                                        <option <?php echo ($cpt->bank=='Standard Chartered Bank')?'selected':''?> value="Standard Chartered Bank">Standard Chartered Bank</option>
                                        <option <?php echo ($cpt->bank=='Bank Of Punjab')?'selected':''?> value="Bank Of Punjab">Bank Of Punjab</option>
                                        <option <?php echo ($cpt->bank=='Meezan Bank Limited')?'selected':''?> value="Meezan Bank Limited">Meezan Bank Limited</option>
                                        <option <?php echo ($cpt->bank=='Soneri Bank')?'selected':''?> value="Soneri Bank">Soneri Bank</option>
                                        <option <?php echo ($cpt->bank=='National Bank of Pakistan')?'selected':''?> value="National Bank of Pakistan">National Bank of Pakistan</option>
                                        <option <?php echo ($cpt->bank=='United Bank Limited')?'selected':''?> value="United Bank Limited">United Bank Limited</option>
                                        <option <?php echo ($cpt->bank=='Askari Bank')?'selected':''?> value="Askari Bank">Askari Bank</option>
                                        <option <?php echo ($cpt->bank=='Faysal Bank')?'selected':''?> value="Faysal Bank">Faysal Bank</option>
                                        <option <?php echo ($cpt->bank=='Silk Bank')?'selected':''?> value="Silk Bank">Silk Bank</option>
                                        <option <?php echo ($cpt->bank=='Bank Alfalah')?'selected':''?> value="Bank Alfalah">Bank Alfalah</option>
                                        <option <?php echo ($cpt->bank=='City Bank')?'selected':''?> value="City Bank">City Bank</option>
                                        <option <?php echo ($cpt->bank=='JS Bank')?'selected':''?> value="JS Bank">JS Bank</option>
                                        <option <?php echo ($cpt->bank=='Muslim Commercial Bank')?'selected':''?> value="Muslim Commercial Bank">Muslim Commercial Bank</option>
                                        <option <?php echo ($cpt->bank=='Sindh Bank')?'selected':''?> value="Sindh Bank">Sindh Bank</option>
                                        <option <?php echo ($cpt->bank=='Bank of khyber')?'selected':''?> value="Bank of khyber">Bank of khyber</option>
                                        <option <?php echo ($cpt->bank=='Bank of Azad & Jamu Kashmir')?'selected':''?> value="Bank of Azad & Jamu Kashmir">Bank of Azad & Jamu Kashmir</option>
                                        <option <?php echo ($cpt->bank=='Samba Bank')?'selected':''?> value="Samba Bank">Samba Bank</option>
                                        <option <?php echo ($cpt->bank=='Summit Bank')?'selected':''?> value="Summit Bank">Summit Bank</option>
                                        <option <?php echo ($cpt->bank=='Other')?'selected':''?> value="Other">Other</option>
                                    </select>
                                </div>
                                
                                <div class="form-group col-lg-1">
                                    <label>Ref.</label>
                                    
                                    <input class="form-control" name="extra_t_reference_number[]" placeholder="Reference Number" value="<?php echo $cpt->reference_number?>" autocomplete="off"> 
                                </div>
                                <div class="form-group col-lg-2">
                                    <label>Comment</label>
                                    <textarea class="form-control" rows="3" name="extra_t_comment[]" placeholder="Comments"><?php echo $cpt->comment?></textarea>
                                </div>
                                <div class="form-group col-lg-2">
                                    <label>Reason</label>
                                    <textarea class="form-control" rows="3" name="extra_t_reason[]" placeholder="Reason"><?php echo $cpt->monthlyDate?></textarea>
                                </div>
                                <div class="form-group col-lg-1">
                                    <label>Date</label>
                                    <input class="form-control calender" name="extra_t_date[]" placeholder="Transaction Date" value="<?php echo date('Y-m-d',strtotime($cpt->createdOn))?>" autocomplete="off">
                                </div>
                            </div>
                            <?php endforeach;}?>
                            <button type="submit" class="btn btn-success">Update</button>
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
    <div class="col-lg-6" style="padding-left: 0px;">
        <label>Plot Payment Mode</label>
        <select name="mode_id[]"  class="form-control">
            <option value="">Please select plot payment mode</option>
            <?php if(@$paymentmodes) { foreach($paymentmodes as $pm){?>
                <option value="<?php echo $pm->id?>"><?php echo $pm->mode?></option>
            <?php } }?>
        </select>
        <!-- <p class="help-block">Example block-level help text here.</p> -->
    </div>
    <div class="form-group col-lg-3">
        <label>Amount</label>
        <input class="form-control numbersOnly" name="amount[]" placeholder="Amount">
    </div>
    <div class="form-group col-lg-3">
        <label>Transaction Number</label>
        <input class="form-control" name="transaction[]" placeholder="Transaction Number">
    </div>

</div>
            