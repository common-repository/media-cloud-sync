<?php
namespace Dudlewebs\WPMCS;

defined('ABSPATH') || exit;

class Counter {
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
     * Add Count
     * @since 1.0.0
     *
     */
    public static function add(  $property = 'uploaded' ){
        $settings_key = Schema::getConstant('COUNTER_KEY');
        $current      = Utils::get_option( $property, 0, Schema::getConstant('COUNTER_KEY') );
        $current++;
        return Utils::update_option( $property, $current, Schema::getConstant('COUNTER_KEY') );
    }

    /**
     * 
     * Add Count
     * @since 1.0.0
     *
     */
    public static function remove(  $property = 'uploaded' ){
        $settings_key = Schema::getConstant('COUNTER_KEY');
        $current      = Utils::get_option( $property, 0, Schema::getConstant('COUNTER_KEY') );
        $current--;
        return Utils::update_option( $property, $current, Schema::getConstant('COUNTER_KEY') );
    }

    /**
     * Get Count
     * @since 1.0.0
     */
    public static function get( $property = 'uploaded' ) {
        return Utils::get_option( $property, 0, Schema::getConstant('COUNTER_KEY') );
    }

    /**
     * Update Count
     * @since 1.0.0
     */
    public static function update( $property, $value ) {
        return Utils::update_option( $property, $value, Schema::getConstant('COUNTER_KEY') );
    }

    
    public static function instance(){
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}