<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2016 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('restricted aceess');

AddonParser::addAddon('sp_accordion','sp_accordion_addon');
AddonParser::addAddon('sp_accordion_item','sp_accordion_item_addon');

$sppbAccordionStyle = '';

function sp_accordion_addon($atts, $content){

	global $sppbAccordionStyle;

	extract(spAddonAtts(array(
		"title"					=>'',
		"heading_selector" 		=> 'h3',
		"title_fontsize" 		=> '',
		"title_fontweight" 		=> '',
		"title_text_color" 		=> '',
		"title_margin_top" 		=> '',
		"title_margin_bottom" 	=> '',		
		"style"					=> 'panel-default',
		"class"					=> ''
		), $atts));

	$sppbAccordionStyle = $style;

	$output  = '<div class="sppb-addon sppb-addon-accordion ' . $class . '">';

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
	$output	.= '<div class="sppb-panel-group ' . $class . '">';
	$output .= AddonParser::spDoAddon($content);
	$output .= '</div>';
	$output .= '</div>';

	$output .= '</div>';

	$sppbAccordionStyle = '';

	return $output;

}

function sp_accordion_item_addon( $atts ){

	global $sppbAccordionStyle;

	extract(spAddonAtts(array(
		"title"=>'',
		"icon"=>'',
		'content'=>''
		), $atts));

	if($icon!='') {
		$title = '<i class="fa ' . $icon . '"></i> ' . $title;
	}
	
	$output   = '<div class="sppb-panel sppb-'. $sppbAccordionStyle .'">';

	$output  .= '<div class="sppb-panel-heading">';
	$output  .= '<span class="sppb-panel-title">';
	$output  .= $title;
	$output  .= '</span>';
	$output  .= '</div>';

	$output  .= '<div class="sppb-panel-collapse">';
	$output  .= '<div class="sppb-panel-body">';
	$output  .= $content;
	$output  .= '</div>';
	$output  .= '</div>';

	$output  .= '</div>';

	return $output;

}