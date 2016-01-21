<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2016 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined('_JEXEC') or die ('restricted aceess');


$report['output'] 		= '';

// Date Filter
if(count($this->filters)) {
	$report['date_filter'] = '<select class="sppb-date-filter">';
	$report['date_filter'] .= '<option value="">'. JText::_('COM_SPPAGEBUILDER_MEDIA_MANAGER_MEDIA_ALL') .'</option>';

	foreach ($this->filters as $key => $this->filter) {
		$report['date_filter'] .= '<option value="'. $this->filter->year . '-' . $this->filter->month .'">'. JHtml::_('date', $this->filter->year . '-' . $this->filter->month, 'F Y') .'</option>';
	}

	$report['date_filter'] .= '</select>';
} else {
	$report['date_filter'] = '<select class="date-filter">';
	$report['date_filter'] .= '<option value="">'. JText::_('COM_SPPAGEBUILDER_MEDIA_MANAGER_MEDIA_ALL') .'</option>';
	$report['date_filter'] .= '</select>';
}

// Load More
if($this->total > ($this->limit + $this->start)) {
	$report['loadmore'] 	= true;
} else {
	$report['loadmore'] 	= false;	
}


// Media Items
if(!$this->start) $report['output'] .= '<ul class="sppb-media">';

if(count($this->items)) {
	foreach ($this->items as $key => $this->item) {
		$report['output'] .= '<li class="sppb-media-item" data-id="' . $this->item->id . '" data-src="'. JURI::root(true) . '/' . $this->item->path .'" data-path="'. $this->item->path .'">';
		$report['output'] .= '<div>';
		$report['output'] .= '<div>';
		$report['output'] .= '<div class="sppb-media-image">';

		if(isset($this->item->thumb) && $this->item->thumb) {
			$report['output'] .= '<img src="'. JURI::root(true) . '/' . $this->item->thumb .'">';
		} else {
			$report['output'] .= '<img src="'. JURI::root(true) . '/' . $this->item->path .'">';
		}
		
		$report['output'] .= '<span class="sppb-media-title">' . $this->item->title .'</span>';
		$report['output'] .= '</div>';
		$report['output'] .= '</div>';
		$report['output'] .= '</div>';
		$report['output'] .= '</div>';
		$report['output'] .= '</li>';
	}
}

if(!$this->start) $report['output'] .= '</ul>';

echo json_encode($report);

die;