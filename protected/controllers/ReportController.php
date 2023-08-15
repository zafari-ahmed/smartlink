<?php

class ReportController extends Controller
{
	public function actionIndex()
	{
		$sql = "SELECT id,mode FROM `payment_schedule_payment_modes` GROUP BY mode";
		$data['paymentmodes'] = Yii::app()->db->createCommand($sql)->queryAll();
		$this->render('index',$data);
	}


	public function actionReport4()
	{
		$data['paymentmodes'] = PaymentModes::model()->findAll('amount = 0');
		$this->render('index4',$data);
	}

	public function actionSearch()
	{

		$development = 0;
		// if(!empty($_POST['mode'])){
		// 	if($_POST['mode'] == 'development'){
		// 		$development = 1;
		// 	}
		// }
		$data['development'] = $development;
		$criteria = new CDbCriteria();
		
		$criteria->addCondition('t.createdOn >= :startDate AND t.createdOn <= :endDate');
		$criteria->params = array(':startDate' =>$_POST['start_date'].' 00:00:00',':endDate' =>$_POST['end_date'].' 23:59:59');
		$criteria->order = "t.createdOn ASC";
		if($_POST['transaction_type'] == 'bank'){
			$type = $_POST['transaction_type'];
			$criteria->addCondition("t.transaction_type != 'cash'");
		} else if($_POST['transaction_type'] != 'all'){
			$type = $_POST['transaction_type'];
			$criteria->addCondition("t.transaction_type LIKE '%$type%'");
		}
		
		if(!empty($_POST['mode'])){
			if($_POST['mode'] != 'all'){
				$sql = "SELECT GROUP_CONCAT(id) as id FROM payment_schedule_payment_modes WHERE mode = '".$_POST['mode']."' LIMIT 1";
				$data['paymentmodeID'] = Yii::app()->db->createCommand($sql)->queryRow();
				$criteria->addInCondition('plot_payment_mode_id',explode(',', $data['paymentmodeID']['id']));
			}
		}
		
		//$criteria->addCondition('plot.status = 1');
		//$criteria->addCondition('plot.blocked = 0');
		$criteria->addCondition('t.status = 1');
		$phaseId = Yii::app()->session->get('userModel')['phase_id'];
		//$criteria->addCondition("plot.phase_id = $phaseId");
		$trans = CustomerPlotTransactions::model()->findAll($criteria);

		//extra transacrion
		$criteriaE = new CDbCriteria();
		$criteriaE->addCondition('t.createdOn >= :startDate AND t.createdOn <= :endDate');
		if($_POST['transaction_type'] == 'bank'){
			$type = $_POST['transaction_type'];
			$criteriaE->addCondition("t.transaction_type != 'cash'");
		} else if($_POST['transaction_type'] != 'all'){
			$type = $_POST['transaction_type'];
			$criteriaE->addCondition("t.transaction_type LIKE '%$type%'");
		}

		if(!empty($_POST['mode'])){
			if($_POST['mode'] != 'all'){
				$criteriaE->addCondition("t.plot_payment_mode = '".$_POST['mode']."'");
			}
		}

		$criteriaE->params = array(':startDate' =>$_POST['start_date'].' 00:00:00',':endDate' =>$_POST['end_date'].' 23:59:59');
		$criteriaE->order = "t.createdOn ASC";
		//$criteria->addCondition('plot.status = 1');
		//$criteria->addCondition('plot.blocked = 0');
		$criteriaE->addCondition('t.status = 1');
		//print_r($criteria);exit;
		$extraTrans = CustomerPlotExtraTransactions::model()->findAll($criteriaE);	

		$data['model'] = array_merge($trans,$extraTrans);
		array_multisort( array_column($data['model'], "transaction_number"), SORT_ASC, $data['model'] );
		

		$data['modelCount'] = 0;

		//Normal Transaction
		$criteria->select = array('COUNT(DISTINCT t.plot_id) as total');
		$data['modelCountNormal'] = CustomerPlotTransactions::model()->with('plot')->find($criteria);

		//Extra Transaction
		$criteriaE->select = array('COUNT(DISTINCT t.plot_id) as total');
		$data['modelCountExtra'] = CustomerPlotExtraTransactions::model()->with('plot')->find($criteriaE);
		//}
		$data['modelCount'] = @$data['modelCountNormal']->total + @$data['modelCountExtra']->total;

		$sql = "SELECT id,mode FROM `payment_schedule_payment_modes` GROUP BY mode";
		$data['paymentmodes'] = Yii::app()->db->createCommand($sql)->queryAll();
		$this->render('index',$data);
	}


