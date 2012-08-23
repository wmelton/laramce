<?php namespace Laramce;

use \HTML;

/**
 * RTE for generating TinyMCE rich text editors.
 * 
 * @package     Bundles
 * @subpackage  TinyMCE
 * @author      Charl Gottschalk - Follow @charlgottschalk
 *
 * @see http://www.tinymce.com/index.php
 */
class RTE 
{

	const DEFAULT_PLUGINS = 'autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave,visualblocks';
	const DEFAULT_BUTTONS_1 = 'save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect';
	const DEFAULT_BUTTONS_2 = 'cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor';
	const DEFAULT_BUTTONS_3 = 'tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen';
	const DEFAULT_BUTTONS_4 = 'insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft,visualblocks';


	/**
	 * Return script for a full setup.
	 *
	 * @param  string     $textarea_selector_id
	 */
	protected static function full_setup($textarea_selector_id, $setup = array())
	{

		$script = '<script type="text/javascript">
						tinyMCE.init({
							// General options
							mode : "specific_textareas",
							editor_selector : "'.$textarea_selector_id.'",
							theme : "advanced",
							plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave,visualblocks",
							'.(array_key_exists('skin', $setup)? 'skin : "'.$setup['skin'] .'",' : "").'
							'.(array_key_exists('skin_variant', $setup)? 'skin_variant : "'.$setup['skin_variant'] .'",' : "").'
							theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
							theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
							theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
							theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft,visualblocks",
							theme_advanced_toolbar_location : "'.(array_key_exists('toolbar_location', $setup)? $setup['toolbar_location'] : 'top').'",
							theme_advanced_toolbar_align : "'.(array_key_exists('toolbar_align', $setup)? $setup['toolbar_align'] : 'left').'",
							theme_advanced_statusbar_location : "'.(array_key_exists('statusbar_location', $setup)? $setup['statusbar_location'] : 'bottom').'",
							theme_advanced_resizing : '.(array_key_exists('advanced_resizing', $setup)? $setup['advanced_resizing'] : true).',
							});
					</script>'; 

		return $script;
	}

	/**
	 * Return script for a simple setup.
	 *
	 * @param  string     $textarea_selector_id
	 */
	protected static function simple_setup($textarea_selector_id, $setup = array())
	{

		$script = '<script type="text/javascript">
						tinyMCE.init({
							mode : "specific_textareas",
							editor_selector : "'.$textarea_selector_id.'",
							theme : "simple",
							'.(array_key_exists('skin', $setup)? 'skin : "'.$setup['skin'] .'",' : "").'
							'.(array_key_exists('skin_variant', $setup)? 'skin_variant : "'.$setup['skin_variant'] .'",' : "").'
						});
					</script>'; 

		return $script;
	}

	/**
	 * Return script for a custom setup.
	 *
	 * @param  string     $textarea_selector_id
	 * @param  string     $plugins
	 * @param  array      $buttons
	 * @param  array      $setup
	 */
	protected static function custom_setup($textarea_selector_id, $plugins, $buttons = array(), $setup = array())
	{

		$script = '<script type="text/javascript">
						tinyMCE.init({
							// General options
							mode : "specific_textareas",
							editor_selector : "'.$textarea_selector_id.'",
							theme : "advanced",
							plugins : "'.$plugins.'",
							'.(array_key_exists('skin', $setup)? 'skin : "'.$setup['skin'] .'",' : "").'
							'.(array_key_exists('skin_variant', $setup)? 'skin_variant : "'.$setup['skin_variant'] .'",' : "").'
							theme_advanced_buttons1 : "'.(array_key_exists('buttons1', $buttons)? $buttons['buttons1'] : RTE::DEFAULT_BUTTONS_1).'",
							'.(array_key_exists('buttons2', $buttons)? 'theme_advanced_buttons2 : "'.$buttons['buttons2'] .'",' : "").'
							'.(array_key_exists('buttons3', $buttons)? 'theme_advanced_buttons3 : "'.$buttons['buttons3'] .'",' : "").'
							'.(array_key_exists('buttons4', $buttons)? 'theme_advanced_buttons4 : "'.$buttons['buttons4'] .'",' : "").'
							theme_advanced_toolbar_location : "'.(array_key_exists('toolbar_location', $setup)? $setup['toolbar_location'] : 'top').'",
							theme_advanced_toolbar_align : "'.(array_key_exists('toolbar_align', $setup)? $setup['toolbar_align'] : 'left').'",
							theme_advanced_statusbar_location : "'.(array_key_exists('statusbar_location', $setup)? $setup['statusbar_location'] : 'bottom').'",
							theme_advanced_resizing : '.(array_key_exists('advanced_resizing', $setup)? $setup['advanced_resizing'] : true).',
							});
					</script>'; 

		return $script;
	}

	/**
	 * Create a new tiny mce editor.
	 *
	 * @param  string     $id
	 * @param  string     $name
	 * @param  string     $selector_id
	 * @param  string     $config	 	 
	 * @return string     RTE HTML
	 */
	public static function rich_text_box($config = array())
	{
		$style = array_key_exists('style', $config)? $config['style'] : '';
		$rows = array_key_exists('rows', $config)? $config['rows'] : '5';
		$cols = array_key_exists('cols', $config)? $config['cols'] : '80';
		$mode = array_key_exists('mode', $config) ? $config['mode'] : 'full';
		$buttons = array_key_exists('buttons', $config) ? $config['buttons'] : array();
		$plugins = array_key_exists('plugins', $config) ? $config['plugins'] : RTE::DEFAULT_PLUGINS;
		$setup = array_key_exists('setup', $config) ? $config['setup'] : array();

		if($mode == 'full')
		{
			$script = static::full_setup($config['selector'], $setup);
		}
		elseif ($mode == 'simple') {
			$script = static::simple_setup($config['selector'], $setup);
		}
		else
		{
			$script = static::custom_setup($config['selector'], $plugins, $buttons, $setup);
		}
		$html = $script.' <textarea id="'.$config['id'].'" name="'.$config['name'].'" class="'.$config['selector'].'" rows="'.$rows.'" cols="'.$cols.'" style="'.$style.'"></textarea>';
		return $html;
	}
}