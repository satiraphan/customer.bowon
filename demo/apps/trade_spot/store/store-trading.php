<?php
	session_start();
	include_once "../../../config/define.php";
	include_once "../../../include/db.php";
	include_once "../../../include/datastore.php";

	date_default_timezone_set(DEFAULT_TIMEZONE);

	$dbc = new datastore;
	$dbc->Connect();

	$columns = array(
		"id" => "bs_trade_spot.id",
		"date" => "bs_trade_spot.date",
		"type" => "'Trade'",
		"purchase_spot" => "FORMAT((SELECT AVG(rate_spot) FROM bs_purchase_spot WHERE trade_id=bs_trade_spot.id),2)",
		"purchase_amount" => "FORMAT((SELECT SUM(amount) FROM bs_purchase_spot WHERE trade_id=bs_trade_spot.id),2)",
		"purchase_usd" => "FORMAT((SELECT SUM(amount*rate_spot) FROM bs_purchase_spot WHERE trade_id=bs_trade_spot.id),2)",
		"sales_spot" => "FORMAT((SELECT AVG(rate_spot) FROM bs_sales_spot WHERE trade_id=bs_trade_spot.id),2)",
		"sales_amount" => "FORMAT((SELECT SUM(amount) FROM bs_sales_spot WHERE trade_id=bs_trade_spot.id),2)",
		"sales_usd" => "FORMAT((SELECT SUM(amount*rate_spot) FROM bs_sales_spot WHERE trade_id=bs_trade_spot.id),2)",
		"profit" => "FORMAT((SELECT SUM(amount*rate_spot) FROM bs_sales_spot WHERE trade_id=bs_trade_spot.id)-(SELECT SUM(amount*rate_spot) FROM bs_purchase_spot WHERE trade_id=bs_trade_spot.id),2)",
		"created" => "bs_trade_spot.created",
		"updated" => "bs_trade_spot.updated",
		"user" => "bs_trade_spot.user",
	);

	$table = array(
		"index" => "id",
		"name" => "bs_trade_spot",
	);

	$dbc->SetParam($table,$columns,$_GET['order'],$_GET['columns'],$_GET['search']);
	$dbc->SetLimit($_GET['length'],$_GET['start']);
	$dbc->Processing();
	echo json_encode($dbc->GetResult());

	$dbc->Close();

?>
