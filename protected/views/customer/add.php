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
                New Customer
            </div>
            <div class="panel-body">
                <div class="row">
                    <form role="form" method="POST" action="<?php echo Yii::app()->baseUrl?>/customer/save" autocomplete="off">
                        <!-- <div class="col-lg-12"> -->
                            
                            <div class="form-group col-lg-3" style="padding-right: 0px;">
                                <label>Country</label>                                
                                <select name="country_id" id="country_id" class="form-control">
                                    <option value="">Please select country</option>
                                    <?php foreach($countries as $country):?>
                                        <option value="<?php echo $country->id?>"><?php echo $country->name?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>

                            <div class="form-group col-lg-3" style="padding-right: 0px;">
                                <label>Legal Type</label>                                
                                <select name="legal_type_id" id="legal_type_id" class="form-control" required>
                                    <option value="">Please select legal type</option>
                                    <?php foreach($legalTypes as $legalType):?>
                                        <option value="<?php echo $legalType->id?>"><?php echo $legalType->type?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>

                            <div class="form-group col-lg-3" style="padding-right: 0px;">
                                <label>Reference Id</label>                                
                                <select name="unique_reference_id" id="unique_reference_id" class="form-control">
                                    <option value="">Please select reference</option>
                                    <?php foreach($references as $reference):?>
                                        <option value="<?php echo $reference->id?>"><?php echo $reference->account_name?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>

                            <div class="form-group col-lg-4" >
                                <label>Name</label>
                                <input class="form-control" name="name" id="name" placeholder="Name" required="">
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>

                            <div class="form-group col-lg-4">
                                <label>Incorporation Number</label>
                                <input class="form-control" name="incorporation_number" id="incorporation_number" placeholder="Incorporation Number" required="">
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>

                            <div class="form-group col-lg-4">
                                <label>NTN Number</label>
                                <input class="form-control" name="ntn_number" id="ntn_number" placeholder="NTN Number" required="" type="number" autocomplete="off">
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>

                            <div class="form-group col-lg-4">
                                <label>STRN Number</label>
                                <input class="form-control" name="strn_number" id="strn_number" placeholder="STRN Number" type="number" autocomplete="off">
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>
                            <div class="form-group col-lg-6" >
                                <label>Customer Login Email Address</label>
                                <input class="form-control" name="email" id="email" placeholder="Email Address" required="" type="email" autocomplete="off">
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>
                            <div class="form-group col-lg-6" >
                                <label>Customer Login Password</label>
                                <input class="form-control" name="password" id="password" placeholder="Password" required="" type="password" autocomplete="off">
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>

                            <div class="form-group col-lg-6" >
                                <label>Billed By</label>
                                <input class="form-control" name="billed_by" id="billed_by" placeholder="Billed By" required="">
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>

                            <div class="form-group col-lg-6" >
                                <label>Domain Url</label>
                                <input class="form-control" name="domain_url" id="domain_url" placeholder="Domain Url" required="">
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
            