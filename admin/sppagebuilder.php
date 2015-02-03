<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2015 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('resticted aceess');

JHtml::_('behavior.tabstate');

jimport('joomla.application.component.controller');

$input = JFactory::getApplication()->input;
$task = $input->get('task');

$controller = JControllerLegacy::getInstance('sppagebuilder');
$controller->execute($input->getCmd('task'));
$controller->redirect();
