/**
 * Highlight File block type implementation.
 *
 * js for form controller for add/edit
 *
 * Copyright 2017 - TDSystem Beratung & Training - Thomas Dausner (aka dausi)
 *
 */
(function($) {
	$(function() {
		var packageUrl = CCM_APPLICATION_URL + '/packages/tds_highlight_file/blocks/tds_highlight_file/jquery_filetree/';

		setupFileTree = function() {
			$('#filetree').fileTree({
				root:			CCM_REL == '' ?  '/' : CCM_REL,
				script: 		packageUrl + 'jqueryFileTree.php',
				folderEvent:	'click',
				expandSpeed:	750,
				collapseSpeed:	750,
				multiFolder:	false
			}, function(file) {
				$('#highlightFile').val(file.replace(/\/+/,'/'));
				var ext = file.split('.').pop().toLowerCase();
				var aceType = 'text';	// default value
				$('#aceType option').each(function() {
					if (ext == $(this).text()) {
						aceType = $(this).val();
						return false;
					}
				});
				$('#aceType').val(aceType);
			});
			if ($('.ui-dialog').css('position') == 'fixed') {
				// concrete5 < V8
				$('#filetree').addClass('c5-7');
			}
		};
		//
		// css file is appended to <head> as <link> tag
		//
		if ($('head link.filetree-css').length <= 0) {
			$('<link/>', {
				   rel:		'stylesheet',
				   type:	'text/css',
				   class:	'filetree-css',
				   href: 	packageUrl + 'jqueryFileTree.css'
				}).appendTo('head');
			//
			// The javascript files has to be inserted synchronous, as the functionality
			// is demanded in setupFileTree().
			//
			$.getScript(packageUrl + 'jqueryFileTree.js').done(setupFileTree);
		}
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
	});
} (window.jQuery));
