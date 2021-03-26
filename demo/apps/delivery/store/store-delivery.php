<?php
	session_start();
	include_once "../../../config/define.php";
	include_once "../../../include/db.php";
	include_once "../../../include/datastore.php";

	date_default_timezone_set(DEFAULT_TIMEZONE);

	$dbc = new datastore;
	$dbc->Connect();

	$columns = array(
		"id" => "bs_deliveries.id",
		"code" => "bs_deliveries.code",
		"type" => "bs_deliveries.type",
		"delivery_date" => "bs_deliveries.delivery_date",
		"created" => "bs_deliveries.created",
		"updated" => "bs_deliveries.updated",
		"status" => "bs_deliveries.status",
		"amount" => "bs_deliveries.amount",
		"user" => "bs_deliveries.user",
		"comment" => "bs_deliveries.comment",
	);

	$table = array(
		"index" => "id",
		"name" => "bs_deliveries",
	);

	$dbc->SetParam($table,$columns,$_GET['order'],$_GET['columns'],$_GET['search']);
	$dbc->SetLimit($_GET['length'],$_GET['start']);
	$dbc->Processing();
	echo json_encode($dbc->GetResult());

	$dbc->Close();

?>
