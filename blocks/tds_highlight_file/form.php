<?php  defined('C5_EXECUTE') or die('Access Denied.');
/**
 * Highlight File block type implementation.
 *
 * form controller for add/edit
 *
 * Copyright 2017 - TDSystem Beratung & Training - Thomas Dausner (aka dausi)
 *
 */
echo '
<div class="ccm-block-highlight-file">
	<div class="form-group">',
		$form->label('highlightFile', t('Select a file to highlight.')), '
		<div id="filetree" class="form-control"></div>' ,
		$form->text('highlightFile', $highlightFile, [
			'style' => 'pointer-events: none; background-color: #eee;',
			 'readonly' => 'readonly'
		]), '
		<div class="form-50 pull-left">',
			$form->label('winHeight', t('Highlight File window height')), '
			<div class="input-group" style="width: 50%;">',
				$form->text('winHeight', $winHeight, ['style' => 'text-align: center;']), '
				<span class="input-group-addon">', t('lines'), '</span>
			</div>
			<input type="hidden" id="winHeightError" value="', t('Highlight File window height is not a valid number'), '" />
		</div>
		<div class="form-50 pull-left">',
			$form->label('aceType', t('Highlight File type')),
			$form->select('aceType', [
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
			], $aceType),'
		</div>
	</div>
</div>';
?>
<script type="text/javascript">
	try {
		setupFileTree();
	} catch(e) {
	}
</script>
