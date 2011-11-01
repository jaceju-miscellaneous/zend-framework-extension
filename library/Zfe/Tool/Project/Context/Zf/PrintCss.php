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
class Zfe_Tool_Project_Context_Zf_PrintCss extends Zend_Tool_Project_Context_Filesystem_File
{

    /**
     * @var string
     */
    protected $_filesystemName = 'print.css';

    /**
     * getName()
     *
     * @return string
     */
    public function getName()
    {
        return 'PrintCss';
    }

    /**
     * getContents()
     *
     * @return string
     */
    public function getContents()
    {
        $output = <<<EOS
/* Welcome to Compass. Use this file to define print styles.
 * Import this file using the following HTML or equivalent:
 * <link href="/stylesheets/print.css" media="print" rel="stylesheet" type="text/css" /> */

EOS;
        return $output;
    }

}
