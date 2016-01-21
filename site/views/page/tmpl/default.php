<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2016 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('restricted aceess');

JHtml::_('jquery.framework');

require_once ( JPATH_COMPONENT .'/parser/addon-parser.php' );

$doc = JFactory::getDocument();
$doc->addStyleSheet(JUri::base(true).'/components/com_sppagebuilder/assets/css/font-awesome.min.css');
$doc->addStyleSheet(JUri::base(true).'/components/com_sppagebuilder/assets/css/animate.min.css');
$doc->addStyleSheet(JUri::base(true).'/components/com_sppagebuilder/assets/css/sppagebuilder.css');


$app = JFactory::getApplication();
$menus		= $app->getMenu();
$menu = $menus->getActive();

$menuClassPrefix = '';
$showPageHeading = 0;

// check active menu item
if ($menu) {
	$menuClassPrefix 	= $menu->params->get('pageclass_sfx');
	$showPageHeading 	= $menu->params->get('show_page_heading');
	$menuheading 		= $menu->params->get('page_heading');
}

$page = $this->data;
$content = json_decode($page->text);
$fullwidth = $page->page_layout;
?>

<div id="sp-page-builder" class="sp-page-builder <?php echo $menuClassPrefix; ?> page-<?php echo $page->id; ?>">
	<?php if($showPageHeading){ ?>
	<div class="page-header">
		<h1 itemprop="name">
			<?php
			if($menuheading)
			{
				echo $menuheading;
			} else {
				echo $page->title;
			}
			?>
		</h1>
	</div>
	<?php } ?>
	
	<div class="page-content">
		<?php echo AddonParser::viewAddons($content,$fullwidth); ?>
	</div>
</div>

<?php
$doc->addScript(JUri::base(true).'/components/com_sppagebuilder/assets/js/sppagebuilder.js');
