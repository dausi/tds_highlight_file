<?php
namespace Concrete\Package\TdsHighlightFile;

use Package;
use BlockType;
use Concrete\Core\Routing\Router;
use Concrete\Core\Support\Facade\Route;
use AssetList;
/**
 * Highlight File block type implementation.
 *
 * package controller
 *
 * Copyright 2017 - TDSystem Beratung & Training - Thomas Dausner
 *
 */
class Controller extends Package
{
    protected $pkgHandle = 'tds_highlight_file';
    protected $appVersionRequired = '5.7.5.6';
    protected $pkgVersion = '0.9.4';

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
		$bt = BlockType::getByHandle('tds_highlight_file');
		if (!is_object($bt)) {
			$bt = BlockType::installBlockType('tds_highlight_file', $pkg);
		}
	}

    public function on_start()
    {
		Route::register('/ccm/tds_highlight_file/lines/', 'Concrete\Package\TdsHighlightFile\Controller\Lines::lines');

		$al = AssetList::getInstance();
		$assets = [
			'css' => 'blocks/'.$this->pkgHandle.'/css/view.css',
			'javascript' => 'blocks/'.$this->pkgHandle.'/js/view.js'
		];
    	$assetGroups = [];
		foreach ($assets as $type => $asset)
		{
			$al->register($type, $this->pkgHandle.'/'.$type, $asset, [], $this->pkgHandle);
			$assetGroups[] = [$type, $this->pkgHandle.'/'.$type];
		}
		$al->registerGroup($this->pkgHandle, $assetGroups);
    }

}
