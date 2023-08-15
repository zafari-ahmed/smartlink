<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Monthly Report</h1>
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
                    <form role="form" method="POST" action="<?php echo Yii::app()->baseUrl?>/report/monthlyreportsearch">
                        <!-- <div class="col-lg-12"> -->
                            <div class="form-group col-lg-3" >
                                <label>Opening Balance</label>
                                <input class="form-control" name="balance" value="" autocomplete="off">
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>
                            <div class="form-group col-lg-3" >
                                <label>Month</label>
                                <input class="form-control calender" name="start_date" value="<?php echo isset($_POST['start_date'])?$_POST['start_date']:date('Y-m-d')?>" autocomplete="off" required>
                                
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>
                            <div class="form-group col-lg-12">
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
                <table width="100%" class="table table-striped table-bordered table-hover" id="report2table">
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
                                <!-- <td><a href="<?php echo Yii::app()->baseUrl?>/plot/view/<?php echo $data->plot->plot->id?>"><?php echo @$data->plot->plot->plot_number.' / '.@$data->plot->plot->block_number?></a></td> -->
                                <td><a href="<?php echo Yii::app()->baseUrl?>/booking/viewbooking/<?php echo $data->plot->id?>"><?php echo @$data->plot->plot->block_number.' / '.@$data->plot->plot->plot_number?></a></td>
                                <td><?php echo $data->plot->customer->name?></td>
                                <td><?php echo ($this->startsWith($data->transaction_number, '#'))?$data->transaction_number:'#'.$data->transaction_number?></td>
                                <td><?php echo @$data->transaction_type?></td>
                                <td><?php echo ($development==0)?(@$data->plotPaymentMode->mode):'Development'?></td>
                                <td><?php echo 'Rs. '.number_format($data->amount)?></td>
                                <?php $total = $total + $data->amount?>
                                <td><?php echo date('d M,Y',strtotime($data->createdOn))?></td>
                                <td><?php echo $data->createdBy?></td>
                                <!-- <td><?php //echo ($data->status==0)?'<span class="label label-danger">Pending</span>':'<span class="label label-success">Paid</span>'?></td> -->
                            </tr>
                       <?php endforeach;}?>
                       
                    </tbody>
                </table>

                <?php if(isset($model)){?>
                <table width="100%" class="table table-striped table-bordered table-hover" id="report2table">
                    <th>Total Records</th>
                    <th>Total Plots</th>
                    <th>Total Amount</th>
                    <tr style="font-weight: bold;">
                       <td><?php echo (@$paymentmode)?(count(@$model).' '.ucwords(@$paymentmode->mode).'(s)'):count(@$model).' Records'?></td>
                       <td><?php echo @$modelCount->total?></td>
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