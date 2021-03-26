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
			if($dbc->hasRecord("bs_stock_prepare","status = 0")){
				echo '<h3>ไม่สามารถเพิ่มรายการได้จนกว่าจะปิด Case</h3>';
				
			}else{
			
			?>
			<form name="form_addpacking">
				<div class="form-group row display-group" display-group="daily">
					<label class="col-sm-2 col-form-label text-right">สำหรับจัดส่งในวันที่</label>
					<div class="col-sm-10">
						<input name="delivery_date" type="date" class="form-control" value="<?php echo date("Y-m-d");?>">
					</div>
				</div>
				
			<hr>
			<table id="tblPackAdding" class="mt-3 table table-striped table-bordered" cellspacing="0" width="100%">
				<thead>
					<thead>
						<tr>
							<th class="text-center">รายการ</th>
							<th class="text-center">ขนาด</th>
							<th class="text-center">จำนวนที่ต้องการ</th>
							<th class="text-center">จำนวนที่สั่งผลิต</th>
							<th class="text-center">รวมกิโลกรัม</th>
							<th class="text-center">หมายเหตุ</th>
						</tr>
					</thead>
				</thead>
				<tfoot>
					<tr>
						<th class="text-right" colspan="3">ยอดรวม</th>
						<th class="text-center">
							<div class="input-group input-group-sm">
								<input name="total" type="text" class="form-control text-right" readonly value="0">
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
	}

	$modal = new myModel($dbc,$os->auth);
	$modal->setParam($_POST);
	$modal->setModel("dialog_add_packing","Save Change");
	$modal->setExtraClass("modal-full");
	$modal->setButton(array(
		array("close","btn-secondary","Dismiss"),
		array("action","btn-danger","Packing","fn.app.sales.packing.add()")
	));
	$modal->EchoInterface();

	$dbc->Close();
?>
