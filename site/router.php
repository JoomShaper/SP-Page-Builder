<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2015 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('resticted aceess');

class SppagebuilderRouter extends JComponentRouterBase
{

	public function build(&$query)
	{
		$segments = array();

		$app = JFactory::getApplication();
		$menu = $app->getMenu();
		$params = JComponentHelper::getParams('com_sppagebuilder');
		$advanced = $params->get('sef_advanced_link', 0);

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

		if (isset($query['layout']))
		{
			unset($query['layout']);
		}

		if (isset($query['view']))
		{
			$view = $query['view'];
		}
		else
		{
			return $segments;
		}

		if (($menuItem instanceof stdClass) && $menuItem->query['view'] == $query['view'] && isset($query['id']) && $menuItem->query['id'] == (int) $query['id'])
		{
			unset($query['view']);
			unset($query['id']);

			return $segments;
		}

		if ($view == 'page')
		{
			if (!$menuItemGiven)
			{
				$segments[] = $view;
			}

			unset($query['view']);

			if ($view == 'page')
			{
				if (isset($query['id']))
				{
					if (strpos($query['id'], '-') === false)
					{
						$db = JFactory::getDbo();
						$dbQuery = $db->getQuery(true)
							->select('alias')
							->from('#__sppagebuilder')
							->where('id=' . (int) $query['id']);
						$db->setQuery($dbQuery);
						$alias = $db->loadResult();
						$query['id'] = $query['id'] . '-' . $alias;
					}
				}
				else
				{
					return $segments;
				}
			}
			else
			{
				if (isset($query['id']))
				{
					$catid = $query['id'];
				}
				else
				{
					return $segments;
				}
			}

			if ($view == 'page')
			{
				if ($advanced)
				{
					list($tmp, $id) = explode(':', $query['id'], 2);
				}
				else
				{
					$id = $query['id'];
				}

				$segments[] = $id;
			}

			unset($query['id']);
		}

		$total = count($segments);

		for ($i = 0; $i < $total; $i++)
		{
			$segments[$i] = str_replace('-', '-', $segments[$i]);
		}

		return $segments;
	}

	public function parse(&$segments)
	{
		$total = count($segments);
		$vars = array();

		for ($i = 0; $i < $total; $i++)
		{
			$segments[$i] = preg_replace('/-/', '-', $segments[$i], 1);
		}

		// Get the active menu item.
		$app = JFactory::getApplication();
		$menu = $app->getMenu();
		$item = $menu->getActive();
		$params = JComponentHelper::getParams('com_sppagebuilder');
		$advanced = $params->get('sef_advanced_link', 0);
		$db = JFactory::getDbo();

		// Count route segments
		$count = count($segments);

		if (!isset($item))
		{
			$vars['view'] = $segments[0];
			$vars['id'] = $segments[$count - 1];

			return $vars;
		}

		if ($count == 1)
		{
			if (strpos($segments[0], '-') === false)
			{
				$vars['view'] = 'page';
				$vars['id'] = (int) $segments[0];

				return $vars;
			}

			list($id, $alias) = explode('-', $segments[0], 2);
		}

		if (!$advanced)
		{
			$article_id = (int) $segments[$count - 1];

			if ($article_id > 0)
			{
				$vars['view'] = 'page';
				$vars['id'] = $article_id;
			}

			return $vars;
		}

		return $vars;
	}
}


function SppagebuilderBuildRoute(&$query)
{
	$router = new SppagebuilderRouter;

	return $router->build($query);
}

function SppagebuilderParseRoute($segments)
{
	$router = new SppagebuilderRouter;

	return $router->parse($segments);
}