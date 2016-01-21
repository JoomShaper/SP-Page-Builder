<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2016 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('restricted aceess');

abstract class SppagebuilderHelper
{

	public static $extension = 'com_sppagebuilder';

	public static function addSubmenu($vName)
	{

		JHtmlSidebar::addEntry(
			JText::_('COM_SPPAGEBUILDER_PAGES'),
			'index.php?option=com_sppagebuilder&view=pages',
			$vName == 'pages'
		);

		JHtmlSidebar::addEntry(
			JText::_('COM_SPPAGEBUILDER_CATEGORIES'),
			'index.php?option=com_categories&extension=com_sppagebuilder',
			$vName == 'categories'
		);
	}
}