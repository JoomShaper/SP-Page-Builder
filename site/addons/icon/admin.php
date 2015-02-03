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
		'addon_name'=>'sp_icon',
		'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ICON'),
		'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ICON_DESC'),
		'attr'=>array(

			'name'=>array(
				'type'=>'icon', 
				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_ICON_NAME'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_ICON_NAME_DESC'),
				'std'=> ''
				),

			'size'=>array(
				'type'=>'number',
				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_ICON_SIZE'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_ICON_SIZE_DESC'),
				'placeholder'=>36,
				'std'=>36,
				),

			'color'=>array(
				'type'=>'color',
				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_COLOR'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_COLOR_DESC'),
				),

			'background'=>array(
				'type'=>'color',
				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_BACKGROUND'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_BACKGROUND_DESC'),
				),

			'border_color'=>array(
				'type'=>'color',
				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_BORDER_COLOR'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_BORDER_COLOR_DESC'),
				),

			'border_width'=>array(
				'type'=>'number',
				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_BORDER_WIDTH_SIZE'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_BORDER_WIDTH_SIZE_DESC'),
				'placeholder'=>'3',
				),

			'border_radius'=>array(
				'type'=>'number',
				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_BORDER_RADIUS'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_BORDER_RADIUS_DESC'),
				'placeholder'=>'5',
				),

			'margin_top'=>array(
				'type'=>'number',
				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_MARGIN_TOP'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_MARGIN_TOP_DESC'),
				'placeholder'=>'10',
				),

			'margin_bottom'=>array(
				'type'=>'number',
				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_MARGIN_BOTTOM'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_MARGIN_BOTTOM_DESC'),
				'placeholder'=>'10',
				),				

			'padding'=>array(
				'type'=>'number',
				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_PADDING'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_PADDING_DESC'),
				'placeholder'=>'20',
				),

			'alignment'=>array(
				'type'=>'select',
				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ICON_ALIGNMENT'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ICON_ALIGNMENT_DESC'),
				'values'=>array(
					'sppb-text-left'=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_LEFT'),
					'sppb-text-center'=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_CENTER'),
					'sppb-text-right'=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_RIGHT'),
					),
				'std'=>'sppb-text-center',
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