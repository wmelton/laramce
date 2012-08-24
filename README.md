##LaraMCE Bundle, by Charl Gottschalk
LaraMCE allows you to generate rich text boxes based on TinyMCE for the excellent [Laravel](http://laravel.com/ "Laravel") PHP framework

######1. Install using Artisan CLI:

<pre>php artisan bundle:install laramce</pre>

######2. Add the following line to application/bundles.php file:

<pre>return array('laramce' => array('auto' => true),);</pre>

######3. Add the following to the application.php config file in the 'aliases' array:

<pre>'RTE'                 => 'Laramce\\rte',</pre>

######4. Publish the bundle assets to your public folder:

<pre>php artisan bundle:publish</pre>

######5. Add the following to your template view file to include the TinyMCE Javascript:

<pre>Asset::container('laramce')->styles();</pre>

######To create a rich text box:
_for the mode setting, use 'simple' to create a simple editor, 'full' to create an editor with all options enabled and 'custom' to create an editor with your own settings_

<pre>
RTE::rich_text_box(array(
					'id'=>'rt1',
					'name'=>'rt1',
					'selector'=>'rich1',
					'mode'=>'full',
					'setup'=>array(
						'skin'=>'o2k7',
						'skin_variant'=>'black'
						)
					))
</pre>

######LaraMCE settings:

<pre>
<i>Available in all modes | Required</i>
'id'        =>   'id of the control',

<i>Available in all modes | Required</i>
'name'      =>   'name of the control',

<i>Available in all modes | Required</i>
'selector'  =>   'a unique name that TinyMCE will use to select the textarea',

<i>Required</i>
'mode'      =>   'full/simple/custom',

<i>Available in all modes</i>
'style'     =>   'standard css',

<i>Available in all modes</i>
'rows'      =>   '5',

<i>Available in all modes</i>
'cols'      =>   '80',

<i>Only available in 'full' and 'custom' modes</i>
'plugins'   =>   'refer to TinyMCE documentation for plugins',

<i>Only available in 'full' and 'custom' modes</i>
'buttons'   =>   array( 'buttons1'=>'Refer to TinyMCE documentation for buttons',
                        'buttons2'=>'Refer to TinyMCE documentation for buttons',
                        'buttons3'=>'Refer to TinyMCE documentation for buttons',
                        'buttons4'=>'Refer to TinyMCE documentation for buttons',),
                        
<i>All except for 'skin' and 'skin_variant', available in 'full' and 'custom' modes only</i>                        
'setup'     =>   array( 'skin'=>'o2k7',
                        'skin_variant'=>'silver/black',
                        'toolbar_location'=>'top/bottom/external',
                        'toolbar_align'=>'left/right/center',
                        'statusbar_location'=>'top/bottom/none',
                        'advanced_resizing'=>'true/false')
</pre>

Current TinyMCE version is 3.5.6<br/>
TinyMCE Homepage: http://www.tinymce.com/<br/>
TinyMCE Documentation: http://www.tinymce.com/wiki.php

