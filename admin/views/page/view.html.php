<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2016 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('restricted aceess');
 
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

		//Load Language
		$db = JFactory::getDbo();
		$query = "SELECT template FROM #__template_styles WHERE client_id = 0 AND home = 1";
		$db->setQuery($query);
		$defaultemplate = $db->loadResult();

		$lang = JFactory::getLanguage();
		$lang->load('tpl_' . $defaultemplate, JPATH_SITE, $lang->getName(), true);

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