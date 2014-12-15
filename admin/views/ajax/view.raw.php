<?php

defined('_JEXEC') or die('Restricted access');

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