	public function actionReportdev()
	{
		$data['transactions'] = [];
		$data['paymentmodes'] = PaymentModes::model()->findAll('amount = 0');
		$this->render('indexDev',$data);
	}

	public function actionSearchdev()
	{

		$modes = $_POST['mode'];
		if($modes == 'All'){
			$modes = ['development','penalty'];
		} else{
			$modes = [$_POST['mode']];
		}
		$result['transactions'] = [];
		foreach($modes as $m){
			$criteria = new CDbCriteria();
			$criteria->addBetweenCondition('t.createdOn', @$_POST['start_date'].' 00:00:00', @$_POST['end_date'].' 23:59:59');
			$criteria->order = "t.createdOn ASC";
			if($_POST['transaction_type'] != 'all'){
				$type = $_POST['transaction_type'];
				$criteria->addCondition("t.transaction_type LIKE '%$type%'");
			}
			$criteria->addCondition('plot_payment_mode = "'.$m.'"');		
			//$criteria->addCondition('plot.status = 1');
			$models = CustomerPlotExtraTransactions::model()->with('plot')->findAll($criteria);	
			$total = 0;
			foreach($models as $index=>$data){
				$result['transactions'][$m][$index]['id'] = $data->plot->id;
				$result['transactions'][$m][$index]['plot'] = $data->plot->plot->block_number.' / '.@$data->plot->plot->plot_number;
                $result['transactions'][$m][$index]['customer_name'] = $data->plot->customer->name;
                $result['transactions'][$m][$index]['transaction_number'] = ($this->startsWith($data->transaction_number, '#'))?$data->transaction_number:'#'.$data->transaction_number;
                $result['transactions'][$m][$index]['transaction_type'] = @$data->transaction_type;
                $result['transactions'][$m][$index]['plot_payment_mode'] = $data->plot_payment_mode;
                $result['transactions'][$m][$index]['amount'] = 'Rs. '.number_format($data->amount);
                $total = $total + $data->amount;
                $result['transactions'][$m][$index]['createdOn'] = date('d M,Y',strtotime($data->createdOn));
                $result['transactions'][$m][$index]['createdBy'] = $data->createdBy;
			}
			$result['transactions'][$m]['total'] = $total;
		}
		
		$data = $result;
		$this->render('indexDev',$data);
	}

	public function actionSearch4()
	{

		$result = array();
		foreach($_POST['mode'] as $m){
			$paymentmode = PaymentModes::model()->findByPk($m);
			$criteria = new CDbCriteria();
			$criteria->select = 'SUM(t.amount) as amount,COUNT(t.id) as id,t.transaction_type,COUNT(distinct(t.plot_id)) as plot_id';
			$criteria->addCondition('t.createdOn >= :startDate AND t.createdOn <= :endDate');
			$criteria->params = array(':startDate' =>$_POST['start_date'].' 00:00:00',':endDate' =>$_POST['end_date'].' 23:59:59');
			$criteria->order = "t.createdOn ASC";
			$criteria->group = "t.transaction_type";
			if($_POST['transaction_type'] != 'all'){
				$type = $_POST['transaction_type'];
				$criteria->addCondition("t.transaction_type LIKE '%$type%'");
			}
			$criteria->addCondition("t.plot_payment_mode_id IN ($m)");
			$criteria->addCondition('plot.status = 1');
			$model = CustomerPlotTransactions::model()->with('plot')->findAll($criteria);
			
			$result[$paymentmode->mode] = $paymentmode->attributes;
			foreach($model as $mm){
				$result[$paymentmode->mode]['data'][] = $mm->attributes;	
			}
			
		}
		//echo '<pre>';print_r($result);exit;
		$data['result'] = $result;
		$data['paymentmodes'] = PaymentModes::model()->findAll('amount = 0');
		$this->render('index4',$data);
	}

