<?php
/**
 * @package     SP Page Builder
 * @subpackage  mod_sppagebuilder_admin_menu
 *
 * @copyright   Copyright (C) 2010 - 2014 JoomShaper, Inc. All rights reserved.
 * @license     
 */

defined('_JEXEC') or die;

if ($user->authorise('core.manage', 'com_sppagebuilder'))
{
	$menu->addChild(new JMenuNode(JText::_('MOD_MENU_COM_SPPAGEBUILDER'), null, 'disabled'));
}