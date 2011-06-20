<?php

require 'ZendExt/Tool/Project/Provider/PortableProject.php';
require 'ZendExt/Tool/Project/Provider/AdvancedLayout.php';

class ZendExt_Tool_Project_Manifest implements
    Zend_Tool_Framework_Manifest_ProviderManifestable
{
    public function getProviders()
    {
        return array(
            'ZendExt_Tool_Project_Provider_PortableProject',
            'ZendExt_Tool_Project_Provider_AdvancedLayout',
        );
    }
}