<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Development Letter</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                New Development Letter
            </div>
            <div class="panel-body">
                <div class="row">
                    <form role="form" method="POST" action="<?php echo Yii::app()->baseUrl?>/letter/developmentletter">
                        <!-- <div class="col-lg-12"> -->
                            <div class="form-group col-lg-4" >
                                <label>Plot Size</label>
                                <select name="size_id" id="size_id" class="form-control">
                                    <option value="">Please select plot size</option>
                                    <?php foreach(@$sizes as $size):?>
                                        <option value="<?php echo $size->id?>"><?php echo $size->size.' '.(($size->size_amount!=0)?'('.$size->size_amount.')':'')?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>

                            <div class="form-group col-lg-6" >
                                <label>Development Amount</label>
                                <input class="form-control" name="amount" id="amount" placeholder="Amount" required="">
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>


                            <div class="form-group col-lg-4" >
                                <label>Customer Plot</label>
                                <select name="plot_id" id="plot_id" class="form-control select2">
                                    <option value="">Select Customer Plot</option>
                                    <?php foreach(@$bookings as $booking):?>
                                        <option value="<?php echo $booking->id?>"><?php echo $booking->plot->block_number.' / '.$booking->plot->plot_number?></option>
                                    <?php endforeach;?>
                                </select>
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
            