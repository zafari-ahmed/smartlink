<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Customers</h1>
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
                All Customers
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
                            <th>Name</th>
                            <th>NTN Number</th>
                            <th>STRN Number</th>
                            <th>Country</th>
                            <th>Login Email</th>
                            <th>Devices</th>
                            <th>Domain</th>
                            <th>Created At</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php if($customers){ foreach($customers as $customer):?>
                       		<tr>
	                            <td class="hidden"><?php echo $customer->id?></td>
                                <td><?php echo @$customer->name?></td>
                                <td><?php echo @$customer->ntn_number?></td>
                                <td><?php echo @$customer->strn_number?></td>
                                <td><?php echo @$customer->country->name ?></td>
                                <td><?php echo @$customer->email ?></td>
                                <td><?php echo count(@$customer->devices)?></td>
                                <td><?php echo @$customer->domain_url?></td>
                                <td><?php echo date('d M, Y',strtotime(@$customer->created_at))?></td>    
                                <td>
                                	<?php echo ($customer->status==0)?'<span class="label label-danger">De-Activated</span>':'<span class="label label-success">Activated</span>'?>&nbsp;
                                	<a href="<?php echo Yii::app()->baseUrl?>/customer/edit/<?php echo $customer->id?>"><span class="aLink label label-success">Edit</span></a>&nbsp;
                                    <a href="<?php echo Yii::app()->baseUrl?>/customer/view/<?php echo $customer->id?>"><span class="aLink label label-info">View</span></a>&nbsp;
                                    <a href="<?php echo Yii::app()->baseUrl?>/customer/customerdevice/<?php echo $customer->id?>"><span class="aLink label label-warning">Cust Devices</span></a>&nbsp;

                                </td>
                                <td><a href="#"><span class="aLink label label-success">Admin Login</span></a></td>
                            
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