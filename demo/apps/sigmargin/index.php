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

	$panel->setApp("sigmargin","Sigmargin");
	$panel->setView(isset($_GET['view'])?$_GET['view']:'transaction');

	$panel->setMeta(array(
		array("transaction",	"Transaction",		"mr-1 far fa-history"),
		array("silver",			"Silver Trading",	"mr-1 far fa-shopping-cart"),
		array("transfer",		"Transfer/Deposit",	"mr-1 far fa-money-bill-alt"),
		array("incoming",		"Incoming Silver",	"mr-1 far fa-clipboard-check"),
		array("rollover",		"Rollover",			"mr-1 far fa-user-secret"),
		array("interest",		"Interest",			"mr-1 far fa-box"),
		array("claim",			"Claim",			"mr-1 far fa-exclamation-circle"),
		array("cash",			"USD:Cash",			"mr-1 far fa-money-bill"),
		array("Initial",		"Initial Margin",	"mr-1 far fa-building"),
		array("ohter",			"Other",			"mr-1 far fa-clone"),
	));
?>
<?php
	$panel->PageBreadcrumb();
?>
<div class="row">
	<div class="col-xl-12">
	<?php
		$panel->EchoInterface_verticle();
	?>
	</div>
</div>
<script>
	var plugins = [
		'apps/sigmargin/include/interface.js',
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
			case "transaction":
				//include "control/controller.transaction.view.js";
				//if($os->allow("sigmargin","add"))include "control/controller.transaction.add.js";
				//if($os->allow("sigmargin","edit"))include "control/controller.transaction.edit.js";
				//if($os->allow("sigmargin","remove"))include "control/controller.transaction.remove.js";
				break;
			case "silver":
				//include "control/controller.silver.view.js";
				if($os->allow("sigmargin","add"))include "control/controller.silver.add.js";
				if($os->allow("sigmargin","edit"))include "control/controller.silver.edit.js";
				if($os->allow("sigmargin","remove"))include "control/controller.silver.remove.js";
				if($os->allow("sigmargin","approve"))include "control/controller.silver.approve.js";
				break;
			case "transfer":
				//include "control/controller.transfer.view.js";
				if($os->allow("sigmargin","add"))include "control/controller.transfer.add.js";
				if($os->allow("sigmargin","edit"))include "control/controller.transfer.edit.js";
				if($os->allow("sigmargin","remove"))include "control/controller.transfer.remove.js";
				if($os->allow("sigmargin","approve"))include "control/controller.transfer.approve.js";
				break;
			case "incoming":
				//include "control/controller.incoming.view.js";
				if($os->allow("sigmargin","add"))include "control/controller.incoming.add.js";
				if($os->allow("sigmargin","edit"))include "control/controller.incoming.edit.js";
				if($os->allow("sigmargin","remove"))include "control/controller.incoming.remove.js";
				if($os->allow("sigmargin","approve"))include "control/controller.incoming.approve.js";
				break;
			case "rollover":
				//include "control/controller.rollover.view.js";
				if($os->allow("sigmargin","add"))include "control/controller.rollover.add.js";
				if($os->allow("sigmargin","edit"))include "control/controller.rollover.edit.js";
				if($os->allow("sigmargin","remove"))include "control/controller.rollover.remove.js";
				if($os->allow("sigmargin","approve"))include "control/controller.rollover.approve.js";
				break;
			case "interest":
				//include "control/controller.interest.view.js";
				if($os->allow("sigmargin","add"))include "control/controller.interest.add.js";
				if($os->allow("sigmargin","edit"))include "control/controller.interest.edit.js";
				if($os->allow("sigmargin","remove"))include "control/controller.interest.remove.js";
				if($os->allow("sigmargin","approve"))include "control/controller.interest.approve.js";
				break;
			case "claim":
				//include "control/controller.claim.view.js";
				if($os->allow("sigmargin","add"))include "control/controller.claim.add.js";
				if($os->allow("sigmargin","edit"))include "control/controller.claim.edit.js";
				if($os->allow("sigmargin","remove"))include "control/controller.claim.remove.js";
				if($os->allow("sigmargin","approve"))include "control/controller.claim.approve.js";
				break;
			case "cash":
				//include "control/controller.cash.view.js";
				if($os->allow("sigmargin","add"))include "control/controller.cash.add.js";
				if($os->allow("sigmargin","edit"))include "control/controller.cash.edit.js";
				if($os->allow("sigmargin","remove"))include "control/controller.cash.remove.js";
				if($os->allow("sigmargin","approve"))include "control/controller.cash.approve.js";
				break;
			case "Initial":
				//include "control/controller.Initial.view.js";
				if($os->allow("sigmargin","add"))include "control/controller.Initial.add.js";
				if($os->allow("sigmargin","edit"))include "control/controller.Initial.edit.js";
				if($os->allow("sigmargin","remove"))include "control/controller.Initial.remove.js";
				if($os->allow("sigmargin","approve"))include "control/controller.Initial.approve.js";
				break;
			case "ohter":
				//include "control/controller.ohter.view.js";
				if($os->allow("sigmargin","add"))include "control/controller.ohter.add.js";
				if($os->allow("sigmargin","edit"))include "control/controller.ohter.edit.js";
				if($os->allow("sigmargin","remove"))include "control/controller.ohter.remove.js";
				if($os->allow("sigmargin","apporve"))include "control/controller.ohter.apporve.js";
				break;
}
	?>
	}).then(() => App.stopLoading())
</script>
