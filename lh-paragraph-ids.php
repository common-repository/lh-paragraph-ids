<?php
/**
 * Plugin Name: LH Paragraph IDs
 * Plugin URI: https://lhero.org/portfolio/lh-paragraph-ids/
 * Description:  This plug-in adds a customizable, 'id' attribute to your <p>, <h2>, <h3> tags on singular posts. This enables links to specific elements in your posts and pages.  
 * Author: Peter Shaw
 * Version: 2.00
 * Text Domain: lh_paragraph_ids
 * Domain Path: /languages
 * Author URI: https://shawfactor.com
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/*
*  LH Paragraph IDs class
*
*  @description:
*/


if (!class_exists('LH_Paragraph_ids_plugin')) {


class LH_Paragraph_ids_plugin {

    private static $instance;

    static function return_plugin_namespace(){
    
        return 'lh_paragraph_ids';
    
    }


    static function return_id_string(){
    
        return 'lh_element_id';
    
    }
    
    static function return_elegible_tags(){
        
        $array = array('p','h1','h2','h3','h4');
        
        return apply_filters(self::return_plugin_namespace().'_return_elegible_tags', $array);
        
    }

    static function paragraph_links_enabled(){
        
        return apply_filters('lh_paragraph_ids_link_enabled', false);
    
    }

    /*
    *  gatherClass
    *
    *  @description: 
    */
    
    static function gatherClass() {
        $classes = array('lh-paragraph-id');

        return $classes;   

    }
    

    static function is_not_empty($input) {
        
        $input = trim($input);
    
        if ($input != ''){
            
            return true;
            
        } else {
    
            return false;
        
        }
    }

    static function do_elements($tag, $document, $postid){
        
        $count = 0;
        
        //Find all images
        $elements = $document->getElementsByTagName($tag);
    
        if (($elements->length != 0) && !empty(self::paragraph_links_enabled())){
        
            wp_enqueue_script(self::return_plugin_namespace().'-script');    
    
        }
        
        //Iterate though images
        foreach ($elements AS $element) {
    
            if ($id = $element->getAttribute('id')){
    
                //do nothing 
    
            } else {
        
                $element->setAttribute("id", self::return_id_string().'-'.$element->tagName.$postid.'-'.$count);
    
                $count++;
    
            }
    
            if ($class = $element->getAttribute('class')){
        
                $class = explode(' ' , $class);
    
                $new = array_unique(array_merge(self::gatherClass(), $class));
    
                $element->setAttribute("class", implode( ' ' , $new));
        
        
            } else {
        
                $element->setAttribute("class", implode( ' ' , self::gatherClass()));
        
            }
        
        }    
        
        return $elements;
    
    }

    public function register_core_scripts(){
        
         if (!class_exists('LH_Register_file_class')) {
         
            include_once('includes/lh-register-file-class.php');
        
        }
    
        $add_array = array('defer="defer"');
        $add_array[] = 'id="'.self::return_plugin_namespace().'-script"';
        
        $lh_sortable_tables_script = new LH_Register_file_class( self::return_plugin_namespace().'-script', plugin_dir_path( __FILE__ ).'scripts/lh-paragraph-ids.js', plugins_url( '/scripts/lh-paragraph-ids.js', __FILE__ ), true, array(), true, $add_array);
        
        unset($add_array);
        
    }


    /*
    *  para_ids_content_filter
    *
    *  @description: 
    */
    public function para_ids_content_filter( $content ){
        

        if (self::is_not_empty($content) && !empty(get_the_ID())){

            //libxml_use_internal_errors(true);  
            libxml_use_internal_errors(true); 
            $document = new DOMDocument;
            $document->loadHTML('<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head><body>'.stripslashes($content).'</body></html>');
            
            //Iterate though imagesthe elegible tags
            foreach (self::return_elegible_tags() AS $elegible_tag) {
                
                self::do_elements($elegible_tag, $document, get_the_ID());
                
            }
        
            $body = $document->documentElement->lastChild;

            //very ugly regex, should do this via dom
            preg_match("/<body[^>]*>(.*?)<\/body>/is", $document->saveHTML($body), $matches);
            //libxml_clear_errors();
            libxml_clear_errors();
            
            if (!empty($matches[1])){

                $content = $matches[1];
                
            } 
            global $wp_filter;
            $current_filter_data = $wp_filter[ current_filter() ];
            
            $removed = remove_filter('the_content', array($this,'para_ids_content_filter'),$current_filter_data->current_priority(), 1);    

        }
 
        return $content;

    }
        
    public function add_hooks($classes){
        
        if (is_singular() && !is_admin()){

            add_filter('the_content', array($this,'para_ids_content_filter'),10, 1);
            
        }
        
        return $classes;
    
    }



    public function plugins_loaded(){
        
        //load translations
        load_plugin_textdomain( self::return_plugin_namespace(), false, basename( dirname( __FILE__ ) ) . '/languages' );
        
        //register the core scripts and styles
        add_action( 'wp_loaded', array($this, 'register_core_scripts'), 10 ); 
            
        //add on body open so that it only runs when needed
        add_filter( 'body_class', array($this,'add_hooks'));
    
    }




    /**
     * Gets an instance of our plugin.
     *
     * using the singleton pattern
     */
     
    public static function get_instance(){
        if (null === self::$instance) {
            self::$instance = new self();
        }
 
        return self::$instance;
    }




    /*
    *  Constructor
    *
    *  @description: This method will be called each time this object is created
    */

    public function __construct() {

    	//run our hooks on plugins loaded to as we may need checks       
        add_action( 'plugins_loaded', array($this,'plugins_loaded'));

    }


}

$lh_paragraph_ids_instance = LH_Paragraph_ids_plugin::get_instance();

}

?>