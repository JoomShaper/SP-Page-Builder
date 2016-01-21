<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2016 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('restricted aceess');

$spbuilder_row_settings = array( 
	'type'=>'general', 
	'title'=>'', 
	'attr'=>array(

		'title'=>array(
			'type'=>'text', 
			'title'=>JText::_('COM_SPPAGEBUILDER_SECTION_TITLE'),
			'desc'=>JText::_('COM_SPPAGEBUILDER_SECTION_TITLE_DESC'),
			'std'=>''
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
		
		'subtitle'=>array(
			'type'=>'textarea', 
			'title'=>JText::_('COM_SPPAGEBUILDER_SECTION_SUBTITLE'),
			'desc'=>JText::_('COM_SPPAGEBUILDER_SECTION_SUBTITLE_DESC')
			),

		'subtitle_fontsize'=>array(
			'type'=>'number', 
			'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_SUB_TITLE_FONT_SIZE'),
			'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_SUB_TITLE_FONT_SIZE_DESC'),
			'std'=>''
			),			

		'title_position'=>array(
				'type'=>'select', 
				'title'=>JText::_('COM_SPPAGEBUILDER_TITLE_SUBTITLE_POSITION'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_TITLE_SUBTITLE_POSITION_DESC'),
				'values'=>array(
					'sppb-text-left'=>JText::_('COM_SPPAGEBUILDER_LEFT'),
					'sppb-text-center'=>JText::_('COM_SPPAGEBUILDER_CENTER'),
					'sppb-text-right'=>JText::_('COM_SPPAGEBUILDER_RIGHT')
					),
				'std'=>'sppb-text-center',
			),

		'background_color'=>array(
			'type'=>'color', 
			'title'=>JText::_('COM_SPPAGEBUILDER_BGCOLOR'),
			'desc'=>JText::_('COM_SPPAGEBUILDER_BGCOLOR_DESC')
			),

		'color'=>array(
			'type'=>'color', 
			'title'=>JText::_('COM_SPPAGEBUILDER_FONTCOLOR'),
			'desc'=>JText::_('COM_SPPAGEBUILDER_FONTCOLOR_DESC')
			),

		'background_image'=>array(
			'type'=>'media', 
			'title'=>JText::_('COM_SPPAGEBUILDER_BGIMG'),
			'desc'=>JText::_('COM_SPPAGEBUILDER_BGIMG_DESC'),
			'std'=>'',
			),

		'background_repeat'=>array(
			'type'=>'select', 
			'title'=>JText::_('COM_SPPAGEBUILDER_BG_REPEAT'),
			'desc'=>JText::_('COM_SPPAGEBUILDER_BG_REPEAT_DESC'),
			'values'=>array(
				'no-repeat'=>JText::_('COM_SPPAGEBUILDER_BG_REPEAT_NO'),
				'repeat'=>JText::_('COM_SPPAGEBUILDER_BG_REPEAT_ALL'),
				'repeat-x'=>JText::_('COM_SPPAGEBUILDER_BG_REPEAT_HORIZ'),
				'repeat-y'=>JText::_('COM_SPPAGEBUILDER_BG_REPEAT_VERTI'),
				'inherit'=>JText::_('COM_SPPAGEBUILDER_BG_REPEAT_INHERIT'),
				),
			'std'=>'no-repeat',
			),

		'background_size'=>array(
			'type'=>'select', 
			'title'=>JText::_('COM_SPPAGEBUILDER_BG_SIZE'),
			'desc'=>JText::_('COM_SPPAGEBUILDER_BG_SIZE_DESC'),
			'values'=>array(
				'cover'=>JText::_('COM_SPPAGEBUILDER_BG_COVER'),
				'contain'=>JText::_('COM_SPPAGEBUILDER_BG_CONTAIN'),
				'inherit'=>JText::_('COM_SPPAGEBUILDER_BG_INHERIT'),
				),
			'std'=>'cover',
			),

		'background_attachment'=>array(
			'type'=>'select', 
			'title'=>JText::_('COM_SPPAGEBUILDER_BG_ATTACHMENT'),
			'desc'=>JText::_('COM_SPPAGEBUILDER_BG_ATTACHMENT_DESC'),
			'values'=>array(
				'fixed'=>JText::_('COM_SPPAGEBUILDER_BG_ATTACHMENT_FIXED'),
				'scroll'=>JText::_('COM_SPPAGEBUILDER_BG_ATTACHMENT_SCROLL'),
				'inherit'=>JText::_('COM_SPPAGEBUILDER_BG_ATTACHMENT_INHERIT'),
				),
			'std'=>'fixed',
			),

		'background_position'=>array(
			'type'=>'select', 
			'title'=>JText::_('COM_SPPAGEBUILDER_BG_POSITION'),
			'desc'=>JText::_('COM_SPPAGEBUILDER_BG_POSITION_DESC'),
			'values'=>array(
				'0 0'=>JText::_('COM_SPPAGEBUILDER_LEFT_TOP'),
				'0 50%'=>JText::_('COM_SPPAGEBUILDER_LEFT_CENTER'),
				'0 100%'=>JText::_('COM_SPPAGEBUILDER_LEFT_BOTTOM'),
				'50% 0'=>JText::_('COM_SPPAGEBUILDER_CENTER_TOP'),
				'50% 50%'=>JText::_('COM_SPPAGEBUILDER_CENTER_CENTER'),
				'50% 100%'=>JText::_('COM_SPPAGEBUILDER_CENTER_BOTTOM'),
				'100% 0'=>JText::_('COM_SPPAGEBUILDER_RIGHT_TOP'),
				'100% 50%'=>JText::_('COM_SPPAGEBUILDER_RIGHT_CENTER'),
				'100% 100%'=>JText::_('COM_SPPAGEBUILDER_RIGHT_BOTTOM'),
				),
			'std'=>'0 0',
			),

		'background_video'=>array(
			'type'=>'checkbox', 
			'title'=>JText::_('COM_SPPAGEBUILDER_BG_VIDEO_PATH'),
			'desc'=>JText::_('COM_SPPAGEBUILDER_BG_VIDEO_PATH_DESC'),
			'std'=>'0',
			),

		'background_video_mp4'=>array(
			'type'=>'text', 
			'title'=>JText::_('COM_SPPAGEBUILDER_BG_VIDEO_MP4'),
			'placeholder'=>'http://yoursite.com/video/video.mp4',
			),

		'background_video_ogv'=>array(
			'type'=>'text', 
			'title'=>JText::_('COM_SPPAGEBUILDER_BG_VIDEO_OGV'),
			'placeholder'=>'http://yoursite.com/video/video.ogv',
			),

		'id'=>array(
			'type'=>'text', 
			'title'=>JText::_('COM_SPPAGEBUILDER_SECTION_ID'),
			'desc'=>JText::_('COM_SPPAGEBUILDER_SECTION_ID_DESC')
			),

		'class'=>array(
			'type'=>'text', 
			'title'=>JText::_('COM_SPPAGEBUILDER_CSS_CLASS'),
			'desc'=>JText::_('COM_SPPAGEBUILDER_CSS_CLASS_DESC')
			),

		'padding'=>array(
			'type'=>'text', 
			'title'=>JText::_('COM_SPPAGEBUILDER_PADDING'),
			'desc'=>JText::_('COM_SPPAGEBUILDER_PADDING_DESC'),
			'placeholder'=>'10px 10px 10px 10px',
			),

		'margin'=>array(
			'type'=>'text', 
			'title'=>JText::_('COM_SPPAGEBUILDER_MARGIN'),
			'desc'=>JText::_('COM_SPPAGEBUILDER_MARGIN_DESC'),
			'placeholder'=>'10px 10px 10px 10px',
			),

		'fullscreen'=>array(
			'type'=>'checkbox', 
			'title'=>JText::_('COM_SPPAGEBUILDER_FULLSCREEN'),
			'desc'=>JText::_('COM_SPPAGEBUILDER_FULLSCREEN_DESC')
			),
		)
);

