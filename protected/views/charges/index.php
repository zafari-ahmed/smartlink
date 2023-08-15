<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Charges</h1>
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
                All Charges
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables">
                    <thead>
                        <tr>
                            <th>Development Charges</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php if($charges){ foreach($charges as $charge):?>
                       		<tr>
	                            <td><?php echo $charge->charge?></td>
                                <td><?php echo date('d M,Y',strtotime($charge->createdOn))?></td>
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