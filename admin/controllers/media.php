<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2015 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('restricted aceess');

jimport('joomla.application.component.controllerform');
jimport( 'joomla.application.component.helper' );
jimport('joomla.filesystem.folder');
jimport('joomla.filesystem.file');
jimport('joomla.image.image');

class SppagebuilderControllerMedia extends JControllerForm
{

	private static function getYears() {
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select('DISTINCT YEAR( created_on ) AS year, MONTH( created_on ) AS month');
		$query->from($db->quoteName('#__sppagebuilder_media'));
		$query->order('created_on DESC');
		$db->setQuery($query);
		$dates = $db->loadObjectList();

		$output = '<select class="date-filter">';
		$output .= '<option value="">'. JText::_('COM_SPPAGEBUILDER_MEDIA_MANAGER_MEDIA_ALL') .'</option>';
		foreach ( $dates as $date ) {
			$output .= '<option value="'. $date->year . '-' . $date->month .'">'. JHtml::_('date', $date->year . '-' . $date->month, 'F Y') .'</option>';
		}
		$output .= '</select>';

		return $output;

	}

	private static function getTotal($date = '') {
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select( 'COUNT(id)' );
		$query->from($db->quoteName('#__sppagebuilder_media'));

		if($date) {
			$date = explode('-', $date);
			$query->where('YEAR(created_on) = ' . $date[0]);
			$query->where('MONTH(created_on) = ' . $date[1]);
		}

		$db->setQuery($query);

		return $db->loadResult();
	}

	public function browse() {

		$input 	= JFactory::getApplication()->input;
        $date 	= $input->post->get('date', NULL, 'STRING');
        $start 	= $input->post->get('start', 0, 'INT');
        $limit 	= 18;

		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select( array('id', 'title', 'path', 'created_on'));
		$query->from($db->quoteName('#__sppagebuilder_media'));

		if($date) {
			$year_month = explode('-', $date);
			$query->where('YEAR(created_on) = ' . $year_month[0]);
			$query->where('MONTH(created_on) = ' . $year_month[1]);
		}

		$query->order('created_on DESC');
		$query->setLimit($limit, $start);
		$db->setQuery($query);
		$items = $db->loadObjectList();

		$report = array();

		$report['date_filter'] 	= self::getYears();
		
		if(self::getTotal($date) > ($limit + $start)) {
			$report['loadmore'] 	= true;
		} else {
			$report['loadmore'] 	= false;	
		}
		
		$report['output'] 		= '';

		if(!$start) $report['output'] .= '<ul class="sppb-media-images">';
		
		if(count($items)) {
			foreach ($items as $key => $item) {
				$report['output'] .= '<li>';
					$report['output'] .= '<div>';
						$report['output'] .= '<div>';
							$report['output'] .= '<div class="sppb-media-image">';
								$report['output'] .= '<img src="'. JURI::root(true) . '/' . $item->path .'">';
								$report['output'] .= '<span class="sppb-media-title">' . $item->title .'</span>';
							$report['output'] .= '</div>';

							$report['output'] .= '<div class="media-image-information">';
							$report['output'] .= '<span class="sppb-media-date">' . JHtml::_('date', $item->created_on, 'DATE_FORMAT_LC3') .'</span>';

							$media_file = JPATH_ROOT . '/' . $item->path;

							if(JFile::exists($media_file)) {
								$report['output'] .= '<span class="sppb-media-fileszie">'. JText::_('COM_SPPAGEBUILDER_MEDIA_MANAGER_MEDIA_SIZE') .': '. (round(filesize($media_file)/(1024))) .' kb</span>';
								$properties = JImage::getImageFileProperties($media_file);
								$report['output'] .= '<span class="sppb-media-resolution">' . JText::_('COM_SPPAGEBUILDER_MEDIA_MANAGER_MEDIA_RESOLUTION') . ': '. $properties->width . 'x'. $properties->height .' px</span>';
							} else {
								$report['output'] .= '<span class="sppb-media-fileszie">' . JText::_('COM_SPPAGEBUILDER_MEDIA_MANAGER_MEDIA_SIZE') . ': 0 kb</span>';
								$report['output'] .= '<span class="sppb-media-resolution">' . JText::_('COM_SPPAGEBUILDER_MEDIA_MANAGER_MEDIA_RESOLUTION') . ': 0x0 px</span>';
							}
							$report['output'] .= '<a class="remove-media-item" href="#" data-id="'. $item->id .'"><i class="fa fa-times"></i></a>';
							$report['output'] .= '<a class="btn btn-success btn-insert-media" href="#" data-path="'. $item->path .'" data-src="'. JURI::root(true) . '/' . $item->path .'"><i class="fa fa-check"></i> Select</a>';
						$report['output'] .= '</div>';

						$report['output'] .= '</div>';
					$report['output'] .= '</div>';
				$report['output'] .= '</li>';
			}
		}
		
		if(!$start) $report['output'] .= '</ul>';

		echo json_encode($report);

	    die;
	}

