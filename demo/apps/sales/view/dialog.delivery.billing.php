<?php
	session_start();
	include_once "../../../config/define.php";
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);

	include_once "../../../include/db.php";
	include_once "../../../include/oceanos.php";
	include_once "../../../include/iface.php";

	$dbc = new dbc;
	$dbc->Connect();

	$os = new oceanos($dbc);
	$delivery = $dbc->GetRecord("bs_deliveries","*","id=".$_POST['id']);

	$modal = new imodal($dbc,$os->auth);

	$modal->setModel("dialog_billing_delivery","Billing");
	$modal->initiForm("form_billingdelivery");
	$modal->setExtraClass("modal-lg");
	$modal->setButton(array(
		array("close","btn-secondary","Dismiss"),
		array("action","btn-outline-dark","Save Change","fn.app.sales.delivery.billing()")
	));
	$modal->SetVariable(array(
		array("id",$delivery['id'])
	));
	
	$blueprint = array(
		array(
			array(
				"name" => "billing_id",
				"caption" => "Billing ID",
				"placeholder" => "หมายเลขบิล",
				"value" => $delivery['billing_id']
			)
		)
	);

	$modal->SetBlueprint($blueprint);
	$modal->EchoInterface();
	$dbc->Close();
?>
