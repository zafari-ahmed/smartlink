<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Messages</h1>
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
                New Message
            </div>
            <div class="panel-body">
                <div class="row">
                    <form role="form" method="POST" action="<?php echo Yii::app()->baseUrl?>/message/save">
                        <!-- <div class="col-lg-12"> -->
                            <div class="col-lg-12" >
                                <div class="form-group" >
                                    <label>Number</label>
                                    <input class="form-control numbersOnly" name="number"  placeholder="Number" required="" autocomplete="off">
                                    <p class="help-block">* Add , for multiple numbers.</p>
                                </div>
                                <div class="form-group">
                                    <label>New Message</label>
                                    <textarea class="form-control" rows="3" name="message" placeholder="Message Content" required=''></textarea>
                                </div>
                            </div>
                            
                        <!-- </div> -->
                        
                        
                            
                            <div class="col-lg-12">
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                            
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
            