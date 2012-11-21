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
		if(!empty($textarea_selector_id))
		{
			$selector = 'editor_selector : "'.$textarea_selector_id.'"';
		}
		else
		{
			$selector='';
		}

		return '<script type="text/javascript">tinyMCE.init({'.$selector;
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
		if ( is_bool( $value ) || is_int( $value ) ){
			$return_value = $value;
		} elseif( is_array($value) ){
			$return_value = json_encode($value);
		}else {
			$return_value = '"' . $value . '"';
		};
		return $script . ',' . $key . ' : ' . $return_value;
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
	public static function rich_text_box($name, $value = '',$config = array())
	{
		$mode 		= array_key_exists('mode', $config) ? $config['mode'] : 'full';
		$setup 		= array_key_exists('setup', $config) ? $config['setup'] : array();
		$attributes = array_key_exists('att', $config) ? $config['att'] : array();

		if(!isset($attributes['name']))
		{
			$attributes['name']=$name;
		}
		else
		{
			$name=$attributes['name'];
		}

		if(!isset($config['selector']))
		{
			$config['selector']=static::random(6);
		}

		if(!isset($attributes['id']))
		{
			$attributes['id']=$name.static::random(6);
		}

		if(isset($attributes['class']))
		{
			$attributes['class']=$attributes['class'].' '.$config['selector'];
		}
		else
		{
			$attributes['class']=$config['selector'];
		}

		if ( ! isset($attributes['rows'])) $attributes['rows'] = 10;

		if ( ! isset($attributes['cols'])) $attributes['cols'] = 50;

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
		$html = $script.' <textarea '.HTML::attributes($attributes).'>'.$value.'</textarea>';
		return $html;
	}

	/**
	 * Generate a random alpha or alpha-numeric string.
	 *
	 * <code>
	 *		// Generate a 40 character random alpha-numeric string
	 *		echo Str::random(40);
	 *
	 *		// Generate a 16 character random alphabetic string
	 *		echo Str::random(16, 'alpha');
	 * <code>
	 *
	 * @param  int	   $length
	 * @param  string  $type
	 * @return string
	 */
	protected static function random($length, $type = 'alnum')
	{
		return substr(str_shuffle(str_repeat(static::pool($type), 5)), 0, $length);
	}

	/**
	 * Get the character pool for a given type of random string.
	 *
	 * @param  string  $type
	 * @return string
	 */
	protected static function pool($type)
	{
		switch ($type)
		{
			case 'alpha':
				return 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

			case 'alnum':
				return '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

			default:
				throw new \Exception("Invalid random string type [$type].");
		}
	}
}