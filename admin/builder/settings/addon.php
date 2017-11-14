<?php
/**
* @package SP Page Builder
* @author JoomShaper http://www.joomshaper.com
* @copyright Copyright (c) 2010 - 2017 JoomShaper
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('restricted aceess');

$addon_global_settings = array(
	'style' => array(
		'global_options'=>array(
			'type'=>'separator',
			'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_OPTIONS'),
		),
		'global_text_color'=>array(
			'type'=>'color',
			'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_TEXT_COLOR')
		),
		'global_link_color'=>array(
			'type'=>'color',
			'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_LINK_COLOR'),
		),
		'global_link_hover_color'=>array(
			'type'=>'color',
			'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_LINK_COLOR_HOVER'),
		),
		'global_use_background'=>array(
			'type'=>'checkbox',
			'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_ENABLE_BACKGROUND_OPTIONS'),
			'std'=>0
		),
		'global_background_color'=>array(
			'type'=>'color',
			'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_COLOR'),
			'depends'=>array('global_use_background'=>1)
		),
		'global_background_image'=>array(
			'type'=>'media',
			'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_IMAGE'),
			'depends'=>array('global_use_background'=>1)
		),
		'global_use_overlay'=>array(
			'type'=>'checkbox',
			'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_ENABLE_BACKGROUND_OVERLAY'),
			'std'=>0,
			'depends'=>array(
				array('global_use_background', '=', 1)
			)
		),
		'global_background_overlay'=>array(
			'type'=>'color',
			'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_OVERLAY'),
			'depends'=>array(
				array('global_use_background', '=', 1),
				array('global_use_overlay', '=', 1)
			)
		),
		'global_background_repeat'=>array(
			'type'=>'select',
			'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_REPEAT'),
			'values'=>array(
				'no-repeat'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_NO_REPEAT'),
				'repeat-all'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_REPEAT_ALL'),
				'repeat-horizontally'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_REPEAT_HORIZONTALLY'),
				'repeat-vertically'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_REPEAT_VERTICALLY'),
				'inherit'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_INHERIT'),
			),
			'std'=>'no-repeat',
			'depends'=>array(
				array('global_use_background', '=', 1),
				array('global_background_image', '!=', '')
			)
		),
		'global_background_size'=>array(
			'type'=>'select',
			'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_SIZE'),
			'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_SIZE_DESC'),
			'values'=>array(
				'cover'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_SIZE_COVER'),
				'contain'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_SIZE_CONTAIN'),
				'inherit'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_INHERIT'),
			),
			'std'=>'cover',
			'depends'=>array(
				array('global_use_background', '=', 1),
				array('global_background_image', '!=', '')
			)
		),
		'global_background_attachment'=>array(
			'type'=>'select',
			'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_ATTACHMENT'),
			'values'=>array(
				'fixed'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_ATTACHMENT_FIXED'),
				'scroll'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_ATTACHMENT_SCROLL'),
				'inherit'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_INHERIT'),
			),
			'std'=>'inherit',
			'depends'=>array(
				array('global_use_background', '=', 1),
				array('global_background_image', '!=', '')
			)
		),
		'global_user_border'=>array(
			'type'=>'checkbox',
			'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_USE_BORDER'),
			'std'=>0
		),
		'global_border_width'=>array(
			'type'=>'slider',
			'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_WIDTH'),
			'std'=>'',
			'depends'=>array('global_user_border'=>1),
			'responsive'=> true
		),
		'global_border_color'=>array(
			'type'=>'color',
			'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_COLOR'),
			'depends'=>array('global_user_border'=>1)
		),
		'global_boder_style'=>array(
			'type'=>'select',
			'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_STYLE'),
			'values'=>array(
				'none'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_STYLE_NONE'),
				'solid'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_STYLE_SOLID'),
				'double'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_STYLE_DOUBLE'),
				'dotted'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_STYLE_DOTTED'),
				'dashed'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_STYLE_DASHED'),
			),
			'depends'=>array('global_user_border'=>1)
		),
		'global_border_radius'=>array(
			'type'=>'slider',
			'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_RADIUS'),
			'std'=>0,
			'max'=>500,
			'responsive'=> true
		),
		'global_margin'=>array(
			'type'=>'margin',
			'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_MARGIN'),
			'std'=>array('md'=> '  30px ', 'sm'=> '  20px ', 'xs'=> '  10px '),
			'responsive' => true
		),
		'global_padding'=>array(
			'type'=>'padding',
			'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_PADDING'),
			'std'=>'',
			'responsive' => true
		),
		'global_boxshadow'=>array(
			'type'=>'boxshadow',
			'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BOXSHADOW'),
			'std'=>'0 0 0 0 #ffffff'
		),
		'global_use_animation'=>array(
			'type'=>'checkbox',
			'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_USE_ANIMATION'),
			'std'=>0
		),
		'global_animation'=>array(
			'type'=>'animation',
			'title'=>JText::_('COM_SPPAGEBUILDER_ANIMATION'),
			'desc'=>JText::_('COM_SPPAGEBUILDER_ANIMATION_DESC'),
			'depends'=>array('global_use_animation'=>1)
		),

		'global_animationduration'=>array(
			'type'=>'number',
			'title'=>JText::_('COM_SPPAGEBUILDER_ANIMATION_DURATION'),
			'desc'=> JText::_('COM_SPPAGEBUILDER_ANIMATION_DURATION_DESC'),
			'std'=>'300',
			'placeholder'=>'300',
			'depends'=>array('global_use_animation'=>1)
		),

		'global_animationdelay'=>array(
			'type'=>'number',
			'title'=>JText::_('COM_SPPAGEBUILDER_ANIMATION_DELAY'),
			'desc'=>JText::_('COM_SPPAGEBUILDER_ANIMATION_DELAY_DESC'),
			'std'=>'0',
			'placeholder'=>'300',
			'depends'=>array('global_use_animation'=>1)
		),
	),

	'advanced' => array(
		'use_global_width'=>array(
			'type'=>'checkbox',
			'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_USE_WIDTH'),
			'std'=>'0',
		),
		'global_width' => array(
			'type'=>'slider',
			'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_WIDTH'),
			'max'=>100,
			'responsive'=>true,
			'depends'=>array('use_global_width'=>1)
		),
		'hidden_md'=>array(
			'type'=>'checkbox',
			'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_HIDDEN_MD'),
			'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_HIDDEN_MD_DESC'),
			'std'=>'0',
			),

		'hidden_sm'=>array(
			'type'=>'checkbox',
			'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_HIDDEN_SM'),
			'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_HIDDEN_SM_DESC'),
			'std'=>'0',
			),

		'hidden_xs'=>array(
			'type'=>'checkbox',
			'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_HIDDEN_XS'),
			'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_HIDDEN_XS_DESC'),
			'std'=>'0',
			),

		'acl' => array(
			'type' => 'accesslevel',
			'title' => JText::_('COM_SPPAGEBUILDER_ACCESS'),
			'desc' => JText::_('COM_SPPAGEBUILDER_ACCESS_DESC'),
			'placeholder' => '',
			'std' 			=> '',
			'multiple' => true
			)
		)
	);
