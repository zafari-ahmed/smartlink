<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Devices</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Update Device
            </div>
            <div class="panel-body">
                <div class="row">
                    <form role="form" method="POST" action="<?php echo Yii::app()->baseUrl?>/device/update">
                        <!-- <div class="col-lg-12"> -->
                            <input type="hidden" name="id" value="<?php echo @$device->id?>">
                            <div class="form-group col-lg-5" style="padding-right: 0px;">
                                <label>Device Category</label>                                
                                <select name="device_category" id="device_category" class="form-control">
                                    <option value="">Please select Device Category</option>
                                    <option value="basic" <?php echo ($device->device_category=='basic')?'selected':''?>>Basic Version</option>
                                    <option value="advanced" <?php echo ($device->device_category=='advanced')?'selected':''?>>Advanced Version</option>
                                </select>
                            </div>

                            <div class="form-group col-lg-5" >
                                <label>Name</label>
                                <input class="form-control" name="name" id="name" placeholder="Device Name" required="" value="<?php echo @$device->name?>">
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>

                            <div class="form-group col-lg-4">
                                <label>Android Master Mac Address</label>
                                <input class="form-control" name="android_master_mac_address" id="android_master_mac_address" placeholder="Android Master Mac Address" required="" value="<?php echo @$device->android_master_mac_address?>">
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>

                            <div class="form-group col-lg-4">
                                <label>PCB Controller Bluetooth Name</label>
                                <input class="form-control" name="pcb_controller_bluetooth_name" id="pcb_controller_bluetooth_name" placeholder="Pcb Controller Bluetooth Name" required="" type="text" value="<?php echo @$device->pcb_controller_bluetooth_name?>">
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>

                            <div class="form-group col-lg-4">
                                <label>Aynchronised Asset Code</label>
                                <input class="form-control" name="synchronised_asset_code" id="synchronised_asset_code" placeholder="Aynchronised Asset Code" type="text" value="<?php echo @$device->synchronised_asset_code?>">
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>

                            <div class="form-group col-lg-3">
                                <label>Installation Date</label>
                                <input class="form-control calender" id="installation_date" name="installation_date" placeholder="Installation Date" value="<?php echo @$device->installation_date?>">
                            </div>

                            <div class="form-group col-lg-3">
                                <label>Date Of Supply</label>
                                <input class="form-control calender" id="date_of_supply" name="date_of_supply" placeholder="Date Of Supply" value="<?php echo @$device->date_of_supply?>">
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
            