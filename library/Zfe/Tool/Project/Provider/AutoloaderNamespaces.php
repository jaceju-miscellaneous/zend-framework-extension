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
 * @see Zend_Tool_Project_Provider_Abstract
 */
require_once 'Zend/Tool/Project/Provider/Abstract.php';

/**
 * @category   Zend
 * @package    Zend_Tool
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zfe_Tool_Project_Provider_AutoloaderNamespaces
    extends Zend_Tool_Project_Provider_Abstract
    implements Zend_Tool_Framework_Provider_Pretendable
{
    /**
     * @return Zend_Tool_Project_Context_Zf_ApplicationConfigFile
     */
    protected function _getApplicationConfigResource()
    {
        $profile = $this->_loadProfile(self::NO_PROFILE_THROW_EXCEPTION);
        return $profile->search('ApplicationConfigFile');
    }

    /**
     * @param Zend_Tool_Project_Context_Zf_ApplicationConfigFile $applicationConfigResource
     * @return array
     */
    protected function _getRegisteredNamespaces(Zend_Tool_Project_Profile_Resource $applicationConfigResource)
    {
        $zc = $applicationConfigResource->getAsZendConfig()->toArray();

        $registeredNamespaces = array();
        foreach ($zc as $key => $value) {
            if ('autoloadernamespaces' === strtolower($key)) {
                $registeredNamespaces = $value;
                break;
            }
        }
        return (array) $registeredNamespaces;
    }

    /**
     *
     * @param string $namespace
     */
    public function register($namespace, $section = 'production')
    {
        $applicationConfigResource = $this->_getApplicationConfigResource();
        $registeredNamespaces = $this->_getRegisteredNamespaces($applicationConfigResource);

        if (in_array($namespace, $registeredNamespaces)) {
            $this->_registry->getResponse()->appendContent('The autoloader-namespace \'' . $namespace . '\' already exists in this project\'s application configuration file.');
            return;
        }

        $applicationConfigResource->addStringItem('autoloaderNamespaces[]', $namespace, $section, true);
        $applicationConfigResource->create();

        $this->_registry->getResponse()->appendContent('Autoloader-namespace \'' . $namespace . '\' have been registered.');
    }

    /**
     *
     * @param string $namespace
     */
    public function unregister($namespace, $section = 'production')
    {
        $applicationConfigResource = $this->_getApplicationConfigResource();
        $contentLines = file($applicationConfigResource->getPath());

        $newLines = array();
        $insideSection = false;

        foreach ($contentLines as $contentLineIndex => $contentLine) {

            if ($insideSection === false && preg_match('#^\[' . $section . '#', $contentLine)) {
                $insideSection = true;
            }

            if ($insideSection) {
                // if its blank, or a section heading
                if ((trim($contentLine) == null) || ($contentLines[$contentLineIndex + 1][0] == '[')) {
                    $insideSection = null;
                }
            }

            if (!preg_match('#autoloaderNamespaces\[\]\s?=\s?"?' . $namespace . '"?#', $contentLine)) {
                $newLines[] = $contentLine;
            }
        }

        $newContent = implode('', $newLines);

        file_put_contents($applicationConfigResource->getPath(), $newContent);
    }
}
