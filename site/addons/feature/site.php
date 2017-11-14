<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2016 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('restricted aceess');

class SppagebuilderAddonFeature extends SppagebuilderAddons {

	public function render() {

		$class = (isset($this->addon->settings->class) && $this->addon->settings->class) ? $this->addon->settings->class : '';
		$title = (isset($this->addon->settings->title) && $this->addon->settings->title) ? $this->addon->settings->title : '';
		$heading_selector = (isset($this->addon->settings->heading_selector) && $this->addon->settings->heading_selector) ? $this->addon->settings->heading_selector : 'h3';

		//Options
		$title_url = (isset($this->addon->settings->title_url) && $this->addon->settings->title_url) ? $this->addon->settings->title_url : '';
		$url_appear = (isset($this->addon->settings->url_appear) && $this->addon->settings->url_appear) ? $this->addon->settings->url_appear : 'title';
		$title_position = (isset($this->addon->settings->title_position) && $this->addon->settings->title_position) ? $this->addon->settings->title_position : 'before';
		$feature_type = (isset($this->addon->settings->feature_type) && $this->addon->settings->feature_type) ? $this->addon->settings->feature_type : 'icon';
		$feature_image = (isset($this->addon->settings->feature_image) && $this->addon->settings->feature_image) ? $this->addon->settings->feature_image : '';
		$icon_name = (isset($this->addon->settings->icon_name) && $this->addon->settings->icon_name) ? $this->addon->settings->icon_name : '';
		$text = (isset($this->addon->settings->text) && $this->addon->settings->text) ? $this->addon->settings->text : '';
		$alignment = (isset($this->addon->settings->alignment) && $this->addon->settings->alignment) ? $this->addon->settings->alignment : '';

		//Image or icon position
		if($title_position == 'before') {
			$icon_image_position = 'after';
		} else if($title_position == 'after') {
			$icon_image_position = 'before';
		} else {
			$icon_image_position = $title_position;
		}

		//Reset Alignment for left and right style
		if( ($icon_image_position=='left') || ($icon_image_position=='right') ) {
			$alignment = 'sppb-text-' . $icon_image_position;
		}

		//Icon or Image
		$media = '';
		if($feature_type == 'icon') {
			if($icon_name) {
				$media  .= '<div class="sppb-icon">';
					if( ($title_url && $url_appear == 'icon') || ($title_url && $url_appear == 'both' ) ) $media .= '<a href="'. $title_url .'">';
						$media  .= '<span class="sppb-icon-container">';
						$media  .= '<i class="fa ' . $icon_name . '"></i>';
						$media  .= '</span>';
					if(($title_url && $url_appear == 'icon') || ($title_url && $url_appear == 'both' )) $media .= '</a>';
				$media  .= '</div>';
			}
		} else {
			if($feature_image) {
				$media  .= '<span class="sppb-img-container">';
				if( ($title_url && $url_appear == 'icon') || ($title_url && $url_appear == 'both' ) ) $media .= '<a href="'. $title_url .'">';
				$media  .= '<img class="sppb-img-responsive" src="' . $feature_image . '" alt="'.$title.'">';
				if(($title_url && $url_appear == 'icon') || ($title_url && $url_appear == 'both' )) $media .= '</a>';
				$media  .= '</span>';
			}
		}

		//Title
		$feature_title = '';
		if($title) {
			$heading_class = '';
			if( ($icon_image_position=='left') || ($icon_image_position=='right') ) {
				$heading_class = ' sppb-media-heading';
			}

			if( ($title_url && $url_appear == 'title') || ($title_url && $url_appear == 'both' ) ) $feature_title .= '<a href="'. $title_url .'">';
			$feature_title .= '<'.$heading_selector.' class="sppb-addon-title sppb-feature-box-title'. $heading_class .'">' . $title . '</'.$heading_selector.'>';
			if(($title_url && $url_appear == 'title') || ($title_url && $url_appear == 'both' )) $feature_title .= '</a>';
		}

		//Feature Text
		$feature_text  = '<div class="sppb-addon-text">';
		$feature_text .= $text;
		$feature_text .= '</div>';

		//Output
		$output  = '<div class="sppb-addon sppb-addon-feature ' . $alignment . ' ' . $class . '">';
		$output .= '<div class="sppb-addon-content">';

		if ($icon_image_position == 'before') {
			$output .= ($media) ? $media : '';
			$output .= ($title) ? $feature_title : '';
			$output .= $feature_text;
		} else if ($icon_image_position == 'after') {
			$output .= ($title) ? $feature_title : '';
			$output .= ($media) ? $media : '';
			$output .= $feature_text;
		} else {
			if($media) {
				$output .= '<div class="sppb-media">';
				$output .= '<div class="pull-'. $icon_image_position .'">';
				$output .= $media;
				$output .= '</div>';
				$output .= '<div class="sppb-media-body">';
				$output .= ($title) ? $feature_title : '';
				$output .= $feature_text;
				$output .= '</div>';
				$output .= '</div>';
			}
		}

		$output .= '</div>';
		$output .= '</div>';

		return $output;
	}

