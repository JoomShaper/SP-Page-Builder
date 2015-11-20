<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2015 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('restricted aceess');

class SpTypeMedia
{

	static function getInput($key, $attr)
	{

		if(!isset($attr['std'])){
			$attr['std'] = '';
		}

		if($attr['std']!='') {
			$src = 'src="' . JURI::root() .  $attr['std'] . '"';
		} else {
			$src = '';
		}

		// Depend
		$depend_data = '';
		if(isset($attr['depends'])) {
			$depends = $attr['depends'];
			foreach ($depends as $selector => $value) {
				$depend_data .= ' data-group_parent="' . $selector . '" data-depend="' . $value . '"';
			}
		}

		JHtml::_('jquery.framework');

		$doc = JFactory::getDocument();
		$doc->addScript( JURI::base(true) . '/components/com_sppagebuilder/assets/js/media.js' );
		
		$output  = '<div class="form-group"' . $depend_data . '>';
		$output .= '<label>' . $attr['title'] . '</label>';
		$output .= '<div class="media">';

		$output .= '<div class="media-preview">';
		$output .= '<div class="image-preview">';
		$output .= '<img ' . $src . ' alt="" height="100px">';
		$output .= '</div>';
		$output .= '</div>';

		$output .= '<input type="hidden" data-attrname="'.$key.'" class="input-media addon-input" value="'.$attr['std'].'">';
		$output .= '<a href="#" class="sppb-btn sppb-btn-primary sppb-btn-media">'. JText::_('COM_SPPAGEBUILDER_TYPE_MEDIA_SELECT') .'</a>';
		$output .= ' <a class="sppb-btn sppb-btn-danger remove-media" href="#"><i class="icon-remove"></i></a>';
		$output .= '</div>';

		if( ( isset($attr['desc']) ) && ( isset($attr['desc']) != '' ) )
		{
			$output .= '<p class="help-block">' . $attr['desc'] . '</p>';
		}

		$output .= '</div>';

		return $output;

	}
}