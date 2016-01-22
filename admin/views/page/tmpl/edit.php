<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2016 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('restricted aceess');

JHtml::_('behavior.formvalidation');
JHtml::_('jquery.ui', array('core', 'sortable'));
JHtml::_('formbehavior.chosen', 'select');

$doc = JFactory::getDocument();

$doc->addScriptdeclaration('var pagebuilder_base="' . JURI::root() . '";');

define('SPASSET', '/components/com_sppagebuilder/assets/');

$doc->addStylesheet( JURI::base(true) . SPASSET. 'css/bootstrap.css' );
$doc->addStylesheet( JURI::base(true) . SPASSET. 'css/modal.css' );
$doc->addStylesheet( JURI::base(true) . SPASSET. 'css/font-awesome.min.css' );
$doc->addStylesheet( JURI::base(true) . SPASSET. 'css/sppagebuilder.css' );

//js
$doc->addScript( JURI::base(true) . SPASSET. 'js/jquery-ui.js' );
$doc->addScript( JURI::root(true) . '/media/editors/tinymce/tinymce.min.js' );
$doc->addScript( JURI::base(true) . SPASSET. 'js/transition.js' );
$doc->addScript( JURI::base(true) . SPASSET. 'js/modal.js' );
$doc->addScript( JURI::base(true) . SPASSET. 'js/helper.js' );
$doc->addScript( JURI::base(true) . SPASSET. 'js/parentchild.js' );
$doc->addScript( JURI::base(true) . SPASSET. 'js/main.js' );

$app = JFactory::getApplication();

global $pageId;
global $language;
global $pageLayout;

$pageId = $this->item->id; // page id
$language = $this->item->language; // page language
$pageLayout = $this->item->page_layout; // One click load page layout

require_once ( JPATH_COMPONENT .'/builder/builder_layout.php' );

?>
<form action="<?php echo JRoute::_('index.php?option=com_sppagebuilder&layout=edit&id=' . (int) $this->item->id); ?>" method="post" name="adminForm" id="adminForm" class="form-validate">
    
    <?php echo JLayoutHelper::render('joomla.edit.title_alias', $this); ?>


    <div class="form-horizontal">

        <?php
        $fieldsets = $this->form->getFieldsets();
        $shortcode = $this->form->getValue('text');
        $tab_count = 0;

        foreach ($fieldsets as $key => $attr)
        {
            if ( $tab_count == 0 )
            {
                echo JHtml::_('bootstrap.startTabSet', 'page', array('active' => $attr->name));
            }
            echo JHtml::_('bootstrap.addTab', 'page', $attr->name, JText::_($attr->label, true));
            ?>
            <div class="row-fluid">
                <div class="span12">
                    <?php
                    $layout = '';
                    $style = '';
                    $fields = $this->form->getFieldset($attr->name);
                    foreach ($fields as $key => $field)
                    {
                        if ($field->name !== 'jform[page_layout]') {
                    ?>
                        <div class="control-group <?php echo $layout; ?>" <?php echo $style; ?>>
                            <div class="control-label"><?php echo $field->label; ?></div>
                            <div class="controls"><?php echo $field->input; ?></div>
                        </div>
                    <?php
                        }
                    }

                    if ($tab_count == 0) {
                          echo builder_layout(json_decode( $shortcode ));
                    }
                    ?>
                </div>
            </div>
            <?php
            echo JHtml::_('bootstrap.endTab');
            $tab_count++;
        }
        ?>

    </div>
    <div class="pagebuilder clearfix" style="margin: 30px auto; text-align: center;">
        <p>
            <a href="https://www.joomshaper.com/page-builder/" target="_blank">SP Page Builder Free v1.0.8</a> | Copyright &copy; 2010-2016 <a href="http://www.joomshaper.com" target="_blank">JoomShaper</a>
        </p>
        <p>
            Rate SP Page Builder on <a href="http://bit.ly/pbjed" target="_blank">JED</a>
        </p>
    </div>
    <input type="hidden" name="task" value="page.edit" />
    <?php echo JHtml::_('form.token'); ?>
</form>