<?php $userModel = Yii::app()->session->get('userModel');?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">View Customer
    </h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-success">
            <div class="panel-heading">
                <b style="text-transform: UPPERCASE;font-weight: bold;">View Customer (<?php echo @$customer->domain_url?>)</b>
            </div>
            <!-- /.panel-heading -->
            

            <div class="panel-body">
                <div class="col-lg-12">
                    <h3 style="text-transform: UPPERCASE;font-weight: bold;">Customer Information</h3>
                    <div class="form-group col-lg-3" style="padding-left: 0px;">
                        <label>Name</label>
                        <p><?php echo @$customer->name?></p>
                    </div>
                    <div class="form-group col-lg-2">
                        <label>NTN Number</label>
                        <p><?php echo @$customer->ntn_number?></p>
                    </div>
                    <div class="form-group col-lg-2">
                        <label>STRN Number</label>
                        <p><?php echo @$customer->strn_number?></p>
                    </div>

                    <div class="form-group col-lg-2" >
                        <label>Country</label>
                        <p><?php echo @$customer->country->name?></p>
                    </div>
                    <div class="form-group col-lg-2" style="padding-left: 0px;">
                        <label>Login Email</label>
                        <p><?php echo @$customer->email?></p>
                    </div>
                </div> 
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->

    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <b style="text-transform: UPPERCASE;font-weight: bold;">Customer Device(s) Information</b>
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