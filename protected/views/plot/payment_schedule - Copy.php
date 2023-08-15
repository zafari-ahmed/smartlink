<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Schedule</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <style>
        .main {
            /*width: 595px;*/
            width: 710px;
            height: 842px;
            /* border: 2px solid black; */
            padding-top: 300px;
            font-size: 13px;
        }
        .content {
            text-align: justify;
            line-height: 30px;
        }
        span {
            display: inline-block;
            width: 10%;
            /*border-bottom: 1px solid black;*/
            text-decoration: underline;
            text-align: center;
            font-weight: bold;

            /*padding-left: 20px;
            padding-right: 20px;*/
        }
        span.customSpan{
            width: auto!important;
            text-transform: uppercase;
            padding-left: 8px;
            padding-right: 8px;
        }

        span.calc{
            width: auto!important;
            text-transform: uppercase;
            border-bottom: 0;
            text-decoration: none;
        }

        td {
            padding: 3px 15px;
            border: 1px solid black;
        }
        .right {
            text-align: right;
        }
        .center h6 {
            text-align: center;
        }
        .pagebreak { 
            page-break-before: always; 
        } /* page-break-after works, as well */
    </style>
    <style type="text/css" media="print">
        .heading{
            color:#0072bb!important;
        }
    </style>
</head>
<body>

    
    <?php 
        $cornerCharger = 0;
        $parkFacing = 0;
        $westOpen = 0;
        $extraCharge = 0;
        $plotTotal = $plot->total;
        $plotTotalExtra = $plotTotal;
        $extraCost = 0;
        if($plot->discount > 0) {
            $plotTotal = $plotTotalExtra = $plotTotal - $plot->discount;
        }

        if($plot->is_corner == 1){
            $cornerCharger = $this->Percentage($plotTotal,$plot->is_corner_amount,0);
            $plotTotalExtra = $plotTotal + $cornerCharger;
            $extraCost = $extraCost + $cornerCharger;
        }

        if($plot->is_park_facing == 1){
            $parkFacing = $this->Percentage($plotTotalExtra,$plot->is_park_facing_amount,0);
            $plotTotalExtra = $plotTotalExtra + $parkFacing;
            $extraCost = $extraCost + $parkFacing;
        }

        if($plot->is_west_open == 1){
            $westOpen = $this->Percentage($plotTotalExtra,$plot->is_west_open_amount,0);
            $plotTotalExtra = $plotTotalExtra + $westOpen;
            $extraCost = $extraCost + $westOpen;
        }

        //if($plot->is_road_facing == 1){
        $extraCharge = 'PKR '.number_format(@$plotTotalExtra/(str_replace(' SQ Yrd','',$plot->size->size))).' per SQ Yrd';
        //}
    ?>
    <div class="main container">
        <div class="container content">
            <div style="text-align: center;border: 2px solid #000;border-radius: 5px;margin-left: 35%;position: absolute;top: 5%;font-size: 30px;padding: 10px;font-weight: bold;">Duplicate</div>
            Block: <span class="customSpan"><?php echo @$plot->block_number?></span>, Plot Type: <span class="customSpan"><?php echo @$plot->plot_type?></span>, Plot No:<span class="customSpan"><?php echo @$plot->plot_number?></span>, Admeasuring: <span><?php echo @$plot->size->size?></span>, Category: <span><?php echo @$plot->category->name?></span> 
            <br><br>
            Cost of Land: <span class="customSpan">PKR <?php echo number_format($plot->total)?>/=</span>
            <?php if($plot->discount > 0) {?>
                <?php $plotTotalD = $plot->total - $plot->discount?>
                &nbsp;&nbsp;, Discount: <span class="customSpan"><?php echo ' PKR '.number_format($plot->discount)?>/=</span>, Discounted Cost of Land: <span class="customSpan"><?php echo 'PKR '.number_format($plotTotalD)?>/=</span><br>
                
            <?php }?>
            <br>
            Corner Charges: <span><?php echo ($cornerCharger!=0)?(number_format($cornerCharger).'/='):'N/A'?></span>, Park Facing Charges: <span><?php echo ($parkFacing!=0)?(number_format($parkFacing).'/='):'N/A'?></span>, West Open Charges: <span><?php echo ($westOpen!=0)?(number_format($westOpen).'/='):'N/A'?></span>.
            <br><br>
            <?php 


            $modes = PaymentSchedulePaymentModes::model()->findAll('payment_schedule_id = :id AND plot_type = :type',array(':id'=>$booking->is_special,':type'=>strtolower($booking->plot->plot_type)));
            $displayP = 0;
            foreach($modes as $index=>$mode):
                
                if($mode->mode=='possession'){
                    if($plot->discount > $mode->amount ){
                        $displayP = 0;
                    } else{
                        $displayP = 1;
                    }
                }
            endforeach;

            if($displayP == 1){
            ?>
            <h5>PAYMENT BREAKUP (PKR)</h5>
            <?php
            //echo '<pre>';print_r($booking);exit;
            
            
            if($modes){
                //$modes = array_slice($plot->size->paymentModes, 0, 5, true);
                foreach($modes as $index=>$mode):
                    
                    if($index==4){
                        echo '<br>';
                    } 

                    if($mode->mode == 'booking'){
                        echo ucfirst($mode->mode).':'.' <span>'.number_format(round($mode->amount)).'/=</span>, ';    
                    }

                    if($mode->mode == 'confirmation'){
                        echo ucfirst($mode->mode).':'.' <span>'.number_format(round($mode->amount)).'/=</span>, ';    
                    }

                    if($mode->mode == 'allocation'){
                        echo ucfirst($mode->mode).':'.' <span>'.number_format(round($mode->amount)).'/=</span>, ';    
                    }

                    //echo $mode->mode;

                    if($mode->mode == 'monthly'){
                        $mode->mode = 'Monthly (<span class="calc">36x'.(number_format((float)$mode->amount/36, 1, '.', '')).'/=)</span>';
                        $modeAmount = round($mode->amount);
                        echo ucfirst($mode->mode).':'.' <span>'.number_format($modeAmount).'/=</span>, ';    
                    }

                    if($mode->mode == 'yearly'){
                        $mode->mode = 'Half Yearly (<span class="calc">6x'.(number_format((float)$mode->amount/6, 1, '.', '')).'/=)</span>';
                        if($plot->discount > 0) {
                            $modeAmount = round($mode->amount);
                            //$discount = $plot->discount;
                            //$finalAmount = $modeAmount - $discount;
                            echo ucfirst($mode->mode).':'.' <span>'.number_format($modeAmount).'/=</span>, ';    
                        } else{
                            $modeAmount = round($mode->amount);
                            echo ucfirst($mode->mode).':'.' <span>'.number_format($modeAmount).'/=</span>, ';    
                        }
                        
                    }
                    if($mode->mode == 'possession'){
                        if($plot->discount > 0) {
                            $modeAmount = round($mode->amount);
                            $discount = $plot->discount;
                            $finalAmount = $modeAmount - $discount;
                            echo ucfirst($mode->mode).':'.' <span>'.number_format($finalAmount).'/=</span>, ';    
                        } else{
                            $modeAmount = round($mode->amount);
                            echo ucfirst($mode->mode).':'.' <span>'.number_format($modeAmount).'/=</span>, ';    
                        }
                        
                    } 
                    
                    
                endforeach;
            }
        }
            ?>
            Extra charges: <span class="customSpan"><?php echo number_format($extraCost)?>/=</span>.
            <?php $plotTotal = $plotTotal+$extraCost;?>
            <br><br>
            <?php /*if($plot->discount > 0) {?>
                Discount <span class="customSpan"><?php echo number_format($plot->discount)?>/=</span><br>
            <?php }*/?>
            Total cost of land: <span class="customSpan"><?php echo ' PKR '.number_format($plotTotal)?>/=</span><br>
            Total cost of land in words: &nbsp;<span class="customSpan"><?php echo $this->getIndianCurrency($plotTotal)?></span><br>
            
            Extra land charges (if any): <span class="customSpan"><?php echo @$extraCharge?> </span>.
            <br>
            
            <br>
            I/we, the undersigned do hereby accept, confirm, affirm and agree to pay the total cost of land and/or any other extra land charges on demarcation of the plot as mentioned above for the afore said plot in Kainat City, Scheme 45 Karachi on the Terms and Conditions mentioned on the reverse.
            <br>
            
            <div class="row">
                <div class="col-md-12">
                    <br><br>
                    <br><div style="display: initial;margin-left: 0%;text-decoration: overline;">
                    Signature & Thumb of Allotee : <span></span> <div style="display: initial;margin-left: 28%;text-decoration: overline;">For Essa Housing<span></span></div>
                </div>
            </div>
            <div class="col-md-12" style="display:flex">
                <div >
                    <?php if($is_orig == 1){?>
                    Applicant Name: <span style="width:auto;"><?php echo $plot->customerPlots[0]->customer->name?></span> 
                    <?php } else{?>
                        Applicant Name: <span style="width:auto;"><?php echo $plot->customerPlotsOld[0]->customer->name?></span> 
                    <?php }?>
                </div>
             <div  style="margin-left:38%">
                 <?php if($is_orig == 1){?>
                    Dated: <span style="width:auto"><?php echo date('d M, o',strtotime($plot->customerPlots[0]->createdOn))?></span>
                <?php } else{?>
                    Dated: <span style="width:auto"><?php echo date('d M, o',strtotime($plot->customerPlotsOld[0]->createdOn))?></span>
                <?php }?>
                
             </div>
            </div>
            
            
                                
        </div>
    </div>
    <div class="pagebreak"> </div>
    <?php 
        $cornerCharger = 0;
        $parkFacing = 0;
        $westOpen = 0;
        $extraCharge = 0;
        $plotTotal = $plot->total;
        $plotTotalExtra = $plotTotal;
        $extraCost = 0;
        if($plot->discount > 0) {
            $plotTotal = $plotTotalExtra = $plotTotal - $plot->discount;
        }

        if($plot->is_corner == 1){
            $cornerCharger = $this->Percentage($plotTotal,$plot->is_corner_amount,0);
            $plotTotalExtra = $plotTotal + $cornerCharger;
            $extraCost = $extraCost + $cornerCharger;
        }

        if($plot->is_park_facing == 1){
            $parkFacing = $this->Percentage($plotTotalExtra,$plot->is_park_facing_amount,0);
            $plotTotalExtra = $plotTotalExtra + $parkFacing;
            $extraCost = $extraCost + $parkFacing;
        }

        if($plot->is_west_open == 1){
            $westOpen = $this->Percentage($plotTotalExtra,$plot->is_west_open_amount,0);
            $plotTotalExtra = $plotTotalExtra + $westOpen;
            $extraCost = $extraCost + $westOpen;
        }

        //if($plot->is_road_facing == 1){
        $extraCharge = 'PKR '.number_format(@$plotTotalExtra/(str_replace(' SQ Yrd','',$plot->size->size))).' per SQ Yrd';
        //}
    ?>
    <div class="main container">
        <div class="container content">
            Block: <span class="customSpan"><?php echo @$plot->block_number?></span>, Plot Type: <span class="customSpan"><?php echo @$plot->plot_type?></span>, Plot No:<span class="customSpan"><?php echo @$plot->plot_number?></span>, Admeasuring: <span><?php echo @$plot->size->size?></span>, Category: <span><?php echo @$plot->category->name?></span> 
            <br><br>
            Cost of Land: <span class="customSpan">PKR <?php echo number_format($plot->total)?>/=</span>
            <?php if($plot->discount > 0) {?>
                <?php $plotTotalD = $plot->total - $plot->discount?>
                &nbsp;&nbsp;, Discount: <span class="customSpan"><?php echo ' PKR '.number_format($plot->discount)?>/=</span>, Discounted Cost of Land: <span class="customSpan"><?php echo 'PKR '.number_format($plotTotalD)?>/=</span><br>
                
            <?php }?>
            <br>
            Corner Charges: <span><?php echo ($cornerCharger!=0)?(number_format($cornerCharger).'/='):'N/A'?></span>, Park Facing Charges: <span><?php echo ($parkFacing!=0)?(number_format($parkFacing).'/='):'N/A'?></span>, West Open Charges: <span><?php echo ($westOpen!=0)?(number_format($westOpen).'/='):'N/A'?></span>.
            <br><br>
            <?php 


            $modes = PaymentSchedulePaymentModes::model()->findAll('payment_schedule_id = :id AND plot_type = :type',array(':id'=>$booking->is_special,':type'=>strtolower($booking->plot->plot_type)));
            $displayP = 0;
            foreach($modes as $index=>$mode):
                
                if($mode->mode=='possession'){
                    if($plot->discount > $mode->amount ){
                        $displayP = 0;
                    } else{
                        $displayP = 1;
                    }
                }
            endforeach;

            if($displayP == 1){
            ?>
            <h5>PAYMENT BREAKUP (PKR)</h5>
            <?php
            //echo '<pre>';print_r($booking);exit;
            
            
            if($modes){
                //$modes = array_slice($plot->size->paymentModes, 0, 5, true);
                foreach($modes as $index=>$mode):
                    
                    if($index==4){
                        echo '<br>';
                    } 

                    if($mode->mode == 'booking'){
                        echo ucfirst($mode->mode).':'.' <span>'.number_format(round($mode->amount)).'/=</span>, ';    
                    }

                    if($mode->mode == 'confirmation'){
                        echo ucfirst($mode->mode).':'.' <span>'.number_format(round($mode->amount)).'/=</span>, ';    
                    }

                    if($mode->mode == 'allocation'){
                        echo ucfirst($mode->mode).':'.' <span>'.number_format(round($mode->amount)).'/=</span>, ';    
                    }

                    //echo $mode->mode;

                    if($mode->mode == 'monthly'){
                        $mode->mode = 'Monthly (<span class="calc">36x'.(number_format((float)$mode->amount/36, 1, '.', '')).'/=)</span>';
                        $modeAmount = round($mode->amount);
                        echo ucfirst($mode->mode).':'.' <span>'.number_format($modeAmount).'/=</span>, ';    
                    }

                    if($mode->mode == 'yearly'){
                        $mode->mode = 'Half Yearly (<span class="calc">6x'.(number_format((float)$mode->amount/6, 1, '.', '')).'/=)</span>';
                        if($plot->discount > 0) {
                            $modeAmount = round($mode->amount);
                            //$discount = $plot->discount;
                            //$finalAmount = $modeAmount - $discount;
                            echo ucfirst($mode->mode).':'.' <span>'.number_format($modeAmount).'/=</span>, ';    
                        } else{
                            $modeAmount = round($mode->amount);
                            echo ucfirst($mode->mode).':'.' <span>'.number_format($modeAmount).'/=</span>, ';    
                        }
                        
                    }
                    if($mode->mode == 'possession'){
                        if($plot->discount > 0) {
                            $modeAmount = round($mode->amount);
                            $discount = $plot->discount;
                            $finalAmount = $modeAmount - $discount;
                            echo ucfirst($mode->mode).':'.' <span>'.number_format($finalAmount).'/=</span>, ';    
                        } else{
                            $modeAmount = round($mode->amount);
                            echo ucfirst($mode->mode).':'.' <span>'.number_format($modeAmount).'/=</span>, ';    
                        }
                        
                    } 
                    
                    
                endforeach;
            }
        }
            ?>
            Extra charges: <span class="customSpan"><?php echo number_format($extraCost)?>/=</span>.
            <?php $plotTotal = $plotTotal+$extraCost;?>
            <br><br>
            <?php /*if($plot->discount > 0) {?>
                Discount <span class="customSpan"><?php echo number_format($plot->discount)?>/=</span><br>
            <?php }*/?>
            Total cost of land: <span class="customSpan"><?php echo ' PKR '.number_format($plotTotal)?>/=</span><br>
            Total cost of land in words: &nbsp;<span class="customSpan"><?php echo $this->getIndianCurrency($plotTotal)?></span><br>
            
            Extra land charges (if any): <span class="customSpan"><?php echo @$extraCharge?> </span>.
            <br>
            
            <br>
            I/we, the undersigned do hereby accept, confirm, affirm and agree to pay the total cost of land and/or any other extra land charges on demarcation of the plot as mentioned above for the afore said plot in Kainat City, Scheme 45 Karachi on the Terms and Conditions mentioned on the reverse.
            <br>
            
            <div class="row">
                <div class="col-md-12">
                    <br><br>
                    <br><div style="display: initial;margin-left: 0%;text-decoration: overline;">
                    Signature & Thumb of Allotee : <span></span> <div style="display: initial;margin-left: 28%;text-decoration: overline;">For Essa Housing<span></span></div>
                </div>
            </div>
            <div class="col-md-12" style="display:flex">
                <div >
                    <?php if($is_orig == 1){?>
                    Applicant Name: <span style="width:auto;"><?php echo $plot->customerPlots[0]->customer->name?></span> 
                    <?php } else{?>
                        Applicant Name: <span style="width:auto;"><?php echo $plot->customerPlotsOld[0]->customer->name?></span> 
                    <?php }?>
                </div>
             <div  style="margin-left:38%">
                 <?php if($is_orig == 1){?>
                    Dated: <span style="width:auto"><?php echo date('d M, o',strtotime($plot->customerPlots[0]->createdOn))?></span>
                <?php } else{?>
                    Dated: <span style="width:auto"><?php echo date('d M, o',strtotime($plot->customerPlotsOld[0]->createdOn))?></span>
                <?php }?>
                
             </div>
            </div>
            
            
                                
        </div>
    </div>
</body>
</html>