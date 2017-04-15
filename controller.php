<?php
namespace Concrete\Package\TdsHighlightFile;

use Package;
use BlockType;
use AssetList;
/**
 * Highlight File block type implementation.
 *
 * package controller
 *
 * Copyright 2017 - TDSystem Beratung & Training - Thomas Dausner (aka dausi)
 *
 */
class Controller extends Package
{
    protected $pkgHandle = 'tds_highlight_file';
    protected $appVersionRequired = '5.7.5.6';
    protected $pkgVersion = '0.9.0';

    public function getPackageName()
    {
        return t('Highlight File');
    }

    public function getPackageDescription()
    {
        return t('Add a highlighted file block on your pages.');
    }

    public function install()
    {
        $pkg = parent::install();

        $blk = BlockType::getByHandle('tds_highlight_file');
        if (!is_object($blk)) {
            BlockType::installBlockTypeFromPackage('tds_highlight_file', $pkg);
        }
    }

    public function on_start()
    {
		$nix = t('Highlight File');
		//
		// view assets
		//
    	$al = AssetList::getInstance();
    	$assets = [
			'e' => 'js/ace/theme-eclipse.js',
    		'p' => 'js/ace/mode-php.js',
    		'j' => 'js/ace/mode-javascript.js',
    		'l' => 'js/ace/mode-less.js',
    		't' => 'js/ace/mode-text.js',
    	];
    	$assetGroups = [];
		foreach ($assets as $c => $asset)
		{
			$al->register('javascript', 'ace/'.$this->pkgHandle.'/'.$c, $asset);
			$assetGroups[] = ['javascript', 'ace/'.$this->pkgHandle.'/'.$c];
		}
		$al->registerGroup('ace/'.$this->pkgHandle, $assetGroups);
		// view.css
		$al->register('css', $this->pkgHandle.'/css', 'blocks/'.$this->pkgHandle.'/css/view.css', [], $this->pkgHandle);
		$al->registerGroup($this->pkgHandle, [['css', $this->pkgHandle.'/css']]);
    }

}