	public function css() {
		$addon_id = '#sppb-addon-' . $this->addon->id;
		$icon_color	= (isset($this->addon->settings->icon_color) && $this->addon->settings->icon_color) ? $this->addon->settings->icon_color : '';
		$icon_size = (isset($this->addon->settings->icon_size) && $this->addon->settings->icon_size) ? $this->addon->settings->icon_size : '';
		$icon_border_color = (isset($this->addon->settings->icon_border_color) && $this->addon->settings->icon_border_color) ? $this->addon->settings->icon_border_color : '';
		$icon_border_width = (isset($this->addon->settings->icon_border_width) && $this->addon->settings->icon_border_width) ? $this->addon->settings->icon_border_width : '';
		$icon_border_width_sm = (isset($this->addon->settings->icon_border_width_sm) && $this->addon->settings->icon_border_width_sm) ? $this->addon->settings->icon_border_width_sm : '';
		$icon_border_width_xs = (isset($this->addon->settings->icon_border_width_xs) && $this->addon->settings->icon_border_width_xs) ? $this->addon->settings->icon_border_width_xs : '';
		$icon_border_radius	= (isset($this->addon->settings->icon_border_radius) && $this->addon->settings->icon_border_radius) ? $this->addon->settings->icon_border_radius : '';
		$icon_border_radius_sm	= (isset($this->addon->settings->icon_border_radius_sm) && $this->addon->settings->icon_border_radius_sm) ? $this->addon->settings->icon_border_radius_sm : '';
		$icon_border_radius_xs	= (isset($this->addon->settings->icon_border_radius_xs) && $this->addon->settings->icon_border_radius_xs) ? $this->addon->settings->icon_border_radius_xs : '';
		$icon_style	= (isset($this->addon->settings->icon_style) && $this->addon->settings->icon_style) ? $this->addon->settings->icon_style : '';
		$icon_background = (isset($this->addon->settings->icon_background) && $this->addon->settings->icon_background) ? $this->addon->settings->icon_background : '';
		$icon_margin_top = (isset($this->addon->settings->icon_margin_top) && $this->addon->settings->icon_margin_top) ? $this->addon->settings->icon_margin_top : '';
		$icon_margin_top_sm = (isset($this->addon->settings->icon_margin_top_sm) && $this->addon->settings->icon_margin_top_sm) ? $this->addon->settings->icon_margin_top_sm : '';
		$icon_margin_top_xs = (isset($this->addon->settings->icon_margin_top_xs) && $this->addon->settings->icon_margin_top_xs) ? $this->addon->settings->icon_margin_top_xs : '';
		$icon_margin_bottom	= (isset($this->addon->settings->icon_margin_bottom) && $this->addon->settings->icon_margin_bottom) ? $this->addon->settings->icon_margin_bottom : '';
		$icon_margin_bottom_sm	= (isset($this->addon->settings->icon_margin_bottom_sm) && $this->addon->settings->icon_margin_bottom_sm) ? $this->addon->settings->icon_margin_bottom_sm : '';
		$icon_margin_bottom_xs	= (isset($this->addon->settings->icon_margin_bottom_xs) && $this->addon->settings->icon_margin_bottom_xs) ? $this->addon->settings->icon_margin_bottom_xs : '';
		$icon_padding = (isset($this->addon->settings->icon_padding) && $this->addon->settings->icon_padding) ? $this->addon->settings->icon_padding : '';
		$feature_type = (isset($this->addon->settings->feature_type) && $this->addon->settings->feature_type) ? $this->addon->settings->feature_type : 'icon';
		$feature_image = (isset($this->addon->settings->feature_image) && $this->addon->settings->feature_image) ? $this->addon->settings->feature_image : '';
		$icon_name = (isset($this->addon->settings->icon_name) && $this->addon->settings->icon_name) ? $this->addon->settings->icon_name : '';

		$css = '';
		if($feature_type == 'icon') {
			if($icon_name) {
				$style = 'display:inline-block;text-align:center;';
				$style_sm = '';
				$style_xs = '';

				$style .= ($icon_margin_top) ? 'margin-top:' . (int) $icon_margin_top . 'px;' : '';
				$style_sm .= ($icon_margin_top_sm) ? 'margin-top:' . (int) $icon_margin_top_sm . 'px;' : '';
				$style_xs .= ($icon_margin_top_xs) ? 'margin-top:' . (int) $icon_margin_top_xs . 'px;' : '';

				$style .= ($icon_margin_bottom) ? 'margin-bottom:' . (int) $icon_margin_bottom . 'px;' : '';
				$style_sm .= ($icon_margin_bottom_sm) ? 'margin-bottom:' . (int) $icon_margin_bottom_sm . 'px;' : '';
				$style_xs .= ($icon_margin_bottom_xs) ? 'margin-bottom:' . (int) $icon_margin_bottom_xs . 'px;' : '';

				$icon_padding_md = '';
				$icon_paddings_md = explode(' ', $icon_padding);
				foreach($icon_paddings_md as $icon_padding_md_item){
					if(empty(trim($icon_padding_md_item))){
						$icon_padding_md .= ' 0';
					} else {
						$icon_padding_md .= ' '.$icon_padding_md_item;
					}

				}
				$style .= ($icon_padding_md) ? 'padding:' . $icon_padding_md . ';' : '';

				$icon_padding_sm = '';

				if(trim($icon_padding_sm) != ""){
					$icon_paddings_sm = explode(' ', $icon_padding_sm);
					foreach($icon_paddings_sm as $icon_padding_sm_item){
						if(empty(trim($icon_padding_sm_item))){
							$icon_padding_sm .= ' 0';
						} else {
							$icon_padding_sm .= ' '.$icon_padding_sm_item;
						}

					}
				}

				$style_sm .= ($icon_padding_sm) ? 'padding:' . $icon_padding_sm . ';' : '';

				$icon_padding_xs = '';

				if(trim($icon_padding_xs) != ""){
					$icon_paddings_xs = explode(' ', $icon_padding_xs);
					foreach($icon_paddings_xs as $icon_padding_xs_item){
						if(empty(trim($icon_padding_xs_item))){
							$icon_padding_xs .= ' 0';
						} else {
							$icon_padding_xs .= ' '.$icon_padding_xs_item;
						}

					}
				}

				$style_xs .= ($icon_padding_xs) ? 'padding:' . $icon_padding_xs . ';' : '';

				$style .= ($icon_color) ? 'color:' . $icon_color  . ';' : '';
				$style .= ($icon_background) ? 'background-color:' . $icon_background  . ';' : '';
				$style .= ($icon_border_color) ? 'border-style:solid;border-color:' . $icon_border_color  . ';' : '';

				$style .= ($icon_border_width) ? 'border-width:' . (int) $icon_border_width . 'px;' : '';
				$style_sm .= ($icon_border_width_sm) ? 'border-width:' . (int) $icon_border_width_sm . 'px;' : '';
				$style_xs .= ($icon_border_width_xs) ? 'border-width:' . (int) $icon_border_width_xs . 'px;' : '';

				$style .= ($icon_border_radius) ? 'border-radius:' . (int) $icon_border_radius  . 'px;' : '';
				$style_sm .= ($icon_border_radius_sm) ? 'border-radius:' . (int) $icon_border_radius_sm  . 'px;' : '';
				$style_xs .= ($icon_border_radius_xs) ? 'border-radius:' . (int) $icon_border_radius_xs  . 'px;' : '';

				$font_size 	= (isset($icon_size) && $icon_size) ? 'font-size:' . (int) $icon_size . 'px;width:' . (int) $icon_size . 'px;height:' . (int) $icon_size . 'px;line-height:' . (int) $icon_size . 'px;' : '';
				$font_size_sm 	= (isset($icon_size_sm) && $icon_size_sm) ? 'font-size:' . (int) $icon_size_sm . 'px;width:' . (int) $icon_size_sm . 'px;height:' . (int) $icon_size_sm . 'px;line-height:' . (int) $icon_size_sm . 'px;' : '';
				$font_size_xs 	= (isset($icon_size_xs) && $icon_size_xs) ? 'font-size:' . (int) $icon_size_xs . 'px;width:' . (int) $icon_size_xs . 'px;height:' . (int) $icon_size_xs . 'px;line-height:' . (int) $icon_size_xs . 'px;' : '';

				$text_style = '';
				$text_style_sm = '';
				$text_style_xs = '';

				$text_style .= (isset($this->addon->settings->text_fontsize) && $this->addon->settings->text_fontsize) ? "font-size: " . $this->addon->settings->text_fontsize . "px;" : "";
				$text_style_sm .= (isset($this->addon->settings->text_fontsize_sm) && $this->addon->settings->text_fontsize_sm) ? "font-size: " . $this->addon->settings->text_fontsize_sm . "px;" : "";
				$text_style_xs .= (isset($this->addon->settings->text_fontsize_xs) && $this->addon->settings->text_fontsize_xs) ? "font-size: " . $this->addon->settings->text_fontsize_xs . "px;" : "";

				$text_style .= (isset($this->addon->settings->text_lineheight) && $this->addon->settings->text_lineheight) ? "line-height: " . $this->addon->settings->text_lineheight . "px;" : "";
				$text_style_sm .= (isset($this->addon->settings->text_lineheight_sm) && $this->addon->settings->text_lineheight_sm) ? "line-height: " . $this->addon->settings->text_lineheight_sm . "px;" : "";
				$text_style_xs .= (isset($this->addon->settings->text_lineheight_xs) && $this->addon->settings->text_lineheight_xs) ? "line-height: " . $this->addon->settings->text_lineheight_xs . "px;" : "";

				if($text_style) {
					$css .= $addon_id . ' .sppb-addon-text {';
					$css .= $text_style;
					$css .= '}';
				}

				if($text_style_sm) {
					$css .= '@media (min-width: 768px) and (max-width: 991px) {';
						$css .= $addon_id . ' .sppb-addon-text {';
						$css .= $text_style_sm;
						$css .= '}';
					$css .= '}';
				}

				if($text_style_xs) {
					$css .= '@media (max-width: 767px) {';
						$css .= $addon_id . ' .sppb-addon-text {';
						$css .= $text_style_xs;
						$css .= '}';
					$css .= '}';
				}

				if($style) {
					$css .= $addon_id . ' .sppb-icon .sppb-icon-container {';
					$css .= $style;
					$css .= '}';
				}

				if($font_size) {
					$css .= $addon_id . ' .sppb-icon .sppb-icon-container > i {';
					$css .= $font_size;
					$css .= '}';
				}

				if(!empty($style_sm) || !empty($font_size_sm)){
					$css .= '@media (min-width: 768px) and (max-width: 991px) {';
						if($style_sm) {
							$css .= $addon_id . ' .sppb-icon .sppb-icon-container {';
							$css .= $style_sm;
							$css .= '}';
						}

						if($font_size_sm) {
							$css .= $addon_id . ' .sppb-icon .sppb-icon-container > i {';
							$css .= $font_size_sm;
							$css .= '}';
						}
					$css .= '}';
				}

				if(!empty($style_xs) || !empty($font_size_xs)){
					$css .= '@media (max-width: 767px) {';
						if($style_xs) {
							$css .= $addon_id . ' .sppb-icon .sppb-icon-container {';
							$css .= $style_xs;
							$css .= '}';
						}

						if($font_size_xs) {
							$css .= $addon_id . ' .sppb-icon .sppb-icon-container > i {';
							$css .= $font_size_xs;
							$css .= '}';
						}
					$css .= '}';
				}
			}
		} else {
			if($feature_image) {
				$img_style = 'display:inline-block;';
				$img_style .= ($icon_margin_top) ? 'margin-top:' . (int) $icon_margin_top . 'px;' : '';
				$img_style .= ($icon_margin_bottom) ? 'margin-bottom:' . (int) $icon_margin_bottom . 'px;' : '';

				if($img_style) {
					$css .= $addon_id . ' .sppb-img-container {';
					$css .= $img_style;
					$css .= '}';
				}
			}
		}

		return $css;
	}

