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
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Filter
            </div>
            <div class="panel-body">
                <div class="row">
                    <form role="form" method="POST" action="<?php echo Yii::app()->baseUrl?>/report/search3">
                        <!-- <div class="col-lg-12"> -->
                            <div class="form-group col-lg-2" >
                                <label>Start Date</label>
                                <input class="form-control calender" name="start_date" value="<?php echo @$_POST['start_date']?>" autocomplete="off" required>
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>
                            <div class="form-group col-lg-2">
                                <label>End Date</label>
                                <input class="form-control calender" name="end_date" value="<?php echo @$_POST['end_date']?>" autocomplete="off"  required>
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>

                            <div class="form-group col-lg-2">
                                <label>Payment Mode</label>
                                <select name="mode" id="mode" class="form-control">
                                    <option value="">Please select plot payment mode</option>
                                    <?php foreach(@$paymentmodes as $mode):?>
                                        <option value="<?php echo $mode->id?>" <?php echo (@$_POST['mode']==$mode->id)?'selected':''?>><?php echo $mode->mode?></option>
                                    <?php endforeach;?>
                                    <!-- <option value="full_payment">Full Payment</option> -->
                                </select>
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>
                            <div class="form-group col-lg-2">
                                <label>Dealer</label>
                                <select name="agent" id="agent" class="form-control select2">
                                    <!-- <option value="">Please select plot payment mode</option> -->
                                    <?php foreach(@$agents as $agent):?>
                                        <option value="<?php echo $agent->id?>" <?php echo (@$_POST['agent']==$agent->id)?'selected':''?>><?php echo $agent->name?></option>
                                    <?php endforeach;?>
                                    <!-- <option value="full_payment">Full Payment</option> -->
                                </select>
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>

                            <div class="form-group col-lg-2">
                                <label>Cheque #</label>
                                <input class="form-control" name="cheque" value="<?php //echo @$_POST['cheque']?>" autocomplete="off" >
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>

                            


                            <div class="form-group col-lg-6">
                                <button type="submit" class="btn btn-success" style="margin-top: 9%;">Submit</button>
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
                <table width="100%" class="table table-striped table-bordered table-hover" id="report2table">
                    <thead>
                        <tr>
                            <th style="width: 15%">Plot #</th>
                            <th style="width: 30%">Client Name</th>
                            <th style="width: 10%">Transaction #</th>
                            <th style="width: 10%">Payment Mode</th>
                            <th style="width: 10%">Amount</th>
                            <th style="width: 10%">Commission</th>
                            <th style="width: 15%">Created On</th>
                            <!-- <th>Created By</th> -->
                            <!-- <th>Action</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php $total = 0;$commission = 0;if(@$model){ foreach($model as $data):?>
                            <tr>
                                <td><a href="<?php echo Yii::app()->baseUrl?>/booking/viewbooking/<?php echo $data->plot->id?>"><?php echo @$data->plot->plot->block_number.' / '.@$data->plot->plot->plot_number?></a></td>
                                <td><?php echo $data->plot->customer->name?></td>
                                <td><?php echo ($this->startsWith($data->transaction_number, '#'))?$data->transaction_number:'#'.$data->transaction_number?></td>
                                <td><?php echo @$data->plotPaymentMode->mode?></td>
                                <td><?php echo 'Rs. '.number_format($data->amount)?></td>
                                <?php $total = $total + $data->amount?>
                                <td><?php echo 'Rs. '.$this->DealerPercentage($data->plot->agent,$data->amount,$data->plot->agent->percentage,1,$data->plotPaymentMode)  ?></td>
                                <?php $commission = $commission + @$this->DealerPercentage($data->plot->agent,$data->amount,$data->plot->agent->percentage,0,$data->plotPaymentMode)?>
                                <td><?php echo date('d M,Y',strtotime($data->createdOn))?></td>
                                <!-- <td><?php echo $data->createdBy?></td> -->
                                <!-- <td><?php //echo ($data->status==0)?'<span class="label label-danger">Pending</span>':'<span class="label label-success">Paid</span>'?></td> -->
                            </tr>
                       <?php endforeach;}?>
                       
                    </tbody>
                </table>

                <?php if(isset($model)){?>
                <table width="100%" class="table table-striped table-bordered table-hover" id="report2table">
                    <th>Total Records</th>
                    <th>Dealer Name</th>
                    <th>Cheque #</th>
                    <th>Total Amount</th>
                    <th>Total Commission</th>
                    <!-- <th>Plot #</th>
                    <th>Client Name</th>
                    <th>Transaction #</th>
                    <th>Payment Mode</th>
                    <th>Amount</th>
                    <th>Commission</th>
                    <th>Created On</th> -->
                    
                    <tr style="font-weight: bold;">
                       <td style="width: 15%"><?php echo (@$paymentmode)?(count(@$model).' '.ucwords(@$paymentmode->mode).'(s)'):count(@$model).' Records'?></td>
                       <td style="width: 15%"><?php echo $agentSelected->name?></td>
                       <td style="width: 15%"><?php echo @$_POST['cheque']?></td>
                       <td style="width: 15%"><?php echo 'Rs. '.number_format(@$total)?></td>
                       <td style="width: 15%"><?php echo 'Rs. '.number_format(@$commission)?></td>
                       
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
       var che = '<div style="margin-top:100px;"><div style="width:25%;font-family:Arial, Helvetica, sans-serif;text-align:center;margin-right:10px;margin-top:15px;float:left;"><input type="text" style="border:0;border-bottom:solid 1px #000;width:100%;font-family:Arial, Helvetica, sans-serif;outline:0;"><label>Prepared By</label></div></div>';
       var rev = '<div style="margin-left:35%;margin-top:100px;width:35%;"><div style="font-family:Arial, Helvetica, sans-serif;text-align:center;margin-right:10px;margin-top:15px;float:left;"><input type="text" style="border:0;border-bottom:solid 1px #000;width:100%;font-family:Arial, Helvetica, sans-serif;outline:0;"><label>Checked By</label></div></div>';
       var sign = '<div style="margin-left:70%;margin-top:100px;width:50%"><div style="font-family:Arial, Helvetica, sans-serif;text-align:center;margin-right:10px;margin-top:15px;float:left;"><input type="text" style="border:0;border-bottom:solid 1px #000;width:100%;font-family:Arial, Helvetica, sans-serif;outline:0;"><label>Receiver`s Signature</label></div></div>';
       newWin.document.write('<style>table, th, td {border: 1px solid black;}</style>'+heading+divToPrint.outerHTML+che+rev+sign);
       newWin.print();
       newWin.close();
    });

</script>