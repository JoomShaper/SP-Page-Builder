<?php

defined ('_JEXEC') or die('resticted aceess');

AddonParser::addAddon('sp_empty_space','sp_empty_space_addon');

function sp_empty_space_addon($atts){

	extract(spAddonAtts(array(
		"gap"=>'20',
		'class'=>'',
		), $atts));

	return '<div class="sppb-empty-space ' . $class . ' clearfix" style="margin-bottom:' . (int)$gap . 'px"></div>';
}