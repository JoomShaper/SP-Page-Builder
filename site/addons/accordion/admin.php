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
		'type'=>'repeatable', 
		'addon_name'=>'sp_accordion',
		'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ACCORDION'),
		'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ACCORDION_DESC'),
		'attr'=>array(

			'admin_label'=>array(
					'type'=>'text', 
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL_DESC'),
					'std'=> ''
				),

			'title'=>array(
				'type'=>'text', 
				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_DESC'),
				'std'=>  ''
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

			'title_margin_top'=>array(
				'type'=>'number',
				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_MARGIN_TOP'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_MARGIN_TOP_DESC'),
				'placeholder'=>'10',
				),

			'title_margin_bottom'=>array(
				'type'=>'number',
				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_MARGIN_BOTTOM'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_MARGIN_BOTTOM_DESC'),
				'placeholder'=>'10',
				),	

			'style'=>array(
				'type'=>'select', 
				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ACCORDION_STYLE'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ACCORDION_STYLE_DESC'),
				'values'=> array( 
					'panel-default'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_DEFAULT'),
					'panel-primary'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_PRIMARY'),
					'panel-success'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_SUCCESS'),
					'panel-info'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_INFO'),
					'panel-warning'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_WARNING'),
					'panel-danger'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_DANGER'),
					),
				'std'=> ''
				),
			'class'=>array(
				'type'=>'text', 
				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CLASS'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_CLASS_DESC'),
				'std'=>''
				),
			'repetable_item'=>array(
				'type'=>'repeatable',
				'addon_name'=>'sp_accordion_item',
				'title'=>'Repetable', 
				'attr'=>array(
					'title'=>array(
						'type'=>'text', 
						'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ACCORDION_TITLE'),
						'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ACCORDION_TITLE_DESC'),
						'std'=>'Accordion Title',
						),
					'icon'=>array(
						'type'=>'icon', 
						'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ACCORDION_ICON'),
						'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ACCORDION_ICON_DESC'),
						'std'=> ''
						),
					'content'=>array(
						'type'=>'editor', 
						'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ACCORDION_CONTENT'),
						'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ACCORDION_CONTENT_DESC'),
						'std'=>'Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et.'
						),  
					)
				),  

			)

)
);

