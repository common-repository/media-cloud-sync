<?php
namespace Dudlewebs\WPMCS;

defined('ABSPATH') || exit;

class Db {
    private static $instance = null;
    private string $assets_url;
    private string $version;
    private string $token;


    /**
     * Admin constructor.
     * @since 1.0.0
     */
    public function __construct() {
        $this->assets_url = WPMCS_ASSETS_URL;
        $this->version    = WPMCS_VERSION;
        $this->token      = WPMCS_TOKEN;
    }

    /**
     * Create Database Table
     * 
     */
    public function create_table() {
        global $wpdb;

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

        $table_name = WPMCS_ITEM_TABLE;
        $queries = array();
        $charset_collate = $wpdb->get_charset_collate();
        if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
            $queries[] = "
                CREATE TABLE {$table_name} (
                id BIGINT(20) NOT NULL AUTO_INCREMENT,
                provider varchar(18) NOT NULL,
                region varchar(255) NOT NULL,
                storage varchar(255) NOT NULL,
                source_id bigint(20) NOT NULL,
                source_path varchar(1024) NOT NULL,
                source_type varchar(18) NOT NULL,
                url varchar(1024) NOT NULL,
                `key` varchar(1024) NOT NULL,
                is_private tinyint(1) NOT NULL DEFAULT 0,
                extra longtext DEFAULT NULL,
                PRIMARY KEY (id),
                UNIQUE KEY uidx_url (url(190), id),
                UNIQUE KEY uidx_key (`key`(190), id),
                UNIQUE KEY uidx_source_path (source_path(190), id)
            ) $charset_collate;";
        } 
        dbDelta( $queries );
    }

    /**
     * Database Upgrade 
     * @since 1.0.0
     */
    public function do_database_upgrade() {
        global $wpdb;
        $table_name         = WPMCS_ITEM_TABLE;
        $current_version    = get_option( $this->token.'_db_version' );

        switch($current_version) {
            case '1.0.0': null;
                break;
            default: null;
        }

        update_option( $this->token.'_db_version', WPMCS_DB_VERSION, true );
    }

    /**
     * Ensures only one instance of Class is loaded or can be loaded.
     *
     * @return Db Class instance
     * @since 1.0.0
     * @static
     */
    public static function instance(){
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}