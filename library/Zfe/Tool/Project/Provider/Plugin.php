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
class Zfe_Tool_Project_Provider_Plugin
    extends Zend_Tool_Project_Provider_Abstract
    implements Zend_Tool_Framework_Provider_Pretendable
{
    /**
     * @param Zend_Tool_Project_Profile $profile
     * @param string $pluginName
     * @return Zfe_Tool_Project_Context_Zf_PluginFile
     */
    public static function createResources(Zend_Tool_Project_Profile $profile, $pluginName)
    {
        $pluginsDirectory = $profile->search('pluginsDirectory');
        $pluginFile = $pluginsDirectory->createResource('PluginFile', array('pluginName' => $pluginName));

        return $pluginFile;
    }

    /**
     * @param Zend_Tool_Project_Profile $profile
     * @param string $pluginName
     * @return bool
     */
    public static function hasResource(Zend_Tool_Project_Profile $profile, $pluginName)
    {
        $pluginsDirectory = $profile->search(array('pluginsDirectory'));

        if (!($pluginsDirectory instanceof Zend_Tool_Project_Profile_Resource)) {
            return false;
        }

        $pluginFile = $pluginsDirectory->search(array('PluginFile' => array('pluginName' => $pluginName)));

        return ($pluginFile instanceof Zend_Tool_Project_Profile_Resource) ? true : false;
    }

    /**
     * @param sting $name
     * @return void
     */
    public function create($name)
    {
        $this->_loadProfile(self::NO_PROFILE_THROW_EXCEPTION);

        // Check that there is not a dash or underscore, return if doesnt match regex
        if (preg_match('#[_-]#', $name)) {
            throw new Zend_Tool_Project_Provider_Exception('Plugin names should be camel cased.');
        }

        $originalName = $name;
        $name = ucfirst($name);

        if (self::hasResource($this->_loadedProfile, $name)) {
            throw new Zend_Tool_Project_Provider_Exception('This project already has a Plugin named ' . $name);
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
            $pluginResource = self::createResources($this->_loadedProfile, $name);
        } catch (Exception $e) {
            $response = $this->_registry->getResponse();
            $response->setException($e);
            return;
        }

        // do the creation
        if ($request->isPretend()) {
            $response->appendContent('Would create a plugin at '  . $pluginResource->getContext()->getPath());
        } else {
            $response->appendContent('Creating a plugin at ' . $pluginResource->getContext()->getPath());
            $pluginResource->create();
            $this->_storeProfile();
        }
    }

    /**
     * @param string $className
     */
    public function register($className)
    {
        $this->_loadProfile(self::NO_PROFILE_THROW_EXCEPTION);
        $response = $this->_registry->getResponse();
        $appConfigFile = $this->_loadedProfile->search('ApplicationConfigFile');
        $pluginName = ($t = array_reverse(explode('_', $className))) ? strtolower($t[0]) : null;

        if (null === $pluginName) {
            $response->appendContent("Can not register plugin '$className'.");
        } else {
            $response->appendContent('Plugin \'' . $className . '\' has been registered to the application.ini file');
            $appConfigFile->addStringItem('resources.frontController.plugins.' . $pluginName . '.class', $className, 'production', true);
            $appConfigFile->create();
        }
    }
}
