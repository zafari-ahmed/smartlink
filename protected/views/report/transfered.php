<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Transfered Booking</h1>
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

    <?php if(@$transfered){?>
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Transfered Report
                <span class="pull-right"><a href="javascript:void(0)" id="report2btn"><span class="label label-success">Print</span></a></span>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body" id="tableBody">
                <table width="100%" class="table table-striped table-bordered table-hover" id="report2table" style="font-size: 12px">
                    <thead>
                        <tr>
                            <th>Booking ID</th>
                            <th>Old Customer Name</th>
                            <th>New Customer Name</th>
                            <th>Customer Number</th>
                            <th>Block #</th>
                            <th>Plot #</th>
                            <!-- <th>Transfered Amount</th> -->
                            <!-- <th>Deduct Amount</th> -->
                            <th>Transfered Date</th>
                            <th>Transfered Certificate</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(@$transfered){ foreach($transfered as $data): ?>
                            <tr>
                                <td><?php echo @$data->plot_id?></td>
                                <td><?php echo @$data->oldCustomer->name?></td>
                                <td><?php echo @$data->newCustomer->name?></td>
                                <td><?php echo @$data->newCustomer->mobile?></td>
                                <td><?php echo @$data->booking->block_number?></td>
                                <td><?php echo @$data->booking->plot_number?></td>
                                <td><?php echo date('d M,Y',strtotime(@$data->createdOn))?></td>
                                <td><a target="_blank" href="<?php echo Yii::app()->baseUrl?>/letter/Transferedletter/id/<?php echo $data->id?>"><span class="aLink label label-success">Certificate</span></a></td>
                       <?php endforeach;}?>
                    </tbody>
                </table>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <?php }?>
    <!-- /.col-lg-12 -->
</div>

<script type="text/javascript">
    $(document).on('click', '#report2btn', function (e) {
       var divToPrint=document.getElementById("tableBody");
       newWin= window.open("");
       var heading = '<div><h3>Kainat City<span style="margin-left:25%">Kainat City</span><span style="float:right">Transfered Bookings</span></h3></div>';
       newWin.document.write('<style>table, th, td {border: 1px solid black;}</style>'+heading+divToPrint.outerHTML);
       newWin.print();
       newWin.close();
    });

</script>