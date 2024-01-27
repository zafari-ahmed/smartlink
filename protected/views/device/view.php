<?php $userModel = Yii::app()->session->get('userModel');?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">View Device
    </h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-success">
            <div class="panel-heading">
                <b style="text-transform: UPPERCASE;font-weight: bold;">View Device (<?php echo @$device->name?>)</b>
            </div>
            <!-- /.panel-heading -->
            

            <div class="panel-body">
                <div class="col-lg-12">
                   <div class="form-group col-lg-3" style="padding-left: 0px;">
                        <label>Name</label>
                        <p><?php echo @$device->name?></p>
                    </div>
                    <div class="form-group col-lg-2">
                        <label>MAC Address</label>
                        <p><?php echo @$device->android_master_mac_address?></p>
                    </div>
                    <div class="form-group col-lg-2">
                        <label>Bluetooth Name</label>
                        <p><?php echo @$device->pcb_controller_bluetooth_name?></p>
                    </div>

                    <div class="form-group col-lg-2" >
                        <label>Device Category</label>
                        <p><?php echo @$device->device_category?> Version</p>
                    </div>
                    <div class="form-group col-lg-2" style="padding-left: 0px;">
                        <label>Installation Date</label>
                        <p><?php echo date('d M, Y',strtotime(@$device->installation_date))?></p>
                    </div>
                    <div class="form-group col-lg-2" style="padding-left: 0px;">
                        <label>Supply Date</label>
                        <p><?php echo date('d M, Y',strtotime(@$device->date_of_supply))?></p>
                    </div>
                </div> 
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
    <?php if($device->assets){?>
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <b style="text-transform: UPPERCASE;font-weight: bold;">Device Asset Information</b>
            </div>
            
            <div class="panel-body">
                <table width="100%" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th class="hide">#</th>
                            <th>Asset Code</th>
                            <th>Manufacturer</th>
                            <th>Model</th>
                            <th>YOM</th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php foreach($device->assets as $asset):?>
                            <tr>
                                <td class="hidden"><?php echo $asset->id?></td>
                                <td><?php echo @$asset->asset_code?></td>
                                <td><?php echo @$asset->manufacturer?></td>
                                <td><?php echo @$asset->model?></td>
                                <td><?php echo @$asset->yom?></td>

                            </tr>
                       <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php }?>
    <!-- /.col-lg-12 -->
</div>