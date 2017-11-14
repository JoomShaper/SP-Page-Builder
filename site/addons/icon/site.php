<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2016 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/

//no direct accees
defined ('_JEXEC') or die ('restricted aceess');

class SppagebuilderAddonIcon extends SppagebuilderAddons {

	public function render() {

		$class = (isset($this->addon->settings->class) && $this->addon->settings->class) ? $this->addon->settings->class : '';
		$class .= (isset($this->addon->settings->alignment) && $this->addon->settings->alignment) ? ' ' . $this->addon->settings->alignment : '';
		$class .= (isset($this->addon->settings->hover_effect) && $this->addon->settings->hover_effect) ? ' sppb-icon-hover-effect-' . $this->addon->settings->hover_effect : '';
		$name = (isset($this->addon->settings->name) && $this->addon->settings->name) ? $this->addon->settings->name : '';
		$link = (isset($this->addon->settings->link) && $this->addon->settings->link) ? $this->addon->settings->link : '';

		if($name) {
			$output   = '<div class="sppb-icon' . $class . '">';
			if (!empty($link)) {
				$output .= '<a href="'.$link.'">';
			}
			$output  .= '<span class="sppb-icon-inner">';
			$output  .= '<i class="fa ' . $name . '"></i>';
			$output  .= '</span>';
			if (!empty($link)) {
				$output .= '</a>';
			}
			$output  .= '</div>';
			return $output;
		}
	}

