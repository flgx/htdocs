'use strict';

$(document).ready(function() {
	$("[type='checkbox']").bootstrapSwitch({
		"size"     : "min",
		"onColor"  : "success",
		"offColor" : "danger",
		"onText"   : "SI",
		"offText"  : "NO",
	});
});