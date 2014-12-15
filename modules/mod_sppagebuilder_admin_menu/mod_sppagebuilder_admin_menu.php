<?php
/**
 * @package     SP Page Builder
 * @subpackage  mod_sppagebuilder_admin_menu
 *
 * @copyright   Copyright (C) 2010 - 2014 JoomShaper, Inc. All rights reserved.
 * @license     
 */

defined('_JEXEC') or die;

if (!class_exists('JAdminCssMenu'))
{
	require __DIR__ . '/menu.php';
}

$lang 	= JFactory::getLanguage();
$user 	= JFactory::getUser();
$input 	= JFactory::getApplication()->input;
$menu 	= new JAdminCSSMenu;
$enabled = $input->getBool('hidemainmenu') ? false : true;

require JModuleHelper::getLayoutPath('mod_sppagebuilder_admin_menu',$params->get('layout','default'));