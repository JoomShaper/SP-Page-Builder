<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2016 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('restricted aceess');

$options = $displayData['options'];

$doc = JFactory::getDocument();
$custom_class  = (isset($options->class) && ($options->class))?' '.$options->class:'';
$row_id     = (isset($options->id) && $options->id )? $options->id : 'section-id-'.$options->dynamicId;
$fluid_row = (isset($options->fullscreen) && $options->fullscreen) ? $options->fullscreen : 0;
$row_class = (isset($options->no_gutter) && $options->no_gutter ) ?  ' sppb-no-gutter' : '';
$row_class .= (isset($options->columns_align_center) && $options->columns_align_center ) ?  ' sppb-align-center' : '';
$external_video = (isset($options->background_external_video) && $options->background_external_video ) ?  $options->background_external_video : '';

// Visibility
if(isset($options->hidden_md) && $options->hidden_md) {
	$custom_class .= ' sppb-hidden-md sppb-hidden-lg';
}

if(isset($options->hidden_sm) && $options->hidden_sm) {
	$custom_class .= ' sppb-hidden-sm';
}

if(isset($options->hidden_xs) && $options->hidden_xs) {
	$custom_class .= ' sppb-hidden-xs';
}

$addon_attr = '';

// Animation
if(isset($options->animation) && $options->animation) {

	$custom_class .= ' sppb-wow ' . $options->animation;

	if(isset($options->animationduration) && $options->animationduration) {
		$addon_attr .= ' data-sppb-wow-duration="' . $options->animationduration . 'ms"';
	}

	if(isset($options->animationdelay) && $options->animationdelay) {
		$addon_attr .= ' data-sppb-wow-delay="' . $options->animationdelay . 'ms"';
	}
}

if (!empty($external_video)) {
	$custom_class .= ' sppb-row-have-ext-bg';
}


// Video
$video_params = '';
if (isset($options->background_video) && $options->background_video) {
	if (isset($options->background_image) && $options->background_image){
		$video_params .= ' data-vide-image="' . JURI::base(true) . '/' . $options->background_image . '"';
	}
	if (isset($options->background_video_mp4) && $options->background_video_mp4) {
		$mp4_parsed = parse_url($options->background_video_mp4);
		$mp4_url = (isset($mp4_parsed['host']) && $mp4_parsed['host']) ? $options->background_video_mp4 : JURI::base(true) . '/' . $options->background_video_mp4;

		$video_params .= ' data-vide-mp4="' . $mp4_url . '"';}
	if (isset($options->background_video_ogv) && $options->background_video_ogv) {
		$ogv_parsed = parse_url($options->background_video_ogv);
		$ogv_url = (isset($ogv_parsed['host']) && $ogv_parsed['host']) ? $options->background_video_ogv : JURI::base(true) . '/' . $options->background_video_ogv;

		$video_params .= ' data-vide-ogv="' . $ogv_url . '"';
	}
	$video_params .= ' data-vide-bg';
}



$html = '';

if(!$fluid_row){
	$html .= '<section id="' . $row_id . '" class="sppb-section ' . $custom_class . '" '.$addon_attr.' ' . $video_params . '>';
	if (isset($options->overlay) && $options->overlay) {
		$html .= '<div class="sppb-row-overlay"></div>';
	}
	$html .= '<div class="sppb-row-container">';
} else {
	$html .= '<div id="' . $row_id . '" class="sppb-section ' . $custom_class . '" '.$addon_attr.' ' . $video_params . '>';
	if (isset($options->overlay) && $options->overlay) {
		$html .= '<div class="sppb-row-overlay"></div>';
	}
	$html .= '<div class="sppb-container-inner">';
}

// Row Title
if ( (isset($options->title) && $options->title) || (isset($options->subtitle) && $options->subtitle) ) {
	$title_position = '';
	if (isset($options->title_position) && $options->title_position) {
		$title_position = $options->title_position;
	}

	if($fluid_row) {
		$html .= '<div class="sppb-container">';
	}
	$html .= '<div class="sppb-section-title ' . $title_position . '">';

	if(isset($options->title) && $options->title) {
		$heading_selector   = 'h2';
		if( isset($options->heading_selector) && $options->heading_selector ) {
			$heading_selector = $options->heading_selector;
		}
		$html .= '<'. $heading_selector .' class="sppb-title-heading">' . $options->title . '</'. $heading_selector .'>';
	}

	if( $options->subtitle ) {
		$html .= '<p class="sppb-title-subheading">' . $options->subtitle . '</p>';
	}
	$html .= '</div>';

	if( $fluid_row ) {
		$html .= '</div>';
	}
}

if (!empty($external_video) && $options->external_background_video && $options->background_video) {
	$video = parse_url($external_video);
	$src = '';
	switch($video['host']) {
		case 'youtu.be':
		$id = trim($video['path'],'/');
		$src = '//www.youtube.com/embed/' . $id .'?playlist='.$id.'&iv_load_policy=3&enablejsapi=1&disablekb=1&autoplay=1&controls=0&showinfo=0&rel=0&loop=1&wmode=transparent&widgetid=1&mute=';
		break;

		case 'www.youtube.com':
		case 'youtube.com':
		parse_str($video['query'], $query);
		$id = $query['v'];
		$src = '//www.youtube.com/embed/' . $id .'?playlist='.$id.'&iv_load_policy=3&enablejsapi=1&disablekb=1&autoplay=1&controls=0&showinfo=0&rel=0&loop=1&wmode=transparent&widgetid=1&mute=';
		break;
		case 'vimeo.com':
		case 'www.vimeo.com':
		$id = trim($video['path'],'/');
		$src = "//player.vimeo.com/video/{$id}?autoplay=1&loop=1&title=0&byline=0&portrait=0";
	}
	$html .= '<div class="sppb-youtube-video-bg hidden"><iframe src="'.$src.'" frameborder="0" allowfullscreen></iframe></div>';
}

$html .= '<div class="sppb-row'. $row_class .'">';

echo $html;
