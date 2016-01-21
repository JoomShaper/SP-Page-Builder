<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2016 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('restricted aceess');

jimport('joomla.form.formfield');

class JFormFieldSpmedia extends JFormField
{
	protected $type = 'Spmedia';

	protected function getInput() {

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

		JHtml::_('jquery.framework');

		$doc = JFactory::getDocument();
		$doc->addScript( JURI::base(true) . '/components/com_sppagebuilder/assets/js/media.js' );

		if($this->value) {
			$html = '<img class="sppb-media-preview" src="' . JURI::root(true) . '/' . $this->value . '" alt="" />';
		} else {
			$html  = '<img class="sppb-media-preview no-image" alt="">';
		}
		
		$html .= '<input class="sp-media-input" type="hidden" name="'. $this->name .'" id="'. $this->id .'" value="'. $this->value .'">';
		$html .= '<a href="#" class="btn btn-primary sppb-btn-media-manager" data-id="' . $this->id . '"><i class="fa fa-picture-o"></i> '. JText::_('COM_SPPAGEBUILDER_MEDIA_MANAGER_SELECT') .'</a> <a href="#" class="btn btn-danger btn-clear-image"><i class="fa fa-times"></i></a>';		

		return $html;
	}
}
