<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2015 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('resticted aceess');

AddonParser::addAddon('sp_testimonial','sp_testimonial_addon');

function sp_testimonial_addon($atts, $content){

	extract(spAddonAtts(array(
		"title"					=> '',
		"heading_selector" 		=> 'h3',
		"title_fontsize" 		=> '',
		"title_fontweight" 		=> '',
		"title_text_color" 		=> '',
		"title_margin_top" 		=> '',
		"title_margin_bottom" 	=> '',		
		"review"				=> '',
		"name"					=> '',
		"company"				=> '',
		"avatar"				=> '',
		"avatar_width"			=> '',
		"avatar_position"		=> 'left',
		"link"					=> '',
		"link_target"			=> '',
		"class"					=> '',
		), $atts));

	$output  = '<div class="sppb-addon sppb-addon-testimonial ' . $class . '">';

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
	$output .= '<div class="sppb-media">';

	if ($avatar) {
		$output .= '<a target="' . $link_target . '" class="pull-'.$avatar_position.'" href="'.$link.'">';
		$output .= '<img class="sppb-media-object" src="'.$avatar.'" width="' . $avatar_width . '" alt="'.$name.'">';
		$output .= '</a>';
	}

	$output .= '<div class="sppb-media-body">';
	$output .= '<blockquote>';
	$output .= $review;
	$output .= '<footer><strong>'.$name.'</strong> <cite>'.$company.'</cite></footer>';
	$output .= '</blockquote>';
	$output .= '</div>';
	$output .= '</div>';

	$output .= '</div>';

	$output .= '</div>';

	return $output;
}

