## Install

Checkout the source from GitHub repository:

<pre>
git clone git://github.com/jaceju/zend_framework_extension.git
</pre>

Add manifest to ~/.zf.ini

<pre>
zf enable config.manifest Zfe_Tool_Project_Manifest
</pre>

## Usage

Creaet Portable Project:

<pre>
zf create advanced-project path
</pre>

Enable Advanced Layout:

<pre>
-- default doctype is XHTML --

zf enable advanced-layout

-- use HTML5 layout --

zf enable advanced-layout html5

-- or --

zf enable advanced-layout --doctype=html5
</pre>

Register/Unregister autoloader-namespace:

<pre>
zf register autoloader-namespaces name
zf unregister autoloader-namespaces name
</pre>

Create action helper for project:

<pre>
zf create action-helper name
</pre>

Register action helper prefix/path:

<pre>
zf register action-helper.prefix prefix [class-path]
</pre>

Create Front Controller Plugin:

<pre>
zf create plugin name
</pre>

Register Front Controller Plugin:

<pre>
zf register plugin class-name
</pre>


Jace
