<?php
namespace Dudlewebs\WPMCS;

defined('ABSPATH') || exit;

class Media {
    private static $instance = null;
    private $assets_url;
    private $version;
    private $token;

    protected $settings;
	private $deleting_attachment = false;

    /**
     * Admin constructor.
     * @since 1.0.0
     */
    public function __construct() {
        $this->assets_url = WPMCS_ASSETS_URL;
        $this->version    = WPMCS_VERSION;
        $this->token      = WPMCS_TOKEN;

        // Initialize setup
        $this->init();
    }

    /**
     * Initialize
     */
    public function init() {
        $this->settings = Utils::get_settings();

        // Load action for modifying URL s and uploading media
        $this->register_actions();
    }


    /**
     * Register Actions for for media handling
     * @access public
     * @return void
     * @since 1.0.0
     */

    public function register_actions(){
        /** URL RE-WRITING HOOKS */
        add_filter( 'wp_get_attachment_url', [ $this, 'wp_get_attachment_url' ], 99, 2 );
        add_filter( 'wp_get_attachment_image_attributes', [ $this, 'wp_get_attachment_image_attributes' ], 99, 3 );
        add_filter( 'wp_calculate_image_srcset', [ $this, 'wp_calculate_image_srcset' ], 99, 5 );
        add_filter( 'get_attached_file', [ $this, 'get_attached_file' ], 10, 2 );
        add_filter( 'wp_get_original_image_path', [ $this, 'get_attached_file' ], 10, 2 );
        add_filter( 'wp_video_shortcode', [ $this, 'wp_media_shortcode' ], 100, 5  );
        add_filter( 'wp_audio_shortcode', [ $this, 'wp_media_shortcode' ], 100, 5  );

        // /** FILE MANAGEMENT HOOKS */
        add_filter( 'wp_unique_filename', [ $this, 'wp_unique_filename' ], 10, 3 );
        add_filter( 'wp_update_attachment_metadata', [ $this, 'update_attachment_metadata' ], 110, 2 );
        add_filter( 'wp_generate_attachment_metadata', [ $this, 'wp_generate_attachment_metadata' ], 110, 3 );
		add_filter( 'pre_delete_attachment', [ $this, 'pre_delete_attachment' ], 20  );
        add_filter( 'delete_attachment', [ $this, 'delete_attachment' ], 20 );
		add_action( 'delete_post',  [$this, 'delete_post'] );
        add_filter( 'update_attached_file', [ $this, 'update_attached_file' ], 100, 2 ); 
        add_filter( 'load_image_to_edit_path', [ $this, 'load_image_to_edit_path' ], 10, 3 );
    }


    /**
     * Function to execute on wp_generate_attachment_metadata
     * To delete files from server only after updating all meta
     * @since 1.0.0
     * 
     */

    public function wp_generate_attachment_metadata( $attachment_meta, $attachment_id, $action) {
        if($action == 'create') {
            global $wpmcsService;
            global $wpmcsItem;
    
            $attachment_id = (int)$attachment_id;

            if (!Utils::is_ok_to_upload($attachment_id)) return $attachment_meta;

            $item = $wpmcsItem->get($attachment_id);
            if(!Utils::is_empty($item)) {
                $this->may_be_delete_server_files_by_id($attachment_id, true, true);
            }
        } 

        return $attachment_meta;
    }


