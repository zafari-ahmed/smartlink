<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Development Charges</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Update Development Charges
            </div>
            <div class="panel-body">
                <div class="row">
                    <form role="form" method="POST" action="<?php echo Yii::app()->baseUrl?>/charges/update">
                        <!-- <div class="col-lg-12"> -->
                            <div class="form-group col-lg-3" >
                                <label>New Charges</label>
                                <input class="form-control" name="charge"  placeholder="Charges" required="" value="<?php echo $charge->charge?>">
                                <input type="hidden" name="id" value="<?php echo $charge->id?>">
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>
                        <!-- </div> -->
                        
                        
                            <div class="col-lg-12">
                                <button type="submit" class="btn btn-success">Submit</button>
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
            