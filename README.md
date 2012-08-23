LaraMCE Bundle, by Charl Gottschalk
LaraMCE allows you to generate rich text boxes based on TinyMCE

Install using Artisan CLI:

php artisan bundle:install laramce
Add the following line to application/bundles.php

return array(
    'laramce' => array('auto' => true),
);

Add the following to the application.php config file:

'RTE'                 => 'Laramce\\rte',

Publish the bundle assets to your public folder.

php artisan bundle:publish

Add the following to your template view file to include the TinyMCE Javascript.

Asset::container('laramce')->styles();

Current TinyMCE version is 3.5.6.
Homepage: http://www.tinymce.com/
