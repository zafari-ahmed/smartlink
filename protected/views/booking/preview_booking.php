<!DOCTYPE html>
<html lang="en">
<?php print_r($_FILES);?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Letter</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <style>
        .main {
            width: 595px;
            height: 842px;
            /* border: 2px solid black; */
            padding-top: 200px;
            font-size: 12px!important;
        }
        .content {
            text-align: justify;
            line-height: 30px;
        }
        span {
            display: inline-block;
            /*width: 70px;*/
            width: auto;
            min-width: 30px;
            border-bottom: 1px solid black;
        }
        td {
            padding: 1px 15px;
            border: 1px solid black;
            line-height: 18px;
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
            position: absolute;
            top: 40px;
            right: 30px;
        }
    </style>
</head>
<body>
    <div class="main container">
        <div class="container content">
            <div class="center"><h6>APPLICATION FORM</h6></div>
            <div class="abs"><img src="<?php echo @$_FILES['plot']['tmp_name']?>" alt="" style="height: 150px; width: 100px;"></div>
            Dear Sir, <br>
            <p>
                &nbsp; &nbsp; I wish to become a member of Kainat city essa housing 
            </p>
            <p>
                &nbsp; &nbsp; I declare that I shall willingly and faithfully abide by all rules, regulations and by-laws of the 
KAINAT CITY ESSA HOUSING, which is enforced and those to be revised application from time to time
            </p>
            <br>
            <p>
                I further declare, that I have not been in possession of any plot allotted by the company 
My particulars are as under:
            </p>
            <p>
                Name <span><?php echo @$_POST['name']?></span> S/O, W/O, D/O <span><?php echo @$_POST['father_husband_name']?></span>
            </p>
            <div>CNIC NO
                <table border="1" style="display: inline-block;">
                    <tr>
                        <td><?php echo @$_POST['cnic'][0]?></td>
                        <td><?php echo @$_POST['cnic'][1]?></td>
                        <td><?php echo @$_POST['cnic'][2]?></td>
                        <td><?php echo @$_POST['cnic'][3]?></td>
                        <td>-</td>
                        <td><?php echo @$_POST['cnic'][4]?></td>
                        <td><?php echo @$_POST['cnic'][5]?></td>
                        <td><?php echo @$_POST['cnic'][6]?></td>
                        <td><?php echo @$_POST['cnic'][7]?></td>
                        <td><?php echo @$_POST['cnic'][8]?></td>
                        <td><?php echo @$_POST['cnic'][9]?></td>
                        <td><?php echo @$_POST['cnic'][10]?></td>
                        <td>-</td>
                        <td><?php echo @$_POST['cnic'][11]?></td>
    
                    </tr>
                </table> 
            </div>
            <p>Occupation <span><?php echo @$_POST['occupation']?></span><span></span>Membership No. <span></span><span></span></p>
            <p>Resident <span><?php echo @$_POST['address']?></span><span></span><span></span><span></span><span></span><span></span></p>
            <p>Mobile # <span><?php echo @$_POST['mobile']?></span>Ph. <span><?php echo @$_POST['phone']?></span><span></span>OfficePhone. <span><?php echo @$_POST['office']?></span><span></span> </p>
            <p>Email <span><?php echo @$_POST['email']?></span><span></span> Postal Address <span><?php echo @$_POST['occupation']?></span><span></span><span></span></p>
            <p>Nominee <span><?php echo @$_POST['nominee_name']?></span><span></span> S/O, W/O, D/O <span><?php echo @$_POST['nominee_name']?></span><span></span><span></span></p>
            <p>Relationship with Nominee <span><?php echo @$_POST['nominee_relation']?></span><span></span> Address <span></span><span></span></p>
            <p>Contact # <span></span><span></span> Occupation <span></span><span></span><span></span></p>
            <div>CNIC NO
                <table border="1" style="display: inline-block;">
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>-</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>-</td>
                        <td></td>
    
                    </tr>
                </table> 
            </div>
            Choice of plot applied for Residential / Commercial <span><?php echo @$_POST['block_number'].''.@$_POST['plot_type'].''.@$_POST['block_number']?></span>
            <br>
            <p>
                I hereby declare that I have read and understand the terms and conditions of allotment of plot and 
accept the same and further declare that I shall abide by existing rules and regulations, Conditions, 
requirement etc. which may presented by you for the purchase of plot in this project
            </p>                                
        </div>
    </div>

</body>
</html>