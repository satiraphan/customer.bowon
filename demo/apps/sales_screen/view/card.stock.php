<?php
	$today = time();
	$aDate = array();
	for($i=0;$i<=7;$i++){
		array_push($aDate,$today+$i*86400);
	}
?>
<div class="card mb-3">
	<div class="card-body bg-dark">
		<table class="table table-sm table-bordered text-white">
			<tbody>
				<tr>
					<td width="4%" align="center"><input type="hidden" name="today" value="2020-11-25"></td>
					<?php
						foreach($aDate as $date){
							echo '<td width="10%" align="center">';
								echo date("D-d",$date);
							echo '</td>';
						}
					
					?>
				</tr>
				<tr>
					<td align="right">B/f</td>
					<td align="right">527.3834</td>
					<td align="right">527.3834</td>
					<td align="right">527.3834</td>
					<td align="right">527.3834</td>
					<td align="right">527.3834</td>
					<td align="right">527.3834</td>
					<td align="right">527.3834</td>
					<td align="right">527.3834</td>
				</tr>
				<tr class="bg-success">
					<td align="right">In</td>
					<td align="right">0.0000</td>
					<td align="right">0.0000</td>
					<td align="right">0.0000</td>
					<td align="right">0.0000</td>
					<td align="right">0.0000</td>
					<td align="right">0.0000</td>
					<td align="right">0.0000</td>
					<td align="right">0.0000</td>
				</tr>
				<tr class="bg-danger">
					<td align="right">Out</td>
					<td align="right">0.0000</td>
					<td align="right">0.0000</td>
					<td align="right">0.0000</td>
					<td align="right">0.0000</td>
					<td align="right">0.0000</td>
					<td align="right">0.0000</td>
					<td align="right">0.0000</td>
					<td align="right">0.0000</td>
				</tr>
				<tr>
					<td align="right">ฝาก</td>
					<td align="right">20</td>
					<td align="right">20</td>
					<td align="right">20</td>
					<td align="right">20</td>
					<td align="right">20</td>
					<td align="right">20</td>
					<td align="right">20</td>
					<td align="right">20</td>
				</tr>
				<tr>
					<td align="right">C/f</td>
					<td align="right">527.3834</td>
					<td align="right">527.3834</td>
					<td align="right">527.3834</td>
					<td align="right">527.3834</td>
					<td align="right">527.3834</td>
					<td align="right">527.3834</td>
					<td align="right">527.3834</td>
					<td align="right">527.3834</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>