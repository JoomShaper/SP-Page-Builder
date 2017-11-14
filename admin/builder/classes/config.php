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

	private static function str_replace_first($from, $to, $subject) {
		$from = '/'.preg_quote($from, '/').'/';
		return preg_replace($from, $to, $subject, 1);
	}

	public static function addonConfig( $attributes ) {
		if (empty($attributes['addon_name']) || empty($attributes)) {
			return false;
		} else {
			$addon = self::str_replace_first('sp_', '', $attributes['addon_name']);

			if (!isset($attributes['icon']) || !$attributes['icon']) {
				$attributes['icon'] = self::getIcon($addon);
			}
			self::$addons[$addon] = $attributes;
		}
	}

	public static function getIcon( $addon ) {

		$template_name = self::getTemplateName();
		$template_path = JPATH_ROOT . '/templates/' . $template_name . '/sppagebuilder/addons/' . $addon . '/assets/images/icon.png';
		$com_file_path = JPATH_ROOT . '/components/com_sppagebuilder/addons/' . $addon . '/assets/images/icon.png';

		if ( file_exists($template_path) ) {
			$icon = JURI::root(true) . '/templates/' . $template_name . '/sppagebuilder/addons/' . $addon . '/assets/images/icon.png';
		} else if ( file_exists($com_file_path) ) {
			$icon = JURI::root(true) . '/components/com_sppagebuilder/addons/' . $addon . '/assets/images/icon.png';
		} else {
			$icon = JURI::root(true) . '/administrator/components/com_sppagebuilder/assets/img/addon-default.png';
		}

		return $icon;

	}

	private static function getTemplateName() {
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select($db->quoteName(array('template')));
		$query->from($db->quoteName('#__template_styles'));
		$query->where($db->quoteName('client_id') . ' = 0');
		$query->where($db->quoteName('home') . ' = 1');
		$db->setQuery($query);

		return $db->loadObject()->template;
	}
}
