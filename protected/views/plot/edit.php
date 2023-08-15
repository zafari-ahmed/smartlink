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
                    <form role="form" method="POST" action="<?php echo Yii::app()->baseUrl?>/plot/update" enctype="multipart/form-data">
                        <!-- <div class="col-lg-12"> -->
                            <div class="form-group col-lg-3" >
                                <label>Plot #</label>
                                <input class="form-control" name="plot_number" placeholder="Plot #" required="" value="<?php echo $plot->plot_number?>">
                                <input type="hidden" name="id" value="<?php echo $plot->id?>">
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>
                            <div class="form-group col-lg-3">
                                <label>Block #</label>
                                <input class="form-control"  name="block_number" id="block_number" placeholder="Block #" required value="<?php echo $plot->block_number?>">
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>
                            <div class="form-group col-lg-3" style="padding-right: 0px;">
                                <label>Category</label>
                                <!-- <input class="form-control" disabled="" name="category_id" id="category_id" placeholder="Plot Category"> -->
                                <select name="category_id" id="category_id" class="form-control" required>
                                    <option value="">Please select plot category</option>
                                    <?php foreach($categories as $category):?>
                                        <option value="<?php echo $category->id?>" <?php echo (@$plot->category_id == $category->id)?'selected':''?>><?php echo $category->name?></option>
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
                                        
                                        <option value="<?php echo $size->id?>" <?php echo (@$plot->size_id == $size->id)?'selected':''?>><?php echo $size->size.' '.(($size->size_amount!=0)?'('.$size->size_amount.')':'')?></option>
                                    <?php endforeach;?>
                                </select>
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>
                            <div class="form-group col-lg-6" >
                                <label>Total Amount</label>
                                <input class="form-control" name="total" id="total" placeholder="Total " value="<?php echo @$plot->total?>">
                            </div>
                            <div class="form-group col-lg-6" >
                                <label>Total Discount</label>
                                <input class="form-control" name="discount" id="discount" placeholder="Discount " value="<?php echo @$plot->discount?>">
                            </div>
                        <!-- </div> -->
                        <div class="col-lg-12">
                            <h3><label>Extra</label></h3>
                            <div class="form-group">
                                
                                <div class="form-group col-lg-12" >
                                    <label class="checkbox-inline">
                                        <input type="checkbox" name="is_road_facing" id="is_road_facing" value="1" <?php echo (@$plot->is_road_facing == 1)?'checked':''?>>Extra Land
                                    </label>
                                    <input class="form-control" name="is_road_facing_amount" id="is_road_facing_amount" placeholder="Road Facing Amount " value="<?php echo @$plot->is_road_facing_amount?>">
                                </div>
                                <div class="form-group col-lg-12" >
                                    <label class="checkbox-inline">
                                        <input type="checkbox" name="is_corner" id="is_corner" value="1" <?php echo (@$plot->is_corner == 1)?'checked':''?>>Corner
                                    </label>
                                    <input class="form-control" name="is_corner_amount" id="is_corner_amount" placeholder="Corner Amount " value="<?php echo @$plot->is_corner_amount?>">
                                </div>
                                <div class="form-group col-lg-12" >
                                    <label class="checkbox-inline">
                                        <input type="checkbox" name="is_park_facing" id="is_park_facing" value="1" <?php echo (@$plot->is_park_facing == 1)?'checked':''?>>Park Facing
                                    </label>
                                    <input class="form-control" name="is_park_facing_amount" id="is_park_facing_amount" placeholder="Park Facing Amount " value="<?php echo @$plot->is_park_facing_amount?>">
                                </div>
                                <div class="form-group col-lg-12" >
                                    <label class="checkbox-inline">
                                        <input type="checkbox" name="is_west_open" id="is_west_open" value="1" <?php echo (@$plot->is_west_open == 1)?'checked':''?>>West Open
                                    </label>
                                    <input class="form-control" name="is_west_open_amount" id="is_west_open_amount" placeholder="West Open Amount" value="<?php echo @$plot->is_west_open_amount?>">
                                </div>
                            </div>

                        </div>

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Site Plan Document</label>
                                <input type="file" class="form-control" name="site_plan" id="plot" placeholder="Upload Site Plan">
                            </div>
                            <?php if(@$plot->plotSitePlans){?>
                            <p>
                                <a target="_blank" href="<?php echo Yii::app()->baseUrl?>/uploads/plot/site_plan/<?php echo @$plot->plotSitePlans[0]->site_plan?>">View Site Plan</a>
                            </p>
                            <?php }?>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group col-lg-3" >
                                <label>North</label>
                                <input required class="form-control" name="north" id="north" placeholder="North " value="<?php echo @$plot->plotBoundries[0]->north?>">
                            </div>
                            <div class="form-group col-lg-3" >
                                <label>West</label>
                                <input required class="form-control" name="west" id="west" placeholder="West " value="<?php echo @$plot->plotBoundries[0]->west?>">
                            </div>
                            <div class="form-group col-lg-3" >
                                <label>South</label>
                                <input required class="form-control" name="south" id="south" placeholder="South " value="<?php echo @$plot->plotBoundries[0]->south?>">
                            </div>
                            <div class="form-group col-lg-3" >
                                <label>East</label>
                                <input required class="form-control" name="east" id="east" placeholder="East " value="<?php echo @$plot->plotBoundries[0]->east?>">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            
                            <div class="col-lg-12">
                                <button type="submit" class="btn btn-success">Update Plot</button>
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
            