	// Upload File
	public function upload() {
		$input 	= JFactory::getApplication()->input;
        $image 	= $input->files->get('image');
        $dir 	= $input->post->get('folder', '', 'PATH');
        $report = array();
        
        if(count($image)) {
            if ($image['error'] == UPLOAD_ERR_OK) {
                $error = false;
                $params = JComponentHelper::getParams('com_media');
                $contentLength = (int) $_SERVER['CONTENT_LENGTH'];
                $mediaHelper = new JHelperMedia;
                $postMaxSize = $mediaHelper->toBytes(ini_get('post_max_size'));
                $memoryLimit = $mediaHelper->toBytes(ini_get('memory_limit'));

                // Check for the total size of post back data.
                if (($postMaxSize > 0 && $contentLength > $postMaxSize) || ($memoryLimit != -1 && $contentLength > $memoryLimit)) {
                    $report['status'] = false;
                    $report['output'] = JText::_('COM_SPPAGEBUILDER_MEDIA_MANAGER_MEDIA_TOTAL_SIZE_EXCEEDS');
                    $error = true;
                    echo json_encode($report);
                    die;
                }

                $uploadMaxSize = $params->get('upload_maxsize', 0) * 1024 * 1024;
                $uploadMaxFileSize = $mediaHelper->toBytes(ini_get('upload_max_filesize'));

                if (($image['error'] == 1) || ($uploadMaxSize > 0 && $image['size'] > $uploadMaxSize) || ($uploadMaxFileSize > 0 && $image['size'] > $uploadMaxFileSize)) {
                    $report['status'] = false;
                    $report['output'] = JText::_('COM_SPPAGEBUILDER_MEDIA_MANAGER_MEDIA_LARGE');
                    $error = true;
                }
                
                // Upload if no error found
                if(!$error) {
                    $date = JFactory::getDate();

                    $folder = 'images/' . JHtml::_('date', $date, 'Y') . '/' . JHtml::_('date', $date, 'm') . '/' . JHtml::_('date', $date, 'd');
                    
                    if($dir != '') {
                    	$folder = ltrim($dir, '/');
                    }

                    if(!file_exists( JPATH_ROOT . '/' . $folder )) {
                        JFolder::create(JPATH_ROOT . '/' . $folder, 0755);
                    }

                    $name = $image['name'];
                    $path = $image['tmp_name'];

                    // Do no override existing file
                    $file = pathinfo($name);
                    $i = 0;
                    do {
                        $base_name  = $file['filename'] . ($i ? "$i" : "");
                        $ext        = $file['extension'];
                        $image_name = $base_name . "." . $ext;
                        $i++;
                        $dest 		= JPATH_ROOT . '/' . $folder . '/' . $image_name;
                        $src 		= $folder . '/'  . $image_name;
                    } while(file_exists($dest));
                    // End Do not override

                    if(JFile::upload($path, $dest)) {

                    	$db = JFactory::getDbo();
						$query = $db->getQuery(true);
						$columns = array('title', 'path', 'created_on', 'created_by');
						$values = array($db->quote($base_name), $db->quote($src), $db->quote( JFactory::getDate('now') ), JFactory::getUser()->id);
						$query
						    ->insert($db->quoteName('#__sppagebuilder_media'))
						    ->columns($db->quoteName($columns))
						    ->values(implode(',', $values));
						 
						$db->setQuery($query);
						$db->execute();
						$insertid = $db->insertid();

						$report['status'] = true;

						$output = '<li>';
							$output .= '<div>';
								$output .= '<div>';
									$output .= '<div class="sppb-media-image">';
										$output .= '<img src="'. JURI::root(true) . '/' . $src .'">';
										$output .= '<span class="sppb-media-title">' . $base_name .'</span>';
									$output .= '</div>';

									$output .= '<div class="media-image-information">';
									$output .= '<span class="sppb-media-date">' . JHtml::_('date', JFactory::getDate('now'), 'DATE_FORMAT_LC3') .'</span>';

									$media_file = JPATH_ROOT . '/' . $src;

									if(JFile::exists($media_file)) {
										$output .= '<span class="sppb-media-fileszie">'. JText::_('COM_SPPAGEBUILDER_MEDIA_MANAGER_MEDIA_SIZE') .': '. (round(filesize($media_file)/(1024))) .' kb</span>';
										$properties = JImage::getImageFileProperties($media_file);
										$output .= '<span class="sppb-media-resolution">'. JText::_('COM_SPPAGEBUILDER_MEDIA_MANAGER_MEDIA_RESOLUTION') .': '. $properties->width . 'x'. $properties->height .' px</span>';
									} else {
										$output .= '<span class="sppb-media-fileszie">'. JText::_('COM_SPPAGEBUILDER_MEDIA_MANAGER_MEDIA_SIZE') .': 0 kb</span>';
										$output .= '<span class="sppb-media-resolution">'. JText::_('COM_SPPAGEBUILDER_MEDIA_MANAGER_MEDIA_RESOLUTION') .': 0x0 px</span>';
									}
									$output .= '<a class="remove-media-item" href="#" data-id="'. $insertid .'"><i class="fa fa-times"></i></a>';
									$output .= '<a class="btn btn-success btn-insert-media" href="#" data-path="'. $src .'" data-src="'. JURI::root(true) . '/' . $src .'"><i class="fa fa-check"></i> Select</a>';
								$output .= '</div>';

								$output .= '</div>';
							$output .= '</div>';
						$output .= '</li>';

                        $report['output'] = $output;
                    }
                }
            }
        } else {
            $report['status'] = false;
            $report['output'] = JText::_('Upload Failed!');
        }

        echo json_encode($report);

        die();
	}

