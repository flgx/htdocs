'use strict'

var App =  {

	layout: '<div class="block-screen"><p><img src="/img/ajax-loader.gif" class="center-block img-responsive" height="" width=""/>{MESSAGE}</p></div>',

	initWait : function(message) {

		if(message != undefined) {
			var message = this.layout.replace("{MESSAGE}", message);
		} else {
			var message = this.layout.replace("{MESSAGE}", '');
		}

		$('.skin-blue').append(message);
	},

	stopWait: function(message) {
		$('.block-screen').hide();
	}
}

window.app = App;
