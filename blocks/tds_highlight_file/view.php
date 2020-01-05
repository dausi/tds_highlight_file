<?php  defined('C5_EXECUTE') or die('Access Denied.');

/*
 * Highlight File block type implementation by Thomas Dausner
 */
if (is_object($file)) {
	$content = h($file->getFileContents());
	$height = ($winHeight + 1) * 14 * 1.2 + 6;
	echo '
	<div class="ccm-block-highlight-file-wrapper">
		<div class="ccm-block-highlight-file-view-header">
			'. t('File:') .'&nbsp;'. $file->getFilename() . '&nbsp;(' . $noLines . '&nbsp;' . t('lines') . ')
			<div class="toggle">
				<i class="fa fa-caret-down"></i>
				<i class="fa fa-caret-right"></i>
			</div>
		</div>
		<div class="ccm-block-highlight-file-view" data-acetype="' .$aceType. '" style="height: '. $height .'px">'. $content .'</div>
	</div>
	<script type="text/javascript">
		$(document).trigger("highlight-file-block-loaded");
	</script>
	';
}
else
{
	echo '
	<div class="ccm-block-highlight-file">
		<pre>Error: file &lt;'. ($file == null ? '??' : $file) .'&gt; does not exist.</pre>
	</div>';
}
