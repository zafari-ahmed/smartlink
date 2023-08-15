<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style media="print">
    .btnn{
        display: none;
    }
</style>
</head>
<?php $userModel = Yii::app()->session->get('userModel');?>
<?php //echo '<pre>';print_r($transaction);?>
<body style="margin:0;font-family:Arial, Helvetica, sans-serif;font-size:14px;">
    <div style="width:675px;height:842px;background:#fff;margin:0 auto;font-family:Arial, Helvetica, sans-serif;font-size:16px;">
		<div style="overflow:hidden;">
			<div style="width:15%;float:left;">
				<img src="<?php echo Yii::app()->baseUrl?>/images/logo1.jpg" style="max-width: 110%;margin-top: 16px;margin-left: 30px;">
			</div>
			<div style="width:70%;float:left;">
				<h1 style="margin:10px 0 0;text-align: center;">Kainat City</h1>
				<h4 style="border-bottom:solid 2px #000;padding:10px 0;margin:0;font-weight:normal;font-size: 10px;text-align: center;">Office # 2 & 3, Crown Center, SB-1 Block  13-C, Gulshan-e-Iqbal, Karachi</h4>
			</div>
			<div style="width:15%;float:left;">
				<img src="<?php echo Yii::app()->baseUrl?>/images/logo2.jpg" style="    max-width: 100%;margin-top: 5px;margin-left: -40px;">
			</div>
		</div>
        <div style="overflow:hidden;margin:05px 0;">
            <div style="width:150px;font-family:Arial, Helvetica, sans-serif;font-size:12px;float:left;margin-right:10px;">
            	<label style="width:70px;float:left;font-weight: bold;">Receipt No. </label>
                <input type="text" placeholder="Receipt No." style="font-weight:bold;text-align: center;border:0;border-bottom:solid 1px #000;width:70px;font-family:Arial, Helvetica, sans-serif;font-size:12px;float:right;outline:0;" value="<?php echo @$transaction[0]->transaction_number?>" />
            </div>
            <div style="width:140px;font-family:Arial, Helvetica, sans-serif;font-size:12px;float:left;margin-right:10px;">
            	<label style="width:40px;float:left;font-weight: bold;">Date :</label>
                <input type="text" placeholder="Date" value="<?php echo date('d-M-o')?>" style="border:0;width:90px;font-family:Arial, Helvetica, sans-serif;font-size:12px;float:right;outline:0;" />
            </div>
            <div style="width:120px;font-family:Arial, Helvetica, sans-serif;font-size:12px;float:left;margin-right:10px;">
            	<label style="width:60px;float:left;font-weight: bold;">Voucher #</label>
                <input type="text" placeholder="Voucher No." value="<?php echo @$transaction[0]->transaction_number?>" style="border:0;width:50px;font-family:Arial, Helvetica, sans-serif;font-size:12px;outline:0;" />
            </div>
            <div style="width:135px;font-family:Arial, Helvetica, sans-serif;font-size:12px;float:left;">
            	<label style="width:60px;float:left;font-weight: bold;">Rec by :</label>
                <input type="text" placeholder="Rec by" value="<?php echo @$transaction[0]->createdBy?>" style="border:0;width:70px;font-family:Arial, Helvetica, sans-serif;font-size:11px;float:right;outline:0;" />
            </div>
        </div>
        <div style="overflow:hidden;margin:05px 0;">
            <div style="width:100%;font-family:Arial, Helvetica, sans-serif;font-size:12px;">
            	<label style="width:225px;float:left;font-weight: bold;">Received with thanks from Mr./Mrs./Miss.</label>
                <input type="text" placeholder="Name" style="border:0;border-bottom:solid 1px #000;width:330px;font-family:Arial, Helvetica, sans-serif;font-size:12px;outline:0;" value="<?php echo ucwords(@$booking->customer->name)?>" />
            </div>
        </div>
        <div style="overflow:hidden;margin:05px 0;">
            <div style="width:400px;font-family:Arial, Helvetica, sans-serif;font-size:12px;float:left;margin-right:10px;">
            	<label style="width:90px;float:left;font-weight: bold;">S/O. W/O. D/O.</label>
                <input type="text" placeholder="Name" value="<?php echo ucwords(@$booking->customer->father_husband_name)?>" style="border:0;border-bottom:solid 1px #000;width:300px;font-family:Arial, Helvetica, sans-serif;font-size:12px;float:right;outline:0;" />
            </div>
            <div style="width:185px;font-family:Arial, Helvetica, sans-serif;font-size:12px;float:left;">
            	<label style="width:70px;float:left;font-weight: bold;">Contact # :</label>
                <input type="text" placeholder="Number" value="<?php echo @$booking->customer->mobile?>" style="border:0;border-bottom:solid 1px #000;width:100px;font-family:Arial, Helvetica, sans-serif;font-size:12px;outline:0;" />
            </div>
        </div>
        <div style="overflow:hidden;margin:05px 0;">
            <div style="width:130px;font-family:Arial, Helvetica, sans-serif;font-size:12px;float:left;margin-right:10px;">
            	<label style="width:80px;float:left;font-weight: bold;">Mode of Pay :</label>
                <input type="text" placeholder="" value="<?php echo @$transaction[0]->transaction_type?>" style="border:0;border-bottom:solid 1px #000;width:40px;font-family:Arial, Helvetica, sans-serif;font-size:12px;float:right;outline:0;text-align: center;" />
            </div>
            <div style="width:145px;font-family:Arial, Helvetica, sans-serif;font-size:12px;float:left;margin-right:10px;">
            	<label style="width:35px;float:left;font-weight: bold;">Bank</label>
                <input type="text" value="<?php echo (@$transaction[0]->transaction_type != 'cash')?@$transaction[0]->bank:''?>" style="border:0;border-bottom:solid 1px #000;width:100px;font-family:Arial, Helvetica, sans-serif;font-size:12px;float:right;outline:0;" />
            </div>
            <div style="width:190px;font-family:Arial, Helvetica, sans-serif;font-size:12px;float:left;margin-right:10px;">
            	<label style="width:120px;float:left;font-weight: bold;">Pay Order/Cheque #:</label>
                <input type="text" value="<?php echo (@$transaction[0]->transaction_type != 'cash')?@$transaction[0]->comment:''?>" style="border:0;width:60px;font-family:Arial, Helvetica, sans-serif;font-size:12px;float:right;outline:0;" />
            </div>
            <div style="margin-left: -40px;width:130px;font-family:Arial, Helvetica, sans-serif;font-size:12px;float:left;">
            	<label style="width:40px;float:left;font-weight: bold;">Dated:</label>
                <input type="text"  value="<?php echo date('d-M-o',strtotime(@$transaction[0]->createdOn))?>" style="border:0;width:80px;font-family:Arial, Helvetica, sans-serif;font-size:11px;float:right;outline:0;" />
            </div>
        </div>
        <div style="overflow:hidden;margin:05px 0;">
            <div style="width:105px;font-family:Arial, Helvetica, sans-serif;font-size:12px;float:left;margin-right:10px;">
            	<label style="width:40px;float:left;padding-top:10px;font-weight: bold;">Plot # :</label>
                <input type="text" placeholder="Plot" value="<?php echo @$booking->plot->plot_number?>" style="border:solid 1px #000;width:50px;font-family:Arial, Helvetica, sans-serif;font-size:10px;padding:5px;float:right;outline:0;font-weight: bold;" />
            </div>
            <div style="width:155px;font-family:Arial, Helvetica, sans-serif;font-size:12px;float:left;margin-right:10px;">
            	<label style="width:50px;float:left;padding-top:10px;font-weight: bold;">Block # :</label>
                <input type="text" placeholder="Block " value="<?php echo @$booking->plot->block_number?>" style="border:solid 1px #000;width:90px;font-family:Arial, Helvetica, sans-serif;font-size:10px;padding:5px;float:right;outline:0;font-weight: bold;" />
            </div>
            <div style="width:155px;font-family:Arial, Helvetica, sans-serif;font-size:12px;float:left;margin-right:10px;">
            	<label style="width:40px;float:left;padding-top:10px;font-weight: bold;">Type :</label>
                <input type="text" placeholder="Type" value="<?php echo @$booking->plot->category->name?>" style="border:solid 1px #000;width:100px;font-family:Arial, Helvetica, sans-serif;font-size:10px;padding:5px;float:right;outline:0;font-weight: bold;" />
            </div>
            <div style="width:150px;font-family:Arial, Helvetica, sans-serif;font-size:12px;float:left;">
            	<label style="width:40px;float:left;padding-top:10px;">Size :</label>
                <input type="text" placeholder="Size" value="<?php echo @$booking->plot->size->size?>" style="border:solid 1px #000;width:95px;font-family:Arial, Helvetica, sans-serif;font-size:10px;padding:5px;float:right;outline:0;font-weight: bold;" />
            </div>
        </div>
        <div style="border:solid 2px #000;margin:10px 0;border-radius:10px;padding-bottom:5px;height: 31%">
        	<div style="border-bottom:solid 2px #000;margin-bottom:5px;padding:10px;overflow:hidden;">
            	<div style="width:40px;float:left;font-size:10px;font-family:Arial, Helvetica, sans-serif;margin-right:10px;">S#.</div>
                <div style="width:250px;float:left;font-size:10px;font-family:Arial, Helvetica, sans-serif;margin-right:10px;">Mode of Payment</div>
                <div style="width:80px;float:left;font-size:10px;font-family:Arial, Helvetica, sans-serif;margin-right:10px;">No of Inst.</div>
                <div style="width:80px;float:left;font-size:10px;font-family:Arial, Helvetica, sans-serif;margin-right:10px;">Inst. Amt</div>
                <div style="width:80px;float:left;font-size:10px;font-family:Arial, Helvetica, sans-serif;">Received Amount</div>
            </div>
            
            <?php $total = 0; $lastMonthly = @$lastMonthly; if($transaction) { foreach($transaction as $index=>$transact): $total = $total + $transact->amount;?>
                <?php $paymentModeInfo = PaymentModes::model()->find('plot_size_id = :id AND mode =:mode',array(':id'=>@$size_id,':mode'=>$transact->plotPaymentMode->mode)); ?>
            <div style="border-bottom:dashed 1px #000;padding:3px 10px;overflow:hidden;">
            	<div style="width:40px;float:left;font-size:10px;font-family:Arial, Helvetica, sans-serif;margin-right:10px;"><?php echo @$index+1?></div>
                <div style="width:250px;float:left;font-size:10px;font-family:Arial, Helvetica, sans-serif;margin-right:10px;"><?php echo @$transact->plotPaymentMode->mode?></div>
                <?php if(@$transact->plotPaymentMode->id == 34){?>
                    <?php $lastMonthly = @$lastMonthly +1;?>
                    <div style="width:80px;float:left;font-size:10px;font-family:Arial, Helvetica, sans-serif;margin-right:10px;"><?php echo @$lastMonthly?></div>
                <?php } else {?>
                    <div style="width:80px;float:left;font-size:10px;font-family:Arial, Helvetica, sans-serif;margin-right:10px;">1</div>
                <?php } ?>

                <?php if(@$transact->plotPaymentMode->id == 34){?>
                <div style="width:80px;float:left;font-size:10px;text-align:right;font-family:Arial, Helvetica, sans-serif;margin-right:10px;"><?php echo number_format(@$transact->amount)?></div>
                <?php } else {?>
                <div style="width:80px;float:left;font-size:10px;text-align:right;font-family:Arial, Helvetica, sans-serif;margin-right:10px;"><?php echo number_format(@$paymentmode[$transact->plotPaymentMode->id])?></div>
                <?php } ?>
                <div style="width:80px;float:left;font-size:10px;text-align:right;font-family:Arial, Helvetica, sans-serif;"><?php echo number_format(@$transact->amount)?></div>
            </div>

            
        <?php endforeach;}?>
            
            
        </div>

        <div style="overflow:hidden;margin:-05px 0 0;">
            <div style="padding: 3px 10px;overflow: hidden;margin-top: -5%;position: absolute;z-index: 9999999999;">
                <div style="width:40px;float:left;font-size:14px;font-family:Arial, Helvetica, sans-serif;margin-right:10px;">&nbsp;</div>
                <div style="width:250px;float:left;font-size:14px;font-family:Arial, Helvetica, sans-serif;margin-right:10px;">&nbsp;</div>
                <div style="width:80px;float:left;font-size:14px;font-family:Arial, Helvetica, sans-serif;margin-right:10px;">&nbsp;</div>
                <div style="width: 80px;float: left;font-size: 12px;font-family: initial;margin-right: 8px;position: relative;top: 10px;font-style: italic;font-weight: bold;">Grand Total: </div>
                <div style="text-align: right;width: 75px;float: left;font-size: 12px;font-family: Arial, Helvetica, sans-serif;border-bottom: 1px solid;border-top: 1px solid;padding: 2px;position: relative;top: 2px;"><?php echo number_format($total)?></div>
            </div>


            <div style="width:400px;font-family:Arial, Helvetica, sans-serif;font-size:10px;float:left;margin-right:10px;">
            	<label style="width:50px;float:left;font-weight:bold;">Rupees: </label>
                <input type="text" value="<?php echo $this->getIndianCurrency($total)?>" placeholder="Price" style="border:0;width:330px;font-family:Arial, Helvetica, sans-serif;font-size:10px;outline:0;text-transform: uppercase;" />
            </div>
        </div>
        <div style="overflow:hidden;margin:5px 0 0;">
            <div style="width:220px;font-family:Arial, Helvetica, sans-serif;font-size:07px;text-align:center;margin-right:10px;margin-top:15px;float:left;">
            	<input type="text" style="border:0;border-bottom:solid 1px #000;width:100%;font-family:Arial, Helvetica, sans-serif;font-size:07px;outline:0;" />
                <label style="width:100%;display:block;margin-top:5px;">For Kainat City</label>
            </div>
            <div style="width:350px;font-family:Arial, Helvetica, sans-serif;font-size:07px;float:right;">
            	<p style="color:#000;font-size:07px;margin:0;font-weight:bold;">(This Receipt is valid subject to realizations of cheque)</p>
                <div style="width:100%;font-family:Arial, Helvetica, sans-serif;font-size:07px;float:left;margin-top:5px;">
                    <label style="width:80px;float:left;">Posted Date:</label>
                    <input type="text" value="<?php echo date('d/m/o')?>" placeholder="Date" style="border:0;width:250px;text-align:center;font-family:Arial, Helvetica, sans-serif;font-size:07px;float:right;outline:0;" />
                </div>
                <div style="width:100%;font-family:Arial, Helvetica, sans-serif;font-size:07px;float:left;margin-top:5px;">
                    <label style="width:90px;float:left;margin-right:10px;">Print Date Time:</label>
                    <input type="text" placeholder="Time" style="border:0;width:80px;text-align:center;font-family:Arial, Helvetica, sans-serif;font-size:07px;float:left;outline:0;" value="<?php echo date('H:i:sA')?>"/>
                    <input type="text" placeholder="Date" style="border:0;width:80px;text-align:center;font-family:Arial, Helvetica, sans-serif;font-size:07px;float:left;margin:0 3px;outline:0;" value="<?php echo date('d/m/o')?>"/>
                    <input type="text" placeholder="Name" style="border:0;width:80px;text-align:center;font-family:Arial, Helvetica, sans-serif;font-size:07px;float:left;outline:0;" value="<?php echo ucwords($userModel['first_name'].' '.$userModel['last_name'])?>"/>
                </div>
            </div>
        </div>
    </div>
    <div style="padding-left: 0px;    margin-left: 47%;margin-top: -15%;">
        <button type="button" class="btn btn-success btnn" onclick="printBtn()">Print</button>
        <a href="<?php echo @$link?>"><button type="button" class="btn btn-success btnn" id="transactionBtn">Back</button></a>
    </div>
</body>

<script type="text/javascript">
        
    function printBtn(){
        window.print();
    }
</script>
</html>
