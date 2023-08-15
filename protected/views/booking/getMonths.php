<?php $userModel = Yii::app()->session->get('userModel');?>
<?php $netTotal = ($this->plotTotal(@$booking->plot->id,false) - intval(@$booking->customerPlotTransactionSum)) - intval($this->plotDiscount(@$booking->plot->id,false))?>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">View Booking 
            <?php if($userModel['user_type']['id'] == 1 || $userModel['user_type']['id'] == 5 || $userModel['user_type']['id'] == 4){?>
            <span class="pull-right" ><a href="<?php echo Yii::app()->baseUrl?>/booking/getmonths/id/<?php echo $booking->id?>/edit/true"><button type="button" class="btn btn-success btn-sm">Edit</button></a></span>
            <?php }?>
        </h1>
    </div>
</div>
<div class="row">
    
    <!-- /.col-lg-12 -->

    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <b style="text-transform: UPPERCASE;font-weight: bold;">View Land Transactions</b>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <form role="form" method="POST" action="<?php echo Yii::app()->baseUrl?>/booking/savepenality">
                <table width="100%" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Payment Mode</th>
                            <th>Transaction #</th>
                            <th>Transaction Type</th>
                            <th>Amount</th>
                            <th>Date</th>
                            <th>Cr By</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                       <?php if($booking->customerPlotTransactions){ echo $tablee;}?>
                    </tbody>
                </table>

                
                <div class="col-lg-12 <?php echo (!$edit)?'hide':''?>" style="padding-left: 0px;">
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </div>
            <input class="form-control" type="hidden" name="booking_id" value="<?php echo $booking->id?>">
            </form>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
