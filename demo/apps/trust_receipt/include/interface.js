var trust_receipt = {
	trust : {
		dialog_lookup : fn.noaccess,
		dialog_add : fn.noaccess,
		dialog_edit : fn.noaccess,
		add : fn.noaccess,
		edit : fn.noaccess
	},
};
$.extend(fn.app,{trust_receipt:trust_receipt});
