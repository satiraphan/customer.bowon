	fn.app.delivery.delivery.dialog_prepare = function(id) {
		$.ajax({
			url: "apps/delivery/view/dialog.delivery.prepare.php",
			data: {id:id},
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				fn.ui.modal.setup({dialog_id : "#dialog_prepare_delivery"});
			}
		});
	};

	fn.app.delivery.delivery.prepare = function(){
		$.post("apps/delivery/xhr/action-prepare-delivery.php",$("form[name=form_preparedelivery]").serialize(),function(response){
			if(response.success){
				$("#tblDelivery").DataTable().draw();
				$("#dialog_prepare_delivery").modal("hide");
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},"json");
		return false;
	};
	
	fn.app.delivery.delivery.prepare_append_driver = function() {
		var total_driver = 0;
		$("#tblDriver > thead > tr > th").each(function(){
			total_driver++;
		});
		$("#tblDriver > thead > tr > td").before("<th>ผู้ส่ง "+(total_driver+1)+"</th>");
		var s = '<td>' + $("#tblDriver > tbody > tr > td:fisrt-child").html() + '</td>';
		$("#tblDriver > tbody > tr > td").before(s);
		
		/*
		("#tblDriver tbody tr:first-child").html();
		v$("#tblDriver tbody tr:first-child").html();
		*/
	};
