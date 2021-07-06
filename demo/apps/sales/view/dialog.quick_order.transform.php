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
	$order = $dbc->GetRecord("bs_quick_orders","*","id=".$_POST['id']);

	class myModel extends imodal{
		private $os = null;
		
		function setOS($os){
			$this->os = $os;
		}
		
		function body(){
			$dbc = $this->dbc;
			$order = $dbc->GetRecord("bs_quick_orders","*","id=".$this->param['id']);
			$customer = $dbc->GetRecord("bs_customers","*","id=".$order['customer_id']);
			
			echo '<ul class="list-group list-group-horizontal mb-3">';
				echo '<li class="list-group-item flex-fill text-center">';
					echo '<div class="text-secondary">ID</div><strong>'.$this->param['id'].' </strong>';
				echo '</li>';
				echo '<li class="list-group-item flex-fill text-center">';
					echo '<div class="text-secondary">Created</div><strong>'.$order['created'].' </strong>';
				echo '</li>';
				echo '<li class="list-group-item flex-fill text-center">';
					echo '<div class="text-secondary">Sales</div><strong>'.$this->os->auth['display'].' </strong>';
				echo '</li>';
			echo '</ul>';
			
			
			echo '<table class="table">';
				echo '<tbody>';
					echo '<tr><th class="text-right">customer</th><td>'.$customer['name'].'</td></tr>';
					echo '<tr><th class="text-right">created</th><td>'.$order['created'].'</td></tr>';
					echo '<tr><th class="text-right">amount</th><td>'.$order['amount'].'</td></tr>';
					echo '<tr><th class="text-right">price</th><td>'.$order['price'].'</td></tr>';
					echo '<tr><th class="text-right">spot</th><td>'.$order['rate_spot'].'</td></tr>';
					echo '<tr><th class="text-right">exchange</th><td>'.$order['rate_exchange'].'</td></tr>';
					echo '<tr><th class="text-right">remark</th><td>'.$order['remark'].'</td></tr>';
				echo '</tbody>';
			echo '</table>';
		}
	}
	
	$modal = new myModel($dbc,$os->auth);
	$modal->setOS($os);
	$modal->setParam($_POST);
	$modal->setModel("dialog_transform_quick_order","Transform to Order");
	$modal->setExtraClass("modal-lg");
	$modal->setButton(array(
		array("close","btn-secondary","Dismiss"),
		array("action","btn-primary","Create Order","fn.app.sales.quick_order.transform(".$_POST['id'].")")
	));

	$modal->EchoInterface();
	$dbc->Close();
?>