	// Delete File
	public function delete() {
		$input 	= JFactory::getApplication()->input;
        $id 	= $input->post->get('id', NULL, 'INT');
       	
       	$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select(array('path'));
		$query->from($db->quoteName('#__sppagebuilder_media'));
		$query->where($db->quoteName('id') . ' = ' . $db->quote($id));
		$db->setQuery($query);
		$src = JPATH_ROOT . '/' . $db->loadResult();
       
        $report = array();
        $report['status'] = false;

        if(JFile::exists($src)) {
        	if(!JFile::delete($src)) {
        		$report['status'] = false;
                $report['output'] = JText::_('Delete failed');
                echo json_encode($report);
        		die;
        	}
        } else {
        	$report['status'] = true;
        }

        // Remove from database
        $db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$conditions = array($db->quoteName('id') . ' = ' . $db->quote($id));
		$query->delete($db->quoteName('#__sppagebuilder_media'));
		$query->where($conditions);
		$db->setQuery($query);
		$db->execute();
		$report['status'] = true;

        echo json_encode($report);
        die;
	}

	// Browse Folders
	public function folders() {

		$input 	= JFactory::getApplication()->input;
        $path 	= $input->post->get('path', '/images', 'PATH');

		$images = JFolder::files(JPATH_ROOT . $path, '.png|.jpg|.gif', false, true);
		$folders_list = JFolder::folders(JPATH_ROOT . $path, '.');
		$folders = JFolder::listFolderTree(JPATH_ROOT . '/images', '.');

		$tree = '<select class="folder-filter">';
		$tree .= '<option value="/images">/images</option>';
		foreach ( $folders as $folder ) {
			$tree .= '<option value="'. $folder['relname'] .'">'. $folder['relname'] .'</option>';
		}
		$tree .= '</select>';

		$report = array();
		$report['folders_tree'] = $tree;
		$report['output'] 		= '';

		$report['output'] .= '<ul class="sppb-media-images">';

		// Folders List
		if(dirname($path) != '/') {
			$report['output'] .= '<li class="sppb-media-folder">';
			$report['output'] .= '<div>';
			$report['output'] .= '<div>';
			$report['output'] .= '<div class="sppb-media-image">';
			$report['output'] .= '<div class="media-folder-warpper no-margin">';
			$report['output'] .= '<i class="fa fa-arrow-left to-folder-back fa-4x" data-path="'. dirname($path) .'"></i>';
			$report['output'] .= '</div>';
			$report['output'] .= '</div>';
			$report['output'] .= '</div>';
			$report['output'] .= '</div>';
			$report['output'] .= '</li>';
		}

		if(count($folders_list)) {
			foreach ($folders_list as $single_folder) {
				$report['output'] .= '<li class="sppb-media-folder">';
				$report['output'] .= '<div>';
				$report['output'] .= '<div>';
				$report['output'] .= '<div class="sppb-media-image">';
				$report['output'] .= '<span class="sppb-media-title">' . $single_folder .'</span>';
				$report['output'] .= '<div class="media-folder-warpper">';
				$report['output'] .= '<i class="fa fa-folder to-folder fa-4x" data-path="'. $path . '/' . $single_folder .'"></i>';
				$report['output'] .= '</div>';
				$report['output'] .= '</div>';
				$report['output'] .= '</div>';
				$report['output'] .= '</div>';
				$report['output'] .= '</li>';
			}
		}

		if(count($images)) {
			foreach ($images as $image) {

				$image = str_replace(JPATH_ROOT . '/', '', $image);
				$title = JFile::stripExt(basename($image));

				$report['output'] .= '<li class="sppb-media-item">';
					$report['output'] .= '<div>';
						$report['output'] .= '<div>';
							$report['output'] .= '<div class="sppb-media-image">';
								$report['output'] .= '<img src="'. JURI::root(true) . '/' . $image .'">';
								$report['output'] .= '<span class="sppb-media-title">' . $title .'</span>';
							$report['output'] .= '</div>';

							$report['output'] .= '<div class="media-image-information">';
							$media_file = JPATH_ROOT . '/' . $image;

							if(JFile::exists($media_file)) {
								$report['output'] .= '<span class="sppb-media-fileszie">'. JText::_('COM_SPPAGEBUILDER_MEDIA_MANAGER_MEDIA_SIZE') .': '. (round(filesize($media_file)/(1024))) .' kb</span>';
								$properties = JImage::getImageFileProperties($media_file);
								$report['output'] .= '<span class="sppb-media-resolution">'. JText::_('COM_SPPAGEBUILDER_MEDIA_MANAGER_MEDIA_RESOLUTION') .': '. $properties->width . 'x'. $properties->height .' px</span>';
							} else {
								$report['output'] .= '<span class="sppb-media-fileszie">'. JText::_('COM_SPPAGEBUILDER_MEDIA_MANAGER_MEDIA_SIZE') .': 0 kb</span>';
								$report['output'] .= '<span class="sppb-media-resolution">'. JText::_('COM_SPPAGEBUILDER_MEDIA_MANAGER_MEDIA_RESOLUTION') .': 0x0 px</span>';
							}
							$report['output'] .= '<a class="btn btn-success btn-insert-media" href="#" data-path="'. $image .'" data-src="'. JURI::root(true) . '/' . $image .'"><i class="fa fa-check"></i> Select</a>';
						$report['output'] .= '</div>';

						$report['output'] .= '</div>';
					$report['output'] .= '</div>';
				$report['output'] .= '</li>';
			}
		}

		$report['output'] .= '</ul>';
		echo json_encode($report);

	    die;
	}
}