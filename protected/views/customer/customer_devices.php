<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Customer Devices</h1>
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
                New Customer Device
            </div>
            <div class="panel-body">
                <div class="row">
                    <form role="form" method="POST" action="<?php echo Yii::app()->baseUrl?>/customer/saveDevices">
                        <!-- <div class="col-lg-12"> -->
                            <input type="hidden" name="customer_id" value="<?php echo $customer_id?>">
                            <div class="form-group col-lg-3" style="padding-right: 0px;">
                                <label>Customer</label>                                
                                <select id="customer_id" class="form-control" readonly disabled>
                                    <option value="">Please select Customer</option>
                                    <?php foreach($customers as $customer):?>
                                        <option value="<?php echo $customer->id?>" <?php echo ($customer_id==$customer->id)?'selected':''?>><?php echo $customer->name?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>

                            <div class="form-group col-lg-3" style="padding-right: 0px;">
                                <label>Devices</label>                                
                                <select name="device_id" id="device_id" class="form-control" required>
                                    <option value="">Please select Device</option>
                                    <?php foreach($devices as $device):?>
                                        <option value="<?php echo $device->id?>"><?php echo $device->name?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                            <div class="col-lg-12">
                                <button type="submit" class="btn btn-success">Submit</button>
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
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Customer Devices
                <!-- <span class="pull-right">
                    <a href="<?php //echo Yii::app()->baseUrl?>/report/exportavailableplot"><span class="label label-success">Export</span></a>
                    &nbsp;
                    <a href="<?php //echo Yii::app()->baseUrl?>/import/uploaddealer"><span class="label label-success">Import</span></a>
                </span> -->
                
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <table width="100%" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <!-- <th>Block #</th>
                            <th>Plot Type</th> -->
                            <th class="hide">#</th>
                            <th>Device</th>
                            <th>Mac Address</th>
                            <th>Bluetooth Name</th>
                            <th>Device Category</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php if($customerDevices){ foreach($customerDevices as $customerDevice):?>
                            <tr>
                                <td class="hidden"><?php echo $customerDevice->id?></td>
                                <td><?php echo @$customerDevice->device->name?></td>
                                 <td><?php echo @$customerDevice->device->android_master_mac_address?></td>
                                <td><?php echo @$customerDevice->device->pcb_controller_bluetooth_name?></td>
                                <td><?php echo @$customerDevice->device->device_category?> Version</td>
                                <td><a href="<?php echo Yii::app()->baseUrl?>/customer/deletecustomerdevice/<?php echo $customerDevice->id?>"><span class="aLink label label-danger">Delete</span></a></td>
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
            