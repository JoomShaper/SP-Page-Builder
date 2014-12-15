<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla view library
jimport('joomla.application.component.view');

class SppagebuilderViewPage extends JViewLegacy
{
	public function display( $tpl = null )
	{
		$form = $this->get('Form');
		$item = $this->get('Item');

		if (count($errors = $this->get('Errors'))) 
		{
			JError::raiseError(500, implode('<br />', $errors));
			return false;
		}

		$this->form = $form;
		$this->item = $item;

		$this->addToolBar();

		parent::display($tpl);
	}

	protected function addToolBar()
	{
		$input = JFactory::getApplication()->input;
        $input->set('hidemainmenu', true);
        $isNew = ($this->item->id == 0);
        JToolBarHelper::title($isNew ? JText::_('New')
                                     : JText::_('Edit'));
        JToolBarHelper::apply('page.apply');
        JToolBarHelper::save('page.save');

        if (!$isNew)
        {
        	JToolbarHelper::save2copy('page.save2copy');
        }
        JToolBarHelper::cancel('page.cancel', $isNew ? 'Cancel'
                                                     : 'Close');
	}
}