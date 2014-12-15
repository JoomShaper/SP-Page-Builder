<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla view library
jimport('joomla.application.component.view');

class SppagebuilderViewPage extends JViewLegacy
{
	protected $page;
	
	function display( $tpl = null )
	{
		$this->data = $this->get('Item');
		$this->page = $this->get('Item');

		if (count($errors = $this->get('Errors'))) {
			JLog::add(implode('<br />',$errors),JLog::WARNING,'jerror');
			return false;
		}

		if ($this->data->access_view == false)
		{
			JError::raiseWarning(403, JText::_('JERROR_ALERTNOAUTHOR'));
			return;
		}

		$this->_prepareDocument();
		parent::display($tpl);
	}

	protected function _prepareDocument()
	{
		$app = JFactory::getApplication();
		$menus = $app->getMenu();
		$title = null;

		$menu = $menus->getActive();

		if ($menu) {
			$title = $menu->params->get('page_title', '');
		}

		// check page title is empty

		if (empty($title))
		{
			$title = $this->page->title;
		}

		if (empty($title)) {
			$title = $this->page->title;
		}
		$this->document->setTitle($title);

		$this->document->addCustomTag('<meta content="website" property="og:type"/>');
		$this->document->addCustomTag('<meta content="'.JURI::current().'" property="og:url" />');

		$og_title = $this->page->og_title;
		if ($og_title) {
			$this->document->addCustomTag('<meta content="'.$og_title.'" property="og:title" />');
		}

		$og_image = $this->page->og_image;
		if ($og_image) {
			$this->document->addCustomTag('<meta content="'.JURI::root().$og_image.'" property="og:image" />');
		}

		$og_description = $this->page->og_description;
		if ($og_description) {
			$this->document->addCustomTag('<meta content="'.$og_description.'" property="og:description" />');
		}

		if ($menu) {

			if ($menu->params->get('menu-meta_description')) {
				$this->document->setDescription($menu->params->get('menu-meta_description'));
			}

			if ($menu->params->get('menu-meta_keywords')) {
				$this->document->setMetadata('keywords', $menu->params->get('menu-meta_keywords'));
			}

			if ($menu->params->get('robots'))
			{
				$this->document->setMetadata('robots', $menu->params->get('robots'));
			}
	
		}
	}
}