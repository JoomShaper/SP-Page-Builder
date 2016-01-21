<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2016 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('restricted aceess');

jimport( 'joomla.filesystem.file' );
jimport('joomla.filesystem.folder');

class AddonParser
{
    private static $sppagebuilderAddonTags = array();

    public static function addAddon($tag, $func)
    {
        if ( is_callable($func) )
                self::$sppagebuilderAddonTags[$tag] = $func;
    }

    public static function spDoAddon($content, $mm='')
    {

        if ( false === strpos( $content, '[' ) ) {
            return $content;
        }
        if (empty(self::$sppagebuilderAddonTags) || !is_array(self::$sppagebuilderAddonTags))
            return $content;
        $pattern = self::getAddonRegex();
        return preg_replace_callback( "/$pattern/s", array('AddonParser','doAddonTag'), $content );
    }


    private static function getAddonRegex()
    {
        $tagnames = array_keys(self::$sppagebuilderAddonTags);
        $tagregexp = join( '|', array_map('preg_quote', $tagnames) );
        // WARNING! Do not change this regex without changing do_addon_tag() and strip_addon_tag()
        // Also, see addon_unautop() and shortcode.js.
        return
                  '\\['                              // Opening bracket
                . '(\\[?)'                           // 1: Optional second opening bracket for escaping shortcodes: [[tag]]
                . "($tagregexp)"                     // 2: Shortcode name
                . '(?![\\w-])'                       // Not followed by word character or hyphen
                . '('                                // 3: Unroll the loop: Inside the opening shortcode tag
                .     '[^\\]\\/]*'                   // Not a closing bracket or forward slash
                .     '(?:'
                .         '\\/(?!\\])'               // A forward slash not followed by a closing bracket
                .         '[^\\]\\/]*'               // Not a closing bracket or forward slash
                .     ')*?'
                . ')'
                . '(?:'
                .     '(\\/)'                        // 4: Self closing tag ...
                .     '\\]'                          // ... and closing bracket
                . '|'
                .     '\\]'                          // Closing bracket
                .     '(?:'
                .         '('                        // 5: Unroll the loop: Optionally, anything between the opening and closing shortcode tags
                .             '[^\\[]*+'             // Not an opening bracket
                .             '(?:'
                .                 '\\[(?!\\/\\2\\])' // An opening bracket not followed by the closing shortcode tag
                .                 '[^\\[]*+'         // Not an opening bracket
                .             ')*+'
                .         ')'
                .         '\\[\\/\\2\\]'             // Closing shortcode tag
                .     ')?'
                . ')'
                . '(\\]?)';                          // 6: Optional second closing brocket for escaping shortcodes: [[tag]]
    }


    private static function doAddonTag ( $m )
    {
        // allow [[foo]] syntax for escaping a tag
        if ( $m[1] == '[' && $m[6] == ']' ) {
                return substr($m[0], 1, -1);
        }
        $tag = $m[2];
        $attr = self::addonParseAtts( $m[3] );
        if ( isset( $m[5] ) ) {
                // enclosing tag - extra parameter
                return $m[1] . call_user_func( self::$sppagebuilderAddonTags[$tag], $attr, $m[5], $tag ) . $m[6];
        } else {
                // self-closing tag
                return $m[1] . call_user_func( self::$sppagebuilderAddonTags[$tag], $attr, null,  $tag ) . $m[6];
        }
    }


    private static function addonParseAtts($text)
    {
        $atts = array();
        $pattern = '/(\w+)\s*=\s*"([^"]*)"(?:\s|$)|(\w+)\s*=\s*\'([^\']*)\'(?:\s|$)|(\w+)\s*=\s*([^\s\'"]+)(?:\s|$)|"([^"]*)"(?:\s|$)|(\S+)(?:\s|$)/';
        $text = preg_replace("/[\x{00a0}\x{200b}]+/u", " ", $text);
        if ( preg_match_all($pattern, $text, $match, PREG_SET_ORDER) ) {
                foreach ($match as $m) {
                        if (!empty($m[1]))
                                $atts[strtolower($m[1])] = stripcslashes($m[2]);
                        elseif (!empty($m[3]))
                                $atts[strtolower($m[3])] = stripcslashes($m[4]);
                        elseif (!empty($m[5]))
                                $atts[strtolower($m[5])] = stripcslashes($m[6]);
                        elseif (isset($m[7]) and strlen($m[7]))
                                $atts[] = stripcslashes($m[7]);
                        elseif (isset($m[8]))
                                $atts[] = stripcslashes($m[8]);
                }
        } else {
                $atts = ltrim($text);
        }
        return $atts;
    }
    

