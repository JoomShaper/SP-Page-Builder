<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2016 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('restricted aceess');

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

		$model = $this->getModel();
		$model->hit();

		$this->_prepareDocument();
		parent::display($tpl);
	}

	protected function _prepareDocument()
	{
		$config 	= JFactory::getConfig();
		$app 		= JFactory::getApplication();
		$doc 		= JFactory::getDocument();
		$menus   	= $app->getMenu();
		$menu 		= $menus->getActive();
		$title 		= '';

		$menu = $menus->getActive();

		//Title
		if (isset($meta['title']) && $meta['title']) {
			$title = $meta['title'];
		} else {
			if ($menu) {
				if($menu->params->get('page_title', '')) {
					$title = $menu->params->get('page_title');
				} else {
					$title = $menu->title;
				}
			}
		}

		//Include Site title
		$sitetitle = $title;
		if($config->get('sitename_pagetitles')==2) {
			$sitetitle = $title . ' | ' . $config->get('sitename');
		} elseif ($config->get('sitename_pagetitles')==1) {
			$sitetitle = $config->get('sitename') . ' | ' . $title;
		}

		$doc->setTitle($sitetitle);
		$doc->addCustomTag('<meta content="' . $title . '" property="og:title" />');

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