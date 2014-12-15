<?php
//no direct accees
defined('JPATH_BASE') or die;

class SpTypeEditor
{

	static function getInput($key, $attr)
	{

		if(!isset($attr['std'])){
			$attr['std'] = '';
		}

		$output  = '<div class="form-group">';
		$output .= '<label>'.$attr['title'].'</label>';
		$output .= '<textarea class="form-control sppb-editor addon-input" data-attrname="'.$key.'">'.$attr['std'].'</textarea>';

		if( ( isset($attr['desc']) ) && ( isset($attr['desc']) != '' ) )
		{
			$output .= '<p class="help-block">' . $attr['desc'] . '</p>';
		}

		$output .= '</div>';

		return $output;
	}

} 