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
				<?php include "view/card.overview.php";?>
				
			</div>
		</div>
		<div class="card mb-3">
			<div class="card-body">
				<?php include "view/card.delivery.php";?>
				
			</div>
		</div>
		<div class="card mb-3">
			<div class="card-body">
				<?php include "view/card.delivery_future.php";?>
			</div>
		</div>
	</div>
	<div class="col-xl-7 mb-3">
		<div class="card">
			<div class="card-body">
				<?php include "view/card.sales.php";?>
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