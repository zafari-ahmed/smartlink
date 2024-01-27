<?php $userModel = Yii::app()->session->get('userModel');?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">View Reference
    </h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-success">
            <div class="panel-heading">
                <b style="text-transform: UPPERCASE;font-weight: bold;">View Reference (<?php echo @$reference->account_name?>)</b>
            </div>
            <!-- /.panel-heading -->
            

            <div class="panel-body">
                <div class="col-lg-12">
                    <div class="form-group col-lg-1" style="padding-left: 0px;">
                        <label>Account</label>
                        <p><?php echo @$reference->account_name?></p>
                    </div>
                    <div class="form-group col-lg-2">
                        <label>Legal Type</label>
                        <p><?php echo @$reference->legalType->type?></p>
                    </div>
                    <div class="form-group col-lg-2">
                        <label>Incorporation Number</label>
                        <p><?php echo @$reference->incorporation_number?></p>
                    </div>

                    <div class="form-group col-lg-2" >
                        <label>Country</label>
                        <p><?php echo @$reference->country->name?></p>
                    </div>
                    <div class="form-group col-lg-2" style="padding-left: 0px;">
                        <label>Local Tax ID Number</label>
                        <p><?php echo @$reference->ntn_number?></p>
                    </div>

                    <div class="form-group col-lg-1" style="padding-left: 0px;">
                        <label>Commision %</label>
                        <p><?php echo @$reference->set_commision_percentage?></p>
                    </div>

                    <div class="form-group col-lg-2" style="padding-left: 0px;">
                        <label>User Account</label>
                        <p><?php echo @$reference->reference_user_account?></p>
                    </div>
                </div> 
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>