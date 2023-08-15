<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Payment Modes</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Edit Payment Modes
            </div>
            <div class="panel-body">
                <div class="row">
         			<form role="form" method="POST" action="<?php echo Yii::app()->baseUrl?>/paymentmode/update">
                    <!-- <div class="col-lg-12"> -->
                        <div class="col-lg-12" >
                            <div class="form-group" >
                                <label>Payment Mode</label>
                                <input class="form-control" placeholder="Payment Mode" readonly="" value="<?php echo $paymentmode->mode?>">
                            </div>
                            <div class="form-group" >
                                <label>Size</label>
                                <input class="form-control" placeholder="Number" value="<?php echo $paymentmode->plotSize->size?>" readonly="">
                                <input type="hidden" name="id" value="<?php echo $paymentmode->id?>">
                            </div>
                            <div class="form-group" >
                                <label>Amount</label>
                                <input class="form-control numbersOnly" name="amount"  placeholder="Number" required="" value="<?php echo $paymentmode->amount?>">
                            </div>
                            <div class="form-group" >
                                <label>Discount</label>
                                <input class="form-control numbersOnly" name="discount"  placeholder="Discount" value="<?php echo $paymentmode->discount?>">
                            </div>
                        </div>
                        
                    <!-- </div> -->
                    
                    
                        
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                        
                    </form>           
                </div>
                <!-- /.row (nested) -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
            