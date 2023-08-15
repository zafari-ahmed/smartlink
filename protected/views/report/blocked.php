<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Blocked Booking</h1>
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

    <?php if(@$cancelled){?>
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Blocked Booking Report
                <span class="pull-right"><a href="javascript:void(0)" id="report2btn"><span class="label label-success">Print</span></a></span>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body" id="tableBody">
                <table width="100%" class="table table-striped table-bordered table-hover" id="report2table" style="font-size: 12px">
                    <thead>
                        <tr>
                            <th>Booking ID</th>
                            <th>Customer Name</th>
                            <th>Customer Number</th>
                            <th>Block</th>
                            <th>Plot</th>
                            <th>Reason</th>
                            <th>Action</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(@$cancelled){ foreach($cancelled as $booking): ?>
                            <tr>
                                <td><a href="<?php echo Yii::app()->baseUrl?>/booking/viewbooking/<?php echo $booking->id?>"><?php echo $this->getBookingRegNo($booking->id)?></a></td>
                                <td><?php echo @$booking->customer->name?></td>
                                <td><?php echo @$booking->customer->mobile?></td>
                                <td><?php echo @$booking->plot->block_number?></td>
                                <td><?php echo @$booking->plot->plot_type.' - '.$booking->plot->plot_number?></td>
                                <td><?php echo @$booking->reason?></td>
                                <td><a href="<?php echo Yii::app()->baseUrl?>/booking/unblockbooking/<?php echo $booking->id?>"><span class="unblockBooking label label-info">Unblock</span></a></td>
                            </tr>
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
       var heading = '<div><h3>Kainat City<span style="margin-left:25%">Kainat City</span><span style="float:right">Cancelled Bookings</span></h3></div>';
       newWin.document.write('<style>table, th, td {border: 1px solid black;}</style>'+heading+divToPrint.outerHTML);
       newWin.print();
       newWin.close();
    });

</script>