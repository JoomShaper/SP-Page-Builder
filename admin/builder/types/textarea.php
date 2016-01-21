<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2016 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('restricted aceess');

class SpTypeTextarea{

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
		$output	.= '<textarea class="form-control addon-input addon-'.$key.'" data-attrname="'.$key.'" placeholder="'.$attr['placeholder'].'">'.$attr['std'].'</textarea>';

		if( ( isset($attr['desc']) ) && ( isset($attr['desc']) != '' ) )
		{
			$output .= '<p class="help-block">' . $attr['desc'] . '</p>';
		}

		$output .= '</div>';

		return $output;
	}

}