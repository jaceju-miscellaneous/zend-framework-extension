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
class Zfe_Tool_Project_Context_Zf_IeCss extends Zend_Tool_Project_Context_Filesystem_File
{

    /**
     * @var string
     */
    protected $_filesystemName = 'ie.css';

    /**
     * getName()
     *
     * @return string
     */
    public function getName()
    {
        return 'IeCss';
    }

    /**
     * getContents()
     *
     * @return string
     */
    public function getContents()
    {
        $output = <<<EOS
/* Welcome to Compass. Use this file to write IE specific override styles.
 * Import this file using the following HTML or equivalent:
 * <!--[if IE]>
 *   <link href="/stylesheets/ie.css" media="screen, projection" rel="stylesheet" type="text/css" />
 * <![endif]--> */
EOS;
        return $output;
    }

}
