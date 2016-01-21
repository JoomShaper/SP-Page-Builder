<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2016 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('restricted aceess');
 
// import Joomla table library
jimport('joomla.database.table');
jimport( 'joomla.filter.filteroutput' );

class SppagebuilderTablePage extends JTable
{
	 function __construct(&$db) 
    {
        parent::__construct('#__sppagebuilder', 'id', $db);
    }

    public function store($updateNulls = true)
	{
		$date = JFactory::getDate();
		$user = JFactory::getUser();

		if ($this->id) {
			$this->modified_time		= $date->toSql();
			$this->modified_user_id		= $user->get('id');

		}
		else
		{
			if (!(int) $this->created_time) {
				$this->created_time = $date->toSql();
			}
			if (empty($this->created_user_id)) {
				$this->created_user_id = $user->get('id');
			}
		}

		$table = JTable::getInstance('Page', 'SppagebuilderTable');
		$alias = JFilterOutput::stringURLSafe($this->alias);

		if ($alias == '') {
			$alias = JFilterOutput::stringURLSafe($this->title);
		}

		$this->alias = $alias;
		
		if ($table->load(array('alias' => $alias)) && ($table->id != $this->id || $this->id == 0))
		{
			$this->setError(JText::_('COM_SPPAGEBUILDER_ERROR_UNIQUE_ALIAS'));
			return false;
		}

		return parent::store($updateNulls);
	}
}