<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">All Messages</h1>
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
                All Messages
            </div>
            <div class="panel-body">
                <div class="row">
                    <form role="form" method="POST" action="<?php echo Yii::app()->baseUrl?>/message/runallmessage">
                        <!-- <div class="col-lg-12"> -->
                            <div class="form-group col-lg-3" style="padding-right: 0px;">
                                <label>Message to RUN</label>
                                <!-- <input class="form-control" disabled="" name="category_id" id="category_id" placeholder="Plot Category"> -->
                                <select name="messagetorun" id="messagetorun" class="form-control" required>
                                    <option value="">Please select Message</option>
                                    <option value="payment_reminder">Payment Reminder</option>
                                </select>
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>    
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Testing</label>
                                    <label class="checkbox-inline">
                                        <input type="checkbox" name="test" id="test" value="1" checked>Testing
                                    </label>
                                </div>
                            </div>                      

                            <div class="col-lg-12">
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        <!-- </div> -->
                            
                        </form>
                    </div>
                    <!-- /.col-lg-6 (nested) -->
                </div>
                <!-- /.row (nested) -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
            