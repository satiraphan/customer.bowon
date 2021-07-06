<?php
	session_start();
	include_once "../../../config/define.php";
	include_once "../../../include/db.php";
	include_once "../../../include/oceanos.php";

	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);

	$dbc = new dbc;
	$dbc->Connect();
	$os = new oceanos($dbc);


	if($dbc->HasRecord("rollovers","name = '".$_POST['name']."'")){
		echo json_encode(array(
			'success'=>false,
			'msg'=>'Rollover Name is already exist.'
		));
	}else{
		$data = array(
			'#id' => "DEFAULT",
			'name' => $_POST['name'],
			'#created' => 'NOW()',
			'#updated' => 'NOW()'
		);

		if($dbc->Insert("rollovers",$data)){
			$rollover_id = $dbc->GetID();
			echo json_encode(array(
				'success'=>true,
				'msg'=> $rollover_id
			));

			$rollover = $dbc->GetRecord("rollovers","*","id=".$rollover_id);
			$os->save_log(0,$_SESSION['auth']['user_id'],"rollover-add",$rollover_id,array("rollovers" => $rollover));
		}else{
			echo json_encode(array(
				'success'=>false,
				'msg' => "Insert Error"
			));
		}
	}

	$dbc->Close();
?>
