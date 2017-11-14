<?php
/**
* @package SP Page Builder
* @author JoomShaper http://www.joomshaper.com
* @copyright Copyright (c) 2010 - 2016 JoomShaper
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('restricted aceess');

SpAddonsConfig::addonConfig(
	array(
		'type'=>'content',
		'addon_name'=>'sp_divider',
		'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_DIVIDER'),
		'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_DIVIDER_DESC'),
		'category'=>'General',
		'attr'=>array(
			'general' => array(
			'admin_label'=>array(
				'type'=>'text',
				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL_DESC'),
				'std'=> '',
			),

			'divider_type'=>array(
				'type'=>'select',
				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_DIVIDER_TYPE'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_DIVIDER_TYPE_DESC'),
				'values'=> array(
					'border'=>JText::_('COM_SPPAGEBUILDER_ADDON_DIVIDER_TYPE_BORDER'),
					'image'=>JText::_('COM_SPPAGEBUILDER_ADDON_DIVIDER_TYPE_IMAGE'),
				),
				'std'=>'border',
			),

			'divider_image'=>array(
				'type' => 'media',
				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_DIVIDER_IMAGE'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_DIVIDER_IMAGE_DESC'),
				'std' => '',
				'depends' => array('divider_type' => 'image'),
			),

			'background_repeat'=>array(
				'type'=>'select',
				'title'=>JText::_('COM_SPPAGEBUILDER_BG_REPEAT'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_BG_REPEAT_DESC'),
				'values'=>array(
					'no-repeat'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_NO_REPEAT'),
					'repeat'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_REPEAT_ALL'),
					'repeat-x'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_REPEAT_HORIZONTALLY'),
					'repeat-y'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_REPEAT_VERTICALLY'),
					'inherit'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_INHERIT'),
				),
				'std'=>'no-repeat',
				'depends' => array('divider_type' => 'image'),
			),

			'divider_height'=>array(
				'type' => 'number',
				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_DIVIDER_HEIGHT'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_DIVIDER_HEIGHT_DESC'),
				'std' => '10',
				'placeholder' => '10',
				'depends' => array('divider_type' => 'image'),
			),

			'border_style'=>array(
				'type'=>'select',
				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_DIVIDER_BORDER_STYLE'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_DIVIDER_BORDER_STYLE_DESC'),
				'values'=>array(
					'solid'=>JText::_('COM_SPPAGEBUILDER_ADDON_DIVIDER_BORDER_STYLE_SOLID'),
					'dashed'=>JText::_('COM_SPPAGEBUILDER_ADDON_DIVIDER_BORDER_STYLE_DASHED'),
					'dotted'=>JText::_('COM_SPPAGEBUILDER_ADDON_DIVIDER_BORDER_STYLE_DOTTED'),
				),
				'std'=>'solid',
				'depends' => array('divider_type' => 'border'),
			),

			'border_width'=>array(
				'type'=>'slider',
				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_DIVIDER_BORDER_WIDTH'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_DIVIDER_BORDER_WIDTH_DESC'),
				'std'=>'1',
				'depends' => array('divider_type' => 'border'),
			),

			'border_color'=>array(
				'type' => 'color',
				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_DIVIDER_BORDER_COLOR'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_DIVIDER_BORDER_COLOR_DESC'),
				'std' => '#cccccc',
				'depends' => array('divider_type' => 'border'),
			),

			'margin_top'=>array(
				'type' => 'slider',
				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_DIVIDER_MARGIN_TOP'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_DIVIDER_MARGIN_TOP_DESC'),
				'std' => array('md'=>30, 'sm'=>20, 'xs'=>10),
				'responsive' => true
			),

			'margin_bottom'=>array(
				'type' => 'slider',
				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_DIVIDER_MARGIN_BOTTOM'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_DIVIDER_MARGIN_BOTTOM_DESC'),
				'std' => array('md'=>30, 'sm'=>20, 'xs'=>10),
				'responsive' => true
			),

			'class'=>array(
				'type'=>'text',
				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CLASS'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_CLASS_DESC'),
				'std'=> ''
			),
		),
		)
	)
);
