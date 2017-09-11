/**
 * Highlight File block type implementation.
 *
 * js for form controller for add/edit
 *
 * Copyright 2017 - TDSystem Beratung & Training - Thomas Dausner (aka dausi)
 *
 */
(function($) {
	//
	// validity check winHeight
	//
	$('#winHeight').change(function() {
		var wh = $('#winHeight').val();
		if (!wh.match(/^(0|[1-9][0-9]*)$/)) {
			ConcreteAlert.error({
				message: $('#winHeightError').val()
			});
			$('.ui-dialog-buttonpane').css({pointerEvents: 'none'});
		}
		else {
			$('#winHeightError').hide();
			$('.ui-dialog-buttonpane').css({pointerEvents: 'auto'});
		}
	});
} (window.jQuery));
