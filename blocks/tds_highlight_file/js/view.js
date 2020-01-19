/**
 * Highlight File block type implementation.
 *
 * js for form controller for view
 *
 * Copyright 2017 - TDSystem Beratung & Training - Thomas Dausner
 *
 */
(function($) {
	//
	// validity check winHeight
	//
	$(document).on('highlight-file-block-loaded', function() {
		var idx = 0;
		//
		// set idx to highest block number
		//
		$('.ccm-block-highlight-file-wrapper').each(function() {
			var $div = $('.ccm-block-highlight-file-view', this);
			var id = $div.attr('id');
			if (typeof id !== 'undefined') {
				// initialised block found, get index from id
				var divIdx = parseInt(id.replace(/[^0-9]+/, ''));
				if (idx < divIdx)
					idx = divIdx;
			}
		});
		//
		// initialise all new blocks (for example after edit)
		//
		$('.ccm-block-highlight-file-wrapper').each(function() {
			var $div = $('.ccm-block-highlight-file-view', this);
			if (typeof $div.attr('id') === 'undefined') {
				// non initialised block found
				var id = 'ccm-block-highlight-file-' + ++idx;
				$div.attr('id', id);
				// open highlighted file on caret down visible (not on xs viewport)
				if ($('.toggle .fa-caret-down:visible', this).length > 0)
					$div.show();
				// initialise eca editor to highlight file content
				var editor = ace.edit(id);
				editor.setTheme('ace/theme/eclipse');
				editor.setOptions({fontSize: '14px'});
				editor.getSession().setMode('ace/mode/' + $div.data('acetype'));
			}
		});
	
		$('div.ccm-block-highlight-file-view-header').click(function(e) {
			e.preventDefault();
			$('i', this).toggle();
			$(this).siblings('div.ccm-block-highlight-file-view').toggle(300);
		});
	});
	$(document).ready(function() {
		$(document).trigger('highlight-file-block-loaded');
	});
} (window.jQuery));
