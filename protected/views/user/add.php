<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Users</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                New User
            </div>
            <div class="panel-body">
                <div class="row">
                    <form role="form" method="POST" action="<?php echo Yii::app()->baseUrl?>/user/save">
                        <!-- <div class="col-lg-12"> -->
                            <div class="form-group col-lg-6" >
                                <label>First Name</label>
                                <input class="form-control" name="first_name" id="first_name" placeholder="First Name" required="">
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Last Name</label>
                                <input class="form-control" name="last_name" id="last_name" placeholder="Last Name" required="">
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>

                            <div class="form-group col-lg-4">
                                <label>Username</label>
                                <input class="form-control" name="username" id="username" placeholder="Username" required="">
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>
                            <div class="form-group col-lg-4">
                                <label>Email Address</label>
                                <input class="form-control" name="email_address" id="email" placeholder="Email Address" >
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>
                            <div class="form-group col-lg-4">
                                <label>Password</label>
                                <input class="form-control" type="password" name="password" id="password" placeholder="Password" required="">
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>
                            <div class="form-group col-lg-3" style="padding-right: 0px;">
                                <label>User Type</label>
                                <!-- <input class="form-control" disabled="" name="category_id" id="category_id" placeholder="Plot Category"> -->
                                <select name="user_type_id" id="user_type_id" class="form-control" required>
                                    <option value="">Please select plot category</option>
                                    <?php foreach($types as $type):?>
                                        <option value="<?php echo $type->id?>"><?php echo $type->name?></option>
                                    <?php endforeach;?>
                                </select>
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
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
            