<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2016 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('restricted aceess');

class SppagebuilderAddonVideo extends SppagebuilderAddons {

	public function render() {

		$class = (isset($this->addon->settings->class) && $this->addon->settings->class) ? $this->addon->settings->class : '';
		$title = (isset($this->addon->settings->title) && $this->addon->settings->title) ? $this->addon->settings->title : '';
		$heading_selector = (isset($this->addon->settings->heading_selector) && $this->addon->settings->heading_selector) ? $this->addon->settings->heading_selector : 'h3';

		//Options
		$url = (isset($this->addon->settings->url) && $this->addon->settings->url) ? $this->addon->settings->url : '';

		//Output
		if($url) {
			$video = parse_url($url);

			switch($video['host']) {
				case 'youtu.be':
				$id = trim($video['path'],'/');
				$src = '//www.youtube.com/embed/' . $id;
				break;

				case 'www.youtube.com':
				case 'youtube.com':
				parse_str($video['query'], $query);
				$id = $query['v'];
				$src = '//www.youtube.com/embed/' . $id;
				break;

				case 'vimeo.com':
				case 'www.vimeo.com':
				$id = trim($video['path'],'/');
				$src = "//player.vimeo.com/video/{$id}";
			}

			$output  = '<div class="sppb-addon sppb-addon-video ' . $class . '">';
			$output .= ($title) ? '<'.$heading_selector.' class="sppb-addon-title">' . $title . '</'.$heading_selector.'>' : '';
			$output .= '<div class="sppb-video-block sppb-embed-responsive sppb-embed-responsive-16by9">';
			$output .= '<iframe class="sppb-embed-responsive-item" src="' . $src . '" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
			$output .= '</div>';
			$output .= '</div>';

			return $output;

		}

		return;

	}

	public static function getTemplate() {

		$output = '

			<#
				let videoUrl = data.url || ""
				let embedSrc = ""

				if ( videoUrl ) {
					let tempAchor = document.createElement("a")
							tempAchor.href = videoUrl

					let videoObj = {
					        host    :   tempAchor.hostname,
					        path    :   tempAchor.pathname,
					        query   :   tempAchor.search.substr(tempAchor.search.indexOf("?") + 1)
						  }

					switch( videoObj.host ){
						case "youtu.be":
							var videoId = videoObj.path.trim();
									embedSrc = "//www.youtube.com/embed"+ videoId
							break;

						case "www.youtube.com":
						case "youtube.com":
							var queryStr = videoObj.query.split("=");
									embedSrc = "//www.youtube.com/embed/"+ queryStr[1]
							break;

						case "www.vimeo.com":
						case "vimeo.com":
							var videoId = videoObj.path.trim();
									embedSrc = "//player.vimeo.com/video"+ videoId
							break;
					}
				}
			#>

	 		<div class="sppb-addon sppb-addon-video {{ data.class }}">
		 		<# if( !_.isEmpty( data.title ) ){ #><{{ data.heading_selector }} class="sppb-addon-title">{{{ data.title }}}</{{ data.heading_selector }}><# } #>
				<div class="sppb-iframe-drag-overlay"></div>
		 		<div class="sppb-video-block sppb-embed-responsive sppb-embed-responsive-16by9">
					<# if(embedSrc){ #>
		 			<iframe class="sppb-embed-responsive-item" src=\'{{ embedSrc }}\' webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
					<# } #>
		 		</div>
	 		</div>
		';

		return $output;
 }
}
