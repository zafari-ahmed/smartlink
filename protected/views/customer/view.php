<?php $userModel = Yii::app()->session->get('userModel');?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">View Customer
    </h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-success">
            <div class="panel-heading">
                <b style="text-transform: UPPERCASE;font-weight: bold;">View Customer (<?php echo $customer->name?>)</b>
            </div>
            <!-- /.panel-heading -->
            

            <div class="panel-body">
                <div class="col-lg-12">
                    <h3 style="text-transform: UPPERCASE;font-weight: bold;">Customer Information</h3>
                    <div class="form-group col-lg-3" style="padding-left: 0px;">
                        <label>Name</label>
                        <p><?php echo $customer->name?></p>
                    </div>
                    <div class="form-group col-lg-3">
                        <label>Father/Husband Name</label>
                        <p><?php echo $customer->father_husband_name?></p>
                    </div>
                    <div class="form-group col-lg-3">
                        <label>Occupation</label>
                        <p><?php echo $customer->occupation?></p>
                    </div>

                    <div class="form-group col-lg-3" >
                        <label>CNIC</label>
                        <p><?php echo $customer->cnic?></p>
                    </div>
                    <div class="form-group col-lg-10" style="padding-left: 0px;">
                        <label>Address</label>
                        <p><?php echo $customer->address?></p>
                    </div>

                    <div class="form-group col-lg-2" style="padding-left: 0px;">
                        <label>Birth Date</label>
                        <p><?php echo date('d M,Y',strtotime(@$customer->dob))?></p>
                    </div>
                </div>
                <div class="col-lg-12">
                    <h3 style="text-transform: UPPERCASE;font-weight: bold;">Customer Contact Information</h3>
                    <div class="form-group col-lg-4" style="padding-left: 0px;">
                        <label>Office #</label>
                        <p><?php echo $customer->office?></p>
                    </div>
                    <div class="form-group col-lg-4">
                        <label>Res Phone #</label>
                        <p><?php echo $customer->phone?></p>
                    </div>
                    <div class="form-group col-lg-4">
                        <label>Mobile #</label>
                        <p><?php echo $customer->mobile?></p>
                    </div>

                    <h3 style="text-transform: UPPERCASE;font-weight: bold;">Customer Nominee's Information</h3>
                    <div class="form-group col-lg-4" style="padding-left: 0px;">
                        <label>Nominee's Name</label>
                        <p><?php echo $customer->nominee_name?></p>
                    </div>
                    <div class="form-group col-lg-4">
                        <label>Nominee's CNIC</label>
                        <p><?php echo $customer->nominee_cnic?></p>
                    </div>
                    <div class="form-group col-lg-4">
                        <label>Nominee's Relation</label>
                        <p><?php echo $customer->nominee_relation?></p>
                    </div>
                </div>   
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->

    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <b style="text-transform: UPPERCASE;font-weight: bold;">Customer Booking(s)</b>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <table width="100%" class="table table-bordered table-hover" id="dataTables">
                    <thead>
                        <tr>
                            <th>Block #</th>
                            <th>Plot #</th>
                            <th>Category</th>
                            <th>Size</th>
                            <th>Booking Date</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php if($customer->customerPlots){ foreach($customer->customerPlots as $cp):?>
                            <tr>
                                <td><?php echo $cp->plot->block_number?></td>
                                <td><?php echo $cp->plot->plot_number?></td>
                                <td><?php echo $cp->plot->category->name?></td>
                                <td><?php echo $cp->plot->size->size?></td>
                                <td><?php echo date('d M,Y',strtotime($cp->createdOn))?></td>
                                <td><a href="<?php echo Yii::app()->baseUrl?>/booking/viewbooking/<?php echo $cp->id?>"><span class="aLink label label-info">View</span></a>&nbsp;<a target="_blank" href="<?php echo Yii::app()->baseUrl?>/booking/bookingledger/<?php echo $cp->id?>"><span class="aLink label label-warning">View Ledger</span></a>&nbsp;
                                    <?php if($userModel['user_type']['id'] == 1 || $userModel['user_type']['id'] == 5){?>
                                    <a href="<?php echo Yii::app()->baseUrl?>/booking/editbooking/<?php echo $cp->id?>"><span class="aLink label label-info">Edit</span></a>
                                <?php }?>
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