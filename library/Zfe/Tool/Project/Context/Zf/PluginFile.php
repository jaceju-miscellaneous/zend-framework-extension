<?php
/**
 * Zend Framework
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://framework.zend.com/license/new-bsd
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@zend.com so we can send you a copy immediately.
 *
 * @category   Zend
 * @package    Zend_Tool
 * @subpackage Framework
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: PluginFile.php 23775 2011-03-01 17:25:24Z ralph $
 */

/**
 * This class is the front most class for utilizing Zend_Tool_Project
 *
 * A profile is a hierarchical set of resources that keep track of
 * items within a specific project.
 *
 * @category   Zend
 * @package    Zend_Tool
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
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
