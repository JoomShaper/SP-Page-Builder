<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2015 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('resticted aceess');

if ($user->authorise('core.manage', 'com_sppagebuilder'))
{
	$menu->addChild(new JMenuNode(JText::_('MOD_MENU_COM_SPPAGEBUILDER'), null, 'disabled'));
}