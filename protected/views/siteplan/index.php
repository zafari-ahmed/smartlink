<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site Plan - Booking</title>
    
    <style>
        .main {
            width: 710px;
            height: 912px;
            /* border: 2px solid black; */
            padding: 35px;
            border: 2px solid;
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
            border: 1px solid black;
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
            font-weight: bold;
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
        /* ESSA FOM STYLES */
    </style>
</head>

<body>
    <div class="main container">
        <table>
            <tr>
                <td>
                    <img src="<?php echo Yii::app()->baseUrl?>/images/sitePlan/essa-logo.png" alt="" class="logo-1">
                </td>
                <td>
                    <img src="<?php echo Yii::app()->baseUrl?>/images/sitePlan/essa-header.PNG" alt="" class="logo-2">
                </td>
            </tr>
        </table>
        <table class="form-sec space">
            <tr>
                <td class="pad-0">Scale : _________________</td>
                <td class="pad-0" style="text-align: right;">Date : <?php echo date('d M, Y')?></td>
            </tr>
        </table>
        <table class="form-sec">
            <tr>
                <td class="brdr">Plot No : <?php echo $cp->plot->plot_number?></td>
                <td class="brdr">Block : <?php echo $cp->plot->block_number?></td>
                <td class="brdr">Area : <?php echo $cp->plot->size->size?></td>
                <td class="brdr">Category : <?php echo $cp->plot->category->name?></td>
            </tr>
        </table>
        <table class="form-sec" style="margin-top: 4px;">
            <tr>
                <td class="brdr">Alotee : <?php echo $cp->customer->name?></td>
            </tr>
        </table>
        <table class="form-sec">
            <tr>
                <td class="pad-0">
                    <div class="tag">
                        DRAWN BY
                    </div>
                    <div>
                        Name : __________________
                    </div>
                    <div class="sign-box">
                        <div>
                            SIGNATURE
                        </div>
                    </div>
                </td>
                <td class="pad-0">
                    <div class="tag">
                        DRAWN BY
                    </div>
                    <div>
                        Name : __________________
                    </div>
                    <div class="sign-box">
                        <div>
                            SIGNATURE
                        </div>
                    </div>
                </td>
            </tr>
        </table>
        <table class="form-sec" style="margin-top: 10px;">
            <tr>
                <td class="tag" style="text-align: center;">
                    AREA OF PLOT IS SUBJECT TO ACTUAL DEMARCATION ON SITES
                </td>
            </tr>
        </table>
        <table class="form-sec" style="margin-top: 10px;">
            <tr>
                <td style="width: 50%;" class="pad-0">
                    <table style="width: 100%;">
                        <tr>
                            <td class="brdr">
                            </td>
                            <td class="tag">
                                VERIFIED BY
                            </td>
                            <td class="tag">
                                APPROVED BY
                            </td>
                        </tr>
                        <tr>
                            <td class="brdr">
                                Signature
                            </td>
                            <td class="brdr">
                            </td>
                            <td class="brdr">
                            </td>
                        </tr>
                        <tr>
                            <td class="brdr">
                                Name
                            </td>
                            <td class="brdr">
                            </td>
                            <td class="brdr">
                            </td>
                        </tr>
                    </table>
                </td>
                <td class="pad-0" style="padding-left: 20px;">
                    <img src="<?php echo Yii::app()->baseUrl?>/images/sitePlan/logo-1.PNG" alt="" class="foot-logo">
                    <div>
                        <b>
                            ESSA HOUSING (PVT.) LIMITED 
                        </b>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <table class="form-sec">
        <tr>
            <td style="font-size: 12px;">
                Contact us on: 021-37440935
            </td>
            <td style="text-align: right; font-size: 12px;">
                Address: Office No.: C-4, First Floor Block-7, <br> Saadi Town, Scheme 33, Karachi
            </td>
        </tr>
    </table>


    <script type="text/javascript">
        window.print();
    </script>
</body>
</html>