    /**
     * Function to execute on wp_update_attachment_metadata
     * @since 1.0.0
     *
     */
    public function update_attachment_metadata($attachment_meta, $attachment_id) {
        global $wpmcsService;
        global $wpmcsItem;
        $attachment_id          = (int)$attachment_id;
        $type                   = get_post_mime_type($attachment_id);
        $is_image               = (0 === strpos($type, 'image/'));
        $is_image_edit          = false;

        if (!Utils::is_ok_to_upload($attachment_id)) return $attachment_meta;

        //Generate attachment meta if empty
        if (empty($attachment_meta)) {
            $attachment_meta = wp_get_attachment_metadata($attachment_id);
        }

        // Get File Name/Path from Image meta
        $file = isset($attachment_meta) && !empty($attachment_meta) && isset($attachment_meta['file']) && !empty($attachment_meta['file'])
                ?  $attachment_meta['file']
                :  Utils::get_post_meta((int) $attachment_id, '_wp_attached_file', true);

        // Generate relative path of the file 
        $source_path = Utils::get_attachment_source_path($file);

        if($source_path){
            $existing   = $wpmcsItem->get($attachment_id); 
            $backup     = $wpmcsItem->get_backup($attachment_id);

            if(Utils::is_empty($existing)) {   // First Upload attempt
                $uploaded_data = $wpmcsService->uploadMedia($attachment_meta, $attachment_id, $source_path);
                if(isset($uploaded_data['file'])) {
                    $wpmcsItem->add(
                        $attachment_id,
                        $uploaded_data['file']['url'],
                        $uploaded_data['file']['key'],
                        $uploaded_data['file']['source_path'],
                        $uploaded_data['extra']
                    );
                }
            } else {
                if(Utils::is_empty($backup)) { // if no backup available
                    $uploaded_data = $wpmcsService->uploadMedia($attachment_meta, $attachment_id, $source_path);
                    
                    if( $existing['source_path'] != $source_path ) { // if existing item is different from new
                        $uploaded_data['extra']['backup']   = serialize($existing);
                        $is_image_edit                      = true;  //  if existing item is different from new it is image edit
                    } 

                    if(isset($uploaded_data['file'])) {
                        $wpmcsItem->update(
                            $attachment_id,
                            [
                                'source_path'   => $uploaded_data['file']['source_path'],
                                'url'           => $uploaded_data['file']['url'],
                                'key'           => $uploaded_data['file']['key'],
                                'extra'         => maybe_serialize($uploaded_data['extra']),
                            ]
                        );
                    }
                } else { // if backup available
                    if($backup['source_path'] != $source_path) {  
                        $uploaded_data = $wpmcsService->uploadMedia($attachment_meta, $attachment_id, $source_path);
                        $uploaded_data['extra']['backup'] = maybe_serialize($backup);

                        if( $existing['source_path'] != $source_path ) { // if existing item is different from new
                            /**
                             * Since the backup is present and it is not the first edit
                             * It is a re-edit, So we don't need intermediate edit state.
                             * So removing cloud and server files immediately
                             */
                            $wpmcsService->delete_attachments_by_item($existing, false);
                            $this->may_be_delete_server_files_by_item($existing, true);
                        
                            $is_image_edit = true;  //  if existing item is different from new it is image edit
                        }

                        if(isset($uploaded_data['file'])) {
                            $wpmcsItem->update(
                                $attachment_id,
                                [
                                    'source_path'   => $uploaded_data['file']['source_path'],
                                    'url'           => $uploaded_data['file']['url'],
                                    'key'           => $uploaded_data['file']['key'],
                                    'extra'         => maybe_serialize($uploaded_data['extra']),
                                ]
                            );
                        }
                    } else { // Restore backup
                        $wpmcsService->delete_attachments_by_item($existing, false);
                        $wpmcsItem->update(
                            $attachment_id,
                            [
                                'source_path'   => $backup['source_path'],
                                'url'           => $backup['url'],
                                'key'           => $backup['key'],
                                'extra'         => $backup['extra'],
                            ]
                        );
                    }
                }
            }
        }
        
        // Remove files from server if enabled ---- Remove main file if it is not image or a new image source url (image edit)
        $delete_main_file   = !$is_image || $is_image_edit;
        // Remove files from server for backup ---- Remove backup from server if it is image edit (To remove restored file)
        $delete_backup      = $is_image_edit;
        $this->may_be_delete_server_files_by_id($attachment_id, $delete_main_file, $delete_backup);

        return $attachment_meta;
    }


 

    /**
     * Function to remove media from server by id
     * @since 1.0.0
     *
     */
    public function may_be_delete_server_files_by_id($attachment_id, $delete_main_file=false, $delete_backup = false) {
        global $wpmcsItem;
        $item = $wpmcsItem->get($attachment_id);
        if(Utils::is_empty($item)) {
            return false;
        }

        if( !( isset($this->settings['remove_from_server']) && $this->settings['remove_from_server'] ) ) {
            return false;
        }

        if (isset($item['extra']) && !empty($item['extra'])) {
            $extras = unserialize($item['extra']);
            if (
                isset($extras) && !empty($extras) &&
                isset($extras['backup']) && !empty($extras['backup']) &&
                $delete_backup
            ) {
                $backup = unserialize($extras['backup']);
                if (isset($backup) && !empty($backup)) {
                    $this->may_be_delete_server_files_by_item($backup, $delete_main_file);
                }
            }
        }

        $this->may_be_delete_server_files_by_item($item, $delete_main_file);

        return true;
    }

