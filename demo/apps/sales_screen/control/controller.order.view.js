
	$('#tblDailyTable').DataTable({
		responsive: true,
		"bStateSave": true,
		"autoWidth" : true,
		"processing": true,
		"serverSide": true,
		"ajax": "apps/sales_screen/store/store-order.php",
		"aoColumns": [
			{"bSortable":true	,"data":"code"		,"sClass":"hidden-xs text-center",	"sWidth": "20px"  },
			{"bSortable":true	,"data":"created"	,class:"text-center"	},
			{"bSortable":true	,"data":"delivery_date"	,"sClass":"hidden-xs text-center"},
			{"bSortable":true	,"data":"amount"	,"sClass":"hidden-xs text-right"},
			{"bSortable":true	,"data":"price"	,"sClass":"text-right"},
			{"bSortable":false	,"data":"sales"		,"sClass":"text-center" , "sWidth": "80px"  }
		],"order": [[ 1, "desc" ]],
		"createdRow": function ( row, data, index ) {
			
			$('td', row).eq(1).html(moment(data.created).format("DD/MM/YYYY HH:mm:ss"));
			if(data.delivery_date != null && data.delivery_date != "0000-00-00"){
				$('td', row).eq(2).html(moment(data.delivery_date).format("DD/MM/YYYY"));
			}else{
				$('td', row).eq(2).html("-");
			}
			
			
			
		}
	});

