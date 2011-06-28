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
 * @see Zend_Tool_Project_Context_Zf_LayoutScriptFile
 */
require_once 'Zend/Tool/Project/Context/Zf/LayoutScriptFile.php';

/**
 * @category   Zfe
 * @package    Zfe_Tool
 */
class Zfe_Tool_Project_Context_Zf_XhtmlLayoutScriptFile extends Zend_Tool_Project_Context_Zf_LayoutScriptFile
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
