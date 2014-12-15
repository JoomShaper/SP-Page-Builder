<?php

defined ('_JEXEC') or die('resticted aceess');

AddonParser::addAddon('sp_feature','sp_feature_addon');

function sp_feature_addon($atts){

	extract(spAddonAtts(array(
		"title"					=>'',
		"heading_selector" 		=> 'h3',
		"title_fontsize" 		=> '',
		"title_text_color" 		=> '',			
		"title_position"		=>'',
		"feature_type"			=>'icon',
		"feature_image"			=>'icon',
		'icon_name' 			=> '',
		'icon_color' 			=> '',
		'icon_size' 			=> '',
		'icon_border_color' 	=> '',
		'icon_border_width' 	=> '',
		'icon_border_radius' 	=> '',
		'icon_style' 			=> '',
		'icon_background' 		=> '',
		'icon_margin_top' 		=> '',
		'icon_margin_bottom' 	=> '',
		'icon_padding' 			=> '',
		'text'					=>'',
		'alignment' 			=> '',
		'class'					=>'',
		), $atts));

	$output  = '<div class="sppb-addon sppb-addon-feature ' . $alignment . ' ' . $class . '">';

	$output .= '<div class="sppb-addon-content">';

	if ($title_position == 'before') {
		
		if($title) {

			$title_style = '';
			if($title_text_color) $title_style .= 'color:' . $title_text_color  . ';';
			if($title_fontsize) $title_style .= 'font-size:'.$title_fontsize.'px;line-height:'.$title_fontsize.'px;';

			$output .= '<'.$heading_selector.' class="sppb-feature-box-title" style="' . $title_style . '">' . $title . '</'.$heading_selector.'>';
		}

	}


	if($feature_type == 'icon') {
		//Icon
		if($icon_name) {
			$style = 'text-align:center;';
			$font_size = '';

			if($icon_margin_top) $style .= 'margin-top:' . (int) $icon_margin_top . 'px;';
			if($icon_margin_bottom) $style .= 'margin-bottom:' . (int) $icon_margin_bottom . 'px;';
			if($icon_padding) $style .= 'padding:' . (int) $icon_padding  . 'px;';
			if($icon_color) $style .= 'color:' . $icon_color  . ';';
			if($icon_background) $style .= 'background-color:' . $icon_background  . ';';
			if($icon_border_color) $style .= 'border-style:solid;border-color:' . $icon_border_color  . ';';
			if($icon_border_width) $style .= 'border-width:' . (int) $icon_border_width  . 'px;';
			if($icon_border_radius) $style .= 'border-radius:' . (int) $icon_border_radius  . 'px;';

			if($icon_size) $font_size .= 'font-size:' . (int) $icon_size . 'px;width:' . (int) $icon_size . 'px;height:' . (int) $icon_size . 'px;line-height:' . (int) $icon_size . 'px;';

			$output  .= '<div class="sppb-icon">';
			$output  .= '<span style="display:inline-block;' . $style . ';">';
			$output  .= '<i class="fa ' . $icon_name . '" style="' . $font_size . ';"></i>';
			$output  .= '</span>';
			$output  .= '</div>';
		}
		//End Icon
	} 

	 else {

		if($feature_image) { 

			$img_style ='';

			if($icon_margin_top) $img_style .= 'margin-top:' . (int) $icon_margin_top . 'px;';
			if($icon_margin_bottom) $img_style .= 'margin-bottom:' . (int) $icon_margin_bottom . 'px;';
			$output  .= '<span style="display:inline-block;' . $img_style . ';">';
			$output  .= '<img class="sppb-img-responsive" src="' . $feature_image . '" alt="">';
			$output  .= '</span>';
		}
	}



	if ($title_position == 'after') {
		
		if($title) {

			$title_style = '';
			if($title_text_color) $title_style .= 'color:' . $title_text_color  . ';';
			if($title_fontsize) $title_style .= 'font-size:'.$title_fontsize.'px;line-height:'.$title_fontsize.'px;';

			$output .= '<'.$heading_selector.' class="sppb-feature-box-title" style="' . $title_style . '">' . $title . '</'.$heading_selector.'>';
		}
	}

	$output .= '<div class="sppb-addon-text">';
	$output .= $text;
	$output .= '</div>';

	$output .= '</div>';

	$output .= '</div>';

	return $output;
}