<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2016 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('restricted aceess');

class SppagebuilderAddonImage extends SppagebuilderAddons{

	public function render() {

		$class = (isset($this->addon->settings->class) && $this->addon->settings->class) ? $this->addon->settings->class : '';
		$title = (isset($this->addon->settings->title) && $this->addon->settings->title) ? $this->addon->settings->title : '';
		$title_position = (isset($this->addon->settings->title_position) && $this->addon->settings->title_position) ? $this->addon->settings->title_position : 'top';
		$heading_selector = (isset($this->addon->settings->heading_selector) && $this->addon->settings->heading_selector) ? $this->addon->settings->heading_selector : 'h3';

		//Options
		$image = (isset($this->addon->settings->image) && $this->addon->settings->image) ? $this->addon->settings->image : '';
		$alt_text = (isset($this->addon->settings->alt_text) && $this->addon->settings->alt_text) ? $this->addon->settings->alt_text : '';
		$position = (isset($this->addon->settings->position) && $this->addon->settings->position) ? $this->addon->settings->position : '';
		$link = (isset($this->addon->settings->link) && $this->addon->settings->link) ? $this->addon->settings->link : '';
		$target = (isset($this->addon->settings->target) && $this->addon->settings->target) ? 'target="' . $this->addon->settings->target . '"' : '';
		$open_lightbox = (isset($this->addon->settings->open_lightbox) && $this->addon->settings->open_lightbox) ? $this->addon->settings->open_lightbox : 0;
		$image_overlay = (isset($this->addon->settings->overlay_color) && $this->addon->settings->overlay_color) ? 1 : 0;

		$output = '';

		if($image) {
			$output  .= '<div class="sppb-addon sppb-addon-single-image ' . $position . ' ' . $class . '">';
			$output .= ($title && $title_position != 'bottom') ? '<'.$heading_selector.' class="sppb-addon-title">' . $title . '</'.$heading_selector.'>' : '';
			$output .= '<div class="sppb-addon-content">';
			$output .= '<div class="sppb-addon-single-image-container">';

			if (empty($alt_text)) {
				if (!empty($title)) {
					$alt_text = $title;
				} else {
					$alt_text = basename($image);
				}
			}

			if($image_overlay && $open_lightbox) {
				$output .= '<div class="sppb-addon-image-overlay">';
				$output .= '</div>';
			}

			if($open_lightbox) {
				$output .= '<a class="sppb-magnific-popup sppb-addon-image-overlay-icon" data-popup_type="image" data-mainclass="mfp-no-margins mfp-with-zoom" href="' . $image . '">+</a>';
			}

			if(!$open_lightbox) {
				$output .= ($link) ? '<a ' . $target . ' href="' . $link . '">' : '';
			}

			$output  .= '<img class="sppb-img-responsive" src="' . $image . '" alt="'. $alt_text .'" title="'.$title.'">';

			if(!$open_lightbox) {
				$output .= ($link) ? '</a>' : '';
			}

			$output  .= '</div>';
			$output  .= '</div>';
			$output .= ($title && $title_position == 'bottom') ? '<'.$heading_selector.' class="sppb-addon-title">' . $title . '</'.$heading_selector.'>' : '';
			$output  .= '</div>';
		}

		return $output;
	}

	public function scripts() {
		return array(JURI::base(true) . '/components/com_sppagebuilder/assets/js/jquery.magnific-popup.min.js');
	}

	public function stylesheets() {
		return array(JURI::base(true) . '/components/com_sppagebuilder/assets/css/magnific-popup.css');
	}

	public function css() {
		$addon_id = '#sppb-addon-' . $this->addon->id;
		$open_lightbox = (isset($this->addon->settings->open_lightbox) && $this->addon->settings->open_lightbox) ? $this->addon->settings->open_lightbox : 0;
		$style = (isset($this->addon->settings->overlay_color) && $this->addon->settings->overlay_color) ? 'background-color: ' . $this->addon->settings->overlay_color . ';' : '';
		$style_img = (isset($this->addon->settings->border_radius) && $this->addon->settings->border_radius) ? 'border-radius: ' . $this->addon->settings->border_radius . 'px;' : '';

		$css = '';
		if($open_lightbox && $style) {
			$css .= $addon_id . ' .sppb-addon-image-overlay{' . $style . '}';
		}

		$css .= $addon_id . ' img{' . $style_img . '}';

		return $css;

	}

	public static function getTemplate() {
		$output = '
		<#
			var image_overlay = 0;
			if(!_.isEmpty(data.overlay_color)){
				image_overlay = 1;
			}
			var open_lightbox = parseInt(data.open_lightbox);
			var title_font_style = data.title_fontstyle || "";

			var alt_text = data.alt_text;

			if(_.isEmpty(alt_text)){
				if(!_.isEmpty(data.title)){
					alt_text = data.title;
				}
			}
		#>
		<style type="text/css">
			<# if(open_lightbox && data.overlay_color){ #>
				#sppb-addon-{{ data.id }} .sppb-addon-image-overlay{
					background-color: {{ data.overlay_color }};
				}
			<# } #>

			#sppb-addon-{{ data.id }} img{
				border-radius: {{ data.border_radius }}px;
			}
		</style>
		<# if(data.image){ #>
			<div class="sppb-addon sppb-addon-single-image {{ data.position }} {{ data.class }}">
				<# if( !_.isEmpty( data.title ) && data.title_position != "bottom" ){ #><{{ data.heading_selector }} class="sppb-addon-title">{{ data.title }}</{{ data.heading_selector }}><# } #>
				<div class="sppb-addon-content">
					<div class="sppb-addon-single-image-container">
						<# if(image_overlay && open_lightbox) { #>
							<div class="sppb-addon-image-overlay"></div>
						<# } #>
						<# if(open_lightbox) { #>
							<a class="sppb-magnific-popup sppb-addon-image-overlay-icon" data-popup_type="image" data-mainclass="mfp-no-margins mfp-with-zoom" href=\'{{ data.image }}\'>+</a>
						<# } #>
			
						<# if(!open_lightbox) { #>
							<a target="{{ data.target }}" href=\'{{ data.link }}\'>
						<# } #>

						<img class="sppb-img-responsive" src=\'{{ data.image }}\' alt="{{ alt_text }}" title="{{ data.title }}">

						<# if(!open_lightbox) { #>
							</a>
						<# } #>

					</div>
				</div>
				<# if( !_.isEmpty( data.title ) && data.title_position == "bottom" ){ #><{{ data.heading_selector }} class="sppb-addon-title">{{ data.title }}</{{ data.heading_selector }}><# } #>
			</div>
		<# } #>
		';

		return $output;
	}

}
