<?php

class ExpensesController extends Controller
{
	public function actionAdd()
	{
		$data['accounts'] = Accounts::model()->findAll();
		$data['phases'] = Phases::model()->findAll();
		$data['booking'] = [];
		if(isset($_GET['booking_id'])){
			$data['booking'] = CustomerPlots::model()->findByPk($_GET['booking_id']);	
		}
		$criteria = new CDbCriteria();
		$criteria->group = "paid_to";
		$data['paid_to_list'] = Expenses::model()->findAll($criteria);
		
		$this->render('add',$data);
	}

	public function actionDelete($status,$id)
	{
		if($status==1){
			$expense = Expenses::model()->findByPk($id);
			$expense->status = 1;
			$expense->save(false);
			Yii::app()->user->setFlash('success','Expense update successfully.');
            $this->redirect(Yii::app()->baseUrl.'/expenses');
		}
		if($status!=1){
			$data['expense'] = Expenses::model()->findByPk($id);
			$data['status'] = 0;
			$this->render('delete',$data);
		}
		
	}

	public function actionSummary()
	{
		$userModel = Yii::app()->session->get('userModel');
		$phaseId = Yii::app()->session->get('userModel')['phase_id'];
		$sql = "SELECT expense_type,SUM(amount) as amount FROM expenses WHERE STATUS = 1 AND expense_type != 15 AND phase_id = $phaseId GROUP BY expense_type;";
  		$data['result'] = $expenseData = Yii::app()->db->createCommand($sql)->queryAll();
  		$expenseJson = [];
  		foreach($expenseData as $in=>$expense){
  			$expenseJson[$in]['name'] = ucfirst($this->expenseType(@$expense['expense_type']));
  			$expenseJson[$in]['y'] = $expense['amount'];
  		}
  		$data['expenseJson'] = $expenseJson;
  		//echo '<pre>';print_r($data);exit;
		$this->render('indexSummarize',$data);
	}

	public function actionIndex()
	{
		$userModel = Yii::app()->session->get('userModel');
		$criteria = new CDbCriteria();
		if(isset($_GET['development'])){
			$criteria->addCondition("expense_type = 'development'");	
		} else{
			$criteria->addCondition("expense_type != 'development'");
		}

		$phaseId = Yii::app()->session->get('userModel')['phase_id'];
		$criteria->addCondition("phase_id = $phaseId");
		
		$criteria->order = "createdOn DESC";
		$data['expenses'] = $expenses = Expenses::model()->findAll($criteria);


		$userModel = Yii::app()->session->get('userModel');
		$criteria = new CDbCriteria();
		$criteria->addCondition("phase_id = $phaseId");
		$criteria->order = "createdOn DESC";
		$data['expensesPettyCash'] = $expensesPettyCash = PettyCashExpenses::model()->findAll($criteria);
		
		$data['expenses'] = array_merge($expenses,$expensesPettyCash);

		$this->render('index',$data);
	}

	public function actionSave(){
		if($_POST['description']){
			$expense = new Expenses;
			$expense->attributes = $_POST;
			$expense->account_id = 5;
			$expense->user_id = Yii::app()->session['userModel']['id'];
			$expense->createdOn = $_POST['createdOn'].' '.date('H:i:s');
			$expense->status = 2;
			$expense->save(false);
			if($_POST['expense_type']==15){
				$pettyCash = new PettyCash;
				$pettyCash->expense_id = $expense->id;
				$pettyCash->amount = $_POST['amount'];
				$pettyCash->description = $_POST['description'];
				$pettyCash->reference_number = $_POST['number'];
				$pettyCash->phase_id = Yii::app()->session->get('userModel')['phase_id'];
				$pettyCash->created_by = Yii::app()->session['userModel']['id'];
				$pettyCash->createdOn = $_POST['createdOn'].' '.date('H:i:s');
				$pettyCash->save();

				//update expense as approved
				$expense->status = 1;
				$expense->save(false);
			}
			Yii::app()->user->setFlash('success','Expense add successfully.');
            $this->redirect(Yii::app()->baseUrl.'/expenses');
		}
	}

