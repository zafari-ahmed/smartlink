<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <link rel="icon" type="image/x-icon" href="<?php echo Yii::app()->baseUrl?>//images/favicon.ico">

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

</head>

<body>
    <div class="alertMsgBox" style="display: none"></div>
    <?php echo $content; ?>

    <!-- jQuery -->
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/dist/js/sb-admin-2.js"></script>
    <script type="text/javascript">
        var baseUrl = '<?php echo Yii::app()->baseUrl?>';
    </script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/dist/js/jquery.mask.min.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/dist/js/custom.js"></script>

</body>

</html>

