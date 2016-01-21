<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2016 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('restricted aceess');

jimport('joomla.application.component.modellist');
jimport('joomla.filesystem.folder');
jimport('joomla.filesystem.file');
jimport('joomla.image.image');

class SppagebuilderModelMedia extends JModelList
{

	public function getItems() {

		$input 	= JFactory::getApplication()->input;
		$date 	= $input->post->get('date', NULL, 'STRING');
		$start 	= $input->post->get('start', 0, 'INT');
		$search = $input->post->get('search', NULL, 'STRING');
		$limit 	= 18;

		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select( array('id', 'title', 'path', 'thumb', 'created_on'));
		$query->from($db->quoteName('#__spmedia'));

		if($search) {
			$search = preg_replace('#\xE3\x80\x80#s', " ", trim($search));
	    	$search_array = explode(" ", $search);
			$query->where($db->quoteName('title') . " LIKE '%" . implode("%' OR " . $db->quoteName('title') . " LIKE '%", $search_array) . "%'");
		}

		if($date) {
			$year_month = explode('-', $date);
			$query->where('YEAR(created_on) = ' . $year_month[0]);
			$query->where('MONTH(created_on) = ' . $year_month[1]);
		}

		$query->order('created_on DESC');
		$query->setLimit($limit, $start);
		$db->setQuery($query);
		$items = $db->loadObjectList();

		return $items;
	}

	public function getDateFilters($date = '', $search = '') {
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select('DISTINCT YEAR( created_on ) AS year, MONTH( created_on ) AS month');
		$query->from($db->quoteName('#__spmedia'));

		if($search) {
			$search = preg_replace('#\xE3\x80\x80#s', " ", trim($search));
	    	$search_array = explode(" ", $search);
			$query->where($db->quoteName('title') . " LIKE '%" . implode("%' OR " . $db->quoteName('title') . " LIKE '%", $search_array) . "%'");
		} 
		
		if($date) {
			$date = explode('-', $date);
			$query->where('YEAR(created_on) = ' . $date[0]);
			$query->where('MONTH(created_on) = ' . $date[1]);
		}

		$query->order('created_on DESC');
		$db->setQuery($query);

		return $db->loadObjectList();
	}

	public function getTotalMedia($date = '', $search = '') {
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select( 'COUNT(id)' );
		$query->from($db->quoteName('#__spmedia'));

		if($search) {
			$search = preg_replace('#\xE3\x80\x80#s', " ", trim($search));
	    	$search_array = explode(" ", $search);
			$query->where($db->quoteName('title') . " LIKE '%" . implode("%' OR " . $db->quoteName('title') . " LIKE '%", $search_array) . "%'");
		}

		if($date) {
			$date = explode('-', $date);
			$query->where('YEAR(created_on) = ' . $date[0]);
			$query->where('MONTH(created_on) = ' . $date[1]);
		}

		$db->setQuery($query);

		return $db->loadResult();
	}

	public function insertMedia($title, $path, $thumb='', $type='image') {
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$columns = array('title', 'path', 'thumb', 'type', 'alt', 'extension', 'created_on', 'created_by');
		$values = array($db->quote($title), $db->quote($path), $db->quote($thumb), $db->quote($type), $db->quote($title), $db->quote('com_sppagebuilder'), $db->quote( JFactory::getDate('now') ), JFactory::getUser()->id);
		$query
		    ->insert($db->quoteName('#__spmedia'))
		    ->columns($db->quoteName($columns))
		    ->values(implode(',', $values));
		 
		$db->setQuery($query);
		$db->execute();
		$insertid = $db->insertid();

		return $insertid;
	}

	public function getMediaByID($id) {
		$db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select($db->quoteName(array('title', 'path', 'thumb')));
        $query->from($db->quoteName('#__spmedia'));
        $query->where($db->quoteName('id') . ' = ' . $db->quote($id));
        $db->setQuery($query);

        return $db->loadObject();
	}

	public function removeMediaByID($id) {
		$db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $conditions = array($db->quoteName('id') . ' = ' . $db->quote($id));
        $query->delete($db->quoteName('#__spmedia'));
        $query->where($conditions);
        $db->setQuery($query);
        $db->execute();

        return true;
	}

	// Browse Folders
	public function getFolders() {

		$input 	= JFactory::getApplication()->input;
        $path 	= $input->post->get('path', '/images', 'PATH');

        $output = array();
		$images = JFolder::files(JPATH_ROOT . $path, '.png|.jpg|.gif|.svg', false, true);
		$folders_list = JFolder::folders(JPATH_ROOT . $path, '.', false, false, array('.svn', 'CVS', '.DS_Store', '__MACOSX', '_spmedia_thumbs'));
		$folders = self::listFolderTree(JPATH_ROOT . '/images', '.');

		$output['images'] = $images;
		$output['folders_list'] = $folders_list;
		$output['folders'] = $folders;

		return $output;
	}

	public static function listFolderTree($path, $filter, $maxLevel = 3, $level = 0, $parent = 0)
	{
		$dirs = array();

		if ($level == 0)
		{
			$GLOBALS['_JFolder_folder_tree_index'] = 0;
		}

		if ($level < $maxLevel)
		{
			$folders    = JFolder::folders($path, $filter, false, false, array('.svn', 'CVS', '.DS_Store', '__MACOSX', '_spmedia_thumbs'));
			$pathObject = new JFilesystemWrapperPath;

			// First path, index foldernames
			foreach ($folders as $name)
			{
				$id = ++$GLOBALS['_JFolder_folder_tree_index'];
				$fullName = $pathObject->clean($path . '/' . $name);
				$dirs[] = array('id' => $id, 'parent' => $parent, 'name' => $name, 'fullname' => $fullName,
					'relname' => str_replace(JPATH_ROOT, '', $fullName));
				$dirs2 = self::listFolderTree($fullName, $filter, $maxLevel, $level + 1, $id);
				$dirs = array_merge($dirs, $dirs2);
			}
		}

		return $dirs;
	}
	
}