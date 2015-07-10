<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2015 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('resticted aceess');

//import Joomla controller library
jimport('joomla.application.component.controller');

class SppagebuilderController extends JControllerLegacy{

	//Ajax
	public function ajax() {
    	$app 		= JFactory::getApplication();
		$input 		= $app->input;
		$format 	= strtolower($input->getWord('format'));
		$results 	= null;
		
		if ($input->get('addon')) {

			$function = 'sp_'. $input->get('addon') .'_get_ajax';
			$method = $input->get('method') ? $input->get('method') : 'get';

			require_once JPATH_BASE . '/components/com_sppagebuilder/parser/addon-parser.php';
			
			$core_path 		= JPATH_BASE . '/components/com_sppagebuilder/addons/' . $input->get('addon') . '/site.php';
			$template_path 	= JPATH_BASE . '/templates/' . $this->getTemplateName() . '/sppagebuilder/addons/' . $input->get('addon') . '/site.php';

			if(file_exists($template_path)) {
				require_once $template_path;
			} else {
				require_once $core_path;
			}


			if (function_exists($function)) {
				try
				{
					$results = call_user_func($function);
				}
				catch (Exception $e)
				{
					$results = $e;
				}
			} else {
				$results = new LogicException(JText::sprintf('Function %s does not exist', $function), 404);
			}

		}

		echo new JResponseJson($results, null, false, $input->get('ignoreMessages', true, 'bool'));
		die;
    }

    function display( $cachable = false, $urlparams = false )
	{
		$input = JFactory::getApplication()->input;
		
		if ($input->getCmd('view','pages') === 'pages') {
			JFactory::getApplication()->redirect(JURI::base());
		}

		$input->set('view', $input->getCmd('view','pages'));

		parent::display($cachable);
	}

	private function getTemplateName()
	{
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select($db->quoteName(array('template')));
		$query->from($db->quoteName('#__template_styles'));
		$query->where($db->quoteName('client_id') . ' = 0');
		$query->where($db->quoteName('home') . ' = 1');
		$db->setQuery($query);

		return $db->loadObject()->template;
	}
}