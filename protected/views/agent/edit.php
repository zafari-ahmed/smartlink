<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Dealers</h1>
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
                Edit Dealer
                <?php if(@$agent->parent_id){?>
                <span class="pull-right" style="margin-top: -5px;"><a href="<?php echo Yii::app()->baseUrl?>/agent/agentreport/<?php echo $agent->id?>" target="_blank"><button type="button" class="btn btn-success btn-sm">CSV Report</button></a></span>
                <?php }?>
            </div>
            <div class="panel-body">
                <div class="row">
                    <form role="form" method="POST" action="<?php echo Yii::app()->baseUrl?>/agent/update">
                        <!-- <div class="col-lg-12"> -->
                            <div class="form-group col-lg-3" style="padding-right: 0px;">
                                <label>Parent Dealer</label>                                
                                <select name="parent_id" id="parent_id" class="form-control">
                                    <option value="">Please select Parent Dealer</option>
                                    <?php foreach($parents as $parent):?>
                                        <option value="<?php echo $parent->id?>" <?php echo ($agent->parent_id==$parent->id)?'selected':''?>><?php echo $parent->name?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>

                            <div class="form-group col-lg-6" >
                                <label>Full Name</label>
                                <input class="form-control" name="name" id="name" placeholder="Full Name" required="" value="<?php echo $agent->name?>">
                                <input name="id" value="<?php echo $agent->id?>" type="hidden">
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>

                            <div class="form-group col-lg-4">
                                <label>Number</label>
                                <input class="form-control" name="number" id="number" placeholder="Number" required="" value="<?php echo $agent->number?>">
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>

                            <div class="form-group col-lg-4">
                                <label>Percentage</label>
                                <input class="form-control" name="percentage" id="percentage" placeholder="Percentage" required="" type="number" value="<?php echo $agent->percentage?>">
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>

                            <div class="form-group col-lg-4">
                                <label>Percentage Value</label>
                                <input class="form-control" name="percentage_value" id="percentage" placeholder="Percentage" type="text" value="<?php echo $agent->percentage_value?>">
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>

                            <div class="col-md-12" id="agentPlotBox">
                                <h2>Plot Reserve Detail
                                    <span class="pull-right btn-lg"><a href="javascript:void(0)" id="report2btn"><span class="label label-success">Print</span></a></span>
                                </h2>
                                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables">
                                <thead>
                                    <tr>
                                        <th class="hide">#</th>
                                        <th>Plot #</th>
                                        <th>Agent Total Comission</th>
                                        <th>Agent Paid Comission</th>
                                        <th>Agent Balance Comission</th>
                                        <th>Plot Paid Total</th>
                                        <th>Plot Attributes</th>
                                        <!-- <th>Status</th> -->
                                        <th>Dues Desciption</th>
                                        <th>Total Dues</th>
                                        <th>Installments<br/> Paid Monthly/Yearly</th>
                                        <th>Status</th>
                                        <th class="btnn">Action</th>
                                        
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $tComission = 0; $tpComission = 0; $tbComission = 0; if($agent->agentReserves){ foreach($agent->agentReserves as $res):
                                    $det = [];
                                    if(@$res->plot && @$res->plot->customerPlots){
                                        $det = $this->getPlotLedgerDetail(@$res->plot->customerPlots[0]->id);    
                                    }
                                    
                                    $netTotal = intval(@$res->plot->customerPlots[0]->customerPlotTransactionSum);
                                    $complete = ($this->plotTotal(@$res->plot->customerPlots[0]->plot->id) == number_format($netTotal))?1:0;
                                    $trasferred = 0;
                                    if(@$res->plot->customerPlots[0]->plot->customerPlotTransfers){
                                        $trasferred = 1;
                                    }

                                    ?>
                                    <tr>
                                        <td class="hidden"><?php echo $res->id?></td>
                                        <?php if(@$res->plot->customerPlots){?>
                                        
                                        <td><a href="<?php echo Yii::app()->baseUrl?>/booking/viewbooking/<?php echo @$res->plot->customerPlots[0]->id?>"><?php echo '*'.@$res->plot->block_number.'-'.$res->plot->plot_type.'-'.$res->plot->plot_number?>*</a><br/><?php echo @$res->plot->customerPlots[0]->customer->name?></td>
                                        <?php } else {?>
                                            <td><?php echo '*'.@$res->plot->block_number.'-'.@$res->plot->plot_type.'-'.@$res->plot->plot_number.'*'?></td>    
                                        <?php }?>
                                        
                                        <td><?php echo 'PKR '.number_format(@$res->commission!=''?$res->commission:0.00)?></td>
                                        <?php $tComission = $tComission + (@$res->commission!=''?$res->commission:0.00)?>
                                        <td><?php echo 'PKR '.number_format(@$res->plot->customerPlots[0]->agent_commision_sum)?></td>
                                        <?php $tpComission = $tpComission + (@$res->plot->customerPlots[0]->agent_commision_sum)?>
                                        <td><?php echo 'PKR '.number_format((@$res->commission!=''?$res->commission:0)-(@$res->plot->customerPlots[0]->agent_commision_sum))?></td>
                                        <?php $tbComission = $tbComission + ((@$res->commission!=''?$res->commission:0)-(@$res->plot->customerPlots[0]->agent_commision_sum))?>
                                        <td><?php echo 'Rs. '.$this->plotTotal(@$res->plot->id).' / Rs. '.number_format($netTotal);?></td>
                                        <td>
                                            <table class="table table-responsive" style="FONT-SIZE: 12PX;">
                                                <tbody>
                                                    <tr>
                                                        <td class="tbBold">Corner</td>
                                                        <td><?php echo (@$res->plot->is_corner==1)?'<span class="label label-success" style="text-decoration: none;">YES</span>':'<span class="label label-danger" style="text-decoration: none;">No</span>'?></td>
                                                        
                                                    </tr>
                                                    <tr>
                                                        <td class="tbBold">Park Facing</td>
                                                        <td><?php echo (@$res->plot->is_park_facing==1)?'<span class="label label-success" style="text-decoration: none;">YES</span>':'<span class="label label-danger" style="text-decoration: none;">No</span>'?></td>
                                                        
                                                    </tr>
                                                    <tr>
                                                        <td class="tbBold">West Open</td>
                                                        <td><?php echo (@$res->plot->is_west_open==1)?'<span class="label label-success" style="text-decoration: none;">YES</span>':'<span class="label label-danger" style="text-decoration: none;">No</span>'?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                        <td><?php echo @$det['html'];?></td>
                                        <td><b><?php echo 'PKR '.number_format(@$det['amount'],2,'.',',');?></b></td>
                                        <td><?php echo $this->getPlotLedgerDetailSingle(@$res->plot->customerPlots[0]->id,'monthly',false,false)?><hr/>
                                        <?php echo $this->getPlotLedgerDetailSingle(@$res->plot->customerPlots[0]->id,'yearly',false,false)?>
                                        </td>
                                        <td style="display: none;"><?php echo (@$res->plot->customerPlots)?'<span class="label label-danger" style="text-decoration: none;">Booked</span>':'<span class="label label-success" style="text-decoration: none;">Available</span>'?></td>
                                        
                                        <?php if(@$res->plot->customerPlots){?>
                                        <?php if(@$res->plot->customerPlots[0]->blocked != 1 && $res->plot->customerPlots[0]->blocked != 2){?> 
                                            <?php if(empty(@$res->plot->customerPlots[0]->customerPlotCancelled)){?>
                                            <td><?php echo (@$res->plot->customerPlots[0]->status==1)?(($complete==0)?'<span class="aLink label label-primary">Booked '.(($trasferred==1)?'(Transferred)':'').'</span>':'<span class="aLink label label-success">Completed</span>'):'<span class="aLink label label-danger">Temporary Booked</span>'?>
                                                
                                                <?php if(@$res->plot->customerPlots[0]->customerPlotTransactionSum >= $this->discountedPlotCostOfLand(@$res->plot->customerPlots[0]->plot->id)) {?>
                                            <span class="label label-warning" style="text-decoration: none;">Cost of Land Paid</span>
                                            <?php }?>

                                            <?php if(@$res->plot->customerPlots[0]->customerPlotTransactionSum >= $this->discountedPlotCostOfLandAndExtra(@$res->plot->customerPlots[0]->plot->id)) {?>
                                            <br/><span class="label label-success" style="text-decoration: none;">Plot Total Paid</span>
                                            <?php }?>
                                            </td>
                                            <?php } else{ ?>
                                                <td><span class="aLink label label-danger">Cancelled</span></td>
                                            <?php } ?>
                                        <?php } else {?>
                                            <td><span class="aLink label label-danger">Blocked</span></td>
                                            <?php if(@$res->plot->customerPlots[0]->is_open==0){?>
                                                <td><span class="aLink label label-danger">Blocked</span></td>
                                            <?php } else {?>
                                                <td><span class="aLink label label-success">Open</span></td>
                                            <?php } ?>
                                        <?php } } else{ ?>
                                            <td><span class="aLink label label-success">Available</span></td>
                                        <?php } ?>

                                        <td class="btnn"><a href="<?php echo Yii::app()->baseUrl?>/agent/deleteagentplot/<?php echo @$res->id?>"><span class="aLink label label-danger">Delete</span></a></td>
                                        
                                    </tr>
                                    
                                <?php endforeach; }?>
                            </tbody>
                            <tfoot style="font-weight: bold;">
                                <td>Total</td>
                                <td><?php echo 'PKR '.number_format(@$tComission)?></td>
                                <td><?php echo 'PKR '.number_format(@$tpComission)?></td>
                                <td><?php echo 'PKR '.number_format(@$tbComission)?></td>
                                <td colspan="8"></td>
                                
                            </tfoot>
                        </table>
                                <div class="form-group col-lg-4">
                                    <label>Block #</label>
                                    <select id="block_number" class="form-control">
                                        <option value="">Select block #</option>
                                        <?php foreach($blocks as $block):?>
                                            <option value="<?php echo $block->block_number?>" <?php (@$currentPlot['block_number'] == $block->block_number)?'selected':''?>><?php echo $block->block_number?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>

                                <div class="form-group col-lg-4" >
                                    <label>Plot type</label>
                                    <select id="plot_type" class="form-control">
                                        <option value="">Select plot #</option>
                                    </select>
                                </div>

                                <div class="form-group col-lg-4" >
                                    <label>Plot #</label>
                                    <select name="plot_number[]" id="plot_number" class="form-control">
                                        <option value="">Select plot #</option>
                                    </select>
                                </div>
                            </div>
                            

                            <div class="col-lg-12">
                                <button type="submit" class="btn btn-success">Update</button>
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
<script type="text/javascript">
    $(document).on('click', '#report2btn', function (e) {
       var divToPrint=document.getElementById("dataTables");
       newWin= window.open("");
       var heading = '<div><h3>Kainat City<span style="margin-left:25%">Kainat City</span></h3></div>';
       newWin.document.write('<style>table, th, td {border: 1px solid black;}.btnn{display: none;}</style>'+heading+divToPrint.outerHTML);
       newWin.print();
       newWin.close();
    });

</script>
            