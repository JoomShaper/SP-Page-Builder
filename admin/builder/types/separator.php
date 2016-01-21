<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2016 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('restricted aceess');

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