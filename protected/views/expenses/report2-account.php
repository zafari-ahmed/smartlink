<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Account Report</h1>
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
                Filter
            </div>
            <div class="panel-body">
                <div class="row">
                    <form role="form" method="POST" action="<?php echo Yii::app()->baseUrl?>/expenses/reportsearchaccount">
                        <!-- <div class="col-lg-12"> -->
                            <div class="form-group col-lg-2" >
                                <label>Start Date</label>
                                <input class="form-control calender" name="start_date" value="<?php echo isset($_POST['start_date'])?@$_POST['start_date']:date('Y-m-d');?>" autocomplete="off" required>
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>
                            <div class="form-group col-lg-2">
                                <label>End Date</label>
                                <input class="form-control calender" name="end_date" value="<?php echo isset($_POST['end_date'])?@$_POST['end_date']:date('Y-m-d');?>" autocomplete="off"  required>
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>

                            
                            
                            </div>

                            <div class="form-group col-lg-2">
                                <button type="submit" class="btn btn-success" style="margin-top: 9%;">Submit</button>
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
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Expense Report
                <span class="pull-right">
                    <!-- <a href="<?php //echo Yii::app()->baseUrl?>/expenses/reportall"><span class="label label-success">CSV Download</span></a> -->
                    &nbsp;
                    <?php if(@$result){?>
                        <?php $start = isset($_POST['start_date'])?@$_POST['start_date']:'2021-01-01'?>
                        <?php $end = isset($_POST['end_date'])?@$_POST['end_date']:date('Y-m-d');?>
                        <a href="<?php echo Yii::app()->baseUrl?>/expenses/accountreportcsv?start=<?php echo $start?>&end=<?php echo $end?>"><span class="label label-success">CSV Report</span></a>
                    <?php }?>
                </span>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <table width="100%" class="table table-striped table-bordered table-hover" id="report2table" style="margin-bottom: 5%">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th style="background-color: #ffff00">Transactions(Cash)</th>
                            <th style="background-color: #ff9800">Expenses(Cash)</th>
                            <th style="background-color: #8bc34a">Balance(Cash)</th>
                            <th style="background-color: #ffff00">Transactions(Bank)</th>
                            <th style="background-color: #ff9800">Expenses(Bank)</th>
                            <th style="background-color: #8bc34a">Balance(Bank)</th>
                            <!-- <th>Total</th> -->
                            <th>(Previous)<br/>PettyCash</th>
                            <th style="background-color: #ff9800">PettyCash (Expense)</th>
                            <th style="background-color: #8bc34a">PettyCash Balance</th>

                            <th style="background-color: #ffff00;color:#f44336;font-weight: bold">Total Transaction</th>
                            <th style="background-color: #ff9800;color:#f44336;font-weight: bold">Total Expense</th>
                            <th style="background-color: #8bc34a;color:#f44336;font-weight: bold">Total Balance</th>


                        </tr>
                    </thead>
                    <tbody>
                        <?php $trC = $eC = $pC =  $treCT = $trO = $eO = $treOT = $mT= 0;if(@$result){ foreach(@$result as $date=>$data):?>
                            <tr>
                                <td><?php echo $date?></td>
                                <td><?php echo @$data['transaction_cash']?></td>
                                <?php $trC = $trC + @$data['transaction_cash']?>

                                <td><?php echo @$data['expense_cash']?></td>
                                <?php $eC = $eC + @$data['expense_cash']?>

                                <!-- <td><?php //echo @$data['pettyCash_cash']?></td>
                                <?php //$pC = $pC + @$data['pettyCash_cash']?> -->
                                
                                <td><?php echo @$data['transaction_cash']-$data['expense_cash']?></td>
                                <?php $treCT = $treCT + ($data['transaction_cash']-$data['expense_cash'])?>
                                
                                <td><?php echo @$data['transaction_other']?></td>
                                <?php $trO = $trO + @$data['transaction_other']?>
                                <td><?php echo @$data['expense_other']?></td>
                                <?php $eO = $eO + @$data['expense_other']?>
                                
                                <td><?php echo @$data['transaction_other']-$data['expense_other']?></td>
                                <?php $treOT = $treOT + ($data['transaction_other']-$data['expense_other'])?>

                                


                                <!--PettyCash Start-->
                                <td><?php echo @$data['pettyCash'].'</br>'.'PettyCash:'.$data['pettyCashAmount']?></td>
                                <td><?php echo @$data['pettyCashExpense']?></td>
                                <td><?php echo @$data['pettyCashBalance']?></td>



                                <td><?php echo number_format(@$data['transaction_cash']+@$data['transaction_other'])?><?php //echo ($data['transaction_cash']-$data['expense_cash'])+($data['transaction_other']-$data['expense_other'])?></td>
                                <?php $mT = $mT + ($data['transaction_cash']-$data['expense_cash'])+($data['transaction_other']-$data['expense_other'])?>
                                <td><?php echo number_format(@$data['expense_cash']+@$data['expense_other']+@$data['pettyCashExpense'])?></td>
                                <td><?php echo number_format((@$data['transaction_cash']-$data['expense_cash'])+(@$data['transaction_other']-$data['expense_other'])+@$data['pettyCashBalance'])?></td>



                                <!--PettyCash End-->
                            </tr>
                       <?php endforeach;}?>   
                                       
                    </tbody>
                </table>
                <?php if(@$result){?>
                <table width="100%" class="table table-striped table-bordered table-hover" id="report2table" style="margin-top:10px;bottom: 0%;position: fixed;background-color: #ddd;width: 60%;
                ">  <thead>
                        <tr>
                            <th>&nbsp;</th>
                            <th>Transactions(Cash)</th>
                            <th>Expenses(Cash)</th>
                            <th>Balance(Cash)</th>
                            <th>Transactions(Bank)</th>
                            <th>Expenses(Bank)</th>
                            <th>Balance(Bank)</th>
                            <th>(Previous)<br/>PettyCash</th>
                            <th>PettyCash (Expense)</th>
                            <th>PettyCash Balance</th>
                            <th>Total Transaction</th>
                            <th>Total Expense</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="font-weight: bold;">
                           <td>Total</td>
                           <td><?php echo number_format(array_sum(array_column($result,'transaction_cash')));?><?php //echo number_format(@$trC)?></td>
                           <td><?php echo number_format(array_sum(array_column($result,'expense_cash')));?><?php //echo number_format(@$eC)?></td>
                           <td><?php echo number_format(array_sum(array_column($result,'transaction_cash'))-array_sum(array_column($result,'expense_cash')));?><?php //echo number_format(@$treCT)?></td>

                           <td><?php echo number_format(array_sum(array_column($result,'transaction_other')));?><?php //echo number_format(@$trO)?></td>
                           <td><?php echo number_format(array_sum(array_column($result,'expense_other')));?><?php //echo number_format(@$eO)?></td>
                           <td><?php echo number_format(array_sum(array_column($result,'transaction_other'))-array_sum(array_column($result,'expense_other')));?><?php //echo number_format(@$treOT)?></td>

                           <td><?php echo number_format(array_sum(array_column($result,'pettyCash')));?></td>
                           <td><?php echo number_format(array_sum(array_column($result,'pettyCashExpense')));?></td>
                           <td><?php echo number_format(array_sum(array_column($result,'pettyCashBalance')));?></td>

                           <td><?php echo number_format(array_sum(array_column($result,'transaction_cash'))+array_sum(array_column($result,'transaction_other')));?></td>
                           <td><?php echo number_format(array_sum(array_column($result,'expense_cash'))+array_sum(array_column($result,'expense_other'))+array_sum(array_column($result,'pettyCashExpense')));?></td>
                           <!-- <td><?php //echo (array_sum(array_column($result,'transaction_cash'))-array_sum(array_column($result,'expense_cash')))+(array_sum(array_column($result,'transaction_other'))-array_sum(array_column($result,'expense_other')))+array_sum(array_column($result,'pettyCashBalance'));?></td> -->
                       </tr> 
                    </tbody>
                </table>
                <?php }?>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>

<script type="text/javascript">
    $(document).on('click', '#report2btn', function (e) {
       var divToPrint=document.getElementById("report2table");
       newWin= window.open("");
       newWin.document.write('<style>.noPrint{display:none}table, th, td {border: 1px solid black;}</style>'+divToPrint.outerHTML);
       newWin.print();
       newWin.close();
    });

</script>