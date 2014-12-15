<?php
//no direct accees
defined('JPATH_BASE') or die;

class SpTypeColor{

	static function getInput($key, $attr)
	{

		if(!isset($attr['std'])){
			$attr['std'] = '';
		}

		// Including fallback code for HTML5 non supported browsers.
		JHtml::_('jquery.framework');
		JHtml::_('script', 'system/html5fallback.js', false, true);

		JHtml::_('behavior.colorpicker');

		$output  = '<div class="form-group">';
		$output .= '<label>'.$attr['title'].'</label>';
		$output .= '<input type="text" class="sppb-color addon-input" data-attrname="'.$key.'" placeholder="#rrggbb" value="'.$attr['std'].'">';

		if( ( isset($attr['desc']) ) && ( isset($attr['desc']) != '' ) )
		{
			$output .= '<p class="help-block">' . $attr['desc'] . '</p>';
		}

		$output .= '</div>';

		return $output;
	}

}