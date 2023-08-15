<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Customers</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                All Customers
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Father/Husband Name</th>
                            <th>CNIC</th>
                            <th>Mobile Number</th>
                            <th>Plots</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php if($customers){ foreach($customers as $customer):?>
                       		<tr>
	                            <td><a href="<?php echo Yii::app()->baseUrl?>/customer/view/<?php echo $customer->id?>"><?php echo $customer->name?></a></td>
	                            <td><?php echo $customer->father_husband_name?></td>
	                            <td><?php echo $customer->cnic?></td>
	                            <td><?php echo $customer->mobile?></td>
                                <td><?php echo ($customer->customerPlots)?'<a href="'.Yii::app()->baseUrl.'/customer/view/'.$customer->id.'"><span class="aLink label label-info">View</span></a>':'-'?></td>
	                            <td><?php echo ($customer->status==1)?'<span class="label label-success">Active</span>':'<span class="label label-danger">In Active</span>'?></td>
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