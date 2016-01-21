<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2016 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('restricted aceess');

class SpTypeNumber{

	static function getInput($key, $attr)
	{

		if(!isset($attr['std'])){
			$attr['std'] = '';
		}

		if (!isset($attr['placeholder'])) {
			$attr['placeholder'] = '';
		}

		// Depend
		$depend_data = '';
		if(isset($attr['depends'])) {
			$depends = $attr['depends'];
			foreach ($depends as $selector => $value) {
				$depend_data .= ' data-group_parent="' . $selector . '" data-depend="' . $value . '"';
			}
		}

		$output  = '<div class="form-group"' . $depend_data . '>';
		$output .= '<label>'.$attr['title'].'</label>';
		$output	.= '<input id="field_'.$key.'" class="form-control addon-input" type="number" data-attrname="'.$key.'" value="'.$attr['std'].'" placeholder="'.$attr['placeholder'].'" />';
		
		if( ( isset($attr['desc']) ) && ( isset($attr['desc']) != '' ) )
		{
			$output .= '<p class="help-block">' . $attr['desc'] . '</p>';
		}
		
		$output .= '</div>';

		return $output;
	}

}