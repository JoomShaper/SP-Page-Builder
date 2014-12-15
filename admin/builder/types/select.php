<?php
//no direct accees
defined('JPATH_BASE') or die;

class SpTypeSelect{

	static function getInput($key, $attr)
	{
		if(!isset($attr['std'])){
			$attr['std'] = '';
		}

		$output  = '<div class="form-group">';
		$output .= '<label>'.$attr['title'].'</label>';

		$output .= '<select class="form-control addon-input" data-attrname="'.$key.'">';

		foreach( $attr['values'] as $key=>$value )
		{
			$output .= '<option value="'.$key.'" '.(($attr['std'] == $key )?'selected':'').'>'.$value.'</option>';
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