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
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                All Plots
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables">
                    <thead>
                        <tr>
                            <th>Plot Sizes</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php if($sizes){ foreach($sizes as $size):?>
                       		<tr>
	                            <td><?php echo $size->size.' '.(($size->size_amount!=0)?'('.$size->size_amount.')':'')?></td>
                                <td><a href="<?php echo Yii::app()->baseUrl?>/sizes/edit/<?php echo $size->id?>"><span class="aLink label label-warning">Edit</span></a>&nbsp;<!-- <a href="javascript:void(0)" data-rel="<?php //echo $plot->id?>" class="deletePlot"><span class="aLink label label-danger">Delete</span></a> --></td>
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