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
class Zfe_Tool_Project_Provider_AdvancedLayout extends Zend_Tool_Project_Provider_Abstract implements Zend_Tool_Framework_Provider_Pretendable
{
    /**
     * @param Zend_Tool_Project_Profile $profile
     * @param string $doctype
     * @return Zend_Tool_Project_Context_Filesystem_File
     */
    public static function createResource(Zend_Tool_Project_Profile $profile, $doctype = 'xhtml')
    {
        $doctype = ucfirst(strtolower($doctype));

        $applicationDirectory = $profile->search('applicationDirectory');
        $layoutDirectory = $applicationDirectory->search('layoutsDirectory');

        if ($layoutDirectory == false) {
            $layoutDirectory = $applicationDirectory->createResource('layoutsDirectory');
        }

        $layoutScriptsDirectory = $layoutDirectory->search('layoutScriptsDirectory');

        if ($layoutScriptsDirectory == false) {
            $layoutScriptsDirectory = $layoutDirectory->createResource('layoutScriptsDirectory');
        }

        $resourceName = $doctype . 'LayoutScriptFile';
        $layoutScriptFile = $layoutScriptsDirectory->search($resourceName, array('layoutName' => 'layout'));

        if ($layoutScriptFile == false) {
            $layoutScriptFile = $layoutScriptsDirectory->createResource($resourceName, array('layoutName' => 'layout'));
        }

        return $layoutScriptFile;
    }

    /**
     * @param string $doctype
     * @return void
     */
    public function enable($doctype = 'html5')
    {
        $profile = $this->_loadProfile(self::NO_PROFILE_THROW_EXCEPTION);

        $applicationConfigResource = $profile->search('ApplicationConfigFile');

        if (!$applicationConfigResource) {
            throw new Zend_Tool_Project_Exception('A project with an application config file is required to use this provider.');
        }

        $zc = $applicationConfigResource->getAsZendConfig();

        if (isset($zc->resources) && isset($zf->resources->layout)) {
            $this->_registry->getResponse()->appendContent('A layout resource already exists in this project\'s application configuration file.');
            return;
        }

        $layoutPath = 'APPLICATION_PATH "/layouts/scripts/"';

        if ($this->_registry->getRequest()->isPretend()) {
            $this->_registry->getResponse()->appendContent('Would add "resources.layout.layoutPath" key to the application config file.');
        } else {
            $applicationConfigResource->addStringItem('resources.layout.layoutPath', $layoutPath, 'production', false);
            $applicationConfigResource->create();

            $layoutScriptFile = self::createResource($profile, $doctype);

            $layoutScriptFile->create();

            $this->_registry->getResponse()->appendContent(
                'Layouts have been enabled, and a default layout created at '
                . $layoutScriptFile->getPath()
                );

            $this->_registry->getResponse()->appendContent('A layout entry has been added to the application config file.');
        }
    }

    public function disable()
    {
        // @todo
    }
}
