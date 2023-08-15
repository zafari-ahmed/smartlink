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
                Update Payment Schedule
            </div>
            <div class="panel-body">
                <div class="row">
                    <form role="form" method="POST" action="<?php echo Yii::app()->baseUrl?>/paymentschedule/update">

                        <div class="form-group col-lg-3" >
                            <label>Name</label>
                            <input class="form-control" name="name" id="name" placeholder="Name" required="" value="<?php echo $PaymentSchedule->name?>" >
                            <input type="hidden" name="id" value="<?php echo $PaymentSchedule->id?>" >
                        </div>                    
                        
                        <div class="form-group col-lg-12" >
                            <table width="100%" class="table table-striped table-bordered table-hover">
                                <tr>
                                    <th>Description</th>
                                    <?php foreach($types as $type):?>
                                        <th><?php echo ucwords($type->plot_type)?></th>
                                    <?php endforeach;?>
                                </tr>
                                <tbody>
                                    <?php $modes = PaymentSchedulePaymentModes::model()->findAll(array(
                                            'select'=>'t.mode',
                                            'condition'=>"payment_schedule_id = $PaymentSchedule->id",
                                            'distinct'=>true,
                                        ));
                                    foreach($modes as $mode):
                                        $modeDetail = PaymentSchedulePaymentModes::model()->findAll('payment_schedule_id = :id AND mode = :type',array(':id'=>$PaymentSchedule->id,':type'=>$mode->mode));
                                        foreach($modeDetail as $md){
                                            $modeDetailData[$md->plot_type]['type'] = $md->plot_type;
                                            $modeDetailData[$md->plot_type]['amount'] = $md->amount;
                                            $modeDetailData[$md->plot_type]['id'] = $md->id;
                                        }
                                    ?>
                                        <tr>
                                            <td><?php echo ucfirst($mode->mode)?></td>
                                            <?php foreach($types as $type):
                                                 ?>
                                                <td><input class="form-control col-md-3" name="payment[<?php echo strtolower($mode->mode)?>][<?php echo strtolower($type->plot_type)?>][amount]" value="<?php echo $modeDetailData[strtolower($type->plot_type)]['amount']?>" required><input  type="hidden" name="payment[<?php echo strtolower($mode->mode)?>][<?php echo strtolower($type->plot_type)?>][id]" value="<?php echo $modeDetailData[strtolower($type->plot_type)]['id']?>"></td>
                                            <?php endforeach;?>
                                        </tr>
                                    <?php endforeach;?>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
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
            