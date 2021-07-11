	fn.app.sales.delivery.dialog_billing = function(id) {
		$.ajax({
			url: "apps/sales/view/dialog.delivery.billing.php",
			data: {id:id},
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				fn.ui.modal.setup({dialog_id : "#dialog_billing_delivery"});
			}
		});
	};

	fn.app.sales.delivery.billing = function(){
		$.post("apps/sales/xhr/action-billing-delivery.php",$("form[name=form_billingdelivery]").serialize(),function(response){
			if(response.success){
				$("#tblDelivery").DataTable().draw();
				$("#dialog_billing_delivery").modal("hide");
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},"json");
		return false;
	};
