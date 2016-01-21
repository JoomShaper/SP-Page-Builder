<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2016 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('restricted aceess');

AddonParser::addAddon('sp_carousel','sp_carousel_addon');
AddonParser::addAddon('sp_carousel_item','sp_carousel_item_addon');

function sp_carousel_addon($atts, $content){

	extract(spAddonAtts(array(
		'autoplay'=>'',
		'controllers'=>'',
		'arrows'=>'',
		'background'=>'',
		'color'=>'',
		'alignment'=>'',
		"class"=>'',
		), $atts));

	if($background) {
		$background = 'background-color:' . $background . ';';
	}

	if($color) {
		$color = 'color:' . $color . ';';
	}

	$carousel_autoplay = ($autoplay)?'data-sppb-ride="sppb-carousel"':'';

	$output  = '<div style="' . $background . $color . '" class="sppb-carousel sppb-slide ' . $class . '" ' . $carousel_autoplay . '>';

	if($controllers) {
	$output .= '<ol class="sppb-carousel-indicators">';
    $output .= '</ol>';
	}

	$output .= '<div class="sppb-carousel-inner ' . $alignment . '">';
	$output .= AddonParser::spDoAddon($content);
	$output	.= '</div>';

	if($arrows) {
		$output	.= '<a style="' . $color . '" class="sppb-carousel-arrow left sppb-carousel-control" role="button" data-slide="prev"><i class="fa fa-chevron-left"></i></a>';
		$output	.= '<a style="' . $color . '" class="sppb-carousel-arrow right sppb-carousel-control" role="button" data-slide="next"><i class="fa fa-chevron-right"></i></a>';
	}
	
	$output .= '</div>';

	return $output;

}

function sp_carousel_item_addon( $atts ){

	extract(spAddonAtts(array(
		"title"=>'',
		"bg"=>'',
		'content'=>'',
		"button_text"=>'',
		"button_url"=>'',
		"button_size" => '',
		"button_type"=>'',
		"button_icon"=>'',
		), $atts));

	if($button_icon) {
		$button_text = '<i class="fa ' . $button_icon . '"></i> ' . $button_text;
	}

	$has_bg = '';

	if($bg) {
		$has_bg = ' sppb-item-has-bg';
	}
	
	$output   = '<div class="sppb-item'. $has_bg .'">';

	if($bg) {
		$output  .= '<img src="' . $bg . '" alt="' . $title . '">';
	}

	$output  .= '<div class="sppb-carousel-item-inner">';
	$output  .= '<div class="sppb-carousel-caption">';
	$output  .= '<div class="sppb-carousel-pro-text">';

	if(($title) || ($content) ) {
		
		if($title!='') $output  .= '<h2>' . $title . '</h2>';
        $output  .= '<p>' . $content . '</p>';

        if($button_text && $button_url) {
        	$output  .= '<a href="' . $button_url . '" class="sppb-btn sppb-btn-' . $button_type . ' sppb-btn-' . $button_size . '" role="button">' . $button_text . '</a>';
        }
	}

	$output  .= '</div>';
	$output  .= '</div>';

	$output  .= '</div>';
	$output  .= '</div>';

	return $output;

}