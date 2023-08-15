<?php $userModel = Yii::app()->session->get('userModel');?>
<?php $netTotal = ($this->plotTotal(@$booking->plot->id,false) - intval(@$booking->customerPlotTransactionSum))?>

<?php

// echo '<pre>';
// print_r($this->plotTotal(@$booking->plot->id,false));
// echo '<br/>';
// print_r(intval(@$booking->customerPlotTransactionSum));
// echo '<br/>';
// print_r(intval($this->plotDiscount(@$booking->plot->id,false)));
// exit;
$det = $this->getPlotLedgerDetail($booking->id);
?>
<div class="row">
    <div class="col-lg-12">
        
        <?php
            foreach(Yii::app()->user->getFlashes() as $key => $message) {
                echo '<div class="alert alert-'.$key.' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'.$message.'</div>';
            }
        ?>
        <h1 class="page-header">View Booking (<?php echo $this->getBookingRegNo($booking->id)?>)</h1><br/>
        <?php if($booking->status!=3){?>
        
            <table width="100%" class="table table-striped table-bordered table-hover">
                <thead style="color: #3c763d;background-color: #dff0d8;    text-transform: UPPERCASE;font-weight: bold;">
                    <th>Booking Dues Summary</th>
                    <th>Total Dues</th>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $det['html'];?></td>
                        <td><b><?php echo 'PKR '.number_format(@$det['amount'],2,'.',',');?></b></td>
                    </tr>
                </tbody>
            </table>

        <?php }?>
        <?php if(empty($booking->customerPlotCancelled) && $booking->status!=3){?>
            <span><a target="_blank" href="<?php echo Yii::app()->baseUrl?>/bookingpreview/duplicate/<?php echo $booking->id?>"><button class="btn btn-info btn-sm">Generate Booking Form</button></a></span>

            <?php if($userModel['user_type']['id'] == 1){?>
            <span><a target="_blank" href="<?php echo Yii::app()->baseUrl?>/booking/bookingtransferletter/<?php echo $booking->id?>"><button class="btn btn-info btn-sm">Generate Transfer Letter</button></a></span>
            <?php }?>
            <span><a target="_blank" href="<?php echo Yii::app()->baseUrl?>/plot/getpaymentscheduleorig/id/<?php echo $booking->plot->id?>/booking/<?php echo $booking->id?>"><button class="btn btn-warning btn-sm">Payment Schedule</button></a></span>

            <?php if($userModel['user_type']['id'] == 1){?>
                

                <span><a class="performTask" href="<?php echo Yii::app()->baseUrl?>/api/messages/type/booking/id/<?php echo $booking->id?>"><button type="button"  class="btn btn-primary btn-sm">Booking Message</button></a></span>


                <span><a href="javascript:void(0)"><button data-toggle="modal" data-target="#generateCert" type="button"  class="btn btn-info btn-sm">Generate Certificate</button></a></span>&nbsp;
                
             <?php } ?>

              <?php if($userModel['user_type']['id'] == 1){?>

                    <?php if($booking->flag_status==2){?>
                        <span><button type="button"  class="btn btn-success btn-sm">Received By Customer</button></span>&nbsp;
                    <?php } else if($booking->flag_status==1){?>
                        <span><a href="<?php echo Yii::app()->baseUrl?>/api/setbookingflag/view/1/flag/2/booking/<?php echo $booking->id?>"><button type="button"  class="flagLink btn btn-primary btn-sm">Rec By Customer?</button></a></span>&nbsp;
                    <?php } else{?>
                        <span><a href="<?php echo Yii::app()->baseUrl?>/api/setbookingflag/view/1/flag/1/booking/<?php echo $booking->id?>"><button type="button"  class="flagLink btn btn-danger btn-sm">File Complete?</button></a></span>&nbsp;
                    <?php } ?>
                    
                    

                    <span><a id="cancelBooking" href="<?php echo Yii::app()->baseUrl?>/booking/cancel/<?php echo $booking->id?>"><button type="button"  class="btn btn-danger btn-sm">Cancel Booking</button></a></span>

                    <span><a href="javascript:void(0)"><button data-toggle="modal" data-target="#bookingReason" type="button"  class="btn btn-info btn-sm">Block Booking</button></a></span>&nbsp;
            <?php } ?>
                    <?php if($userModel['user_type']['id'] == 1 || $userModel['user_type']['id']==5){?>
                    <span><a id="transferBooking" href="<?php echo Yii::app()->baseUrl?>/booking/transfer/<?php echo $booking->id?>"><button type="button"  class="btn btn-success btn-sm">Transfer Booking</button></a></span>
                    <?php }?>
            <?php } /*?>                       
                    <?php if($userModel['user_type']['id'] == 1 || $userModel['user_type']['id']==5){?>
                    <span><a id="transferBooking" href="<?php echo Yii::app()->baseUrl?>/booking/transferamount/id/<?php echo $booking->id?>/to/<?php echo $booking->id?>"><button type="button"  class="btn btn-success btn-sm">Transfer Transactions</button></a></span>
                    <?php }?>
                    <?php */?>
                    
                    <?php /*?>
                    <?php if($userModel['user_type']['id'] == 1){ ?>
                                        <span><a href="javascript:void()" id="reminderLetter" ><button type="button"  class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal">Reminder Letter <?php echo ($booking->reminderLettersCount > 0)?' ('.$booking->reminderLettersCount.')':''?></button></a></span>
                    <?php } else{ ?>
                        <span><a href="javascript:void()" ><button type="button"  class="btn btn-success btn-sm">Reminder Letter <?php echo ($booking->reminderLettersCount > 0)?' ('.$booking->reminderLettersCount.')':''?></button></a></span>
                    <?php }  ?>

                     <?php if($userModel['user_type']['id'] == 1 || $userModel['user_type']['id']==5){?>

                    <?php if($extra > 0){ ?>
                            <span><a href="<?php echo Yii::app()->baseUrl?>/booking/addplantransaction/<?php echo $booking->id?>" id="reminderLetter" ><button type="button"  class="btn btn-success btn-sm">Add Plot Plan Transaction</button></a></span>
                    <?php } ?>
                    <?php }?>

                     <?php if($userModel['user_type']['id'] == 1 || $userModel['user_type']['id']==5){?>

                    <span><a href="javascript:void()" id="developmentLetterSingle" ><button type="button"  class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModalLetter">Development Letter</button></a></span>
                    
                    <?php }?>

                <?php } else{?>
                    <span><a id="transferBooking" href="<?php echo Yii::app()->baseUrl?>/booking/transferamount/id/<?php echo $booking->id?>/to/<?php echo $booking->id?>"><button type="button"  class="btn btn-success btn-sm">Transfer Transactions</button></a></span>
                <?php }?>
            <?php //}?>
            <?php */?>
        <?php if($userModel['user_type']['id'] == 1 || $userModel['user_type']['id'] == 5 || $userModel['user_type']['id'] == 4 || $userModel['user_type']['id'] == 3){?>
            <?php if(empty($booking->customerPlotCancelled) && $booking->status!=3){?>  
                        <span class="pull-right" ><a href="<?php echo Yii::app()->baseUrl?>/booking/addtransaction/<?php echo $booking->id?>"><button type="button" class="btn btn-success btn-sm">Add Transaction</button></a></span>
                        <?php if($userModel['user_type']['id'] != 4){?>
                    &nbsp;&nbsp;<span class="pull-right" style="margin-right: 10px;">
                        <a href="<?php echo Yii::app()->baseUrl?>/booking/editbooking/<?php echo $booking->id?>"><button type="button" class="btn btn-primary btn-sm">Edit Booking</button></a>
                        &nbsp;&nbsp;
                        <a href="<?php echo Yii::app()->baseUrl?>/paymentschedule/customschedule/id/<?php echo $booking->id?>"><button type="button" class="btn btn-primary btn-sm">Custom Payment Schedule</button></a>
                    </span>&nbsp;&nbsp;
                    <?php if($userModel['user_type']['id'] == 1){?>
                    <span class="pull-right" style="margin-right: 10px;"><a href="<?php echo Yii::app()->baseUrl?>/plot/edit/<?php echo $booking->plot->id?>"><button type="button" class="btn btn-primary btn-sm">Edit Plot</button></a></span>
                        <?php } }?>
            <?php } else {  ?>
            <?php }   ?>
        <?php } else { ?>
            <?php if(empty($booking->customerPlotCancelled) && $booking->status!=3){?>   
                <?php if($booking->blocked !=1 && $userModel['user_type']['id'] != 4) {?>
                    <span class="pull-right" ><a href="<?php echo Yii::app()->baseUrl?>/booking/addtransaction/<?php echo $booking->id?>"><button type="button" class="btn btn-success btn-sm">Add Transaction</button></a></span>
                <?php }  ?>
            <?php }  ?>
        <?php }  ?>
        
        <?php //if($userModel['user_type']['id'] != 3){?>
        &nbsp;&nbsp;<span class="pull-right" style="margin-right: 10px;"><a target="_blank" href="<?php echo Yii::app()->baseUrl?>/booking/bookingledger/<?php echo $booking->id?>"><button type="button" class="btn btn-warning btn-sm">Booking Ledger</button></a></span>
        <?php /*?>
        <!-- &nbsp;&nbsp;<span class="pull-right" style="margin-right: 10px;"><a href="<?php //echo Yii::app()->baseUrl?>/booking/chargesledger/<?php //echo $booking->id?>"><button type="button" class="btn btn-warning btn-sm">Development Ledger</button></a></span> -->
        <?php */?>
    <br/><br/><br/>
    <?php
        foreach(Yii::app()->user->getFlashes() as $key => $message) {
            echo '<div class="alert alert-'.$key.' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>'.$message.'</b></div>';
        }
    ?>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<?php if(!empty($booking->customerPlotCancelled)){?>    
    <img src="<?php echo Yii::app()->baseUrl?>/images/cancelled.png" style="    position: absolute;z-index: 999;width: 50%;margin-left: 15%;margin-top: 5%;opacity: 0.1;">
<?php } ?>

