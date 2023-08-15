<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>

    <!-- Bootstrap core CSS -->
   <link href="<?php echo Yii::app()->request->baseUrl; ?>/assets/letter/assets/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/letter/assets/css/icomoon.css">
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/letter/assets/css/fonts/icomoon.ttf">
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/letter/assets/css/fonts/icomoon.woff">
    <link href="https://fonts.googleapis.com/css?family=Amiri&display=swap" rel="stylesheet">
    <!-- Custom styles for this template -->
    <!-- <link href="assets/css/form-validation.css" rel="stylesheet">
    <link href="assets/css/signin.css" rel="stylesheet"> -->
    <!-- Custom styles for this template -->
    <style type="text/css"> p{margin-bottom: 0px !important;}</style>
  </head>
  <style>
    .tbBold{
      font-weight: bold!important;
    }
    body{
      font-family: 'Amiri', serif;
    }
    p{
      margin-bottom: -10px !important;
    }
  </style>
    <body style="font-size: 20px!important;">
        <?php echo $content; ?>
    </body>
    <script type="text/javascript">
      window.print();
      //window.close();
    </script>
</html>
  
