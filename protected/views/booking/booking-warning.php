<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cancellation Warning</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <style>
        .main {
            width: 730px;
            height: 912px;
            /* border: 2px solid black; */
            padding: 35px;
            padding-right: 0px;
            /* border: 2px solid; */
        }
        
        .content {
            text-align: justify;
            line-height: 30px;
        }
        
        span {
            display: inline-block;
            /*width: 80px;*/
            width: auto;
            /*border-bottom: 1px solid black;*/
            text-decoration: underline;
            text-align: center;
            font-weight: bold;
            padding-right: 10px;
            padding-left: 10px;
        }
        
        td {
            padding: 3px 15px;
            /* border: 1px solid black; */
        }
        
        .right {
            text-align: right;
        }
        
        .center h6 {
            text-align: center;
        }
        
        .pagebreak {
            page-break-before: always!important;
        }
        /* page-break-after works, as well */
        /* For Terms And COnditions */
        
        .mainYY {
            width: 820px;
            height: 842px;
            font-size: 10px!important;
            margin: 0px auto;
            /* border: 2px solid black; */
            /* padding-top: 275px; */
        }
        
        span.terms {
            display: inline-block;
            width: 70px;
            border-bottom: 1px solid white;
        }
        
        td.terms {
            padding: 1px 15px;
            border: 1px solid white;
            line-height: 5px;
        }
        
        .mainYY ol {
            margin-left: 0px;
            padding-left: 9px;
        }
        
        .mainYY p,
        .mainYY li {
            margin-bottom: 5px!important;
            font-size: 10px!important;
            line-height: 16px;
            font-family: Arial, Helvetica, sans-serif;
        }
        
        .abs {
            position: absolute;
            top: 40px;
            right: 30px;
        }
        /* ESSA FOM STYLES */
        
        .logo-1 {
            width: 170px;
        }
        
        .logo-2 {
            width: 425px;
        }
        
        .foot-logo {
            width: 70px;
        }
        
        .space {
            margin-top: 358px;
        }
        
        .form-sec {
            width: 100%;
        }
        
        .sign-box div,
        .tag {
            background: black;
            color: white;
        }
        
        .sign-box {
            width: 250px;
            height: 80px;
            border: 2px solid;
            display: flex;
            align-items: end;
        }
        
        .sign-box div {
            width: 100%;
            text-align: center;
            font-size: 12px;
        }
        
        .tag {
            width: fit-content;
            padding: 6px;
            font-size: 12px;
        }
        
        table {
            border: none!important;
        }
        
        td {
            border: none!important;
        }
        
        .brdr {
            border: 2px solid!important;
        }
        
        .pad-0 {
            padding-left: 0px;
            padding-right: 0px;
        }
        
        p,
        td {
            font-size: 14px;
            text-align: justify;
            color: #000/*#1A5276*/;
        }
        /* ESSA FOM STYLES */
        b{
            font-weight: 700!important;
        }
        .pagebreak { 
            page-break-before: always; 
        } /* page-break-after works, as well */

    </style>
