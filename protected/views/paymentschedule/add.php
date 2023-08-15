<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Payment Schedules</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                New Payment Schedule
            </div>
            <div class="panel-body">
                <div class="row">
                    <form role="form" method="POST" action="<?php echo Yii::app()->baseUrl?>/paymentschedule/save">
                        <!-- <div class="col-lg-12"> -->
                            
                            <!-- <div class="form-group col-lg-3" >
                                <label>Plot Type</label>
                                <select name="plot_type" id="plot_type" class="form-control" required>
                                    <option value="">Select plot Type</option>
                                    <?php /*foreach($types as $type):?>
                                        <option value="<?php echo $type->plot_type?>"><?php echo $type->plot_type?></option>
                                    <?php endforeach;*/?>
                                </select>
                            </div> -->
                            <div class="form-group col-lg-3" >
                                <label>Name</label>
                                <input class="form-control" name="name" id="name" placeholder="Name" required="" value="<?php echo 'EH'.sprintf('%04d', $total+1)?>" readonly>
                            </div>                    
                            <?php /*foreach($this->paymentScheduleModes() as $modes):?>
                                <div class="form-group col-lg-12" >
                                <label><?php echo $modes?></label>
                                <input class="form-control col-md-3" name="payment[modes][<?php echo strtolower($modes)?>]" id="name" placeholder="<?php echo $modes?> Amount" required>
                            </div>
                            <?php endforeach;*/?>
                            <div class="form-group col-lg-12" >
                                <table width="100%" class="table table-striped table-bordered table-hover">
                                    <tr>
                                        <th>Description</th>
                                        <?php foreach($types as $type):?>
                                            <th><?php echo ucwords($type->plot_type)?></th>
                                        <?php endforeach;?>
                                    </tr>
                                    <tbody>
                                        <?php foreach($this->paymentScheduleModes() as $modes):?>
                                            <tr>
                                                <td><?php echo $modes?></td>
                                                <?php foreach($types as $type):?>
                                                    <td><input class="form-control col-md-3" name="payment[<?php echo strtolower($modes)?>][<?php echo strtolower($type->plot_type)?>]" id="name" placeholder="<?php echo $modes?> Amount" required></td>
                                                <?php endforeach;?>
                                            </tr>
                                        <?php endforeach;?>
                                    </tbody>
                                </table>
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
            