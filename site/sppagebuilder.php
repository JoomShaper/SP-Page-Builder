<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

require_once JPATH_COMPONENT.'/helpers/route.php';

// import joomla controller library
jimport('joomla.application.component.controller');

$controller = JControllerLegacy::getInstance('Sppagebuilder');

$input = JFactory::getApplication()->input;
$controller->execute($input->getCmd('task'));

$controller->redirect();

