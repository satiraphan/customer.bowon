	
	
	$("form[name=order] input[name=amount],form[name=order] input[name=price]").change(function(){
		let amount = parseFloat($("form[name=order] input[name=amount]").val());
		let price = parseFloat($("form[name=order] input[name=price]").val());
		let tax = $("form[name=order] select[name=vat_percent]").val()=="2"?7:0;
		let total = amount*price;
		
		let net = total * (1 + (tax/100));
		$("form[name=order] input[name=net]").val(net);
	});
	
	$("form[name=order] select[name=customer_id]").change(function(){
		let customer_id = $(this).val();
		if(customer_id != ""){
			$.post('apps/sales_screen/xhr/action-load-customer.php',{id:customer_id},function(customer){
				for(i in customer){
					$("form[name=customer] input[name="+i+"]").val(customer[i]);
					$("form[name=customer] textarea[name="+i+"]").val(customer[i]);
				};
				$("form[name=order] input[name=contact]").val(customer['contact']);
				
				if(customer['info_memo']!=""){
					$("#info_memo").html('<div class="alert alert-danger" role="alert"><strong>ตำเตือน</strong> '+customer['info_memo']+'</div>');
				}else{
					$("#info_memo").html("");
				}
			},"json");
		}else{
			$("form[name=customer] input").val("-");
		}
	});
	
	$("input[name=delivery_lock]").change(function(){
		$("input[name=delivery_date]").prop('readOnly',$(this).prop('checked'));
	});
	
	
	
	fn.app.sales_screen.reset = function(){
		$('form[name=quick_order]')[0].reset();
		$('form[name=order]')[0].reset();
		$("#info_memo").html("");
		$('.select2').val("").trigger('change');
		return false;
	};
	
	
	fn.app.sales_screen.recalcuate = function(){
		var spot = $('form[name=rate] input[name=spot]').val();
		var exchange = $('form[name=rate] input[name=exchange]').val();
		var discount = $('form[name=rate] input[name=discount]').val();
		var margin = $('form[name=rate] input[name=margin]').val();
		
		var total = ((parseFloat(spot) + parseFloat(discount))*32.1507) * parseFloat(exchange);
		var price_extra = total+parseFloat(margin);
		$('form[name=rate] input[name=price]').val(price_extra.toFixed(2));
		
		var price1 = total;
		var price2 = total+20;
		var price3 = total+40;
		
		$('form[name=rate] input[name=price1]').val(price1.toFixed(2));
		$('form[name=rate] input[name=price2]').val(price2.toFixed(2));
		$('form[name=rate] input[name=price3]').val(price3.toFixed(2));
	};

	fn.app.sales_screen.recalcuate();