</head>
<?php
//echo '<pre>';print_r($oldLetters);exit;
?>
<body>
    <div class="main container" style="padding-top: 160px;">
        <div style="text-align: center;border: 2px solid #000/*#1A5276*/;border-radius: 5px;margin-left: 35%;position: absolute;top: 8%;font-size: 20px;padding: 10px;font-weight: bold;color:#000/*#1A5276*/">Record Copy</div>
        <table class="form-sec">
            <tr>
                <td class="pad-0"><b><u>Ref : <?php echo $wlNumber//$this->getWarningLetterNo(@$booking->id)?></u></b></td>
                <td class="pad-0" style=""><b><u>Dated : <?php echo date('l', strtotime(date('Y-m-d')))?>, <?php echo date('F d, Y')?></u></b></td>
            </tr>
        </table>
        <table class="form-sec">
            <tr>
                <td class="pad-0">
                    <b>TO,</b> <br> <?php echo ucfirst(@$booking->customer->name)?> <br> Contact No.: <?php echo ucfirst(@$booking->customer->mobile)?> <br> <?php echo ucfirst(@$booking->customer->address)?> <br>

                </td>
            </tr>
        </table>
        
        <table class="form-sec" style="margin-top: -5px;">
            <tr>
                <td class="pad-0" style="text-align: center;"><b><u>Subject: Warning to pay outstanding Dues against Plot: (<b><?php echo @$booking->plot->plot_type?></b>-<b><?php echo @$booking->plot->plot_number?></b>) in Block (<b><?php echo @$booking->plot->block_number?></b>)</b></td>
            </tr>
        </table>
        
        <table class="form-sec">
            <tr>
                <td class="pad-0">
                    <p>
                        Dear <?php echo ucfirst(@$booking->customer->name)?>,
                    </p>
                    <p style="margin-top:-10px">
                        We are writing this letter to bring your attention that you have not paid <b><u><?php echo $monthly?></u></b> Monthly Installments against your <b><u><?php echo @$booking->plot->category->name?></u></b> Plot bearing Registration Number. <b><u><?php echo $this->getBookingRegNo($booking->id)?></u></b>, Block. <b><u><?php echo @$booking->plot->block_number?></u></b>, Plot Type. <b><u><?php echo @$booking->plot->plot_type?></u></b>, Plot
                        No. <b><u><?php echo @$booking->plot->plot_number?></u></b>, admeasuring <b><u><?php echo @$booking->plot->size->size?></u></b> in Kainat City, Karachi.
                    </p>
                    <p style="margin-top:-10px">
                        Please note that the outstanding payment for above mention plot is PKR <b><u><?php echo number_format(ceil(@$amount))?></u></b> (<?php echo ucwords($this->getIndianCurrency(ceil($amount)))?>). Kindly, pay your Remaining dues by date: <b><u><?php echo date('F d, Y', strtotime($date))?></u></b>.
                    </p>
                    <?php if(count($oldLetters) > 0){?>
                    <p style="margin-top:-10px">
                        You must consider this as formal final warning from our side as we have sent you warning letter/s earlier through TCS (details provided in table below), after which we would be forced to take difficult decision. 

                        <div class="col-lg-12">
                        <?php if($oldLetters){?>
                        <!-- <h6 style="text-transform: UPPERCASE;font-weight: bold;">Warning Letters</h6>  -->                       
                        <div class="col-lg-12" style="padding-left: 0px;">
                            <table width="100%" border="2" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="font-size: 10px;">Reference #</th>
                                        <th style="font-size: 10px;">Letter Date</th>
                                        <th style="font-size: 10px;">Tracking ID</th>
                                        <th style="font-size: 10px;">Received By</th>
                                        <th style="font-size: 10px;">Received Date</th>
                                    </tr>
                                </thead>   
                                <tbody>
                                    <?php foreach($oldLetters as $letter):?>
                                    <tr style="background-color: lightgray;">
                                        <td style="font-size: 10px;"><b><?php echo @$letter->reference_number?></b></td>
                                        <td style="font-size: 10px;"><b><?php echo date('d M,Y',strtotime(@$letter->createdOn))?></b></td>
                                        <td style="font-size: 10px;"><b><?php echo @$letter->tracking_id?></b></td>
                                        <td style="font-size: 10px;"><b><?php echo @$letter->received_by?></b></td>
                                        <td style="font-size: 10px;"><b><?php echo ($letter->received_on)?date('d M,Y',strtotime(@$letter->received_on)):''?></b></td>
                                        
                                    </tr>
                                    <?php endforeach;?>
                                </tbody>
                            </table>
                        </div>
                        <?php }?>
                    </div>




                        In case of non-payment of outstanding dues your above mentioned plot will be cancelled by the Company.
                    </p>
                    <?php } else{?>
                        <p style="margin-top:-10px">
                        You can consider this as the last and formal warning from our side, after which we would be forced to take difficult decision. In case of non-payment of outstanding dues your above mentioned plot will be cancelled by the Company.
                    </p>
                    <?php }?>
                    
                    <p style="margin-top:-10px">
                        As courtesy for our allottee we do accept online payment options. If you chose to pay your outstanding balance with this option please contact <b><u>ESSA Housing Head Office (0336-4684681)</u></b> for further details.
                    </p>
                    <p style="margin-top:-10px">
                        If you have already paid your payment, please accept our thanks and apologies for any inconvenience this may have caused.
                    </p>
                    <p style="margin-top:-10px">
                        Thank you for choosing KAINAT CITY for your dream land. Assuring you of our best services.
                    </p>

                    
                    <p>
                        <b>Sincerely</b> <br> For Essa Housing
                    </p>
                    <br/><br/>
                    <p>
                        <b>MANAGER</b>
                    </p>
                </td>
            </tr>
        </table>
    </div>

    <div class="pagebreak"></div>
    <div class="main container" style="padding-top: 160px;">
        <table class="form-sec">
            <tr>
                <td class="pad-0"><b><u>Ref : <?php echo $wlNumber//$this->getWarningLetterNo(@$booking->id)?></u></b></td>
                <td class="pad-0" style=""><b><u>Dated : <?php echo date('l', strtotime(date('Y-m-d')))?>, <?php echo date('F d, Y')?></u></b></td>
            </tr>
        </table>
        <table class="form-sec">
            <tr>
                <td class="pad-0">
                    <b>TO,</b> <br> <?php echo ucfirst(@$booking->customer->name)?> <br> Contact No.: <?php echo ucfirst(@$booking->customer->mobile)?> <br> <?php echo ucfirst(@$booking->customer->address)?> <br>

                </td>
            </tr>
        </table>
        
        <table class="form-sec" style="margin-top: -5px;">
            <tr>
                <td class="pad-0" style="text-align: center;"><b><u>Subject: Warning to pay outstanding Dues against Plot: (<b><?php echo @$booking->plot->plot_type?></b>-<b><?php echo @$booking->plot->plot_number?></b>) in Block (<b><?php echo @$booking->plot->block_number?></b>)</b></td>
            </tr>
        </table>
        
        <table class="form-sec">
            <tr>
                <td class="pad-0">
                    <p>
                        Dear <?php echo ucfirst(@$booking->customer->name)?>,
                    </p>
                    <p style="margin-top:-10px">
                        We are writing this letter to bring your attention that you have not paid <b><u><?php echo $monthly?></u></b> Monthly Installments against your <b><u><?php echo @$booking->plot->category->name?></u></b> Plot bearing Registration Number. <b><u><?php echo $this->getBookingRegNo($booking->id)?></u></b>, Block. <b><u><?php echo @$booking->plot->block_number?></u></b>, Plot Type. <b><u><?php echo @$booking->plot->plot_type?></u></b>, Plot
                        No. <b><u><?php echo @$booking->plot->plot_number?></u></b>, admeasuring <b><u><?php echo @$booking->plot->size->size?></u></b> in Kainat City, Karachi.
                    </p>
                    <p style="margin-top:-10px">
                        Please note that the outstanding payment for above mention plot is PKR <b><u><?php echo number_format(ceil(@$amount))?></u></b> (<?php echo ucwords($this->getIndianCurrency(ceil($amount)))?>). Kindly, pay your Remaining dues by date: <b><u><?php echo date('F d, Y', strtotime($date))?></u></b>.
                    </p>
                    <?php if(count($oldLetters) > 0){?>
                    <p style="margin-top:-10px">
                        You must consider this as formal final warning from our side as we have sent you warning letter/s earlier through TCS (details provided in table below), after which we would be forced to take difficult decision. 

                        <div class="col-lg-12">
                        <?php if($oldLetters){?>
                        <!-- <h6 style="text-transform: UPPERCASE;font-weight: bold;">Warning Letters</h6>  -->                       
                        <div class="col-lg-12" style="padding-left: 0px;">
                            <table width="100%" border="2" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="font-size: 10px;">Reference #</th>
                                        <th style="font-size: 10px;">Letter Date</th>
                                        <th style="font-size: 10px;">Tracking ID</th>
                                        <th style="font-size: 10px;">Received By</th>
                                        <th style="font-size: 10px;">Received Date</th>
                                    </tr>
                                </thead>   
                                <tbody>
                                    <?php foreach($oldLetters as $letter):?>
                                    <tr style="background-color: lightgray;">
                                        <td style="font-size: 10px;"><b><?php echo @$letter->reference_number?></b></td>
                                        <td style="font-size: 10px;"><b><?php echo date('d M,Y',strtotime(@$letter->createdOn))?></b></td>
                                        <td style="font-size: 10px;"><b><?php echo @$letter->tracking_id?></b></td>
                                        <td style="font-size: 10px;"><b><?php echo @$letter->received_by?></b></td>
                                        <td style="font-size: 10px;"><b><?php echo ($letter->received_on)?date('d M,Y',strtotime(@$letter->received_on)):''?></b></td>
                                        
                                    </tr>
                                    <?php endforeach;?>
                                </tbody>
                            </table>
                        </div>
                        <?php }?>
                    </div>




                        In case of non-payment of outstanding dues your above mentioned plot will be cancelled by the Company.
                    </p>
                    <?php } else{?>
                        <p style="margin-top:-10px">
                        You can consider this as the last and formal warning from our side, after which we would be forced to take difficult decision. In case of non-payment of outstanding dues your above mentioned plot will be cancelled by the Company.
                    </p>
                    <?php }?>
                    
                    <p style="margin-top:-10px">
                        As courtesy for our allottee we do accept online payment options. If you chose to pay your outstanding balance with this option please contact <b><u>ESSA Housing Head Office (0336-4684681)</u></b> for further details.
                    </p>
                    <p style="margin-top:-10px">
                        If you have already paid your payment, please accept our thanks and apologies for any inconvenience this may have caused.
                    </p>
                    <p style="margin-top:-10px">
                        Thank you for choosing KAINAT CITY for your dream land. Assuring you of our best services.
                    </p>

                    
                    <p>
                        <b>Sincerely</b> <br> For Essa Housing
                    </p>
                    <br/><br/>
                    <p>
                        <b>MANAGER</b>
                    </p>
                </td>
            </tr>
        </table>
    </div>

    <script type="text/javascript">
        window.print();
    </script> 


</body>

</html>