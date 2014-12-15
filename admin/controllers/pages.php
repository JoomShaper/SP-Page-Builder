<?php
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.controlleradmin');

class SppagebuilderControllerPages extends JControllerAdmin
{
	public function getModel($name = 'Page', $prefix = 'SppagebuilderModel')
	{
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));
        return $model;
	}
}
