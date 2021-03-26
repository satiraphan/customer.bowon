<?php
	session_start();
	@ini_set('display_errors',1);
	include "../../config/define.php";
	include "../../include/db.php";
	include "../../include/oceanos.php";
	include "../../include/iface.php";
	include "../../include/demo.php";
	
	$demo = new demo;
	$dbc = new dbc;
	$dbc->Connect();
	$os = new oceanos($dbc);
	//$os->initial_lang("lang");
	$panel = new ipanel($dbc,$os->auth);
	$ui_form = new iform($dbc,$os->auth);
	
	$date = isset($_GET['date'])?$_GET['date']:date("Y-m-d");
	$today = time();
	
	$order_count = $dbc->GetRecord("bs_orders","COUNT(id)","date LIKE '".$date."'");
	$order_total = $dbc->GetRecord("bs_orders","SUM(amount)","date LIKE '".$date."'");
	
?>
<div class="row gutters-sm">
	<div class="col-xl-5 mb-3">
		<div class="card mb-3">
			<div class="card-body">
				<form class="form-inline mb-3">
					<label class="mr-sm-2">เลือกวันที่</label>
					<input name="date" type="date" class="form-control mr-sm-2" value="<?php echo $date;?>" onchange="$(this).parent().submit()">
					<button type="submit" class="btn btn-primary">Lookup</button>
				</form>
				<div class="row gutters-sm">
					<div class="col-xl-4">
						<table class="table table-striped table-sm table-bordered dt-responsive nowrap">
							<tbody>
								<tr><th class="text-center">Today kg.</th></tr>
								<tr><td class="text-center"><?php echo $order_total[0];?></td></tr>
								<tr><th class="text-center">จำนวน Order </th></tr>
								<tr><td class="text-center"><?php echo $order_count[0];?></td></tr>
							</tbody>
						</table>
						<button onclick="fn.dialog.open('apps/sales_overview/view/dialog.lock.lookup.php','#dialog_lock_lookup')"  type="button" class="btn btn-primary">Lock Report</button>
					</div>
					<div class="col-xl-8">
						<table class="table table-striped table-sm table-bordered dt-responsive nowrap">
							<tbody>
								<tr>
									<th class="text-right">B/f</th>
									<td>2,569.0</td>
									<td>48,283,154.00</td>
								</tr>
								<tr>
									<th class="text-right">Today Sale</th>
									<td>19.0</td>
									<td>366,375.30</td>
								</tr>
								<tr>
									<th class="text-right">Today Delivery</th>
									<td>-1,734.0</td>
									<td>-30,854,805.30</td>
								</tr>
								<tr>
									<th class="text-right">Adjust</th>
									<td>0.0</td>
									<td>0.00</td>
								</tr>
								<tr>
									<th class="text-right">C/f</th>
									<td>854.0</td>
									<td>17,794,724.00</td>
								</tr>
								
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="card mb-3">
			<div class="card-body">
				<table class="datatable table table-striped table-sm table-bordered dt-responsive nowrap">
					<!-- Filter columns -->
					<thead>
						<tr>
							<th class="text-center table-dark" colspan="10">Today Delivery</th>
						</tr>
						<tr>
							<th class="text-center">วันสั่ง</th>
							<th class="text-center">Delivery No.</th>
							<th class="text-center">ลูกค้า</th>
							<th class="text-center">kio</th>
							<th class="text-center">บาท/กิโล</th>
							<th class="text-center">ยอดรวม</th>
							<th class="text-center">ยอดรวม (vat)</th>
							<th class="text-center">ช่วงเวลา</th>
							<th class="text-center">คนส่ง</th>
						</tr>
					</thead>
					<!-- /Filter columns -->
					<tbody>
					<?php
						$model = array(
							array("type" => "date","format"=>"d/m/Y","class"=>"text-center"),
							array("type" => "number","format"=>"%05s","prefix"=> "D","class"=>"text-center"),
							array("type" => "databank","value"=>"name","class"=>"text-center"),
							array("type" => "number", "from"=>1 , "to"=>200,"number_format"=>1,"class"=>"text-center"),
							array("type" => "number", "from"=>25000 , "to"=>27000,"number_format"=>0,"prefix"=> "THB "),
							array("type" => "number", "from"=>25000 , "to"=>27000,"number_format"=>0,"prefix"=> "THB "),
							array("type" => "number", "from"=>25000 , "to"=>27000,"number_format"=>0,"prefix"=> "THB "),
							array("type" => "text","value"=>"เช้า","class"=>"text-center"),
							array("type" => "databank","value"=>"user","class"=>"text-center")
						);
						$demo->loop_table($model,3);
					?>
					</tbody>
				</table>
			</div>
		</div>
		<div class="card mb-3">
			<div class="card-body">
			<table class="datatable table table-striped table-sm table-bordered dt-responsive nowrap">
					<!-- Filter columns -->
					<thead>
						<tr>
							<th class="text-center table-dark" colspan="10">รายงานแยกตามวันส่ง</th>
						</tr>
						<tr>
							<th class="text-center">วันที่ส่ง</th>
							<th class="text-center">kio</th>
							<th class="text-center">ยอดรวม</th>
							<th class="text-center">ยอดรวม (vat)</th>
						</tr>
					</thead>
					<!-- /Filter columns -->
					<tbody>
					<?php
						$model = array(
							array("type" => "date","format"=>"d/m/Y","class"=>"text-center"),
							array("type" => "number", "from"=>1 , "to"=>200,"number_format"=>1,"class"=>"text-center"),
							array("type" => "number", "from"=>25000 , "to"=>27000,"number_format"=>0,"prefix"=> "THB "),
							array("type" => "number", "from"=>25000 , "to"=>27000,"number_format"=>0,"prefix"=> "THB ")
						);
						$demo->loop_table($model,3);
					?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="col-xl-7 mb-3">
		<div class="card">
			<div class="card-body">
				
				<table class="datatable table table-striped table-sm table-bordered dt-responsive nowrap">
					<thead>
						<tr>
							<th class="text-center table-dark" colspan="10">ภาพรวมการขายประจำวันที่ <?php echo date("d/m/Y",strtotime($date));?></tjh>
						</tr>
						<tr>
							<th class="text-center">วันที่สั่ง</th>
							<th class="text-center">หมายเลขส่งของ</th>
							<th class="text-center">ลูกค้า</th>
							<th class="text-center">น้ำหนัก</th>
							<th class="text-center">ราคา/กิโลกรัม</th>
							<th class="text-center">VAT</th>
							<th class="text-center">ยอดรวม</th>
							<th class="text-center">ยอดรวม(VAT)</th>
							<th class="text-center">วันที่ส่ง</th>
							<th class="text-center">ผู้ขาย</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$sql = "SELECT * FROM bs_orders WHERE DATE(date) LIKE '".$date."'";
						$rst = $dbc->Query($sql);
						while($order = $dbc->Fetch($rst)){
							echo '<tr>';
								echo '<td>'.date("d/m/Y",strtotime($date)).'</td>';
								echo '<td>'.$order['code'].'</td>';
								echo '<td>'.$order['customer_name'].'</td>';
								echo '<td>'.number_format($order['amount'],2).'</td>';
								echo '<td>'.number_format($order['price'],2).'</td>';
								echo '<td>'.number_format($order['vat_amount'],2).'</td>';
								echo '<td>'.number_format($order['total'],2).'</td>';
								echo '<td>'.number_format($order['net'],2).'</td>';
								echo '<td>'.$order['delivery_date'].'</td>';
								echo '<td>'.$order['sales'].'</td>';
							echo '</tr>';
						}
					?>
					</tbody>
				</table>
			</div>
		</div>
		
	</div>

	
</div>
<script>
	var plugins = [
		'plugins/datatables/dataTables.bootstrap4.min.css',
		'plugins/datatables/responsive.bootstrap4.min.css',
		'plugins/datatables/jquery.dataTables.bootstrap4.responsive.min.js',
		'plugins/chart.js/Chart.min.js',
		'plugins/jquery-sparkline/jquery.sparkline.min.js',
	]


	App.loadPlugins(plugins, null).then(() => {
		
		/*
		$('.datatable').DataTable({
			"dom": '<"toolbar">rtp',
			//"pageLength": 5
		});
		*/
		
		
	}).then(() => App.stopLoading())
</script>