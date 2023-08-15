<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Report</h1>
        <?php
            foreach(Yii::app()->user->getFlashes() as $key => $message) {
                echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'.$message.'</div>';
            }
        ?>
    </div>
    <!-- /.col-lg-12 -->
</div>
<?php $userModel = Yii::app()->session->get('userModel');?>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Filter
            </div>
            <div class="panel-body">
                <div class="row">
                    <form role="form" method="POST" action="<?php echo Yii::app()->baseUrl?>/report/search">
                        <!-- <div class="col-lg-12"> -->
                            <div class="form-group col-lg-3" >
                                <label>Start Date</label>
                                <?php if($userModel['user_type']['id'] == 1 || $userModel['user_type']['id'] == 5){?>
                                    <input class="form-control calender" name="start_date" value="<?php echo isset($_POST['start_date'])?@$_POST['start_date']:date('Y-m-d');?>" autocomplete="off" required>
                                <?php } else {?>
                                    <input class="form-control" name="start_date" value="<?php echo date('Y-m-d')?>" autocomplete="off" required readonly>
                                <?php }?>
                                
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>
                            <div class="form-group col-lg-3">
                                <label>End Date</label>
                                <?php if($userModel['user_type']['id'] == 1 || $userModel['user_type']['id'] == 5){?>
                                    <input class="form-control calender" name="end_date" value="<?php echo isset($_POST['end_date'])?@$_POST['end_date']:date('Y-m-d');?>" autocomplete="off"  required>
                                <?php } else {?>
                                    <input class="form-control" name="end_date" value="<?php echo date('Y-m-d')?>" autocomplete="off"  required readonly>
                                <?php }?>
                                
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>

                            <div class="form-group col-lg-3">
                                <label>Payment Mode</label>
                                <select name="mode" id="mode" class="form-control">
                                    <option value="all">All</option>
                                    <?php foreach(@$paymentmodes as $mode):?>
                                        <option value="<?php echo $mode['mode']?>" <?php echo (@$_POST['mode']==$mode['mode'])?'selected':''?>><?php echo $mode['mode']?></option>
                                    <?php endforeach;?>
                                    <option value="development" <?php echo (@$_POST['mode']=="development")?'selected':''?>>Development</option>
                                    <option value="transfer_fee" <?php echo (@$_POST['mode']=="transfer_fee")?'selected':''?>>Transfer Fee</option>
                                    <option value="penalty" <?php echo (@$_POST['mode']=="penalty")?'selected':''?>>Penalty</option>
                                    <option value="lease_charges" <?php echo (@$_POST['mode']=="lease_charges")?'selected':''?>>Lease Charges</option>
                                </select>
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>
                            <div class="form-group col-lg-2">
                                <label>Transacton Type</label>
                                <select name="transaction_type" id="transaction_type" class="form-control" required>
                                    <option <?php echo (@$_POST['transaction_type']=='all')?'selected':''?> value="all">All</option>
                                    <option <?php echo (@$_POST['transaction_type']=='cash')?'selected':''?> value="cash">Cash</option>
                                    <option <?php echo (@$_POST['transaction_type']=='cheque')?'selected':''?> value="cheque">Cheque</option>
                                    <option <?php echo (@$_POST['transaction_type']=='online')?'selected':''?> value="online">Online</option>
                                    <option <?php echo (@$_POST['transaction_type']=='PayOrder')?'selected':''?> value="PayOrder">PayOrder</option>
                                    <option <?php echo (@$_POST['transaction_type']=='bank')?'selected':''?> value="bank">Bank</option>

                                </select>
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>

                            <div class="form-group col-lg-2">
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
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                All Report
                <span class="pull-right"><a href="javascript:void(0)" id="report2btn"><span class="label label-success">Print</span></a></span>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body" id="tableBody">
                <table width="100%" class="table table-striped table-bordered table-hover" id="report2table" style="margin-bottom: 10%;">
                    <thead>
                        <tr>
                            <th>Plot #</th>
                            <th>Client Name</th>
                            <th>Transaction #</th>
                            <th>Transaction Type</th>
                            <th>Payment Mode</th>
                            <th>Amount</th>
                            <th>Created On</th>
                            <th>Created By</th>
                            <!-- <th>Action</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php $total = 0;if(@$model){ foreach($model as $data):?>
                            <tr>
                                <td><a href="<?php echo Yii::app()->baseUrl?>/booking/viewbooking/<?php echo $data->plot->id?>"><?php echo @$data->plot->plot->block_number.'-'.@$data->plot->plot->plot_type.'-'.@$data->plot->plot->plot_number?></a></td>
                                <td><?php echo $data->plot->customer->name?></td>
                                <td><?php echo ($this->startsWith($data->transaction_number, '#'))?$data->transaction_number:'#'.ltrim($data->transaction_number,'0')?></td>
                                <td><?php echo @$data->transaction_type?></td>

                                <td><?php //echo ($development==0)?(@$data->plotPaymentMode->mode):'Development'?>
                                    <?php if(isset($data->plot_payment_mode_id)){?> 
                                      <?php echo ucfirst(@$data->plotPaymentMode->mode)?>
                                    <?php } else {?>
                                        <?php echo ucfirst(@$data->plot_payment_mode)?>
                                    <?php }?>
                                </td>
                                <td><?php echo 'Rs. '.number_format($data->amount)?></td>
                                <?php $total = $total + $data->amount?>
                                <td><?php echo date('d M,Y',strtotime($data->createdOn))?></td>
                                <td><?php echo $data->createdBy?></td>
                            </tr>
                       <?php endforeach;}?>
                       
                    </tbody>
                </table>

                <?php if(isset($model)){?>
                <table width="100%" class="table table-striped table-bordered table-hover" id="report2table" style="
                bottom: 0;
    position: fixed;
    background-color: #ddd;
    width: 75%;
                ">
                    <th>Total Records</th>
                    <th>Total Plots</th>
                    <th>Total Amount</th>
                    <tr style="font-weight: bold;">
                       <td><?php echo (@$paymentmode)?(count(@$model).' '.ucwords(@$paymentmode->mode).'(s)'):count(@$model).' Records'?></td>
                       <td><?php echo @$modelCount?></td>
                       <td><?php echo 'Rs. '.number_format(@$total)?></td>
                   </tr>
               </table>
                <?php }?>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>

<script type="text/javascript">
    $(document).on('click', '#report2btn', function (e) {
       var divToPrint=document.getElementById("tableBody");
       newWin= window.open("");
       var heading = '<div><h3>Kainat City<span style="margin-left:25%">Kainat City</span><span style="float:right">Dated: <?php echo @$_POST['start_date']?> / <?php echo @$_POST['end_date']?></span></h3></div>';
       newWin.document.write('<style>table, th, td {border: 1px solid black;}</style>'+heading+divToPrint.outerHTML);
       newWin.print();
       newWin.close();
    });

</script>