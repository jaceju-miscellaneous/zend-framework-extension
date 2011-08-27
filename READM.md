## Install

Checkout the source from Subversion repository:

`svn checkout http://zend-framework-extension.googlecode.com/svn/trunk/library/Zfe /path/to/library`

Add manifest to ~/.zf.ini

`zf enable config.manifest Zfe_Tool_Project_Manifest`

## Usage

Creaet Portable Project:

`zf create advanced-project path`

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

`zf create action-helper name`

Register action helper prefix/path:

`zf register action-helper.prefix prefix [class-path]`

Create Front Controller Plugin:

`zf create plugin name`

Register Front Controller Plugin:

`zf register plugin class-name`