<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">References</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                New Reference
            </div>
            <div class="panel-body">
                <div class="row">
                    <form role="form" method="POST" action="<?php echo Yii::app()->baseUrl?>/reference/save">
                        <!-- <div class="col-lg-12"> -->
                            
                            <div class="form-group col-lg-4" >
                                <label>Account Name</label>
                                <input class="form-control" name="account_name" id="account_name" placeholder="Account Name" required="">
                            </div>

                            <div class="form-group col-lg-4" style="padding-right: 0px;">
                                <label>Legal Type</label>                                
                                <select name="legal_type_id" id="legal_type_id" class="form-control" required>
                                    <option value="">Please select legal type</option>
                                    <?php foreach($legalTypes as $legalType):?>
                                        <option value="<?php echo $legalType->id?>"><?php echo $legalType->type?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>

                            

                            <div class="form-group col-lg-4">
                                <label>Incorporation Number</label>
                                <input class="form-control" name="incorporation_number" id="incorporation_number" placeholder="Incorporation Number" required="">
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>

                            <div class="form-group col-lg-4">
                                <label>Local Tax ID Number</label>
                                <input class="form-control" name="ntn_number" id="ntn_number" placeholder="NTN Number" required="" type="text">
                            </div>

                            <!-- <div class="form-group col-lg-4">
                                <label>STRN Number</label>
                                <input class="form-control" name="strn_number" id="strn_number" placeholder="STRN Number" type="text">
                            </div> -->

                            <div class="form-group col-lg-4">
                                <label>Commision Percentage</label>
                                <input class="form-control" id="set_commision_percentage" name="set_commision_percentage" placeholder="Commision Percentage" >
                            </div>


                            <div class="form-group col-lg-3" style="padding-right: 0px;">
                                <label>Country</label>                                
                                <select name="country_id" id="country_id" class="form-control">
                                    <option value="">Please select country</option>
                                    <?php foreach($countries as $country):?>
                                        <option value="<?php echo $country->id?>"><?php echo $country->name?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>

                            <div class="form-group col-lg-4">
                                <label>Address</label>
                                <input class="form-control" name="address" id="address" placeholder="Address" type="text">
                            </div>

                            <div class="form-group col-lg-4">
                                <label>Contact Number</label>
                                <input class="form-control" name="contact_number" id="contact_number" placeholder="Contact Number" type="number">
                            </div>

                            <div class="form-group col-lg-4">
                                <label>Account Email Address</label>
                                <input class="form-control" id="reference_user_account" name="reference_user_account" placeholder="Account Email Address" >
                            </div>
                            <div class="form-group col-lg-4">
                                <label>Account Password</label>
                                <input class="form-control" id="reference_user_password" name="reference_user_password" placeholder="Account Password" type="password">
                            </div>

                            <div class="form-group col-lg-4">
                                <label>Bank Name</label>
                                <input class="form-control" id="bank_name" name="bank_name" placeholder="Bank Name" >
                            </div>
                            <div class="form-group col-lg-4">
                                <label>IBAN</label>
                                <input class="form-control" id="iban" name="iban" placeholder="IBAN" >
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
            