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

	
		$data = array(
			'amount' => $_POST['total'],
			'#updated' => 'NOW()',
		);

		if($dbc->Update("bs_stock_prepare",$data,"id=".$_POST['id'])){
			$dbc->Delete("bs_stock_items","prepare_id=".$_POST['id']);
			
			for($i=0;$i<count($_POST['name']);$i++){
				$data = array(
					"#id" => "DEFAULT",
					"#prepare_id" => $_POST['id'],
					"name" => $_POST['name'][$i],
					"#size" => $_POST['size'][$i],
					"#amount" => $_POST['amount'][$i],
					"comment" => $_POST['comment'][$i],
					"#status" => 0,
				);
				
				$dbc->Insert("bs_stock_items",$data);
			}
			
			
			echo json_encode(array(
				'success'=>true
			));
			$packing = $dbc->GetRecord("bs_stock_items","*","id=".$_POST['id']);
			$os->save_log(0,$_SESSION['auth']['user_id'],"packing-edit",$_POST['id'],array("packings" => $packing));
		}else{
			echo json_encode(array(
				'success'=>false,
				'msg' => "No Change"
			));
		}
	

	$dbc->Close();
?>
