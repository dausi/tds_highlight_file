<?php
namespace Concrete\Package\TdsHighlightFile\Block\TdsHighlightFile;

use Concrete\Core\Block\BlockController;
use \Core;

/**
 * Highlight File block type implementation.
 *
 * block controller
 *
 * Copyright 2017 - TDSystem Beratung & Training - Thomas Dausner (aka dausi)
 *
 */
class Controller extends BlockController
{
    protected $btInterfaceWidth = 600;
    protected $btInterfaceHeight = 580;
    protected $btCacheBlockOutput = true;
    protected $btTable = 'btTdsHighlightFile';
    protected $btDefaultSet = 'basic';

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
		$this->set('winHeight', 26);
		$this->set('aceType', 'text');
		$this->edit();
    }

    public function edit()
    {
    	$pkgHandle = 'tds_highlight_file';
		$blockUrl = BASE_URL.'/packages/'.$pkgHandle.'/blocks/'.$pkgHandle;
		$html = Core::make('helper/html');
		$this->addFooterItem($html->javascript($blockUrl.'/js/form.js'));
		$this->addHeaderItem($html->css($blockUrl.'/css/form.css'));
    }

    public function view()
    {
		$pkgHandle = $this->getBlockObject()->getPackageHandle();
    	$this->requireAsset('ace');
    	$this->requireAsset('ace/'.$pkgHandle);
    	$this->requireAsset($pkgHandle);
    }

    public function save($args)
    {
    	parent::save($args);
    }
}
