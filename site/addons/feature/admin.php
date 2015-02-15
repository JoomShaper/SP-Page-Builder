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
		'addon_name'=>'sp_feature',
		'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_FEATURE_BOX'),
		'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_FEATURE_BOX_DESC'),
		'attr'=>array(
			'title'=>array(
				'type'=>'text', 
				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_DESC'),
				'std'=>  'Feature Box'
				),

			'heading_selector'=>array(
				'type'=>'select', 
				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_HEADINGS'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_HEADINGS_DESC'),
				'values'=>array(
					'h1'=>JText::_('COM_SPPAGEBUILDER_ADDON_HEADINGS_H1'),
					'h2'=>JText::_('COM_SPPAGEBUILDER_ADDON_HEADINGS_H2'),
					'h3'=>JText::_('COM_SPPAGEBUILDER_ADDON_HEADINGS_H3'),
					'h4'=>JText::_('COM_SPPAGEBUILDER_ADDON_HEADINGS_H4'),
					'h5'=>JText::_('COM_SPPAGEBUILDER_ADDON_HEADINGS_H5'),
					'h6'=>JText::_('COM_SPPAGEBUILDER_ADDON_HEADINGS_H6'),
					),
				'std'=>'h3',
			),

			'title_fontsize'=>array(
				'type'=>'number', 
				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_FONT_SIZE'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_FONT_SIZE_DESC'),
				'std'=>''
				),

			'title_fontweight'=>array(
				'type'=>'text', 
				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_FONT_WEIGHT'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_FONT_WEIGHT_DESC'),
				'std'=>''
				),

			'title_text_color'=>array(
				'type'=>'color',
				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_TEXT_COLOR'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_TEXT_COLOR_DESC'),
				),

			'title_position'=>array(
				'type'=>'select',
				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_FEATURE_BOX_ICON_IMAGE_POSITION'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_FEATURE_BOX_ICON_IMAGE_POSITION_DESC'),
				'values'=>array(
					'after'=>JText::_('COM_SPPAGEBUILDER_ADDON_FEATURE_BOX_TITLE_POSITION_BEFORE_TITLE'),
					'before'=>JText::_('COM_SPPAGEBUILDER_ADDON_FEATURE_BOX_TITLE_POSITION_AFTER_TITLE'),
					'left'=>JText::_('COM_SPPAGEBUILDER_ADDON_FEATURE_BOX_TITLE_POSITION_LEFT'),
					'right'=>JText::_('COM_SPPAGEBUILDER_ADDON_FEATURE_BOX_TITLE_POSITION_RIGHT'),
					),
				'std'=>'before'
				),

			'feature_type'=>array(
				'type'=>'select',
				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_FEATURE_LAYOUT_TYPE'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_FEATURE_LAYOUT_TYPE_DESC'),
				'values'=> array(
					'icon'=>JText::_('COM_SPPAGEBUILDER_ADDON_FEATURE_LAYOUT_TYPE_ICON'),
					'image'=>JText::_('COM_SPPAGEBUILDER_ADDON_FEATURE_LAYOUT_TYPE_IMAGE'),
					),
				'std' => 'icon'
				),

			'feature_image'=>array(
				'type' => 'media',
				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_FEATURE_IMAGE'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_FEATURE_IMAGE_DESC'),
				'std' => ''
				),

			'icon_name'=>array(
				'type'=>'icon', 
				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_ICON_NAME'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_ICON_NAME_DESC'),
				'std'=> ''
				),

			'icon_size'=>array(
				'type'=>'number',
				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_ICON_SIZE'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_ICON_SIZE_DESC'),
				'placeholder'=>36,
				'std'=>36,
				),

			'icon_color'=>array(
				'type'=>'color',
				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_COLOR'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_COLOR_DESC'),
				),

			'icon_background'=>array(
				'type'=>'color',
				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_BACKGROUND'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_BACKGROUND_DESC'),
				),

			'icon_border_color'=>array(
				'type'=>'color',
				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_BORDER_COLOR'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_BORDER_COLOR_DESC'),
				),

			'icon_border_width'=>array(
				'type'=>'number',
				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_BORDER_WIDTH_SIZE'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_BORDER_WIDTH_SIZE_DESC'),
				'placeholder'=>'3',
				),

			'icon_border_radius'=>array(
				'type'=>'number',
				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_BORDER_RADIUS'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_BORDER_RADIUS_DESC'),
				'placeholder'=>'5',
				),

			'icon_margin_top'=>array(
				'type'=>'number',
				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_MARGIN_TOP'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_MARGIN_TOP_DESC'),
				'placeholder'=>'10',
				),

			'icon_margin_bottom'=>array(
				'type'=>'number',
				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_MARGIN_BOTTOM'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_MARGIN_BOTTOM_DESC'),
				'placeholder'=>'10',
				),				

			'icon_padding'=>array(
				'type'=>'number',
				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_PADDING'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_PADDING_DESC'),
				'placeholder'=>'20',
				),

			'text'=>array(
				'type'=>'editor', 
				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_FEATURE_BOX_TEXT'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_FEATURE_BOX_TEXT_DESC'),
				'std'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer adipiscing erat eget risus sollicitudin pellentesque et non erat. Maecenas nibh dolor, malesuada et bibendum a, sagittis accumsan ipsum.'
				),

			'alignment'=>array(
				'type'=>'select',
				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_CONTENT_ALIGNMENT'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_CONTENT_ALIGNMENT_DESC'),
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