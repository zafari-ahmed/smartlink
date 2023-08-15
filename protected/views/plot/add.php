<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Plots</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                New Plot
            </div>
            <div class="panel-body">
                <div class="row">
                    <form role="form" method="POST" action="<?php echo Yii::app()->baseUrl?>/plot/save" enctype="multipart/form-data">
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
                                        <option value="<?php echo $size->id?>"><?php echo $size->size.' '.(($size->size_amount!=0)?'('.$size->size_amount.')':'')?></option>
                                    <?php endforeach;?>
                                </select>
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>
                            <div class="form-group col-lg-6" >
                                <label>Total Discount</label>
                                <input class="form-control" name="discount" id="discount" placeholder="Discount " value="<?php echo @$plot->discount?>">
                            </div>
                        <!-- </div> -->
                        <div class="col-lg-12">
                        
                            <div class="form-group">
                                <label>Extra</label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="is_road_facing" id="is_road_facing" value="1" >Extra Land
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

                        </div>

                        <div class="col-lg-12">
                        
                            <!-- <div class="form-group">
                                <label>Nyhal(s) Plot</label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="nyhal_plot" id="nyhal_plot" value="1" >Nyhal(s) Plot
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
                            </div> -->

                            <div class="form-group col-lg-6" style="padding-left: 0px;">
                                <label>Total Amount</label>
                                <input class="form-control" name="total" id="total" placeholder="Total ">
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>

                             <div class="form-group col-lg-12" style="padding-left: 0px;">
                                <label>Site Plan Document</label>
                                <input type="file" class="form-control" name="site_plan" id="plot" placeholder="Upload Site Plan">
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group col-lg-3" >
                                    <label>North</label>
                                    <input required class="form-control" name="north" id="north" placeholder="North">
                                </div>
                                <div class="form-group col-lg-3" >
                                    <label>West</label>
                                    <input required class="form-control" name="west" id="west" placeholder="West ">
                                </div>
                                <div class="form-group col-lg-3" >
                                    <label>South</label>
                                    <input required class="form-control" name="south" id="south" placeholder="South ">
                                </div>
                                <div class="form-group col-lg-3" >
                                    <label>East</label>
                                    <input required class="form-control" name="east" id="east" placeholder="East ">
                                </div>
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
            