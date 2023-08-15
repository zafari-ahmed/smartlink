<?php

class TransactionsController extends Controller
{
	public function actionIndex()
	{
		$status = isset($_GET['status'])?$_GET['status']:1;
		$phaseId = Yii::app()->session->get('userModel')['phase_id'];
		$data['status'] = $status;
		if($status==0){
			$transactions = CustomerPlotTransactions::model()->with('plot')->findAll("t.status = $status AND t.`reason` IS NOT NULL AND t.phase_id = $phaseId");		
		} else{
			$transactions = CustomerPlotTransactions::model()->with('plot')->findAll("t.status = $status AND t.phase_id = $phaseId");	
		}
		
		$transactionsExtra = CustomerPlotExtraTransactions::model()->with('plot')->findAll("t.status = $status AND t.phase_id = $phaseId");
		$data['trasactions'] = array_merge($transactions,$transactionsExtra);
		// echo '<pre>'.$status.'<br/>';
		// echo count($transactionsExtra).'<br/>';
		// echo count($transactions);
		// exit;
		$this->render('index',$data);
	}


	public function getTransactionMessage($id,$type='transaction'){
		$phaseId = Yii::app()->session->get('userModel')['phase_id'];
		if($type=='transaction'){
			$transaction = CustomerPlotTransactions::model()->findAll("phase_id = $phaseId AND transaction_number = :key AND status = 1",array(':key'=>$id));	
		} else{
			$transactionExtra = CustomerPlotExtraTransactions::model()->findAll("phase_id = $phaseId AND transaction_number = :key AND status = 1",array(':key'=>$id));
		}
		$transaction = CustomerPlotTransactions::model()->findAll("phase_id = $phaseId AND transaction_number = :key AND status = 1",array(':key'=>$id));	
		$transactionExtra = CustomerPlotExtraTransactions::model()->findAll("phase_id = $phaseId AND transaction_number = :key AND status = 1",array(':key'=>$id));

		
		$transactions = array_merge($transaction,$transactionExtra);
		//echo '<pre>';print_r($transactions);exit;
		//$transaction = CustomerPlotTransactions::model()->findAll("phase_id = $phaseId AND transaction_number = :key",array(':key'=>$id));
		$total = 0;
		$msg = '';
		if($transactions){
			$id = @$transaction[0]->plot_id;
			$cplots = CustomerPlots::model()->findByPk(@$transaction[0]->plot_id);
			foreach ($transactions as $key => $value) {
				$total = $total + $value->amount;
			}
			if($cplots){
				$msg = "Dear ".ucfirst($transaction[0]->customer->name).",\nThankyou for Paying Amount(PKR): ".number_format($total)."/= on ".date('d M, o',strtotime($transaction[0]->createdOn))." against your Plot ".$cplots->plot->plot_type."-".$cplots->plot->plot_number." in Block ".$cplots->plot->block_number.".\n\nFor details, please call 021-37440935";	
			}
			
		}
		return $msg;
	}


