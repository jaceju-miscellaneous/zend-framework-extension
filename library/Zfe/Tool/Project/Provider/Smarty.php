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
class Zfe_Tool_Project_Provider_Smarty
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
    }

    /**
     * @param Zend_Tool_Project_Profile $profile
     * @param string $pluginName
     * @return bool
     */
    public static function hasResource(Zend_Tool_Project_Profile $profile, $pluginName)
    {
    }

    /**
     * @return void
     */
    public function enable()
    {
        $this->_loadProfile(self::NO_PROFILE_THROW_EXCEPTION);
    }
}
