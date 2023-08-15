<?php $userModel = Yii::app()->session->get('userModel');?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">View Plot Information </h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-success">
            <div class="panel-heading">
                <b style="text-transform: UPPERCASE;font-weight: bold;">View Plot Information (<?php echo $plot->block_number.' / '.$plot->plot_number?>)</b>               
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="col-lg-12">
                    <h3 style="text-transform: UPPERCASE;font-weight: bold;">Plot Information</h3>
                    <div class="form-group col-lg-3" style="padding-left: 0px;">
                        <label>Block #</label>
                        <p><?php echo $plot->block_number?></p>
                    </div>

                    <div class="form-group col-lg-3" >
                        <label>Plot #</label>
                        <p><?php echo $plot->plot_number?></p>
                    </div>
                    
                    <div class="form-group col-lg-3">
                        <label>Plot Category</label>
                        <p><?php echo $plot->category->name?></p>
                    </div>
                    <div class="form-group col-lg-3" style="padding-right: 0px;">
                        <label>Plot Size</label>
                        <p><?php echo $plot->size->size?></p>
                    </div>

                    
                    <div class="form-group col-lg-3" style="padding-left: 0px;">
                        <label>Road Facing</label>
                        <p><?php echo ($plot->is_road_facing==1)?'<span class="label label-success">YES</span>':'<span class="label label-danger">No</span>'?></p>
                    </div>
                    <div class="form-group col-lg-3">
                        <label>Corner</label>
                        <p><?php echo ($plot->is_corner==1)?'<span class="label label-success">YES</span>':'<span class="label label-danger">No</span>'?></p>
                    </div>
                    <div class="form-group col-lg-3">
                        <label>Park Facing</label>
                        <p><?php echo ($plot->is_park_facing==1)?'<span class="label label-success">YES</span>':'<span class="label label-danger">No</span>'?></p>
                    </div>
                    <div class="form-group col-lg-3" style="padding-right: 0px;">
                        <label>West Open</label>
                        <p><?php echo ($plot->is_west_open==1)?'<span class="label label-success">YES</span>':'<span class="label label-danger">No</span>'?></p>
                    </div>
                </div>

                <div class="col-lg-12">
                    <h3>Plot History</h3>
                    <table width="100%" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Reg No.</th>
                                <th>Customer Name</th>
                                <th>Customer Number</th>
                                <th>Customer CNIC</th>
                                <th>Type</th>
                                <th>Booking Date</th>
                                <th>Transferred Date</th>
                                <th>View</th>
                            </tr>
                        </thead>   
                        <tbody>
                            <?php if($booking){ foreach($booking as $book):?>

                                <?php $tBook = CustomerPlotTransfers::model()->find('plot_id=:pid AND new_customer_id=:cid',array(':pid'=>$book->plot_id,':cid'=>$book->customer->id));;?>
                                <tr>
                                    <td><?php echo $this->getBookingRegNo($book->id,true)?></td>
                                    <td><?php echo $book->customer->name?></td>
                                    <td><?php echo $book->customer->mobile?></td>
                                    <td><?php echo $book->customer->cnic?></td>
                                    <?php $sts = '-';switch($book->status){
                                        case '0':
                                            $sts = 'Cancelled';
                                            break;
                                        case '1':
                                            $sts = 'Active';
                                            break;
                                        case '3':
                                            $sts = 'Transffered';
                                            break;
                                    }?>
                                    <td><?php echo $sts?></td>
                                    <td><?php echo date('d M,Y',strtotime($book->createdOn))?></td>
                                    <td><?php echo ($tBook)?(date('d M,Y',strtotime($tBook->createdOn))):'N/A'?></td>
                                    <td>
                                        <a target="_target" href="<?php echo Yii::app()->baseUrl?>/booking/viewbooking/<?php echo @$book->id?>">
                                            <span class="aLink label label-info">View</span>
                                        </a>
                                    </td>
                                </tr>    
                            <?php endforeach;}?>
                            
                        </tbody>
                    </table>
                </div>

            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->