<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2016 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('restricted aceess');

class SppagebuilderAddonTestimonial extends SppagebuilderAddons {

	public function render() {

		$class = (isset($this->addon->settings->class) && $this->addon->settings->class) ? $this->addon->settings->class : '';
		$class .= (isset($this->addon->settings->alignment) && $this->addon->settings->alignment) ? $this->addon->settings->alignment : 'sppb-text-center';
		$style = (isset($this->addon->settings->style) && $this->addon->settings->style) ? $this->addon->settings->style : '';
		$title = (isset($this->addon->settings->title) && $this->addon->settings->title) ? $this->addon->settings->title : '';
		$heading_selector = (isset($this->addon->settings->heading_selector) && $this->addon->settings->heading_selector) ? $this->addon->settings->heading_selector : 'h3';
		$show_quote = (isset($this->addon->settings->show_quote)) ? $this->addon->settings->show_quote : true;

		//Options
		$review = (isset($this->addon->settings->review) && $this->addon->settings->review) ? $this->addon->settings->review : '';
		$name = (isset($this->addon->settings->name) && $this->addon->settings->name) ? $this->addon->settings->name : '';
		$company = (isset($this->addon->settings->company) && $this->addon->settings->company) ? $this->addon->settings->company : '';
		$avatar = (isset($this->addon->settings->avatar) && $this->addon->settings->avatar) ? $this->addon->settings->avatar : '';
		$avatar_size = (isset($this->addon->settings->avatar_width) && $this->addon->settings->avatar_width) ? $this->addon->settings->avatar_width : '';
		$avatar_shape = (isset($this->addon->settings->avatar_shape) && $this->addon->settings->avatar_shape) ? $this->addon->settings->avatar_shape : 'sppb-avatar-circle';
		$link = (isset($this->addon->settings->link) && $this->addon->settings->link) ? $this->addon->settings->link : '';
		$link_target = (isset($this->addon->settings->link_target) && $this->addon->settings->link_target) ? ' target="' . $this->addon->settings->link_target . '"' : '';

		//Output
		$output  = '<div class="sppb-addon sppb-addon-testimonial ' . $class . '">';
		$output .= ($title) ? '<'.$heading_selector.' class="sppb-addon-title">' . $title . '</'.$heading_selector.'>' : '';
		$output .= '<div class="sppb-addon-content">';
		if($show_quote){
			$output .= '<span class="fa fa-quote-left"></span>';
		}
		$output .= '<div class="sppb-addon-testimonial-review">';
		$output .= $review;
		$output .= '</div>';

		$output .= '<div class="sppb-addon-testimonial-footer">';
		$output .= $link ? '<a' . $link_target . ' href="'.$link.'">' : '';
		$output .= $avatar ? '<img src="'.$avatar.'" height="' . $avatar_size . '" width="' . $avatar_size . '" class="'. $avatar_shape .' sppb-addon-testimonial-avatar" alt="'.$name.'">' : '';
		$output .= '<span class="sppb-addon-testimonial-client"><strong>'.$name.'</strong><br /><span class="sppb-addon-testimonial-client-url">'.$company.'</span></span>';
		$output .= $link ? '</a>' : '';
		$output .= '</div>';

		$output .= '</div>';
		$output .= '</div>';

		return $output;

	}

	public function css() {
		$css = '';

		$style = '';
		$style_sm = '';
		$style_xs = '';

		$style .= (isset($this->addon->settings->review_color) && $this->addon->settings->review_color) ? "color: " . $this->addon->settings->review_color . ";" : "";

		$style .= (isset($this->addon->settings->review_size) && $this->addon->settings->review_size) ? "font-size: " . $this->addon->settings->review_size . "px;" : "";
		$style_sm .= (isset($this->addon->settings->review_size_sm) && $this->addon->settings->review_size_sm) ? "font-size: " . $this->addon->settings->review_size_sm . "px;" : "";
		$style_xs .= (isset($this->addon->settings->review_size_xs) && $this->addon->settings->review_size_xs) ? "font-size: " . $this->addon->settings->review_size_xs . "px;" : "";

		$style .= (isset($this->addon->settings->review_line_height) && $this->addon->settings->review_line_height) ? "line-height: " . $this->addon->settings->review_line_height . "px;" : "";
		$style_sm .= (isset($this->addon->settings->review_line_height_sm) && $this->addon->settings->review_line_height_sm) ? "line-height: " . $this->addon->settings->review_line_height_sm . "px;" : "";
		$style_xs .= (isset($this->addon->settings->review_line_height_xs) && $this->addon->settings->review_line_height_xs) ? "line-height: " . $this->addon->settings->review_line_height_xs . "px;" : "";

		if($style){
			$css .= '#sppb-addon-' . $this->addon->id . ' .sppb-addon-testimonial-review{ ' . $style . ' }';
		}

		if($style_sm){
			$css .= '@media (min-width: 768px) and (max-width: 991px) {#sppb-addon-' . $this->addon->id . ' .sppb-addon-testimonial-review{ ' . $style_sm . ' }}';
		}

		if($style_xs){
			$css .= '@media (max-width: 767px) {#sppb-addon-' . $this->addon->id . ' .sppb-addon-testimonial-review{ ' . $style_xs . ' }}';
		}

		$icon_style = '';
		$icon_style_sm = '';
		$icon_style_xs = '';

		$icon_style .= (isset($this->addon->settings->icon_color) && $this->addon->settings->icon_color) ? "color: " . $this->addon->settings->icon_color . ";" : "";
		
		$icon_style .= (isset($this->addon->settings->icon_size) && $this->addon->settings->icon_size) ? "font-size: " . $this->addon->settings->icon_size . "px;" : "";
		$icon_style_sm .= (isset($this->addon->settings->icon_size_sm) && $this->addon->settings->icon_size_sm) ? "font-size: " . $this->addon->settings->icon_size_sm . "px;" : "";
		$icon_style_xs .= (isset($this->addon->settings->icon_size_xs) && $this->addon->settings->icon_size_xs) ? "font-size: " . $this->addon->settings->icon_size_xs . "px;" : "";

		if($icon_style){
			$css .= '#sppb-addon-' . $this->addon->id . ' .sppb-addon-testimonial .fa-quote-left{ ' . $icon_style . ' }';
		}

		if($icon_style_sm){
			$css .= '@media (min-width: 768px) and (max-width: 991px) {#sppb-addon-' . $this->addon->id . ' .sppb-addon-testimonial .fa-quote-left{ ' . $icon_style_sm . ' }}';
		}

		if($icon_style_xs){
			$css .= '@media (max-width: 767px) {#sppb-addon-' . $this->addon->id . ' .sppb-addon-testimonial .fa-quote-left{ ' . $icon_style_xs . ' }}';
		}

		return $css;
	}

