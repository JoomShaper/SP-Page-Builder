<?php
/**
 * @package     SP Page Builder
 * @subpackage  mod_sppagebuilder_admin_menu
 *
 * @copyright   Copyright (C) 2010 - 2014 JoomShaper, Inc. All rights reserved.
 * @license     
 */

defined('_JEXEC') or die;

$user = JFactory::getUser();
$lang = JFactory::getLanguage();

if ($user->authorise('core.manage', 'com_sppagebuilder'))
{
	$menu->addChild(new JMenuNode(JText::_('MOD_MENU_COM_SPPAGEBUILDER'), '#'), true);
	$createContent = $user->authorise('core.create', 'com_content');
	$menu->addChild(new JMenuNode(JText::_('MOD_MENU_COM_SPPAGEBUILDER_PAGES'), 'index.php?option=com_sppagebuilder', 'class:pages'));
	$menu->addChild(new JMenuNode(JText::_('MOD_MENU_COM_SPPAGEBUILDER_PAGE'), 'index.php?option=com_sppagebuilder&task=page.add', 'class:page'));
	$menu->addChild(new JMenuNode(JText::_('MOD_MENU_COM_SPPAGEBUILDER_DOC'), 'http://www.joomshaper.com/documentation/joomla-extensions/sp-page-builder',null,false,'blank'));

	$menu->getParent();
}