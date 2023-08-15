<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Dealers</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                New Dealer
            </div>
            <div class="panel-body">
                <div class="row">
                    <form role="form" method="POST" action="<?php echo Yii::app()->baseUrl?>/agent/save">
                        <!-- <div class="col-lg-12"> -->
                            
                            <div class="form-group col-lg-3" style="padding-right: 0px;">
                                <label>Parent Dealer</label>                                
                                <select name="parent_id" id="parent_id" class="form-control">
                                    <option value="">Please select Parent Dealer</option>
                                    <?php foreach($parents as $parent):?>
                                        <option value="<?php echo $parent->id?>"><?php echo $parent->name?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>

                            <div class="form-group col-lg-6" >
                                <label>Full Name</label>
                                <input class="form-control" name="name" id="name" placeholder="Full Name" required="">
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>

                            <div class="form-group col-lg-4">
                                <label>Number</label>
                                <input class="form-control" name="number" id="number" placeholder="Number" required="">
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>

                            <div class="form-group col-lg-4">
                                <label>Percentage</label>
                                <input class="form-control" name="percentage" id="percentage" placeholder="Percentage" required="" type="number">
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>

                            <div class="form-group col-lg-4">
                                <label>Percentage Value</label>
                                <input class="form-control" name="percentage_value" id="percentage" placeholder="Percentage Value" type="text">
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
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
            