	public function actionReport2()
	{	
		$data['accounts'] = Accounts::model()->findAll('is_installment = 0 AND is_visible = 1');
		$this->render('index2',$data);
	}

	public function actionReport6()
	{	
		$this->render('index6');
	}

	public function actionSearch6()
	{
		$phaseId = Yii::app()->session->get('userModel')['phase_id'];
		$criteria = new CDbCriteria();
		$criteria->addBetweenCondition('t.createdOn', @$_POST['start_date'].' 00:00:00', @$_POST['end_date'].' 23:59:59');
		$criteria->addCondition('plot.status = 1');
		$criteria->addCondition("mainPlot.phase_id = $phaseId");

		$criteria->order = "t.createdOn ASC";
		$data['model'] = CustomerPlotTransactions::model()->with(['plot','plot.plot'=>array('alias' => 'mainPlot')])->findAll($criteria);
		$data['accounts'] = Accounts::model()->findAll('is_visible = 1');
		$data['partners'] = Accounts::model()->findAll('is_installment = 0 AND is_visible = 1');

		$criteria = new CDbCriteria();
		$criteria->addBetweenCondition('t.createdOn', @$_POST['start_date'].' 00:00:00', @$_POST['end_date'].' 23:59:59');
		$criteria->order = "t.createdOn ASC";
		$data['cancelled'] = CustomerPlotCancelled::model()->findAll($criteria);

		//development
		$modes = ['development','penalty'];
		$result['transactions'] = [];
		foreach($modes as $m){
			$criteria = new CDbCriteria();
			$criteria->addBetweenCondition('t.createdOn', @$_POST['start_date'].' 00:00:00', @$_POST['end_date'].' 23:59:59');
			$criteria->order = "t.createdOn ASC";
			$criteria->addCondition('plot_payment_mode = "'.$m.'"');		
			//$criteria->addCondition('plot.status = 1');
			$models = CustomerPlotExtraTransactions::model()->with('plot')->findAll($criteria);	
			$total = 0;
			foreach($models as $index=>$datas){
				$result['transactions'][$m][$index]['id'] = $datas->plot->id;
				$result['transactions'][$m][$index]['plot'] = $datas->plot->plot->block_number.' / '.@$datas->plot->plot->plot_number;
                $result['transactions'][$m][$index]['customer_name'] = $datas->plot->customer->name;
                $result['transactions'][$m][$index]['transaction_number'] = ($this->startsWith($datas->transaction_number, '#'))?$datas->transaction_number:'#'.$datas->transaction_number;
                $result['transactions'][$m][$index]['transaction_type'] = @$datas->transaction_type;
                $result['transactions'][$m][$index]['plot_payment_mode'] = $datas->plot_payment_mode;
                $result['transactions'][$m][$index]['amount'] = 'Rs. '.number_format($datas->amount);
                $total = $total + $datas->amount;
                $result['transactions'][$m][$index]['createdOn'] = date('d M,Y',strtotime($datas->createdOn));
                $result['transactions'][$m][$index]['createdBy'] = $datas->createdBy;
			}
			$result['transactions'][$m]['total'] = $total;
		}
		
		$data['transactions'] = $result;
		$criteria = new CDbCriteria();
		$criteria->addCondition('createdOn >= :startDate AND createdOn <= :endDate');
		if(!empty($_POST['type'])){
			$criteria->addCondition('expense_type = :mode_id');
			$criteria->params = array(':startDate' =>$_POST['start_date'].' 00:00:00',':endDate' =>$_POST['end_date'].' 23:59:59',':mode_id' =>$_POST['type']);			
		} else{
			$criteria->params = array(':startDate' =>$_POST['start_date'].' 00:00:00',':endDate' =>$_POST['end_date'].' 23:59:59');			
		}
		
		$data['expenses'] = Expenses::model()->findAll($criteria);
		$this->render('index6',$data);
	}

