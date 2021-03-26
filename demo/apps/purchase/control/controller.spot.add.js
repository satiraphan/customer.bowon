	fn.app.purchase.spot.dialog_add = function() {
		$.ajax({
			url: "apps/purchase/view/dialog.spot.add.php",
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				fn.ui.modal.setup({dialog_id : "#dialog_add_spot"});
			}
		});
	};

	fn.app.purchase.spot.add = function(){
		$.post("apps/purchase/xhr/action-add-spot.php",$("form[name=form_addspot]").serialize(),function(response){
			if(response.success){
				$("#tblSpot").DataTable().draw();
				$("form[name=form_addspot]")[0].reset();
				$("#dialog_add_spot").modal("hide");
				$("#tblPurchase").DataTable().draw();
				$("#tblPending").DataTable().draw();
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
		onclick : "fn.app.purchase.spot.dialog_add()",
		caption : "Add"
	}));
