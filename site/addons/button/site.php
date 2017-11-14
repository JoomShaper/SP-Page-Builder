<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2016 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/

//no direct accees
defined ('_JEXEC') or die ('restricted aceess');

class SppagebuilderAddonButton extends SppagebuilderAddons {

	public function render() {
		$alignment = (isset($this->addon->settings->alignment) && $this->addon->settings->alignment) ? $this->addon->settings->alignment : 'sppb-text-left';
		$class 	 = (isset($this->addon->settings->class) && $this->addon->settings->class) ? ' ' . $this->addon->settings->class : '';
		$class .= (isset($this->addon->settings->type) && $this->addon->settings->type) ? ' sppb-btn-' . $this->addon->settings->type : '';
		$class .= (isset($this->addon->settings->size) && $this->addon->settings->size) ? ' sppb-btn-' . $this->addon->settings->size : '';
		$class .= (isset($this->addon->settings->block) && $this->addon->settings->block) ? ' ' . $this->addon->settings->block : '';
		$class .= (isset($this->addon->settings->shape) && $this->addon->settings->shape) ? ' sppb-btn-' . $this->addon->settings->shape: ' sppb-btn-rounded';
		$class .= (isset($this->addon->settings->appearance) && $this->addon->settings->appearance) ? ' sppb-btn-' . $this->addon->settings->appearance : '';
		$attribs = (isset($this->addon->settings->target) && $this->addon->settings->target) ? ' target="' . $this->addon->settings->target . '"': '';
		$attribs .= (isset($this->addon->settings->url) && $this->addon->settings->url) ? ' href="' . $this->addon->settings->url . '"': '';
		$attribs .= ' id="btn-' . $this->addon->id . '"';
		$text = (isset($this->addon->settings->text) && $this->addon->settings->text) ? $this->addon->settings->text: '';
		$icon = (isset($this->addon->settings->icon) && $this->addon->settings->icon) ? $this->addon->settings->icon: '';
		$icon_position = (isset($this->addon->settings->icon_position) && $this->addon->settings->icon_position) ? $this->addon->settings->icon_position: 'left';

		if($icon_position == 'left') {
			$text = ($icon) ? '<i class="fa ' . $icon . '"></i> ' . $text : $text;
		} else {
			$text = ($icon) ? $text . ' <i class="fa ' . $icon . '"></i>' : $text;
		}

		$output  = '<div class="'. $alignment .'">';
		$output  .= '<a' . $attribs . ' class="sppb-btn ' . $class . '">' . $text . '</a>';
		$output  .= '</div>';

		return $output;
	}

	public function css() {
		$addon_id = '#sppb-addon-' .$this->addon->id;
		$layout_path = JPATH_ROOT . '/components/com_sppagebuilder/layouts';

		$css_path = new JLayoutFile('addon.css.button', $layout_path);

		$options = new stdClass;
		$options->button_type = (isset($this->addon->settings->type) && $this->addon->settings->type) ? $this->addon->settings->type : '';
		$options->button_appearance = (isset($this->addon->settings->appearance) && $this->addon->settings->appearance) ? $this->addon->settings->appearance : '';
		$options->button_color = (isset($this->addon->settings->color) && $this->addon->settings->color) ? $this->addon->settings->color : '';
		$options->button_color_hover = (isset($this->addon->settings->color_hover) && $this->addon->settings->color_hover) ? $this->addon->settings->color_hover : '';
		$options->button_background_color = (isset($this->addon->settings->background_color) && $this->addon->settings->background_color) ? $this->addon->settings->background_color : '';
		$options->button_background_color_hover = (isset($this->addon->settings->background_color_hover) && $this->addon->settings->background_color_hover) ? $this->addon->settings->background_color_hover : '';
		$options->button_fontstyle = (isset($this->addon->settings->fontstyle) && $this->addon->settings->fontstyle) ? $this->addon->settings->fontstyle : '';
		$options->button_font_style = (isset($this->addon->settings->font_style) && $this->addon->settings->font_style) ? $this->addon->settings->font_style : '';
		$options->button_padding = (isset($this->addon->settings->button_padding) && $this->addon->settings->button_padding) ? $this->addon->settings->button_padding : '';
		$options->button_letterspace = (isset($this->addon->settings->letterspace) && $this->addon->settings->letterspace) ? $this->addon->settings->letterspace : '';

		return $css_path->render(array('addon_id' => $addon_id, 'options' => $options, 'id' => 'btn-' . $this->addon->id));
	}

