<?php
/**
 * TDS Highlight Files
 *
 * Copyright 2017 - TDSystem Beratung & Training - Thomas Dausner
 *
 * the Highlight Files controller URL is
 *
 * 		/ccm/tds_highlight_file/lines => public function lines()
 *
 * mandatory parameter is
 *
 *		fID=fileId
 */
namespace Concrete\Package\TdsHighlightFile\Controller;

defined('C5_EXECUTE') or die("Access Denied.");

use Concrete\Core\Controller\AbstractController;
use Core, File;

class Lines extends AbstractController
{
	public function lines()
	{
		$req = $this->getRequest();
		if ($req != null && $req->query != null)
		{
			$token= Core::make('token');
		    if ($token->validate('highlight_file_lines', $req->query->get('token'))) {
				$file = File::getByID($req->query->get('fID'));
				$lines = preg_split('/\n/', h($file->getFileContents()));
				echo count($lines);
			}
		}
	}

	public function getViewObject()
	{
	}
}
