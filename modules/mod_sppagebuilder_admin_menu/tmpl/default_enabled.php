<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2016 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('restricted aceess');

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