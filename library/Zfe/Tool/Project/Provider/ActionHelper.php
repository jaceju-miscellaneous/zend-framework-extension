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
 * @version    $Id: Layout.php 23775 2011-03-01 17:25:24Z ralph $
 */

/**
 * @see Zend_Tool_Project_Provider_Abstract
 */
require_once 'Zend/Tool/Project/Provider/Abstract.php';

/**
 * @category   Zend
 * @package    Zend_Tool
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zfe_Tool_Project_Provider_ActionHelper
    extends Zend_Tool_Project_Provider_Abstract
    implements Zend_Tool_Framework_Provider_Pretendable
{
    protected $_specialties = array('Prefix');

    public static function createResources(Zend_Tool_Project_Profile $profile, $actionHelperName)
    {
        $actionHelpersDirectory = $profile->search('actionHelpersDirectory');
        $actionHelperFile = $actionHelpersDirectory->createResource('ActionHelperFile', array('actionHelperName' => $actionHelperName));

        return $actionHelperFile;
    }

    public static function hasResource(Zend_Tool_Project_Profile $profile, $actionHelperName)
    {
        $actionHelpersDirectory = $profile->search(array('actionHelpersDirectory'));

        if (!($actionHelpersDirectory instanceof Zend_Tool_Project_Profile_Resource)) {
            return false;
        }

        $actionHelperFile = $actionHelpersDirectory->search(array('ActionHelperFile' => array('actionHelperName' => $actionHelperName)));

        return ($actionHelperFile instanceof Zend_Tool_Project_Profile_Resource) ? true : false;
    }

    public function create($name)
    {
        $this->_loadProfile(self::NO_PROFILE_THROW_EXCEPTION);

        // Check that there is not a dash or underscore, return if doesnt match regex
        if (preg_match('#[_-]#', $name)) {
            throw new Zend_Tool_Project_Provider_Exception('ActionHelper names should be camel cased.');
        }

        $originalName = $name;
        $name = ucfirst($name);

        if (self::hasResource($this->_loadedProfile, $name)) {
            throw new Zend_Tool_Project_Provider_Exception('This project already has a ActionHelper named ' . $name);
        }

        // get request/response object
        $request = $this->_registry->getRequest();
        $response = $this->_registry->getResponse();

        // alert the user about inline converted names
        $tense = (($request->isPretend()) ? 'would be' : 'is');

        if ($name !== $originalName) {
            $response->appendContent(
                'Note: The canonical model name that ' . $tense
                    . ' used with other providers is "' . $name . '";'
                    . ' not "' . $originalName . '" as supplied',
                array('color' => array('yellow'))
                );
        }

        try {
            $actionHelperResource = self::createResources($this->_loadedProfile, $name);
        } catch (Exception $e) {
            $response = $this->_registry->getResponse();
            $response->setException($e);
            return;
        }

        // do the creation
        if ($request->isPretend()) {
            $response->appendContent('Would create a ActionHelper at '  . $actionHelperResource->getContext()->getPath());
        } else {
            $response->appendContent('Creating a ActionHelper at ' . $actionHelperResource->getContext()->getPath());
            $actionHelperResource->create();
            $this->_storeProfile();
        }

        $this->_addActionHelperConfig();
    }

    protected function _addActionHelperConfig()
    {
        $appConfigFile = $this->_loadedProfile->search('ApplicationConfigFile');
        /* @var $appConfigFile Zend_Tool_Project_Context_Zf_ApplicationConfigFile */
        $zc = $appConfigFile->getAsZendConfig()->toArray();
        $appNamespace = 'Application';
        foreach ($zc as $key => $val) {
            if ('appnamespace' == strtolower($key)) {
                $appNamespace = rtrim($val, '_');
                break;
            }
        }

        $prefix = $appNamespace . '_ActionHelper_';
        $classPath = 'APPLICATION_PATH "/helpers"';
        $this->_addActionHelperPrefix($prefix, $classPath, false);
    }

    protected function _addActionHelperPrefix($prefix, $classPath = null, $quoteValue = true)
    {
        $response = $this->_registry->getResponse();
        $appConfigFile = $this->_loadedProfile->search('ApplicationConfigFile');

        $response->appendContent('Added a prefix/path for action helper to the application.ini file');
        $appConfigFile->addStringItem('resources.frontController.actionHelperPaths.' . $prefix, $classPath, 'production', $quoteValue);
        $appConfigFile->create();
    }

    /**
     * @param string $prefix
     * @param string $path
     */
    public function registerPrefix($prefix, $classPath = null)
    {
        $this->_loadProfile(self::NO_PROFILE_THROW_EXCEPTION);
        if (null === $classPath) {
            $classPath = implode('/', explode('_', rtrim($prefix, '_')));
        }
        $this->_addActionHelperPrefix($prefix, $classPath);
    }
}
