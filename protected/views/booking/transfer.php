<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Transfer Booking</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Transfer Booking
            </div>
            <div class="panel-body">
                <div class="row">
                    <form role="form" method="POST" action="<?php echo Yii::app()->baseUrl?>/booking/transfersubmit">
                        <div class="col-lg-12">
                            <h3 style="margin-left: 1%">Current Information</h3>
                            <div class="form-group col-lg-3" >
                                <label>Customer Name </label>
                                <input class="form-control" id="customer_name" readonly  value="<?php echo @$booking->customer->name?>" required="">
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>
                            <div class="form-group col-lg-3">
                                <label>Customer Number</label>
                                <input class="form-control" id="customer_number"  required="" readonly value="<?php echo @$booking->customer->mobile?>">
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>


                            <div class="form-group col-lg-3">
                                <label>Customer CNIC</label>
                                <input class="form-control" id="customer_cnic"  value="<?php echo @$booking->customer->cnic?>" readonly required="">
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>

                            <div class="form-group col-lg-3">
                                <label>Transfer Amount</label>
                                <input class="form-control" name="transfer_amount" id="transfer_amount" required="">
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>

                            
                            
                            <input type="hidden" name="booking_id" value="<?php echo @$booking->id?>"/>

                        </div>
                        <div class="col-lg-12">
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
                                <input class="form-control calender" id="dob" name="dob" placeholder="Daet of Birth">
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
                        </div>


                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-success">Submit</button>

                            <a href="<?php echo Yii::app()->baseUrl?>/booking/viewbooking/<?php echo $booking->id?>"><button type="button" class="btn btn-danger">Cancel</button></a>
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
            