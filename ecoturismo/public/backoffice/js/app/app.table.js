'use strict';

$(document).ready(function() {

	var urlRequest 				= $('#data-table').attr('data-url-request');
	var urlEdit 		 		= $('#data-table').attr('data-url-edit');
	var urlDestroy 		 		= $('#data-table').attr('data-url-destroy');
	var displayLength	 		= parseInt($('#data-table').attr('data-display-length'));
	var dataBoolRenderTarget 	= parseInt($('#data-table').attr('data-bool-render-target'));
	var columnActionPos  		= parseInt($('#data-table').attr('data-column-action-pos'));
	var columnRanking    		= parseInt($('#data-table').attr('data-column-ranking'));
	var columnBlock	    		= parseInt($('#data-table').attr('data-column-block'));
	var columns 		 		= getColumns();	

	if(urlDestroy !== undefined) {

		var modalDestroy	= $('#data-table').attr('data-modal-destroy');
		var buttonDestroy	= $('#data-table').attr('data-modal-button-destroy');

		$(modalDestroy).on('show.bs.modal', function(e) {
		    var dataId  = $(e.relatedTarget).data('id');
		    var destroy = urlDestroy.replace("{id}", dataId.toString());

		    if(dataId !== undefined) {
		    	$(buttonDestroy).attr('href',destroy);
		    }
		});
	}

	var tableOptions = {

		/**
		 * Request
		 */
    	"bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": urlRequest,

        /**
         * Config
         */
        "bPaginate"		: true,
        "bLengthChange"	: false,
        "bFilter"		: false,
        "bSort"			: true,
        "bInfo"			: true,
        "bAutoWidth"	: true,
        "iDisplayLength": displayLength,

        /**
         * Lang
         */
        "oLanguage": {
			"oPaginate": {
				"sPrevious": "Anterior",
				"sNext"    : "Siguiente",
			},
			"sInfoEmpty"   : "No se han econtrado registros",
			"sInfoFiltered": " - filtrado de _MAX_ registros",
			"sInfo"        : "Mostrando _START_ a _END_ de _TOTAL_ registros",
			"sProcessing"  : '&nbsp;&nbsp;&nbsp;&nbsp;Procesando...',
			"sEmptyTable"  : "No se han econtrado registros",
		},

		/**
		 * Column Action
		 */
		"aoColumnDefs": [
		    {
		    	"aTargets": [dataBoolRenderTarget],
		    	"mData"   : null,
		    	"mRender" : function(data, type, full) {
		    		if(parseInt(data) == 1) {
		    			return '<center><span class="label label-success center">SI</span></center>';
		    		} else {
		    			return '<center><span class="label label-default center">NO</span></center>';
		    		}
		    	}
		    }		    
		],

		/**
		 * Data Object
		 */
		"aoColumns": columns,
    };

    if( ! isNaN(columnActionPos)) {

    	var actions = {
	        "aTargets": [columnActionPos],
	        "mData"   : null,
	        "mRender" : function (data, type, full) {
	        	var id 		= full.id;
	        	var actions = '';

	        	if(urlEdit !== undefined) {
	        		var edit = urlEdit.replace("{id}", id.toString());
	        		actions  = '<a href="'+edit+'" class="btn btn-warning btn-s" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-edit"></i></a>'; 
	        	}
	        	
	        	if(urlDestroy !== undefined) {
	        		actions += '&nbsp;<a data-toggle="modal" data-target="'+modalDestroy+'" data-id="'+id+'" class="btn btn-danger btn-s" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="fa fa-trash-o"></i></a>';
	        	}
	        	
	        	if(actions == '') {
	        		actions = '<span class="label label-default">SIN ACCIONES</span>';
	        	}

	        	return 	actions;
                    	
	        }
		};

    	tableOptions.aoColumnDefs.push(actions);
    }

    //Add Ranking
    if( ! isNaN(columnRanking)) {
    	var ranking = {
	    	"aTargets": [columnRanking],
	    	"mData"   : null,
	    	"mRender" : function(data, type, full) {
	    		return '<div class="ranking" data-ranking="'+data+'"></div>';
	    	}
	    }	

    	tableOptions.aoColumnDefs.push(ranking);
    }

    //Add Block
    if( ! isNaN(columnBlock)) {
    	var block = {
	    	"aTargets": [columnBlock],
	    	"mData"   : null,
	    	"mRender" : function(data, type, full) {
	    		if(parseInt(data) == 1) {
	    			return '<center><span class="label label-success center action-comment" data-action="unblock" data-commentId="'+full.id+'">SI</span></center>';
	    		} else {
	    			return '<center><span class="label label-default center action-comment" data-action="block" data-commentId="'+full.id+'">NO</span></center>';
	    		}
	    	}
	    }	

    	tableOptions.aoColumnDefs.push(block);
    }

	$('#data-table').dataTable(tableOptions).on( 'draw.dt', function () {
	    $('#data-table a').tooltip();

	    $.each($('.ranking'), function(index, value){
	    	var currentRanking = $(this).attr('data-ranking');

			$(this).raty({ score: currentRanking, readOnly: true });
	    });

	    $.each($('.action-comment'), function(index, value){
	    	$(this).on('click', function(){
	    		var commentId = $(this).attr('data-commentId')
	    		actionComment(commentId, $(this));
	    	});
	    });

	   /* $.each($('.unblock-comment'), function(index, value){
	    	$(this).on('click', function(){
	    		var commentId = $(this).attr('data-commentId')
	    		blockComment(commentId);
	    	});
	    });*/


	} );;

	function getColumns()
	{
		var data 	= $('#data-table').attr('data-columns').split(',');
		var columns = new Array();

		$.each(data, function(index, value ) {
			columns[index] = {"mData":value.trim()};
		});

		return columns;
	}
});