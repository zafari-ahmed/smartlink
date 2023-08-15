<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Plots</h1>
        <?php
            foreach(Yii::app()->user->getFlashes() as $key => $message) {
                echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'.$message.'</div>';
            }
        ?>
    </div>
    <!-- /.col-lg-12 -->
</div>
<?php $userModel = Yii::app()->session->get('userModel'); ?>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                All Plots
                <span class="pull-right">
                    <a href="<?php echo Yii::app()->baseUrl?>/report/exportavailableplot"><span class="label label-success">Export</span></a>
                    &nbsp;
                    <a href="<?php echo Yii::app()->baseUrl?>/import/uploaddealer"><span class="label label-success">Import</span></a>
                </span>
                
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables">
                    <thead>
                        <tr>
                            <!-- <th>Block #</th>
                            <th>Plot Type</th> -->
                            <th class="hide">#</th>
                            <th>Plot #</th>
                            <th>Category</th>
                            <th>Size</th>
                            <th>Dealer</th>
                            <th>Boundries<span style="font-size: 10px;">(N-S-E-W)</span></th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php if($plots){ foreach($plots as $plot):?>
                       		<tr>
	                            <td class="hidden"><?php echo $plot->id?></td>
                                <td><a href="<?php echo Yii::app()->baseUrl?>/plot/view/<?php echo $plot->id?>"><?php echo '*'.$plot->block_number.'-'.$plot->plot_type.'-'.$plot->plot_number?>*</a></td>
	                            <td><?php echo @$plot->category->name?></td>
	                            <td><?php echo @$plot->size->size?></td>
	                            <td><?php echo @$plot->agentReserve[0]->agent->agentParent->name.'/'.@$plot->agentReserve[0]->agent->name;//echo @$this->PlotUpdatedTotal($plot->id)?></td>
                                <td><?php echo @$plot->plotBoundries[0]->north.'-'.@$plot->plotBoundries[0]->south.'-'.@$plot->plotBoundries[0]->east.'-'.@$plot->plotBoundries[0]->west?></td>
	                            
                                <td><?php echo ($plot->status==0)?'<span class="label label-success">Available</span>':'<span class="label label-danger">Booked</span>'?>&nbsp;<a href="<?php echo Yii::app()->baseUrl?>/plot/view/<?php echo $plot->id?>"><span class="aLink label label-info">View</span></a>&nbsp;
                                    <?php if($userModel['user_type']['id'] == 1 || $userModel['user_type']['id'] == 5){?>
                                        <a href="<?php echo Yii::app()->baseUrl?>/plot/edit/<?php echo $plot->id?>"><span class="aLink label label-warning">Edit</span></a>
                                    <?php }?>
                                    <!--&nbsp;<a href="javascript:void(0)" data-rel="<?php //echo $plot->id?>" class="deletePlot"><span class="aLink label label-danger">Delete</span></a>&nbsp;--><!-- <a href="<?php //echo Yii::app()->baseUrl?>/plot/getpaymentschedule/<?php //echo $plot->id?>" data-rel="<?php //echo $plot->id?>"><span class="label label-info">Payment Schedule</span></a> -->

                                    <table class="table table-responsive" style="FONT-SIZE: 12PX;">
                                        <tbody>
                                            <tr>
                                                <td class="tbBold">Corner</td>
                                                <td><?php echo ($plot->is_corner==1)?'<span class="label label-success" style="text-decoration: none;">YES</span>':'<span class="label label-danger" style="text-decoration: none;">No</span>'?></td>
                                                
                                            </tr>
                                            <tr>
                                                <td class="tbBold">Park Facing</td>
                                                <td><?php echo ($plot->is_park_facing==1)?'<span class="label label-success" style="text-decoration: none;">YES</span>':'<span class="label label-danger" style="text-decoration: none;">No</span>'?></td>
                                                
                                            </tr>
                                            <tr>
                                                <td class="tbBold">West Open</td>
                                                <td><?php echo ($plot->is_west_open==1)?'<span class="label label-success" style="text-decoration: none;">YES</span>':'<span class="label label-danger" style="text-decoration: none;">No</span>'?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <?php /*} else {?>
                                    <td><?php echo ($plot->status==0)?'<span class="label label-success">Available</span>':'<span class="label label-danger">Booked</span>'?>&nbsp;<a href="<?php echo Yii::app()->baseUrl?>/plot/view/<?php echo $plot->id?>"><span class="aLink label label-info">View</span></a></td>
                                <?php }*/ ?>
	                        </tr>
                       <?php endforeach;}?>
                    </tbody>
                </table>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>