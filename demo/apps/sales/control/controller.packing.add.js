	fn.app.sales.packing.dialog_add = function() {
		$.ajax({
			url: "apps/sales/view/dialog.packing.add.php",
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				fn.ui.modal.setup({dialog_id : "#dialog_add_packing"});
				
				
				$("input[name=delivery_date]").unbind().change(function(){
					var date = $(this).val();
					$.post("apps/sales/xhr/action-load-packing.php",{date:date},function(json){
						var s = '';
						
						for(i in json){
							s += '<tr>';
								s += '<td><input readonly class="form-control text-center" name="name[]" value="'+json[i].name+'"></td>';
								s += '<td><input xname="size" readonly class="form-control text-center" name="size[]" value="'+json[i].size+'"></td>';
								s += '<td class="text-center">'+json[i].amount+'</td>';
								s += '<td><input  xname="amount" class="form-control text-center" name="amount[]" value="'+json[i].amount+'" onchange="fn.app.sales.packing.calculation()"></td>';
								s += '<td xname="total" class="text-center"></td>';
								s += '<td><input class="form-control text-center" name="comment[]" value="'+json[i].comment+'"></td>';
							s += '</tr>';
						}
						
						$("#tblPackAdding tbody").html(s);
						fn.app.sales.packing.calculation();
					},"json");
					
				}).change();
				
				
			}
		});
	};
	
	fn.app.sales.packing.calculation = function(){
		var total = 0;
		$("#tblPackAdding tbody tr,#tblPackEditing tbody tr").each(function(){
			var amount = parseInt($(this).find("input[xname=amount]").val());
			var size = parseInt($(this).find("input[xname=size]").val());
			var eachtotal = size*amount;
			$(this).find("input[xname=total]").html(eachtotal);
			total += size*amount;
		});
		$("input[name=total]").val(total);
	};

	fn.app.sales.packing.add = function(){
		$.post("apps/sales/xhr/action-add-packing.php",$("form[name=form_addpacking]").serialize(),function(response){
			if(response.success){
				$("#tblPacking").DataTable().draw();
				$("#dialog_add_packing").modal("hide");
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},"json");
		return false;
	};
	$(".btn-area").append(fn.ui.button({
		class_name : "btn btn-light has-icon",
		icon_type : "material",
		icon : "add_circle_outline",
		onclick : "fn.app.sales.packing.dialog_add()",
		caption : "Add"
	}));
