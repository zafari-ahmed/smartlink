<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Payment Modes</h1>
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
                All Payment Modes
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <table width="100%" class="table table-striped table-bordered table-hover" id="sizeTable">
                    <thead>
                        <tr>
                            <th>Mode</th>
                            <th>Size</th>
                            <th>Amount</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php if($plotSizes){ foreach($plotSizes as $plotSize): $modes = PaymentModes::model()->findAll('plot_size_id = :id',array(':id'=>$plotSize->id));?>
                       		<?php if($modes) { foreach($modes as $mode): ?>
                       		<tr>
	                            <td><?php echo @$mode->mode?></td>
	                            <td><?php echo @$mode->plotSize->size.(($mode->plotSize->size_amount!=0)?'-'.$mode->plotSize->size_amount:'')?></td>
	                            <td><?php echo ($mode->amount)?('Rs. '.number_format(@$mode->amount)):'-'?></td>
	                            <td><a href="<?php echo Yii::app()->baseUrl?>/paymentmode/edit/<?php echo $mode->id?>"><span class="aLink label label-warning">Edit</span></a></td>
	                        </tr>
	                    <?php endforeach; }?>
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