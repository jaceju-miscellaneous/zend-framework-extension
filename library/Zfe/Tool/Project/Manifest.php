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
 * @see Zfe_Tool_Project_Provider_AdvancedProject
 */
require 'Zfe/Tool/Project/Provider/AdvancedProject.php';

/**
 * @see Zfe_Tool_Project_Provider_AdvancedLayout
 */
require 'Zfe/Tool/Project/Provider/AdvancedLayout.php';

/**
 * @see Zfe_Tool_Project_Provider_AutoloaderNamespaces
 */
require 'Zfe/Tool/Project/Provider/AutoloaderNamespaces.php';

/**
 * @see Zfe_Tool_Project_Provider_Plugin
 */
require 'Zfe/Tool/Project/Provider/Plugin.php';

/**
 * @see Zfe_Tool_Project_Provider_ActionHelper
 */
require 'Zfe/Tool/Project/Provider/ActionHelper.php';

/**
 * @see Zfe_Tool_Project_Provider_Extension
 */
require 'Zfe/Tool/Project/Provider/Extension.php';

/**
 * @category   Zfe
 * @package    Zfe_Tool
 */
class Zfe_Tool_Project_Manifest implements
    Zend_Tool_Framework_Manifest_ProviderManifestable
{
    /**
     *
     * @return array
     */
    public function getProviders()
    {
        return array(
            'Zfe_Tool_Project_Provider_AdvancedProject',
            'Zfe_Tool_Project_Provider_AdvancedLayout',
            'Zfe_Tool_Project_Provider_AutoloaderNamespaces',
            'Zfe_Tool_Project_Provider_Plugin',
            'Zfe_Tool_Project_Provider_ActionHelper',
            'Zfe_Tool_Project_Provider_Extension',
        );
    }
}