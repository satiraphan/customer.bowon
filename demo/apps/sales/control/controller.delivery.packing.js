	fn.app.sales.delivery.dialog_packing = function(id) {
		$.ajax({
			url: "apps/sales/view/dialog.delivery.packing.php",
			data: {id:id},
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				fn.ui.modal.setup({dialog_id : "#dialog_packing_delivery"});
				var items = $("form[name=form_packing]").attr("data-items");
				if(items!=""){
					var obj = $.parseJSON(items);
					for(i in obj){
						fn.app.sales.delivery.packing_append(obj[i]);
					}
				}
				fn.app.sales.delivery.packing_calculate();
			}
		});
	};

	fn.app.sales.delivery.packing = function(){
		$.post("apps/sales/xhr/action-packing-delivery.php",$("form[name=form_packing]").serialize(),function(response){
			if(response.success){
				$("#tblDelivery").DataTable().draw();
				$("#dialog_packing_delivery").modal("hide");
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},"json");
		return false;
	};
	
	
	fn.app.sales.delivery.packing_append = function(item){
		var fn_calculate = "fn.app.sales.delivery.packing_calculate()";
		
		if(typeof item != "undefined"){
			var s ='';
			var classname = '';
			var val ='';
			s += '<tr class="pack_item">';
				classname = 'pt-2 text-center item_level';
				s += '<td xname="number" class="'+classname+'">#</td>';
				classname = 'form-control form-control-sm';
				s += '<td><input xname="name" name="name[]" type="text" class="'+classname+'" value="'+item.name+'"></td>';
				classname = 'form-control form-control-sm text-center';
				s += '<td><input xname="size" name="size[]" type="number" class="'+classname+'" onchange="'+ fn_calculate+'" value="'+item.size+'"></td>';
				classname = 'form-control form-control-sm text-center';
				s += '<td><input xname="amount" name="amount[]" type="number" class="'+classname+'" onchange="'+fn_calculate+'" value="'+item.amount+'"></td>';
				classname = 'form-control-sm form-control text-center';
				s += '<td><input xname="totaleach" name="totaleach[]" type="text" class="'+classname+'" readonly value="0"></td>';
				classname = 'form-control-sm form-control text-center';
				s += '<td><input xname="comment" name="comment[]" type="text" class="'+classname+'" placeholder="ข้อความพิเศษ" value="'+item.comment+'"></td>';
				classname = 'btn btn-sm btn-danger';
				s += '<td class="text-center"><button class="'+classname+'" onclick="$(this).parent().parent().remove();">ลบ</button></td>';
			s += '</tr>';
			$("#tblPacking tbody").append(s);
		}else{
			if($("select[name=packtype]").val()=="1"){
				var value_pack = $("select[name=packsize]").val();
				var caption_pack = $("select[name=packsize]").val() + ' กิโลกรัม';
			}else{
				var value_pack = 1;
				var caption_pack = $("select[name=packcustom]").val();
			}
			var s ='';
			var classname = '';
			var val ='';
			s += '<tr class="pack_item">';
				classname = 'pt-2 text-center item_level';
				s += '<td xname="number" class="'+classname+'">#</td>';
				classname = 'form-control form-control-sm';
				var readonly = caption_pack==""?"":" readonly";
				s += '<td><input xname="name" name="name[]" type="text" class="'+classname+'"'+readonly+' value="' + caption_pack + '"></td>';
				classname = 'form-control form-control-sm text-center';
				s += '<td><input xname="size" name="size[]" type="number" class="'+classname+'" onchange="'+ fn_calculate+'" value="'+value_pack+'"></td>';
				classname = 'form-control form-control-sm text-center';
				s += '<td><input xname="amount" name="amount[]" type="number" class="'+classname+'" onchange="'+fn_calculate+'" value="1"></td>';
				classname = 'form-control-sm form-control text-center';
				s += '<td><input xname="totaleach" name="totaleach[]" type="text" class="'+classname+'" readonly value="0"></td>';
				classname = 'form-control-sm form-control text-center';
				s += '<td><input xname="comment" name="comment[]" type="text" class="'+classname+'" placeholder="ข้อความพิเศษ"></td>';
				classname = 'btn btn-sm btn-danger';
				s += '<td class="text-center"><button class="'+classname+'" onclick="$(this).parent().parent().remove();">ลบ</button></td>';
			s += '</tr>';
			$("#tblPacking tbody").append(s);
		}
		
		fn.app.sales.delivery.packing_calculate();
	};
	
	fn.app.sales.delivery.packing_calculate = function(){
		var allocate = parseInt($("input[name=amount_limit]").val());
		var total = 0;
		var counter = 0;
		$(".pack_item").each(function(){
			var amount = parseInt($(this).find("input[xname=amount]").val());
			var size = parseInt($(this).find("input[xname=size]").val());
			var sum = amount * size;
			$(this).find("input[xname=totaleach]").val(sum);
			total += sum;
			$(this).find("td[xname=number]").html(++counter);
		});
		
		$("input[name=total]").val(total);
		$("input[name=remain]").val(allocate-total);
	};