$spbuilder_column_settings = array( 
	'type'=>'general', 
	'title'=>'', 
	'attr'=>array(

		'background'=>array(
			'type'=>'color', 
			'title'=>JText::_('COM_SPPAGEBUILDER_BGCOLOR'),
			'desc'=>JText::_('COM_SPPAGEBUILDER_BGCOLOR_DESC')
			),

		'color'=>array(
			'type'=>'color', 
			'title'=>JText::_('COM_SPPAGEBUILDER_FONTCOLOR'),
			'desc'=>JText::_('COM_SPPAGEBUILDER_FONTCOLOR_DESC')
			),

		'padding'=>array(
			'type'=>'text', 
			'title'=>JText::_('COM_SPPAGEBUILDER_COLUMN_PADDING'),
			'desc'=>JText::_('COM_SPPAGEBUILDER_COLUMN_PADDING_DESC'),
			'desc'=> '',
			'placeholder'=>'10px 10px 10px 10px',
			),

		'animation'=>array(
			'type'=>'animation', 
			'title'=>JText::_('COM_SPPAGEBUILDER_COLUMN_ANIMATION'),
			'desc'=>JText::_('COM_SPPAGEBUILDER_COLUMN_ANIMATION_DESC')
			),

		'animationduration'=>array(
			'type'=>'number', 
			'title'=>JText::_('COM_SPPAGEBUILDER_ANIMATION_DURATION'),
			'desc'=> JText::_('COM_SPPAGEBUILDER_ANIMATION_DURATION_DESC'),
			'std'=>'300',
			'placeholder'=>'300',
			),

		'animationdelay'=>array(
			'type'=>'number', 
			'title'=>JText::_('COM_SPPAGEBUILDER_ANIMATION_DELAY'),
			'desc'=>JText::_('COM_SPPAGEBUILDER_ANIMATION_DELAY_DESC'),
			'std'=>'0',
			'placeholder'=>'300',
			),

		'class'=>array(
			'type' 		=> 'text', 
			'title' 	=> JText::_('COM_SPPAGEBUILDER_CSS_CLASS'),
			'desc' 		=> JText::_('COM_SPPAGEBUILDER_CSS_CLASS_DESC')
			)

		) 

);

define("SP_COLUMN_SETTINGS",serialize($spbuilder_column_settings));
define("SP_ROW_SETTINGS",serialize($spbuilder_row_settings));