<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/assets/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/assets/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
        .tbBold{
            font-weight: bold;
        }
        .bookingStatus{
            background-color: gray;
            color: #fff;
            padding: 5px;
            border-radius: 4px;
            font-weight: bold;
        }
        .heading{
                font-weight: bold;
                text-transform: uppercase;
                background-color: gray;
                padding: 10px;
                padding-left: 0px;
            }

        @media print {
            body{
                font-size: 15px;
            }
            
            .heading{
                font-weight: bold;
                text-transform: uppercase;
                background-color: gray!important;
                padding: 05px;
                padding-left: 0px;
                font-size: 18px;
                font-family: monospace;
            }
            .infoDiv{
                width: 33%;
                float: left;
                display: inline;
            }
            .infoBox{
                width: 100%;
                float: left;
                margin-bottom: -2%;
            }
            .preClass{
                background-color: gray!important;
                font-size: 18px;
            }
            .pagebreak { 
                page-break-before: always; 
            }
            .bookingStatus{
                background-color: gray!important;
                color: #fff!important;
                padding: 5px;
                border-radius: 4px;
                font-weight: bold;
                font-family: monospace;
            }

            .duesTable.total{
                background-color: lightgrey!important;
                color: #000!important;
                font-weight: bold!important;
            }
            .duesTable>tbody>tr>td, .duesTable>tbody>tr>th, .duesTable>tfoot>tr>td, .duesTable>tfoot>tr>th, .duesTable>thead>tr>td, .duesTable>thead>tr>th{
                line-height: 2px!important;
            }
        }
    </style>
</head>

<body style="background-color: #fff;margin-top: 10px;">
    <?php echo $content; ?>
</body>
<script type="text/javascript">
    //window.print();
    //window.close();
</script>
</html>

