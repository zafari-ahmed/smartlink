<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Devices</h1>
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
                All Devices
                <!-- <span class="pull-right">
                    <a href="<?php //echo Yii::app()->baseUrl?>/report/exportavailableplot"><span class="label label-success">Export</span></a>
                    &nbsp;
                    <a href="<?php //echo Yii::app()->baseUrl?>/import/uploaddealer"><span class="label label-success">Import</span></a>
                </span> -->
                
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables">
                    <thead>
                        <tr>
                            <!-- <th>Block #</th>
                            <th>Plot Type</th> -->
                            <th class="hide">#</th>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Mac Address</th>
                            <th>Bluetooth Name</th>
                            <th>Device Category</th>
                            <th>Installation Date</th>
                            <th>Date Of Supply</th>
                            <th>Created At</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php if($devices){ foreach($devices as $device):?>
                       		<tr>
	                            <td class="hidden"><?php echo $device->id?></td>
                                <td><?php echo $this->UniqueID(@$device->id,'FL')?></td>
                                <td><?php echo @$device->name?></td>
                                <td><?php echo @$device->android_master_mac_address?></td>
                                <td><?php echo @$device->pcb_controller_bluetooth_name?></td>
                                <td><?php echo @$device->device_category?> Version</td>
                                <td><?php echo date('d M, Y',strtotime(@$device->installation_date))?></td>
                                <td><?php echo date('d M, Y',strtotime(@$device->date_of_supply))?></td>
                                <td><?php echo date('d M, Y',strtotime(@$device->created_at))?></td>    
                                <td><?php echo ($device->status==0)?'<span class="label label-danger">De-Activated</span>':'<span class="label label-success">Activated</span>'?>&nbsp;
                                    <a href="<?php echo Yii::app()->baseUrl?>/device/edit/<?php echo $device->id?>"><span class="aLink label label-success">Edit</span></a>&nbsp;
                                	<a href="<?php echo Yii::app()->baseUrl?>/device/view/<?php echo $device->id?>"><span class="aLink label label-info">View</span></a></td>
                            
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