<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Custom Payment Schedules</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Add Custom Payment Schedule
            </div>
            <div class="panel-body">
                <div class="row">
                    <form role="form" method="POST" action="<?php echo Yii::app()->baseUrl?>/paymentschedule/savecustom">
                        <!-- <div class="col-lg-12"> -->
                            
                            <div class="form-group col-lg-3" >
                                <label>Booking</label>
                                <input class="form-control" value="<?php echo '*'.$booking->plot->block_number.'-'.$booking->plot->plot_type.'-'.$booking->plot->plot_number?>*" readonly>
                                <input name="booking_id" type="hidden" value="<?php echo $booking->id?>">
                            </div>
                            <div class="form-group col-lg-3" >
                                <label>Customer Name</label>
                                <input class="form-control" value="<?php echo $booking->customer->name?>" readonly>
                            </div>

                            <div class="form-group col-lg-3" >
                                <label>Monthly Installment Number</label>
                                <input class="form-control" name="monthlyMonths" value="<?php echo @$booking->monthlyMonths?>">
                            </div>

                            <div class="form-group col-lg-3" >
                                <label>Yearly Installment Number</label>
                                <input class="form-control" name="monthlyYearlies" value="<?php echo @$booking->monthlyYearlies?>">
                            </div>
                            
                            <div class="form-group col-lg-12" >
                                <table width="100%" class="table table-striped table-bordered table-hover">
                                    <tr>
                                        <th>Description</th>
                                        <th>Old Amount</th>
                                        <th>Amount</th>
                                    </tr>
                                    <tbody>
                                        <?php $paymentmodesT = $paymentmodesCustomT = 0;foreach($this->paymentScheduleModes() as $modes):?>
                                            <tr>
                                                <td><?php echo $modes?></td>
                                                <td><input class="form-control col-md-3" placeholder="<?php echo $modes?> Amount" value="<?php echo number_format($paymentmodes[strtolower($modes)]['amount'])?>" readonly></td>
                                                <?php $paymentmodesT = $paymentmodesT + $paymentmodes[strtolower($modes)]['amount']?>
                                                <td><input class="form-control col-md-3 price" name="payment[<?php echo strtolower($modes)?>]" id="name" placeholder="<?php echo $modes?> Amount" value="<?php echo (isset($paymentmodesNew))?$paymentmodesNew[strtolower($modes)]['amount']:0?>" required></td>
                                                <?php $paymentmodesCustomT = $paymentmodesCustomT + ((isset($paymentmodesNew))?$paymentmodesNew[strtolower($modes)]['amount']:0)?>
                                            </tr>
                                        <?php endforeach;?>
                                        <tr>
                                            <td><b>Total</b></td>
                                            <td><b><?php echo number_format(@$paymentmodesT)?></b></td>
                                            <td id="customT" style="font-weight: bold;"><b><?php echo number_format(@$paymentmodesCustomT)?></b></td>
                                        </tr>
                                        <tr>
                                            <td><b>Total Discount</b></td>
                                            <td id="customDiscountText" style="font-weight: bold;"><b><?php echo @$paymentmodesT.'-'.@$paymentmodesCustomT?></b></td>
                                            <td id="customDiscount" style="font-weight: bold;"><b><?php echo number_format(@$paymentmodesT-$paymentmodesCustomT)?></b></td>
                                        </tr>
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
<script type="text/javascript">
    $('.price').blur(function () {
        let oldAmount = <?php echo @$paymentmodesT?>;
        console.log(oldAmount);
        let sum = 0;
        $('.price').each(function() {
            sum += Number($(this).val());
        });

        $('#customT').text(sum.toFixed(2))
        $('#customDiscountText').text(oldAmount+'-'+sum)
        $('#customDiscount').text((oldAmount-sum).toFixed(2))
    });
</script>
            