    /**
     * Function to remove media from server by item
     */
    public function may_be_delete_server_files_by_item( $item, $delete_main_file=false ) {
        if(Utils::is_empty($item)) {
            return false;
        }

        if( !( isset($this->settings['remove_from_server']) && $this->settings['remove_from_server'] ) ) {
            return false;
        }

        $upload_dir     = wp_get_upload_dir();
        $has_original   = false;

        $file_path = trailingslashit($upload_dir['basedir']) . $item['source_path'];

        if (isset($item['extra']) && !empty($item['extra'])) {
            $extras = unserialize($item['extra']);
            if (
                isset($extras) && !empty($extras) &&
                isset($extras['sizes']) && !empty($extras['sizes'])
            ) {
                foreach ($extras['sizes'] as $sub_image) {
                    if (isset($sub_image['source_path']) && !empty($sub_image['source_path'])) {
                        $file = trailingslashit($upload_dir['basedir']) . $sub_image['source_path'];
                        if(file_exists($file)) {
                            wp_delete_file($file);
                        }
                    }
                }
            }

            if (
                isset($extras) && !empty($extras) &&
                isset($extras['original']) && !empty($extras['original'])
            ) {
                $has_original = true;
                $file = trailingslashit($upload_dir['basedir']).$extras['original']['source_path'];
                if(file_exists($file) && $delete_main_file) {
                    wp_delete_file($file);
                }
            }
        }
        if(file_exists($file_path)) {
            if ($has_original || (!$has_original && $delete_main_file)) {
                wp_delete_file($file_path);
            }
        }
        return true;
    }

    /**
     * Function to remove data from provider by attachment ID
     * @since 1.0.0
     *
     */
    public function delete_attachment($attachment_id){
        if (!Utils::is_service_enabled()) {
            return $attachment_id;
        }

        global $wpmcsItem;
        global $wpmcsService;

        $item = $wpmcsItem->get($attachment_id);

        if (Utils::is_empty($item)) {
            return $attachment_id;
        }

        $wpmcsService->delete_attachments_by_item($item);

        $wpmcsItem->delete($attachment_id);

        return $attachment_id;
    }

    /**
     * Allow processes to update the file on provider via update_attached_file()
     * @since 1.0.0
     * @param string $file
     * @param int    $attachment_id
     *
     * @return string
     */
    public function update_attached_file($file, $attachment_id) {
        global $wpmcsItem;

        if( !Utils::is_ok_to_upload($attachment_id) ) {
            return $file;
        }

        $item = $wpmcsItem->get($attachment_id);

        if (Utils::is_empty($item)) {
            return $file;
        }

        $file = apply_filters('wpmcs_update_attached_file', $file, $attachment_id, $item);

        return $file;
    }

    /**
     * Function to execute on load_image_to_edit_path
     * @since 1.0.0
     * @return string
     *
     */
    public function load_image_to_edit_path($path, $attachment_id, $size) {
        global $wpmcsItem;

        if (!Utils::is_ok_to_serve($attachment_id) && !$wpmcsItem->is_available_from_provider($attachment) ) {
            return $path;
        }


        $server_file = false;
        //If operation is Image editor Image Save
        if(
            isset($_REQUEST['do']) &&
            isset($_REQUEST['action']) && 
            $_REQUEST['action'] === 'image-editor' &&
            $_REQUEST['do']==='save'
        ) {
            $server_file = $wpmcsItem->moveToServer($attachment_id, $size);
        }

        return $server_file ? $server_file : $path;
    }

    /**
     * Get attachment url
     * @since 1.0.0
     * @param string $url
     * @param int    $attachment_id
     *
     * @return bool|mixed|WP_Error
     */
    public function wp_get_attachment_url($url, $attachment_id) {
        global $wpmcsItem;

        if (!Utils::is_ok_to_serve($attachment_id)) {
            return $url;
        }

        $new_url = $wpmcsItem->get_url($attachment_id);

        if (Utils::is_empty($new_url)) {
            return $url;
        }

        $new_url = apply_filters('wpmcs_wp_get_attachment_url', $new_url, $url, $attachment_id);

        return $new_url;
    }

