<?php $userModel = Yii::app()->session->get('userModel');?>
<div class="row">
<div class="col-lg-12">
    <h1 class="page-header">Dashboard</h1>
</div>
<!-- /.col-lg-12 -->
</div>
<!-- /.row -->

<div class="row">
    
    <div class="col-lg-4 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-users fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo Customers::model()->count();?></div>
                        <div>Customer</div>
                    </div>
                </div>
            </div>
            <a href="<?php echo Yii::app()->baseUrl?>/customer">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-asterisk fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo Devices::model()->count();?></div>
                        <div>Devices</div>
                    </div>
                </div>
            </div>
            <a href="<?php echo Yii::app()->baseUrl?>/device">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-retweet fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo References::model()->count();?></div>
                        <div>References</div>
                    </div>
                </div>
            </div>
            <a href="<?php echo Yii::app()->baseUrl?>/reference">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    
</div>