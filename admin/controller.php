<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2015 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('resticted aceess');

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