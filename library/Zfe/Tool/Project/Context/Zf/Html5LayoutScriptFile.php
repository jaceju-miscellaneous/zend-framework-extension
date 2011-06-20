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
 * @version    $Id: LayoutScriptFile.php 23775 2011-03-01 17:25:24Z ralph $
 */

/**
 * @see Zend_Tool_Project_Context_Filesystem_File
 */
require_once 'Zend/Tool/Project/Context/Filesystem/File.php';

/**
 * This class is the front most class for utilizing Zend_Tool_Project
 *
 * A profile is a hierarchical set of resources that keep track of
 * items within a specific project.
 *
 * @category   Zend
 * @package    Zend_Tool
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class ZendExt_Tool_Project_Context_Zf_Html5LayoutScriptFile extends Zend_Tool_Project_Context_Filesystem_File
{

    /**
     * @var string
     */
    protected $_filesystemName = 'layout.phtml';

    /**
     * @var string
     */
    protected $_layoutName = null;

    /**
     * getName()
     *
     * @return string
     */
    public function getName()
    {
        return 'Html5LayoutScriptFile';
    }

    /**
     * init()
     *
     * @return Zend_Tool_Project_Context_Zf_ViewScriptFile
     */
    public function init()
    {
        if ($layoutName = $this->_resource->getAttribute('layoutName')) {
            $this->_layoutName = $layoutName;
        } else {
            throw new Exception('Either a forActionName or scriptName is required.');
        }

        parent::init();
        return $this;
    }

    /**
     * getPersistentAttributes()
     *
     * @return unknown
     */
    public function getPersistentAttributes()
    {
        $attributes = array();

        if ($this->_layoutName) {
            $attributes['layoutName'] = $this->_layoutName;
        }

        return $attributes;
    }

    /**
     * getContents()
     *
     * @return string
     */
    public function getContents()
    {
        $contents = <<<EOS
<!doctype html>
<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title></title>

	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php \$this->headLink()->appendStylesheet('/css/style.css')
                ->headLink(array(
                    'rel' => 'shortcut icon',
                    'href' => '/img/favicon.ico',
                ), 'PREPEND')
                ->headLink(array(
                    'rel' => 'apple-touch-icon',
                    'href' => '/img/apple-touch-icon.png',
                ), 'PREPEND'); ?>
    <?php echo \$this->headLink(); ?>
</head>
<body>
<?php echo \$this->layout()->content; ?>
<?php \$this->headScript()->appendFile('/lib/modernizr-1.7.min.js', 'text/javascript'); ?>
<?php echo \$this->headScript(); ?>
</body>
</html>
EOS;

        return $contents;
    }

}
