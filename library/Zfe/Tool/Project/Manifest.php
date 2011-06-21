<?php

require 'Zfe/Tool/Project/Provider/PortableProject.php';
require 'Zfe/Tool/Project/Provider/AdvancedLayout.php';
require 'Zfe/Tool/Project/Provider/Extension.php';
require 'Zfe/Tool/Project/Provider/AutoloaderNamespaces.php';

class Zfe_Tool_Project_Manifest implements
    Zend_Tool_Framework_Manifest_ProviderManifestable
{
    public function getProviders()
    {
        return array(
            'Zfe_Tool_Project_Provider_PortableProject',
            'Zfe_Tool_Project_Provider_AdvancedLayout',
            'Zfe_Tool_Project_Provider_Extension',
            'Zfe_Tool_Project_Provider_AutoloaderNamespaces',
        );
    }
}