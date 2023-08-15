<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Bookings</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                New Plot Booking
            </div>
            <?php //print_r($currentPlot)?>
            <div class="panel-body">
                <div class="row">
                	<form target="_blank" role="form" method="POST" action="<?php echo Yii::app()->baseUrl?>/booking/save" enctype="multipart/form-data">
	                	<!-- <div class="col-lg-12"> -->
	                		<div class="col-lg-12">
                                <div class="form-group col-lg-3">
                                    <label>Block #</label>
                                    <!-- <input class="form-control"  name="block_number" id="block_number" placeholder="Block #" value="<?php echo @$currentPlot->block_number?>"> -->
                                    <select name="block_number" id="block_number" class="form-control">
                                        <option value="">Select block #</option>
                                        <?php foreach($blocks as $block):?>
                                            <option value="<?php echo $block->block_number?>" <?php (@$currentPlot['block_number'] == $block->block_number)?'selected':''?>><?php echo $block->block_number?></option>
                                        <?php endforeach;?>
                                    </select>
                                    
                                </div>
                                <div class="form-group col-lg-3" >
                                    <label>Plot Type</label>
                                    <select name="plot_type" id="plot_type" class="form-control">
                                        <option value="">Select plot Type</option>
                                    </select>
                                    <!-- <p class="help-block">Example block-level help text here.</p> -->
                                </div>
                                <div class="form-group col-lg-3" >
                                    <label>Plot #</label>
                                    <select name="plot_id" id="plot_number" class="form-control select2">
                                        <option value="">Select plot #</option>
                                    </select>
                                    <!-- <p class="help-block">Example block-level help text here.</p> -->
                                </div>
                                <div class="form-group col-lg-3" style="padding-right: 0px;">
                                    <label>Category</label>
                                    <!-- <input class="form-control" disabled="" name="category_id" id="category_id" placeholder="Plot Category"> -->
                                    <select name="category_id" id="category_id" class="form-control" disabled="">
                                    	<option value="">Please select plot category</option>
                                    	<?php foreach($categories as $category):?>
                                    		<option value="<?php echo $category->id?>" <?php echo (@$currentPlot->category_id == $category->id)?'selected':''?>><?php echo $category->name?></option>
                                    	<?php endforeach;?>
                                    </select>
                                    <!-- <p class="help-block">Example block-level help text here.</p> -->
                                </div>
                                
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group col-lg-3">
                                    <label>Size</label>
                                    <!-- <input class="form-control" disabled="" name="size_id" id="size_id" placeholder="Plot Size"> -->
                                    <select name="size_id" id="size_id" class="form-control" disabled="">
                                        <option value="">Please select plot size</option>
                                        <?php foreach($sizes as $size):?>
                                            <option value="<?php echo $size->id?>" <?php echo (@$currentPlot->size_id == $size->id)?'selected':''?>><?php echo $size->size?></option>
                                        <?php endforeach;?>
                                    </select>
                                    <!-- <p class="help-block">Example block-level help text here.</p> -->
                                </div>
                                <div class="form-group col-lg-3">
                                    <label>Monthly Plan</label>
                                    <!-- <input class="form-control" disabled="" name="size_id" id="size_id" placeholder="Plot Size"> -->
                                    <select class="form-control" name="monthlyMonths" readonly>
                                            <option value="36">36</option>
                                    </select>
                                    <!-- <p class="help-block">Example block-level help text here.</p> -->
                                </div>
                                <div class="form-group col-lg-3">
                                    <label>Plot Discount</label>
                                    <input class="form-control" id="discount" name="discount" placeholder="Plot Discount">
                                </div>
                                <div class="form-group col-lg-3 hide">
                                    <label>Development Charges</label>
                                    <!-- <input class="form-control" disabled="" name="size_id" id="size_id" placeholder="Plot Size"> -->
                                    <select name="charge_id" id="charge_id" class="form-control">
                                        <?php foreach($charges as $key => $charge):?>
                                            <option value="<?php echo $charge->id?>" <?php echo ( $key !== count( $charges ) -1 ) ? "" : "selected";?>><?php echo $charge->charge?></option>
                                        <?php endforeach;?>
                                    </select>
                                    <!-- <p class="help-block">Example block-level help text here.</p> -->
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group col-lg-3">
                                    <label>Dealer</label>
                                    <!-- <input class="form-control" disabled="" name="size_id" id="size_id" placeholder="Plot Size"> -->
                                    <select class="form-control" name="agent_parent_id" id="agent_parent_id">
                                        <option value="">Please select dealer</option>
                                        <?php foreach($agents as $agent):?>
                                            <option value="<?php echo $agent->id?>" <?php echo (@$booking->agent_id == $agent->id)?'selected':''?>><?php echo $agent->name?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                                
                                <!-- <div class="form-group col-lg-3">
                                    <label>Sub Agent</label>
                                    <input class="form-control" id="sub_agent" name="agent_id" placeholder="Sub Agent">
                                </div> -->
                                <div class="form-group col-lg-3" >
                                    <label>Sub Agent</label>
                                    <select name="agent_id" id="sub_agent" class="form-control">
                                        <option value="">Select Sub Agent</option>
                                        <?php foreach($agentsub as $agents):?>
                                            <option value="<?php echo $agents->id?>"><?php echo $agents->name?></option>
                                        <?php endforeach;?>
                                    </select>
                                    <!-- <p class="help-block">Example block-level help text here.</p> -->
                                </div>

                                <div class="form-group col-lg-3">
                                    <label>Agent Commission</label>
                                    <input class="form-control" id="agent_commission" name="agent_percentage" placeholder="Agent Commission">
                                </div>

                                <div class="form-group col-lg-3">
                                    <label>Payment Schedule</label>
                                    <select class="form-control" name="is_special" id="is_special" required>
                                        <?php foreach($paymentSchedules as $index=>$paymentS):?>
                                            <option value="<?php echo $paymentS->id?>" <?php echo (count($paymentSchedules)==$index)?'selected':''?>><?php echo $paymentS->name?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                                <div class="form-group col-lg-3">
                                    <label>Monthly Start Date</label>
                                    <input class="form-control calender" id="monthly_start_date" name="monthly_start_date" placeholder="Monthly Start Date" value="<?php echo date('Y-m-d',strtotime(date('Y-m-d')."+1 month"))?>">
                                </div>
                            </div>
	                	<!-- </div> -->
                        
	                    <div class="col-lg-12">
                            <hr/>
                            <div class="form-group">
                                <label>Name: Mr./Mrs./Ms.</label>
                                <input class="form-control" id="name" name="name" placeholder="Name:Mr./Mrs./Ms.">
                            </div>
                            <div class="form-group">
                                <label>Gender</label>
                                <label class="radio-inline">
                                    <input type="radio" name="gender" id="gender" value="Male" checked="">Male
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="gender" id="gender" value="Female">Female
                                </label>
                            </div>
                            <div class="form-group">
                                <label>Type</label>
                                <label class="radio-inline">
                                    <input type="radio" name="agent_name" id="agent_name" value="S/O" checked="">S/O
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="agent_name" id="agent_name" value="D/O">D/O
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="agent_name" id="agent_name" value="W/O">W/O
                                </label>
                            </div>
                            <div class="form-group">
                                <label>Father/Husband Name</label>
                                <input class="form-control" id="father_husband_name" name="father_husband_name" placeholder="Father/Husband Name">
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>
                            <div class="form-group col-lg-6" style="padding-left: 0px;">
                                <label>Occupation</label>
                                <input class="form-control" id="occupation" name="occupation" placeholder="Occupation">
                            </div>
                            <div class="form-group col-lg-6" style="padding-right: 0px;">
                                <label>Date of Birth</label>
                                <input class="form-control calender" id="dob" name="dob" placeholder="Date of Birth">
                            </div>
                            <div class="form-group">
                                <label>CNIC</label>
                                <input class="form-control cnic" id="cnic" name="cnic" placeholder="CNIC">
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <textarea class="form-control" rows="3" name="address" placeholder="Postal/Residental Address"></textarea>
                            </div>
                            <!-- <div class="col-lg-12 form-group"> -->
		                		<div class="form-group col-lg-4" style="padding-left: 0px;">
	                                <label>Res Phone #</label>
	                                <input class="form-control numbersOnly" name="phone" placeholder="Res Phone #" maxlength="20">
	                                <!-- <p class="help-block">Example block-level help text here.</p> -->
	                            </div>
	                            <div class="form-group col-lg-4">
	                                <label>Office Phone #</label>
	                                <input class="form-control numbersOnly" name="office" placeholder="Office Phone #" maxlength="20">
	                                <!-- <p class="help-block">Example block-level help text here.</p> -->
	                            </div>
	                            <div class="form-group col-lg-4" style="padding-right: 0px;">
	                                <label>Mobile Phone #</label>
	                                <input class="form-control numbersOnly" name="mobile" placeholder="Mobile Phone #" maxlength="20">
	                                <!-- <p class="help-block">Example block-level help text here.</p> -->
	                            </div>
		                	<!-- </div> -->
		                	<div class="form-group">
                                <label>Email</label>
                                <input class="form-control" id="email" name="email" placeholder="Email" type="email">
                            </div>
                            <div class="form-group" >
                                <label>Scanned Image (Passport Size)</label>
                                <input type="file" class="form-control" name="plot" id="plot" placeholder="Upload CSV" >
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>
                            <hr/>
                            <!-- <div class="col-lg-12 form-group"> -->
	                            <div class="form-group col-lg-6" style="padding-left: 0px;">
	                                <label>Nominee's Name</label>
	                                <input class="form-control" id="nominee_name" name="nominee_name" placeholder="Nominee's Name">
	                            </div>
	                            <div class="form-group col-lg-6" style="padding-right: 0px;">
	                                <label>Relation</label>
	                                <input class="form-control" id="nominee_relation" name="nominee_relation" placeholder="Relation">
	                            </div>
	                        <!-- </div> -->
	                        <div class="form-group">
                                <label>Nominee's CNIC</label>
                                <input class="form-control cnic" id="nominee_cnic" name="nominee_cnic" placeholder="Nominee's cnic">
                            </div>

                            <div class="form-group col-lg-6" style="padding-left: 0px;">
                                <label>Created Date</label>
                                <input class="form-control calender"  name="createdOn" placeholder="Created Date" autocomplete="off" required value="<?php echo date('Y-m-d')?>">
                            </div>
                            <div class="hide">
                            <div class="clearfix"></div>
                            <h3>Transaction Detail <span class="pull-right"><a href="javascript:void(0)"><button type="button" class="btn btn-success btn-sm" id="addNewPayment">Add Another</button></a></span></h3>
                            <!-- <div class="form-group">
                                <label>Full Payment Discount (%)</label>
                                <label class="radio-inline">
                                    <input type="number" class="form-control" name="discount" placeholder="Discount Percent" autocomplete="off">
                                </label>
                            </div> -->
                            <div class="col-lg-12 form-group" style="padding-left: 0px;" id="paymentModeBox">
                                <div class="col-lg-3" style="padding-left: 0px;">
                                    <label>Plot Payment Mode</label>
                                    <select name="mode_id[]"  class="form-control">
                                        <option value="">Select plot payment mode</option>
                                        <?php if(@$paymentmodes) { foreach($paymentmodes as $pm){?>
                                            <option value="<?php echo $pm->id?>"><?php echo $pm->mode?></option>
                                        <?php } }?>
                                        <!-- <option value="full_payment">Full Payment</option> -->
                                    </select>
                                    <!-- <p class="help-block">Example block-level help text here.</p> -->
                                </div>
                                <div class="form-group col-lg-1">
                                    <label>Amount</label>
                                    <input class="form-control numbersOnly" name="amount[]" placeholder="Amount">
                                </div>
                                <div class="form-group col-lg-1">
                                    <label>Trans. #</label>
                                    <input class="form-control" name="transaction[]" placeholder="Transaction Number" value="<?php echo @(($lastTrans->transaction_number)?($lastTrans->transaction_number+1):0001)?>">
                                </div>
                                <div class="form-group col-lg-2">
                                    <label>Trans. Type</label>
                                    <select name="transaction_type" id="transaction_type[]" class="form-control">
                                        <option value="">Select transaction type</option>
                                        <option value="cash">Cash</option>
                                        <option value="cheque">Cheque</option>
                                        <option value="online">Online</option>
                                    </select>
                                </div>
                                <div class="form-group col-lg-2">
                                    <label>Comment</label>
                                    <textarea class="form-control" rows="3" name="t_comment[]" placeholder="Comments"></textarea>
                                </div>
                                <div class="form-group col-lg-2">
                                    <label>Trans. Date</label>
                                    <input class="form-control calender" name="t_date[]" placeholder="Transaction Date">
                                </div>
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
                            </div>
                            <div class="col-lg-12 form-group">
                                <button type="submit" class="btn btn-success" name="save">Save Booking</button>
                            </div>

                            <div class="col-lg-12 form-group">
                                <button type="submit" class="btn btn-success" name="preview" target="_blank">Preview Booking</button>
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
    <div class="col-md-12">
        <div class="col-lg-3" style="padding-left: 0px;">
            <label>Plot Payment Mode</label>
            <select name="mode_id[]"  class="form-control">
                <option value="">Select plot payment mode</option>
                <?php if(@$paymentmodes) { foreach($paymentmodes as $pm){?>
                    <option value="<?php echo $pm->id?>"><?php echo $pm->mode?></option>
                <?php } }?>
            </select>
            <!-- <p class="help-block">Example block-level help text here.</p> -->
        </div>
        
        <div class="form-group col-lg-1">
            <label>Amount</label>
            <input class="form-control numbersOnly" name="amount[]" placeholder="Amount">
        </div>
        <div class="form-group col-lg-1">
            <label>Trans. #</label>
            <input class="form-control" name="transaction[]" placeholder="Transaction Number" value="<?php echo @(($lastTrans->transaction_number)?($lastTrans->transaction_number+1):0001)?>">
        </div>
        <div class="form-group col-lg-2">
            <label>Trans. Type</label>
            <select name="transaction_type" id="transaction_type[]" class="form-control" required>
                <option value="">Select transaction type</option>
                <option value="cash">Cash</option>
                <option value="cheque">Cheque</option>
                <option value="online">Online</option>
            </select>
        </div>
        <div class="form-group col-lg-2">
            <label>Comment</label>
            <textarea class="form-control" rows="3" name="t_comment[]" placeholder="Comments"></textarea>
        </div>
        <div class="form-group col-lg-2">
            <label>Trans. Date</label>
            <input class="form-control calender" name="t_date[]" placeholder="Transaction Date">
        </div>
    </div>

</div>
            