	public function css() {
		$addon_id = '#sppb-addon-' . $this->addon->id;

		// Normal
		$icon_style  = '';
		$icon_style_sm  = '';
		$icon_style_xs  = '';

		$font_size = '';
		$font_size_sm = '';
		$font_size_xs = '';

		if(isset($this->addon->settings->margin) && trim($this->addon->settings->margin) != ""){
			$margin_md = '';
			$margins = explode(' ', $this->addon->settings->margin);
			foreach($margins as $margin){
				if(empty(trim($margin))){
					$margin_md .= ' 0';
				} else {
					$margin_md .= ' '.$margin;
				}

			}
			$icon_style .= "margin: " . $margin_md . ";\n";
		}

		if(isset($this->addon->settings->margin_sm) && trim($this->addon->settings->margin_sm) != ""){
			$margin_sm_full = '';
			$margins_sm = explode(' ', $this->addon->settings->margin_sm);
			foreach($margins_sm as $margin_sm){
				if(empty(trim($margin_sm))){
					$margin_sm_full .= ' 0';
				} else {
					$margin_sm_full .= ' '.$margin_sm;
				}

			}
			$icon_style_sm .= "margin: " . $margin_sm_full . ";\n";
		}

		if(isset($this->addon->settings->margin_xs) && trim($this->addon->settings->margin_xs) != ""){
			$margin_xs_full = '';
			$margins_xs = explode(' ', $this->addon->settings->margin_xs);
			foreach($margins_xs as $margin_xs){
				if(empty(trim($margin_xs))){
					$margin_xs_full .= ' 0';
				} else {
					$margin_xs_full .= ' '.$margin_xs;
				}

			}
			$icon_style_xs .= "margin: " . $margin_xs_full . ";\n";
		}

		$icon_style .= (isset($this->addon->settings->height) && $this->addon->settings->height) ? 'height: ' . (int) $this->addon->settings->height . 'px;' : '';
		$icon_style_sm .= (isset($this->addon->settings->height_sm) && $this->addon->settings->height_sm) ? 'height: ' . (int) $this->addon->settings->height_sm . 'px;' : '';
		$icon_style_xs .= (isset($this->addon->settings->height_xs) && $this->addon->settings->height_xs) ? 'height: ' . (int) $this->addon->settings->height_xs . 'px;' : '';

		$font_size .= (isset($this->addon->settings->height) && $this->addon->settings->height) ? 'line-height: ' . (int) $this->addon->settings->height . 'px;' : '';
		$font_size_sm .= (isset($this->addon->settings->height_sm) && $this->addon->settings->height_sm) ? 'line-height: ' . (int) $this->addon->settings->height_sm . 'px;' : '';
		$font_size_xs .= (isset($this->addon->settings->height_xs) && $this->addon->settings->height_xs) ? 'line-height: ' . (int) $this->addon->settings->height_xs . 'px;' : '';

		$icon_style .= (isset($this->addon->settings->width) && $this->addon->settings->width) ? 'width: ' . (int) $this->addon->settings->width . 'px;' : '';
		$icon_style_sm .= (isset($this->addon->settings->width_sm) && $this->addon->settings->width_sm) ? 'width: ' . (int) $this->addon->settings->width_sm . 'px;' : '';
		$icon_style_xs .= (isset($this->addon->settings->width_xs) && $this->addon->settings->width_xs) ? 'width: ' . (int) $this->addon->settings->width_xs . 'px;' : '';

		$icon_style .= (isset($this->addon->settings->color) && $this->addon->settings->color) ? 'color: ' . $this->addon->settings->color . ';' : '';
		$icon_style .= (isset($this->addon->settings->background) && $this->addon->settings->background) ? 'background-color: ' . $this->addon->settings->background . ';' : '';
		$icon_style .= (isset($this->addon->settings->border_color) && $this->addon->settings->border_color) ? 'border-style: solid; border-color: ' . $this->addon->settings->border_color . ';' : '';

		$icon_style .= (isset($this->addon->settings->border_width) && $this->addon->settings->border_width) ? 'border-width: ' . (int) $this->addon->settings->border_width . 'px;' : '';
		$icon_style_sm .= (isset($this->addon->settings->border_width_sm) && $this->addon->settings->border_width_sm) ? 'border-width: ' . (int) $this->addon->settings->border_width_sm . 'px;' : '';
		$icon_style_xs .= (isset($this->addon->settings->border_width_xs) && $this->addon->settings->border_width_xs) ? 'border-width: ' . (int) $this->addon->settings->border_width_xs . 'px;' : '';

		$icon_style .= (isset($this->addon->settings->border_radius) && $this->addon->settings->border_radius) ? 'border-radius: ' . (int) $this->addon->settings->border_radius . 'px;' : '';
		$icon_style_sm .= (isset($this->addon->settings->border_radius_sm) && $this->addon->settings->border_radius_sm) ? 'border-radius: ' . (int) $this->addon->settings->border_radius_sm . 'px;' : '';
		$icon_style_xs .= (isset($this->addon->settings->border_radius_xs) && $this->addon->settings->border_radius_xs) ? 'border-radius: ' . (int) $this->addon->settings->border_radius_xs . 'px;' : '';

		$font_size .= (isset($this->addon->settings->size) && $this->addon->settings->size) ? 'font-size: ' . (int) $this->addon->settings->size . 'px;' : '';
		$font_size_sm .= (isset($this->addon->settings->size_sm) && $this->addon->settings->size_sm) ? 'font-size: ' . (int) $this->addon->settings->size_sm . 'px;' : '';
		$font_size_xs .= (isset($this->addon->settings->size_xs) && $this->addon->settings->size_xs) ? 'font-size: ' . (int) $this->addon->settings->size_xs . 'px;' : '';

		$font_size .= (isset($this->addon->settings->border_width) && $this->addon->settings->border_width) ? 'margin-top: -' . (int) $this->addon->settings->border_width . 'px;' : '';
		$font_size_sm .= (isset($this->addon->settings->border_width_sm) && $this->addon->settings->border_width_sm) ? 'margin-top: -' . (int) $this->addon->settings->border_width_sm . 'px;' : '';
		$font_size_xs .= (isset($this->addon->settings->border_width_xs) && $this->addon->settings->border_width_xs) ? 'margin-top: -' . (int) $this->addon->settings->border_width_xs . 'px;' : '';

		// Mouse Hover
		$icon_style_hover  = '';
		$icon_style_hover_sm  = '';
		$icon_style_hover_xs  = '';

		$icon_style_hover  .= (isset($this->addon->settings->hover_color) && $this->addon->settings->hover_color) ? 'color: ' . $this->addon->settings->hover_color . ';' : '';
		$icon_style_hover .= (isset($this->addon->settings->hover_background) && $this->addon->settings->hover_background) ? 'background-color: ' . $this->addon->settings->hover_background . ';' : '';
		$icon_style_hover .= (isset($this->addon->settings->hover_border_color) && $this->addon->settings->hover_border_color) ? 'border-color: ' . $this->addon->settings->hover_border_color . ';' : '';

		$icon_style_hover .= (isset($this->addon->settings->hover_border_width) && $this->addon->settings->hover_border_width) ? 'border-width: ' . (int) $this->addon->settings->hover_border_width . 'px;' : '';
		$icon_style_hover_sm .= (isset($this->addon->settings->hover_border_width_sm) && $this->addon->settings->hover_border_width_sm) ? 'border-width: ' . (int) $this->addon->settings->hover_border_width_sm . 'px;' : '';
		$icon_style_hover_xs .= (isset($this->addon->settings->hover_border_width_xs) && $this->addon->settings->hover_border_width_xs) ? 'border-width: ' . (int) $this->addon->settings->hover_border_width_xs . 'px;' : '';

		$icon_style_hover .= (isset($this->addon->settings->hover_border_radius) && $this->addon->settings->hover_border_radius) ? 'border-radius: ' . (int) $this->addon->settings->hover_border_radius . 'px;' : '';
		$icon_style_hover_sm .= (isset($this->addon->settings->hover_border_radius_sm) && $this->addon->settings->hover_border_radius_sm) ? 'border-radius: ' . (int) $this->addon->settings->hover_border_radius_sm . 'px;' : '';
		$icon_style_hover_xs .= (isset($this->addon->settings->hover_border_radius_xs) && $this->addon->settings->hover_border_radius_xs) ? 'border-radius: ' . (int) $this->addon->settings->hover_border_radius_xs . 'px;' : '';

		$css = '';
		if($icon_style) {
			$css .= $addon_id . ' .sppb-icon-inner {';
			$css .= $icon_style;
			$css .= "\n" . '}' . "\n"	;
		}

		if($font_size) {
			$css .= $addon_id . ' .sppb-icon-inner i {';
			$css .= $font_size;
			$css .= "\n" . '}' . "\n"	;
		}

		// Hover
		if($icon_style_hover) {
			$css .= $addon_id . ' .sppb-icon-inner:hover {';
			$css .= $icon_style_hover;
			$css .= "\n" . '}' . "\n"	;
		}

		if(!empty($icon_style_hover_sm) || !empty($icon_style_sm) || !empty($font_size_sm)) {
			$css .= '@media (min-width: 768px) and (max-width: 991px) {';
				if($icon_style_sm) {
					$css .= $addon_id . ' .sppb-icon-inner {';
					$css .= $icon_style_sm;
					$css .= "\n" . '}' . "\n"	;
				}

				if($font_size_sm) {
					$css .= $addon_id . ' .sppb-icon-inner i {';
					$css .= $font_size_sm;
					$css .= "\n" . '}' . "\n"	;
				}

				// Hover
				if($icon_style_hover_sm) {
					$css .= $addon_id . ' .sppb-icon-inner:hover {';
					$css .= $icon_style_hover_sm;
					$css .= "\n" . '}' . "\n"	;
				}
			$css .= '}';
		}

		if(!empty($icon_style_hover_xs) || !empty($icon_style_xs) || !empty($font_size_xs)) {
			$css .= '@media (max-width: 767px) {';
				if($icon_style_xs) {
					$css .= $addon_id . ' .sppb-icon-inner {';
					$css .= $icon_style_xs;
					$css .= "\n" . '}' . "\n"	;
				}

				if($font_size_xs) {
					$css .= $addon_id . ' .sppb-icon-inner i {';
					$css .= $font_size_xs;
					$css .= "\n" . '}' . "\n"	;
				}

				// Hover
				if($icon_style_hover_xs) {
					$css .= $addon_id . ' .sppb-icon-inner:hover {';
					$css .= $icon_style_hover_xs;
					$css .= "\n" . '}' . "\n"	;
				}
			$css .= '}';
		}

		return $css;
	}

