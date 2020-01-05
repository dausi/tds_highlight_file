<?php
namespace Concrete\Package\TdsHighlightFile\Block\TdsHighlightFile;

use File;
use AssetList;
use Concrete\Core\Block\BlockController;

/**
 * Highlight File block type implementation.
 *
 * block controller
 *
 * Copyright 2017 - TDSystem Beratung & Training - Thomas Dausner
 *
 */
class Controller extends BlockController
{
    protected $btCacheBlockRecord = true;
    protected $btInterfaceWidth = 600;
    protected $btInterfaceHeight = 235;
    protected $btTable = 'btTdsHighlightFile';
    protected $btDefaultSet = 'develop';

    public function getBlockTypeDescription()
    {
        return t('Add a highlighted file block on your pages.');
    }

    public function getBlockTypeName()
    {
        return t('Highlight File');
    }

    public function add()
    {
		$this->set('noLines', 0);
		$this->set('highlightFileName', '');
		$this->set('winHeight', 26);
		$this->set('aceType', 'text');
    }


    public function view()
    {
		$file = File::getByID($this->highlightFileID);
        $this->set('file', $file);
	}

    public function getFileID()
    {
        return $this->highlightFileID;
    }

    public function getFileObject()
    {
        if ($this->highlightFileID) {
            return File::getByID($this->highlightFileID);
        } else {
            return null;
        }
    }
	
    public function on_start()
    {
    	$al = AssetList::getInstance();
		$pkgHandle = 'tds_highlight_file'; // no blockObject on add()! else: $this->getBlockObject()->getPackageHandle();

		$assets = [
			'css' => 'blocks/'.$pkgHandle.'/css/form.css',
			'javascript' => 'blocks/'.$pkgHandle.'/js/form.js'
		];
    	$assetGroups = [];
		foreach ($assets as $type => $asset)
		{
			$al->register($type, $pkgHandle.'/'.$type, $asset, [], $pkgHandle);
			$assetGroups[] = [$type, $pkgHandle.'/'.$type];
		}
		$al->registerGroup($pkgHandle.'/block', $assetGroups);
		$this->requireAsset($pkgHandle.'/block');
		
    	$this->requireAsset('ace');
    	$this->requireAsset($pkgHandle);
	}

}
