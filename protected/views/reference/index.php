<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">References</h1>
        <?php
            foreach(Yii::app()->user->getFlashes() as $key => $message) {
                echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'.$message.'</div>';
            }
        ?>
    </div>
    <!-- /.col-lg-12 -->
</div>
<?php $userModel = Yii::app()->session->get('userModel'); ?>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                All References
                <!-- <span class="pull-right">
                    <a href="<?php //echo Yii::app()->baseUrl?>/report/exportavailableplot"><span class="label label-success">Export</span></a>
                    &nbsp;
                    <a href="<?php //echo Yii::app()->baseUrl?>/import/uploaddealer"><span class="label label-success">Import</span></a>
                </span> -->
                
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables">
                    <thead>
                        <tr>
                            <!-- <th>Block #</th>
                            <th>Plot Type</th> -->
                            <th class="hide">#</th>
                            <th>Account</th>
                            <th>Legal Type</th>
                            <th>Incorporation Number</th>
                            <th>NTN Number</th>
                            <th>STRN Number</th>
                            <th>Percentage</th>
                            <th>User Account</th>
                            <th>Created At</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php if($references){ foreach($references as $reference):?>
                       		<tr>
	                            <td class="hidden"><?php echo $reference->id?></td>
                                <td><?php echo @$reference->account_name?></td>
                                <td><?php echo @$reference->legalType->type?></td>
                                <td><?php echo @$reference->incorporation_number?></td>
                                <td><?php echo @$reference->ntn_number?></td>
                                <td><?php echo @$reference->strn_number?></td>
                                <td><?php echo @$reference->set_commision_percentage ?></td>
                                <td><?php echo @$reference->reference_user_account ?></td>
                                <td><?php echo date('d M, Y',strtotime(@$reference->created_at))?></td>    
                                <td>
                                	<?php echo ($reference->status==0)?'<span class="label label-danger">De-Activated</span>':'<span class="label label-success">Activated</span>'?>&nbsp;
                                	<a href="<?php echo Yii::app()->baseUrl?>/reference/view/<?php echo $reference->id?>"><span class="aLink label label-info">View</span></a>&nbsp;
                                </td>                            
	                        </tr>
                       <?php endforeach;}?>
                    </tbody>
                </table>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>