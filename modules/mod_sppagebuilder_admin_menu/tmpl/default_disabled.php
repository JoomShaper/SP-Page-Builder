<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2016 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('restricted aceess');

if ($user->authorise('core.manage', 'com_sppagebuilder'))
{
	$menu->addChild(new JMenuNode(JText::_('MOD_MENU_COM_SPPAGEBUILDER'), null, 'disabled'));
}