    /**
     * Filters the list of attachment image attributes.
     *
     * @since 1.0.0
     * @param array        $attr  Attributes for the image markup.
     * @param WP_Post      $attachment Image attachment post.
     * @param string|array $size  Requested size. Image size or array of width and height values (in that order).
     *
     * @return array
     */
    public function wp_get_attachment_image_attributes($attr, $attachment, $size='thumbnail') {
        global $wpmcsItem;

        if (
            !$attachment || 
            !Utils::is_ok_to_serve($attachment->ID)
        ) {
            return $attr;
        }

        $item = $wpmcsItem->get($attachment->ID);

        if (Utils::is_empty($item)) {
            return $attr;
        }

        $size = Utils::maybe_convert_size_to_string($attachment->ID, $size);
        if ($size === false) {
            return $attr;
        }

        

        if (
            isset($size) && !empty($size) &&
            isset($attr['src']) && !empty($attr['src'])
        ) {
            $source = $wpmcsItem->get_url($attachment->ID, $size);
            if (isset($source) && !empty($source)) {
                $attr['src'] = $source;
            }
        }

        /**
         * Filtered list of attachment image attributes.
         *
         * @param array              $attr       Attributes for the image markup.
         * @param WP_Post            $attachment Image attachment post.
         * @param string             $size       Requested size.
         */
        return apply_filters('wpmcs_wp_get_attachment_image_attributes', $attr, $attachment, $size, $item);
    }

    /**
     * Return the provider URL when the local file is missing
     * unless we know who the calling process is and we are happy
     * to copy the file back to the server to be used.
     *
     * @handles get_attached_file
     * @handles wp_get_original_image_path
     * @since 1.0.0
     * @param string $file
     * @param int    $attachment_id
     *
     * @return string
     */
    public function get_attached_file($file, $attachment_id) {
        global $wpmcsItem;
        $attachment_id = (int)$attachment_id;

        // During the deletion of an attachment, stream wrapper URLs should not be returned.
		if ( $this->deleting_attachment ) {
			return $file;
		}

        if (!Utils::is_ok_to_serve($attachment_id)) {
            return $file;
        }

        $item = $wpmcsItem->get($attachment_id);

        if (Utils::is_empty($item)) {
            return $file;
        }

        if( isset($_REQUEST['action']) &&  $_REQUEST['action'] === 'image-editor' ) {
            // Avoid rewriting URL when image restore in image editor
            if(isset($_REQUEST['do']) && $_REQUEST['do']==='restore') {
                return $file;
            }
            // Avoid rewriting URL when image save in image editor
            if(isset($_REQUEST['do']) && $_REQUEST['do'] === 'save') {
                return $file;
            }
        }
        
        $url = $wpmcsItem->get_url($attachment_id);

        if ($url) {
            $file = apply_filters('wpmcs_get_attached_file', $url, $file, $attachment_id, $item);
        }

        return $file;
    }

    /**
     * Change src attributes
     * @since 1.0.0
     */

    public function wp_calculate_image_srcset($sources, $size_array, $image_src, $attachment_meta, $attachment_id = 0) {
        global $wpmcsItem;

        $attachment_id = (int)$attachment_id;

        // Must need $attachment_id other wise not possible to get data from the table
        if (!Utils::is_ok_to_serve($attachment_id)) {
            return $sources;
        }

        $item = $wpmcsItem->get($attachment_id);

        if (Utils::is_empty($item)) {
            return $sources;
        }

        $item_extra = $wpmcsItem->get_extras($attachment_id);

        if (isset($item_extra['width']) && !empty($item_extra['width'])) {
            $sources[$item_extra['width']]=[
                'url'           => $wpmcsItem->get_url($attachment_id),
                'descriptor'    => 'w',
				'value'         => $item_extra['width']
            ];
        }

        if ($item_extra) {
            if (isset($item_extra['sizes']) && !empty($item_extra['sizes'])) {
                foreach ($item_extra['sizes'] as $size => $size_array) {
                    if (isset($size_array['width']) && !empty($size_array['width'])) {
                        $w = $size_array['width'];
                        if (isset($sources[$w]) && !empty($sources[$w])) {
                            $sources[$w]['url'] = $wpmcsItem->get_url($attachment_id, $size);
                        }
                    }
                }
            }
        }

        return $sources;
    }



    /**
     * Create unique names for files effects mainly on delete files from server settings
     * @since 1.0.0
     * @return string
     */
    public function wp_unique_filename($filename, $ext, $dir) {
        // Get Post ID if uploaded in post screen.
        $post_id = filter_input(INPUT_POST, 'post_id', FILTER_VALIDATE_INT);

        $filename = $this->filter_unique_filename($filename, $ext, $dir, $post_id);

        return $filename;
    }

