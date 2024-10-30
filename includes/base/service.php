<?php
namespace Dudlewebs\WPMCS;

defined('ABSPATH') || exit;

class Service {
    private static $instance = null;
    private $assets_url;
    private $version;
    private $token;
    private $service = false;

    protected $settings;


    /**
     * Admin constructor.
     * @since 1.0.0
     */
    public function __construct() {
        $this->assets_url = WPMCS_ASSETS_URL;
        $this->version    = WPMCS_VERSION;
        $this->token      = WPMCS_TOKEN;

        $this->settings = Utils::get_settings();

        $current_service = Utils::get_service();
        switch ($current_service) {
            case 's3':
                $this->service = new S3;
                break;
            case 'gcloud':
                $this->service = new GCloud;
                break;
            case 'docean':
                $this->service = new DOcean;
                break;
            default:$this->service = false;
        }
    }

    /**
     * Verify Service Credentials
     * @since 1.0.0
     */
    public function verifyCredentials($data) {
        $result = [
            'success' => false,
            'message' => esc_html__('Something went wrong', 'media-cloud-sync')
        ];
        
        $service = isset($data['service'])? $data['service'] : false;

        if($service == false) {
            $result = [
                'success' => false,
                'message' => esc_html__('No service selected', 'media-cloud-sync')
            ];
            return $result;
        }

        switch($service){
            case 's3':
                $config     = isset($data['config']) ? $data['config'] : [];
                $access_key = isset($config['access_key']) ? $config['access_key'] : false;
                $secret_key = isset($config['secret_key']) ? $config['secret_key'] : false;
                $region     = isset($config['region']) ? $config['region'] : false;

                if($access_key==false || $secret_key==false || $region==false) {
                    $result = [
                        'success' => false,
                        'message' => esc_html__('Insufficient Data. Please try again', 'media-cloud-sync')
                    ];
                    return $result;
                }

                $currentService = new S3;
                return $currentService->verifyCredentials($access_key, $secret_key, $region);
                break;
            case 'gcloud':
                $config         = isset($data['config']) ? $data['config'] : [];
                $config_file    = isset($config['config_json']) ? $config['config_json'] : [ 'name' => '', 'path' => '' ];

                if(!(isset($config_file['path']) && !empty($config_file['path']) && file_exists($config_file['path']))) {
                    $result = [
                        'success' => false,
                        'message' => esc_html__('Insufficient Data. Please try again', 'media-cloud-sync')
                    ];
                    return $result;
                }

                $currentService = new GCloud;
                return $currentService->verifyCredentials($config_file);
                break;
            case 'docean':
                $currentService = new DOcean;
                break;
            default: 
                $result = [
                    'success' => false,
                    'message' => esc_html__('Invalid service', 'media-cloud-sync')
                ];
        }

        return $result;
    }

    /**
     * Verify Bucket Credentials
     * @since 1.0.0
     */
    public function verifyBucket($data) {
        $result = [
            'success' => false,
            'message' => esc_html__('Something went wrong', 'media-cloud-sync')
        ];
        
        $service = isset($data['service'])? $data['service'] : false;

        if($service == false) {
            $result = [
                'success' => false,
                'message' => esc_html__('No service selected', 'media-cloud-sync')
            ];
            return $result;
        }

        switch($service){
            case 's3':
                $result = [
                    'success' => false,
                    'message' => esc_html__('Insufficient Data. Please try again', 'media-cloud-sync')
                ];
                $config                 = isset($data['config']) ? $data['config'] : [];
                $bucketConfig           = isset($data['bucketConfig']) ? $data['bucketConfig'] : [];
                $bucket                 = isset($bucketConfig['bucket_name']) ? $bucketConfig['bucket_name'] : false;
                $transfer_acceleration  = isset($bucketConfig['transfer_acceleration']) ? $bucketConfig['transfer_acceleration'] : false;
                $access_key             = isset($config['access_key']) ? $config['access_key'] : false;
                $secret_key             = isset($config['secret_key']) ? $config['secret_key'] : false;
                $region                 = isset($config['region']) ? $config['region'] : false;

                if( $access_key==false || $secret_key==false || $region==false || $bucket==false ) return $result;
                
                $currentService = new S3;


                return $currentService->verifyBucket($access_key, $secret_key, $region, $bucket, $transfer_acceleration);
                  
            case 'gcloud':
                $result = [
                    'success' => false,
                    'message' => esc_html__('Insufficient Data. Please try again', 'media-cloud-sync')
                ];
                $config                 = isset($data['config']) ? $data['config'] : [];
                $config_file            = isset($config['config_json']) ? $config['config_json'] : [ 'name' => '', 'path' => '' ];
                $bucketConfig           = isset($data['bucketConfig']) ? $data['bucketConfig'] : [];
                $bucket                 = isset($bucketConfig['bucket_name']) ? $bucketConfig['bucket_name'] : false;

                if( !(isset($config_file['path']) && !empty($config_file['path']) && file_exists($config_file['path']) && $bucket!=false ) ) return $result;
                
                $currentService = new GCloud;
                return $currentService->verifyBucket($config_file, $bucket);
                break;
            case 'docean':
                $currentService = new DOcean;
                break;
            default: 
                $result = [
                    'success' => false,
                    'message' => esc_html__('Invalid service', 'media-cloud-sync')
                ];
        }

        return $result;
    }

