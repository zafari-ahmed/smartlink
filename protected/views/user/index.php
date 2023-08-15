<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Users</h1>
        <?php
            foreach(Yii::app()->user->getFlashes() as $key => $message) {
                echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'.$message.'</div>';
            }
        ?>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                All Users
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables">
                    <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email Address</th>
                            <th>Username</th>
                            <th>User Type</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php if($users){ foreach($users as $user):?>
                       		<tr>
	                            <td><?php echo $user->first_name?></td>
	                            <td><?php echo $user->last_name?></td>
	                            <td><?php echo $user->email_address?></td>
	                            <td><?php echo $user->username?></td>
	                            <td><?php echo $user->userType->name?></td>
	                            <td><?php echo ($user->status==0)?'<span class="label label-danger">In active</span>':'<span class="label label-success">Active</span>'?>&nbsp;<a href="<?php echo Yii::app()->baseUrl?>/user/edit/<?php echo $user->id?>"><span class="aLink label label-info">Edit</span></a>&nbsp;</td>
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