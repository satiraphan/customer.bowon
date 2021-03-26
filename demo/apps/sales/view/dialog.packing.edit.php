<?php
	session_start();
	include_once "../../../config/define.php";
	include_once "../../../include/db.php";
	include_once "../../../include/oceanos.php";
	include_once "../../../include/iface.php";

	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);

	$dbc = new dbc;
	$dbc->Connect();

	$os = new oceanos($dbc);

	class myModel extends imodal{
		function body(){
			$dbc = $this->dbc;
			$prepare = $dbc->GetRecord("bs_stock_prepare","*","id=".$_POST['id']);
			?>
			<form name="form_editpacking">
				<input type="hidden" name="id" value="<?php echo $prepare['id'];?>">
				<div class="form-group row display-group" display-group="daily">
					<label class="col-sm-2 col-form-label text-right">สำหรับจัดส่งในวันที่</label>
					<div class="col-sm-10">
						<input name="delivery_date" type="date" class="form-control" value="<?php echo $prepare['delivery_date'];?>">
					</div>
				</div>
				
			<hr>
			<table id="tblPackEditing" class="mt-3 table table-striped table-bordered" cellspacing="0" width="100%">
				<thead>
					<thead>
						<tr>
							<th class="text-center">รายการ</th>
							<th class="text-center">ขนาด</th>
							<th class="text-center">จำนวนที่สั่งผลิต</th>
							<th class="text-center">รวมกิโลกรัม</th>
							<th class="text-center">หมายเหตุ</th>
						</tr>
					</thead>
				</thead>
				<tbody>
				<?php
					$sql = "SELECT * FROM bs_stock_items WHERE prepare_id = ".$prepare['id'];
					$rst = $dbc->Query($sql);
					while($line = $dbc->Fetch($rst)){
						echo '<tr>';
							echo '<td><input readonly class="form-control text-center" name="name[]" value="'.$line['name'].'"></td>';
							echo '<td><input xname="size" readonly class="form-control text-center" name="size[]" value="'.$line['size'].'"></td>';
							echo '<td><input xname="amount" class="form-control text-center" name="amount[]" value="'.$line['amount'].'" onchange="fn.app.sales.packing.calculation()"></td>';
							echo '<td xname="total" class="text-center">'.$line['amount']*$line['size'].'</td>';
							echo '<td><input class="form-control text-center" name="comment[]" value="'.$line['comment'].'"></td>';
							
							
						echo '</tr>';
					}
				?>
				</tbody>
				<tfoot>
					<tr>
						<th class="text-right" colspan="3">ยอดรวม</th>
						<th class="text-center">
							<div class="input-group input-group-sm">
								<input name="total" type="text" class="form-control text-right" readonly value="<?php echo $prepare['amount'];?>">
								<div class="input-group-append">
									<span class="input-group-text">กิโลกรัม</span>
								</div>
							</div>
						</th>
						<th></th>
					</tr>
					
				</tfoot>
				<tbody>
				</tbody>
			</table>
			</form>
			
			<?php
		}
	}

	$modal = new myModel($dbc,$os->auth);
	$modal->setParam($_POST);
	$modal->setModel("dialog_edit_packing","Save Change");
	$modal->setExtraClass("modal-full");
	$modal->setButton(array(
		array("close","btn-secondary","Dismiss"),
		array("action","btn-danger","Packing","fn.app.sales.packing.edit()")
	));
	$modal->EchoInterface();

	$dbc->Close();
?>
