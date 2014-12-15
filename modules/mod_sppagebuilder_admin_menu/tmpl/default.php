<?php
/**
 * @package     SP Page Builder
 * @subpackage  mod_sppagebuilder_admin_menu
 *
 * @copyright   Copyright (C) 2010 - 2014 JoomShaper, Inc. All rights reserved.
 * @license     
 */

defined('_JEXEC') or die;

$document = JFactory::getDocument();
$direction = $document->direction == 'rtl' ? 'pull-right' : '';
require JModuleHelper::getLayoutPath('mod_sppagebuilder_admin_menu', $enabled ? 'default_enabled' : 'default_disabled');

$menu->renderMenu('menu', $enabled ? 'nav ' . $direction : 'nav disabled ' . $direction);