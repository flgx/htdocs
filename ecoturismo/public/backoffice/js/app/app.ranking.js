'use strict'

$(document).ready(function() {
	$.each($('.ranking'), function(index, value){
    	var currentRanking = $(this).attr('data-ranking');

		$(this).raty({ score: currentRanking, readOnly: true });
    });
});