	public static function getTemplate() {
		$output = '
		<#
			var margin = "";
			var margin_sm = "";
			var margin_xs = "";
			if(data.margin){
				if(_.isObject(data.margin)){
					if(data.margin.md.trim() != ""){
						margin = data.margin.md.split(" ").map(item => {
							if(_.isEmpty(item)){
								return "0";
							}
							return item;
						}).join(" ")
					}
					if(data.margin.sm.trim() != ""){
						margin_sm = data.margin.sm.split(" ").map(item => {
							if(_.isEmpty(item)){
								return "0";
							}
							return item;
						}).join(" ")
					}
					if(data.margin.xs.trim() != ""){
						margin_xs = data.margin.xs.split(" ").map(item => {
							if(_.isEmpty(item)){
								return "0";
							}
							return item;
						}).join(" ")
					}
				} else {
					if(data.margin.trim() != ""){
						margin = data.margin.split(" ").map(item => {
							if(_.isEmpty(item)){
								return "0";
							}
							return item;
						}).join(" ")
					}
				}

			}
		#>
		<style type="text/css">
		#sppb-addon-{{ data.id }} .sppb-icon-inner {
			margin: {{ margin }};
			<# if(_.isObject(data.height)){ #>
				height: {{ data.height.md }}px;
			<# } else { #>
				height: {{ data.height }}px;
			<# } #>
			<# if(_.isObject(data.width)){ #>
				width: {{ data.width.md }}px;
			<# } else { #>
				width: {{ data.width }}px;
			<# } #>
			color: {{ data.color }};
			background-color: {{ data.background }};
			<# if(data.border_width){ #>
				border-style: solid;
				border-color: {{ data.border_color }};
				<# if(_.isObject(data.border_width)){ #>
					border-width: {{ data.border_width.md }}px;
				<# } else { #>
					border-width: {{ data.border_width }}px;
				<# } #>
			<# } #>
			<# if(_.isObject(data.border_radius)){ #>
				border-radius: {{ data.border_radius.md }}px;
			<# } else { #>
				border-radius: {{ data.border_radius }}px;
			<# } #>
		}
		#sppb-addon-{{ data.id }} .sppb-icon-inner i{
			<# if(_.isObject(data.size)){ #>
				font-size: {{ data.size.md }}px;
			<# } else { #>
				font-size: {{ data.size }}px;
			<# } #>

