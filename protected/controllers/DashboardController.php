<?php

class DashboardController extends Controller
{
	public $layout='main';
	
	public function init()
    {
        $this->checkSession();

    }
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}

	public function actionFetchall(){
		$term = @$_REQUEST['q'];
		$blocks = Plots::model()->findAll(array(
            'select'=>'t.block_number',
            'distinct'=>true,
            'condition'=>"t.block_number LIKE :number",
            'params'    => array(':number' => "%$term%")
        )); 
		$data = [];

		foreach($blocks as $bb){
			$d['id'] = $bb->block_number;
			$d['text'] = $bb->block_number;
			array_push($data, $d);
		}

        $transactions = CustomerPlotTransactions::model()->findAll(array(
            'select'=>'t.transaction_number',
            'distinct'=>true,
            'condition'=>"t.transaction_number LIKE :number",
            //'params'=>array(':number'=>$term)
            'params'    => array(':number' => "%$term%")
        ));


        foreach($transactions as $transaction){
			$d['id'] = $transaction->transaction_number;
			$d['text'] = $this->startsWith($transaction->transaction_number, '#')?$transaction->transaction_number:'#'.$transaction->transaction_number;
			array_push($data, $d);
		}


		$transactions = CustomerPlotExtraTransactions::model()->findAll(array(
            'select'=>'t.transaction_number',
            'distinct'=>true,
            'condition'=>"t.transaction_number LIKE :number",
            //'params'=>array(':number'=>$term)
            'params'    => array(':number' => "%$term%")
        ));


        foreach($transactions as $transaction){
			$d['id'] = 'Dev-'.$transaction->transaction_number;
			$d['text'] = 'Dev- '.($this->startsWith($transaction->transaction_number, '#')?$transaction->transaction_number:'#'.$transaction->transaction_number);
			array_push($data, $d);
		}


		echo json_encode($data);


	}

}