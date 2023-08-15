<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transfer of Booking</title>
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
            font-size: 14px;
            text-align: justify;
        }
        /* ESSA FOM STYLES */

        .pagebreak { 
            page-break-before: always; 
        } /* page-break-after works, as well */
    </style>
</head>

<body>
    <div class="main container" style="padding-top: 110px;">
        <table class="form-sec">
            <tr>
                <td class="pad-0">Ref : <u><?php echo $this->getBookingRegNo($booking->id)?>/ST-<?php echo $this->numberToRoman($plot_letter+1)?></u></td>
                <td class="pad-0" style="text-align: right;">Dated : <u><?php echo date('l', strtotime(date('Y-m-d')))?>, <?php echo date('F d, Y')?></u></td>
            </tr>
        </table>
        <table class="form-sec">
            <tr>
                <td class="pad-0">
                    <?php echo ucfirst(@$booking->customer->name)?> <br><?php echo ucfirst(@$booking->agent_name)?>  <?php echo ucfirst(@$booking->customer->father_husband_name)?> <br> <div style="width:50%"><?php echo ucfirst(@$booking->customer->address)?></div> <br>

                </td>
            </tr>
        </table>
        <table class="form-sec" style="margin-top: 4px;">
            <tr>
                <td class="pad-0" style="text-align: center;"><b>Subject: <u>TRANSFER OF BOOKING/RESERVATION OF PLOT</u></b></td>
            </tr>
        </table>
        <table class="form-sec">
            <tr>
                <td class="pad-0">
                    <p>
                        Dear Sir/Madam/Miss,
                    </p>
                    <p>
                        We are pleased to inform you that your application dated <u><b><?php echo date('F d, Y',strtotime($booking->plot->customerPlotTransfersRecent[0]->createdOn))?></b></u> for transfer of Reservation/Booking/Allotment of a <u><b><?php echo @$booking->plot->category->name?></b></u> Plot of Land bearing Registration Number. <u><b><?php echo $this->getBookingRegNo($booking->id)?></b></u>, Block. <u><b><?php echo @$booking->plot->block_number?></b></u>, Plot Type. <u><b><?php echo @$booking->plot->plot_type?></b></u>, Plot No. <u><b><?php echo @$booking->plot->plot_number?></b></u>, admeasuring
                        <u><b><?php echo @$booking->plot->size->size?></b></u> in <u><b>Kainat City</b></u>, Karachi has been accepted.
                    </p>
                    <p>
                        Please note that this Transfer of Booking/Reservation/Allotment is being made on your unequivocal acceptance of the terms and conditions applicable on your predecessor(s) in interest and in addition Thereto, which you have also duly agreed, accepted and
                        signed and/or as prescribed/revised by the Company from time to time at its sole discretion.
                    </p>
                    <p>
                        The Expiry Date of Lease to be executed in your favor shall be 31st December 2120, irrespective of the date of registration of Lease Deed. The expiry date may be extended on such payments and/or such conditions as the Company may decide at its sole discretion
                        from time to time, but not exceeding 99years from the date of actual registration of lease.
                    </p>
                    <p>Assuring you of our best services.</p>
                </td>
            </tr>
        </table>
        <table class="form-sec" style="width: 100%;">
            <tr>
                <td class="pad-0" style="position: relative;top: -100px;">&nbsp;<br> <br> <br> Truly yours <br> <b>For Essa Housing</b> </td>
                <td class="pad-0">
                    <table style="width: 100%;">
                        <tr>
                            <td style="vertical-align: bottom;position: relative;left: 15%;">
                                <span style="border-bottom: 1px solid; width: 180px;"></span><br> Signature & Tumb Impression <br> of Transferee
                            </td>
                            <td class="pad-0" style="display: flex; justify-content: end;">
                                <div style="width: 160px; height: 200px; border: 1px solid;">
                                    <img style="width: 100%;" src="<?php echo Yii::app()->baseUrl?>/uploads/booking/<?php echo $booking->agent_cnic?>" alt="..." class="img-thumbnail">
                                </div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <table class="form-sec" style="width: 100%;">
            <tr>
                <td class="pad-0" style="vertical-align: top;position: relative;top: -50px;width: 40%;"><b>Director</b><br/>Copy To: Transferor for record<br/><?php echo 'Mr./Mrs./Ms.  <u><b>'.@$booking->plot->customerPlotTransfersRecent[0]->oldCustomer->name.'</b></u>'?><div style="font-size:12px;width: 90%;margin-top: -2%;"><p style="font-size: 12px!important;"><?php echo @$booking->agent_name?>&nbsp;:&nbsp;<b><u><?php echo @$booking->plot->customerPlotTransfersRecent[0]->oldCustomer->father_husband_name?></u></b></p></div></td>
                <td class="pad-0" style="margin-top:-20%">
                    <div style="margin-top:-10%"><b>CNIC NO.</b></div>
                    <table style="width: 100%; margin-right: -30px">
                        <tr>
                            <td style="border: 1px solid!important; width: 5px; padding: 0px; height: 30px;text-align: center!important;"><?php echo $booking->customer->cnic[0]?></td>
                            <td style="border: 1px solid!important; width: 5px; padding: 0px; height: 30px;text-align: center!important;"><?php echo $booking->customer->cnic[1]?></td>
                            <td style="border: 1px solid!important; width: 5px; padding: 0px; height: 30px;text-align: center!important;"><?php echo $booking->customer->cnic[2]?></td>
                            <td style="border: 1px solid!important; width: 5px; padding: 0px; height: 30px;text-align: center!important;"><?php echo $booking->customer->cnic[3]?></td>
                            <td style="border: 1px solid!important; width: 5px; padding: 0px; height: 30px;text-align: center!important;"><?php echo $booking->customer->cnic[4]?></td>
                            <td style="border: 1px solid!important; width: 5px; padding: 0px; height: 30px;text-align: center!important;"><?php echo $booking->customer->cnic[5]?></td>
                            <td style="border: 1px solid!important; width: 5px; padding: 0px; height: 30px;text-align: center!important;"><?php echo $booking->customer->cnic[6]?></td>
                            <td style="border: 1px solid!important; width: 5px; padding: 0px; height: 30px;text-align: center!important;"><?php echo $booking->customer->cnic[7]?></td>
                            <td style="border: 1px solid!important; width: 5px; padding: 0px; height: 30px;text-align: center!important;"><?php echo $booking->customer->cnic[8]?></td>
                            <td style="border: 1px solid!important; width: 5px; padding: 0px; height: 30px;text-align: center!important;"><?php echo $booking->customer->cnic[9]?></td>
                            <td style="border: 1px solid!important; width: 5px; padding: 0px; height: 30px;text-align: center!important;"><?php echo $booking->customer->cnic[10]?></td>
                            <td style="border: 1px solid!important; width: 5px; padding: 0px; height: 30px;text-align: center!important;"><?php echo $booking->customer->cnic[11]?></td>
                            <td style="border: 1px solid!important; width: 5px; padding: 0px; height: 30px;text-align: center!important;"><?php echo $booking->customer->cnic[12]?></td>
                            <td style="border: 1px solid!important; width: 5px; padding: 0px; height: 30px;text-align: center!important;"><?php echo $booking->customer->cnic[13]?></td>
                            <td style="border: 1px solid!important; width: 5px; padding: 0px; height: 30px;text-align: center!important;"><?php echo $booking->customer->cnic[14]?></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>

    <div class="pagebreak"></div>
    <div class="main container" style="padding-top: 110px;">
        <div style="text-align: center;border: 2px solid #000;border-radius: 5px;margin-left: 35%;position: absolute;top: 3%;font-size: 30px;padding: 10px;font-weight: bold;">Duplicate</div>
        <table class="form-sec">
            <tr>
                <td class="pad-0">Ref : <u><?php echo $this->getBookingRegNo($booking->id)?>/ST-<?php echo $this->numberToRoman($plot_letter+1)?></u></td>
                <td class="pad-0" style="text-align: right;">Dated : <u><?php echo date('l', strtotime(date('Y-m-d')))?>, <?php echo date('F d, Y')?></u></td>
            </tr>
        </table>
        <table class="form-sec">
            <tr>
                <td class="pad-0">
                    <?php echo ucfirst(@$booking->customer->name)?> <br><?php echo ucfirst(@$booking->agent_name)?>  <?php echo ucfirst(@$booking->customer->father_husband_name)?> <br> <div style="width:50%"><?php echo ucfirst(@$booking->customer->address)?></div> <br>

                </td>
            </tr>
        </table>
        <table class="form-sec" style="margin-top: 4px;">
            <tr>
                <td class="pad-0" style="text-align: center;"><b>Subject: <u>TRANSFER OF BOOKING/RESERVATION OF PLOT</u></b></td>
            </tr>
        </table>
        <table class="form-sec">
            <tr>
                <td class="pad-0">
                    <p>
                        Dear Sir/Madam/Miss,
                    </p>
                    <p>
                        We are pleased to inform you that your application dated <u><b><?php echo date('F d, Y',strtotime($booking->plot->customerPlotTransfersRecent[0]->createdOn))?></b></u> for transfer of Reservation/Booking/Allotment of a <u><b><?php echo @$booking->plot->category->name?></b></u> Plot of Land bearing Registration Number. <u><b><?php echo $this->getBookingRegNo($booking->id)?></b></u>, Block. <u><b><?php echo @$booking->plot->block_number?></b></u>, Plot Type. <u><b><?php echo @$booking->plot->plot_type?></b></u>, Plot No. <u><b><?php echo @$booking->plot->plot_number?></b></u>, admeasuring
                        <u><b><?php echo @$booking->plot->size->size?></b></u> in <u><b>Kainat City</b></u>, Karachi has been accepted.
                    </p>
                    <p>
                        Please note that this Transfer of Booking/Reservation/Allotment is being made on your unequivocal acceptance of the terms and conditions applicable on your predecessor(s) in interest and in addition Thereto, which you have also duly agreed, accepted and
                        signed and/or as prescribed/revised by the Company from time to time at its sole discretion.
                    </p>
                    <p>
                        The Expiry Date of Lease to be executed in your favor shall be 31st December 2120, irrespective of the date of registration of Lease Deed. The expiry date may be extended on such payments and/or such conditions as the Company may decide at its sole discretion
                        from time to time, but not exceeding 99years from the date of actual registration of lease.
                    </p>
                    <p>Assuring you of our best services.</p>
                </td>
            </tr>
        </table>
        <table class="form-sec" style="width: 100%;">
            <tr>
                <td class="pad-0" style="position: relative;top: -100px;">&nbsp;<br> <br> <br> Truly yours <br> <b>For Essa Housing</b> </td>
                <td class="pad-0">
                    <table style="width: 100%;">
                        <tr>
                            <td style="vertical-align: bottom;position: relative;left: 15%;">
                                <span style="border-bottom: 1px solid; width: 180px;"></span><br> Signature & Tumb Impression <br> of Transferee
                            </td>
                            <td class="pad-0" style="display: flex; justify-content: end;">
                                <div style="width: 160px; height: 200px; border: 1px solid;">
                                    <img style="width: 100%;" src="<?php echo Yii::app()->baseUrl?>/uploads/booking/<?php echo $booking->agent_cnic?>" alt="..." class="img-thumbnail">
                                </div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <table class="form-sec" style="width: 100%;">
            <tr>
                <td class="pad-0" style="vertical-align: top;position: relative;top: -50px;width: 40%;"><b>Director</b><br/>Copy To: Transferor for record<br/><?php echo 'Mr./Mrs./Ms.  <u><b>'.@$booking->plot->customerPlotTransfersRecent[0]->oldCustomer->name.'</b></u>'?><div style="font-size:12px;width: 90%;margin-top: -2%;"><p style="font-size: 12px!important;"><?php echo @$booking->agent_name?>&nbsp;:&nbsp;<b><u><?php echo @$booking->plot->customerPlotTransfersRecent[0]->oldCustomer->father_husband_name?></u></b></p></div></td>
                <td class="pad-0" style="margin-top:-20%">
                    <div style="margin-top:-10%"><b>CNIC NO.</b></div>
                    <table style="width: 100%; margin-right: -30px">
                        <tr>
                            <td style="border: 1px solid!important; width: 5px; padding: 0px; height: 30px;text-align: center!important;"><?php echo $booking->customer->cnic[0]?></td>
                            <td style="border: 1px solid!important; width: 5px; padding: 0px; height: 30px;text-align: center!important;"><?php echo $booking->customer->cnic[1]?></td>
                            <td style="border: 1px solid!important; width: 5px; padding: 0px; height: 30px;text-align: center!important;"><?php echo $booking->customer->cnic[2]?></td>
                            <td style="border: 1px solid!important; width: 5px; padding: 0px; height: 30px;text-align: center!important;"><?php echo $booking->customer->cnic[3]?></td>
                            <td style="border: 1px solid!important; width: 5px; padding: 0px; height: 30px;text-align: center!important;"><?php echo $booking->customer->cnic[4]?></td>
                            <td style="border: 1px solid!important; width: 5px; padding: 0px; height: 30px;text-align: center!important;"><?php echo $booking->customer->cnic[5]?></td>
                            <td style="border: 1px solid!important; width: 5px; padding: 0px; height: 30px;text-align: center!important;"><?php echo $booking->customer->cnic[6]?></td>
                            <td style="border: 1px solid!important; width: 5px; padding: 0px; height: 30px;text-align: center!important;"><?php echo $booking->customer->cnic[7]?></td>
                            <td style="border: 1px solid!important; width: 5px; padding: 0px; height: 30px;text-align: center!important;"><?php echo $booking->customer->cnic[8]?></td>
                            <td style="border: 1px solid!important; width: 5px; padding: 0px; height: 30px;text-align: center!important;"><?php echo $booking->customer->cnic[9]?></td>
                            <td style="border: 1px solid!important; width: 5px; padding: 0px; height: 30px;text-align: center!important;"><?php echo $booking->customer->cnic[10]?></td>
                            <td style="border: 1px solid!important; width: 5px; padding: 0px; height: 30px;text-align: center!important;"><?php echo $booking->customer->cnic[11]?></td>
                            <td style="border: 1px solid!important; width: 5px; padding: 0px; height: 30px;text-align: center!important;"><?php echo $booking->customer->cnic[12]?></td>
                            <td style="border: 1px solid!important; width: 5px; padding: 0px; height: 30px;text-align: center!important;"><?php echo $booking->customer->cnic[13]?></td>
                            <td style="border: 1px solid!important; width: 5px; padding: 0px; height: 30px;text-align: center!important;"><?php echo $booking->customer->cnic[14]?></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>

    <script type="text/javascript">
        window.print();
    </script>


</body>

</html>