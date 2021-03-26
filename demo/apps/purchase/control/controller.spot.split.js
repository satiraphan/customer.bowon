	fn.app.purchase.spot.dialog_split = function(id) {
		$.ajax({
			url: "apps/purchase/view/dialog.spot.split.php",
			data: {id:id},
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				fn.ui.modal.setup({dialog_id : "#dialog_split_spot"});
			}
		});
	};

	fn.app.purchase.spot.split = function(){
		
		$.post("apps/purchase/xhr/action-split-spot.php",$("form[name=form_splitspot]").serialize(),function(response){
			if(response.success){
				$("#tblSpot").DataTable().draw();
				$("#dialog_split_spot").modal("hide");
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},"json");
		
		return false;
	};
