	fn.app.sales.order.dialog_split = function(id) {
		$.ajax({
			url: "apps/sales/view/dialog.order.split.php",
			data: {id:id},
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				fn.ui.modal.setup({dialog_id : "#dialog_split_order"});
			}
		});
	};

	fn.app.sales.order.split = function(){
		$.post("apps/sales/xhr/action-split-order.php",$("form[name=form_splitorder]").serialize(),function(response){
			if(response.success){
				$("#tblOrder").DataTable().draw();
				$("#dialog_split_order").modal("hide");
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},"json");
		return false;
	};
