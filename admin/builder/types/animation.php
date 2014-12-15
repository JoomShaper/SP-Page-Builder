<?php
//no direct accees
defined('JPATH_BASE') or die;

class SpTypeAnimation{

	static function getInput($key, $attr)
	{
		if(!isset($attr['std'])){
			$attr['std'] = '';
		}

		$output  = '<div class="form-group">';
		$output .= '<label>'.$attr['title'].'</label>';

		$output .= '<select class="form-control addon-input chosen-select-deselect data-animation-select" data-attrname="'.$key.'">';

		$animations = array(
				"fadeIn",
				"fadeInDown",
				"fadeInDownBig",
				"fadeInLeft",
				"fadeInLeftBig",
				"fadeInRight",
				"fadeInRightBig",
				"fadeInUp",
				"fadeInUpBig",

				"flip",
				"flipInX",
				"flipInY",
				
				"rotateIn",
				"rotateInDownLeft",
				"rotateInDownRight",
				"rotateInUpLeft",
				"rotateInUpRight",

				"zoomIn",
				"zoomInDown",
				"zoomInLeft",
				"zoomInRight",
				"zoomInUp",

				"bounceIn",
				"bounceInDown",
				"bounceInLeft",
				"bounceInRight",
				"bounceInUp"

			);

		$output .= '<option value=""></option>';

		foreach( $animations as $animation )
		{
			$output .= '<option value="'.$animation.'" '.(($attr['std'] == $animation )?'selected':'').'>'. $animation .'</option>';
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