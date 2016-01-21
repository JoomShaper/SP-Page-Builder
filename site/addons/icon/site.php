<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2016 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('restricted aceess');

AddonParser::addAddon('sp_icon','sp_icon_addon');

function sp_icon_addon($atts) {
	extract(spAddonAtts(array(
		'name' => '',
		'alignment' => '',
		'color' => '',
		'size' => '',
		'border_color' => '',
		'border_width' => '',
		'border_radius' => '',
		'style' => '',
		'background' => '',
		'margin_top' => '',
		'margin_bottom' => '',
		'padding' => '',
		'class' => '',
		), $atts));

	$style = 'text-align:center;';
	$font_size = '';

	if($name) {

		if($margin_top) $style .= 'margin-top:' . (int) $margin_top . 'px;';
		if($margin_bottom) $style .= 'margin-bottom:' . (int) $margin_bottom . 'px;';
		if($padding) $style .= 'padding:' . (int) $padding  . 'px;';
		if($color) $style .= 'color:' . $color  . ';';
		if($background) $style .= 'background-color:' . $background  . ';';
		if($border_color) $style .= 'border-style:solid;border-color:' . $border_color  . ';';
		if($border_width) $style .= 'border-width:' . (int) $border_width  . 'px;';
		if($border_radius) $style .= 'border-radius:' . (int) $border_radius  . 'px;';

		if($size) $font_size .= 'font-size:' . (int) $size . 'px;width:' . (int) $size . 'px;height:' . (int) $size . 'px;line-height:' . (int) $size . 'px;';

		$output   = '<div class="sppb-icon ' . $alignment . ' ' . $class . '">';
		$output  .= '<span style="display:inline-block;' . $style . ';">';
		$output  .= '<i class="fa ' . $name . '" style="' . $font_size . ';"></i>';
		$output  .= '</span>';
		$output  .= '</div>';

		return $output;
	}

	return;

}