    /**
     * Verify Bucket Credentials
     * @since 1.0.0
     */
    public function createBucket($data) {
        $result = [
            'success' => false,
            'message' => esc_html__('Something went wrong', 'media-cloud-sync')
        ];
        
        $service = isset($data['service'])? $data['service'] : false;

        if($service == false) {
            $result = [
                'success' => false,
                'message' => esc_html__('No service selected', 'media-cloud-sync')
            ];
            return $result;
        }

        switch($service){
            case 's3':
                $result = [
                    'success' => false,
                    'message' => esc_html__('Insufficient Data. Please try again', 'media-cloud-sync')
                ];
                $config                 = isset($data['config']) ? $data['config'] : [];
                $bucketConfig           = isset($data['bucketConfig']) ? $data['bucketConfig'] : [];
                $bucket                 = isset($bucketConfig['bucket_name']) ? $bucketConfig['bucket_name'] : false;
                $transfer_acceleration  = isset($bucketConfig['transfer_acceleration']) ? $bucketConfig['transfer_acceleration'] : false;
                $access_key             = isset($config['access_key']) ? $config['access_key'] : false;
                $secret_key             = isset($config['secret_key']) ? $config['secret_key'] : false;
                $region                 = isset($config['region']) ? $config['region'] : false;

                if( $access_key==false || $secret_key==false || $region==false || $bucket==false ) return $result;
                
                $currentService = new S3;
                return $currentService->createBucket($access_key, $secret_key, $region, $bucket, $transfer_acceleration);
            case 'gcloud':
                $result = [
                    'success' => false,
                    'message' => esc_html__('Insufficient Data. Please try again', 'media-cloud-sync')
                ];
                $config                 = isset($data['config']) ? $data['config'] : [];
                $config_file            = isset($config['config_json']) ? $config['config_json'] : [ 'name' => '', 'path' => '' ];
                $bucketConfig           = isset($data['bucketConfig']) ? $data['bucketConfig'] : [];
                $bucket                 = isset($bucketConfig['bucket_name']) ? $bucketConfig['bucket_name'] : false;
                $region                 = isset($bucketConfig['region']) ? $bucketConfig['region'] : false;

                if( !(isset($config_file['path']) && !empty($config_file['path']) && file_exists($config_file['path']) && $region!=false && $bucket!=false ) ) return $result;
                
                $currentService = new GCloud;
                return $currentService->createBucket($config_file, $region, $bucket);
                break;
            case 'docean':
                $currentService = new DOcean;
                break;
            default: 
                $result = [
                    'success' => false,
                    'message' => esc_html__('Invalid service', 'media-cloud-sync')
                ];
        }

        return $result;
    }

