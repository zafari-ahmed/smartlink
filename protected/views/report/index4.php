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
<?php
$mainTotal = 0;
$totalR = 0;
$totalP = 0;
?>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Filter
            </div>
            <div class="panel-body">
                <div class="row">
                    <form role="form" method="POST" action="<?php echo Yii::app()->baseUrl?>/report/search4">
                        <!-- <div class="col-lg-12"> -->
                            <div class="form-group col-lg-3" >
                                <label>Start Date</label>
                                <input class="form-control calender" name="start_date" value="<?php echo @$_POST['start_date']?>" autocomplete="off" required>
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>
                            <div class="form-group col-lg-3">
                                <label>End Date</label>
                                <input class="form-control calender" name="end_date" value="<?php echo @$_POST['end_date']?>" autocomplete="off"  required>
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>

                            <div class="form-group col-lg-3">
                                <label>Payment Mode</label>
                                <select name="mode[]" id="mode" class="form-control select2" required multiple="">
                                    <option value="">Please select plot payment mode</option>
                                    <?php foreach(@$paymentmodes as $mode):?>
                                        <option value="<?php echo $mode->id?>" <?php echo (@in_array($mode->id,$_POST['mode']))?'selected':''?>><?php echo $mode->mode?></option>
                                    <?php endforeach;?>
                                    <!-- <option value="full_payment">Full Payment</option> -->
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
                <?php if(!empty($result)){?>
                    <?php foreach($result as $r){ ?>
                        <h3><?php echo $r['mode']?></h3>
                        <table width="100%" class="table table-striped table-bordered table-hover" id="report2table">
                            <thead>
                                <tr>
                                    <th>Transaction Type</th>
                                    <th>Total Records</th>
                                    <th>Total Plots</th>
                                    <th>Amount</th>
                                    <!-- <th>Action</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php $tt = 0; if(@$r['data']){foreach($r['data'] as $d):?>
                                    <tr>
                                        <td><?php echo @$d['transaction_type']?></td>
                                        <td><?php echo @$d['id']?></td>
                                        <?php $totalR = $totalR + $d['id']?>
                                        <td><?php echo @$d['plot_id']?></td>
                                        <?php $totalP = $totalP + $d['plot_id']?>
                                        <td><?php echo 'Rs. '.number_format(@$d['amount'])?></td>
                                        <?php $tt = $tt+$d['amount'];?>
                                    </tr>
                               <?php endforeach;}?>
                               <tr>
                                    <td colspan="3"><b>Total: </b></td>
                                    <td><b><?php echo 'Rs. '.number_format(@$tt)?></b></td>
                                    <?php $mainTotal = $mainTotal + $tt?>
                                </tr>
                            </tbody>
                        </table>
                    <?php }?>

                    <table width="100%" class="table table-striped table-bordered table-hover" id="report2table">
                        <thead>
                            <tr>
                                <th>&nbsp;</th>
                                <th>Total Records</th>
                                <th>Total Plots</th>
                                <th>Total Amount</th>
                                <!-- <th>Action</th> -->
                            </tr>
                        </thead>
                        <tbody>
                           <tr>
                                <td><b>Total: </b></td>
                                <td><b><?php echo number_format(@$totalR)?></b></td>
                                <td><b><?php echo number_format(@$totalP)?></b></td>
                                <td><b><?php echo 'Rs. '.number_format(@$mainTotal)?></b></td>
                            </tr>
                        </tbody>
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