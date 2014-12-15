<?php

defined ('_JEXEC') or die('resticted aceess');

AddonParser::addAddon('sp_text_block','sp_text_block_addon');

function sp_text_block_addon($atts){

	extract(spAddonAtts(array(
		"title"					=>'',
		"heading_selector" 		=> 'h3',
		"title_fontsize" 		=> '',
		"title_text_color" 		=> '',
		"title_margin_top" 		=> '',
		"title_margin_bottom" 	=> '',
		"text"					=>'',
		"alignment"				=>'',
		'class'					=>'',
		), $atts));

	
	$output  = '<div class="sppb-addon sppb-addon-text-block ' . $alignment . ' ' . $class . '">';
	
	if($title) {

		$title_style = '';
		if($title_margin_top) $title_style .= 'margin-top:' . (int) $title_margin_top . 'px;';
		if($title_margin_bottom) $title_style .= 'margin-bottom:' . (int) $title_margin_bottom . 'px;';
		if($title_text_color) $title_style .= 'color:' . $title_text_color  . ';';
		if($title_fontsize) $title_style .= 'font-size:'.$title_fontsize.'px;line-height:'.$title_fontsize.'px;';

		$output .= '<'.$heading_selector.' class="sppb-addon-title" style="' . $title_style . '">' . $title . '</'.$heading_selector.'>';
	}
	
	$output .= '<div class="sppb-addon-content">';
	$output .= $text;
	$output .= '</div>';
	
	$output .= '</div>';

	return $output;
}