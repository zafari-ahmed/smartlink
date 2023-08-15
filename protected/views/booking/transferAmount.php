<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Transfer Booking Transactions</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Transfer Booking Transactions
            </div>
            <div class="panel-body">
                <div class="row">
                    <form role="form" method="POST" action="<?php echo Yii::app()->baseUrl?>/booking/transferamountsubmit">
                        <div class="col-lg-12">
                            
                            <div class="form-group col-lg-6" >
                                <label>Source Booking</label>
                                <select name="source_id" id="plot_number" class="form-control select2">
                                    <option value="<?php echo $booking->id?>" <?php echo ($booking->id == $id)?'selected':'' ?>><?php echo $booking->plot->block_number.' / '.$booking->plot->plot_number?></option>
                                </select>
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>

                            <div class="form-group col-lg-6" >
                                <label>Destination Booking</label>
                                <select name="destination_id" id="plot_number" class="form-control">
                                    <?php foreach($bookings as $bookingss):?>
                                        <option value="<?php echo $bookingss->id?>" <?php echo ($bookingss->id == $to)?'selected':'' ?>><?php echo $bookingss->plot->block_number.' / '.$bookingss->plot->plot_number?></option>
                                    <?php endforeach;?>
                                </select>
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>
                        </div>
                            <div class="form-group col-lg-6" >
                                <label>Total Plot Amount</label>
                                <input class="form-control" id="total_plot_amount"  value="<?php echo $this->plotTotal($booking->plot->id,false)?>" required="">
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Total Plot Paid Amounts</label>
                                <input class="form-control" id="paid_amount"  required="" value="<?php echo $booking->customerPlotTransactionSum?>">
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>


                            <!-- <div class="form-group col-lg-4">
                                <label>Cancel Percentage (%)</label>
                                <input class="form-control" id="cancel_percentage"  value="<?php echo @$perc?>" required="">
                            </div> -->

                            
                            
                            <div class="form-group col-lg-12">
                                <label>Cancel Date</label>
                                <input class="form-control calender" name="cancel_date" required="" value="<?php echo date('Y-m-d')?>">
                            </div>

                            <!-- <div class="form-group col-lg-6">
                                <label>Deduction Total</label>
                                
                                <input class="form-control" id="almiraj_dib"  required="" value="<?php echo @number_format(@$plotBookingSum - (@$almirajPercentage + $remainingAmount))?>">
                                
                            </div>-->

                            <input type="hidden" name="booking_id" id="booking_id" value="<?php echo @$booking->id?>"/>
                            <!-- <input type="hidden" name="account_id[]" value="1"/>
                            <input type="hidden" name="account_id[]" value="3"/>
                            <input type="hidden" name="amount[]" value="<?php echo @$almirajPercentage?>"/>
                            <input type="hidden" name="amount[]" value="<?php echo @$remainingAmount?>"/> -->


                            <div class="form-group col-lg-6">
                                <h2>Source Booking Transaction</h2>
                                <table width="100%" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Payment Mode</th>
                                            <th>Transaction #</th>
                                            <th>Amount</th>
                                            <th>Date</th>
                                            <td></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php if($booking->customerPlotTransactions){ foreach($booking->customerPlotTransactions as $cpt):?>
                                            <tr id="parentTr_<?php echo $cpt->id?>">
                                                <td><?php echo @$cpt->plotPaymentMode->mode.''.(($cpt->monthlyDate!='')?' ('.$cpt->monthlyDate.')':'')?>
                                                    
                                                    
                                                </td>
                                                <td><?php echo ($this->startsWith($cpt->transaction_number, '#'))?$cpt->transaction_number:'#'.$cpt->transaction_number?></td>
                                                <td><?php echo $cpt->amount?></td>
                                                <td><?php echo date('d M,Y',strtotime($cpt->createdOn))?></td>
                                                <td><a href="javascript:void(0)" class="addtemp" data-rel="<?php echo $cpt->id?>" data-datee="<?php echo $cpt->createdOn?>" data-trans="<?php echo ($this->startsWith($cpt->transaction_number, '#'))?$cpt->transaction_number:'#'.$cpt->transaction_number?>"><span class="aLink label label-success">Add Transaction</span></a></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label>Plot Payment Mode</label>
                                                    <select name="mode[]" class="form-control modesS" required>
                                                        <option value="">Please select plot payment mode</option>
                                                        <?php foreach(@$paymentmodes as $mode):?>
                                                            <option value="<?php echo $mode->id?>"><?php echo $mode->mode?></option>
                                                        <?php endforeach;?>
                                                    </select>
                                                    <!-- <p class="help-block">Example block-level help text here.</p> -->
                                                </td>
                                                
                                                <td>
                                                    <label>Transaction Number</label>
                                                    <input type="number" class="form-control childTrans_*" name="transaction[]" placeholder="Transaction Number" autocomplete="off" value="<?php echo str_replace('#', '', $cpt->transaction_number)?>" readonly="">
                                                </td>

                                                <td>
                                                    <label>Amount</label>
                                                    <input class="form-control numbersOnly" name="amount[]" placeholder="Amount">
                                                </td>

                                                <td>
                                                    <label>Date</label>
                                                    <input class="form-control childDatee_* numbersOnly" name="date[]" placeholder="Date" value="<?php echo $cpt->createdOn?>" readonly>
                                                </td>
                                                <td></td>
                                            </tr>
                                       <?php endforeach;}?>
                                    </tbody>
                                </table>    
                            </div>

                            <div class="form-group col-lg-6">
                                <h2>Destination Booking Transaction</h2>
                                <table width="100%" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Payment Mode</th>
                                            <th>Transaction #</th>
                                            <th>Amount</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php if($destBooking->customerPlotTransactions){ foreach($destBooking->customerPlotTransactions as $cpt):?>
                                            <tr >
                                                <td><?php echo @$cpt->plotPaymentMode->mode.''.(($cpt->monthlyDate!='')?' ('.$cpt->monthlyDate.')':'')?></td>
                                                <td><?php echo ($this->startsWith($cpt->transaction_number, '#'))?$cpt->transaction_number:'#'.$cpt->transaction_number?></td>
                                                <td><?php echo 'Rs. '.number_format($cpt->amount)?></td>
                                                <td><?php echo date('d M,Y',strtotime($cpt->createdOn))?></td>
                                            </tr>
                                       <?php endforeach;}?>
                                    </tbody>
                                </table>    
                            </div>
                            
                            
                            


                            <div class="col-lg-12">
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
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
            
        <table class="hide">
        <tbody id ="paymentModeBoxHiddenTransfer">
            <tr>
            <td>
                <label>Plot Payment Mode</label>
                <select name="mode[]" class="form-control modesS" required>
                    <option value="">Please select plot payment mode</option>
                    <?php foreach(@$paymentmodes as $mode):?>
                        <option value="<?php echo $mode->id?>"><?php echo $mode->mode?></option>
                    <?php endforeach;?>
                </select>
                <!-- <p class="help-block">Example block-level help text here.</p> -->
            </td>
            
            <td>
                <label>Transaction Number</label>
                <input type="number" class="form-control childTrans_*" name="transaction[]" placeholder="Transaction Number" autocomplete="off" value="">
            </td>

            <td>
                <label>Amount</label>
                <input class="form-control numbersOnly" name="amount[]" placeholder="Amount">
            </td>

            <td>
                <label>Date</label>
                <input class="form-control childDatee_* numbersOnly" name="date[]" placeholder="Date">
            </td>
            <td></td>
            </tr>
        </tbody>
    </table>