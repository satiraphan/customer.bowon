<?php
	global $os;
	$rate_exchange = $os->load_variable("rate_exchange");
	$rate_spot = $os->load_variable("rate_spot");
	$rate_pmdc = $os->load_variable("rate_pmdc");

?>
<ul class="list-group list-group-horizontal">
	<li class="list-group-item flex-fill text-center">
		<div class="text-secondary">Exchagne Rate</div>
		<h1><strong id="exchange_rate"><?php echo number_format($rate_exchange,3);?></strong></h1>
		<button class="btn btn-warning" onclick="fn.app.datapanel.master.dialog_change_exchange()">Change</button>
	</li>
	<li class="list-group-item flex-fill text-center">
		<div class="text-secondary">Spot Rate</div>
		<h1><strong id="exchange_rate"><?php echo number_format($rate_spot,3);?></strong></h1>
		<button class="btn btn-warning" onclick="fn.app.datapanel.master.dialog_change_spot()">Change</button>
	</li>
	<li class="list-group-item flex-fill text-center">
		<div class="text-secondary">Premium/Discount</div>
		<h1><strong id="exchange_rate"><?php echo number_format($rate_pmdc,2);?></strong></h1>
		<button class="btn btn-warning" onclick="fn.app.datapanel.master.dialog_change_pmdc()">Change</button>
	</li>
</ul>