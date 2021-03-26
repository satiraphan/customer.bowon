<div class="card">
	<div class="card-body">
		<div id="info_memo"></div>
		<form name="customer">
			<table class="table table-bordered table-form">
				<tbody>
					<tr>
						<td><label>ชื่อลูกค้า</label></td>
						<td><input name="name" type="text" class="form-control" value="-" readonly></td>
						<td rowspan=4><label>comment</label></td>
						<td rowspan=4><textarea name="info_comment" class="form-control" rows="6" readonly></textarea></td>
					</tr>
					<tr>
						<td><label>เบอร์โทรศัพท์</label></td>
						<td><input name="phone" type="text" class="form-control" value="-" readonly></td>
					</tr>
					<tr>
						<td><label>แฟร์ก</label></td>
						<td><input name="fax" type="text" class="form-control" value="-" readonly></td>
					</tr>
					<tr>
						<td><label>ชื่อผู้ติดต่อ</label></td>
						<td><input name="contact" type="text" class="form-control" value="-" readonly></td>
					</tr>
					<tr>
						<td><label>อีเมลล์</label></td>
						<td><input name="email" type="text" class="form-control" value="-" readonly></td>
						<td><label>ธนาคาร</label></td>
						<td><input name="info_bank" type="text" class="form-control" value="-" readonly></td>
					</tr>
					<tr>
						<td><label>ผู้ขาย</label></td>
						<td><input name="sales" type="text" class="form-control" value="-" readonly></td>
						<td><label>หมายเหตุ</label></td>
						<td><input name="inf_comment" type="text" class="form-control" value="-" readonly></td>
					</tr>
				</tbody>
			</table>
			<button onclick="fn.app.customer.customer.dialog_edit($('form[name=order] select[name=customer_id]').val())" class="btn btn-primary" type="button">แก้ไข</button>	
		</form>
	</div>
</div>