	public static function getTemplate()
	{

		$output = '
			<#
				let testimonialAlignment = data.alignment || "sppb-text-center"
				let avatar_position = data.avatar_position || "left"
				let avatar = data.avatar || ""
				let avatar_shape = data.avatar_shape || "sppb-avatar-circle"
				let reviewer_link = data.link || ""
				let link_target = (data.link_target)? "target=\'"+ data.link_target +"\'": ""
			#>

			<style type="text/css">
				<# if(data.show_quote){ #>
					#sppb-addon-{{ data.id }} .sppb-addon-testimonial .fa-quote-left{
						<# if(_.isObject(data.icon_size)){ #>
							font-size: {{ data.icon_size.md }}px;
						<# } #>
						color: {{ data.icon_color }};
					}
				<# } #>

				#sppb-addon-{{ data.id }} .sppb-addon-testimonial-review{
					<# if(_.isObject(data.review_size)){ #>
						font-size: {{ data.review_size.md }}px;
					<# } #>
					<# if(_.isObject(data.review_line_height)){ #>
						line-height: {{ data.review_line_height.md }}px;
					<# } #>
					color: {{ data.review_color }};
				}
				@media (min-width: 768px) and (max-width: 991px) {
					<# if(data.show_quote){ #>
						#sppb-addon-{{ data.id }} .sppb-addon-testimonial .fa-quote-left{
							<# if(_.isObject(data.icon_size)){ #>
								font-size: {{ data.icon_size.sm }}px;
							<# } #>
						}
					<# } #>
	
					#sppb-addon-{{ data.id }} .sppb-addon-testimonial-review{
						<# if(_.isObject(data.review_size)){ #>
							font-size: {{ data.review_size.sm }}px;
						<# } #>
						<# if(_.isObject(data.review_line_height)){ #>
							line-height: {{ data.review_line_height.sm }}px;
						<# } #>
					}
				}
				@media (max-width: 767px) {
					<# if(data.show_quote){ #>
						#sppb-addon-{{ data.id }} .sppb-addon-testimonial .fa-quote-left{
							<# if(_.isObject(data.icon_size)){ #>
								font-size: {{ data.icon_size.xs }}px;
							<# } #>
						}
					<# } #>
	
					#sppb-addon-{{ data.id }} .sppb-addon-testimonial-review{
						<# if(_.isObject(data.review_size)){ #>
							font-size: {{ data.review_size.xs }}px;
						<# } #>
						<# if(_.isObject(data.review_line_height)){ #>
							line-height: {{ data.review_line_height.xs }}px;
						<# } #>
					}
				}
			</style>

			<div class="sppb-addon sppb-addon-testimonial {{ data.class }} {{ testimonialAlignment }}">
				<# if( !_.isEmpty( data.title ) ){ #><{{ data.heading_selector }} class="sppb-addon-title">{{ data.title }}</{{ data.heading_selector }}><# } #>
				<div class="sppb-addon-content">
					<# if(data.show_quote){ #>
						<span class="fa fa-quote-left"></span>
					<# } #>
					<div class="sppb-addon-testimonial-review">
					{{{ data.review }}}
					</div>

					<div class="sppb-addon-testimonial-footer">
					<# if (reviewer_link) { #>
						<a {{ link_target }} href=\'{{{ reviewer_link }}}\'>
					<# } #>

					<# if (avatar) { #>
						<img class="{{ avatar_shape }} sppb-addon-testimonial-avatar" src=\'{{ data.avatar }}\' width="{{ data.avatar_width }}" height="{{ data.avatar_width }}" alt="{{ data.name }}">
					<# } #>

					<span class="sppb-addon-testimonial-client"><strong>{{ data.name }}</strong><br /><span class="sppb-addon-testimonial-client-url">{{ data.company }}</span></span>

					<# if (reviewer_link) { #>
						</a>
					<# } #>
					</div>

				</div>
			</div>
			';

		return $output;
	}
}
