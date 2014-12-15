<?php
/**
 * @package     SP Page Builder
 * @subpackage  mod_sppagebuilder_icons
 *
 * @copyright   Copyright (C) 2010 - 2014 JoomShaper, Inc. All rights reserved.
 * @license     
 */

defined('_JEXEC') or die;

$mod_name = 'mod_sppagebuilder_icons';

$document 	= JFactory::getDocument();
$input 		= JFactory::getApplication()->input;

$document->addStyleSheet(JURI::base(true).'/modules/'.$mod_name.'/tmpl/css/pagebuilder-style.css');

require JModuleHelper::getLayoutPath($mod_name,$params->get('layout','default'));