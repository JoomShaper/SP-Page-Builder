<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2015 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('restricted aceess');

function SppagebuilderBuildRoute(&$query) {

	$app 		= JFactory::getApplication();
	$menu   	= $app->getMenu();

	$segments = array();

	if (empty($query['Itemid']))
	{
		$menuItem = $menu->getActive();
		$menuItemGiven = false;
	}
	else
	{
		$menuItem = $menu->getItem($query['Itemid']);
		$menuItemGiven = true;
	}

	// Check again
	if ($menuItemGiven && isset($menuItem) && $menuItem->component != 'com_sppagebuilder')
	{
		$menuItemGiven = false;
		unset($query['Itemid']);
	}

	if (isset($query['view']))
	{
		$view = $query['view'];
	}
	else
	{
		return $segments;
	}

	if (($menuItem instanceof stdClass) && $menuItem->query['view'] == $query['view']) {

		if (!$menuItemGiven) {
			$segments[] = $view;
		}

		unset($query['id']);
		unset($query['view']);

		return $segments;
	}

	return $segments;
}
