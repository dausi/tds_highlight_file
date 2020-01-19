<?php
/**
 * TDS Highlight Files
 *
 * Copyright 2017 - TDSystem Beratung & Training - Thomas Dausner
 *
 * the Highlight Files controller URL is
 *
 *        /ccm/tds_highlight_file/lines => public function lines()
 *
 * mandatory parameter is
 *
 *        fID=fileId
 */

namespace Concrete\Package\TdsHighlightFile\Controller;

defined('C5_EXECUTE') or die("Access Denied.");

use Concrete\Core\Controller\AbstractController;
use Core, File;

class Lines extends AbstractController
{
    public function lines()
    {
        parse_str($_SERVER['QUERY_STRING'], $query);
        if (isset($query['fID']) && isset($query['token']))
        {
            $token = Core::make('token');
            if ($token->validate('highlight_file_lines', $query['token']))
            {
                $file = File::getByID($query['fID']);
                $lines = preg_split('/\n/', h($file->getFileContents()));
                echo count($lines);
            }
        }
    }

    public function getViewObject()
    {
    }
}
