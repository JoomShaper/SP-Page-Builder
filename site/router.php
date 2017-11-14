<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2017 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('restricted aceess');

class SppagebuilderRouter extends JComponentRouterBase {

	public function build(&$query) {
		$app = JFactory::getApplication();
		$menu = $app->getMenu();

		$segments = array();

		if (empty($query['Itemid'])) {
			$menuItem = $menu->getActive();
			$menuItemGiven = false;
		} else {
			$menuItem = $menu->getItem($query['Itemid']);
			$menuItemGiven = true;
		}

		// Check again
		if ($menuItemGiven && isset($menuItem) && $menuItem->component != 'com_sppagebuilder') {
			$menuItemGiven = false;
			unset($query['Itemid']);
		}

		if (isset($query['view'])) {
			$view = $query['view'];
		} else {
			return $segments;
		}

		if (($menuItem instanceof stdClass) && $menuItem->query['view'] == $query['view']) {

			if (!$menuItemGiven) {
				$segments[] = $view;
			}

			unset($query['view']);
		}

		// Page
		if (($view == 'page')) {

			if(isset($query['id']) && $query['id']) {
				$id = $this->getPageSegment($query['id']);
				$segments[] = str_replace(':', '-', $id);
				unset($query['id']);
			}

			unset($query['view']);
		}

		// Form
		if (($view == 'form')) {

			if(isset($query['id']) && $query['id']) {
				$id = $this->getPageSegment($query['id']);
				$segments[] = str_replace(':', '-', $id);
				unset($query['id']);
			}

			if(isset($query['layout']) && $query['layout']) {
				$segments[] = $query['layout'];
				unset($query['layout']);
			}

			if(isset($query['tmpl']) && $query['tmpl']) {
				unset($query['tmpl']);
			}

			unset($query['view']);
		}

		return $segments;
	}

	// Parse
	public function parse(&$segments) {
		$app = JFactory::getApplication();
		$menu = $app->getMenu();
		$item = $menu->getActive();
		$total = count($segments);
		$vars = array();
		$view = (isset($item->query['view']) && $item->query['view']) ? $item->query['view'] : 'page';

		if($view == 'page') {
			if($total == 2) {
				if($segments[1] == 'edit') {
					$vars['view'] = 'form';
					$vars['id'] = (int) $segments[0];
					$vars['tmpl'] = 'component';
					$vars['layout'] = 'edit';
				} else {
					$vars['view'] = 'page';
					$vars['id'] = (int) $segments[0];
				}
			}

			if($total == 1) {
				$vars['view'] = 'page';
				$vars['id'] = (int) $segments[0];
			}
		}

		return $vars;
	}

	private function getPageSegment($id) {
		if (!strpos($id, ':')) {
			$db = JFactory::getDbo();
			$dbquery = $db->getQuery(true);
			$dbquery->select($dbquery->qn('title'))
			->from($dbquery->qn('#__sppagebuilder'))
			->where('id = ' . $dbquery->q($id));
			$db->setQuery($dbquery);

			$id .= ':' . JFilterOutput::stringURLSafe($db->loadResult());
		}

		return $id;
	}
}

function SppagebuilderBuildRoute(&$query) {
	$router = new SppagebuilderRouter;
	return $router->build($query);
}

function SppagebuilderParseRoute($segments) {
	$router = new SppagebuilderRouter;
	return $router->parse($query);
}
