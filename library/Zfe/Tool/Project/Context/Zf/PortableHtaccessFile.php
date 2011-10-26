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
class Zfe_Tool_Project_Context_Zf_PortableHtaccessFile extends Zend_Tool_Project_Context_Filesystem_File
{

    /**
     * @var string
     */
    protected $_filesystemName = '.htaccess';

    /**
     * getName()
     *
     * @return string
     */
    public function getName()
    {
        return 'PortableHtaccessFile';
    }

    /**
     * getContents()
     *
     * @return string
     */
    public function getContents()
    {
        $output = <<<EOS
Options -Indexes
RewriteEngine On
RewriteRule ^(css|js|img)/(.*)$ public/$1/$2 [L]
RewriteCond %{REQUEST_FILENAME} -s [OR]
RewriteCond %{REQUEST_FILENAME} -l
RewriteRule ^.*$ - [NC,L]
RewriteRule ^.*$ index.php [NC,L]
EOS;
        return $output;
    }

}
