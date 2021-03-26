$("#tblProduce").data( "selected", [] );
$("#tblProduce").DataTable({
	responsive: true,
	"bStateSave": true,
	"autoWidth" : true,
	"processing": true,
	"serverSide": true,
	"ajax": "apps/production/store/store-produce.php",	
	"aoColumns": [
		{"bSortable":false		,"data":"id"		,"sClass":"hidden-xs text-center",	"sWidth": "20px"  },
		{"bSort":true			,"data":"created"	},
		{"bSort":true			,"data":"submited"	},
		{"bSort":true			,"data":"round"	},
		{"bSort":true			,"data":"import_bar"	},
		{"bSort":true			,"data":"type_material"	},
		{"bSort":true			,"data":"import_bar_weight"	},
		{"bSort":true			,"data":"import_weight_in"	},
		{"bSort":true			,"data":"import_weight_actual"	},
		{"bSort":true			,"data":"import_weight_margin"	},
		{"bSort":true			,"data":"weight_in_safe"	},
		{"bSort":true			,"data":"weight_in_total"	},
		{"bSort":true			,"data":"weight_margin"	},
		{"bSort":true			,"data":"weight_out_safe"	},
		{"bSort":true			,"data":"weight_out_total"	},
		{"bSortable":false		,"data":"id"		,"sClass":"text-center" , "sWidth": "80px"  }
	],"order": [[ 1, "desc" ]],
	"createdRow": function ( row, data, index ) {
		var selected = false,checked = "",s = '';
		if ( $.inArray(data.DT_RowId, $("#tblProduce").data( "selected")) !== -1 ) {
			$(row).addClass("selected");
			selected = true;
		}
		$("td", row).eq(0).html(fn.ui.checkbox("chk_produce",data[0],selected));
		s = '';
		s += fn.ui.button("btn btn-xs btn-outline-dark","far fa-pen","window.location='#apps/production/index.php?view=edit&id="+data[0]+"'");
		$("td", row).eq(15).html(s);
	}
});
fn.ui.datatable.selectable("#tblProduce","chk_produce");
