<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2016 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('restricted aceess');

class SppagebuilderAddonTab extends SppagebuilderAddons {

	public function render() {

		$class = (isset($this->addon->settings->class) && $this->addon->settings->class) ? $this->addon->settings->class : '';
		$style = (isset($this->addon->settings->style) && $this->addon->settings->style) ? $this->addon->settings->style : '';
		$title = (isset($this->addon->settings->title) && $this->addon->settings->title) ? $this->addon->settings->title : '';
		$heading_selector = (isset($this->addon->settings->heading_selector) && $this->addon->settings->heading_selector) ? $this->addon->settings->heading_selector : 'h3';

		//Output
		$output  = '<div class="sppb-addon sppb-addon-tab ' . $class . '">';
		$output .= ($title) ? '<'.$heading_selector.' class="sppb-addon-title">' . $title . '</'.$heading_selector.'>' : '';
		$output .= '<div class="sppb-addon-content sppb-tab">';

		//Tab Title
		$output .='<ul class="sppb-nav sppb-nav-' . $style . '">';
		foreach ($this->addon->settings->sp_tab_item as $key => $tab) {
			$title = (isset($tab->icon) && $tab->icon) ? '<i class="fa ' . $tab->icon . '"></i> ' . $tab->title : $tab->title;
			$output .='<li class="'. ( ($key==0) ? "active" : "").'"><a data-toggle="sppb-tab" href="#sppb-tab-'. ($this->addon->id + $key) .'">'. $title .'</a></li>';
		}
		$output .='</ul>';

		//Tab Contnet
		$output .='<div class="sppb-tab-content sppb-nav-' . $style . '-content">';
		foreach ($this->addon->settings->sp_tab_item as $key => $tab) {
			$output .='<div id="sppb-tab-'. ($this->addon->id + $key) .'" class="sppb-tab-pane sppb-fade'. ( ($key==0) ? " active in" : "").'">' . $tab->content .'</div>';
		}
		$output .='</div>';
		$output .= '</div>';
		$output .= '</div>';

		return $output;

	}

	public function css() {
		$addon_id = '#sppb-addon-' . $this->addon->id;
		$tab_style = (isset($this->addon->settings->style) && $this->addon->settings->style) ? $this->addon->settings->style : '';
		$style = (isset($this->addon->settings->active_tab_color) && $this->addon->settings->active_tab_color) ? 'color: ' . $this->addon->settings->active_tab_color . ';': '';

		$css = '';
		if($tab_style == 'pills') {
			$style .= (isset($this->addon->settings->active_tab_bg) && $this->addon->settings->active_tab_bg) ? 'background-color: ' . $this->addon->settings->active_tab_bg . ';': '';
			if($style) {
				$css .= $addon_id . ' .sppb-nav-pills > li.active > a,' . $addon_id . ' .sppb-nav-pills > li.active > a:hover,' . $addon_id . ' .sppb-nav-pills > li.active > a:focus {';
				$css .= $style;
				$css .= '}';
			}
		} else if ($tab_style == 'lines') {
			$style .= (isset($this->addon->settings->active_tab_bg) && $this->addon->settings->active_tab_bg) ? 'border-bottom-color: ' . $this->addon->settings->active_tab_bg . ';': '';
			if($style) {
				$css .= $addon_id . ' .sppb-nav-lines > li.active > a,' . $addon_id . ' .sppb-nav-lines > li.active > a:hover,' . $addon_id . ' .sppb-nav-lines > li.active > a:focus {';
				$css .= $style;
				$css .= '}';
			}
		}

		return $css;
	}

	public static function getTemplate(){
		$output = '
		<style type="text/css">
			<# if(data.style == "pills"){ #>
				#sppb-addon-{{ data.id }} .sppb-nav-pills > li.active > a,
				#sppb-addon-{{ data.id }} .sppb-nav-pills > li.active > a:hover,
				#sppb-addon-{{ data.id }} .sppb-nav-pills > li.active > a:focus{
					color: {{ data.active_tab_color }};
					background-color: {{ data.active_tab_bg }};
				}
			<# } #>

			<# if(data.style == "lines"){ #>
				#sppb-addon-{{ data.id }} .sppb-nav-lines > li.active > a,
				#sppb-addon-{{ data.id }} .sppb-nav-lines > li.active > a:hover,
				#sppb-addon-{{ data.id }} .sppb-nav-lines > li.active > a:focus{
					color: {{ data.active_tab_color }};
					border-bottom-color: {{ data.active_tab_bg }};
				}
			<# } #>
		</style>
		<div class="sppb-addon sppb-addon-tab {{ data.class }}">
			<# if( !_.isEmpty( data.title ) ){ #><{{ data.heading_selector }} class="sppb-addon-title">{{{ data.title }}}</{{ data.heading_selector }}><# } #>
			<div class="sppb-addon-content sppb-tab">
				<ul class="sppb-nav sppb-nav-{{ data.style }}">
					<# _.each(data.sp_tab_item, function(tab, key){ #>
						<#
							var active = "";
							if(key == 0){
								active = "active";
							}

							var title = tab.title;

							if(tab.icon){
								title = \'<i class="fa \' + tab.icon + \'"></i> \' + tab.title;
							}
						#>
						<li class="{{ active }}"><a data-toggle="sppb-tab" href="#sppb-tab-{{ data.id }}{{ key }}">{{{ title }}}</a></li>
					<# }); #>
				</ul>
				<div class="sppb-tab-content sppb-nav-{{ data.style }}-content">
					<# _.each(data.sp_tab_item, function(tab, key){ #>
						<#
							var active = "";
							if(key == 0){
								active = "active in";
							}
						#>
						<div id="sppb-tab-{{ data.id }}{{ key }}" class="sppb-tab-pane sppb-fade {{ active }}">
							<#
							var htmlContent = "";
							_.each(tab.content, function(content){
								htmlContent += content;
							});
							#>
							{{{ htmlContent }}}
						</div>
					<# }); #>
				</div>
			</div>
		</div>
		';

		return $output;
	}

}
