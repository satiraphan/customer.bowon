	fn.app.trust_receipt.trust.dialog_add = function() {
		$.ajax({
			url: "apps/trust_receipt/view/dialog.trust.add.php",
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				fn.ui.modal.setup({dialog_id : "#dialog_add_trust"});
			}
		});
	};

	fn.app.trust_receipt.trust.add = function(){
		$.post("apps/trust_receipt/xhr/action-add-trust.php",$("form[name=form_addtrust]").serialize(),function(response){
			if(response.success){
				$("#tblTrust").DataTable().draw();
				$("#dialog_add_trust").modal("hide");
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
		onclick : "fn.app.trust_receipt.trust.dialog_add()",
		caption : "Add"
	}));
