<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2015 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('resticted aceess');

$template_name = $_POST['template'];
$path = JPATH_COMPONENT.'/builder/templates/'.$template_name.'.json';
if (file_exists($path)) {
	require_once ( JPATH_COMPONENT .'/builder/builder_layout.php' );
	$content = file_get_contents($path);
	echo dataLayoutBuilder(json_decode( $content ));
}else{
	echo '<h1>There is no souch template</h1>';
}
die();