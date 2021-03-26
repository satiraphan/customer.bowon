$("#tblReserve").data( "selected", [] );
$("#tblReserve").DataTable({
	responsive: true,
	"bStateSave": true,
	"autoWidth" : true,
	"processing": true,
	"serverSide": true,
	"ajax": "apps/reserve_silver/store/store-reserve.php",	
	"aoColumns": [
		{"bSortable":false		,"data":"id"		,"sClass":"hidden-xs text-center",	"sWidth": "20px"  },
		{"bSort":true			,"data":"lock_date"	},
		{"bSort":true			,"data":"supplier"	},
		{"bSort":true			,"data":"weight_lock"	},
		{"bSort":true			,"data":"weight_fixed"	},
		{"bSort":true			,"data":"weight_pending"	},
		{"bSort":true			,"data":"discount"	},
		{"bSort":true			,"data":"weight_actual"	},
		{"bSort":true			,"data":"defer"	},
		{"bSort":true			,"data":"bar"	},
		{"bSort":true			,"data":"type"	},
		{"bSortable":false		,"data":"id"		,"sClass":"text-center" , "sWidth": "80px"  }
	],"order": [[ 1, "desc" ]],
	"createdRow": function ( row, data, index ) {
		var selected = false,checked = "",s = '';
		if ( $.inArray(data.DT_RowId, $("#tblReserve").data( "selected")) !== -1 ) {
			$(row).addClass("selected");
			selected = true;
		}
		$("td", row).eq(0).html(fn.ui.checkbox("chk_reserve",data[0],selected));
		if(data.type=="1"){
			$("td", row).eq(10).html("ใช้จริง");
		}else if(data.type=="2"){
			$("td", row).eq(10).html("สำรอง");
		}
		s = '';
		s += fn.ui.button("btn btn-xs btn-outline-dark","far fa-pen","fn.app.reserve_silver.reserve.dialog_edit("+data[0]+")");
		$("td", row).eq(11).html(s);
	}
});
fn.ui.datatable.selectable("#tblReserve","chk_reserve");
