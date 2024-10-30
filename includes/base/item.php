<?php
namespace Dudlewebs\WPMCS;

defined('ABSPATH') || exit;

class Item {
    private static $instance = null;
    private $assets_url;
    private $version;
    private $token;

    protected $config;
    protected $bucketConfig;
    protected $settings;
    protected $credentials;
    protected $service;

    protected $bucket_name;
    protected $region = '';

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
        $this->settings     = Utils::get_settings();
        $this->credentials  = Utils::get_credentials();
        $this->config       = isset($this->credentials['config']) && !empty($this->credentials['config']) 
                                ? $this->credentials['config']
                                : [];
        $this->bucketConfig =  isset($this->credentials['bucketConfig']) && !empty($this->credentials['bucketConfig']) 
                                ? $this->credentials['bucketConfig']
                                : [];
        $this->service      =  isset($this->credentials['service']) && !empty($this->credentials['service']) 
                                ? $this->credentials['service']
                                : [];

        if (isset($this->bucketConfig['bucket_name'])) {
            $this->bucket_name = $this->bucketConfig['bucket_name'];
        }
        if (isset($this->config['region'])) {
            $this->region = $this->config['region'];
        }
    }

    /**
     * Add Item In database
     * @since 1.0.0
     * @param
     */
    public function add(
        $source_id,
        $url,
        $key,
        $source_path,
        $meta,
        $source_type = 'media_library',
        $is_private = 0
    ) {
        global $wpdb;
        $item_id = false;

        $data = array(
            'provider' => $this->service,
            'region' => $this->region,
            'storage' => $this->bucket_name,
            'source_id' => $source_id,
            'source_path' => $source_path,
            'source_type' => $source_type,
            'url' => $url,
            'key' => $key,
            'is_private' => $is_private,
            'extra' => maybe_serialize($meta),
        );
        if ($wpdb->insert(WPMCS_ITEM_TABLE, $data)) {
            $item_id = $wpdb->insert_id;
            $data['id'] = $item_id;
            Utils::update_meta($source_id, 'item', $data);
            Cache::update_item_cache($source_id.'_item', $data);
            Counter::add( 'uploaded' );
        }

        return $item_id;
    }


    /**
     * Get Item From Db
     */
    public function get($source_id, $source_type = 'media_library') {
        global $wpdb;
        $item = Cache::get_item_cache($source_id.'_item', false); 
        if($item == false) {
            $item = Utils::get_meta($source_id, 'item', false);
            if($item == false){
                $item = $wpdb->get_row("SELECT * FROM ".WPMCS_ITEM_TABLE." WHERE source_id = $source_id AND source_type='$source_type'", ARRAY_A);

                if($wpdb->last_error || null === $item || !(isset($item) && !empty($item))) {
                    return false;
                }

                Utils::update_meta($source_id, 'item', $item);
                Cache::update_item_cache($source_id.'_item', $item);
            } else {
                Cache::update_item_cache($source_id.'_item', $item);
            }
        }
        
        return $item;
    }

    /**
     * Function to delete item from data base
     * @since 1.0.0
     */
    public function delete($source_id){
        global $wpdb;
        if (isset($source_id) && !empty($source_id)) {
            $rows = $wpdb->delete(WPMCS_ITEM_TABLE, array('source_id' => $source_id));
            if ($wpdb->last_error || false === $rows) {
                return false;
            }
            Utils::delete_meta($source_id, 'item');
            Cache::delete_item_cache($source_id.'_item');
            Counter::remove( 'uploaded' );
            return true;
        }
        return false;
    }


     /**
     * Function to update item in data base
     * @since 1.0.0
     */
    public function update($source_id, $data){
        global $wpdb;
        if (isset($source_id) && !empty($source_id)) {

            $data['provider'] = $this->service;
            $data['region'] = $this->region;
            $data['storage'] = $this->bucket_name;

            $rows = $wpdb->update(WPMCS_ITEM_TABLE, $data, array('source_id' => $source_id));
            if ($wpdb->last_error || false === $rows) {
                return false;
            }

            Utils::delete_meta($source_id, 'item');
            Cache::delete_item_cache($source_id.'_item');

            // Reset cache
            $current_data = $this->get($source_id);
            return true;
        }
        return false;
    }

    /**
     * Get extra values of item from database
     * @since 1.0.0
     * @param
     */
    public function get_extras($source_id, $field = false){
        $data = $this->get($source_id); 
        if ($data) {
            if (isset($data['extra']) && !empty($data['extra'])) {

                if(!Utils::is_empty($field)) {
                    $extras = unserialize($data['extra']);
                    return isset($extras[$field]) && !empty($extras[$field]) ? $extras[$field] : false;
                }

                return unserialize($data['extra']);
            }
        }
        return false;
    }


    /**
     * Get column of item from database
     * @since 1.0.0
     * @param
     */
    public function get_field($source_id, $field){
        $data = $this->get($source_id); 
        if ($data) {
            if (isset($data[$field]) && !empty($data[$field])) {
                return $data[$field];
            }
        }
        return false;
    }


    /**
     * Get backup values of item from database
     * @since 1.0.0
     * @param
     */
    public function get_backup($source_id){
        $data = $this->get_extras($source_id);
        if ($data) {
            if (isset($data['backup']) && !empty($data['backup'])) {
                return unserialize($data['backup']);
            }
        }
        return false;
    }


    /**
     * Checking Item that is served by provider And Is rewrite URL is enabled
     * @since 1.0.0
     * @param
     */
    public function is_available_from_provider($attachment_id, $check_rewrite = true){
        $item = $this->get($attachment_id);
        if(Utils::is_empty($item)) {
            return false;
        }

        if ($item['provider'] == $this->service) {
            if(
                ($check_rewrite && (isset($this->settings['rewrite_url']) && $this->settings['rewrite_url'])) ||
                !$check_rewrite
            ) {
                return true;
            } 
        }
        return false;
    }

    /**
     * Get items by paths
     */
    public function get_items_by_source_paths( $paths = [] ) {
        global $wpdb;

        $items = [];

        if (!Utils::is_empty($paths)) {
            // Ensure paths are properly sanitized and ready for the query
            $like_conditions = array();
            foreach ($paths as $path) {
                // Prepare the SQL conditions for exact match in source_path and partial match in extras column
                $like_conditions[] = $wpdb->prepare("(source_path = %s OR extra LIKE %s)", $path, '%' . $wpdb->esc_like($path) . '%');
            }

            // Combine the conditions with OR
            $where_clause = implode(' OR ', $like_conditions);

            // Execute the SQL query to fetch source_id instead of source_path
            $sql = "SELECT DISTINCT source_id FROM " . WPMCS_ITEM_TABLE . " WHERE " . $where_clause;
            $results = $wpdb->get_results($sql, ARRAY_A);

            if ($wpdb->last_error || Utils::is_empty($results)) {
                return [];
            }

            $source_ids = array();
            foreach ($results as $row) {
                $item = $this->get((int)$row['source_id']);
                if(!Utils::is_empty($item)) {
                    $items[] = $item;
                }
            }
            return $items;
        }
        return $items;
    }


    /**
     * Get similar existing files like origin path
     * @since 1.0.0
     */
    public function get_similar_files_by_path($path){
        global $wpdb;
        if (isset($path) && !empty($path)) {
            $results = $wpdb->get_results("SELECT source_path FROM " . WPMCS_ITEM_TABLE . " WHERE source_path LIKE '$path%'", ARRAY_A);
            if ($wpdb->last_error || null === $results || !(isset($results) && !empty($results))) {
                return false;
            }
            $source_paths = array();
            foreach ($results as $row) {
                $source_paths[] = $row['source_path'];
            }
            return $source_paths;
        }
        return false;
    }


     /**
     * Get service url of item from database
     * @since 1.0.0
     * @param
     */
    public function get_url($source_id, $size = 'full'){
        if ($data = $this->get($source_id)) {
            $extras = $this->get_extras($source_id);
            $key    = '';
            $url    = '';
            switch($size) {
                case 'full':
                    $key = $data['key'];
                    $url = $data['url'];
                    break;
                case 'original':
                    if(
                        isset($extras) && !empty($extras) &&
                        isset($extras['original']) && !empty($extras['original'])
                    ) {
                        $key = $extras['original']['key'];
                        $url = $extras['original']['url'];
                    }
                default:
                    if(
                        isset($extras) && !empty($extras) &&
                        isset($extras['sizes']) && !empty($extras['sizes']) &&
                        isset($extras['sizes'][$size]) && !empty($extras['sizes'][$size])
                    ) {
                        $key = $extras['sizes'][$size]['key'];
                        $url = $extras['sizes'][$size]['url'];
                    }
            }

            if(!empty($key)){
                if (
                    isset($this->settings['enable_presigned']) && $this->settings['enable_presigned'] &&
                    isset($this->settings['presigned_expire']) && !empty($this->settings['presigned_expire'])
                ) {
                    $preSignedUrl = Utils::get_meta( $source_id, 'presigned_url_'.$size );
                    if ($preSignedUrl === false) {
                        global $wpmcsService;
                        $new_url = $wpmcsService->get_presigned_url($key);

                        if (!Utils::is_empty($new_url)) {
                            $preSignedUrl   = Cdn::may_generate_cdn_url($new_url, $key);
                            $expireMinutes  = (int)(isset($this->settings['presigned_expire']) && !empty($this->settings['presigned_expire']))
                                            ? $this->settings['presigned_expire']
                                            : 20;
                            $expireSeconds  = $expireMinutes * 60;

                            Utils::update_meta($source_id, 'presigned_url_'.$size, $preSignedUrl, false, $expireSeconds);
                        }
                    }
                    return $preSignedUrl;
                } else {
                    return Cdn::may_generate_cdn_url($url, $key);
                }
            }
        }
        return false;
    }


     /**
     * Get service path of item from database
     * @since 1.0.0
     * @param
     */
    public function moveToServer($source_id, $size = 'full', $all = false){
        $server_files   = array();
        $server_file    = false;
        $upload_dir     = wp_get_upload_dir();
        $source_id      = (int)$source_id;

        if ($data = $this->get($source_id)) {
            global $wpmcsService;
            if($all) {
                if (
                    isset($data['source_path']) && !empty($data['source_path']) &&
                    isset($data['key']) && !empty($data['key'])
                ) {
                    $file_path = trailingslashit($upload_dir['basedir']) . $data['source_path'];
                    if(file_exists($file_path) || $wpmcsService->object_to_server($data['key'], $file_path)) {
                        $server_files['full']   = $file_path;
                    }
                }
                $extras = $this->get_extras($source_id) ? $this->get_extras($source_id) : [];
                if (isset($extras['sizes']) && !empty($extras['sizes'])) {
                    $sizes = $extras['sizes'];
                    if(isset($sizes[$size]) && !empty($sizes[$size])) {
                        $sub_file_path = trailingslashit($upload_dir['basedir']) . $sizes[$size]['source_path'];
                        if(file_exists($sub_file_path) || $wpmcsService->object_to_server($sizes[$size]['key'], $sub_file_path)) {
                            $server_files[$size]   = $sub_file_path;
                        }
                    }
                }
                return !empty($server_files) ? $server_files : false;
            } else {
                if($size === 'full') {
                    if (
                        isset($data['source_path']) && !empty($data['source_path']) &&
                        isset($data['key']) && !empty($data['key'])
                    ) {
                        $file_path = trailingslashit($upload_dir['basedir']) . $data['source_path'];
                        if(file_exists($file_path) || $wpmcsService->object_to_server($data['key'], $file_path)) {
                            $server_file = $file_path;
                        } 
                    }
                } else {
                    $extras = $this->get_extras($source_id) ? $this->get_extras($source_id) : [];
                    if (isset($extras['sizes']) && !empty($extras['sizes'])) {
                        $sizes = $extras['sizes'];
                        if(isset($sizes[$size]) && !empty($sizes[$size])) {
                            $sub_file_path = trailingslashit($upload_dir['basedir']) . $sizes[$size]['source_path'];
                            if(file_exists($sub_file_path) || $wpmcsService->object_to_server($sizes[$size]['key'], $sub_file_path)) {
                                $server_file = $sub_file_path;
                            }
                        }
                    }
                } 
                return $server_file;
            }
        }
        return false;
    }


    /**
     * Ensures only one instance of Class is loaded or can be loaded.
     *
     * @return Item Class instance
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