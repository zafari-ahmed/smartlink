<?php $userModel = Yii::app()->session->get('userModel');?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">View Plot
            <?php if($plot->customerPlotsCount > 0){?>
                <?php if($userModel['user_type']['id'] == 1 || $userModel['user_type']['id'] == 4){?>
                        <span class="pull-right"><a href="<?php echo Yii::app()->baseUrl?>/booking/addtransaction/<?php echo $plot->customerPlots[0]->id?>"><button type="button" class="btn btn-success btn-sm">Add Transaction</button></a></span>&nbsp;<span class="pull-right" style="margin-right: 10px;"><a href="<?php echo Yii::app()->baseUrl?>/plot/edit/<?php echo $plot->id?>"><button type="button" class="btn btn-primary btn-sm">Edit Plot</button></a></span>
                <?php }?>
            <?php } else{ ?>
            <span class="pull-right"><a href="<?php echo Yii::app()->baseUrl?>/booking/add/id/<?php echo $plot->id?>"><button type="button" class="btn btn-success btn-sm">Add Booking</button></a></span>
            <?php } ?>
        </h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-<?php echo ($plot->customerPlotsCount > 0)?'danger':'success'?>">
            <div class="panel-heading">
                <b>View Plot (<?php echo $plot->block_number.' / '.$plot->plot_number?>)</b>
                <span class="pull-right"><b><?php echo ($plot->customerPlotsCount > 0)?'<span class="label label-danger">Booked</span>':'<span class="label label-success">Available</span>'?></b></span>
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


                    <div class="col-lg-12" style="padding-left: 0px;">
                        <!-- <div class="form-group col-lg-6" style="padding-left: 0px;">
                            <label>Total Amount</label>
                            <p><b><?php //echo 'Rs. '.number_format($booking->plot->total)?></b></p>
                        </div>
                        <div class="form-group col-lg-6" style="padding-left: 0px;">
                            <label>Booking Date</label>
                            <p><b><?php //echo date('d M,Y',strtotime($booking->createdOn))?></b></p>
                        </div>  -->
                        <table width="100%" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Total Amount</th>
                                    <th>Booking Date</th>
                                </tr>
                            </thead>   
                            <tbody>
                                <tr style="background-color: lightgray;">
                                    <td><b><?php echo 'Rs. '.number_format($plot->total)?></b></td>
                                    <td><b><?php echo ($plot->customerPlots)?(date('d M,Y',strtotime(@$plot->customerPlots[0]->createdOn))):''?></b></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <?php if($plot->is_road_facing == 1 || $plot->is_park_facing == 1 || $plot->is_corner == 1 || $plot->is_west_open == 1){?>
                    <div class="col-lg-12" style="padding-left: 0px;">
                        <table width="100%" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Extra</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Plot Total</td>
                                    <td><?php echo 'Rs. '.number_format($plot->total)?></td>
                                </tr>
                                <?php if($plot->is_road_facing == 1){?>
                                <tr>
                                    <td>Road Facing</td>
                                    <td><?php echo @$plot->is_road_facing_amount?>% - <?php echo 'Rs. '.$this->Percentage($plot->total,$plot->is_road_facing_amount)?></td>
                                </tr>
                                <?php } ?>

                                <?php if($plot->is_park_facing == 1){?>
                                <tr>
                                    <td>Park Facing</td>
                                    <td><?php echo @$plot->is_park_facing_amount?>% - <?php echo 'Rs. '.$this->Percentage($plot->total,$plot->is_park_facing_amount)?></td>
                                </tr>
                                <?php } ?>

                                <?php if($plot->is_corner == 1){?>
                                <tr>
                                    <td>Is Corner</td>
                                    <td><?php echo @$plot->is_corner_amount?>% - <?php echo 'Rs. '.$this->Percentage($plot->total,$plot->is_corner_amount)?></td>
                                </tr>
                                <?php } ?>

                                <?php if($plot->is_west_open == 1){?>
                                <tr>
                                    <td>West Open</td>
                                    <td><?php echo @$plot->is_west_open_amount?>% - <?php echo 'Rs. '.$this->Percentage($plot->total,$plot->is_west_open_amount)?></td>
                                </tr>
                                <?php } ?>

                                
                               <tr style="background-color: lightgray;"><td><b>Total</b></td><td><b><?php echo 'Rs. '.$this->plotTotal($plot->id);?></b></td></tr>
                            </tbody>
                        </table>
                    </div>
                    <?php }?>
                </div>


                <?php if($plot->customerPlots){?>
                <div class="col-lg-12">
                    <h3 style="text-transform: UPPERCASE;font-weight: bold;">Customer Information</h3>
                    <div class="form-group col-lg-3" style="padding-left: 0px;">
                        <label>Name</label>
                        <p><?php echo @$plot->customerPlots[0]->customer->name?></p>
                    </div>
                    <div class="form-group col-lg-3">
                        <label>Father/Husband Name</label>
                        <p><?php echo @$plot->customerPlots[0]->customer->father_husband_name?></p>
                    </div>
                    <div class="form-group col-lg-3">
                        <label>Occupation</label>
                        <p><?php echo @$plot->customerPlots[0]->customer->occupation?></p>
                    </div>

                    <div class="form-group col-lg-3" >
                        <label>CNIC</label>
                        <p><?php echo @$plot->customerPlots[0]->customer->cnic?></p>
                    </div>
                    <div class="form-group col-lg-2" style="padding-left: 0px;">
                        <label>Birth Date</label>
                        <p><?php echo @$plot->customerPlots[0]->customer->dob?></p>
                    </div>
                    
                    <div class="form-group col-lg-10" style="padding-left: 0px;">
                        <label>Address</label>
                        <p><?php echo @$plot->customerPlots[0]->customer->address?></p>
                    </div>

                    
                </div>
                <div class="col-lg-12">
                    <h3 style="text-transform: UPPERCASE;font-weight: bold;">Customer Contact Information</h3>
                    <div class="form-group col-lg-4" style="padding-left: 0px;">
                        <label>Office #</label>
                        <p><?php echo @$plot->customerPlots[0]->customer->office?></p>
                    </div>
                    <div class="form-group col-lg-4">
                        <label>Res Phone #</label>
                        <p><?php echo @$plot->customerPlots[0]->customer->phone?></p>
                    </div>
                    <div class="form-group col-lg-4">
                        <label>Mobile #</label>
                        <p><?php echo @$plot->customerPlots[0]->customer->mobile?></p>
                    </div>

                    <h3 style="text-transform: UPPERCASE;font-weight: bold;">Customer Nominee's Information</h3>
                    <div class="form-group col-lg-4" style="padding-left: 0px;">
                        <label>Nominee's Name</label>
                        <p><?php echo @$plot->customerPlots[0]->customer->nominee_name?></p>
                    </div>
                    <div class="form-group col-lg-4">
                        <label>Nominee's CNIC</label>
                        <p><?php echo @$plot->customerPlots[0]->customer->nominee_cnic?></p>
                    </div>
                    <div class="form-group col-lg-4">
                        <label>Nominee's Relation</label>
                        <p><?php echo @$plot->customerPlots[0]->customer->nominee_relation?></p>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <b>Transactions</b>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables">
                                <thead>
                                    <tr>
                                        <th>Payment Mode</th>
                                        <th>Transaction #</th>
                                        <th>Amount</th>
                                        <th>Transaction Type</th>
                                        <th>Bank/Brnach</th>
                                        <th>Comment</th>
                                        <th>Date</th>
                                        <th>STATUS</th>
                                        <th>Created By</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   <?php if($plot->customerPlots[0]->customerPlotTransactions){ foreach($plot->customerPlots[0]->customerPlotTransactions as $cpt):?>
                                        <tr>
                                            <td><?php echo @$cpt->plotPaymentMode->mode?></td>
                                            <td><?php echo ($this->startsWith($cpt->transaction_number, '#'))?$cpt->transaction_number:'#'.$cpt->transaction_number?></td>
                                            <td><?php echo 'Rs. '.number_format($cpt->amount)?></td>
                                            <td><?php echo $cpt->transaction_type?></td>
                                            <td><?php echo ($cpt->bank != '')?$cpt->bank.' - '.$cpt->branch.' - ':'-'?></td>
                                            <td><?php echo $cpt->comment?></td>
                                            <td><?php echo date('d M,Y',strtotime($cpt->createdOn))?></td>
                                            <td><?php echo ($cpt->status==1)?'<span class="label label-success">Paid</span>':'<span class="label label-danger">Pending</span>'?></td>
                                            <td><?php echo $cpt->createdBy?></td>
                                        </tr>
                                   <?php endforeach;}?>
                                   <tr><td colspan="3"><b>Plot Total</b></td><td colspan="6"><b><?php echo 'Rs. '.$this->plotTotal($plot->id);?>
                                   <tr><td colspan="3"><b>Paid Total</b></td><td colspan="6"><b><?php echo 'Rs. '.number_format($plot->customerPlots[0]->customerPlotTransactionSum)?></b></td></tr>
                                   <?php $netTotal = $this->plotTotal($plot->id,false) - intval($plot->customerPlots[0]->customerPlotTransactionSum)?>
                                   <tr><td colspan="3"><b>Remaing Dues</b></td><td colspan="6"><b><?php echo 'Rs. '.number_format($netTotal)?></b></td></tr>
                                </tbody>
                            </table>

                            
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <?php }?>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>