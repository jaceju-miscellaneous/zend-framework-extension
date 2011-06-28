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
class Zfe_Tool_Project_Context_Zf_ActionHelperFile extends Zend_Tool_Project_Context_Zf_AbstractClassFile
{

    protected $_actionHelperName = null;

    /**
     * getName()
     *
     * @return string
     */
    public function getName()
    {
        return 'ActionHelperFile';
    }

    /**
     * init()
     *
     */
    public function init()
    {
        $this->_actionHelperName = $this->_resource->getAttribute('actionHelperName');
        $this->_filesystemName = ucfirst($this->_actionHelperName) . '.php';
        parent::init();
    }

    public function getPersistentAttributes()
    {
        return array('actionHelperName' => $this->_actionHelperName);
    }

    public function getContents()
    {
        $className = $this->getFullClassName($this->_actionHelperName, 'ActionHelper');

        $codeGenFile = new Zend_CodeGenerator_Php_File(array(
            'fileName' => $this->getPath(),
            'classes' => array(
                new Zend_CodeGenerator_Php_Class(array(
                    'name' => $className,
                    'extendedClass' => 'Zend_Controller_Action_Helper_Abstract',
                    ))
                )
            ));
        return $codeGenFile->generate();
    }

}
