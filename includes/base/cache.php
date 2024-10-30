<?php
namespace Dudlewebs\WPMCS;

defined('ABSPATH') || exit;

class Cache {
    private static $instance = null;
    private $assets_url;
    private $version;
    private $token;


    private static $cached_data=[];

    /**
     * Admin constructor.
     * @since 1.0.0
     */
    public function __construct() {
        $this->assets_url   = WPMCS_ASSETS_URL;
        $this->version      = WPMCS_VERSION;
        $this->token        = WPMCS_TOKEN;

        // Initialize setup
        $this->init();
    }

    /**
     * Initialize datas
     */
    public function init() {
    }


    /**
     * Update Static Cache
     */
    public static function update_item_cache( $item_id, $data ){
        self::$cached_data[$item_id] = $data;
        return true;
    }

    /**
     * Update Static Cache
     */
    public static function get_item_cache( $item_id, $default = false ){
        return isset(self::$cached_data[$item_id]) ? self::$cached_data[$item_id] : $default;
    }

    /**
     * Delete Static Cache
     */
    public static function delete_item_cache( $item_id = false ){
        if($item_id === false) {
            self::$cached_data = [];
        } else {
            unset(self::$cached_data[$item_id]);
        }
        return true;
    }

    /**
     * Get Object Cache
     */
    public static function get_object_cache($key, $post_id = false, $meta_name = false, $cache_expire = false) {
        $meta_name      = $meta_name == false ? Schema::getConstant('META_KEY') : $meta_name;
        $cache_expire   = $cache_expire == false ? Schema::getConstant('CACHE_EXPIRE') : $cache_expire;

        $cache_enabled  = wp_using_ext_object_cache();
        $cache_key      = ($post_id == false ? '' : $post_id) . $meta_name . '_' . $key;

        if ($cache_enabled) {
            $data = wp_cache_get($cache_key, Schema::getConstant('CACHE_GROUP'));
            if ($data !== false) return $data;
        }

        $meta_data = $post_id == false ? get_option($meta_name, []) : get_post_meta($post_id, $meta_name, true);
        $data = isset($meta_data[$key]) ? $meta_data[$key] : false;

        if ($data && $cache_enabled) {
            wp_cache_set($cache_key, $data, Schema::getConstant('CACHE_GROUP'), $cache_expire);
        }

        return $data;
    }

    /**
     * Set Object Cache
     */
    public static function set_object_cache($key, $data, $post_id = false, $meta_name = false, $cache_expire = false) {
        $meta_name      = $meta_name == false ? Schema::getConstant('META_KEY') : $meta_name;
        $cache_expire   = $cache_expire == false ? Schema::getConstant('CACHE_EXPIRE') : $cache_expire;

        $meta_data      = $post_id == false ? get_option($meta_name, []) : get_post_meta($post_id, $meta_name, true);

        if (is_array($meta_data)) {
            if(isset($meta_data[$key])){
                if($meta_data[$key] == $data) {
                    return true;
                }
            }
            $meta_data[$key] = $data;
        } else {
            $meta_data = [$key => $data];
        }

        $update_result = $post_id == false ? update_option($meta_name, $meta_data) : update_post_meta($post_id, $meta_name, $meta_data);
      
        // Set cache only if data update was successful
        if (wp_using_ext_object_cache() && $update_result) {
            $cache_key = ($post_id == false ? '' : $post_id) . $meta_name . '_' . $key;
            wp_cache_set($cache_key, $data, Schema::getConstant('CACHE_GROUP'), Schema::getConstant('CACHE_EXPIRE'));
        }

        // Return success if data update was successful
        return $update_result;
    }

    

    /**
     * Delete object cache
     */
    public static function delete_object_cache($key = false, $post_id = false, $meta_name = false) {
        $meta_name = $meta_name == false ? Schema::getConstant('META_KEY') : $meta_name;
        $update_result = false;
        $meta_data = $post_id == false ? get_option($meta_name, []) : get_post_meta($post_id, $meta_name, true);

        if (is_array($meta_data)) {
            if($key == false) {
                $update_result = $post_id == false ? delete_option($meta_name) : delete_post_meta($post_id, $meta_name);
            } else if (array_key_exists($key, $meta_data)) {
                unset($meta_data[$key]);
                if(empty($meta_data)) {
                    $update_result = $post_id == false ? delete_option($meta_name) : delete_post_meta($post_id, $meta_name);
                } else {
                    $update_result = $post_id == false ? update_option($meta_name, $meta_data) : update_post_meta($post_id, $meta_name, $meta_data);
                }
            }
        }

        // Delete from object cache if caching is enabled
        if (wp_using_ext_object_cache() && $update_result && $key) {
            $cache_key = ($post_id == false ? '' : $post_id) . $meta_name . '_' . $key;
            wp_cache_delete($cache_key, Schema::getConstant('CACHE_GROUP'));
        }

        // Return success if data delete was successful
        return $update_result;
    }

    public static function instance(){
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}