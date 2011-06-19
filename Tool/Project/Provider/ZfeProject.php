<?php

class ZendExt_Tool_Project_Provider_ZfeProject
    extends Zend_Tool_Project_Provider_Project
{
    public function initialize()
    {
        // load all base contexts ONCE
        $contextRegistry = Zend_Tool_Project_Context_Repository::getInstance();
        $contextRegistry->addContextsFromDirectory(
            dirname(dirname(__FILE__)) . '/Context/Zf/', 'ZendExt_Tool_Project_Context_Zf_'
        );
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
            <file filesystemName="README.txt" defaultContentCallback="Zend_Tool_Project_Provider_Project::getDefaultReadmeContents"/>
        </docsDirectory>
        <libraryDirectory>
            <zfStandardLibraryDirectory enabled="false" />
        </libraryDirectory>
        <publicDirectory>
            <publicStylesheetsDirectory enabled="true" />
            <publicScriptsDirectory enabled="true" />
            <publicImagesDirectory enabled="true" />
            <publicIndexFile />
            <htaccessFile />
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

}
