<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Cancel Booking</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Cancel Booking
            </div>
            <div class="panel-body">
                <div class="row">
                    <form role="form" method="POST" action="<?php echo Yii::app()->baseUrl?>/booking/cancelsubmit">
                        <!-- <div class="col-lg-12"> -->
                            <div class="form-group col-lg-4" >
                                <label>Total Plot Amount</label>
                                <input class="form-control" id="total_plot_amount"  value="<?php echo $total?>" required="">
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>
                            <div class="form-group col-lg-4">
                                <label>Total Plot Paid Amounts</label>
                                <input class="form-control" id="paid_amount"  required="" value="<?php echo @number_format(@$plotBookingSum)?>">
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>


                            <div class="form-group col-lg-4">
                                <label>Cancel Amount</label>
                                <input class="form-control" name="amount" required="">
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>

                            
                            
                            <div class="form-group col-lg-6">
                                <label>Cancel Date</label>
                                <input class="form-control calender" name="cancel_date" required="" value="<?php echo date('Y-m-d')?>">
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Cancel Reason</label>
                                <textarea class="form-control" name="reason" required=""></textarea>
                            </div>

                            <input type="hidden" name="booking_id" id="booking_id" value="<?php echo @$booking->id?>"/>
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
            