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
 * @see Zend_Tool_Project_Context_Zf_LayoutScriptFile
 */
require_once 'Zend/Tool/Project/Context/Zf/LayoutScriptFile.php';

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
class ZendExt_Tool_Project_Context_Zf_XhtmlLayoutScriptFile extends Zend_Tool_Project_Context_Zf_LayoutScriptFile
{

    /**
     * getName()
     *
     * @return string
     */
    public function getName()
    {
        return 'XhtmlLayoutScriptFile';
    }

    /**
     * getContents()
     *
     * @return string
     */
    public function getContents()
    {
        $contents = <<<EOS
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
</head>
<body>
<?php echo \$this->layout()->content; ?>
</body>
</html>
EOS;

        return $contents;
    }

}
