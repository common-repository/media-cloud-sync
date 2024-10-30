<?php
namespace Dudlewebs\WPMCS;

defined('ABSPATH') || exit;

class Cdn {
    private static $instance = null;
    private $assets_url;
    private $version;
    private $token;

    /**
     * Admin constructor.
     * @since 1.0.0
     */
    public function __construct() {
        $this->assets_url   = WPMCS_ASSETS_URL;
        $this->version      = WPMCS_VERSION;
        $this->token        = WPMCS_TOKEN;

        // Initialize setup
        // $this->init();
    }
    /**
     * 
     * CDN url generate
     * @since 1.0.0
     *
     */
    public static function may_generate_cdn_url($url, $key){
        $settings = Utils::get_settings();
        if (
            isset($settings['enable_cdn']) && $settings['enable_cdn'] &&
            isset($settings['cdn_url']) && !empty($settings['cdn_url']) &&
            isset($url) && !empty($url) &&
            isset($key) && !empty($key)
        ) {

            $urlArray =  explode($key, $url );
            if(isset($urlArray) && !empty($urlArray) && isset($urlArray[0])) {
                $new_url = str_replace(trailingslashit($urlArray[0]), trailingslashit($settings['cdn_url']), $url);
                $new_url = apply_filters('wpmcs_cdn_url', $new_url, $url, $settings['cdn_url']);
                $new_url = preg_replace('/([^:])(\/{2,})/', '$1/', $new_url); // to remove double slash trapped during any operations
                return $new_url;
            }

        }
        return $url;
    }


    
    public static function instance(){
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}