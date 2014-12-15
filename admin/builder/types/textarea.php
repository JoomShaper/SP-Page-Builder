<?php
//no direct accees
defined('JPATH_BASE') or die;

class SpTypeTextarea{

	static function getInput($key, $attr)
	{

		if(!isset($attr['std'])){
			$attr['std'] = '';
		}

		if (!isset($attr['placeholder'])) {
			$attr['placeholder'] = '';
		}

		$output  = '<div class="form-group">';
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