'use strict';

$(document).ready(function() {

	var markerOld = null;

	function formatIcon(state) {
	    if (!state.id) {
	    	return state.text; 
	    }

	    return state.text;
	}

	function formatMarker(state) {
    	if (state.id == '' || state.id == 0) return state.text;
    	return "<img class='flag' src='app/img/icon/" + state.id + "' width='15px' />  " + state.text;
	}

	$("#marker").select2({
	    formatResult: formatMarker,
	    formatSelection: formatMarker,
	    escapeMarkup: function(m) { return m; }
	});

	$("#icon").select2({
	    formatResult: formatIcon,
	    formatSelection: formatIcon,
	    escapeMarkup: function(m) { return m; }
	});

});

