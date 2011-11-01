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
 * @see Zend_Tool_Project_Provider_Abstract
 */
require_once 'Zend/Tool/Project/Provider/Abstract.php';

/**
 * @category   Zfe
 * @package    Zfe_Tool
 */
class Zfe_Tool_Project_Provider_Extension extends Zend_Tool_Project_Provider_Abstract implements Zend_Tool_Framework_Provider_Pretendable
{
    /**
     *
     * @param string $name
     */
    public function install($name)
    {
        $name = strtolower($name);

        $extensionPath = realpath(dirname(__FILE__) . '/Extensions');
        $zipFile = $extensionPath . '/' . $name . '.zip';
        $tempPath = sys_get_temp_dir();

        echo $zipFile, "\n";
        echo $tempPath, "\n";

        if (!is_file($zipFile)) {
            echo "$name is not a valid extension.\n";
            return;
        }

        $zip = new ZipArchive();
        if ($zip->open($zipFile)) {
            $zip->extractTo($tempPath);
            $zip->close();
        }
    }

    public function uninstall($name)
    {
        echo $name, "\n";
    }

}
