<?php $userModel = Yii::app()->session->get('userModel');?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Payment Schedule</h1>
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
                All Payment Schedule
                <span class="pull-right"><a href="javascript:void(0)" id="report2btn"><span class="label label-success">Print</span></a></span>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <?php foreach($types as $type):?>
                                <th><?php echo $type->plot_type?></th>
                            <?php endforeach?>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php $paymentDetail = [];if($payments){ foreach($payments as $payment):?>
                            <?php 
                                foreach($payment->paymentSchedulePaymentModes as $pspD):

                                    $paymentDetail[$pspD->mode][strtolower($pspD->plot_type)] = $pspD->amount;

                                endforeach;
                                //echo '<pre>';print_r($paymentDetail);
                            ?>    
                       		<tr>
                                <td style="text-align: center;font-weight: bold;" colspan="<?php echo count($types)+1?>"><?php echo $payment->name?></td>
                                <td><a href="<?php echo Yii::app()->baseUrl?>/paymentschedule/edit/<?php echo $payment->id?>"><span class="aLink label label-info">Edit</span></a></td>
	                        </tr>
                            <?php foreach($this->paymentScheduleModes() as $modes):?>
                                <tr>
                                    <td><?php echo ucfirst($modes)?></td>
                                    <?php foreach($types as $type):?>
                                        <td><?php echo $paymentDetail[strtolower($modes)][strtolower($type->plot_type)]?></th>
                                    <?php endforeach?>
                                    <td>-</td>
                                </tr>
                            <?php endforeach;?>
                            <tr>
                                <td>Total</td>
                                <?php //foreach($this->paymentScheduleModes() as $modes):?>
                                <?php //endforeach;?>
                                <?php foreach($types as $o=>$type):?>
                                <td><?php echo $o?>-</td>
                                <?php endforeach;?>
                                <td></td>
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

<script type="text/javascript">
    $(document).on('click', '#report2btn', function (e) {
       var divToPrint=document.getElementById("tableBody");
       newWin= window.open("");
       var heading = '<div><h3>Kainat City<span style="margin-left:25%">Kainat City</span><span style="float:right">All Dealers</h3></div>';
       newWin.document.write('<style>table, th, td {border: 1px solid black;} .dnone{display:none}</style>'+heading+divToPrint.outerHTML);
       newWin.print();
       newWin.close();
    });

</script>