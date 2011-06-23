<?php

require 'Zfe/Tool/Project/Provider/AdvancedProject.php';
require 'Zfe/Tool/Project/Provider/AdvancedLayout.php';
require 'Zfe/Tool/Project/Provider/AutoloaderNamespaces.php';
require 'Zfe/Tool/Project/Provider/Plugin.php';
require 'Zfe/Tool/Project/Provider/ActionHelper.php';

class Zfe_Tool_Project_Manifest implements
    Zend_Tool_Framework_Manifest_ProviderManifestable
{
    public function getProviders()
    {
        return array(
            'Zfe_Tool_Project_Provider_AdvancedProject',
            'Zfe_Tool_Project_Provider_AdvancedLayout',
            'Zfe_Tool_Project_Provider_AutoloaderNamespaces',
            'Zfe_Tool_Project_Provider_Plugin',
            'Zfe_Tool_Project_Provider_ActionHelper',
        );
    }
}