    /**
     * Upload media item
     */
    public function uploadMedia($attachment_meta, $attachment_id, $source_path) {
        global $wpmcsItem;
        $upload_dir             = wp_get_upload_dir();
        $type                   = get_post_mime_type($attachment_id);
        $is_image               = (0 === strpos($type, 'image/'));
        $existing               = $wpmcsItem->get($attachment_id); 
        $existing_extras        = $wpmcsItem->get_extras($attachment_id); 
        $has_existing           = !Utils::is_empty($existing);
        $sizes                  = [];
        $uploaded               = [];
        $extras                 = [];
        $prefix                 = '';
        $file_path              = '';
        $file_dir               = '';
        $original_file_path     = '';
        $original_file_source_path = '';


        // Add prefix if object versioning is ON
        if (isset($this->settings['object_versioning']) && $this->settings['object_versioning']) {
            $prefix             = ($existing_extras && isset($existing_extras['prefix']) && !empty($existing_extras['prefix'])) 
                                    ? $existing_extras['prefix'] 
                                    : Utils::generate_object_versioning_prefix();
            $extras['prefix']   = $prefix;
        }

        // Get width and height from image meta
        if (isset($attachment_meta) && !empty($attachment_meta)) {
            $extras['width']  = (isset($attachment_meta['width']) && !empty($attachment_meta['width'])) ? $attachment_meta['width'] : 0;
            $extras['height'] = (isset($attachment_meta['height']) && !empty($attachment_meta['height'])) ? $attachment_meta['height'] : 0;
        }


        // Get Original File Name/Path from Image meta
        $original_file = isset($attachment_meta) && !empty($attachment_meta) && 
                         isset($attachment_meta['original_image']) && !empty($attachment_meta['original_image'])
                            ? $attachment_meta['original_image'] : '';

        $file_path  = trailingslashit($upload_dir['basedir']) . $source_path;
        $file_dir   = isset(pathinfo($file_path)['dirname']) ? pathinfo($file_path)['dirname'] : '';

        // Check whether the extension is enabled for uploading
        if (!Utils::is_extension_available($file_path)) {
            return $attachment_meta;
        }

        // Upload the Full Size file
        if( $has_existing && ( $existing['source_path'] == $source_path ) ) {
            $uploaded = [
                'success'   => true,
                'file_url'  => $existing['url'],
                'key'       => $existing['key']
            ];
        } else if(file_exists($file_path)){
            $uploaded = $this->service->uploadSingle($file_path, $source_path, $prefix);
        }

        if(
            isset($uploaded) && !empty($uploaded) &&
            isset($uploaded['success']) && $uploaded['success']
        ) {
            if(isset($original_file) && !empty($original_file)){
                // Find original image relative and absolute path
                $original_file_path = trailingslashit($file_dir) . $original_file;
                $original_file_source_path = Utils::get_attachment_source_path($original_file_path);
                $uploaded_original  = [];

                // Upload Original File
                if(
                    !Utils::is_empty($existing_extras) && 
                    isset($existing_extras['original']) && !Utils::is_empty($existing_extras['original']) &&
                    $existing_extras['original']['source_path'] == $original_file_source_path
                ) {
                    $uploaded_original = [
                        'success'   => true,
                        'file_url'  => $existing_extras['original']['url'],
                        'key'       => $existing_extras['original']['key']
                    ];
                } else if(file_exists($original_file_path)) {
                    $uploaded_original = $this->service->uploadSingle($original_file_path, $original_file_source_path, $prefix);
                }

                if(
                    isset($uploaded_original) && !empty($uploaded_original) &&
                    isset($uploaded_original['success']) && $uploaded_original['success']
                ) {
                    $extras['original'] = array(
                        'source_path'   => $original_file_source_path,
                        'url'           => $uploaded_original['file_url'],
                        'key'           => $uploaded_original['key']
                    );
                }
            }

            if (
                $is_image &&
                isset($attachment_meta['sizes']) && !empty($attachment_meta['sizes']) &&
                isset($file_dir) && !empty($file_dir)
            ) {
                foreach ($attachment_meta['sizes'] as $size => $sub_image) {
                    $sub_size           = [];
                    $sub_file           = isset($sub_image['file']) ? $sub_image['file'] : false;
                    $sub_file_path      = '';
                    $sub_file_source_path  = '';
                    $uploaded_sub_image = [];
    
                    if ($sub_file) {
                        $sub_file_path = $file_dir . '/' . $sub_file;
                        $sub_file_source_path = Utils::get_attachment_source_path($sub_file_path);
                    }

                    // Upload Image size
                    if(
                        !Utils::is_empty($existing_extras) && 
                        isset($existing_extras['sizes']) && !Utils::is_empty($existing_extras['sizes']) &&
                        isset($existing_extras['sizes'][$size]) && !Utils::is_empty($existing_extras['sizes'][$size]) &&
                        $existing_extras['sizes'][$size]['source_path'] == $sub_file_source_path
                    ) {
                        $uploaded_sub_image = [
                            'success'   => true,
                            'file_url'  => $existing_extras['sizes'][$size]['url'],
                            'key'       => $existing_extras['sizes'][$size]['key']
                        ];
                    } else if(file_exists($sub_file_path)) {
                        $uploaded_sub_image = $this->service->uploadSingle($sub_file_path, $sub_file_source_path, $prefix);
                    }

                    if (
                        isset($uploaded_sub_image) && !empty($uploaded_sub_image) &&
                        isset($uploaded_sub_image['success']) && $uploaded_sub_image['success']
                    ) {
                        $sub_size['source_path']    = $sub_file_source_path;
                        $sub_size['url']            = $uploaded_sub_image['file_url'];
                        $sub_size['key']            = $uploaded_sub_image['key'];
                        $sub_size['width']          = isset($sub_image['width']) ? $sub_image['width']: 0;
                        $sub_size['height']         = isset($sub_image['height']) ? $sub_image['height']: 0;
                    } 
    
                    $sizes[$size] = $sub_size;
                }
            }
    
            
            if (isset($sizes) && !empty($sizes)) {
                $extras['sizes'] = $sizes;
            }

            return [
                'file' => [
                    'source_path'   => $source_path,
                    'url'           => $uploaded['file_url'],
                    'key'           => $uploaded['key'],
                ],
                'extra' => $extras
            ];

        }

        return false;
    }

