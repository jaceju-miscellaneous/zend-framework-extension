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
class Zfe_Tool_Project_Context_Zf_ScreenCss extends Zend_Tool_Project_Context_Filesystem_File
{

    /**
     * @var string
     */
    protected $_filesystemName = 'screen.css';

    /**
     * getName()
     *
     * @return string
     */
    public function getName()
    {
        return 'ScreenCss';
    }

    /**
     * getContents()
     *
     * @return string
     */
    public function getContents()
    {
        $output = <<<EOS
/* Welcome to Compass.
 * In this file you should write your main styles. (or centralize your imports)
 * Import this file using the following HTML or equivalent:
 * <link href="/stylesheets/screen.css" media="screen, projection" rel="stylesheet" type="text/css" /> */
/* line 17, /path/to/compass/reset/_utilities.scss */
html, body, div, span, applet, object, iframe,
h1, h2, h3, h4, h5, h6, p, blockquote, pre,
a, abbr, acronym, address, big, cite, code,
del, dfn, em, img, ins, kbd, q, s, samp,
small, strike, strong, sub, sup, tt, var,
b, u, i, center,
dl, dt, dd, ol, ul, li,
fieldset, form, label, legend,
table, caption, tbody, tfoot, thead, tr, th, td,
article, aside, canvas, details, embed,
figure, figcaption, footer, header, hgroup,
menu, nav, output, ruby, section, summary,
time, mark, audio, video {
  margin: 0;
  padding: 0;
  border: 0;
  font-size: 100%;
  font: inherit;
  vertical-align: baseline;
}

/* line 20, /path/to/compass/reset/_utilities.scss */
body {
  line-height: 1;
}

/* line 22, /path/to/compass/reset/_utilities.scss */
ol, ul {
  list-style: none;
}

/* line 24, /path/to/compass/reset/_utilities.scss */
table {
  border-collapse: collapse;
  border-spacing: 0;
}

/* line 26, /path/to/compass/reset/_utilities.scss */
caption, th, td {
  text-align: left;
  font-weight: normal;
  vertical-align: middle;
}

/* line 28, /path/to/compass/reset/_utilities.scss */
q, blockquote {
  quotes: none;
}
/* line 101, /path/to/compass/reset/_utilities.scss */
q:before, q:after, blockquote:before, blockquote:after {
  content: "";
  content: none;
}

/* line 30, /path/to/compass/reset/_utilities.scss */
a img {
  border: none;
}

/* line 114, /path/to/compass/reset/_utilities.scss */
article, aside, details, figcaption, figure, footer, header, hgroup, menu, nav, section, summary {
  display: block;
}
EOS;
        return $output;
    }

}
