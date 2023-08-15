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
                New Payment Modes
            </div>
            <div class="panel-body">
                <div class="row">
                    <form role="form" method="POST" action="<?php echo Yii::app()->baseUrl?>/plot/save">
                        <!-- <div class="col-lg-12"> -->
                            <div class="form-group col-lg-3" >
                                <label>Plot #</label>
                                <input class="form-control" name="plot_number"  placeholder="Plot #" required="">
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>
                            <div class="form-group col-lg-3">
                                <label>Block #</label>
                                <input class="form-control"  name="block_number" placeholder="Block #" required>
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>
                            <div class="form-group col-lg-3" style="padding-right: 0px;">
                                <label>Category</label>
                                <!-- <input class="form-control" disabled="" name="category_id" id="category_id" placeholder="Plot Category"> -->
                                <select name="category_id" id="category_id" class="form-control" required>
                                    <option value="">Please select plot category</option>
                                    <?php foreach($categories as $category):?>
                                        <option value="<?php echo $category->id?>"><?php echo $category->name?></option>
                                    <?php endforeach;?>
                                </select>
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>
                            <div class="form-group col-lg-3">
                                <label>Size</label>
                                <!-- <input class="form-control" disabled="" name="size_id" id="size_id" placeholder="Plot Size"> -->
                                <select name="size_id" id="size_id" class="form-control" required>
                                    <option value="">Please select plot size</option>
                                    <?php foreach($sizes as $size):?>
                                        <option value="<?php echo $size->id?>"><?php echo $size->size?></option>
                                    <?php endforeach;?>
                                </select>
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>
                        <!-- </div> -->
                        <div class="col-lg-12">
                        
                            <div class="form-group">
                                <label>Extra</label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="is_road_facing" id="is_road_facing" value="1" >Road Facing
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="is_corner" id="is_corner" value="1">Corner
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="is_park_facing" id="is_park_facing" value="1">Park Facing
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="is_west_open" id="is_west_open" value="1">West Open
                                </label>
                            </div>
                            <div class="form-group col-lg-6" style="padding-left: 0px;">
                                <label>Total Amount</label>
                                <input class="form-control" name="total" id="total" placeholder="Total ">
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>
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
            