    /**
     * Delete media item
     */
    public function delete_attachments_by_item($item, $delete_backup = true) {
        global $wpmcsItem;
        $upload_dir = wp_get_upload_dir();

        if (isset($item['extra']) && !empty($item['extra'])) {
            $extras = unserialize($item['extra']);
            if (
                isset($extras) && !empty($extras) &&
                isset($extras['sizes']) && !empty($extras['sizes'])
            ) {
                foreach ($extras['sizes'] as $sub_image) {
                    if (isset($sub_image['key']) && !empty($sub_image['key'])) {
                        $this->service->deleteSingle($sub_image['key']);
                    }
                }
            }

            if (
                isset($extras) && !empty($extras) &&
                isset($extras['original']) && !empty($extras['original'])
            ) {
                $this->service->deleteSingle($extras['original']['key']);
            }

            if (
                isset($extras) && !empty($extras) &&
                isset($extras['backup']) && !empty($extras['backup']) &&
                $delete_backup
            ) {
                $backup = unserialize($extras['backup']);
                if (isset($backup) && !empty($backup)) {
                    $this->delete_attachments_by_item($backup, false);
                }
            }
        }
        if (isset($item['key']) && !empty($item['key'])) {
            $this->service->deleteSingle($item['key']);
        }
    }


    /**
     * Get presigned URL
     * @since 1.0.0
     */
    public function get_presigned_url($path) {
        $url_result = $this->service->get_presigned_url($path);
        if(isset($url_result['success']) && $url_result['success']) {
            return isset($url_result['file_url']) ? $url_result['file_url'] : false;
        }
        return false;
    }

    /**
	 * Remove query strings from service.
	 *
	 * @param string $content
	 * @param string $base_url Optional base URL that must exist within URL for Amazon query strings to be removed.
	 *
	 * @return string
	 */
	public function remove_query_strings( $content, $base_url = '' ) {
		$pattern    = '\?[^\s"<\?]*(?:X-Amz-Algorithm|AWSAccessKeyId|Key-Pair-Id|GoogleAccessId)=[^\s"<\?]+';
		$group      = 0;

		if ( ! is_string( $content ) ) {
			return $content;
		}

		if ( ! empty( $base_url ) ) {
			$pattern = preg_quote( $base_url, '/' ) . '[^\s"<\?]+(' . $pattern . ')';
			$group   = 1;
		}
		if ( ! preg_match_all( '/' . $pattern . '/', $content, $matches ) || ! isset( $matches[ $group ] ) ) {
			// No query strings found, return
			return $content;
		}

		$matches = array_unique( $matches[ $group ] );

		foreach ( $matches as $match ) {
			$content = str_replace( $match, '', $content );
		}
		return $content;
	}
    

    /**
     * Move object to server from cloud
     */
    public function object_to_server($key, $save_path) {
        $path_parts = pathinfo($save_path);
        if (!file_exists($path_parts['dirname'])) {
            mkdir($path_parts['dirname'], 0755, true);
        }
        return $this->service->object_to_server($key, $save_path);
    }

    /**
     * Get the service domain
     * 
     */
    public function get_domain() {
        return $this->service->get_domain();
    }

    /**
     * Ensures only one instance of Class is loaded or can be loaded.
     *
     * @return Service Class instance
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