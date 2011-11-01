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
 * @see Zend_Tool_Project_Context_Filesystem_File
 */
require_once 'Zend/Tool/Project/Context/Filesystem/File.php';

/**
 * @category   Zfe
 * @package    Zfe_Tool
 */
class Zfe_Tool_Project_Context_WebDev_LiveReloadConfig extends Zend_Tool_Project_Context_Filesystem_File
{

    /**
     * @var string
     */
    protected $_filesystemName = '.livereload';

    /**
     * getName()
     *
     * @return string
     */
    public function getName()
    {
        return 'liveReloadConfig';
    }

    /**
     * getContents()
     *
     * @return string
     */
    public function getContents()
    {
        $output = <<<EOS
# Lines starting with pound sign (#) are ignored.

# additional extensions to monitor
#config.exts << 'haml'
config.exts << 'phtml'
config.exts << 'ini'

# exclude files with NAMES matching this mask
#config.exclusions << '~*'
# exclude files with PATHS matching this mask (if the mask contains a slash)
#config.exclusions << '/excluded_dir/*'
# exclude files with PATHS matching this REGEXP
#config.exclusions << /somedir.*(ab){2,4}.(css|js)$/

# reload the whole page when .js changes
#config.apply_js_live = false
# reload the whole page when .css changes
#config.apply_css_live = false
# reload the whole page when images (png, jpg, gif) change
#config.apply_images_live = false

# wait 100ms for more changes before reloading a page
#config.grace_period = 0.1
EOS;
        return $output;
    }

}