    public static function getAddons( $folders = array() )
    {
        $app = JFactory::getApplication();
        $template = $app->getTemplate();

        require_once JPATH_COMPONENT_SITE . '/addons/module/site.php';//include module manually

        $template_path = JPATH_ROOT . '/templates/' . $template;

        $tmpl_folders = array();
        if (file_exists($template_path . '/sppagebuilder/addons'))
        {
            $tmpl_folders = JFolder::folders( $template_path . '/sppagebuilder/addons');
        }
        

        $folders = JFolder::folders( JPATH_COMPONENT_SITE .'/addons');

        if($tmpl_folders){
            $merge_folders = array_merge( $folders, $tmpl_folders );
            $folders = array_unique( $merge_folders );
        }

        if (count($folders))
        {
            foreach ($folders as $folder)
            {
                $tmpl_file_path = $template_path . '/sppagebuilder/addons/'.$folder.'/site.php';
                $com_file_path = JPATH_COMPONENT_SITE . '/addons/'.$folder.'/site.php';
                if($folder!='module') {
                    if(file_exists( $tmpl_file_path ))
                    {
                        require_once $tmpl_file_path;
                    }
                    else if(file_exists( $com_file_path ))
                    {
                        require_once $com_file_path;
                    }
                }
            }
        }
    }


