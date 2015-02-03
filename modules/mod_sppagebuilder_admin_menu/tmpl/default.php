<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2015 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('resticted aceess');

$document = JFactory::getDocument();
$direction = $document->direction == 'rtl' ? 'pull-right' : '';
require JModuleHelper::getLayoutPath('mod_sppagebuilder_admin_menu', $enabled ? 'default_enabled' : 'default_disabled');

$menu->renderMenu('menu', $enabled ? 'nav ' . $direction : 'nav disabled ' . $direction);