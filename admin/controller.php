<?php
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.controller');

class SppagebuilderController extends JControllerLegacy
{
	function display( $cachable = false, $urlparams = false )
	{
		$input = JFactory::getApplication()->input;
		$input->set('view', $input->getCmd('view','pages'));

		parent::display($cachable);
	}
}