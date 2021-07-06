<div class="card h-100">
	<div class="card-header border-0">
		<h6>ทำรายการสั่งซื้อ</h6>
	</div>
	<div class="card-body">
		<form name="form_addimport">
			<input type="hidden" name="date" value="<?php echo date("Y-m-d");?>">
			<input type="hidden" name="select_spot" value="">
			<input type="hidden" name="select_amount" value="">
			<table class="table table-bordered table-form">
				<tbody>
					<tr>
						<td><label>Bank</label></td>
						<td>
						<?php
							$ui_form->EchoItem(array(
								
								"type" => "comboboxdatabank",
								"source" => "db_bank",
								"name" => "default_bank",
								"caption" => "ธนาคาร",
								"default" => array(
									"value" => "none",
									"name" => "ไม่ระบุ"
								)
								
							));
						?>
						</td>
						<td><label>วันที่ โอน</label></td>
						<td>
						<?php
							$ui_form->EchoItem(array(
								"type" => "date",
								"name" => "transfer_date"
							));
						?>
						</td>
					</tr>
					<tr>
						<td><label>ชำระเงิน</label></td>
						<td colspan=3>
						<?php
							$ui_form->EchoItem(array(
								"type" => "combobox",
								"name" => "method",
								"source" => array(
									"ค่าสินค้า","Deposit","จ่าย Non-Fixed"
								)
							));
						?>
						</td>
					</tr>
					<tr>
						<td><label>เลือก</label></td>
						<td colspan="3"><div id="select_reserve" class="p-2"></div>
						</td>
					</tr>
					<tr>
						<td><label>Fixed Rate</label></td>
						<td>
						<?php
							$ui_form->EchoItem(array(
								"name" => "amount",
								"readonly" => true
							));
						?>
						</td>
						<td><label>Non Fixed</label></td>
						<td>
						<?php
							$ui_form->EchoItem(array(
								"name" => "amount",
								"readonly" => true
							));
						?>
						</td>
					</tr>
					<tr>
						<td><label>Total Transfer</label></td>
						<td>
						<?php
							$ui_form->EchoItem(array(
								"name" => "amount",
								"readonly" => true
							));
						?>
						</td>
						<td><label>Coutner Rate</label></td>
						<td>
						<?php
							$ui_form->EchoItem(array(
								"name" => "amount",
								"readonly" => true
							));
						?>
						</td>
					</tr>
					<tr>
						<td><label>Net Goods Value</label></td>
						<td>
						<?php
							$ui_form->EchoItem(array(
								"name" => "amount",
								"readonly" => true
							));
						?>
						</td>
						<td><label>Deposit</label></td>
						<td>
						<?php
							$ui_form->EchoItem(array(
								"name" => "amount",
								"readonly" => true
							));
						?>
						</td>
					</tr>
				</tbody>
			</table>
			<button class="btn btn-primary" type="button" onclick="fn.app.import.import.add()">ทำรายการ</button>
		</form>
	</div>
</div>