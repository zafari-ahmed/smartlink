<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Dealers</h1>
        <?php
            foreach(Yii::app()->user->getFlashes() as $key => $message) {
                echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'.$message.'</div>';
            }
        ?>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Edit Dealer
            </div>
            <div class="panel-body">
                <div class="row">
                    <form role="form" method="POST" action="<?php echo Yii::app()->baseUrl?>/agent/update">
                        <!-- <div class="col-lg-12"> -->
                            <div class="form-group col-lg-6" >
                                <label>Full Name</label>
                                <input class="form-control" name="name" id="name" placeholder="Full Name" required="" value="<?php echo $agent->name?>">
                                <input name="id" value="<?php echo $agent->id?>" type="hidden">
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>

                            <div class="form-group col-lg-4">
                                <label>Number</label>
                                <input class="form-control" name="number" id="number" placeholder="Number" required="" value="<?php echo $agent->number?>">
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>

                            <div class="form-group col-lg-4">
                                <label>Percentage</label>
                                <input class="form-control" name="percentage" id="percentage" placeholder="Percentage" required="" type="number" value="<?php echo $agent->percentage?>">
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>

                            <div class="form-group col-lg-4">
                                <label>Percentage Value</label>
                                <input class="form-control" name="percentage_value" id="percentage" placeholder="Percentage" type="text" value="<?php echo $agent->percentage_value?>">
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>

                            <div class="col-md-12" id="agentPlotBox">
                                <h2>Plot Reserve Detail</h2>
                                <?php if($agent->agentReserves){ foreach($agent->agentReserves as $res):?>
                                    <div class="col-md-12" id="agentPlotBox">
                                        <div class="form-group col-lg-3">
                                            <label>Block #</label>
                                            <select class="form-control">
                                                <option value="">Select block #</option>
                                                <?php foreach($blocks as $block):?>
                                                    <option value="<?php echo $block->block_number?>" <?php echo (@$res->plot->block_number == $block->block_number)?'selected':''?>><?php echo $block->block_number?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </div>

                                        <div class="form-group col-lg-3" >
                                            <label>Plot type</label>
                                            <select class="form-control">
                                                <option value="" selected><?php echo $res->plot->plot_type?></option>
                                            </select>
                                        </div>

                                        <div class="form-group col-lg-3" >
                                            <label>Plot #</label>
                                            <select class="form-control">
                                                <option value="" selected><?php echo $res->plot->plot_number?></option>
                                            </select>
                                        </div>

                                        <div class="form-group col-lg-3" >
                                            <a href="<?php echo Yii::app()->baseUrl?>/agent/deleteagentplot/<?php echo $res->id?>"><span class="aLink label label-danger">Delete</span></a>
                                        </div>
                                    </div>
                                <?php endforeach; }?>
                                <div class="form-group col-lg-4">
                                    <label>Block #</label>
                                    <select id="block_number" class="form-control">
                                        <option value="">Select block #</option>
                                        <?php foreach($blocks as $block):?>
                                            <option value="<?php echo $block->block_number?>" <?php (@$currentPlot['block_number'] == $block->block_number)?'selected':''?>><?php echo $block->block_number?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>

                                <div class="form-group col-lg-4" >
                                    <label>Plot type</label>
                                    <select id="plot_type" class="form-control">
                                        <option value="">Select plot #</option>
                                    </select>
                                </div>

                                <div class="form-group col-lg-4" >
                                    <label>Plot #</label>
                                    <select name="plot_number[]" id="plot_number" class="form-control">
                                        <option value="">Select plot #</option>
                                    </select>
                                </div>
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
            