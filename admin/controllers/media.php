<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2016 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('restricted aceess');

jimport('joomla.application.component.controllerform');
jimport( 'joomla.application.component.helper' );
jimport('joomla.filesystem.folder');
jimport('joomla.filesystem.file');
jimport('joomla.image.image');
require_once JPATH_COMPONENT . '/helpers/image.php';

class SppagebuilderControllerMedia extends JControllerForm
{

    // Upload File
    public function upload_media() {
        $model  = $this->getModel();
        $input  = JFactory::getApplication()->input;
        $image  = $input->files->get('image');
        $dir    = $input->post->get('folder', '', 'PATH');
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

                    if(!JFolder::exists( JPATH_ROOT . '/' . $folder )) {
                        JFolder::create(JPATH_ROOT . '/' . $folder, 0755);
                    }

                    if(!JFolder::exists( JPATH_ROOT . '/' . $folder . '/_spmedia_thumbs' )) {
                        JFolder::create(JPATH_ROOT . '/' . $folder . '/_spmedia_thumbs', 0755);
                    }

                    $name = $image['name'];
                    $path = $image['tmp_name'];
                    // Do no override existing file

                    $file = preg_replace('#\s+#', "-", JFile::makeSafe(basename($name)));
                    $i = 0;
                    do {
                        $base_name  = JFile::stripExt($file) . ($i ? "$i" : "");
                        $ext        = JFile::getExt($file);
                        $image_name = $base_name . '.' . $ext;
                        $i++;
                        $dest       = JPATH_ROOT . '/' . $folder . '/' . $image_name;
                        $src        = $folder . '/'  . $image_name;
                    } while(file_exists($dest));
                    // End Do not override

                    if(JFile::upload($path, $dest)) {
                        $thumb = '';
                        
                        if(strtolower($ext) == 'svg') {
                            $report['src'] = JURI::root(true) . '/' . $src;
                        } else {
                            $image = new SppagebuilderHelperImage($dest);
                            if( ($image->getWidth() >300) || ($image->getWidth() >225) ) {
                                $image->createThumbs(array('spmedia_thumb'=>'300x225'), 5, '_spmedia_thumbs');
                                $report['src'] = JURI::root(true) . '/' . $folder . '/_spmedia_thumbs/' . $base_name . '.' . $ext;
                                $thumb      = $folder . '/_spmedia_thumbs/'  . $base_name . '.' . $ext;
                            } else {
                                $report['src'] = JURI::root(true) . '/' . $src;
                            }
                        }

                        $insertid = $model->insertMedia($base_name, $src, $thumb, 'image');
                        $report['status'] = true;
                        $report['title'] = $base_name;
                        $report['id'] = $insertid;
                        $report['path'] = $src;
                    }
                }
            }
        } else {
            $report['status'] = false;
            $report['output'] = JText::_('COM_SPPAGEBUILDER_MEDIA_MANAGER_UPLOAD_FAILED');
        }
        echo json_encode($report);
        die();
    }


    // Delete File
    public function delete_media() {
        $model  = $this->getModel();
        $input  = JFactory::getApplication()->input;
        $id     = $input->post->get('id', NULL, 'INT');

        if(!is_numeric($id)) {
            $report['status'] = false;
            $report['output'] = JText::_('COM_SPPAGEBUILDER_MEDIA_MANAGER_DELETE_FAILED');
            echo json_encode($report);
            die;
        }

        $media = $model->getMediaByID($id);
        $src = JPATH_ROOT . '/' . $media->path;
       
        $report = array();
        $report['status'] = false;

        if(isset($media->thumb) && $media->thumb) {
            if(JFile::exists(JPATH_ROOT . '/' . $media->thumb)) {
                JFile::delete(JPATH_ROOT . '/' . $media->thumb); // Delete thumb
            }
        }

        if(JFile::exists($src)) {
            if(!JFile::delete($src)) {
                $report['status'] = false;
                $report['output'] = JText::_('COM_SPPAGEBUILDER_MEDIA_MANAGER_DELETE_FAILED');
                echo json_encode($report);
                die;
            }
        } else {
            $report['status'] = true;
        }

        // Remove from database
        $media = $model->removeMediaByID($id);
        $report['status'] = true;

        echo json_encode($report);
        die;
    }
}