##LaraMCE Bundle, by Charl Gottschalk
LaraMCE allows you to generate rich text boxes based on TinyMCE for the excellent [Laravel](http://laravel.com/ "Laravel") PHP framework

*Update: Now supports all TinyMCE configuration settings*

######1. Install using Artisan CLI:

<pre>php artisan bundle:install laramce</pre>

######2. Add the following line to application/bundles.php file:

<pre>return array('laramce' => array('auto' => true),);</pre>

######3. Add the following to the application.php config file in the 'aliases' array:

<pre>'RTE'                 => 'Laramce\\rte',</pre>

######4. Publish the bundle assets to your public folder:

<pre>php artisan bundle:publish</pre>

######5. Add the following to your template view file to include the TinyMCE Javascript:

<pre>Asset::container('laramce')->scripts();</pre>

######To create a rich text box:
_For the mode setting, use 'simple' to create a simple editor, 'full' to create an editor with all options enabled and 'custom' to create an editor with your own settings_

<pre>
RTE::rich_text_box(array('id'=>'rt1',
			 'name'=>'rt1',
			 'selector'=>'rich1',
			 'mode'=>'full',
			 'setup'=>array(
			    'skin'=>'o2k7',
			    'skin_variant'=>'black')
			))
</pre>

######To create initialization script:
_Use this method if you want to create multiple editors on a single page or generate the script where you want._<br/>
_When using this function, you can create normal textareas using Laravel's form builder, just remember to add the same selector id for the script as a class attribute to the textarea._

<pre>
RTE::initialize_script(array('selector'=>'rich1',
			     'mode'=>'full',
			     'setup'=>array(
			         'skin'=>'o2k7',
			         'skin_variant'=>'black')			
			     ))
</pre>

######LaraMCE settings:

*Required*
<pre>'id'        =>   'id of the control',</pre>

*Required*
<pre>'name'      =>   'name of the control',</pre>

*Required*
<pre>'selector'  =>   'a unique name that TinyMCE will use to select the textarea',</pre>

*Required*
<pre>'mode'      =>   'full/simple/custom',</pre>

*Optional*
<pre>'style'     =>   'standard css',</pre>

*Optional*
<pre>'rows'      =>   '5',</pre>

*Optional*
<pre>'cols'      =>   '80',</pre>
                        
*Refer to TinyMCE configuration documentation for correct setting names and values* - http://www.tinymce.com/wiki.php/Configuration                     
<pre>'setup'     =>   array( 'TinyMCE Setting'=>'Value', 'Another TinyMCE Setting'=>'Value')</pre>

Current TinyMCE version is 3.5.6<br/>
TinyMCE Homepage: http://www.tinymce.com/<br/>
TinyMCE Documentation: http://www.tinymce.com/wiki.php<br/>
TinyMCE Configuration Wiki: http://www.tinymce.com/wiki.php/Configuration

