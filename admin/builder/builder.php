<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2016 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('restricted aceess');

class SpAddonsConfig {

	public static $addons = array();

	public static function addonConfig( $attributes )
	{
		if (empty($attributes['addon_name']) || empty($attributes) || empty($attributes['attr']) ) {
			return false;
		}
		else
		{
			$addon = $attributes['addon_name'];
			self::$addons[$addon] = $attributes;
		}
	}

	public static function getRowConfig()
	{
		return unserialize(SP_ROW_SETTINGS);
	}

	public static function getColumnConfig()
	{
		return unserialize(SP_COLUMN_SETTINGS);
	}
}


class SpPgaeBuilder {

	public $name;

	public function __construct()
	{
		$this->getTypes();
		$this->getElements();
	}

	public static function getAddonRowColumnConfig( $settings = array() )
	{
		$data = '';
		if (count($settings)) {
			foreach ($settings as $key => $value) {
				$data .= ' data-'.$key.'="'.$value.'"';
			}
		}
		return $data;
	}


	private function getTypes()
	{
		$types = JFolder::files( dirname( __FILE__ ) . '/types', '\.php$', false, true);

		foreach ($types as $type) {
			include_once $type;
		}
	}


	private static function getTemplateName()
	{
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select($db->quoteName(array('template')));
		$query->from($db->quoteName('#__template_styles'));
		$query->where($db->quoteName('client_id') . ' = 0');
		$query->where($db->quoteName('home') . ' = 1');
		$db->setQuery($query);

		return $db->loadObject()->template;
	}

	private function getElements( $folders = array() )
	{

		require_once JPATH_COMPONENT_SITE . '/addons/module/admin.php';//Include module manually

		$template_path = JPATH_ROOT . '/templates/' . self::getTemplateName(); // current template path
		$tmpl_folders = array();

		if (file_exists($template_path . '/sppagebuilder/addons'))
		{
			$tmpl_folders = JFolder::folders( $template_path . '/sppagebuilder/addons');
		}
		

		$folders = JFolder::folders( JPATH_COMPONENT_SITE .'/addons');

		if($tmpl_folders){
			$merge_folders = array_merge( $folders, $tmpl_folders );
			$folders = array_unique( $merge_folders );
		}

		if (count($folders))
		{
			foreach ($folders as $folder)
			{
				$tmpl_file_path = $template_path . '/sppagebuilder/addons/'.$folder.'/admin.php';
				$com_file_path = JPATH_COMPONENT_SITE . '/addons/'.$folder.'/admin.php';

				if($folder!='module') {
					if(file_exists( $tmpl_file_path ))
					{
						require_once $tmpl_file_path;
					}
					else if( file_exists( $com_file_path ))
					{
						require_once $com_file_path;
					}
				}
			}
		}
	}

	public static function getIcon( $addon )
	{

		$template_name = self::getTemplateName();

		$template_path = JPATH_ROOT . '/templates/' . $template_name . '/sppagebuilder/addons/' . $addon . '/icon.png';
		$com_file_path = JPATH_COMPONENT_SITE . '/addons/' . $addon . '/icon.png';

		if ( file_exists($template_path) )
		{
			$icon = JURI::root(true) . '/templates/' . $template_name . '/sppagebuilder/addons/' . $addon . '/icon.png';
		}
		else if ( file_exists($com_file_path) )
		{
			$icon = JURI::root(true) . '/components/com_sppagebuilder/addons/' . $addon . '/icon.png';
		}
		else
		{
			$icon = JURI::root(true) . '/administrator/components/com_sppagebuilder/assets/img/addon-default.png';
		}

		return $icon;

	}

	public static function getInputElements( $key, $attr )
	{
		return call_user_func(array( 'SpType' . ucfirst( $attr['type'] ), 'getInput'), $key, $attr );
	}


	public static function outputGenerate( $key, $attr )
	{
		if (isset($attr['type'])) {
			if ($attr['type'] != 'repeatable') {
				return call_user_func(array( 'SpType' . ucfirst( $attr['type'] ), 'getInput'), $key, $attr );
			}
		}
		return '';

	}

}