    /**
     * filter unique file names
     * @since 1.0.0
     * @return string
     */
    private function filter_unique_filename($filename, $ext, $dir, $post_id = null) {
        if (!Utils::is_service_enabled()) {
            return $filename;
        }

        // sanitize the file name before we begin processing
        $filename   = sanitize_file_name($filename);
        $ext        = strtolower($ext);
        $name       = wp_basename($filename, $ext);

        // Edge case: if file is named '.ext', treat as an empty name.
        if ($name === $ext) {
            $name = '';
        }

        // Rebuild filename with lowercase extension as provider will have converted extension on upload.
        $filename = $name . $ext;

        return $this->generate_unique_filename($name, $ext, $dir);
    }

    /**
     * Generate unique filename
     * @since 1.0.0
     * @param string $name
     * @param string $ext
     * @param string $time
     *
     * @return string
     */
    private function generate_unique_filename($name, $ext, $dir) {
        global $wpmcsItem;
        $upload_dir         = wp_get_upload_dir();
        $filename           = $name . $ext;
        $no_ext_path        = $dir . '/' . $name;
        $rel_no_ext_path    = substr($no_ext_path, strlen(trailingslashit($upload_dir['basedir'])),strlen($no_ext_path));
        $path               = $dir . '/' . $name . $ext;
        $source_path        = substr($path, strlen(trailingslashit($upload_dir['basedir'])),strlen($path));


        $uploaded_files = $wpmcsItem->get_similar_files_by_path($rel_no_ext_path);

        if ($uploaded_files !== false) {
            if (Utils::check_existing_file_names($source_path, $uploaded_files) || file_exists($path)) {
                $count = 1;
                $new_file_name = '';
                $found = true;
                while ($found) {
                    $tmp_path   = $dir . '/' . $name . '-' . $count . $ext;
                    $rel_temp_path   = substr($tmp_path, strlen(trailingslashit($upload_dir['basedir'])),strlen($tmp_path));

                    if (Utils::check_existing_file_names($rel_temp_path, $uploaded_files) || file_exists($tmp_path)) {
                        $count++;
                    } else {
                        $found = false;
                        $new_file_name = $name . '-' . $count . $ext;
                    }
                }
                return $new_file_name;
            }
        } else {
            if (file_exists($path)) {
                $count = 1;
                $new_file_name = '';
                $found = true;

                while ($found) {
                    $tmp_path = $dir . '/' . $name . '-' . $count . $ext;
                    if (file_exists($tmp_path)) {
                        $count++;
                    } else {
                        $found = false;
                        $new_file_name = $name . '-' . $count . $ext;
                    }
                }
                return $new_file_name;
            }
        }

        return $filename;
    }

    /**
	 * Filters the audio & video shortcodes output to remove "&_=NN" params from source.src as it breaks signed URLs.
	 *
	 * @param string $html    Shortcode HTML output.
	 * @param array  $atts    Array of shortcode attributes.
	 * @param string $media   Media file.
	 * @param int    $post_id Post ID.
	 * @param string $library Media library used for the shortcode.
	 *
	 * @return string
	 *
	 * Note: Depends on 30377.4.diff from https://core.trac.wordpress.org/ticket/30377
	 */
	public function wp_media_shortcode( $html, $atts, $media, $post_id, $library ) {
		return preg_replace( '/&#038;_=[0-9]+/', '', $html );
	}


    /**
	 * Takes notice that an attachment is about to be deleted and prepares for it.
	 *
	 * @handles pre_delete_attachment
	 *
	 * @param bool|null $delete Whether to go forward with deletion.
	 *
	 * @return bool|null
	 */
	public function pre_delete_attachment( $delete ) {
		if ( is_null( $delete ) ) {
			$this->deleting_attachment = true;
		}

		return $delete;
	}

	/**
	 * Takes notice that an attachment has been deleted and undoes previous preparations for the event.
	 *
	 * @handles delete_post
	 *
	 * Note: delete_post is used as there is a potential that deleted_post is not reached.
	 */
	public function delete_post() {
		$this->deleting_attachment = false;
	}



    /**
     * Ensures only one instance of Class is loaded or can be loaded.
     *
     * @return Media Class instance
     * @since 1.0.0
     * @static
     */
    public static function instance() {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}