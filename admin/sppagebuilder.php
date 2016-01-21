<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2016 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('restricted aceess');

JHtml::_('behavior.tabstate');

if (!JFactory::getUser()->authorise('core.manage', 'com_sppagebuilder'))
{
	return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
}

JLoader::register('SppagebuilderHelper', __DIR__ . '/helpers/sppagebuilder.php');

jimport('joomla.application.component.controller');

$controller = JControllerLegacy::getInstance('sppagebuilder');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();