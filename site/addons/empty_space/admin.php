<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2015 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('resticted aceess');

SpAddonsConfig::addonConfig(
	array( 
		'type'=>'content', 
		'addon_name'=>'sp_empty_space',
		'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_EMPTY_SPACE'),
		'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_EMPTY_SPACE_DESC'),
		'attr'=>array(
			'gap'=>array(
				'type'=>'number', 
				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_EMPTY_SPACE_GAP'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_EMPTY_SPACE_GAP_DESC'),
				'std'=>'20'
				),

			'hidden_md'=>array(
				'type'=>'select', 
				'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_HIDDDEN_MD'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_HIDDDEN_MD_DESC'),
				'values'=>array(
					'1'=>JText::_('COM_SPPAGEBUILDER_YES'),
					'0'=>JText::_('COM_SPPAGEBUILDER_NO'),
					),
				'std'=>'0',
				),

			'hidden_sm'=>array(
				'type'=>'select', 
				'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_HIDDDEN_SM'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_HIDDDEN_SM_DESC'),
				'values'=>array(
					'1'=>JText::_('COM_SPPAGEBUILDER_YES'),
					'0'=>JText::_('COM_SPPAGEBUILDER_NO'),
					),
				'std'=>'0',
				),

			'hidden_xs'=>array(
				'type'=>'select', 
				'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_HIDDDEN_XS'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_HIDDDEN_XS_DESC'),
				'values'=>array(
					'1'=>JText::_('COM_SPPAGEBUILDER_YES'),
					'0'=>JText::_('COM_SPPAGEBUILDER_NO'),
					),
				'std'=>'0',
				),

			'class'=>array(
				'type'=>'text', 
				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CLASS'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_CLASS_DESC'),
				'std'=> ''
				),
			)

		)
	);