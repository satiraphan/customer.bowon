	fn.app.purchase.spot.dialog_edit = function(id) {
		$.ajax({
			url: "apps/purchase/view/dialog.spot.edit.php",
			data: {id:id},
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				fn.ui.modal.setup({dialog_id : "#dialog_edit_spot"});
			}
		});
	};

	fn.app.purchase.spot.edit = function(){
		$.post("apps/purchase/xhr/action-edit-spot.php",$("form[name=form_editspot]").serialize(),function(response){
			if(response.success){
				$("#tblSpot").DataTable().draw();
				$("#tblPurchase").DataTable().draw();
				$("#tblPending").DataTable().draw();
				$("#dialog_edit_spot").modal("hide");
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},"json");
		return false;
	};
