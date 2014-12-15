<?php
//no direct accees
defined('JPATH_BASE') or die;

class SpTypeSeparator{

	static function getInput($key, $attr)
	{

		if (!isset($attr['title'])) {
			$attr['title'] = '';
		}

		$output  = '<div class="sppb-admin-separtor">';
		if($attr['title']) $output .= '<span>'.$attr['title'].'</span>';
		$output .= '</div>';

		return $output;
	}

}