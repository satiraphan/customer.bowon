<?php
	session_start();
	@ini_set('display_errors',1);
	include "../../config/define.php";
	include "../../include/db.php";
	include "../../include/oceanos.php";
	include "../../include/iface.php";

	$dbc = new dbc;
	$dbc->Connect();
	$os = new oceanos($dbc);
	$panel = new ipanel($dbc,$os->auth);

	$panel->setApp("forward_contract","ForwardContract");
	$panel->setView(isset($_GET['view'])?$_GET['view']:'contract');

	$panel->setMeta(array(
		array("contract","Contract","far fa-user"),
	));
?>
<?php
	$panel->PageBreadcrumb();
?>
<div class="row">
	<div class="col-xl-12">
	<?php
		$panel->EchoInterface();
	?>
	</div>
</div>
<script>
	var plugins = [
		'apps/forward_contract/include/interface.js',
		'plugins/datatables/dataTables.bootstrap4.min.css',
		'plugins/datatables/responsive.bootstrap4.min.css',
		'plugins/datatables/jquery.dataTables.bootstrap4.responsive.min.js',
		'plugins/select2/css/select2.min.css',
		'plugins/select2/js/select2.min.js',
		'plugins/moment/moment.min.js'
	];
	App.loadPlugins(plugins, null).then(() => {
		App.checkAll()
	<?php
		switch($panel->getView()){
			case "contract":
				include "control/controller.contract.view.js";
				if($os->allow("forward_contract","add"))include "control/controller.contract.add.js";
				if($os->allow("forward_contract","edit"))include "control/controller.contract.edit.js";
				if($os->allow("forward_contract","remove"))include "control/controller.contract.remove.js";
				if($os->allow("forward_contract","split"))include "control/controller.contract.split.js";
				break;
}
	?>
	}).then(() => App.stopLoading())
</script>
