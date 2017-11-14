<?php
defined('_JEXEC') or die();

$media = '';
$item = $displayData['media'];
$ext = JFile::getExt($item->path);
$app = JFactory::getApplication();
$support = $app->input->post->get('support', 'image', 'STRING');

$innerHTML = false;
if(isset($displayData['innerHTML']) && $displayData['innerHTML']) {
	$innerHTML = true;
}

if(isset($displayData['support']) && $displayData['support']) {
	$support = $displayData['support'];
}

if(!$innerHTML) {
	$class = ' sp-pagebuilder-media-unsupported';
	if($support == $item->type) {
		$class = ' sp-pagebuilder-media-supported';
	}

	if($support == 'all') {
		$class = ' sp-pagebuilder-media-supported';
	}
	$media .= '<li class="sp-pagebuilder-media-item' . $class . ' sp-pagebuilder-media-type-' . $item->type . '" data-id="' . $item->id . '" data-type="' . $item->type . '" data-src="'. JURI::root(true) . '/' . $item->path .'" data-path="'. $item->path .'">';
}

if($item->type == 'image') {
	$media .= '<div>';
	$media .= '<div>';
	$media .= '<div>';
	$media .= '<div>';
	if(isset($item->thumb) && $item->thumb) {
		$media .= '<img src="'. JURI::root(true) . '/' . $item->thumb .'">';
	} else {
		$media .= '<img src="'. JURI::root(true) . '/' . $item->path .'">';
	}
	$media .= '</div>';
	$media .= '</div>';
	$media .= '</div>';
	$media .= '<span class="sp-pagebuilder-media-title"><span><i class="fa fa-picture-o"></i> ' . $item->title . '.' . $ext .'</span></span>';
	$media .= '</div>';
} else {

	if($item->type == 'video') {
		$media .= '<div>';
		$media .= '<div>';
		$media .= '<div>';
		$media .= '<div>';
		$media .= '<div>';
		$media .= '<div class="sp-pagebuilder-media-video">';
		$media .= '<i class="fa fa-film"></i>';
		//$media .= '<span>' . $ext . '</span>';
		$media .= '</div>';
		$media .= '</div>';
		$media .= '</div>';
		$media .= '</div>';
		$media .= '</div>';
		$media .= '<span class="sp-pagebuilder-media-title"><span><i class="fa fa-film"></i> ' . $item->title . '.' . $ext .'</span></span>';
		$media .= '</div>';
	} else if ($item->type == 'audio') {
		$media .= '<div>';
		$media .= '<div>';
		$media .= '<div>';
		$media .= '<div>';
		$media .= '<div>';
		$media .= '<div class="sp-pagebuilder-media-audio">';
		$media .= '<i class="fa fa-music"></i>';
		//$media .= '<span>' . $ext . '</span>';
		$media .= '</div>';
		$media .= '</div>';
		$media .= '</div>';
		$media .= '</div>';
		$media .= '</div>';
		$media .= '<span class="sp-pagebuilder-media-title"><span><i class="fa fa-music"></i> ' . $item->title . '.' . $ext .'</span></span>';
		$media .= '</div>';
	} else if ($item->type == 'attachment') {

		if(($ext == 'doc') || ($ext == 'docx') || ($ext == 'odt')) {
			$media .= '<div>';
			$media .= '<div>';
			$media .= '<div>';
			$media .= '<div>';
			$media .= '<div>';
			$media .= '<div class="sp-pagebuilder-media-attachment-document">';
			$media .= '<i class="fa fa-file-word-o"></i>';
			$media .= '</div>';
			$media .= '</div>';
			$media .= '</div>';
			$media .= '</div>';
			$media .= '</div>';
			$media .= '<span class="sp-pagebuilder-media-title"><span><i class="fa fa-file-word-o"></i> ' . $item->title . '.' . $ext .'</span></span>';
			$media .= '</div>';
		} elseif(($ext == 'key') || ($ext == 'ppt') || ($ext == 'pptx') || ($ext == 'pps') || ($ext == 'ppsx')) {
			$media .= '<div>';
			$media .= '<div>';
			$media .= '<div>';
			$media .= '<div>';
			$media .= '<div>';
			$media .= '<div class="sp-pagebuilder-media-attachment-presentation">';
			$media .= '<i class="fa fa-file-powerpoint-o"></i>';
			$media .= '</div>';
			$media .= '</div>';
			$media .= '</div>';
			$media .= '</div>';
			$media .= '</div>';
			$media .= '<span class="sp-pagebuilder-media-title"><span><i class="fa fa-file-powerpoint-o"></i> ' . $item->title . '.' . $ext .'</span></span>';
			$media .= '</div>';
		} elseif(($ext == 'xls') || ($ext == 'xlsx')) {
			$media .= '<div>';
			$media .= '<div>';
			$media .= '<div>';
			$media .= '<div>';
			$media .= '<div>';
			$media .= '<div class="sp-pagebuilder-media-attachment-excel">';
			$media .= '<i class="fa fa-file-excel-o"></i>';
			$media .= '</div>';
			$media .= '</div>';
			$media .= '</div>';
			$media .= '</div>';
			$media .= '</div>';
			$media .= '<span class="sp-pagebuilder-media-title"><span><i class="fa fa-file-excel-o"></i> ' . $item->title . '.' . $ext .'</span></span>';
			$media .= '</div>';
		} elseif(($ext == 'pdf')) {
			$media .= '<div>';
			$media .= '<div>';
			$media .= '<div>';
			$media .= '<div>';
			$media .= '<div>';
			$media .= '<div class="sp-pagebuilder-media-attachment-pdf">';
			$media .= '<i class="fa fa-file-pdf-o"></i>';
			$media .= '</div>';
			$media .= '</div>';
			$media .= '</div>';
			$media .= '</div>';
			$media .= '</div>';
			$media .= '<span class="sp-pagebuilder-media-title"><span><i class="fa fa-file-pdf-o"></i> ' . $item->title . '.' . $ext .'</span></span>';
			$media .= '</div>';
		} elseif(($ext == 'zip')) {
			$media .= '<div>';
			$media .= '<div>';
			$media .= '<div>';
			$media .= '<div>';
			$media .= '<div>';
			$media .= '<div class="sp-pagebuilder-media-attachment-zip">';
			$media .= '<i class="fa fa-file-archive-o"></i>';
			$media .= '</div>';
			$media .= '</div>';
			$media .= '</div>';
			$media .= '</div>';
			$media .= '</div>';
			$media .= '<span class="sp-pagebuilder-media-title"><span><i class="fa fa-file-archive-o"></i> ' . $item->title . '.' . $ext .'</span></span>';
			$media .= '</div>';
		}
	}
}

if(!$innerHTML) {
	$media .= '</li>';
}

echo $media;