	public function actionReport3()
	{	
		$data['paymentmodes'] = PaymentModes::model()->findAll('amount = 0');
		$data['agents'] = Agents::model()->findAll();
		$this->render('index3',$data);
	}


	public function actionSearch2()
	{
		$phaseId = Yii::app()->session->get('userModel')['phase_id'];
		$criteria = new CDbCriteria();
		$criteria->addBetweenCondition('t.createdOn', @$_POST['start_date'].' 00:00:00', @$_POST['end_date'].' 23:59:59');
		$criteria->addCondition('plot.status = 1');
		$criteria->addCondition("mainPlot.phase_id = $phaseId");

		$criteria->order = "t.createdOn ASC";
		$data['model'] = CustomerPlotTransactions::model()->with(['plot','plot.plot'=>array('alias' => 'mainPlot')])->findAll($criteria);
		//$data['accounts'] = Accounts::model()->findAll('is_installment = 0');
		$data['accounts'] = Accounts::model()->findAll('is_visible = 1');
		$data['partners'] = Accounts::model()->findAll('is_installment = 0 AND is_visible = 1');

		$criteria = new CDbCriteria();
		$criteria->addBetweenCondition('t.createdOn', @$_POST['start_date'].' 00:00:00', @$_POST['end_date'].' 23:59:59');
		$criteria->order = "t.createdOn ASC";
		$data['cancelled'] = CustomerPlotCancelled::model()->findAll($criteria);
		//echo '<pre>';print_r($criteria);
		$this->render('index2',$data);
	}


	// public function plotDiscount($id,$number_format = true){
	// 	$plot = Plots::model()->findByPk($id);
	// 	$totalDiscount = 0;
		
	// 	$total = $this->plotTotal($id,false);
	// 	$totalDiscount = $this->Percentage($total,$plot->discount,0);
	// 	//$total = $total - $totalDiscount;
	// 	if($number_format){
	// 		return number_format($totalDiscount);	
	// 	} else{
	// 		return $totalDiscount;
	// 	}
		
	// }


	// public function plotTotal($id,$number_format = true,$is_total = true){
	// 	$plot = Plots::model()->findByPk($id);
	// 	$total = 0;
	// 	if($plot){
	// 		if($is_total){
	// 		$total += $plot->total;	
	// 		}
			
	// 		if($plot->is_road_facing == 1){
	// 			$total += $this->Percentage($plot->total,$plot->is_road_facing_amount,0);
	// 		}
	// 		if($plot->is_park_facing == 1){
	// 			$total += $this->Percentage($plot->total,$plot->is_park_facing_amount,0);	
	// 		}
	// 		if($plot->is_corner == 1){
	// 			$total += $this->Percentage($plot->total,$plot->is_corner_amount,0);
	// 		}
	// 		if($plot->is_west_open == 1){
	// 			$total += $this->Percentage($plot->total,$plot->is_west_open_amount,0);
	// 		}	
	// 	}
		
	// 	if($number_format){
	// 		return number_format($total);	
	// 	} else{
	// 		return $total;
	// 	}
		
	// }

	public function plotTotal($id,$number_format = true,$is_total = true,$withside = true){
		$plot = Plots::model()->findByPk($id);
		$plotTotal = 0;
		if($is_total){
			$plotTotal += @$plot->total;	
		}

		if($plot->is_corner == 1){
            $cornerCharger = $this->Percentage($plotTotal,$plot->is_corner_amount,0);
            $plotTotal = $plotTotal + $cornerCharger;
        }

        if($plot->is_park_facing == 1){
            $parkFacing = $this->Percentage($plotTotal,$plot->is_park_facing_amount,0);
            $plotTotal = $plotTotal + $parkFacing;
        }

        if($plot->is_west_open == 1){
            $westOpen = $this->Percentage($plotTotal,$plot->is_west_open_amount,0);
            $plotTotal = $plotTotal + $westOpen;
        }

        if($number_format){
			return number_format($plotTotal);	
		} else{
			return $plotTotal;
		}
		
	}

