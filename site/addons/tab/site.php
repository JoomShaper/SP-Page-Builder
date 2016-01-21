<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2016 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('restricted aceess');

AddonParser::addAddon('sp_tab','sp_tab_addon');
AddonParser::addAddon('sp_tab_item','sp_tab_item_addon');

$sppbTabArray = array();
function sp_tab_addon($atts, $content){
	global $sppbTabArray;

	extract(spAddonAtts(array(
		"title"					=> '',
		"heading_selector" 		=> 'h3',
		"title_fontsize" 		=> '',
		"title_fontweight" 		=> '',
		"title_text_color" 		=> '',
		"title_margin_top" 		=> '',
		"title_margin_bottom" 	=> '',		
		"style"					=> '',
		"class"					=> ''
		), $atts));

	AddonParser::spDoAddon($content);

	$output  = '<div class="sppb-addon sppb-addon-tab ' . $class . '">';
	if($title) {

		$title_style = '';
		if($title_margin_top !='') $title_style .= 'margin-top:' . (int) $title_margin_top . 'px;';
		if($title_margin_bottom !='') $title_style .= 'margin-bottom:' . (int) $title_margin_bottom . 'px;';
		if($title_text_color) $title_style .= 'color:' . $title_text_color  . ';';
		if($title_fontsize) $title_style .= 'font-size:'.$title_fontsize.'px;line-height:'.$title_fontsize.'px;';
		if($title_fontweight) $title_style .= 'font-weight:'.$title_fontweight.';';

		$output .= '<'.$heading_selector.' class="sppb-addon-title" style="' . $title_style . '">' . $title . '</'.$heading_selector.'>';
	}
	$output .= '<div class="sppb-addon-content sppb-tab">';
	//Tab Title
	$output .='<ul class="sppb-nav sppb-nav-' . $style . '">';
	foreach ($sppbTabArray as $key=>$tab) {
		$output .='<li class="'. ( ($key==0) ? "active" : "").'"><a role="tab" data-toggle="sppb-tab">'. $tab['icon'].' '. $tab['title'] .'</a></li>';
	}
	$output .='</ul>';
	//Tab Contnet
	$output .='<div class="sppb-tab-content">';
	foreach ($sppbTabArray as $key=>$tab) {
		$output .='<div class="sppb-tab-pane sppb-fade'. ( ($key==0) ? " active in" : "").'">' . $tab['content'] .'</div>';
	}
	$output .='</div>';
	$output .= '</div>';
	$output .= '</div>';

	$sppbTabArray = array();

	return $output;

}

function sp_tab_item_addon( $atts ){
	global $sppbTabArray;

	extract(spAddonAtts(array(
		"title"=>'',
		"icon"=>'',
		'content'=>''
		), $atts));

		if($icon!='') {
			$icon = '<i class="fa ' . $icon . '"></i> ';
		}

	$sppbTabArray[] = array('title'=>$title, 'icon'=>$icon, 'content'=>$content);

}