<?php if($netTotal == 0){?>    
    <img src="<?php echo Yii::app()->baseUrl?>/images/completed.png" style="    position: absolute;z-index: 999;width: 80%;margin-left: 2%;margin-top: 5%;opacity: 0.1;">
<?php } ?>

<?php if($booking->blocked == 1 || ($booking->blocked == 2 && $booking->is_open==0)){?>    
    <img src="<?php echo Yii::app()->baseUrl?>/images/blocked.png" style="    position: absolute;z-index: 999;width: 80%;margin-left: 2%;margin-top: 5%;opacity: 0.1;">
<?php } ?>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-<?php echo ($booking->status==1)?'success':'danger'?>">
            <div class="panel-heading">
                <b style="text-transform: UPPERCASE;font-weight: bold;">View Booking (<?php echo $booking->plot->block_number.' / '.$booking->plot->plot_number?>)</b>
                <?php if(count($booking->customerPlotCancelled) > 1){?>
                    <a href="<?php echo Yii::app()->baseUrl?>/report/cancelled"><span class="pull-right"><b><span class="label label-danger">Cancelled</span></b></span></a>
                <?php } else{?>
                    
                    <?php if($booking->status==1){?>
                        <span class="pull-right"><b><a target="_blank" href="<?php echo Yii::app()->baseUrl.'/booking/plotdetail/id/'.$booking->plot->id?>"><span class="label label-info">View Plot Detail</span></a>&nbsp;<span class="label label-success">Booked</span></b></span>
                    <?php } else if($booking->status==3){?>
                        <span class="pull-right"><b><span class="label label-danger">Transferred</span></b></span>
                    <?php } else if($booking->status==0){?>
                        <span class="pull-right"><b><span class="label label-danger">Cancelled</span></b></span>
                    <?php } ?>
                    <?php if($booking->plot->plotSitePlans){?>
                        <span class="pull-right" ><b><a style="margin-left: -5%;" target="_blank" href="<?php echo Yii::app()->baseUrl?>/uploads/plot/site_plan/<?php echo @$booking->plot->plotSitePlans[0]->site_plan?>"><span class="label label-success">View Plot Site Plan</span></a></b></span>
                    <?php }?>
                    <?php //}?>
                    <!-- <span class="pull-right"><b><?php //echo ($booking->status==1)?'<a target="_blank" href="'.Yii::app()->baseUrl.'/booking/plotdetail/id/'.$booking->plot->id.'"><span class="label label-info">View Plot Detail</span></a>&nbsp;<span class="label label-success">Booked</span>':'<span class="label label-danger">Temporary Booked</span>'?></b></span> -->
                <?php }?>
                
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <?php //if($booking->agent_id){?>



                <div class="col-lg-12">
                    <?php if($booking->warningLetters){?>
                    <h3 style="text-transform: UPPERCASE;font-weight: bold;">Warning Letters</h3>                        
                    <div class="col-lg-12" style="padding-left: 0px;">
                        <table width="100%" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Reference #</th>
                                    <th>Letter Date</th>
                                    <th>Tracking ID</th>
                                    <th>Received By</th>
                                    <th>Received Date</th>
                                </tr>
                            </thead>   
                            <tbody>
                                <?php foreach($booking->warningLetters as $letter):?>
                                <tr style="background-color: lightgray;">
                                    <td><b><?php echo @$letter->reference_number?></b></td>
                                    <td><b><?php echo date('d M,Y',strtotime(@$letter->createdOn))?></b></td>
                                    <td><b><?php echo @$letter->tracking_id?></b></td>
                                    <td><b><?php echo @$letter->received_by?></b></td>
                                    <td><b><?php echo ($letter->received_on)?date('d M,Y',strtotime(@$letter->received_on)):''?></b></td>
                                    
                                </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                    <?php }?>
                </div>
                
                <?php //}?>
                <div class="col-lg-12">
                    <h3 style="text-transform: UPPERCASE;font-weight: bold;">Plot Information</h3>
                    <div class="form-group col-lg-2" style="padding-left: 0px;">
                        <label>Block #</label>
                        <p><?php echo $booking->plot->block_number?></p>
                    </div>

                    <div class="form-group col-lg-2" >
                        <label>Plot Type</label>
                        <p><?php echo $booking->plot->plot_type?></p>
                    </div>

                    <div class="form-group col-lg-2" >
                        <label>Plot #</label>
                        <p><?php echo $booking->plot->plot_number?></p>
                    </div>
                    
                    <div class="form-group col-lg-2">
                        <label>Plot Category</label>
                        <p><?php echo $booking->plot->category->name?></p>
                    </div>
                    <div class="form-group col-lg-2" style="padding-right: 0px;">
                        <label>Plot Size</label>
                        <p><?php echo $booking->plot->size->size?></p>
                    </div>
                </div>
                <div class="col-lg-12">
                    <?php $class = 'col-lg-2';?>
                    <div class="form-group <?php echo $class?>" style="padding-left: 0px;">
                        <label>Corner</label>
                        <p><?php echo ($booking->plot->is_corner==1)?'<span class="label label-success">YES</span>':'<span class="label label-danger">No</span>'?></p>
                    </div>
                    <div class="form-group <?php echo $class?>">
                        <label>Park Facing</label>
                        <p><?php echo ($booking->plot->is_park_facing==1)?'<span class="label label-success">YES</span>':'<span class="label label-danger">No</span>'?></p>
                    </div>
                    <div class="form-group <?php echo $class?>" style="padding-right: 0px;">
                        <label>West Open</label>
                        <p><?php echo ($booking->plot->is_west_open==1)?'<span class="label label-success">YES</span>':'<span class="label label-danger">No</span>'?></p>
                    </div>
                    <div class="form-group <?php echo $class?>" style="padding-left: 0px;">
                        <label>Extra Land</label>
                        <p><?php echo ($booking->plot->is_road_facing==1)?'<span class="label label-success">YES</span>':'<span class="label label-danger">No</span>'?></p>
                    </div>

                    <?php if($booking->is_special != '' && $booking->is_special != 0){?>
                        <div class="form-group <?php echo $class?>" style="padding-right: 0px;">
                            <label>Payment Schedule</label>
                            <?php if($booking->customerpaymentSchedule){?>
                                <p><span class="label label-info"> Custom Payment Schedule</span></p>
                            <?php } else{?>
                                <p><span class="label label-info"> <?php echo @$booking->special->name?></span></p>
                            <?php }?>
                        </div>
                    <?php }?>


                    <div class="col-lg-12" style="padding-left: 0px;">
                        <table width="100%" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Total Cost of Land</th>
                                    <th>Booking Date</th>
                                    <th>Installment Start Date</th>
                                    <th>Transfer Date</th>
                                    <?php if($booking->plot->discount!=0){?>
                                        <th>Discount Amount</th>
                                    <?php }?>
                                    
                                </tr>
                            </thead>   
                            <tbody>
                                <tr style="background-color: lightgray;">
                                    <td><b><?php echo 'Rs. '.number_format($booking->plot->total)?></b></td>
                                    <td><b><?php echo date('d M,Y',strtotime($booking->createdOn))?></b></td>
                                    <td><b><?php echo date('d M,Y',strtotime($booking->monthly_start_date))?></b></td>
                                    <?php if($booking->plot->customerPlotTransfersRecent){?>
                                    <td><b><?php echo date('F d, Y',strtotime($booking->plot->customerPlotTransfersRecent[0]->createdOn))?></b></td>
                                    <?php } else { ?>
                                        <td>N/A</td>
                                    <?php }?>
                                    <?php if($booking->plot->discount!=0){?>
                                        <td><b><?php echo 'Rs. '.number_format($booking->plot->discount)?></b></td>
                                    <?php }?>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    <?php if($booking->plot->is_road_facing == 1 || $booking->plot->is_park_facing == 1 || $booking->plot->is_corner == 1 || $booking->plot->is_west_open == 1){?>
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
                                    <?php if($booking->plot->discount!=0){?>
                                        <td>Discounted Total Cost of Land</td>
                                    <?php } else {?>
                                        <td>Total Cost of Land</td>
                                    <?php }?>
                                    <td><?php echo 'Rs. '.number_format($booking->plot->total-$booking->plot->discount)?></td>
                                </tr>
                                <?php if($booking->plot->is_road_facing == 1){?>
                                <tr>
                                    <td>Extra Land</td>
                                    <td><?php echo @$booking->plot->is_road_facing_amount?>% - <?php echo 'Rs. '.$this->Percentage($booking->plot->total,$booking->plot->is_road_facing_amount)?></td>
                                </tr>
                                <?php } ?>

                                <?php if($booking->plot->is_park_facing == 1){?>
                                <tr>
                                    <td>Park Facing</td>
                                    <td><?php echo @$booking->plot->is_park_facing_amount?>% - <?php echo 'Rs. '.$this->Percentage($booking->plot->total,$booking->plot->is_park_facing_amount)?></td>
                                </tr>
                                <?php } ?>

                                <?php if($booking->plot->is_corner == 1){?>
                                <tr>
                                    <td>Is Corner</td>
                                    <td><?php echo @$booking->plot->is_corner_amount?>% - <?php echo 'Rs. '.$this->Percentage($booking->plot->total,$booking->plot->is_corner_amount)?></td>
                                </tr>
                                <?php } ?>

                                <?php if($booking->plot->is_west_open == 1){?>
                                <tr>
                                    <td>West Open</td>
                                    <td><?php echo @$booking->plot->is_west_open_amount?>% - <?php echo 'Rs. '.$this->Percentage($booking->plot->total,$booking->plot->is_west_open_amount)?></td>
                                </tr>
                                <?php } ?>

                                
                               <tr style="background-color: lightgray;"><td><b>Total</b></td><td><b><?php echo 'Rs. '.$this->plotTotal($booking->plot->id);?></b></td></tr>
                            </tbody>
                        </table>
                    </div>
                    <?php }?>
                    <!-- <div class="form-group col-lg-6" style="padding-right: 0px;">
                        <label>West Open</label>
                        <p><?php //echo ($booking->plot->is_west_open==1)?'<span class="label label-success">YES</span>':'<span class="label label-danger">No</span>'?></p>
                    </div> -->
                </div>

                <div class="col-lg-12">
                    <h3 style="text-transform: UPPERCASE;font-weight: bold;">Customer Information</h3>
                    <div class="form-group col-lg-3" style="padding-left: 0px;">
                        <label>Name</label>
                        <p><?php echo $booking->customer->name?></p>
                    </div>
                    <div class="form-group col-lg-3">
                        <label><?php echo $booking->agent_name?></label>
                        <p><?php echo $booking->customer->father_husband_name?></p>
                    </div>
                    <div class="form-group col-lg-2">
                        <label>Occupation</label>
                        <p><?php echo $booking->customer->occupation?></p>
                    </div>
                    <div class="form-group col-lg-2">
                        <img style="width: 100%;" src="<?php echo Yii::app()->baseUrl?>/uploads/booking/<?php echo $booking->agent_cnic?>" alt="..." class="img-thumbnail">
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group col-lg-3" style="padding-left: 0px;">
                        <label>CNIC</label>
                        <p><?php echo $booking->customer->cnic?></p>
                    </div>
                    <div class="form-group col-lg-2" >
                        <label>Birth Date</label>
                        <p><?php echo date('d M,Y',strtotime(@$booking->customer->dob))?></p>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group col-lg-10" style="padding-left: 0px;">
                        <label>Address</label>
                        <p><?php echo $booking->customer->address?></p>
                    </div>
                </div>

                <div class="col-lg-12">
                    <h3 style="text-transform: UPPERCASE;font-weight: bold;">Customer Contact Information</h3>
                    <div class="form-group col-lg-4" style="padding-left: 0px;">
                        <label>Office #</label>
                        <p><?php echo $booking->customer->office?></p>
                    </div>
                    <div class="form-group col-lg-4">
                        <label>Res Phone #</label>
                        <p><?php echo $booking->customer->phone?></p>
                    </div>
                    <div class="form-group col-lg-4">
                        <label>Mobile #</label>
                        <p><?php echo $booking->customer->mobile?></p>
                    </div>

                    <h3 style="text-transform: UPPERCASE;font-weight: bold;">Customer Nominee's Information</h3>
                    <div class="form-group col-lg-4" style="padding-left: 0px;">
                        <label>Nominee's Name</label>
                        <p><?php echo $booking->customer->nominee_name?></p>
                    </div>
                    <div class="form-group col-lg-4">
                        <label>Nominee's CNIC</label>
                        <p><?php echo $booking->customer->nominee_cnic?></p>
                    </div>
                    <div class="form-group col-lg-4">
                        <label>Nominee's Relation</label>
                        <p><?php echo $booking->customer->nominee_relation?></p>
                    </div>
                </div>
                <div class="col-lg-12">
                    <?php if($booking->customerPlotDocuments){?>
                    <h3 style="text-transform: UPPERCASE;font-weight: bold;">Customer Document Information</h3>
                    <?php foreach($this->documentTypes() as $types):?>
                        <?php $fileType = strtolower(str_replace(' ','-',$types)); if($this->getDocument($booking->id,$fileType)){?>
                        <div class="form-group col-lg-3" >
                            <label>Scanned Image (<?php echo $types?>)</label>
                            <?php //if($fileType != 'nadra-verification-form') {?>
                                <a target="_blank" href="<?php echo Yii::app()->baseUrl.'/uploads/booking/'.$this->getDocument($booking->id,$fileType)?>"><img src="<?php echo Yii::app()->baseUrl.'/uploads/booking/'.$this->getDocument($booking->id,$fileType)?>" alt="..." class="img-thumbnail" style="width: 50%;"></a>
                            <?php /*} else{?> 
                                <a href="<?php echo Yii::app()->baseUrl.'/uploads/booking/'.$this->getDocument($booking->id,$fileType)?>" target="_blank">Nadra Verification Form</a>
                            <?php }*/ ?>
                        </div>
                    <?php } endforeach; }?>
                </div>

                
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->

    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <b style="text-transform: UPPERCASE;font-weight: bold;">View Land Transactions</b>
                <a href="<?php echo Yii::app()->baseUrl?>/booking/getmonths/id/<?php echo $booking->id?>"><span class="pull-right"><b><span class="label label-success">Add penalty</span></b></span></a>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <table width="100%" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Payment Mode</th>
                            <th>Transaction #</th>
                            <th>Transaction Type</th>
                            <th>Amount</th>
                            <th>Bank/Branch</th>
                            <th>Reference Number</th>
                            <th>Comment</th>
                            <th>Date</th>
                            <th>STATUS</th>
                            <th>Cr By</th>
                            <th>Up By</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php if($booking->customerPlotTransactions){ foreach($booking->customerPlotTransactions as $cpt):?>
                            <tr>
                                <td style="width: 20%;"><?php echo ucfirst(@$cpt->plotPaymentMode->mode.''.(($cpt->monthlyDate!='')?' ('.$cpt->monthlyDate.')':''))?>
                                    <br/>
                                    <?php if($cpt->plotPaymentMode->mode=='monthly'){?>
                                        <span style="font-size: 10px;"><?php echo $this->getPlotLedgerDetailSingle(@$booking->id,'monthly',false,$cpt->id)?></span>
                                    <?php } ?>
                                    <?php if($cpt->plotPaymentMode->mode=='yearly'){?>
                                        <span style="font-size: 10px;"><?php echo $this->getPlotLedgerDetailSingle(@$booking->id,'yearly',false,$cpt->id)?></span>
                                    <?php } ?>
                                </td>
                                <td><?php echo ($this->startsWith($cpt->transaction_number, '#'))?$cpt->transaction_number:'#'.ltrim($cpt->transaction_number,0)?></td>
                                <td><?php echo $cpt->transaction_type?></td>
                                <td><?php echo 'Rs. '.number_format($cpt->amount)?></td>
                                <td><?php echo ($cpt->bank != '')? $cpt->bank.' - '.$cpt->branch:'-'?></td>
                                <td><?php echo $cpt->reference_number?></td>
                                <td><?php echo $cpt->comment?></td>
                                <td><?php echo date('d M,Y',strtotime($cpt->createdOn))?></td>
                                <td><?php echo ($cpt->status==1)?'<span class="label label-success">Paid</span>':('<span class="label label-danger">Cancelled</span><br/>'.$cpt->reason)?><!-- &nbsp;<a href=""><span class="label label-info">Update</span></a> --></td>
                                <td><?php echo $cpt->createdBy?></td>
                                <td><?php echo $cpt->updatedBy?></td>
                                <td>
                                    <?php if($cpt->status==1){?>
                                    <a target="_blank" href="<?php echo Yii::app()->baseUrl?>/booking/dublicateinvoice/plot/<?php echo $booking->id?>/transaction/<?php echo str_replace('#', '', $cpt->transaction_number)?>"><span class="label label-success">Print</span></a>&nbsp;
                                    <?php } ?>
                                    <?php if(empty($booking->customerPlotCancelled)){?>
                                    <?php if($userModel['user_type']['id'] == 1 && $cpt->status==1){?>
                                    <a class="performTask" href="<?php echo Yii::app()->baseUrl?>/api/messages/type/transaction/id/<?php echo str_replace('#', '', $cpt->transaction_number)?>"><span title="<?php echo $this->getTransactionMessage(str_replace('#', '', $cpt->transaction_number))?>" class="label label-primary">Transaction Message</span></a>
                                    <?php }}?>
                                </td>
                            </tr>
                       <?php endforeach;}?>

                       <?php /*?>
                       <tr><td colspan="3"><b>Plot Total</b></td><td colspan="9"><b><?php echo 'Rs. '.$this->plotTotal($booking->plot->id);?>
                       <?php if($booking->plot->discount != 0){?>
                        <tr><td colspan="3"><b>Plot Discount</b> ( <?php echo $booking->plot->discount ?>)</td><td colspan="9"><b><?php echo 'Rs. '.$this->plotDiscount($booking->plot->id);?>
                        <?php }?>
                        
                        <tr><td colspan="3"><b>Extra Charges</b></td><td colspan="9"><b><?php echo 'Rs. '.number_format($this->plotExtra($booking->plot->id,false,true,true))?></b></td></tr>
                       <tr><td colspan="3"><b>Paid Total</b></td><td colspan="9"><b><?php echo 'Rs. '.number_format($booking->customerPlotTransactionSum)?></b></td></tr>
                       <?php $netTotal = $this->plotDiscount($booking->plot->id,false) - intval($booking->customerPlotTransactionSum)?>
                       <tr><td colspan="3"><b>Balance</b></td><td colspan="9"><b><?php echo 'Rs. '.number_format($netTotal)?></b></td></tr>

                       <tr><td colspan="3"><b>------</b></td><td colspan="9"><b>------</b></td></tr>
                       <?php */?>
                       <?php $plotTotalText = 0;?>
                       <tr><td colspan="3"><b>Total Cost of Land</b></td><td colspan="9"><b><?php echo 'Rs. '.number_format($booking->plot->total)?></b></td></tr>
                       <?php $plotTotalText = $booking->plot->total;?>
                       <?php if($booking->plot->discount > 0){?>
                       <tr><td colspan="3"><b>Discount</b></td><td colspan="9"><b><?php echo 'Rs. '.number_format($booking->plot->discount)?></b></td></tr>
                       <tr><td colspan="3"><b>Discounted Total Cost of Land</b></td><td colspan="9"><b><?php echo 'Rs. '.number_format($booking->plot->total-$booking->plot->discount)?></b></td></tr>
                       <?php $plotTotalText = $booking->plot->total-$booking->plot->discount;?>
                        <?php }?>

                       <tr><td colspan="3"><b>Extra Charges</b></td><td colspan="9"><b><?php echo 'Rs. '.number_format($this->plotExtra($booking->plot->id,false,true,true))?></b></td></tr>
                       <?php $plotTotalText = $plotTotalText + $this->plotExtra($booking->plot->id,false,true,true);?>
                       <tr><td colspan="3"><b>Plot Total</b></td><td colspan="9"><b><?php echo 'Rs. '.number_format($plotTotalText)?></b></td></tr>
                       <?php if($booking->status==3){?>
                        <tr><td colspan="3"><b>Paid Total</b></td><td colspan="9"><b><?php echo 'Rs. '.number_format($booking->customerPlotTransactionSumTransfer)?></b></td></tr>
                        <tr><td colspan="3"><b>Balance</b></td><td colspan="9"><b><?php echo 'Rs. '.number_format($plotTotalText-$booking->customerPlotTransactionSumTransfer)?></b></td></tr>
                       <?php } else {?>
                        <tr><td colspan="3"><b>Paid Total</b></td><td colspan="9"><b><?php echo 'Rs. '.number_format($booking->customerPlotTransactionSum)?></b></td></tr>
                        <tr><td colspan="3"><b>Balance</b></td><td colspan="9"><b><?php echo 'Rs. '.number_format($plotTotalText-$booking->customerPlotTransactionSum)?></b></td></tr>
                       <?php }?>
                       
                       
                    </tbody>
                </table>

                
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>

    <?php if($booking->customerPlotPlanTransactionsAll){?>
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <b style="text-transform: UPPERCASE;font-weight: bold;">View Other Charges</b>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <table width="100%" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Payment Mode</th>
                            <th>Transaction #</th>
                            <th>Transaction Type</th>
                            <th>Amount</th>
                            <th>Bank/Branch</th>
                            <th>Reference Number</th>
                            <th>Comment</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Cr By</th>
                            <th>Up By</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php $dTotal = 0;   if($booking->customerPlotPlanTransactionsAll){ foreach($booking->customerPlotPlanTransactionsAll as $cpt):?>
                            <tr>
                                <td><?php echo ucfirst(@$cpt->plot_payment_mode)?></td>
                                <td><?php echo ($this->startsWith($cpt->transaction_number, '#'))?$cpt->transaction_number:'#'.ltrim($cpt->transaction_number,0)?></td>
                                <td><?php echo $cpt->transaction_type?></td>
                                <td><?php echo 'Rs. '.number_format($cpt->amount)?></td>
                                <?php $dTotal = $dTotal + $cpt->amount;?>
                                <td><?php echo ($cpt->bank != '')? $cpt->bank.' - '.$cpt->branch:'-'?></td>
                                <td><?php echo $cpt->reference_number?></td>
                                <td><?php echo $cpt->comment?></td>
                                <td><?php echo date('d M,Y',strtotime($cpt->createdOn))?></td>
                                <td><?php echo ($cpt->status==1)?'<span class="label label-success">Paid</span>':('<span class="label label-danger">Cancelled</span><br/>'.$cpt->monthlyDate)?><!-- &nbsp;<a href=""><span class="label label-info">Update</span></a> --></td>
                                <td><?php echo $cpt->createdBy?></td>
                                <td><?php echo $cpt->updatedBy?></td>
                                <td>
                                    <?php if($cpt->status==1){?>
                                    <!-- <a target="_blank" href="<?php echo Yii::app()->baseUrl?>/booking/dublicateextrainvoice/type/development/plot/<?php echo $booking->id?>/transaction/<?php echo str_replace('#', '', $cpt->transaction_number)?>"><span class="label label-success">Print</span></a> -->
                                    <a target="_blank" href="<?php echo Yii::app()->baseUrl?>/booking/dublicateinvoice/plot/<?php echo $booking->id?>/transaction/<?php echo str_replace('#', '', ltrim($cpt->transaction_number,0))?>"><span class="label label-success">Print</span></a>&nbsp;
                                    <?php }?>
                                    <?php if(empty($booking->customerPlotCancelled)){?>
                                    <?php if($userModel['user_type']['id'] == 1 && $cpt->status==1){?>
                                    <a class="performTask" href="<?php echo Yii::app()->baseUrl?>/api/messages/type/other/id/<?php echo str_replace('#', '', $cpt->transaction_number)?>"><span title="<?php echo $this->getTransactionMessage(str_replace('#', '', $cpt->transaction_number),'other')?>" class="label label-primary">Transaction Message</span></a>
                                    <?php }}?>
                                </td>

                            </tr>
                       <?php endforeach;}?>
                        
                        <tr><td colspan="3"><b>Paid Total</b></td><td colspan="9"><b><?php echo 'Rs. '.number_format($dTotal)?></b></td></tr>
                    </tbody>
                </table>

                
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <?php }?>


    <div class="col-lg-12 hide">
        <div class="panel panel-default">
            <div class="panel-heading">
                <b style="text-transform: UPPERCASE;font-weight: bold;">View Penalty Charges</b>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <table width="100%" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Payment Mode</th>
                            <th>Transaction #</th>
                            <th>Transaction Type</th>
                            <th>Amount</th>
                            <th>Bank/Branch</th>
                            <th>Reference Number</th>
                            <th>Comment</th>
                            <th>Date</th>
                            <th>Inst. Month</th>
                            <th>Cr By</th>
                            <th>Up By</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php $dTotal = 0;   if($booking->customerPlotPlanTransactionsPenalty){ foreach($booking->customerPlotPlanTransactionsPenalty as $cpt):?>
                            <tr>
                                <td><?php echo ucfirst(@$cpt->plot_payment_mode)?></td>
                                <td><?php echo ($this->startsWith($cpt->transaction_number, '#'))?$cpt->transaction_number:'#'.$cpt->transaction_number?></td>
                                <td><?php echo $cpt->transaction_type?></td>
                                <td><?php echo 'Rs. '.number_format($cpt->amount)?></td>
                                <?php $dTotal = $dTotal + $cpt->amount;?>
                                <td><?php echo ($cpt->bank != '')? $cpt->bank.' - '.$cpt->branch:'-'?></td>
                                <td><?php echo $cpt->reference_number?></td>
                                <td><?php echo $cpt->comment?></td>
                                <td><?php echo date('d M,Y',strtotime($cpt->createdOn))?></td>
                                <td><?php echo ($cpt->monthlyDate)?></td>
                                <td><?php echo $cpt->createdBy?></td>
                                <td><?php echo $cpt->updatedBy?></td>
                                <td><a target="_blank" href="<?php echo Yii::app()->baseUrl?>/booking/dublicateextrainvoice/type/penalty/plot/<?php echo $booking->id?>/transaction/<?php echo str_replace('#', '', $cpt->transaction_number)?>"><span class="label label-success">Print</span></a></td>
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
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <b style="text-transform: UPPERCASE;font-weight: bold;">Dealer Information</b>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <!--<h3 style="text-transform: UPPERCASE;font-weight: bold;">Dealer Information</h3>-->
                <div class="form-group col-lg-3" style="padding-left: 0px;">
                    <label>Dealer Name</label>
                    <p><?php echo @$booking->agent->agentParent->name?></p>
                </div>
                <div class="form-group col-lg-3" style="padding-left: 0px;">
                    <label>Sub Dealer Name</label>
                    <p><?php echo @$booking->agent->name?></p>
                </div>
                <?php if($userModel['user_type']['id'] == 1){?>
                <div class="form-group col-lg-3" style="padding-left: 0px;">
                    <label>Agent Commission</label>
                    <p><?php echo 'PKR '.number_format(@$booking->agent_percentage).'/='?></p>
                </div>
                <?php }?>
                <div class="form-group col-lg-3">
                    <a href="<?php echo Yii::app()->baseUrl?>/expenses/add?booking_id=<?php echo @$booking->id?>"><button type="button" class="btn btn-success btn-sm">Add Commision</button></a>
                </div>
                <?php if($booking->agent_id && $expenses){?>
                <div class="col-lg-12" style="padding-left: 0px;">
                    <table width="100%" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Expense Ref No.</th>
                                <th>Paid Amount</th>
                                <th>Payment Mode</th>
                                <th>Bank</th>
                                <th>Reference Number</th>
                                <th>Transaction Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>   
                        <tbody>
                            <?php foreach($expenses as $expense):?>
                            <tr style="background-color: lightgray;">
                                <td><?php echo $this->getExpenseRegNo($expense->id,'expense')?></td>
                                <td><b><?php echo 'Rs. '.number_format($expense->amount)?></b></td>
                                <td><b><?php echo $expense->payment_mode?></b></td>
                                <td><b><?php echo $expense->bank?></b></td>
                                <td><b><?php echo $expense->number?></b></td>
                                <td><b><?php echo date('d M,Y',strtotime($expense->createdOn))?></b></td>
                                <td>
                                    <a target="_blank" href="<?php echo Yii::app()->baseUrl?>/expenses/expenseinvoice/<?php echo $expense->id?>">
                                        <span class="label label-success">Print</span>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
                <?php }?>
            </div>
        </div>
        </div>
</div>




<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Reminder Letter</h4>
      </div>
      <form role="form" method="POST" action="<?php echo Yii::app()->baseUrl?>/letter/reminder">
      <div class="modal-body">
        <div class="row">
            <!-- <div class="col-lg-12"> -->
                <div class="form-group col-lg-4" >
                    <label>Amount</label>
                    <input type="number" class="form-control" name="amount" id="name" placeholder="Amount" required="">
                    <input type="hidden" name="booking_id" value="<?php echo $booking->id?>">
                </div>
                <div class="form-group col-lg-4" >
                    <label>Penalty</label>
                    <input type="number" class="form-control" name="penalty" id="Penalty" placeholder="Penalty">
                </div>
                <div class="form-group col-lg-4" >
                    <label>Days</label>
                    <input type="number" class="form-control" name="days" id="days" placeholder="Days" required="">
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <label>Reminder</label>
                        <label class="checkbox-inline">
                            <input type="radio" name="reminder" required value="1" checked>First
                        </label>
                        <label class="checkbox-inline">
                            <input type="radio" name="reminder"  required value="2">Second
                        </label>
                        <label class="checkbox-inline">
                            <input type="radio" name="reminder"  required value="3">Third
                        </label>
                        
                    </div>
                </div>
            
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success">Submit</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>

  </div>
</div>

<!-- Modal -->
<div id="myModalLetter" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Development Letter</h4>
      </div>
      <form role="form" target="_blank" method="POST" action="<?php echo Yii::app()->baseUrl?>/letter/developmentsingle">
      <div class="modal-body">
        <div class="row">
            <!-- <div class="col-lg-12"> -->
                <div class="form-group col-lg-6" >
                    <label>Amount</label>
                    <input type="number" class="form-control" name="amount" id="name" placeholder="Amount" required="">
                    <input type="hidden" name="booking_id" value="<?php echo $booking->id?>">
                </div>
            
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success" >Submit</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>

  </div>
</div>


<!-- Generate Modal -->
<div id="generateCert" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Generate Certificate</h4>
      </div>
      <form role="form" target="_blank" method="POST" action="<?php echo Yii::app()->baseUrl?>/certificate/generate">
      <div class="modal-body">
        <div class="row">
            <!-- <div class="col-lg-12"> -->
                <div class="form-group col-lg-6" >
                    <label>Certificate</label>
                    <select class="form-control" name="certificate">
                            <option value="confirm">Confirmation Letter</option>
                            <option value="allo-let">Allocation Letter</option>
                            <option value="confirm-2">Confirmation Letter 2</option>
                            <option value="confirm-2-back">Confirmation Letter t&c</option>
                            <option value="allo-let-2">Allocation Letter 2</option>
                            <option value="allo-let-2-back">Allocation Letter t&c</option>
                            <option value="allo-cer">Allocation Certificate</option>
                            <option value="poss">Possession Order</option>
                    </select>
                    <input type="hidden" name="booking_id" value="<?php echo $booking->id?>">
                </div>

                <div class="form-group col-lg-12" >
                    <label>Duplicate</label>
                    <input name="duplicate"  value="1" type="checkbox">
                </div>
            
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success" >Submit</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>

  </div>
</div>


<!-- Booking Reason Modal -->
<div id="bookingReason" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Block Booking</h4>
      </div>
      <form role="form" method="POST" action="<?php echo Yii::app()->baseUrl?>/booking/saveBlocked">
      <div class="modal-body">
        <div class="row">
            <!-- <div class="col-lg-12"> -->
            <div class="form-group col-lg-12" >
                <label>Reason</label>
                <textarea class="form-control" rows="3" name="reason" placeholder="Reason" required></textarea>
                <input type="hidden" name="booking_id" value="<?php echo $booking->id?>">
            </div>            
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success" >Submit</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>

  </div>
</div>