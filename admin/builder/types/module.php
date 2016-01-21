<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2016 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('restricted aceess');

class SpTypeModule{

	static function getInput($key, $attr)
	{
		if(!isset($attr['std'])){
			$attr['std'] = '';
		}

		// Depend
		$depend_data = '';
		if(isset($attr['depends'])) {
			$depends = $attr['depends'];
			foreach ($depends as $selector => $value) {
				$depend_data .= ' data-group_parent="' . $selector . '" data-depend="' . $value . '"';
			}
		}

		if(!isset($attr['module'])){
			$attr['module'] = 'module';
		}

		// Get list of modules
		if($attr['module'] == 'position') {

			$db     = JFactory::getDbo();
			$query  = $db->getQuery(true);
			$query->select(array('position'))
				->from('#__modules')
				->where('client_id = 0')
				->where('published = 1')
				->group('position')
				->order('position ASC');

          	$db->setQuery($query);
            $positions = $db->loadColumn();

            $template = self::getTemplate();
            $templateXML = JPATH_SITE.'/templates/'.$template.'/templateDetails.xml';
            $template = simplexml_load_file( $templateXML );

            foreach($template->positions[0] as $position)  {
            	$positions[] =  (string) $position;
            }

            $positions = array_unique($positions);

		} else {
			$db     = JFactory::getDbo();
			$query  = $db->getQuery(true);
			$query->select('id, title');
			$query->from('#__modules');
			$query->where('client_id = 0');
			$query->where('published = 1');
			$query->order('ordering, title');
			$db->setQuery($query);
			$modules = $db->loadObjectList();
		}


		$output  = '<div class="form-group"' . $depend_data . '>';
		$output .= '<label>'.$attr['title'].'</label>';

		$output .= '<select class="form-control addon-input" data-attrname="'.$key.'" id="field_'.$key.'">';

		$output .= '<option value=""></option>';

		if($attr['module'] == 'position') {
			foreach( $positions as $position )
			{
				$output .= '<option value="'.$position.'" '.(($attr['std'] == $position )?'selected':'').'>'. $position .'</option>';
			}
		} else {
			foreach( $modules as $module )
			{
				$output .= '<option value="'.$module->id.'" '.(($attr['std'] == $module->id )?'selected':'').'>'. $module->title .'</option>';
			}	
		}

		$output .= '</select>';

		if( ( isset($attr['desc']) ) && ( isset($attr['desc']) != '' ) )
		{
			$output .= '<p class="help-block">' . $attr['desc'] . '</p>';
		}

		$output .= '</div>';

		return $output;
	}

	private static function getTemplate() {

        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select($db->quoteName(array('template')));
        $query->from($db->quoteName('#__template_styles'));
        $query->where($db->quoteName('client_id') . ' = '. $db->quote(0));
        $query->where($db->quoteName('home') . ' = '. $db->quote(1));
        $db->setQuery($query);

        return $db->loadResult();
    }

}