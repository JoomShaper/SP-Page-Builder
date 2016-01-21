<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2016 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('restricted aceess');

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