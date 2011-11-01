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

To Creaet Portable Project:

<pre>
zf create advanced-project path
</pre>

To Enable Advanced HTML5 Layout:

<pre>
zf enable advanced-layout
</pre>

Then you can use compass and livereload to watch the new project (Install compass and livereload first) :

<pre>
compass watch path
livereload path
</pre>

To Register/Unregister autoloader-namespace:

<pre>
zf register autoloader-namespaces name
zf unregister autoloader-namespaces name
</pre>

To Create action helper for project:

<pre>
zf create action-helper name
</pre>

To Register action helper prefix/path:

<pre>
zf register action-helper.prefix prefix [class-path]
</pre>

To Create Front Controller Plugin:

<pre>
zf create plugin name
</pre>

To Register Front Controller Plugin:

<pre>
zf register plugin class-name
</pre>


Jace
