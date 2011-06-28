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
 * @see Zend_Tool_Project_Provider_Project
 */
require_once 'Zend/Tool/Project/Provider/Project.php';

/**
 * @category   Zfe
 * @package    Zfe_Tool
 */
class Zfe_Tool_Project_Provider_AdvancedProject
    extends Zend_Tool_Project_Provider_Project
{
    public function initialize()
    {
        // load all base contexts ONCE
        $contextRegistry = Zend_Tool_Project_Context_Repository::getInstance();
        $contextRegistry->addContextsFromDirectory(
            dirname(dirname(__FILE__)) . '/Context/Zf/', 'Zfe_Tool_Project_Context_Zf_'
        );
    }

    /**
     * @param string $path
     * @param string $nameOfProfile shortName=n
     * @param string $fileOfProfile shortName=f
     */
    public function create($path, $configFormat = 'ini', $nameOfProfile = null, $fileOfProfile = null)
    {
        parent::create($path, $nameOfProfile, $fileOfProfile);
    }

    /**
     * @return string
     */
    protected function _getDefaultProfile()
    {
        $testAction = '';
        if (Zend_Tool_Project_Provider_Test::isPHPUnitAvailable()) {
            $testAction = '                    	<testApplicationActionMethod forActionName="index" />';
        }

        $version = Zend_Version::VERSION;

        $data = <<<EOS
<?xml version="1.0" encoding="UTF-8"?>
<projectProfile type="default" version="$version">
    <projectDirectory>
        <projectProfileFile />
        <applicationDirectory>
            <apisDirectory enabled="false" />
            <configsDirectory>
                <applicationConfigFile type="ini" />
            </configsDirectory>
            <controllersDirectory>
                <controllerFile controllerName="Index">
                    <actionMethod actionName="index" />
                </controllerFile>
                <controllerFile controllerName="Error" />
            </controllersDirectory>
            <pluginsDirectory enabled="false" />
            <actionHelpersDirectory enabled="false" />
            <formsDirectory enabled="false" />
            <layoutsDirectory enabled="false" />
            <modelsDirectory />
            <modulesDirectory enabled="false" />
            <viewsDirectory>
                <viewScriptsDirectory>
                    <viewControllerScriptsDirectory forControllerName="Index">
                        <viewScriptFile forActionName="index" />
                    </viewControllerScriptsDirectory>
                    <viewControllerScriptsDirectory forControllerName="Error">
                        <viewScriptFile forActionName="error" />
                    </viewControllerScriptsDirectory>
                </viewScriptsDirectory>
                <viewHelpersDirectory />
                <viewFiltersDirectory enabled="false" />
            </viewsDirectory>
            <bootstrapFile />
        </applicationDirectory>
        <dataDirectory enabled="false">
            <cacheDirectory enabled="false" />
            <searchIndexesDirectory enabled="false" />
            <localesDirectory enabled="false" />
            <logsDirectory enabled="false" />
            <sessionsDirectory enabled="false" />
            <uploadsDirectory enabled="false" />
        </dataDirectory>
        <docsDirectory>
            <file filesystemName="README.txt" defaultContentCallback="Zfe_Tool_Project_Provider_PortableProject::getDefaultReadmeContents"/>
        </docsDirectory>
        <libraryDirectory>
            <zfStandardLibraryDirectory enabled="false" />
        </libraryDirectory>
        <publicDirectory>
            <publicCssDirectory enabled="true" />
            <publicJsDirectory enabled="true" />
            <publicImgDirectory enabled="true" />
            <publicLibDirectory enabled="true" />
            <publicPortableHtaccessFile />
        </publicDirectory>
        <projectProvidersDirectory enabled="false" />
        <temporaryDirectory enabled="false" />
        <testsDirectory>
            <testPHPUnitConfigFile />
            <testPHPUnitBootstrapFile />
            <testApplicationDirectory>
                <testApplicationControllerDirectory>
                    <testApplicationControllerFile filesystemName="IndexControllerTest.php" forControllerName="Index">
$testAction
                    </testApplicationControllerFile>
                </testApplicationControllerDirectory>
      	    </testApplicationDirectory>
            <testLibraryDirectory />
        </testsDirectory>
        <portableIndexFile />
        <portableHtaccessFile />
    </projectDirectory>
</projectProfile>
EOS;
        return $data;
    }

    /**
     *
     * @param type $caller
     * @return string
     */
    public static function getDefaultReadmeContents($caller = null)
    {
        $projectDirResource = $caller->getResource()->getProfile()->search('projectDirectory');
        if ($projectDirResource) {
            $name = ltrim(strrchr($projectDirResource->getPath(), DIRECTORY_SEPARATOR), DIRECTORY_SEPARATOR);
            $path = $projectDirResource->getPath();
        } else {
            $path = '/path/to/project';
        }

        return <<< EOS
README
======

This directory should be used to place project specfic documentation including
but not limited to project notes, generated API/phpdoc documentation, or
manual files generated or hand written.  Ideally, this directory would remain
in your development environment only and should not be deployed with your
application to it's final production location.


Setting Up Your VHOST
=====================

The following is a sample VHOST you might want to consider for your project.

<VirtualHost *:80>
   DocumentRoot "$path"
   ServerName $name.local

   # This should be omitted in the production environment
   SetEnv APPLICATION_ENV development

   <Directory "$path">
       Options Indexes MultiViews FollowSymLinks
       AllowOverride All
       Order allow,deny
       Allow from all
   </Directory>

</VirtualHost>

EOS;
    }
}