    public static function viewAddons( $content, $fullwidth = 0 ){
        if (is_array($content))
        {

            $output = '';

            foreach ($content as $key => $row)
            {

                $fullscreen = 0;

                if (isset($settings->fullscreen) && $settings->fullscreen) $fullscreen = 1;

                $settings   = $row->settings;
                $row_class  = (isset($settings->class))?$settings->class:'';
                $row_id     = (isset($settings->id))?$settings->id:'';

                $style ='style="';
                if (isset($settings->margin) && $settings->margin) $style .= 'margin:'.$settings->margin.';';
                if (isset($settings->padding) && $settings->padding) $style .= 'padding:'.$settings->padding.';';
                if (isset($settings->color) && $settings->color) $style .= 'color:'.$settings->color.';';
                if (isset($settings->background_color) && $settings->background_color) $style .= 'background-color:'.$settings->background_color.';';
                
                if (isset($settings->background_image) && $settings->background_image) {
                    $style .= 'background-image:url('. JURI::base(true) . '/' . $settings->background_image.');';

                    if (isset($settings->background_repeat) && $settings->background_repeat) $style .= 'background-repeat:'.$settings->background_repeat.';';
                    if (isset($settings->background_size) && $settings->background_size) $style .= 'background-size:'.$settings->background_size.';';
                    if (isset($settings->background_attachment) && $settings->background_attachment) $style .= 'background-attachment:'.$settings->background_attachment.';';
                    if (isset($settings->background_position) && $settings->background_position) $style .= 'background-position:'.$settings->background_position.';';

                }
                
                $style .='"';

                if ( isset( $settings->fullscreen ) ) $fullscreen = $settings->fullscreen;
                
                if (isset($settings->background_video) && $settings->background_video) {

                    $video = JPATH_ROOT . '/' . $settings->background_video;
                    $video_param = '';

                    if (isset($settings->background_image) && $settings->background_image) $video_param .= ' data-vide-image="' . JURI::base(true) . '/' . $settings->background_image . '"';
                    if (isset($settings->background_video_mp4) && $settings->background_video_mp4) $video_param .= ' data-vide-mp4="' . $settings->background_video_mp4 . '"';
                    if (isset($settings->background_video_ogv) && $settings->background_video_ogv) $video_param .= ' data-vide-ogv="' . $settings->background_video_ogv . '"';
                
                    $output .= '<section '.(($row_id)?'id="'.$row_id.'"':'').' class="sppb-section '.$row_class.'" '.$style.$video_param.' data-vide-bg>';
                } else {
                    $output .= '<section '.(($row_id)?'id="'.$row_id.'"':'').' class="sppb-section '.$row_class.'" '.$style.'>';
                }

                if(!$fullscreen) {
                    if( $fullwidth ) {
                    //$output .= '<div class="sppb-row">';
                        $output .= '<div class="sppb-container">';
                    }
                }

                //Title
                if ( (isset($settings->title) && $settings->title) || (isset($settings->subtitle) && $settings->subtitle) ) {

                    $title_position = '';
                    if (isset($settings->title_position) && $settings->title_position) {
                        $title_position = $settings->title_position;
                    }

                    if($fullscreen) { // Add container to full width row
                        $output .= '<div class="sppb-container">';
                    }

                    $output .= '<div class="sppb-section-title ' . $title_position . '">';

                    if($settings->title) {

                        $heading_selector   = 'h2';
                        $title_style        ='style="';


                        if(isset($settings->heading_selector)) {
                            if($settings->heading_selector == '') {
                                $heading_selector = 'h2';
                            } else {
                                $heading_selector = $settings->heading_selector;
                            }
                        }

                        //Title Font Size
                        if(isset($settings->title_fontsize)) {
                            if($settings->title_fontsize != '') {
                                $title_style .= 'font-size:'.$settings->title_fontsize.'px;line-height: '.$settings->title_fontsize.'px;';
                            }
                        }

                        //Title Font Weight
                        if(isset($settings->title_fontweight)) {
                            if($settings->title_fontweight != '') {
                                $title_style .= 'font-weight:'.$settings->title_fontweight.';';
                            }
                        }

                        //Title Text Color
                        if(isset($settings->title_text_color)) {
                            if($settings->title_text_color != '') {
                                $title_style .= 'color:'.$settings->title_text_color. ';';
                            }
                        }  

                        //Title Margin Top
                        if(isset($settings->title_margin_top)) {
                            if($settings->title_margin_top != '') {
                               $title_style .= 'margin-top:' . $settings->title_margin_top . 'px;';
                            }
                        }                          

                        //Title Margin Bottom
                        if(isset($settings->title_margin_bottom)) {
                            if($settings->title_margin_bottom != '') {
                               $title_style .= 'margin-bottom:' . $settings->title_margin_bottom . 'px;';
                            }
                        }   

                        $title_style .='"';                                           

                        $output .= '<'. $heading_selector .' class="sppb-title-heading" '.$title_style.'>' . $settings->title . '</'. $heading_selector .'>';

                    }

                    if($settings->subtitle) {

                        $subtitle_fontsize      = '';

                        //Style
                        if(isset($settings->title_fontsize)) {
                            if($settings->title_fontsize != '') {
                                $subtitle_fontsize = 'style="font-size:'.$settings->subtitle_fontsize.'px;"';
                            }
                        }

                        $output .= '<p class="sppb-title-subheading" '. $subtitle_fontsize .'>' . $settings->subtitle . '</p>';
                    }

                    $output .= '</div>';

                    if($fullscreen) { // Add container to full width row
                        $output .= '</div>';
                    }
                }

                $output .= '<div class="sppb-row">';

                foreach ($row->attr as $key => $column)
                {
                    $col_settings = $column->settings;
                    $col_class  = (isset($col_settings->class))?$col_settings->class:'';

                    $col_style ='style="';
                    if (isset($col_settings->color) && $col_settings->color) $col_style .= 'color:'.$col_settings->color.';';
                    if (isset($col_settings->background) && $col_settings->background) $col_style .= 'background-color:'.$col_settings->background.';';
                    if (isset($col_settings->padding) && $col_settings->padding) $col_style .= 'padding:'.$col_settings->padding.';';
                    $col_style .='"';

                    $data_attr = '';
                    if (isset($col_settings->animation) && $col_settings->animation) {
                        $col_class .= ' sppb-wow ' . $col_settings->animation;
                    }
                    if (isset($col_settings->animationduration) && $col_settings->animationduration) $data_attr .= ' data-sppb-wow-duration="'.$col_settings->animationduration.'ms"';
                    if (isset($col_settings->animationdelay) && $col_settings->animationdelay) $data_attr .= ' data-sppb-wow-delay="'.$col_settings->animationdelay.'ms"';

                    $column_name = str_replace('column-parent ', '', $column->class_name);

                    $output .= '<div class="sppb-'.str_replace('active-column-parent', '', $column_name). '">';
                    $output .= '<div class="sppb-addon-container'.$col_class.'" '.$col_style.$data_attr.'>';

                    foreach ($column->attr as $key => $spcode)
                    {
                        $output .= '[sp_'.$spcode->name;

                        if (!empty($spcode->atts))
                        {
                            foreach ($spcode->atts as $key => $value)
                            {
                                $output .= ' '.$key.'="'.htmlspecialchars($value).'"';
                            }
                        }
                        $output .= ']';

                        if (is_array($spcode->scontent))
                        {
                            foreach ($spcode->scontent as $key => $spcode_inner) {
                                $output .= '['.$spcode_inner->name;

                                foreach ($spcode_inner->atts as $key => $value) {
                                    $output .= ' '.$key.'="'.htmlspecialchars($value).'"';
                                }

                                $output .= ']';
                            }
                        }
                        else
                        {
                            $output .= $spcode->scontent;
                        }

                        $output .= '[/sp_'.$spcode->name.']';
                    }

                    $output .= '</div>';//end column
                    $output .= '</div>';//end column
                }

                $output .= '</div>';

                if(!$fullscreen) {
                    if( $fullwidth ) {
                        $output .= '</div>';//end sppb-contaniner
                        //$output .= '</div>';//end spppb-row
                    }
                }

                $output .= '</section>';

            }

            return htmlspecialchars_decode(AddonParser::spDoAddon($output));
        }else{
           return '<p>'.$content.'</p>';
        }
    }

}



function spAddonAtts( $pairs, $atts, $shortcode = '' ) {
    $atts = (array)$atts;
    $out = array();
    foreach($pairs as $name => $default) {
        if ( array_key_exists($name, $atts) )
            $out[$name] = $atts[$name];
        else
            $out[$name] = $default;
    }

    return $out;
}

AddonParser::getAddons();