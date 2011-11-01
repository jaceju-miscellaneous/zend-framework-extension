<?php
/**
 * Zend Framework Extension
 *
 * @category   Zfe
 * @package    Zfe_Tool
 * @subpackage Project
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

/**
 * @see Zend_Tool_Project_Context_Filesystem_File
 */
require_once 'Zend/Tool/Project/Context/Filesystem/File.php';

/**
 * @category   Zfe
 * @package    Zfe_Tool
 */
class Zfe_Tool_Project_Context_WebDev_ScreenSass extends Zend_Tool_Project_Context_Filesystem_File
{

    /**
     * @var string
     */
    protected $_filesystemName = 'screen.sass';

    /**
     * getName()
     *
     * @return string
     */
    public function getName()
    {
        return 'ScreenSass';
    }

    /**
     * getContents()
     *
     * @return string
     */
    public function getContents()
    {
        $output = <<<EOS
/*
  Welcome to Compass.
  In this file you should write your main styles. (or centralize your imports)
  Import this file using the following HTML or equivalent:
  <link href="/stylesheets/screen.css" media="screen, projection" rel="stylesheet" type="text/css" />

@import compass/reset
EOS;
        return $output;
    }

}
