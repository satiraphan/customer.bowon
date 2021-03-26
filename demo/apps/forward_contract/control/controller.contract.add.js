	fn.app.forward_contract.contract.dialog_add = function() {
		$.ajax({
			url: "apps/forward_contract/view/dialog.contract.add.php",
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				fn.ui.modal.setup({dialog_id : "#dialog_add_contract"});
			}
		});
	};

	fn.app.forward_contract.contract.add = function(){
		$.post("apps/forward_contract/xhr/action-add-contract.php",$("form[name=form_addcontract]").serialize(),function(response){
			if(response.success){
				$("#tblContract").DataTable().draw();
				$("#dialog_add_contract").modal("hide");
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
		onclick : "fn.app.forward_contract.contract.dialog_add()",
		caption : "Add"
	}));
