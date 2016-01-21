<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2016 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('restricted aceess');

jimport('joomla.application.component.modeladmin');
jimport( 'joomla.filter.filteroutput' );

class SppagebuilderModelPage extends JModelAdmin
{
    public function getTable($type = 'Page', $prefix = 'SppagebuilderTable', $config = array()) 
    {
        return JTable::getInstance($type, $prefix, $config);
    }

    public function getForm($data = array(), $loadData = true) 
    {
        $form = $this->loadForm('com_sppagebuilder.page', 'page',array('control' => 'jform', 'load_data' => $loadData));

        if (empty($form)) 
        {
            return false;
        }
        return $form;
    }

    protected function loadFormData() 
    {
        $data = JFactory::getApplication()->getUserState('com_sppagebuilder.edit.page.data', array());
        if (empty($data)) 
        {
            $data = $this->getItem();
        }

        if (isset($data->alias)) {
            if ($data->alias)
            {
                $data->alias = JFilterOutput::stringURLSafe($data->alias);
            }
            else
            {
                $data->alias = JFilterOutput::stringURLSafe($data->title);
            }
        }


        $this->preprocessData('com_sppagebuilder.page', $data);

        return $data;
    }

    public function save($data)
    {
        $app = JFactory::getApplication();
        if ($app->input->get('task') == 'save2copy')
        {
            list($title, $alias) = $this->pageGenerateNewTitle( $data['alias'], $data['title'] );
            $data['title'] = $title;
            $data['alias'] = $alias;
        }
        parent::save($data);
        return true;
    }
    
    protected function prepareTable($table)
    {
        $jform = JRequest::getVar('jform');
        if (!isset($jform['page_layout'])) {
            $table->page_layout = 0;
        }
    }

    public static function pageGenerateNewTitle($alias, $title )
    {
        $pageTable = JTable::getInstance('Page', 'SppagebuilderTable');

        while( $pageTable->load(array('alias'=>$alias)) ){
            $m = null;
            if (preg_match('#-(\d+)$#', $alias, $m)) {
                $alias = preg_replace('#-(\d+)$#', '-'.($m[1] + 1).'', $alias);
            } else {
                $alias .= '-2';
            }
            if (preg_match('#\((\d+)\)$#', $title, $m)) {
                $title = preg_replace('#\(\d+\)$#', '('.($m[1] + 1).')', $title);
            } else {
                $title .= ' (2)';
            }
        }

        return array($title ,$alias);
    }
}