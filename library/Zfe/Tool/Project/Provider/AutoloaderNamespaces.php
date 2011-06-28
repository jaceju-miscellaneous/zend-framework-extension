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

        if (count($contentLines) !== count($newLines)) {
            $this->_registry->getResponse()->appendContent('Autoloader-namespace \'' . $namespace . '\' have been unregistered.');
        } else {
            $this->_registry->getResponse()->appendContent('Autoloader-namespace \'' . $namespace . '\' not found.');
        }
    }
}
