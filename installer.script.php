<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2016 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('restricted aceess');

class com_sppagebuilderInstallerScript {

    public function uninstall($parent)
    {
        $db = JFactory::getDBO();
        $status = new stdClass;
        $status->modules = array();
        $status->plugins = array();
        $manifest = $parent->getParent()->manifest;

        $modules = $manifest->xpath('modules/module');
        foreach ($modules as $module)
        {
            $name = (string)$module->attributes()->module;
            $client = (string)$module->attributes()->client;
            $db = JFactory::getDBO();
            $query = "SELECT `extension_id` FROM `#__extensions` WHERE `type`='module' AND element = ".$db->Quote($name)."";
            $db->setQuery($query);
            $extensions = $db->loadColumn();
            if (count($extensions))
            {
                foreach ($extensions as $id)
                {
                    $installer = new JInstaller;
                    $result = $installer->uninstall('module', $id);
                }
                $status->modules[] = array('name' => $name, 'client' => $client, 'result' => $result);
            }

        }
    }

    function postflight($type, $parent) {

        $db = JFactory::getDBO();
        $status = new stdClass;
        $status->modules = array();
        $status->plugins = array();
        $src = $parent->getParent()->getPath('source');
        $manifest = $parent->getParent()->manifest;

        $modules = $manifest->xpath('modules/module');
        foreach ($modules as $module)
        {
            $name = (string)$module->attributes()->module;
            $client = (string)$module->attributes()->client;
            $path = $src.'/modules/'.$name;
            $db->setQuery("SELECT id FROM #__modules WHERE `module` = ".$db->quote($name));
            $isUpdate = (int)$db->loadResult();

            $installer = new JInstaller;
            $result = $installer->install($path);
            if($client == 'administrator' && !$isUpdate)
            {
                $position = ($name == 'mod_sppagebuilder_icons') ? 'cpanel' : 'menu';
                $db->setQuery("UPDATE #__modules SET `position`=".$db->quote($position).",`published`='1' WHERE `module`=".$db->quote($name));
                $db->query();

                if ($position == 'menu') {
                    $db->setQuery("UPDATE #__modules SET `ordering`='1' WHERE `module` = 'mod_sppagebuilder_admin_menu'");
                    $db->query();
                }

                $db->setQuery("SELECT id FROM #__modules WHERE `module` = ".$db->quote($name));
                $id = (int)$db->loadResult();

                $db->setQuery("INSERT IGNORE INTO #__modules_menu (`moduleid`,`menuid`) VALUES (".$id.", 0)");
                $db->query();
            }

            if ($isUpdate) {
                $position = ($name == 'mod_sppagebuilder_icons') ? 'cpanel' : 'menu';
                if ($position == 'menu') {
                    $db->setQuery("UPDATE #__modules SET `ordering`='1' WHERE `module` = 'mod_sppagebuilder_admin_menu'");
                    $db->query();
                }
            }
        }

    }
}