	public function plotDiscount($id,$number_format = true){

		$plot = Plots::model()->findByPk($id);
		$totalDiscount = 0;
		if($plot->discount){
			$totalDiscount = $plot->discount;
		}
		$total = $this->plotTotal($id,false,true,false);
		$totalDiscount = $total - $totalDiscount;
		if($number_format){
			return number_format($totalDiscount);	
		} else{
			return $totalDiscount;
		}
		
	}

	public function actionSearch3()
	{
		$criteria = new CDbCriteria();
		//$criteria->addBetweenCondition('createdOn', @$_POST['start_date'], @$_POST['end_date']);
		$criteria->addCondition('t.createdOn >= :startDate AND t.createdOn <= :endDate AND plot.agent_id = :agent AND plot.status = 1');
		$criteria->order = "t.createdOn ASC";
		if(!empty($_POST['mode'])){
			$data['paymentmode'] = PaymentModes::model()->findByPk($_POST['mode']);
			$criteria->addCondition('t.plot_payment_mode_id = :mode_id');
			$criteria->params = array(':startDate' =>$_POST['start_date'].' 00:00:00',':endDate' =>$_POST['end_date'].' 23:59:59',':mode_id' =>$_POST['mode'],':agent'=>$_POST['agent']);			
		}
		else{
			$criteria->params = array(':startDate' =>$_POST['start_date'].' 00:00:00',':endDate' =>$_POST['end_date'].' 23:59:59',':agent'=>$_POST['agent']);				
		}
		
		$data['model'] = CustomerPlotTransactions::model()->with('plot')->findAll($criteria);
		$data['paymentmodes'] = PaymentModes::model()->findAll('amount = 0');
		$data['agents'] = Agents::model()->findAll();
		$data['agentSelected'] = Agents::model()->findByPk($_POST['agent']);
		$this->render('index3',$data);
	}

	public function Percentage($total,$percentage,$type=1){
		if($type == 1){
			return number_format((@$percentage / 100) * @$total);	
		} else{
			return ((@$percentage / 100) * @$total);
		}
		
	}

	public function DealerPercentage($agent,$total,$percentage,$type=1,$mode=''){
		if($mode->is_distribute == 1){
			if($type == 1){
				$total = (($total/100))/10; 
				//return number_format((((@$percentage / 100) * @$total)/100)*$agent->percentage_value);	
				return number_format((@$total*$agent->percentage_value));	
			} else{
				$total = (($total/100))/10; 
				//return (((@$percentage / 100) * @$total)/100)*$agent->percentage_value;
				return (@$total*$agent->percentage_value);
			}	
		} else{
			return 0;
		}
		
		
	}

	public function actionViewPdf(){
		$labor = Labours::model()->findByPk($id);
		$pdf = Yii::createComponent('application.extensions.tcpdf.ETcPdf', 
                        'L', 'cm', 'A4', true, 'UTF-8');
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor("ENGRO");
        $pdf->SetTitle("Applicant Training Report");
        $pdf->SetSubject("Applicant Training Report");
        $pdf->SetKeywords("Applicant Training,Report,");
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->AddPage();
        $pdf->SetFont("times", "N", 9);


        $html='<style>.table-pdf td{text-align:center;font-weight:normal;vertical-align:middle;font-style:normal;padding:10px}</style>';
        //generate report data
        
        $html .= '<table class="table-pdf" border="1">';
        $html .= '<tr><td colspan="9" style="text-align:center">'.$labor->full_name.' Training Report</td></tr>';
        
        $html .= '<tr><td colspan="9"></td></tr>';
        $html .= '<tr><td >ID</td><td>Name</td><td>Type</td><td>Batch No.</td><td>Start Date</td><td>End Date</td><td>Status</td><td>Score</td><td>Result</td></tr>';
        if($labor->traings){
        	foreach($labor->traings as $d){ 
              //foreach($requisition->clientCompanyRequisitionDetails as $d){
                $html .= '<tr><td >'.$d->training->id.'</td><td>'.$d->training->institute_name.'</td><td>'.$d->training->training_type.'</td><td>'.$d->training->batch_no.'</td><td>'.$d->training->start_date.'</td><td>'.$d->training->end_date.'</td><td>'.(($d->training->status==0)?'Open':'End').'</td><td>'.$d->score.'</td><td>'.$d->result.'</td></tr>'; 
            }
        }

        $html .= '</table>';
        // output the HTML content
        $pdf->writeHTML($html, true, true, true, true, '');
        $pdf->Output("result.pdf", "I");
	}

