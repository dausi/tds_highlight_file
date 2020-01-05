<?php defined('C5_EXECUTE') or die('Access Denied.');
/**
 * Highlight File block type implementation.
 *
 * form controller for add/edit
 *
 * Copyright 2017 - TDSystem Beratung & Training - Thomas Dausner
 *
 */
$al = Loader::helper('concrete/asset_library');
$bf = null;
if ($controller->getFileID() > 0) {
	$bf = $controller->getFileObject();
}

$aceTypes = [
	"abap" => "abap",
	"actionscript" => "actionscript",
	"ada" => "ada",
	"apache_conf" => "apache_conf",
	"asciidoc" => "asciidoc",
	"assembly_x86" => "assembly_x86",
	"autohotkey" => "autohotkey",
	"batchfile" => "batchfile",
	"c_cpp" => "cpp",
	"c9search" => "c9search",
	"cirru" => "cirru",
	"clojure" => "clojure",
	"cobol" => "cobol",
	"coffee" => "coffee",
	"coldfusion" => "coldfusion",
	"csharp" => "c#",
	"css" => "css",
	"curly" => "curly",
	"d" => "d",
	"dart" => "dart",
	"diff" => "diff",
	"django" => "django",
	"dot" => "dot",
	"ejs" => "ejs",
	"erlang" => "erlang",
	"forth" => "forth",
	"ftl" => "ftl",
	"gherkin" => "gherkin",
	"glsl" => "glsl",
	"golang" => "golang",
	"groovy" => "groovy",
	"haml" => "haml",
	"handlebars" => "handlebars",
	"haskell" => "haskell",
	"haxe" => "haxe",
	"html" => "html",
	"html_completions" => "html_completions",
	"html_ruby" => "html_ruby",
	"ini" => "ini",
	"jack" => "jack",
	"jade" => "jade",
	"java" => "java",
	"javascript" => "js",
	"json" => "json",
	"jsoniq" => "jsoniq",
	"jsp" => "jsp",
	"jsx" => "jsx",
	"julia" => "julia",
	"latex" => "latex",
	"less" => "less",
	"liquid" => "liquid",
	"lisp" => "lisp",
	"livescript" => "livescript",
	"logiql" => "logiql",
	"lsl" => "lsl",
	"lua" => "lua",
	"luapage" => "luapage",
	"lucene" => "lucene",
	"makefile" => "makefile",
	"markdown" => "markdown",
	"matlab" => "matlab",
	"mel" => "mel",
	"mushcode" => "mushcode",
	"mushcode_high_rules" => "mushcode_high_rules",
	"mysql" => "mysql",
	"nix" => "nix",
	"objectivec" => "objectivec",
	"ocaml" => "ocaml",
	"pascal" => "pascal",
	"perl" => "perl",
	"pgsql" => "pgsql",
	"php" => "php",
	"plain_text" => "plain_text",
	"powershell" => "powershell",
	"prolog" => "prolog",
	"properties" => "properties",
	"protobuf" => "protobuf",
	"python" => "python",
	"r" => "r",
	"rdoc" => "rdoc",
	"rhtml" => "rhtml",
	"ruby" => "ruby",
	"rust" => "rust",
	"sass" => "sass",
	"scad" => "scad",
	"scala" => "scala",
	"scheme" => "scheme",
	"scss" => "scss",
	"sh" => "sh",
	"sjs" => "sjs",
	"smarty" => "smarty",
	"snippets" => "snippets",
	"soy_template" => "soy_template",
	"space" => "space",
	"sql" => "sql",
	"stylus" => "stylus",
	"svg" => "svg",
	"tcl" => "tcl",
	"tex" => "tex",
	"text" => "txt",
	"textile" => "textile",
	"toml" => "toml",
	"twig" => "twig",
	"typescript" => "typescript",
	"vbscript" => "vbscript",
	"velocity" => "velocity",
	"verilog" => "verilog",
	"vhdl" => "vhdl",
	"xml" => "xml",
	"xquery" => "xquery",
	"yaml" => "yaml",
];

echo '
<div class="ccm-block-highlight-file">
	<div class="form-group">',
		$form->label('highlightFileID', t('Select a file to highlight.')), 
		$al->file('ccm-b-file', 'highlightFileID', t('Choose File'), $bf), '
		<div class="form-50 pull-left">',
			$form->label('winHeight', t('Highlight File window height [lines]')), '
			<div class="input-group" style="width: 50%;">',
				$form->text('winHeight', $winHeight, ['style' => 'text-align: center;']), '
				<span class="input-group-addon">', t('lines'), '</span>
			</div>
			<input type="hidden" id="winHeightError" value="', t('Highlight File window height is not a valid number'), '" />
		</div>
		<div class="form-50 pull-left">',
			$form->label('aceType', t('Highlight File type')),
			$form->select('aceType', $aceTypes, $aceType),'
		</div>
		<div class="clearfix"></div>',
		$form->hidden('highlightFileName', $highlightFileName),
		$form->hidden('noLines', $noLines), '
	</div>
</div>';
$token = Core::make('token')->generate('highlight_file_lines');

?>
<script type="text/javascript">
	$(document).ready(function() {
		$('a.pull-right.btn.btn-primary').css( { 'pointerEvents': 'none' } );
	});
	$(document).ajaxComplete(function(e, xhr){
		try {
			var data = JSON.parse(xhr.responseText); // throws exception if xhr.responseText is invalid json
			var fileName = data.files[0].fileName;
			$('a.pull-right.btn.btn-primary').css( { 'pointerEvents': 'initial' } );
			$.ajax( {
				type: 'GET',
				url: CCM_APPLICATION_URL + '/index.php/ccm/tds_highlight_file/lines?fID=' + data.files[0].fID 
																				+ '&token=<?php echo $token; ?>',
				dataType: 'text',
				success: function(noLines) {
					$('#noLines').val(noLines);
					$('div.ccm-file-selector-file-selected-title')
						.html('<div>' + fileName + '</div><p>' + noLines + ' <?php echo t('lines')?></p>');
				}
			});
			var fileType = fileName.replace(/[^\.]+\./, '');
			$('#aceType option').each(function() {
				if ($(this).html() === fileType) {
					$('#aceType').val($(this).val());
					$('#highlightFileName').val(fileName);
					return false;
				}
			});
		}
		catch (e) {
		}
	});
</script>