	public static function getTemplate(){
		$output  = '
		<#
			var modern_font_style = false;
			var classList = data.class;
			classList += " sppb-btn-"+data.type;
			classList += " sppb-btn-"+data.size;
			classList += " sppb-btn-"+data.shape;
			if(!_.isEmpty(data.appearance)){
				classList += " sppb-btn-"+data.appearance;
			}

			classList += " "+data.block;

			var button_fontstyle = data.fontstyle || "";
			var button_font_style = data.font_style || "";

			var button_padding = "";
			var button_padding_sm = "";
			var button_padding_xs = "";
			if(data.button_padding){
				if(_.isObject(data.button_padding)){
					if(data.button_padding.md.trim() !== ""){
						button_padding = data.button_padding.md.split(" ").map(item => {
							if(_.isEmpty(item)){
								return "0";
							}
							return item;
						}).join(" ")
					}

					if(data.button_padding.sm.trim() !== ""){
						button_padding_sm = data.button_padding.sm.split(" ").map(item => {
							if(_.isEmpty(item)){
								return "0";
							}
							return item;
						}).join(" ")
					}

					if(data.button_padding.xs.trim() !== ""){
						button_padding_xs = data.button_padding.xs.split(" ").map(item => {
							if(_.isEmpty(item)){
								return "0";
							}
							return item;
						}).join(" ")
					}
				} else {
					if(data.button_padding.trim() !== ""){
						button_padding = data.button_padding.split(" ").map(item => {
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

			#sppb-addon-{{ data.id }} #btn-{{ data.id }}.sppb-btn-{{ data.type }}{
				letter-spacing: {{ data.letterspace }};

				<# if(_.isObject(button_font_style) && button_font_style.underline) { #>
					text-decoration: underline;
					<# modern_font_style = true #>
				<# } #>

				<# if(_.isObject(button_font_style) && button_font_style.italic) { #>
					font-style: italic;
					<# modern_font_style = true #>
				<# } #>

				<# if(_.isObject(button_font_style) && button_font_style.uppercase) { #>
					text-transform: uppercase;
					<# modern_font_style = true #>
				<# } #>

				<# if(_.isObject(button_font_style) && button_font_style.weight) { #>
					font-weight: {{ button_font_style.weight }};
					<# modern_font_style = true #>
				<# } #>

				<# if(!modern_font_style) { #>
					<# if(_.isArray(button_fontstyle)) { #>
						<# if(button_fontstyle.indexOf("underline") !== -1){ #>
							text-decoration: underline;
						<# } #>
						<# if(button_fontstyle.indexOf("uppercase") !== -1){ #>
							text-transform: uppercase;
						<# } #>
						<# if(button_fontstyle.indexOf("italic") !== -1){ #>
							font-style: italic;
						<# } #>
						<# if(button_fontstyle.indexOf("lighter") !== -1){ #>
							font-weight: lighter;
						<# } else if(button_fontstyle.indexOf("normal") !== -1){#>
							font-weight: normal;
						<# } else if(button_fontstyle.indexOf("bold") !== -1){#>
							font-weight: bold;
						<# } else if(button_fontstyle.indexOf("bolder") !== -1){#>
							font-weight: bolder;
						<# } #>
					<# } #>
				<# } #>
			}

			<# if(data.type == "custom"){ #>
				#sppb-addon-{{ data.id }} #btn-{{ data.id }}.sppb-btn-custom{
					color: {{ data.color }};
					padding: {{ button_padding }};
					<# if(data.appearance == "outline"){ #>
						border-color: {{ data.background_color }}
					<# } else if(data.appearance == "3d"){ #>
						border-bottom-color: {{ data.background_color_hover }};
						background-color: {{ data.background_color }};
					<# } else { #>
						background-color: {{ data.background_color }};
					<# } #>
				}

				#sppb-addon-{{ data.id }} #btn-{{ data.id }}.sppb-btn-custom:hover{
					color: {{ data.color_hover }};
					background-color: {{ data.background_color_hover }};
					<# if(data.appearance == "outline"){ #>
						border-color: {{ data.background_color_hover }}
					<# } #>
				}
				@media (min-width: 768px) and (max-width: 991px) {
					#sppb-addon-{{ data.id }} #btn-{{ data.id }}.sppb-btn-custom{
						padding: {{ button_padding_sm }};
					}
				}
				@media (max-width: 767px) {
					#sppb-addon-{{ data.id }} #btn-{{ data.id }}.sppb-btn-custom{
						padding: {{ button_padding_xs }};
					}
				}
			<# } #>
		</style>
		<div class="{{ data.alignment }}">
			<a href=\'{{ data.url }}\' id="btn-{{ data.id }}" target="{{ data.target }}" class="sppb-btn {{ classList }}"><# if(data.icon_position == "left" && !_.isEmpty(data.icon)) { #><i class="fa {{ data.icon }}"></i> <# } #>{{ data.text }}<# if(data.icon_position == "right" && !_.isEmpty(data.icon)) { #> <i class="fa {{ data.icon }}"></i><# } #></a>
		</div>';

		return $output;
	}

}
