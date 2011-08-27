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
class Zfe_Tool_Project_Context_Zf_PortableIndexFile extends Zend_Tool_Project_Context_Filesystem_File
{

    /**
     * @var string
     */
    protected $_filesystemName = 'index.php';

    /**
     * getName()
     *
     * @return string
     */
    public function getName()
    {
        return 'PortableIndexFile';
    }

    /**
     * getContents()
     *
     * @return string
     */
    public function getContents()
    {
        $codeGenerator = new Zend_CodeGenerator_Php_File(array(
            'body' => <<<EOS
// Define path to application directory
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/application'));

// Define application environment
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));

// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
    realpath(APPLICATION_PATH . '/../library'),
    get_include_path(),
)));

// Error Handler
set_error_handler('errorExceptionHandler');

function errorExceptionHandler(\$level, \$message, \$file, \$line)
{
    if (in_array(\$level, array(E_USER_ERROR, E_ERROR))) {
        throw new ErrorException(\$message, 0, \$level, \$file, \$line);
    }
    return false; // 回復為預設的錯誤處理機制
}

// Zend_Application
require_once 'Zend/Application.php';

// Create application, bootstrap, and run
\$application = new Zend_Application(
    APPLICATION_ENV,
    APPLICATION_PATH . '/configs/application.ini'
);
\$application->bootstrap()
            ->run();
EOS
            ));
        return $codeGenerator->generate();
    }

}
