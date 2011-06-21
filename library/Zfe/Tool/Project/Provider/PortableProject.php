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
 * @see Zend_Tool_Project_Provider_Project
 */
require_once 'Zend/Tool/Project/Provider/Project.php';

/**
 * @category   Zend
 * @package    Zend_Tool
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zfe_Tool_Project_Provider_PortableProject
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
     * @param type $nameOfProfile
     * @param type $fileOfProfile
     */
    public function create($path, $nameOfProfile = null, $fileOfProfile = null)
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
            <publicHtaccessFile />
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
        <projectIndexFile />
        <projectHtaccessFile />
    </projectDirectory>
</projectProfile>
EOS;
        return $data;
    }

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
