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
            width: 710px;
            height: 912px;
            /* border: 2px solid black; */
            padding: 35px;
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
            font-size: 13px;
            text-align: justify;
        }
        /* ESSA FOM STYLES */
    </style>
</head>

<body>
    <div class="main container" style="padding-top: 190px;">
        <table class="form-sec">
            <tr>
                <td class="pad-0">Ref : Booking/Warning/<?php echo $this->numberToRoman(($plot_letter)?$plot_letter->id+1:1)?>/KC</td>
                <td class="pad-0" style="text-align: right;">Dated : <?php echo date('l', strtotime(date('Y-m-d')))?>, <?php echo date('F d, Y')?></td>
            </tr>
        </table>
        <table class="form-sec">
            <tr>
                <td class="pad-0">
                    <b>TO,</b> <br> <?php echo ucfirst(@$booking->customer->name)?> <br> Contact No.: <?php echo ucfirst(@$booking->customer->mobile)?> <br> <?php echo ucfirst(@$booking->customer->address)?> <br>

                </td>
            </tr>
        </table>
        <table class="form-sec" style="margin-top: 4px;">
            <tr>
                <td class="pad-0" style="text-align: center;"><b>Subject: Warning to pay outstanding Dues against Plot: (<b><?php echo @$booking->plot->plot_type?></b>-<b><?php echo @$booking->plot->plot_number?></b>) in Block (<b><?php echo @$booking->plot->block_number?></b>)</b></td>
            </tr>
        </table>
        <table class="form-sec">
            <tr>
                <td class="pad-0">
                    <p>
                        Dear <?php echo ucfirst(@$booking->customer->name)?>,
                    </p>
                    <p>
                        We are writing this letter to bring your attention that you have not paid (no of unpaid monthly installments) Monthly Installments against your (Residential/Commercial) Plot bearing Registration Number. <b><?php echo $this->getBookingRegNo($booking->id)?></b>, Block. <b><?php echo @$booking->plot->block_number?></b>, Plot Type. <b><?php echo @$booking->plot->plot_type?></b>, Plot
                        No. <b><?php echo @$booking->plot->plot_number?></b>, admeasuring <b><?php echo @$booking->plot->size->size?></b> in Kainat City, Karachi.
                    </p>
                    <p>
                        Please note that the outstanding payment for above mention plot is PKR _______ (Amount in word). Kindly, pay your Remaining dues by date: _______________.
                    </p>
                    <p>
                        You can consider this as the last and formal warning from our side, after which we would be forced to take difficult decision. In case of non-payment of outstanding dues your above mentioned plot will be cancelled by the Company.
                    </p>
                    <p>
                        As courtesy for our allottee we do accept online payment options. If you chose to pay your outstanding balance with this option please contact Mr. Amir on 0322-2400467 for further details.
                    </p>
                    <p>
                        If you have already paid your payment, please accept our thanks and apologies for any inconvenience this may have caused.
                    </p>
                    <p>
                        Thank you for choosing KAINAT CITY for your dream land. Assuring you of our best services.
                    </p>
                    <p>
                        <b>Sincerely</b> <br> For Essa Housing
                    </p>
                    <p>
                        <b>MANAGER</b>
                    </p>
                </td>
            </tr>
        </table>
    </div>

    <!-- <script type="text/javascript">
        window.print();
    </script> -->


</body>

</html>