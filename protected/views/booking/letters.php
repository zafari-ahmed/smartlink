<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Reminder Letters</h1>
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

    <?php if(@$plots){?>
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Reminder Letters Report
                <span class="pull-right"><a href="javascript:void(0)" id="report2btn"><span class="label label-success">Print</span></a></span>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body" id="tableBody">
                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables" style="font-size: 12px">
                    <thead>
                        <tr>
                            <th>Booking ID</th>
                            <th>Amount</th>
                            <th>Days</th>
                            <th>Reminder Letters</th>
                            <th>Date</th>
                            <th></th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(@$plots){ foreach($plots as $plot): //if($plot->reminderLettersCount > 0) {?>
                            <tr>
                                <td><a href="<?php echo Yii::app()->baseUrl?>/booking/viewbooking/<?php echo $plot->booking->id?>"><?php echo @'ARC-'.$plot->booking->plot->block_number.'-'.$plot->booking->plot->plot_number?></a></td>
                                <td><?php echo @$plot->amount?></td>
                                <td><?php echo @$plot->days?></td>
                                <td><?php echo @$plot->reminder?></td>
                                <td><?php echo date('d M,o',strtotime(@$plot->createdOn))?></td>
                                <td><a href="javascript:void(0)" data-rel="<?php echo $plot->id?>" class="deleteLetter"><span class="aLink label label-danger">Delete</span></a></td>
                                <!-- <td><?php //echo ($data->status==0)?'<span class="label label-danger">Pending</span>':'<span class="label label-success">Paid</span>'?></td> -->
                            </tr>
                       <?php  endforeach;}?>
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
       var heading = '<div><h3>Kainat City<span style="margin-left:25%">Kainat City</span><span style="float:right">Reminder Letters</span></h3></div>';
       newWin.document.write('<style>table, th, td {border: 1px solid black;}.dataTables_length, .dataTables_filter, .dataTables_info, .dataTables_paginate{display:none}</style>'+heading+divToPrint.outerHTML);
       newWin.print();
       newWin.close();
    });

</script>