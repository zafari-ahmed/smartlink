<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Warning Letter</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Update Warning Letter
            </div>
            <div class="panel-body">
                <div class="row">
                    <form role="form" method="POST" action="<?php echo Yii::app()->baseUrl?>/warningletter/update">
                        <!-- <div class="col-lg-12"> -->
                            <div class="form-group col-lg-6" >
                                <label>Reference #</label>
                                <input class="form-control" name="reference_number" id="reference_number" placeholder="Reference Number" required="" value="<?php echo $letter->reference_number?>" readonly>
                                <input name="id" value="<?php echo $letter->id?>" type="hidden">
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>
                            <div class="form-group col-lg-6" >
                                <label>Letter Date</label>
                                <input class="form-control calender" name="createdOn" id="createdOn" placeholder="Letter Date" value="<?php echo ($letter->createdOn)?$letter->createdOn:date('Y-m-d')?>">
                            </div> 
                            <div class="form-group col-lg-6" >
                                <label>Tracking ID</label>
                                <input class="form-control" name="tracking_id" id="tracking_id" placeholder="Tracking Id" value="<?php echo $letter->tracking_id?>">
                            </div>
                            <div class="form-group col-lg-6" >
                                <label>Received By</label>
                                <input class="form-control" name="received_by" id="received_by" placeholder="Received By" value="<?php echo $letter->received_by?>">
                            </div>
                            <div class="form-group col-lg-6" >
                                <label>Received On</label>
                                <input class="form-control calender" name="received_on" id="received_on" placeholder="Received On" value="<?php echo ($letter->received_on)?$letter->received_on:date('Y-m-d')?>">
                            </div>    
                            

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
            