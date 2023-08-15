<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Warning Letters</h1>
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
                All Warning Letters
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables">
                    <thead>
                        <tr>
                            <!-- <th>Block #</th>
                            <th>Plot Type</th> -->
                            <th class="hide">#</th>
                            <th>Booking ID</th>
                            <th>Reference #</th>
                            <th>Date</th>
                            <th>Tracking ID</th>
                            <th>Received By</th>
                            <th>Received On</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php if($warningLetters){ foreach($warningLetters as $letter):?>
                       		<tr>
	                            <td class="hidden"><?php echo $letter->id?></td>
                                <td><a href="<?php echo Yii::app()->baseUrl?>/booking/viewbooking/<?php echo $letter->booking->id?>"><?php echo '*'.$letter->booking->plot->block_number.'-'.$letter->booking->plot->plot_type.'-'.$letter->booking->plot->plot_number?>*</a></td>
	                            <td><?php echo @$letter->reference_number?></td>
	                            <td><?php echo date('d M, Y',strtotime(@$letter->createdOn))?></td>
	                            <td><?php echo @$letter->tracking_id?></td>
	                            <td><?php echo @$letter->received_by?></td>
	                            <td><?php echo (@$letter->received_on)?date('d M, Y',strtotime(@$letter->received_on)):''?></td>
	                            <td>
	                            	<a href="<?php echo Yii::app()->baseUrl?>/warningletter/edit/<?php echo $letter->id?>"><span class="aLink label label-info">Edit</span></a>&nbsp;
	                            	<?php if($userModel['user_type']['id'] == 1){?>
	                            		<a class="performTaskWindow" href="<?php echo Yii::app()->baseUrl?>/warningletter/delete/<?php echo $letter->id?>"><span class="aLink label label-danger">Delete</span></a>
	                            	<?php }?>
	                            </td>
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