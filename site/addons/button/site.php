<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2015 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('resticted aceess');

AddonParser::addAddon('sp_button','sp_button_addon');

function sp_button_addon($atts, $content){

	extract(spAddonAtts(array(
		"text" => '',
		"url" => '',
		"size" => '',
		"type"=>'',
		"icon"=>'',
		"target"=>'',
		"margin"=>'',
		"block"=>'',
		"class"=>''
		), $atts));

	if($icon !='') {
		$text = '<i class="fa ' . $icon . '"></i> ' . $text;
	}

	$style = '';

	if($margin) $style = ' style="margin:'.$margin.';"';

	$output  = '<a target="' . $target . '" href="' . $url . '" class="sppb-btn sppb-btn-' . $type . ' sppb-btn-' . $size . ' ' . $block . ' ' . $class . '" ' . $style . ' role="button">' . $text . '</a>';

	return $output;
	
}