'use strict';

function actionComment(commentId, obj) {
	var type = obj.attr('data-action');

	switch(type) {
		case 'block': 
			blockComment(commentId, obj);

			break;
		case 'unblock': 
			unblockComment(commentId, obj);
			break;
	}
}

function blockComment(commentId, obj) {

	var jqxhr = $.post( '/admin/comment/'+commentId+'/block', function() {})
	.done(function() {
	    alertify.success("Se ha bloqueado el comentario con éxito.");
	    obj.attr('data-action','unblock');
	    obj.removeClass('label-default');
	    obj.addClass('label-success');
	    obj.html('SI');

	})
	.fail(function() {
	    alertify.error("No se ha podido bloquear el comentario, por favor intente nuevamente.");
	});
}

function unblockComment(commentId, obj) {

	var jqxhr = $.post( '/admin/comment/'+commentId+'/unblock', function() {})
	.done(function() {
	    alertify.success("Se ha desbloqueado el comentario con éxito.");
	    obj.attr('data-action','block');
	    obj.removeClass('label-success');
	    obj.addClass('label-default');
	    obj.html('NO');

	})
	.fail(function() {
	    alertify.error("No se ha podido desbloquear el comentario, por favor intente nuevamente.");
	});
}