	public static function getTemplate() {
		$output = '
		<#
			var alignment = (data.alignment) ? data.alignment : "";

			var icon_image_position = "";
			if(data.title_position == "before") {
				icon_image_position = "after";
			} else if(data.title_position == "after") {
				icon_image_position = "before";
			} else {
				icon_image_position = data.title_position;
			}


			if( ( icon_image_position == "left" ) || ( icon_image_position == "right" ) ) {
				alignment = "sppb-text-" + icon_image_position;
			}

			var media = "";
			if(data.feature_type == "icon") {
				if(data.icon_name){
					media += \'<div class="sppb-icon">\';
						if( (data.title_url && data.url_appear == "icon") || (data.title_url && data.url_appear == "both" ) ){
							media += \'<a href="\'+data.title_url+\'">\';
						}
						media  += \'<span class="sppb-icon-container">\';
							media  += \'<i class="fa \'+data.icon_name+\'"></i>\';
						media  += \'</span>\';
						if( (data.title_url && data.url_appear == "icon") || (data.title_url && data.url_appear == "both" ) ){
							media += \'</a>\';
						}
					media += \'</div>\';
				}
			} else {
				if(data.feature_image){
					media  += \'<span class="sppb-img-container">\';
					if( (data.title_url && data.url_appear == "icon") || (data.title_url && data.url_appear == "both" ) ){
						media += \'<a href="\'+data.title_url+\'">\';
					}
					media  = \'<img class="sppb-img-responsive" src="\'+data.feature_image+\'" alt="\'+data.title+\'">\';
					if( (data.title_url && data.url_appear == "icon") || (data.title_url && data.url_appear == "both" ) ){
						media += \'</a>\';
					}
					media  += \'</span>\';
				}
			}

			var feature_title = "";
			if(data.title) {
				var heading_class = "";
				if( ( icon_image_position == "left" ) || ( icon_image_position == "right" ) ) {
					heading_class = " sppb-media-heading";
				}

				if( (data.title_url && data.url_appear == "icon") || (data.title_url && data.url_appear == "both" ) ){
					feature_title += \'<a href="\'+data.title_url+\'">\';
				}
				feature_title += \'<\'+data.heading_selector+\' class="sppb-addon-title sppb-feature-box-title  \'+heading_class+\'">\'+data.title+\'</\'+data.heading_selector+\'>\';
				if( (data.title_url && data.url_appear == "icon") || (data.title_url && data.url_appear == "both" ) ){
					feature_title += \'</a>\';
				}
			}

			var feature_text  = \'<div class="sppb-addon-text">\';
			feature_text += data.text;
			feature_text += \'</div>\';

			var title_font_style = data.title_fontstyle || "";

			var icon_padding = "";
			var icon_padding_sm = "";
			var icon_padding_xs = "";
			if(data.icon_padding){
				if(_.isObject(data.icon_padding)){
					if(data.icon_padding.md.trim() !== ""){
						icon_padding = data.icon_padding.md.split(" ").map(item => {
							if(_.isEmpty(item)){
								return "0";
							}
							return item;
						}).join(" ")
					}

					if(data.icon_padding.sm.trim() !== ""){
						icon_padding_sm = data.icon_padding.sm.split(" ").map(item => {
							if(_.isEmpty(item)){
								return "0";
							}
							return item;
						}).join(" ")
					}

					if(data.icon_padding.xs.trim() !== ""){
						icon_padding_xs = data.icon_padding.xs.split(" ").map(item => {
							if(_.isEmpty(item)){
								return "0";
							}
							return item;
						}).join(" ")
					}
				} else {
					if(data.icon_padding.trim() !== ""){
						icon_padding = data.icon_padding.split(" ").map(item => {
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
		<# if(data.feature_type == "icon"){ #>
			<# if(data.icon_name){ #>
				#sppb-addon-{{ data.id }} .sppb-icon .sppb-icon-container{
					display:inline-block;
					text-align:center;
					<# if(_.isObject(data.icon_margin_top)){ #>
						margin-top: {{ data.icon_margin_top.md }}px;
					<# } else { #>
						margin-top: {{ data.icon_margin_top }}px;
					<# } #>
					<# if(_.isObject(data.icon_margin_bottom)){ #>
						margin-bottom: {{ data.icon_margin_bottom.md }}px;
					<# } else { #>
						margin-bottom: {{ data.icon_margin_bottom }}px;
					<# } #>
					padding: {{ icon_padding }};
					color: {{ data.icon_color }};
					background-color: {{ data.icon_background }};
					<# if(_.isObject(data.icon_border_width) && !_.isEmpty(data.icon_border_width.md)){ #>
						border-style:solid;
						border-color: {{ data.icon_border_color }};
						border-width: {{ data.icon_border_width.md }}px;
					<# } else if(!_.isEmpty(data.icon_border_width)) { #>
						border-style:solid;
						border-color: {{ data.icon_border_color }};
						border-width: {{ data.icon_border_width }}px;
					<# } #>
					<# if(_.isObject(data.icon_border_radius)){ #>
						border-radius: {{ data.icon_border_radius.md }}px;
					<# } else { #>
						border-radius: {{ data.icon_border_radius }}px;
					<# } #>
				}

				#sppb-addon-{{ data.id }} .sppb-icon .sppb-icon-container > i{
					<# if(_.isObject(data.icon_size)){ #>
						font-size: {{ data.icon_size.md }}px;
						width: {{ data.icon_size.md }}px;
						height: {{ data.icon_size.md }}px;
						line-height: {{ data.icon_size.md }}px;
					<# } else { #>
						font-size: {{ data.icon_size }}px;
						width: {{ data.icon_size }}px;
						height: {{ data.icon_size }}px;
						line-height: {{ data.icon_size }}px;
					<# } #>

				}
				@media (min-width: 768px) and (max-width: 991px) {
					#sppb-addon-{{ data.id }} .sppb-icon .sppb-icon-container{
						<# if(_.isObject(data.icon_margin_top)){ #>
							margin-top: {{ data.icon_margin_top.sm }}px;
						<# } #>
						<# if(_.isObject(data.icon_margin_bottom)){ #>
							margin-bottom: {{ data.icon_margin_bottom.sm }}px;
						<# } #>
						padding: {{ icon_padding_sm }};
						<# if(_.isObject(data.icon_border_width) && !_.isEmpty(data.icon_border_width.sm)){ #>
							border-width: {{ data.icon_border_width.sm }}px;
						<# } #>
						<# if(_.isObject(data.icon_border_radius)){ #>
							border-radius: {{ data.icon_border_radius.sm }}px;
						<# } #>
					}

					#sppb-addon-{{ data.id }} .sppb-icon .sppb-icon-container > i{
						<# if(_.isObject(data.icon_size)){ #>
							font-size: {{ data.icon_size.sm }}px;
							width: {{ data.icon_size.sm }}px;
							height: {{ data.icon_size.sm }}px;
							line-height: {{ data.icon_size.sm }}px;
						<# } #>
					}
				}
				@media (max-width: 767px) {
					#sppb-addon-{{ data.id }} .sppb-icon .sppb-icon-container{
						<# if(_.isObject(data.icon_margin_top)){ #>
							margin-top: {{ data.icon_margin_top.xs }}px;
						<# } #>
						<# if(_.isObject(data.icon_margin_bottom)){ #>
							margin-bottom: {{ data.icon_margin_bottom.xs }}px;
						<# } #>
						padding: {{ icon_padding_xs }};
						<# if(_.isObject(data.icon_border_width) && !_.isEmpty(data.icon_border_width.xs)){ #>
							border-width: {{ data.icon_border_width.xs }}px;
						<# } #>
						<# if(_.isObject(data.icon_border_radius)){ #>
							border-radius: {{ data.icon_border_radius.xs }}px;
						<# } #>
					}

					#sppb-addon-{{ data.id }} .sppb-icon .sppb-icon-container > i{
						<# if(_.isObject(data.icon_size)){ #>
							font-size: {{ data.icon_size.xs }}px;
							width: {{ data.icon_size.xs }}px;
							height: {{ data.icon_size.xs }}px;
							line-height: {{ data.icon_size.xs }}px;
						<# } #>
					}
				}
			<# } #>
		<# } else { #>
			#sppb-addon-{{ data.id }} .sppb-img-container {
				display:inline-block;
				margin-top: {{ data.icon_margin_top }}px;
				margin-bottom: {{ data.icon_margin_bottom }}px;
			}
		<# } #>

		#sppb-addon-{{ data.id }} .sppb-addon-text {
			<# if(_.isObject(data.text_fontsize)){ #>
				font-size: {{ data.text_fontsize.md }}px;
			<# } else { #>
				font-size: {{ data.text_fontsize }}px;
			<# } #>

			<# if(_.isObject(data.text_lineheight)){ #>
				line-height: {{ data.text_lineheight.md }}px;
			<# } else { #>
				line-height: {{ data.text_lineheight }}px;
			<# } #>
		}

		@media (min-width: 768px) and (max-width: 991px) {
			#sppb-addon-{{ data.id }} .sppb-addon-text {
				<# if(_.isObject(data.text_fontsize)){ #>
					font-size: {{ data.text_fontsize.sm }}px;
				<# } #>

				<# if(_.isObject(data.text_lineheight)){ #>
					line-height: {{ data.text_lineheight.sm }}px;
				<# } #>
			}
		}

		@media (max-width: 767px) {
			#sppb-addon-{{ data.id }} .sppb-addon-text {
				<# if(_.isObject(data.text_fontsize)){ #>
					font-size: {{ data.text_fontsize.xs }}px;
				<# } #>

				<# if(_.isObject(data.text_lineheight)){ #>
					line-height: {{ data.text_lineheight.xs }}px;
				<# } #>
			}
		}

		</style>
		<div class="sppb-addon sppb-addon-feature {{ alignment }} {{ data.class }}">
			<div class="sppb-addon-content">
				<# if (icon_image_position == "before") { #>
					<# if(media){ #>
						{{{ media }}}
					<# } #>
					<# if(data.title){ #>
						{{{ feature_title }}}
					<# } #>
					{{{ feature_text }}}
				<# } else if (icon_image_position == "after") { #>
					<# if(data.title){ #>
						{{{ feature_title }}}
					<# } #>
					<# if(media){ #>
						{{{ media }}}
					<# } #>
					{{{ feature_text }}}
				<# } else { #>
					<# if(media) { #>
						<div class="sppb-media">
							<div class="pull-{{ icon_image_position }}">{{{ media }}}</div>
							<div class="sppb-media-body">
								<# if(data.title){ #>
									{{{ feature_title }}}
								<# } #>
								{{{ feature_text }}}
							</div>
						</div>
					<# } #>
				<# } #>
			</div>
		</div>
		';

		return $output;
	}

}
