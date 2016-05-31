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

	public static function render_banner()
	{
		$list = array(
				0 => array( 'name' 	=> 'SP Page Builder Pro', 'url'	=> 'http://bit.ly/pbpricing', 'image' => 'page-builder-1.jpg' ),
				1 => array( 'name' 	=> 'Helix3 Framework', 'url'	=> 'http://bit.ly/jshelix3', 'image' => 'helix.jpg' ),
				2 => array( 'name' 	=> 'SP Page Builder Pro', 'url'	=> 'http://bit.ly/sppbpro', 'image' => 'page-builder-2.jpg' ),
				3 => array( 'name' 	=> 'Professional Joomla Templates', 'url'	=> 'http://bit.ly/jstemplates', 'image' => 'templates.jpg' ),
				4 => array( 'name' 	=> 'Free Joomla Extensions', 'url'	=> 'http://bit.ly/jsextensions', 'image' => 'extensions.jpg' ),
			);

		$banner 	= $list[rand(0,4)];

		$img_link 	= 'components/com_sppagebuilder/assets/img/joomshaper-promotion/'. $banner['image'];
		$output = '';
		$output .='<div class="clearfix" style="text-align:center;">';
		$output .='<a style="max-width:650px;display:inline-block;max-height:60px;" href="'.$banner['url'].'" target="_blank">';
		$output .='<img src="'.$img_link.'" alt="'.$banner['name'].'" />';
		$output .='</a>';
		$output .='</div>';
		
		return $output;
		
	}
}