			<# if(_.isObject(data.height)){ #>
				line-height: {{ data.height.md }}px;
			<# } else { #>
				line-height: {{ data.height }}px;
			<# } #>

			<# if(data.border_width){ #>
				<# if(_.isObject(data.border_width)){ #>
					margin-top: -{{ data.border_width.md }}px;
				<# } else { #>
					margin-top: -{{ data.border_width }}px;
				<# } #>
			<# } #>
		}
		#sppb-addon-{{ data.id }} .sppb-icon-inner:hover {
			color: {{ data.hover_color }};
			background-color: {{ data.hover_background }};
			border-color: {{ data.hover_border_color }};

			<# if(_.isObject(data.hover_border_width)){ #>
				border-width: {{ data.hover_border_width.md }}px;
			<# } else { #>
				border-width: {{ data.hover_border_width }}px;
			<# } #>

			<# if(_.isObject(data.hover_border_radius)){ #>
				border-radius: {{ data.hover_border_radius.md }}px;
			<# } else { #>
				border-radius: {{ data.hover_border_radius }}px;
			<# } #>
		}
		@media (min-width: 768px) and (max-width: 991px) {
			#sppb-addon-{{ data.id }} .sppb-icon-inner {
				margin: {{ margin_sm }};
				<# if(_.isObject(data.height)){ #>
					height: {{ data.height.sm }}px;
				<# } #>
				<# if(_.isObject(data.width)){ #>
					width: {{ data.width.sm }}px;
				<# } #>
				<# if(data.border_width){ #>
					<# if(_.isObject(data.border_width)){ #>
						border-width: {{ data.border_width.sm }}px;
					<# } #>
				<# } #>
				<# if(_.isObject(data.border_radius)){ #>
					border-radius: {{ data.border_radius.sm }}px;
				<# } #>
			}
			#sppb-addon-{{ data.id }} .sppb-icon-inner i{
				<# if(_.isObject(data.size)){ #>
					font-size: {{ data.size.sm }}px;
				<# } #>

				<# if(_.isObject(data.height)){ #>
					line-height: {{ data.height.sm }}px;
				<# } #>
				<# if(data.border_width){ #>
					<# if(_.isObject(data.border_width)){ #>
						margin-top: -{{ data.border_width.sm }}px;
					<# } #>
				<# } #>
			}
			#sppb-addon-{{ data.id }} .sppb-icon-inner:hover {
				<# if(_.isObject(data.hover_border_width)){ #>
					border-width: {{ data.hover_border_width.sm }}px;
				<# } #>

				<# if(_.isObject(data.hover_border_radius)){ #>
					border-radius: {{ data.hover_border_radius.sm }}px;
				<# } #>
			}
		}
		@media (max-width: 767px) {
			#sppb-addon-{{ data.id }} .sppb-icon-inner {
				margin: {{ margin_xs }};
				<# if(_.isObject(data.height)){ #>
					height: {{ data.height.xs }}px;
				<# } #>
				<# if(_.isObject(data.width)){ #>
					width: {{ data.width.xs }}px;
				<# } #>
				<# if(data.border_width){ #>
					<# if(_.isObject(data.border_width)){ #>
						border-width: {{ data.border_width.xs }}px;
					<# } #>
				<# } #>
				<# if(_.isObject(data.border_radius)){ #>
					border-radius: {{ data.border_radius.xs }}px;
				<# } #>
			}
			#sppb-addon-{{ data.id }} .sppb-icon-inner i{
				<# if(_.isObject(data.size)){ #>
					font-size: {{ data.size.xs }}px;
				<# } #>

				<# if(_.isObject(data.height)){ #>
					line-height: {{ data.height.xs }}px;
				<# } #>

				<# if(data.border_width){ #>
					<# if(_.isObject(data.border_width)){ #>
						margin-top: -{{ data.border_width.xs }}px;
					<# } #>
				<# } #>
			}
			#sppb-addon-{{ data.id }} .sppb-icon-inner:hover {
				<# if(_.isObject(data.hover_border_width)){ #>
					border-width: {{ data.hover_border_width.xs }}px;
				<# } #>

				<# if(_.isObject(data.hover_border_radius)){ #>
					border-radius: {{ data.hover_border_radius.xs }}px;
				<# } #>
			}
		}
		</style>
		<# if(data.name){ #>
			<div class="sppb-icon {{ data.alignment }} {{ data.class }}">
				<# if(!_.isEmpty(data.link)){ #>
					<a href=\'{{ data.link }}\'>
				<# } #>
				<span class="sppb-icon-inner">
					<i class="fa {{ data.name }}"></i>
				</span>
				<# if(!_.isEmpty(data.link)){ #>
					</a>
				<# } #>
			</div>
		<# } #>
		';

		return $output;
	}
}
