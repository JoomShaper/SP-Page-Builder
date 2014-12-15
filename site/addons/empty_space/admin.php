<?php

defined ('_JEXEC') or die('resticted aceess');

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
			'class'=>array(
				'type'=>'text', 
				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CLASS'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_CLASS_DESC'),
				'std'=> ''
				),
			)

		)
	);