<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2016 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('restricted aceess');

class SppagebuilderAddonText_block extends SppagebuilderAddons {

	public function render() {

		$class = (isset($this->addon->settings->class) && $this->addon->settings->class) ? $this->addon->settings->class : '';
		$title = (isset($this->addon->settings->title) && $this->addon->settings->title) ? $this->addon->settings->title : '';
		$heading_selector = (isset($this->addon->settings->heading_selector) && $this->addon->settings->heading_selector) ? $this->addon->settings->heading_selector : 'h3';

		//Options
		$text = (isset($this->addon->settings->text) && $this->addon->settings->text) ? $this->addon->settings->text : '';
		$alignment = (isset($this->addon->settings->alignment) && $this->addon->settings->alignment) ? $this->addon->settings->alignment : '';
		$dropcap = (isset($this->addon->settings->dropcap) && $this->addon->settings->dropcap) ? $this->addon->settings->dropcap : 0;

		$dropcapCls = '';
		if($dropcap){
			$dropcap = 'sppb-dropcap';
		}

		//Output
		$output  = '<div class="sppb-addon sppb-addon-text-block ' . $dropcap . ' ' . $alignment . ' ' . $class . '">';
		$output .= ($title) ? '<'.$heading_selector.' class="sppb-addon-title">' . $title . '</'.$heading_selector.'>' : '';
		$output .= '<div class="sppb-addon-content">';
		$output .= $text;
		$output .= '</div>';
		$output .= '</div>';

		return $output;

	}

	public function css() {
		$css = '';
		$dropcap_style = (isset($this->addon->settings->dropcap_color) && $this->addon->settings->dropcap_color) ? "color: " . $this->addon->settings->dropcap_color . ";" : "";

		$style = '';
		$style_sm = '';
		$style_xs = '';

		$style .= (isset($this->addon->settings->text_fontsize) && $this->addon->settings->text_fontsize) ? "font-size: " . $this->addon->settings->text_fontsize . "px;" : "";
		$style_sm .= (isset($this->addon->settings->text_fontsize_sm) && $this->addon->settings->text_fontsize_sm) ? "font-size: " . $this->addon->settings->text_fontsize_sm . "px;" : "";
		$style_xs .= (isset($this->addon->settings->text_fontsize_xs) && $this->addon->settings->text_fontsize_xs) ? "font-size: " . $this->addon->settings->text_fontsize_xs . "px;" : "";

		$style .= (isset($this->addon->settings->text_lineheight) && $this->addon->settings->text_lineheight) ? "line-height: " . $this->addon->settings->text_lineheight . "px;" : "";
		$style_sm .= (isset($this->addon->settings->text_lineheight_sm) && $this->addon->settings->text_lineheight_sm) ? "line-height: " . $this->addon->settings->text_lineheight_sm . "px;" : "";
		$style_xs .= (isset($this->addon->settings->text_lineheight_xs) && $this->addon->settings->text_lineheight_xs) ? "line-height: " . $this->addon->settings->text_lineheight_xs . "px;" : "";

		if(isset($this->addon->settings->dropcap) && $this->addon->settings->dropcap && !empty($dropcap_style)){
			$css .= '#sppb-addon-' . $this->addon->id . ' .sppb-dropcap:first-letter{ ' . $dropcap_style . ' }';
		}

		if($style){
			$css .= '#sppb-addon-' . $this->addon->id . '{ ' . $style . ' }';
		}

		if($style_sm){
			$css .= '@media (min-width: 768px) and (max-width: 991px) {#sppb-addon-' . $this->addon->id . '{ ' . $style_sm . ' }}';
		}

		if($style_xs){
			$css .= '@media (max-width: 767px) {#sppb-addon-' . $this->addon->id . '{ ' . $style_xs . ' }}';
		}

		return $css;
	}

	public static function getTemplate()
	{
		$output = '
		<#
			var dropcap = "";

			if(data.dropcap){
				dropcap = "sppb-dropcap";
			}
		#>
		<style type="text/css">
			#sppb-addon-{{ data.id }}{
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
			#sppb-addon-{{ data.id }} .sppb-dropcap .sppb-addon-content:first-letter {
				color: {{ data.dropcap_color }};
			}

			@media (min-width: 768px) and (max-width: 991px) {
				#sppb-addon-{{ data.id }}{
					<# if(_.isObject(data.text_fontsize)){ #>
						font-size: {{ data.text_fontsize.sm }}px;
					<# } #>

					<# if(_.isObject(data.text_lineheight)){ #>
						line-height: {{ data.text_lineheight.sm }}px;
					<# } #>
				}
			}
			@media (max-width: 767px) {
				#sppb-addon-{{ data.id }}{
					<# if(_.isObject(data.text_fontsize)){ #>
						font-size: {{ data.text_fontsize.xs }}px;
					<# } #>

					<# if(_.isObject(data.text_lineheight)){ #>
						line-height: {{ data.text_lineheight.xs }}px;
					<# } #>
				}
			}
		</style>
		<div class="sppb-addon sppb-addon-text-block {{ dropcap }} {{ data.alignment }} {{ data.class }}">
			<# if( !_.isEmpty( data.title ) ){ #><{{ data.heading_selector }} class="sppb-addon-title">{{{ data.title }}}</{{ data.heading_selector }}><# } #>
			<div class="sppb-addon-content">{{{ data.text }}}</div>
		</div>';
		return $output;
	}
}