	public function actionEdit($id)
	{
		$data['accounts'] = Accounts::model()->findAll();
		$data['phases'] = Phases::model()->findAll();
		$criteria = new CDbCriteria();
		$criteria->group = "paid_to";
		$data['paid_to_list'] = Expenses::model()->findAll($criteria);
		$data['expense'] = expenses::model()->findByPk($id);
		
		$this->render('edit',$data);
		
	}


	public function actionUpdate(){
		if($_POST['id']){
			$expense = Expenses::model()->findByPk($_POST['id']);
			$expense->attributes = $_POST;
			$expense->status = @$_POST['status'];
			$expense->reason = @$_POST['reason'];
			$expense->save(false);
			if($_POST['expense_type']==15){
				$pettyCash = PettyCash::model()->find('expense_id = :id',array(':id'=>$expense->id));
				$pettyCash->expense_id = $expense->id;
				$pettyCash->amount = @$_POST['amount'];
				$pettyCash->description = @$_POST['description'];
				$pettyCash->reference_number = @$_POST['number'];
				$pettyCash->phase_id = Yii::app()->session->get('userModel')['phase_id'];
				$pettyCash->created_by = Yii::app()->session['userModel']['id'];
				$pettyCash->createdOn = @$_POST['createdOn'].' '.date('H:i:s');
				$pettyCash->save();
			}
			Yii::app()->user->setFlash('success','Expense update successfully.');
            $this->redirect(Yii::app()->baseUrl.'/expenses');
		}
	}

	public function actionReport()
	{	$criteria = new CDbCriteria();
		$criteria->group = "paid_to";
		$data['paid_to_list'] = Expenses::model()->findAll($criteria);
		$this->render('report2',$data);
	}

	public function actionReportsearch()
	{	
		//echo '<pre>';print_r($_POST);exit;
		$criteria = new CDbCriteria();
		//$criteria->addBetweenCondition('createdOn', @$_POST['start_date'], @$_POST['end_date']);
		$criteria->addCondition('createdOn >= :startDate AND createdOn <= :endDate');
		$criteria->addCondition("expense_type != 15");	
		if($_POST['paid_to']!='All'){
			$criteria->addCondition("paid_to = '{$_POST['paid_to']}'");	
		}

		if($_POST['payment_mode']!='All'){
			$criteria->addCondition("payment_mode = '{$_POST['payment_mode']}'");	
		}
		
		if(!empty($_POST['expense_type'])){
			$criteria->addCondition('expense_type = :mode_id');
			$criteria->params = array(':startDate' =>$_POST['start_date'].' 00:00:00',':endDate' =>$_POST['end_date'].' 23:59:59',':mode_id' =>$_POST['expense_type']);			
		} else{
			$criteria->params = array(':startDate' =>$_POST['start_date'].' 00:00:00',':endDate' =>$_POST['end_date'].' 23:59:59');			
		}
		
		$data['expenses'] = Expenses::model()->findAll($criteria);
		$criteria = new CDbCriteria();
		$criteria->group = "paid_to";
		$data['paid_to_list'] = Expenses::model()->findAll($criteria);
		$this->render('report2',$data);
	}


	public function actionexpenseinvoice($id,$type='expense'){
		if($type=='expense'){
			$data['expense'] = Expenses::model()->findByPk($id);
		} else{
			$data['expense'] = PettyCashExpenses::model()->findByPk($id);
		}
		$this->renderpartial('printInvoice',$data);
	}


