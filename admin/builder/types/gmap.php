<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2015 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('resticted aceess');

class SpTypeGmap{

	static function getInput($key, $attr)
	{

		$doc = JFactory::getDocument();
		$doc->addScript( '//maps.google.com/maps/api/js?sensor=false&libraries=places' );
		$doc->addScript( JURI::base(true) . '/components/com_sppagebuilder/assets/js/locationpicker.jquery.js' );

		if (!isset($attr['std'])) {
			$attr['std'] = '40.7324319, -73.82480799999996';
		}

		$map = explode(',', $attr['std']);

		if (!isset($attr['placeholder'])) {
			$attr['placeholder'] = '';
		}

		$output  = '<div class="form-group form-group-gmap">';
		$output .= '<label>'.$attr['title'].'</label>';
		$output	.= '<input class="addon-input gmap-latlng" type="hidden" data-attrname="'.$key.'" value="'.$attr['std'].'" />';
		$output	.= '<input class="form-control addon-gmap-address" type="text" placeholder="'.$attr['placeholder'].'" data-latitude="' . trim($map[0]) . '" data-longitude="' . trim($map[1]) . '" />';
		
		if( ( isset($attr['desc']) ) && ( isset($attr['desc']) != '' ) )
		{
			$output .= '<p class="help-block">' . $attr['desc'] . '</p>';
		}

		$output .= '</div>';

		return $output;
	}

}