	public function actionCancelled()
	{	
		//$data['cancelled'] = CustomerPlotCancelled::model()->findAll(array('group'=>'booking_id'));
		$data['cancelled'] = CustomerPlotCancelled::model()->findAll();
		$this->render('cancelled',$data);
	}

	public function actionBlocked()
	{	
		//$data['cancelled'] = CustomerPlotCancelled::model()->findAll(array('group'=>'booking_id'));
		$data['cancelled'] = CustomerPlots::model()->findAll('blocked=1');
		$this->render('blocked',$data);
	}



	public function actionTransfered()
	{	
		//$data['cancelled'] = CustomerPlotCancelled::model()->findAll(array('group'=>'booking_id'));
		$data['transfered'] = CustomerPlotTransfers::model()->findAll();

		$this->render('transfered',$data);
	}



	public function actionMonthlyreport(){
		$data['paymentmodes'] = PaymentModes::model()->findAll('amount = 0');
		$this->render('monthlyreport',$data);
	}

	public function actionMonthlyreportsearch(){

		$month = date("m",strtotime($_POST['start_date']));
		$year = date("Y",strtotime($_POST['start_date']));
		$phaseId = Yii::app()->session->get('userModel')['phase_id'];
		
		$criteria = new CDbCriteria();
		$criteria->addBetweenCondition('t.createdOn',"'01-$month-$year'", "'31-$month-$year'");
		$data['model'] = CustomerPlotTransactions::model()->findAll($criteria);

		print_r($data);
	}


	public function actionExportavailableplot(){
		$phaseId = Yii::app()->session->get('userModel')['phase_id'];
		$plots = Plots::model()->findAll("status = 0 AND phase_id = $phaseId");
		$list = array (
	        array('S.No','Block #','Plot Type','Plot #','Details','Sq. Yds.','Category','SCHEDULE','Dealer','Sub Dealer','Discount','Commission','Date','Commision Recived','Payment','Number','Corner','West Open','Park Facing'),
	    );
      		
      	
        $count = 1;
        foreach($plots as $ind=>$plot):
	        $list[$count][] = $ind+1;
	        $list[$count][] = @$plot->block_number;
	        $list[$count][] = @$plot->plot_type;
	        $list[$count][] = @$plot->plot_number;
	        $list[$count][] = @$plot->plot_type.'-'.$plot->plot_number.'/'.@$plot->block_number;
            $list[$count][] = @$plot->size->size;
            $list[$count][] = @$plot->category->name;
            $list[$count][] = @($plot->agentReserve)?@$plot->agentReserve[0]->paymentSchedule->name:'';
            $list[$count][] = @($plot->agentReserve)?@$plot->agentReserve[0]->agent->name:'';
			$list[$count][] = @($plot->agentReserve)?@$plot->agentReserve[0]->agent->agentParent->name:'';
			$list[$count][] = @$plot->discount;
			$list[$count][] = @($plot->agentReserve)?@$plot->agentReserve[0]->commission:'0';
			$list[$count][] = '';
			$list[$count][] = '';
			$list[$count][] = '';
			$list[$count][] = '';
			$list[$count][] = @($plot->is_corner)?'1':'0';;
			$list[$count][] = @($plot->is_west_open)?'1':'0';;
			$list[$count][] = @($plot->is_park_facing)?'1':'0';;
			$count++;
        endforeach;

        $fileName = 'Available-Plots-'.date('Y-m-d-H-i').'.csv';
		$fp = fopen($fileName, 'w');
      	foreach ($list as $fields) {
          fputcsv($fp, $fields);
      	}



      	$filename = getcwd().'/'.$fileName;
      	header("Content-type: text/csv");
		header("Content-disposition: attachment; filename = $fileName");
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