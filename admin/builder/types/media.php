<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2016 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('restricted aceess');

class SpTypeMedia
{

	static function getInput($key, $attr)
	{

		JText::script('COM_SPPAGEBUILDER_MEDIA_MANAGER');
		JText::script('COM_SPPAGEBUILDER_MEDIA_MANAGER_UPLOAD_FILE');
		JText::script('COM_SPPAGEBUILDER_MEDIA_MANAGER_CLOSE');
		JText::script('COM_SPPAGEBUILDER_MEDIA_MANAGER_INSERT');
		JText::script('COM_SPPAGEBUILDER_MEDIA_MANAGER_SEARCH');
		JText::script('COM_SPPAGEBUILDER_MEDIA_MANAGER_CANCEL');
		JText::script('COM_SPPAGEBUILDER_MEDIA_MANAGER_DELETE');
		JText::script('COM_SPPAGEBUILDER_MEDIA_MANAGER_CONFIRM_DELETE');
		JText::script('COM_SPPAGEBUILDER_MEDIA_MANAGER_LOAD_MORE');
		JText::script('COM_SPPAGEBUILDER_MEDIA_MANAGER_UNSUPPORTED_FORMAT');
		JText::script('COM_SPPAGEBUILDER_MEDIA_MANAGER_BROWSE_MEDIA');
		JText::script('COM_SPPAGEBUILDER_MEDIA_MANAGER_BROWSE_FOLDERS');

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
		
		if($attr['std']) {
			$output .= '<img class="sppb-media-preview" src="' . JURI::root(true) . '/' . $attr['std'] . '" alt="" />';
		} else {
			$output .= '<img class="sppb-media-preview no-image" alt="" />';
		}

		$output .= '<input type="hidden" data-attrname="'.$key.'" class="input-media sppb-media-input addon-input" value="'.$attr['std'].'">';
		$output .= '<a href="#" class="sppb-btn sppb-btn-primary sppb-btn-media-manager">'. JText::_('COM_SPPAGEBUILDER_MEDIA_MANAGER_SELECT') .'</a>';
		$output .= ' <a class="sppb-btn sppb-btn-danger btn-clear-image" href="#"><i class="icon-remove"></i></a>';

		if( ( isset($attr['desc']) ) && ( isset($attr['desc']) != '' ) )
		{
			$output .= '<p class="help-block">' . $attr['desc'] . '</p>';
		}

		$output .= '</div>';

		return $output;

	}
}