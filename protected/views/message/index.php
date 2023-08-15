<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Message</h1>
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
                All Message
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables">
                    <thead>
                        <tr>
                            <th>Block #</th>
                            <th>Plot #</th>
                            <th>Category</th>
                            <th>Size</th>
                            <th>Total</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php if($plots){ foreach($plots as $plot):?>
                       		<tr>
	                            <td><a href="<?php echo Yii::app()->baseUrl?>/plot/view/<?php echo $plot->id?>"><?php echo $plot->block_number?></a></td>
	                            <td><a href="<?php echo Yii::app()->baseUrl?>/plot/view/<?php echo $plot->id?>"><?php echo $plot->plot_number?></a></td>
	                            <td><?php echo $plot->category->name?></td>
	                            <td><?php echo $plot->size->size?></td>
	                            <td><?php echo $plot->total?></td>
	                            <td><?php echo ($plot->status==0)?'<span class="label label-success">Available</span>':'<span class="label label-danger">Booked</span>'?>&nbsp;<a href="<?php echo Yii::app()->baseUrl?>/plot/view/<?php echo $plot->id?>"><span class="aLink label label-info">View</span></a>&nbsp;<a href="<?php echo Yii::app()->baseUrl?>/plot/edit/<?php echo $plot->id?>"><span class="aLink label label-warning">Edit</span></a></td>
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