	public function getIndianCurrency(float $number)
	{
	    $decimal = round($number - ($no = floor($number)), 2) * 100;
	    $hundred = null;
	    $digits_length = strlen($no);
	    $i = 0;
	    $str = array();
	    $words = array(0 => '', 1 => 'one', 2 => 'two',
	        3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',
	        7 => 'seven', 8 => 'eight', 9 => 'nine',
	        10 => 'ten', 11 => 'eleven', 12 => 'twelve',
	        13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
	        16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',
	        19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',
	        40 => 'forty', 50 => 'fifty', 60 => 'sixty',
	        70 => 'seventy', 80 => 'eighty', 90 => 'ninety');
	    $digits = array('', 'hundred','thousand','lac', 'crore');
	    while( $i < $digits_length ) {
	        $divider = ($i == 2) ? 10 : 100;
	        $number = floor($no % $divider);
	        $no = floor($no / $divider);
	        $i += $divider == 10 ? 1 : 2;
	        if ($number) {
	            $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
	            $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
	            $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
	        } else $str[] = null;
	    }
	    $Rupees = implode('', array_reverse($str));
	    $paise = ($decimal) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
	    return ($Rupees ? $Rupees . ' Rupees Only ' : '') . $paise;
	}

	public function actionReportall(){
		$phaseId = Yii::app()->session->get('userModel')['phase_id'];
		$list = array (
	        array('#','H.O.A','Desc','Amount','Mode','Bank','Ref.','Paid To','CNIC/NTN','Cr. By','Date','Status','Reason'),
	    );
      	$criteria = new CDbCriteria();
		$phaseId = Yii::app()->session->get('userModel')['phase_id'];
		$criteria->addCondition("phase_id = $phaseId");
      	//$criteria->addCondition("status = 1");
      	$expenses = Expenses::model()->findAll($criteria);
        $count = 1;
        foreach($expenses as $expense):
        	
	        $list[$count][] = @$this->getExpenseRegNo($expense->id);
	        $list[$count][] = ucfirst($this->expenseType(@$expense->expense_type));
	        $list[$count][] = $expense->description;
	        $list[$count][] = number_format($expense->amount);
	        $list[$count][] = @$expense->payment_mode;
	        $list[$count][] = @$expense->bank;
	        $list[$count][] = '*'.@$expense->number.'*';
	        $list[$count][] = ucfirst(@$expense->paid_to);
	        $list[$count][] = @$expense->cnic;
	        $list[$count][] = @$expense->user->first_name.''.@$expense->user->last_name;
	        $list[$count][] = ($expense->createdOn);
	        if($expense->status==0){
	        	$list[$count][] = 	'Rejected';
	        }
	        if($expense->status==1){
	        	$list[$count][] = 	'Approved';
	        }
	        if($expense->status==2){
	        	$list[$count][] = 	'Pending';
	        }
           	$count++;
        endforeach;
        //echo '<pre>';print_r($list);exit;
        $fName = 'allExpense-'.date('dMY-h:i').'.csv';
		$fp = fopen($fName, 'w');
      	foreach ($list as $fields) {
          fputcsv($fp, $fields);
      	}

      	$filename = getcwd().'/'.$fName;
      	header("Content-type: text/csv");
		header("Content-disposition: attachment; filename = $fName");
		readfile($filename);
	}

	public function actionaccounts(){
		$this->render('report2-account');
	}

