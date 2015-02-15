<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2015 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('resticted aceess');

AddonParser::addAddon('sp_image','sp_image_addon');

function sp_image_addon($atts) {
	extract(spAddonAtts(array(
		'title' 				=> '',
		"heading_selector" 		=> 'h3',
		"title_fontsize" 		=> '',
		"title_fontweight" 		=> '',
		"title_text_color" 		=> '',
		"title_margin_top" 		=> '',
		"title_margin_bottom" 	=> '',		
		'image' 				=> '',
		'position' 				=> '',
		'link' 					=> '',
		'target' 				=> '',
		'class' 				=> '',
		), $atts));

	$output = '';

	if($image) {
		$output  .= '<div class="sppb-addon sppb-addon-single-image ' . $position . ' ' . $class . '">';

		if($title) {

			$title_style = '';
			if($title_margin_top !='') $title_style .= 'margin-top:' . (int) $title_margin_top . 'px;';
			if($title_margin_bottom !='') $title_style .= 'margin-bottom:' . (int) $title_margin_bottom . 'px;';
			if($title_text_color) $title_style .= 'color:' . $title_text_color  . ';';
			if($title_fontsize) $title_style .= 'font-size:'.$title_fontsize.'px;line-height:'.$title_fontsize.'px;';
			if($title_fontweight) $title_style .= 'font-weight:'.$title_fontweight.';';

			$output .= '<'.$heading_selector.' class="sppb-addon-title" style="' . $title_style . '">' . $title . '</'.$heading_selector.'>';
		}

		$output .= '<div class="sppb-addon-content">';

		if($link!='http://') {
			$output 	.= '<a target="' . $target . '" href="' . $link . '">';
		}

		$output  .= '<img class="sppb-img-responsive" src="' . $image . '" alt="">';

		if($link!='http://') {
			$output 	.= '</a>';
		}

		$output  .= '</div>';
		$output  .= '</div>';

		return $output;

	}

	return;

}