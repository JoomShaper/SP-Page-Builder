<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2015 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('resticted aceess');

class SpTypeModule{

	static function getInput($key, $attr)
	{
		if(!isset($attr['std'])){
			$attr['std'] = '';
		}

		// Get list of modules
		$db     = JFactory::getDbo();
		$query  = $db->getQuery(true);
		$query->select('id, title');
		$query->from('#__modules');
		$query->where('client_id = 0');
		$query->where('published = 1');
		$query->order('ordering, title');
		$db->setQuery($query);

		$modules = $db->loadObjectList();



		$output  = '<div class="form-group">';
		$output .= '<label>'.$attr['title'].'</label>';

		$output .= '<select class="form-control addon-input" data-attrname="'.$key.'">';

		$output .= '<option value=""></option>';

		foreach( $modules as $module )
		{
			$output .= '<option value="'.$module->id.'" '.(($attr['std'] == $module->id )?'selected':'').'>'. $module->title .'</option>';
		}

		$output .= '</select>';

		if( ( isset($attr['desc']) ) && ( isset($attr['desc']) != '' ) )
		{
			$output .= '<p class="help-block">' . $attr['desc'] . '</p>';
		}

		$output .= '</div>';

		return $output;
	}

}