	public function actionReportsearchaccount()
	{	
		$startDate  = $data['start_date'] = $_POST['start_date'].' 00:00:00';
		$endDate = $data['end_date'] = $_POST['end_date'].' 23:59:59';
		$days = [];
		$period = new DatePeriod(
		     new DateTime($_POST['start_date']),
		     new DateInterval('P1D'),
		     new DateTime($_POST['end_date'])
		);
		
		//$days[] = $period->start->format('Y-m-d');
		foreach ($period as $key => $value) {
		    $days[] = $value->format('Y-m-d');   
		}
		$days[] = $period->end->format('Y-m-d');

		//Cash Transaction
		//$sqlTransactions = "SELECT DATE(createdOn) as `date`,SUM(CASE WHEN transaction_type = 'cash' THEN Amount ELSE 0 END) AS cash_amount ,SUM(CASE WHEN transaction_type != 'cash' THEN Amount ELSE 0 END) AS other_amount FROM customer_plot_transactions WHERE status = 1 AND `createdOn` BETWEEN '{$startDate}' AND '{$endDate}' GROUP BY DATE(createdOn) ORDER BY `createdOn` ASC;";

		$sqlTransactions = "SELECT DATE(createdOn) as `date`,SUM(CASE WHEN transaction_type = 'cash' THEN Amount ELSE 0 END) AS cash_amount ,SUM(CASE WHEN transaction_type != 'cash' THEN Amount ELSE 0 END) AS other_amount FROM customer_plot_transactions WHERE status = 1 AND createdOn >= '{$startDate}' AND createdOn <= '{$endDate}' GROUP BY DATE(createdOn) ORDER BY `createdOn` ASC";
		
		$transactions = Yii::app()->db->createCommand($sqlTransactions)->queryAll();
        $transactionsArray = [];
        if($transactions){
        	foreach($transactions as $transaction){
        		$transactionsArray[$transaction['date']]['cash_amount'] = $transaction['cash_amount'];
        		$transactionsArray[$transaction['date']]['other_amount'] = $transaction['other_amount'];
        	}
        }

        //Extra Transaction
        $sqlExtraTransactions = "SELECT DATE(createdOn) as `date`,SUM(CASE WHEN transaction_type = 'cash' THEN Amount ELSE 0 END) AS cash_amount ,SUM(CASE WHEN transaction_type != 'cash' THEN Amount ELSE 0 END) AS other_amount FROM customer_plot_extra_transactions WHERE status = 1 AND createdOn >= '{$startDate}' AND createdOn <= '{$endDate}' GROUP BY DATE(createdOn) ORDER BY `createdOn` ASC;";
        
        $extraTransactions = Yii::app()->db->createCommand($sqlExtraTransactions)->queryAll();
        
        if($extraTransactions){
        	foreach($extraTransactions as $extraTransaction){
        		$transactionsArray[$extraTransaction['date']]['cash_amount'] += $extraTransaction['cash_amount'];
        		$transactionsArray[$extraTransaction['date']]['other_amount'] += $extraTransaction['other_amount'];
        	}
        }
        
        
        //Cash Expense & other
        $sqlExpenses = "SELECT DATE(createdOn) as `date`,SUM(CASE WHEN payment_mode  = 'cash' THEN Amount ELSE 0 END) AS cash_amount ,SUM(CASE WHEN payment_mode  != 'cash' THEN Amount ELSE 0 END) AS other_amount FROM expenses WHERE status = 1 AND `createdOn` BETWEEN '{$startDate}' AND '{$endDate}' GROUP BY DATE(createdOn) ORDER BY `createdOn` ASC;";
		$expenses = Yii::app()->db->createCommand($sqlExpenses)->queryAll();
		$expenseArray = [];
		if($expenses){
        	foreach($expenses as $expense){
        		$expenseArray[$expense['date']]['cash_amount'] = $expense['cash_amount'];
        		$expenseArray[$expense['date']]['other_amount'] = $expense['other_amount'];
        	}
        }

		//Final Result
		$result = [];
		foreach($days as $day){
				//transactions
				$result[$day]['transaction_cash'] = array_key_exists($day, $transactionsArray)?$transactionsArray[$day]['cash_amount']:0;
				$result[$day]['transaction_other'] = array_key_exists($day, $transactionsArray)?$transactionsArray[$day]['other_amount']:0;

				//Expenses
				$result[$day]['expense_cash'] = array_key_exists($day, $expenseArray)?$expenseArray[$day]['cash_amount']:0;
				$result[$day]['expense_other'] = array_key_exists($day, $expenseArray)?$expenseArray[$day]['other_amount']:0;
		}

		$data['result'] = $result;
		$this->render('report2-account',$data);
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