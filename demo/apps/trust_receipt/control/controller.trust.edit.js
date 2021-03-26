	fn.app.trust_receipt.trust.dialog_edit = function(id) {
		$.ajax({
			url: "apps/trust_receipt/view/dialog.trust.edit.php",
			data: {id:id},
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				fn.ui.modal.setup({dialog_id : "#dialog_edit_trust"});
			}
		});
	};

	fn.app.trust_receipt.trust.edit = function(){
		$.post("apps/trust_receipt/xhr/action-edit-trust.php",$("form[name=form_edittrust]").serialize(),function(response){
			if(response.success){
				$("#tblTrust").DataTable().draw();
				$("#dialog_edit_trust").modal("hide");
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},"json");
		return false;
	};
