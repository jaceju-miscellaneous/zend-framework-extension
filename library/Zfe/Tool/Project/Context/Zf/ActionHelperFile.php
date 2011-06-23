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
 * @version    $Id: ActionHelperFile.php 23775 2011-03-01 17:25:24Z ralph $
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
//                    'properties' => array(
//                        new Zend_CodeGenerator_Php_Property(array(
//                            'name' => '_name',
//                            'visibility' => Zend_CodeGenerator_Php_Property::VISIBILITY_PROTECTED,
//                            'defaultValue' => $this->_actualTableName
//                            ))
//                        ),

                    ))
                )
            ));
        return $codeGenFile->generate();
    }

}