	public function actionReportalltransactioncancelled(){

		$phaseId = Yii::app()->session->get('userModel')['phase_id'];
		$list = array (
	        array('Receipt No','Client Name','Block #','Plot Type','Plot #','Payment Mode','Total','Comment','Date','Transaction','bank','Reference Number','Sub Dealer', 'Dealer'),
	    );
      		
      	
		$model = new CustomerPlotTransactions;
      	
		//$sql = "SELECT t.transaction_number,c.name as customer_name,SUM(t.amount) as total,GROUP_CONCAT( DISTINCT p.mode ORDER BY p.id SEPARATOR ', ') as p_modes,pl.block_number as block_number ,pl.plot_type,pl.plot_number,cp.id,t.comment,t.createdOn,t.transaction_type,t.bank,t.branch,a.name as agent,ap.name as agentParent,t.reference_number FROM `customer_plot_transactions` t LEFT JOIN payment_schedule_payment_modes p ON p.id = t.plot_payment_mode_id LEFT JOIN customers c ON c.id = t.customer_id LEFT JOIN customer_plots cp ON cp.id = t.plot_id LEFT JOIN plots pl ON pl.id = cp.plot_id LEFT JOIN agents a ON cp.agent_id = a.id LEFT JOIN agents ap ON ap.id = a.parent_id WHERE (t.status = 1 AND cp.status = 1) AND cp.phase_id =  $phaseId GROUP BY transaction_number ORDER BY `transaction_number` ASC";
		$sql = "SELECT t.transaction_number,c.name as customer_name,t.amount as total,p.mode as p_modes,pl.block_number as block_number ,pl.plot_type,pl.plot_number,cp.id,t.comment,t.createdOn,t.transaction_type,t.bank,t.branch,a.name as agent,ap.name as agentParent,t.reference_number FROM `customer_plot_transactions` t LEFT JOIN payment_schedule_payment_modes p ON p.id = t.plot_payment_mode_id LEFT JOIN customers c ON c.id = t.customer_id LEFT JOIN customer_plots cp ON cp.id = t.plot_id LEFT JOIN plots pl ON pl.id = cp.plot_id LEFT JOIN agents a ON cp.agent_id = a.id LEFT JOIN agents ap ON ap.id = a.parent_id WHERE (t.status = 1 AND cp.status = 1) AND cp.phase_id =  $phaseId ORDER BY `transaction_number` ASC";
		//echo $sql;exit;
		$bookings = Yii::app()->db->createCommand($sql)->queryAll();

		$sqlExtra = "SELECT t.transaction_number,c.name as customer_name,t.amount as total,t.plot_payment_mode as p_modes,pl.block_number as block_number ,pl.plot_type,pl.plot_number,cp.id,t.comment,t.createdOn,t.transaction_type,t.bank,t.branch,a.name as agent,ap.name as agentParent,t.reference_number FROM `customer_plot_extra_transactions` t LEFT JOIN customers c ON c.id = t.customer_id LEFT JOIN customer_plots cp ON cp.id = t.plot_id LEFT JOIN plots pl ON pl.id = cp.plot_id LEFT JOIN agents a ON cp.agent_id = a.id LEFT JOIN agents ap ON ap.id = a.parent_id WHERE (t.status = 1 AND cp.status = 1) AND cp.phase_id =  $phaseId ORDER BY `transaction_number` ASC";
		$bookingsExtra = Yii::app()->db->createCommand($sqlExtra)->queryAll();

		$finalTransactions = array_merge($bookings,$bookingsExtra);
		array_multisort( array_column($finalTransactions, "transaction_number"), SORT_ASC, $finalTransactions );
        $count = 1;
        foreach($finalTransactions as $tt):
        	//$list[$count][] = @$count;
	        $list[$count][] = @$tt['transaction_number'];
	        $list[$count][] = @$tt['customer_name'];
            $list[$count][] = @$tt['block_number'];
            $list[$count][] = @$tt['plot_type'];
	        $list[$count][] = @$tt['plot_number'];
	        //$list[$count][] = @$tt['size->size'];
            $list[$count][] = @$tt['p_modes'];
            $list[$count][] = @$tt['total'];
            $list[$count][] = @$tt['comment'];
            $list[$count][] = $tt['createdOn'];//date('d M,o',strtotime(@$tt['createdOn']));
            $list[$count][] = $tt['transaction_type'];
            $list[$count][] = ($tt['transaction_type']!='cash')?$tt['bank'].' - '.$tt['branch']:'-';
            $list[$count][] = @$tt['reference_number'];
            $list[$count][] = @$tt['agent'];
            $list[$count][] = @$tt['agentParent'];
			$count++;
		endforeach;
		$fName = 'alltransactions_'.date('dMY-h:i').'.csv';
		$fp = fopen($fName, 'w');
      	foreach ($list as $fields) {
          fputcsv($fp, $fields);
      	}

      	$filename = getcwd().'/'.$fName;
      	header("Content-type: text/csv");
		header("Content-disposition: attachment; filename = $fName");
		readfile($filename);
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}