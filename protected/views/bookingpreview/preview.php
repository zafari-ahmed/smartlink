<!DOCTYPE html>
<html lang="en">
<?php //print_r($booking);?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Letter</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <style type="text/css" media="print">
    	.printClass{
    		display: none;
    	}
    </style>
    <style>
        .main {
            /*width: 595px;*/
            width: 710px;
            height: 842px;
            /* border: 2px solid black; */
            padding-top: 200px;
            font-size: 12px!important;
        }
        .content {
            text-align: justify;
            line-height: 25px;
        }
        span {
            display: inline-block;
            /*width: 70px;*/
            width: auto;
            min-width: 30px;
            border-bottom: 1px solid black;
            padding-left: 10px;
		    padding-right: 10px;
		    font-weight: bold;
		    /*text-transform: capitalize;*/
        }
        td {
            padding: 1px 10px;
            border: 1px solid black;
            line-height: 18px;
            font-weight: bold;
        }
        .right {
            text-align: right;
        }
        .center h6 {
            text-align: center;
        }
        p {
            margin-bottom: 3px!important;
        }
        .abs {
            /*position: absolute;
            top: 40px;
            right: 30px;*/
            position: static;
            margin-left: 70%;
        }
    </style>
</head>
<body>
    <div class="main container">
        <div class="container content">
            
            <div class="abs">
            	<div style="margin-left: -175%;color:#0072bb"><h1 style="font-size:45px;width: 65%;">&nbsp;</h1></div>
            	<img src="<?php echo Yii::app()->baseUrl?>/uploads/booking/<?php echo $booking->agent_cnic?>" alt="" style="height: 125px;width: 100px;border-radius: 10px;margin-top: -30%;border: 1px solid;margin-left: 40%;">
            </div>
            <div style="margin-top: -5%;">
            Dear Sir, <br>
            <p>
                &nbsp; &nbsp; I wish to become a member of <b>KAINAT CITY, Scheme-45</b>. 
            </p>
            <p>
                &nbsp; &nbsp; &nbsp; I declare that I shall willingly and faithfully abide by all rules, regulations and by-laws of the 
<b>KAINAT CITY, Scheme-45</b>, which is enforced and those to be revised time to time for the purchase and/or sale and/or transfer of this plot in your  project. I further declare, that I have not been in possession of any plot allotted by the company.
<br/><b>My particulars are as under:</b>
            </p>
            <p>
                Name: <span><?php echo @$booking->customer->name?></span> <?php echo @$booking->agent_name?>: <span><?php echo @$booking->customer->father_husband_name?></span>
            </p>
            <div>Allotee CNIC Number: &nbsp;
                <table border="1" style="display: inline-block;position: relative;top: 5px;">
                    <tr>
                        <td><?php echo @$booking->customer->cnic[0]?></td>
                        <td><?php echo @$booking->customer->cnic[1]?></td>
                        <td><?php echo @$booking->customer->cnic[2]?></td>
                        <td><?php echo @$booking->customer->cnic[3]?></td>
                        <td><?php echo @$booking->customer->cnic[4]?></td>
                        <td>-</td>
                        <td><?php echo @$booking->customer->cnic[6]?></td>
                        <td><?php echo @$booking->customer->cnic[7]?></td>
                        <td><?php echo @$booking->customer->cnic[8]?></td>
                        <td><?php echo @$booking->customer->cnic[9]?></td>
                        <td><?php echo @$booking->customer->cnic[10]?></td>
                        <td><?php echo @$booking->customer->cnic[11]?></td>
                        <td><?php echo @$booking->customer->cnic[12]?></td>
                        <td>-</td>
                        <td><?php echo @$booking->customer->cnic[14]?></td>
                    </tr>
                </table> 
            </div>
            <p>Occupation: <span><?php echo @$booking->customer->occupation?></span> Membership No. <span>N/A</span></p>
            <p>Address: <span><?php echo @$booking->customer->address?></span></p>
            <p>Mobile Number: <span><?php echo @$booking->customer->mobile?></span>&nbsp;Ph.: <span><?php echo @$booking->customer->phone?></span>&nbsp;Office Phone: <span><?php echo @$booking->customer->office?></span></p>
            <p>Email: <span><?php echo @$booking->customer->email?></span></p>
            
            <b>My Nominee particulars are as under:</b>
            <p>Nominee: <span><?php echo @$booking->customer->nominee_name?></span></p>
            <p>Relationship with Nominee: <span><?php echo @$booking->customer->nominee_relation?></span></p>
            <!-- <p>Contact # <span></span><span></span> Occupation <span></span><span></span><span></span></p> -->
            <div>Nominee CNIC Number:&nbsp;
                <table border="1" style="display: inline-block;position: relative;top: 5px;">
                    <tr>
                        <td><?php echo @$booking->customer->nominee_cnic[0]?></td>
                        <td><?php echo @$booking->customer->nominee_cnic[1]?></td>
                        <td><?php echo @$booking->customer->nominee_cnic[2]?></td>
                        <td><?php echo @$booking->customer->nominee_cnic[3]?></td>
                        <td><?php echo @$booking->customer->nominee_cnic[4]?></td>
                        <td>-</td>
                        <td><?php echo @$booking->customer->nominee_cnic[6]?></td>
                        <td><?php echo @$booking->customer->nominee_cnic[7]?></td>
                        <td><?php echo @$booking->customer->nominee_cnic[8]?></td>
                        <td><?php echo @$booking->customer->nominee_cnic[9]?></td>
                        <td><?php echo @$booking->customer->nominee_cnic[10]?></td>
                        <td><?php echo @$booking->customer->nominee_cnic[11]?></td>
                        <td><?php echo @$booking->customer->nominee_cnic[12]?></td>
                        <td>-</td>
                        <td><?php echo @$booking->customer->nominee_cnic[14]?></td>
                    </tr>
                </table> 
            </div>
            <br/>
            Choice of plot applied for Block <span><?php echo @$booking->plot->block_number?></span>,&nbsp;Plot Type<span><?php echo @$booking->plot->plot_type?></span>,&nbsp;Plot Number<span><?php echo @$booking->plot->plot_number?></span>, Size <span><?php echo @$booking->plot->size->size?></span>, Category <b><?php echo @$booking->plot->category->name?></b>.
            <br/>
            <br/>
            <p>
                I hereby declare that I have read and understand the terms and conditions of allotment of plot in Kainat City, Scheme 45 and 
accept the same and I further declare that I have read this booking form and all the details mentioned above are correct.
            </p>
            </div>   
            <br/>
            <br/>
            <br/>
            
            
            <div class="row" style="margin-bottom: -1%;margin-top: -5%;">
                <div class="col-md-6">
                    <span style="width:200px"></span>
                </div>
                <!-- <div class="col-md-6 right">
                    <span style="width:200px"></span>
                </div> -->
            </div>
            <div class="row">
                <div class="col-md-6" style="margin-left: 25px;">
                    <p>Signature of Allottee</p>
                    <p><b><?php echo date('d M, o', strtotime($booking->createdOn))?></b></p>
                </div>
                <!-- <div class="col-md-6 right">
                    Signature of Manager
                </div> -->
            </div>                             
        </div>
    </div>
</body>
</html>

<div class="main container printClass" style="text-align: center;">
	<a href="" onclick="window.print()">Print</a>
	<br>
	<a target="_blank" href="<?php echo Yii::app()->baseUrl?>/plot/getpaymentschedule/id/<?php echo $booking->plot->id?>/booking/<?php echo $booking->id?>">Payment Schedule</a>
</div>