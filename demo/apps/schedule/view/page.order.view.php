<?php
	$today = time();
	$order = $dbc->GetRecord("bs_orders","*","id=".$_GET['order_id'])
?>
<div class="btn-area btn-group mb-2">
	<button type="button" class="btn btn-dark" onclick='window.history.back()'>Back</button>
</div>

<div class="card">
	<div class="car-body">
	</div>
<pre>
<?php
	var_dump($order);
?>


</pre>
</div>
