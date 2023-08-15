<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style media="print">
    .btnn{
        display: none;
    }
    .hide{
        display: none;
    }
</style>
<style type="text/css">
    .hide{
        display: none;
    }
    .pagebreak { 
        page-break-before: always; 
    } /* page-break-after works, as well */
</style>
</head>
<?php $userModel = Yii::app()->session->get('userModel');?>

<body style="margin:0;font-family:Arial, Helvetica, sans-serif;font-size:14px;">
    <div style="width:700px;height:842px;background:#fff;margin:0 auto;font-family:Arial, Helvetica, sans-serif;font-size:16px;">
        <?php if(@$expense->reason || $expense->status == 0){?>
        <img src="/kainat/images/cancelledInvoice.png" style="    position: absolute;z-index: 999;width: 70%;margin-left: 9%;margin-top: 1%;opacity: 0.5;">
        <?php }?>
		<div style="overflow:hidden;">
			<div style="width:10%;float:left;position: relative;left: -5%;">
				<img src="<?php echo Yii::app()->baseUrl?>/images/logo1.png" style="max-width: 150%;margin-top: 15px;margin-left: 30px;">
			</div>
			<div style="width:70%;float:left;text-align: center;">
                <!-- <span style="text-align: center;border: 2px solid;border-radius: 5px;padding: 5px;position: relative;top: 10px;">Customer Copy</span> -->
				<h1 style="margin:10px 0 0;text-align: center;    font-size: 36px;margin-top: 5%;">DEBIT VOUCHER</h1>
				<h4 style="border-bottom:solid 2px #000;padding:10px 0;margin:0;font-weight:normal;font-size: 10px;text-align: center;width: 140%;margin-left: -15%;line-height: 15px;">Office No. C-4, First Floor Block-7, Saadi Town, Scheme 33, Karachi<br/>Ph : 021-37440935</h4>
			</div>
			<!-- <div style="width:18%;float:left;position: relative;right: -8%;">
				<img src="<?php //echo Yii::app()->baseUrl?>/images/logo2.png" style="    max-width: 140%;margin-top: 5px;margin-left: -115px;">
			</div> -->
		</div>
        <div style="overflow:hidden;margin:05px 0;">
            <div style="width:200px;font-family:Arial, Helvetica, sans-serif;font-size:12px;float:left;margin-right:10px;">
            	<label style="width:70px;float:left;font-weight: bold;">Voucher No. </label>
                <?php if(isset($expense->account_id)){?>
                <input type="text" placeholder="Receipt No." style="font-weight:bold;text-align: center;border:0;border-bottom:solid 1px #000;width:125px;font-family:Arial, Helvetica, sans-serif;font-size:12px;float:right;outline:0;" value="<?php echo $this->getExpenseRegNo($expense->id,'expense')?>" />
                <?php } else{?>
                    <input type="text" placeholder="Receipt No." style="font-weight:bold;text-align: center;border:0;border-bottom:solid 1px #000;width:125px;font-family:Arial, Helvetica, sans-serif;font-size:12px;float:right;outline:0;" value="<?php echo $this->getExpenseRegNo($expense->id,'pettyCash')?>" />
                <?php } ?>
            </div>
            <div style="width:250px;font-family:Arial, Helvetica, sans-serif;font-size:12px;float:left;margin-right:10px;">
            	<label style="width:110px;float:left;font-weight: bold;">Voucher Date :</label>
                <input type="text" placeholder="Date" value="<?php echo date('d-M-Y',strtotime(@$expense->createdOn))?>" style="border:0;width:130px;font-family:Arial, Helvetica, sans-serif;font-size:12px;float:left;outline:0;border-bottom: solid 1px #000;font-weight: bold;text-align: center;" />
            </div>
            <div style="width:200px;font-family:Arial, Helvetica, sans-serif;font-size:12px;float:left;margin-right:10px;">
            	<label style="width:80px;float:left;font-weight: bold;">Head of A/C:</label>
                <input type="text" placeholder="Voucher No." value="<?php echo ucfirst($this->expenseType(@$expense->expense_type))?>" style="border:0;width:100px;font-family:Arial, Helvetica, sans-serif;font-size:12px;outline:0;border-bottom: solid 1px #000;font-weight: bold;text-align: center;" />
            </div>
        </div>
        <div style="overflow:hidden;margin:05px 0;">
            <div style="width:300px;font-family:Arial, Helvetica, sans-serif;font-size:12px;float:left;margin-right:10px;">
                <label style="width:80px;float:left;font-weight: bold;">Paid To: </label>
                <input type="text" placeholder="Receipt No." style="font-weight:bold;text-align: center;border:0;border-bottom:solid 1px #000;width:210px;font-family:Arial, Helvetica, sans-serif;font-size:12px;float:right;outline:0;" value="<?php echo ucfirst(@$expense->paid_to)?>" />
            </div>
            <div style="width:280px;font-family:Arial, Helvetica, sans-serif;font-size:12px;float:left;margin-right:10px;">
                <label style="width:70px;float:left;font-weight: bold;">CNIC / NTN: </label>
                <input type="text" placeholder="Date" value="<?php echo isset($expense->cnic)?$expense->cnic:''?>" style="border:0;width:180px;font-family:Arial, Helvetica, sans-serif;font-size:12px;float:left;outline:0;border-bottom: solid 1px #000;font-weight: bold;text-align: center;" />
            </div>
            <!-- <div style="width:200px;font-family:Arial, Helvetica, sans-serif;font-size:12px;float:left;margin-right:10px;">
                <label style="width:80px;float:left;font-weight: bold;">Voucher No:</label>
                <input type="text" placeholder="Voucher No." value="<?php //echo $this->getExpenseRegNo($expense->id)?>" style="border:0;width:90px;font-family:Arial, Helvetica, sans-serif;font-size:12px;outline:0;border-bottom: solid 1px #000;font-weight: bold;text-align: center;" />
            </div> -->
        </div>
        
        <!-- <div style="overflow:hidden;margin:05px 0;">
            <div style="width:100%;font-family:Arial, Helvetica, sans-serif;font-size:12px;">
            	<label style="width:240px;float:left;font-weight: bold;">Received with thanks from Mr./Mrs./Miss.</label>
                <input type="text" placeholder="Name" style="border:0;border-bottom:solid 1px #000;width:330px;font-family:Arial, Helvetica, sans-serif;font-size:12px;outline:0;" value="<?php //echo ucwords('asd')?>" />
            </div>
        </div>
        
        <div style="overflow:hidden;margin:05px 0;">
            <div style="width:450px;font-family:Arial, Helvetica, sans-serif;font-size:12px;float:left;margin-right:10px;">
            	<label style="width:35px;float:left;font-weight: bold;"><?php //echo ucwords(@$booking->agent_name)?>:</label>
                <input type="text" placeholder="Name" value="<?php //echo ucwords('asd')?>" style="border:0;border-bottom:solid 1px #000;width:300px;font-family:Arial, Helvetica, sans-serif;font-size:12px;float:left;outline:0;" />
            </div>
        </div>
        
        <div style="overflow:hidden;margin:05px 0;" class="hide">
            <div style="width:185px;font-family:Arial, Helvetica, sans-serif;font-size:12px;float:left;margin-right:10px;">
                <label style="width:30px;float:left;font-weight: bold;">Bank</label>
                <input type="text" value="<?php //echo (@$transaction[0]->transaction_type != 'cash')?@$transaction[0]->bank:''?>" style="border:0;border-bottom:solid 1px #000;width:145px;font-family:Arial, Helvetica, sans-serif;font-size:12px;outline:0;margin-left: 5px" />
            </div>
            <div style="width:175px;font-family:Arial, Helvetica, sans-serif;font-size:12px;float:left;margin-right:10px;">
            	<label style="width:110px;float:left;font-weight: bold;">Mode of Payment :</label>
                <input type="text" placeholder="" value="<?php //echo @$transaction[0]->transaction_type?>" style="border:0;border-bottom:solid 1px #000;width:60px;font-family:Arial, Helvetica, sans-serif;font-size:12px;float:left;outline:0;text-align: center;" />
            </div>
            
            <div style="width:160px;font-family:Arial, Helvetica, sans-serif;font-size:11px;float:left;margin-right:10px;">
            	<label style="width:40px;float:left;font-weight: bold;">Ref #:</label>
                <input type="text" value="<?php //echo @$transaction[0]->reference_number?>" style="border:0;width:80px;font-family:Arial, Helvetica, sans-serif;font-size:12px;outline:0;text-decoration: underline;" />
            </div>
            <div style="margin-left: -40px;width:140px;font-family:Arial, Helvetica, sans-serif;font-size:12px;float:left;">
            	<label style="width:40px;float:left;font-weight: bold;">Dated:</label>
                <input type="text"  value="<?php //echo date('d-M-Y',strtotime(@$transaction[0]->createdOn))?>" style="border:0;width:80px;font-weight: bold;font-family:Arial, Helvetica, sans-serif;font-size:11px;float:right;outline:0;text-decoration: underline;" />
            </div>
        </div> -->
        
        <!-- <div style="overflow:hidden;margin:05px 0;">
            <div style="width:75px;font-family:Arial, Helvetica, sans-serif;font-size:12px;float:left;margin-right:10px;">
                <label style="width:52px;float:left;padding-top:10px;font-weight: bold;">Head of A/C:</label>
                <input type="text" placeholder="Block " value="<?php //echo @$booking->plot->block_number?>" style="border:solid 1px #000;width:10px;font-family:Arial, Helvetica, sans-serif;font-size:10px;padding:5px;float:left;outline:0;font-weight: bold;" />
            </div>

            <div style="width:110px;font-family:Arial, Helvetica, sans-serif;font-size:12px;float:left;margin-right:10px;">
                <label style="width:65px;float:left;padding-top:10px;font-weight: bold;">Paid To:</label>
                <input type="text" placeholder="Block " value="<?php //echo @$booking->plot->plot_type?>" style="border:solid 1px #000;width:25px;font-family:Arial, Helvetica, sans-serif;font-size:10px;padding:5px;float:left;outline:0;font-weight: bold;" />
            </div>

            <div style="width:120px;font-family:Arial, Helvetica, sans-serif;font-size:12px;float:left;margin-right:10px;">
            	<label style="width:40px;float:left;padding-top:10px;font-weight: bold;">Plot # :</label>
                <input type="text" placeholder="Plot" value="<?php //echo @$booking->plot->plot_number?>" style="border:solid 1px #000;width:50px;font-family:Arial, Helvetica, sans-serif;font-size:10px;padding:5px;float:right;outline:0;font-weight: bold;" />
            </div>
            
            <div style="width:150px;font-family:Arial, Helvetica, sans-serif;font-size:12px;float:left;margin-right:10px;">
            	<label style="width:35px;float:left;padding-top:10px;font-weight: bold;">Size :</label>
                <input type="text" placeholder="Type" value="<?php //echo @$booking->plot->size->size?>" style="border:solid 1px #000;width:100px;font-family:Arial, Helvetica, sans-serif;font-size:10px;padding:5px;float:left;outline:0;font-weight: bold;" />
            </div>
            <div style="width:180px;font-family:Arial, Helvetica, sans-serif;font-size:12px;float:left;">
            	<label style="width:70px;float:left;padding-top:10px;font-weight: bold;">Category :</label>
                <input type="text" placeholder="Size" value="<?php //echo @$booking->plot->category->name?>" style="border:solid 1px #000;width:95px;font-family:Arial, Helvetica, sans-serif;font-size:10px;padding:5px;float:right;outline:0;font-weight: bold;" />
            </div>
        </div> -->
        <div style="border:solid 2px #000;margin:10px 0;border-radius:10px;padding-bottom:5px;height: 28%">
        	<div style="border-bottom:solid 2px #000;margin-bottom:5px;padding:10px;overflow:hidden;font-weight:bold">
            	<div style="width:20px;float:left;font-size:11px;font-family:Arial, Helvetica, sans-serif;margin-right:10px;">S#.</div>
                <div style="width:150px;float:left;font-size:11px;font-family:Arial, Helvetica, sans-serif;margin-right:10px;">Mode of Payment</div>
                <div style="width:120px;float:left;font-size:11px;font-family:Arial, Helvetica, sans-serif;margin-right:10px;">Expense Type</div>
                <div style="width:120px;float:left;font-size:11px;font-family:Arial, Helvetica, sans-serif;margin-right:10px;">Bank</div>
                <div style="width:100px;float:left;font-size:11px;font-family:Arial, Helvetica, sans-serif;margin-right:10px;">Ref #</div>
                <div style="width:100px;float:left;font-size:11px;font-family:Arial, Helvetica, sans-serif;">Expense Amount</div>
            </div>
            
            <div style="border-bottom:dashed 1px #000;padding:3px 10px;overflow:hidden;">
            	<div style="width:20px;float:left;font-size:10px;font-family:Arial, Helvetica, sans-serif;margin-right:10px;"><?php echo @$index+1?></div>
                <div style="width:150px;float:left;font-size:10px;font-family:Arial, Helvetica, sans-serif;margin-right:2%;font-weight: bold;"><?php echo @ucfirst($expense->payment_mode)?></div>
                <div style="width:120px;float:left;font-size:10px;font-family:Arial, Helvetica, sans-serif;margin-right:1%;font-weight: bold;"><?php echo ucfirst($this->expenseType(@$expense->expense_type))?></div>
                <div style="width:120px;float:left;font-size:10px;font-family:Arial, Helvetica, sans-serif;margin-right:-1%;font-weight: bold;"><?php echo ucfirst(isset($expense->bank)?$expense->bank:'N/A')?></div>
                <div style="width:100px;float:left;font-size:10px;text-align:left;font-family:Arial, Helvetica, sans-serif;margin-left:3%;font-weight: bold;"><?php echo isset($expense->number)?$expense->number:'N/A'?></div>
                <div style="width:100px;float:left;font-size:10px;text-align:center;font-family:Arial, Helvetica, sans-serif;font-weight: bold;"><?php echo number_format(@$expense->amount)?></div>
            </div>            
            <div style="margin-top:4%;margin-left:1%">
                <div style="width:55px;float:left;font-size:12px;font-family:Arial, Helvetica, sans-serif;margin-right:25px; font-weight: bold">*Particulars:&nbsp;</div>
                    <div style="width:90%;float:left;font-size:12px;font-family:Arial, Helvetica, sans-serif;margin-right:10px;font-weight: bold"><?php echo @$expense->description?></div>
            </div>
        </div>

        <div style="margin:-05px 0 0;">
            <div style="padding: 3px 15px;overflow: hidden;margin-top: -7%;position: absolute;z-index: 9999999999;">
                <?php if(@$expense->reason){?>
                <div style="width:55px;float:left;font-size:12px;font-family:Arial, Helvetica, sans-serif;margin-right:10px; font-weight: bold">*Reason:&nbsp;</div>
                <div style="width:375px;float:left;font-size:12px;font-family:Arial, Helvetica, sans-serif;margin-right:10px;font-weight: bold"><?php echo @$expense->reason?></div>
                <?php } else {?>
                    <div style="width:40px;float:left;font-size:14px;font-family:Arial, Helvetica, sans-serif;margin-right:10px;">&nbsp;</div>
                    <div style="width:250px;float:left;font-size:14px;font-family:Arial, Helvetica, sans-serif;margin-right:10px;">&nbsp;</div>
                    <div style="width:80px;float:left;font-size:14px;font-family:Arial, Helvetica, sans-serif;margin-right:10px;">&nbsp;</div>
                <?php } ?>                    
                <div style="width: 80px;float: left;font-size: 12px;font-family: initial;margin-right: 8px;position: relative;top: 10px;font-style: italic;font-weight: bold;">Grand Total: </div>
                <div style="text-align: right;width: 75px;float: left;font-size: 12px;font-family: Arial, Helvetica, sans-serif;border-bottom: 1px solid;border-top: 1px solid;padding: 2px;position: relative;top: 2px;    font-weight: bold;"><?php echo number_format($expense->amount)?></div>
            </div>
            <div style="width:100%;font-family:Arial, Helvetica, sans-serif;font-size:10px;float:left;margin-right:10px;">
            	<label style="width:50px;float:left;font-weight:bold;">Rupees: </label>
                <input type="text" value="<?php echo $this->getIndianCurrency($expense->amount)?>" placeholder="Price" style="border:0;width:90%;font-family:Arial, Helvetica, sans-serif;font-size:10px;outline:0;text-transform: uppercase;    font-weight: bold;text-align: left" />
            </div>
        </div>
        <div style="margin:5px 0 0;">
            <div>
                <div style="width:220px;font-family:Arial, Helvetica, sans-serif;font-size:07px;text-align:center;margin-right:10px;margin-top:50px;float:left;">
                    <input type="text" style="border:0;border-bottom:solid 1px #000;width:70%;font-family:Arial, Helvetica, sans-serif;font-size:12px;outline:0;" />
                    <label style="width:100%;display:block;margin-top:5px;font-size: 12px;font-weight: bold;">Accountant</label>
                </div>
                <div style="width:220px;font-family:Arial, Helvetica, sans-serif;font-size:07px;text-align:center;margin-right:10px;margin-top:50px;float:left;">
                    <input type="text" style="border:0;border-bottom:solid 1px #000;width:70%;font-family:Arial, Helvetica, sans-serif;font-size:12px;outline:0;" />
                    <label style="width:100%;display:block;margin-top:5px;font-size: 12px;font-weight: bold;">Prop./Manager</label>
                </div>
                <div style="width:220px;font-family:Arial, Helvetica, sans-serif;font-size:07px;text-align:center;margin-right:10px;margin-top:50px;float:left;">
                    <input type="text" style="border:0;border-bottom:solid 1px #000;width:70%;font-family:Arial, Helvetica, sans-serif;font-size:12px;outline:0;" />
                    <label style="width:100%;display:block;margin-top:5px;font-size: 12px;font-weight: bold;">Receiver's Signature</label>
                </div>
            </div>
        </div>
    </div>
    <div class="pagebreak"> </div>
    
    <div style="padding-left: 0px;    margin-left: 47%;margin-top: -15%;">
        <button type="button" class="btn btn-success btnn" onclick="window.print();">Print</button>
        <a href="<?php echo @$link?>"><button type="button" class="btn btn-success btnn" id="transactionBtn">Back</button></a>
    </div>
</body>
<script type="text/javascript">
    window.print();
</script>
</html>
