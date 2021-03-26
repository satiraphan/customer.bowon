<?php
	session_start();
	ini_set('display_errors',1);
	include_once "../../../config/define.php";
	include_once "../../../include/db.php";
	include_once "../../../include/datastore.php";
	
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new datastore;
	$dbc->Connect();
	
	$columns = array(
		"id" => "bs_quick_orders.id",
		"customer_id" => "bs_quick_orders.customer_id",
		"customer_name" => "bs_customers.name",
		"amount" => "FORMAT(bs_quick_orders.amount,2)",
		"price" => "FORMAT(bs_quick_orders.price,2)",
		"spot" => "FORMAT(bs_quick_orders.spot,2)",
		"exchange" => "FORMAT(bs_quick_orders.exchange,2)",
		"status" => "bs_quick_orders.status",
		"created" => "bs_quick_orders.created",
		"updated" => "bs_quick_orders.updated",
		"remark" => "bs_quick_orders.remark"
	);
	
	$table = array(
		"index" => "id",
		"name" => "bs_quick_orders",
		"join" => array(
			array(
				"field" => "sales",
				"table" => "bs_employees",
				"with" => "id"
			),array(
				"field" => "customer_id",
				"table" => "bs_customers",
				"with" => "id"
			)
		)
	);
	
	$dbc->SetParam($table,$columns,$_GET['order'],$_GET['columns'],$_GET['search']);
	$dbc->SetLimit($_GET['length'],$_GET['start']);
	$dbc->Processing();
	echo json_encode($dbc->GetResult());
	
	$dbc->Close();

?>



