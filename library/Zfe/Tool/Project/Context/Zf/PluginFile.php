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
 * @see Zend_Tool_Project_Context_Zf_AbstractClassFile
 */
require_once 'Zend/Tool/Project/Context/Zf/AbstractClassFile.php';

/**
 * @category   Zfe
 * @package    Zfe_Tool
 */
class Zfe_Tool_Project_Context_Zf_PluginFile extends Zend_Tool_Project_Context_Zf_AbstractClassFile
{

    protected $_pluginName = null;

    /**
     * getName()
     *
     * @return string
     */
    public function getName()
    {
        return 'PluginFile';
    }

    /**
     * init()
     *
     */
    public function init()
    {
        $this->_pluginName = $this->_resource->getAttribute('pluginName');
        $this->_filesystemName = ucfirst($this->_pluginName) . '.php';
        parent::init();
    }

    public function getPersistentAttributes()
    {
        return array('pluginName' => $this->_pluginName);
    }

    public function getContents()
    {
        $className = $this->getFullClassName($this->_pluginName, 'Plugin');

        $codeGenFile = new Zend_CodeGenerator_Php_File(array(
            'fileName' => $this->getPath(),
            'classes' => array(
                new Zend_CodeGenerator_Php_Class(array(
                    'name' => $className,
                    'extendedClass' => 'Zend_Controller_Plugin_Abstract',
                    'methods' => array(
                        new Zend_CodeGenerator_Php_Method(array(
                            'name' => 'routeStartup',
                            'visibility' => Zend_CodeGenerator_Php_Property::VISIBILITY_PUBLIC,
                            'parameters' => array(
                                new Zend_CodeGenerator_Php_Parameter(array(
                                    'type' => 'Zend_Controller_Request_Abstract',
                                    'name' => 'request',
                                )),
                            ),
                        )),
                        new Zend_CodeGenerator_Php_Method(array(
                            'name' => 'routeShutdown',
                            'visibility' => Zend_CodeGenerator_Php_Property::VISIBILITY_PUBLIC,
                            'parameters' => array(
                                new Zend_CodeGenerator_Php_Parameter(array(
                                    'type' => 'Zend_Controller_Request_Abstract',
                                    'name' => 'request',
                                )),
                            ),
                        )),
                        new Zend_CodeGenerator_Php_Method(array(
                            'name' => 'dispatchLoopStartup',
                            'visibility' => Zend_CodeGenerator_Php_Property::VISIBILITY_PUBLIC,
                            'parameters' => array(
                                new Zend_CodeGenerator_Php_Parameter(array(
                                    'type' => 'Zend_Controller_Request_Abstract',
                                    'name' => 'request',
                                )),
                            ),
                        )),
                        new Zend_CodeGenerator_Php_Method(array(
                            'name' => 'preDispatch',
                            'visibility' => Zend_CodeGenerator_Php_Property::VISIBILITY_PUBLIC,
                            'parameters' => array(
                                new Zend_CodeGenerator_Php_Parameter(array(
                                    'type' => 'Zend_Controller_Request_Abstract',
                                    'name' => 'request',
                                )),
                            ),
                        )),
                        new Zend_CodeGenerator_Php_Method(array(
                            'name' => 'postDispatch',
                            'visibility' => Zend_CodeGenerator_Php_Property::VISIBILITY_PUBLIC,
                            'parameters' => array(
                                new Zend_CodeGenerator_Php_Parameter(array(
                                    'type' => 'Zend_Controller_Request_Abstract',
                                    'name' => 'request',
                                )),
                            ),
                        )),
                        new Zend_CodeGenerator_Php_Method(array(
                            'name' => 'dispatchLoopShutdown',
                            'visibility' => Zend_CodeGenerator_Php_Property::VISIBILITY_PUBLIC,
                        )),
                    ),
                )),
            ),
        ));
        return $codeGenFile->generate();
    }

}
