<?php
namespace Dudlewebs\WPMCS;

use WP_REST_Response;

defined('ABSPATH') || exit;

class Api {
	private static $instance = null;
	private $token;
	private $version;
	private $assets_url;

	/**
	 * Constructor
     * @since 1.0.0
	 */

	public function __construct() {
		$this->assets_url = WPMCS_ASSETS_URL;
		$this->version    = WPMCS_VERSION;
		$this->token      = WPMCS_TOKEN;

		add_action( 'rest_api_init', array( $this, 'register_routes' ) );
	}


	/**
	 * Register API routes
	 */

	public function register_routes() {
		$this->add_route( '/verifyCredentials', 'verifyCredentials', 'POST' );
		$this->add_route( '/verifyBucket', 'verifyBucket', 'POST' );
		$this->add_route( '/saveConfig', 'saveConfig', 'POST' );
		$this->add_route( '/createBucket', 'createBucket', 'POST' );
		$this->add_route( '/getSettings', 'getSettings' );
        $this->add_route( '/uploadCredentials', 'uploadCredentials', 'POST' );
	}

	/**
	 * Verify the Service Credentials
	 */
	public function verifyCredentials( $data ) {
		global $wpmcsService;
		return new WP_REST_Response( $wpmcsService->verifyCredentials($data->get_params()), 200 );
	}

	/**
	 * Verify the Bucket Credentials
	 */
	public function verifyBucket( $data ) {
		global $wpmcsService;
		return new WP_REST_Response( $wpmcsService->verifyBucket($data->get_params()), 200 );
	}

	/**
	 * Create the bucket
	 */
	public function createBucket( $data ) {
		global $wpmcsService;
		return new WP_REST_Response( $wpmcsService->createBucket($data->get_params()), 200 );
	}

	/**
	 * Get Settings
	 */
	public function getSettings( ) {
		$data = [
			'credentials'	=> Utils::get_credentials(),
			'common'		=> [
				'version'	=> WPMCS_VERSION,
				'uploaded'	=> Counter::get( 'uploaded' ),
				'settings'	=> Utils::get_settings(),
			]
		];

		return new WP_REST_Response( $data, 200 );
	}

	/**
	 * Save the Configurations
	 */
	public function saveConfig( $data ) {
		$saveData 		= $data->get_params();
		$result			= [
			'success'	=> false,
			'message'	=> esc_html__('Something went wrong. Invalid data recieved', 'media-cloud-sync')
		];

		$action 		= isset($saveData['action']) ? $saveData['action'] : false;
		if($action === false) return new WP_REST_Response( $result, 200 );

		$service 		= isset($saveData['service']) ? $saveData['service'] : false;
		$config 		= isset($saveData['config']) ? $saveData['config'] : false;
		$bucketConfig 	= isset($saveData['bucketConfig']) ? $saveData['bucketConfig'] : [];
		$settings 		= isset($saveData['settings']) ? $saveData['settings'] : [];

		$serviceOk 		= true;
		$settingsOk 	= true;
		if($action === 'all' || $action === 'service'){
			if ( $service === false || empty($config) || empty($bucketConfig)) return new WP_REST_Response( $result, 200 );

			$updated = Utils::update_option(
				'credentials', 
				[
					'service' 		=> $service,
					'config'		=> $config,
					'bucketConfig'  => $bucketConfig
				], 
				Schema::getConstant('GLOBAL_SETTINGS_KEY')
			);
			if(!$updated) $serviceOk = false;
		} 
		
		if(($action === 'all' || $action === 'settings')) {
			$updatedSettings = Utils::update_option('settings', $settings, Schema::getConstant('GLOBAL_SETTINGS_KEY'));
			if(!$updatedSettings) $settingsOk = false;
		}


		if($serviceOk && $settingsOk) {
			$result = [
				'success'	=> true,
				'message'	=> esc_html__('Configuration saved successfully', 'media-cloud-sync')
			];
		}

		return new WP_REST_Response( $result, 200 );
	}


	/**
     * Upload Credentials
     * @since 1.0.0
     */
    public function uploadCredentials($request) {
        if (isset($_FILES['file']) && !empty($_FILES['file'])) {
            $config_file = $_FILES['file'];
            if (isset($config_file['type']) && $config_file['type'] == 'application/json') {
                if (file_exists($config_file["tmp_name"])) {

                    add_filter( 'upload_dir', [ $this, 'change_file_upload_dir' ]);
                    add_filter( 'mime_types', [ $this, 'add_custom_mime_type_json' ]);

                    if ( ! function_exists( 'wp_handle_upload' ) ) {
                        require_once( ABSPATH . 'wp-admin/includes/file.php' );
                    }

                    $upload_overrides = [ 
                        'test_form' => false,
                        'test_type' => true,
                        'mimes'     => [ 'json'=>'application/json' ]
					];

                    $movefile = wp_handle_upload( $config_file, $upload_overrides );

                    remove_filter( 'upload_dir', [ $this, 'change_file_upload_dir' ]);
                    remove_filter( 'mime_types', [ $this, 'add_custom_mime_type_json' ]);

                    if ($movefile && !isset($movefile['error'])) {
                        $result     = [ 
                            'success' => true,
                            'file_path' => $movefile['file'],
                            'file_name' => basename($movefile['file']),
						];
                        return new WP_REST_Response($result, 200);
                    } else {
						$result     = [ 
                            'success' => false,
                            'message' => $movefile['error'],
						];
                        return new WP_REST_Response($result, 200);
                    }
                }
            } else {
				$result     = [ 
					'success' => false,
					'message' => esc_html__('Invalid file format', 'media-cloud-sync'),
				];
                return new WP_REST_Response($result, 200);
            }
        } else {
			$result     = [ 
				'success' => false,
				'message' => esc_html__('Insufficient data. Please try again', 'media-cloud-sync'),
			];
            return new WP_REST_Response($result, 200);
        }
    }

	/**
     * Change File Upload Directory
     * @since 1.0.0
     */
    public function change_file_upload_dir($upload) {
        $wpmcs_path = '/' . Schema::getConstant('UPLOADS');
        $path   = $upload['basedir'] . $wpmcs_path;
        $url    = $upload['baseurl'] . $wpmcs_path;

        if (!is_dir($path)) {
            do_action(  $this->token.'_create_plugin_dir' );
        }   

        $upload['subdir'] = $wpmcs_path;
        $upload['path'] = $upload['basedir'] . $wpmcs_path;
        $upload['url'] = $upload['baseurl'] . $wpmcs_path;

        return $upload;
    }

    /**
     * Add Custom Mime Type JSON
     * @since 1.0.0
     */
    public function add_custom_mime_type_json($mimes) {
        $mimes['json'] = 'application/json';
        // Return the array back to the function with our added mime type.
        return $mimes;
    }


	/**
	 * Helper function to create Adding Route
	 * @since 1.0.0
	 */
	private function add_route( $slug, $callBack, $method = 'GET' ) {
		register_rest_route(
			$this->token . '/v1',
			$slug,
			array(
				'methods'             => $method,
				'callback'            => array( $this, $callBack ),
				'permission_callback' => array( $this, 'getPermission' ),
			) );
	}

	/**
	 * Permission Callback
	 **/
	public function getPermission() {
		if ( current_user_can( 'administrator' ) ) {
			return true;
		} else {
			return true;
		}
	}

	/**
     * Ensures only one instance of Class is loaded or can be loaded.
     *
     * @return Api Class instance
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
