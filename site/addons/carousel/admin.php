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
		'addon_name'=>'sp_carousel',
		'category'=>'Slider',
		'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL'),
		'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_DESC'),
		'attr'=>array(
			'admin_label'=>array(
					'type'=>'text', 
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL_DESC'),
					'std'=> ''
				),
			'autoplay'=>array(
				'type'=>'select', 
				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_AUTOPLAY'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_AUTOPLAY_DESC'),
				'values'=>array(
					1=>JText::_('JYES'),
					0=>JText::_('JNO'),
					),
				'std'=>1,
				),
			'controllers'=>array(
				'type'=>'select', 
				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_SHOW_CONTROLLERS'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_SHOW_CONTROLLERS_DESC'),
				'values'=>array(
					1=>JText::_('JYES'),
					0=>JText::_('JNO'),
					),
				'std'=>1,
				),
			'arrows'=>array(
				'type'=>'select', 
				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_SHOW_ARROWS'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_SHOW_ARROWS_DESC'),
				'values'=>array(
					1=>JText::_('JYES'),
					0=>JText::_('JNO'),
					),
				'std'=>1,
				),
			'background'=>array(
				'type'=>'color', 
				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_BACKGROUND_COLOR'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_BACKGROUND_COLOR_DESC'),
				),
			'color'=>array(
				'type'=>'color', 
				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_FONT_COLOR'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_FONT_COLOR_DESC'),
				),
			'alignment'=>array(
				'type'=>'select',
				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_CONTENT_ALIGNMENT'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_CONTENT_ALIGNMENT_DESC'),
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
			'repetable_item'=>array(
				'type'=>'repeatable',
				'addon_name' =>'sp_carousel_item',
				'title'=> 'Repetable', 
				'attr'=>  array(
					'title'=>array(
						'type'=>'text', 
						'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_ITEM_TITLE'),
						'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_ITEM_TITLE_DESC'),
						'std'=>'Carousel Item Title',
						),
					'content'=>array(
						'type'=>'editor', 
						'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_ITEM_CONTENT'),
						'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_ITEM_CONTENT_DESC'),
						'std'=> 'Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et.'
						),
					'bg'=>array(
						'type'=>'media', 
						'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_ITEM_BACKGROUND_IMAGE'),
						'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_ITEM_BACKGROUND_IMAGE_DESC'),
						),
					'button_text'=>array(
						'type'=>'text', 
						'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_BUTTON_TEXT'),
						'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_BUTTON_TEXT_DESC'),
						),
					'button_url'=>array(
						'type'=>'text', 
						'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_BUTTON_URL'),
						'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_BUTTON_URL_DESC'),
						),
					'button_size'=>array(
						'type'=>'select', 
						'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_BUTTON_SIZE'),
						'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_BUTTON_SIZE_DESC'),
						'values'=>array(
							''=>JText::_('COM_SPPAGEBUILDER_ADDON_BUTTON_SIZE_DEFAULT'),
							'lg'=>JText::_('COM_SPPAGEBUILDER_ADDON_BUTTON_SIZE_LARGE'),
							'sm'=>JText::_('COM_SPPAGEBUILDER_ADDON_BUTTON_SIZE_SMALL'),
							'xs'=>JText::_('COM_SPPAGEBUILDER_ADDON_BUTTON_SIZE_EXTRA_SAMLL'),
							),
						),
					'button_type'=>array(
						'type'=>'select', 
						'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_BUTTON_TYPE'),
						'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_BUTTON_TYPE_DESC'),
						'values'=>array(
							'default'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_DEFAULT'),
							'primary'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_PRIMARY'),
							'success'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_SUCCESS'),
							'info'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_INFO'),
							'warning'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_WARNING'),
							'danger'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_DANGER'),
							'link'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_LINK'),
							),
						'std'=>'default',
						),

					'button_icon'=>array(
						'type'=>'icon', 
						'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_BUTTON_ICON'),
						'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_BUTTON_ICON_DESC'),
						),
					)
				),

			)

	)
);

