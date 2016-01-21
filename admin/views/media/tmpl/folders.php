<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2016 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined('_JEXEC') or die ('restricted aceess');

$input 	= JFactory::getApplication()->input;
$path 	= $input->post->get('path', '/images', 'PATH');

$report = array();
$media = $this->media;

$report['output'] 	= '';

$tree = '<select class="sppb-folder-filter">';
$tree .= '<option value="/images">/images</option>';
foreach ( $media['folders'] as $folder ) {
	$tree .= '<option value="'. str_replace('\\', '/', $folder['relname']) .'">'. str_replace('\\', '/', $folder['relname']) .'</option>';
}
$tree .= '</select>';
$report['folders_tree'] = $tree; // End folders tree

$report['output'] .= '<ul class="sppb-media">';

// Folders List
if(dirname($path) != '/') {
	$report['output'] .= '<li class="sppb-media-folder">';
	$report['output'] .= '<div>';
	$report['output'] .= '<div>';
	$report['output'] .= '<div class="sppb-media-image">';
	$report['output'] .= '<div class="media-folder-warpper no-margin">';
	$report['output'] .= '<i class="fa fa-arrow-left to-folder-back fa-4x" data-path="'. dirname($path) .'"></i>';
	$report['output'] .= '</div>';
	$report['output'] .= '</div>';
	$report['output'] .= '</div>';
	$report['output'] .= '</div>';
	$report['output'] .= '</li>';
}

if(isset($media['folders_list']) && count($media['folders_list'])) {
	foreach ($media['folders_list'] as $single_folder) {
		$report['output'] .= '<li class="sppb-media-folder">';
		$report['output'] .= '<div>';
		$report['output'] .= '<div>';
		$report['output'] .= '<div class="sppb-media-image">';
		$report['output'] .= '<span class="sppb-media-title">' . $single_folder .'</span>';
		$report['output'] .= '<div class="media-folder-warpper">';
		$report['output'] .= '<i class="fa fa-folder to-folder fa-4x" data-path="'. $path . '/' . $single_folder .'"></i>';
		$report['output'] .= '</div>';
		$report['output'] .= '</div>';
		$report['output'] .= '</div>';
		$report['output'] .= '</div>';
		$report['output'] .= '</li>';
	}
}

if(isset($media['images']) && count($media['images'])) {
	foreach ($media['images'] as $image) {

		$image = str_replace('\\', '/',$image);
		$root_path = str_replace('\\', '/', JPATH_ROOT);
		$path = str_replace($root_path . '/', '', $image);
		
		$title = JFile::stripExt(basename($image));
		$report['output'] .= '<li class="sppb-media-item" data-src="'. JURI::root(true) . '/' . $path .'" data-path="'. $path .'">';
		$report['output'] .= '<div>';
		$report['output'] .= '<div>';
		$report['output'] .= '<div class="sppb-media-image">';

		$thumb = dirname($path) . '/_sppb_thumbs/' . basename($path);

		if(file_exists(JPATH_ROOT . '/' . $thumb)) {
			$report['output'] .= '<img src="'. JURI::root(true) . '/' . $thumb .'">';
		} else {	
			$report['output'] .= '<img src="'. JURI::root(true) . '/' . $path .'">';
		}
		
		$report['output'] .= '<span class="sppb-media-title">' . $title .'</span>';
		$report['output'] .= '</div>';
		$report['output'] .= '</div>';
		$report['output'] .= '</div>';
		$report['output'] .= '</div>';
		$report['output'] .= '</li>';
	}
}

$report['output'] .= '</ul>';
echo json_encode($report);

die;