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
	
	$order = $dbc->GetRecord("bs_orders","*","id=".$_POST['id']);

	if($_POST['amount_a']==""){
		echo json_encode(array(
			'success'=>false,
			'msg'=>'ต้องระบุค่า'
		));
	}else if($_POST['amount_b']==""){
		echo json_encode(array(
			'success'=>false,
			'msg'=>'ต้องระบุค่า'
		));
	}else if($_POST['amount_a']+$_POST['amount_b']!=$order['amount']){
		echo json_encode(array(
			'success'=>false,
			'msg'=>'ผลรวมไม่ถูกต้องโปรดคำนวณใหม่'
		));
	}else{
		
		$total = $_POST['amount_a']*$order['price'];
		if($order['vat_type']=="2"){$vat = $order['price']*0.07;}else{$vat = 0;}
		$net = $total+$vat;
		
		$data = array(
			'#id' => "DEFAULT",
			"code" => $order['code'].".1",
			"#customer_id" => $order['customer_id'],
			"customer_name" => $order['customer_name'],
			"date" => $order['date'],
			"#sales" => $order['sales']!=""?$order['sales']:"NULL",
			"#user" => $order['user'],
			"#type" => $order['type'],
			"#parent" => $order['id'],
			'#created' => 'NOW()',
			'#updated' => 'NOW()',
			"#amount" => $_POST['amount_a'],
			"#price" => $order['price'],
			"#vat_type" => $order['vat_type'],
			"#vat" => $vat,
			"#total" => $total,
			"#net" => $net,
			"delivery_time" => $order['delivery_time'],
			"#status" => 1,
			"comment" => $order['comment'],
			"shipping_address" => $order['shipping_address'],
			"billing_address" => $order['billing_address'],
			"#rate_spot" => $order['rate_spot'],
			"#rate_exchange" => $order['rate_exchange'],
			"billing_id" => $order['billing_id'],
			"currency" => $order['currency'],
			"info_payment" => $order['info_payment'],
			"info_contact" => $order['info_contact']
		);
		if($_POST['date_a']==""){
			$data['#delivery_date'] = "NULL";
		}else{
			$data['delivery_date'] = $_POST['date_a'];
		}
		$dbc->Insert("bs_orders",$data);
		$order_id = $dbc->GetID();
		$order_a = $dbc->GetRecord("bs_orders","*","id=".$order_id);
		
		//เมื่อมีการสร้าง Delivery Date แล้ว
		if(!is_null($order_a['delivery_date'])){
			$data = array(
				"#id" => "DEFAULT",
				"#type" => 1,
				"delivery_date" => $order_a['delivery_date'],
				"#created" => "NOW()",
				"#updated" => "NOW()",
				"#status" => 0,
				"#amount" => $order_a['amount'],
				"#user" => $os->auth['id'],
				"comment" => ""
			);
			
			$dbc->Insert("bs_deliveries",$data);
			$delivery_id = $dbc->GetID();
			
			$code = "D-".sprintf("%07s", $delivery_id);
			$dbc->Update("bs_deliveries",array("code"=>$code),"id=".$delivery_id);
			$dbc->Update("bs_orders",array("delivery_id"=>$delivery_id),"id=".$order_a['id']);
		}
		
		
		$total = $_POST['amount_a']*$order['price'];
		if($order['vat_type']=="2"){$vat = $order['price']*0.07;}else{$vat = 0;}
		$net = $total+$vat;
		
		$data = array(
			'#id' => "DEFAULT",
			"code" => $order['code'].".2",
			"#customer_id" => $order['customer_id'],
			"customer_name" => $order['customer_name'],
			"date" => $order['date'],
			"#sales" => $order['sales']!=""?$order['sales']:"NULL",
			"#user" => $order['user'],
			"#type" => $order['type'],
			"#parent" => $order['id'],
			'#created' => 'NOW()',
			'#updated' => 'NOW()',
			"#amount" => $_POST['amount_b'],
			"#price" => $order['price'],
			"#vat_type" => $order['vat_type'],
			"#vat" => $vat,
			"#total" => $total,
			"#net" => $net,
			"delivery_time" => $order['delivery_time'],
			"#status" => 1,
			"comment" => $order['comment'],
			"shipping_address" => $order['shipping_address'],
			"billing_address" => $order['billing_address'],
			"#rate_spot" => $order['rate_spot'],
			"#rate_exchange" => $order['rate_exchange'],
			"billing_id" => $order['billing_id'],
			"currency" => $order['currency'],
			"info_payment" => $order['info_payment'],
			"info_contact" => $order['info_contact']
		);
		
		if($_POST['date_b']==""){
			$data['#delivery_date'] = "NULL";
		}else{
			$data['delivery_date'] = $_POST['date_b'];
		}
		$dbc->Insert("bs_orders",$data);
		$order_id = $dbc->GetID();
		$order_b = $dbc->GetRecord("bs_orders","*","id=".$order_id);
		
		//เมื่อมีการสร้าง Delivery Date แล้ว
		if(!is_null($order_b['delivery_date'])){
			$data = array(
				"#id" => "DEFAULT",
				"#type" => 1,
				"delivery_date" => $order_b['delivery_date'],
				"#created" => "NOW()",
				"#updated" => "NOW()",
				"#status" => 0,
				"#amount" => $order_b['amount'],
				"#user" => $os->auth['id'],
				"comment" => ""
			);
			
			$dbc->Insert("bs_deliveries",$data);
			$delivery_id = $dbc->GetID();
			
			$code = "D-".sprintf("%07s", $delivery_id);
			$dbc->Update("bs_deliveries",array("code"=>$code),"id=".$delivery_id);
			$dbc->Update("bs_orders",array("delivery_id"=>$delivery_id),"id=".$order_b['id']);
		}
		
		$data = array(
			'#status' => 0,
			'#updated' => 'NOW()'
		);

		if($dbc->Update("bs_orders",$data,"id=".$_POST['id'])){
			echo json_encode(array(
				'success'=>true
			));
			$order = $dbc->GetRecord("bs_orders","*","id=".$_POST['id']);
			$os->save_log(0,$_SESSION['auth']['user_id'],"order-split",$_POST['id'],array("bs_orders" => $order));
		}else{
			echo json_encode(array(
				'success'=>false,
				'msg' => "No Change"
			));
		}
	}
	
	

	$dbc->Close();
?>
