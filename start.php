<?php

/**
 * LaraMCE for generating TinyMCE rich text editors.
 *
 * @package     Bundles
 * @subpackage  TinyMCE
 * @author      Charl Gottschalk - Follow @charlgottschalk
 *
 * @see http://www.tinymce.com/index.php
 */

Autoloader::map(array(
	'Laramce\\RTE'               => __DIR__.'/rte.php',
));

Asset::container('laramce')->bundle('laramce');

//Asset::container('laramce')->add('tinymce',  'tiny_mce/tiny_mce.js');
Asset::container('laramce')->add('tinymce',  'tiny_mce/tiny_mce.js');