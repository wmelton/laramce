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
	 * Return the start of the TinyMCE initialization script
	 *
	 * @param  string     $textarea_selector_id
	 */
	protected static function start_script($textarea_selector_id)
	{
		return '<script type="text/javascript">tinyMCE.init({editor_selector : "'.$textarea_selector_id.'"';
	}

	/**
	 * Return the end of the TinyMCE initialization script
	 *
	 * @param  string     $script
	 */
	protected static function end_script($script)
	{
		return $script.'});</script>';
	}

	/**
	 * Add a TinyMCE configuration setting to the intitialization
	 *
	 * @param  string     $script
	 * @param  string     $key
	 * @param  object     $value
	 */
	protected static function add_setting($script, $key, $value)
	{
		if(is_bool($value)||is_int($value)){$return_value = $value;}else{$return_value='"'.$value.'"';};
		return $script.','.$key.' : '.$return_value;
	}

	/**
	 * Return script for a full setup.
	 *
	 * @param  string     $textarea_selector_id
	 * @param  array      $setup
	 */
	protected static function full_setup($textarea_selector_id, $setup = array())
	{
		$script = static::start_script($textarea_selector_id);
		$script = static::add_setting($script, 'theme', 'advanced');
		$script = static::add_setting($script, 'plugins', RTE::DEFAULT_PLUGINS);
		$script = static::add_setting($script, 'theme_advanced_buttons1', RTE::DEFAULT_BUTTONS_1);
		$script = static::add_setting($script, 'theme_advanced_buttons2', RTE::DEFAULT_BUTTONS_2);
		$script = static::add_setting($script, 'theme_advanced_buttons3', RTE::DEFAULT_BUTTONS_3);
		$script = static::add_setting($script, 'theme_advanced_buttons4', RTE::DEFAULT_BUTTONS_4);
		$script = static::add_setting($script, 'theme_advanced_toolbar_location', 'top');
		$script = static::add_setting($script, 'theme_advanced_toolbar_align', 'left');
		$script = static::add_setting($script, 'theme_advanced_statusbar_location', 'bottom');
		$script = static::add_setting($script, 'theme_advanced_resizing', true);
		if(array_key_exists('mode', $setup)){$script = static::add_setting($script, 'mode', $setup['mode']);}else{$script = static::add_setting($script, 'mode', 'textareas');}
		if(array_key_exists('readonly', $setup)){$script = static::add_setting($script, 'readonly', $setup['readonly']);}
		if(array_key_exists('skin', $setup)){$script = static::add_setting($script, 'skin', $setup['skin']);}
		if(array_key_exists('skin_variant', $setup)){$script = static::add_setting($script, 'skin_variant', $setup['skin_variant']);}
		$script = static::end_script($script);

		return $script;
	}

	/**
	 * Return script for a simple setup.
	 *
	 * @param  string     $textarea_selector_id
	 * @param  array      $setup
	 */
	protected static function simple_setup($textarea_selector_id, $setup = array())
	{

		$script = static::start_script($textarea_selector_id);
		$script = static::add_setting($script, 'theme', 'simple');
		if(array_key_exists('mode', $setup)){$script = static::add_setting($script, 'mode', $setup['mode']);}else{$script = static::add_setting($script, 'mode', 'textareas');}
		if(array_key_exists('readonly', $setup)){$script = static::add_setting($script, 'readonly', $setup['readonly']);}
		if(array_key_exists('skin', $setup)){$script = static::add_setting($script, 'skin', $setup['skin']);}
		if(array_key_exists('skin_variant', $setup)){$script = static::add_setting($script, 'skin_variant', $setup['skin_variant']);}
		$script = static::end_script($script);

		return $script;
	}

	/**
	 * Return script for a custom setup.
	 *
	 * @param  string     $textarea_selector_id
	 * @param  array      $setup
	 */
	protected static function custom_setup($textarea_selector_id, $setup = array())
	{
		$script = static::start_script($textarea_selector_id);
		if(array_key_exists('mode', $setup)){$script = static::add_setting($script, 'mode', $setup['mode']);}else{$script = static::add_setting($script, 'mode', 'textareas');}
		$script = static::add_setting($script, 'theme', 'advanced');
		foreach ($setup as $key => $value) {
			$script = static::add_setting($script, $key, $value);
		}
		$script = static::end_script($script);

		return $script;
	}

	/**
	 * Create initialization script
	 *
	 * @param  string     $config	 	 
	 * @return string     RTE HTML
	 */
	public static function initialize_script($config = array())
	{
		$mode 		= array_key_exists('mode', $config) ? $config['mode'] : 'full';
		$setup 		= array_key_exists('setup', $config) ? $config['setup'] : array();

		if($mode == 'full')
		{
			$script = static::full_setup($config['selector'], $setup);
		}
		elseif ($mode == 'simple') {
			$script = static::simple_setup($config['selector'], $setup);
		}
		else
		{
			$script = static::custom_setup($config['selector'], $setup);
		}

		return $script;
	}

	/**
	 * Create a new tiny mce editor.
	 *
	 * @param  string     $config	 	 
	 * @return string     RTE HTML
	 */
	public static function rich_text_box($config = array())
	{
		$class 		= array_key_exists('class', $config)? $config['class'] : '';
		$style 		= array_key_exists('style', $config)? $config['style'] : '';
		$rows		= array_key_exists('rows', $config)? $config['rows'] : '5';
		$cols 		= array_key_exists('cols', $config)? $config['cols'] : '80';
		$mode 		= array_key_exists('mode', $config) ? $config['mode'] : 'full';
		$setup 		= array_key_exists('setup', $config) ? $config['setup'] : array();

		if($mode == 'full')
		{
			$script = static::full_setup($config['selector'], $setup);
		}
		elseif ($mode == 'simple') {
			$script = static::simple_setup($config['selector'], $setup);
		}
		else
		{
			$script = static::custom_setup($config['selector'], $setup);
		}
		$html = $script.' <textarea id="'.$config['id'].'" name="'.$config['name'].'" class="'.$config['selector'].''.$class.'" rows="'.$rows.'" cols="'.$cols.'" style="'.$style.'"></textarea>';
		return $html;
	}
}