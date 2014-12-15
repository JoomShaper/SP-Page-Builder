<?php
defined('_JEXEC') or die('Restricted access');

JHtml::_('behavior.tabstate');

jimport('joomla.application.component.controller');

$input = JFactory::getApplication()->input;
$task = $input->get('task');

$controller = JControllerLegacy::getInstance('sppagebuilder');
$controller->execute($input->getCmd('task'));
$controller->redirect();
