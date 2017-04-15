<?php  defined('C5_EXECUTE') or die('Access Denied.');

/*
 * Highlight File block type implementation by Thomas Dausner (aka dausi)
 */

$file = $_SERVER['DOCUMENT_ROOT'] . '/' . trim($highlightFile,'/\\');

if (file_exists($file))
{
	$content = h(file_get_contents($file));
	$divID = "ccm-block-highlight-file-" . $bID;
?>
	<style type="text/css">
	<!--
	#<?=$divID?> {
        height: <?=($winHeight + 1) * 14 * 1.2 + 6?>px;
	}
	-->
	</style>
	<div class="ccm-block-highlight-file-wrapper">
		<div id="<?=$divID?>-header" class="ccm-block-highlight-file-view-header">
			<?=t('File:')?>&nbsp;<?=$highlightFile?>
			<div class="toggle">
				<i class="fa fa-caret-down"></i>
				<i class="fa fa-caret-right"></i>
			</div>
		</div>
		<div id="<?=$divID?>" class="ccm-block-highlight-file-view"><?=$content?></div>
	</div>

	<script type="text/javascript">
	(function($) {
		$(document).ready(function() {
			if ($('#<?=$divID?>-header .toggle .fa-caret-down:visible').length > 0)
	        	$('#<?=$divID?>').show();
	        var editor = ace.edit('<?=$divID?>');
	        editor.setTheme('ace/theme/eclipse');
	        editor.setOptions({fontSize: '14px'});
	        editor.getSession().setMode('ace/mode/<?=$aceType?>');

	        $('#<?=$divID?>-header').click(function() {
		        $('i', this).toggle();
		        $('#<?=$divID?>').toggle(300);
	        });
	    });
	} (window.jQuery));
	</script>
<?php
}
else
{
?>
	<div class="ccm-block-highlight-file">
		<pre>Error: file &lt;DOCROOT/<?=trim($highlightFile,'/\\');?>&gt; does not exist.</pre>
	</div>

<?php
}
?>
