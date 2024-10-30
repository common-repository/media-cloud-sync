<?php
namespace Dudlewebs\WPMCS;

defined('ABSPATH') || exit;

// Libraries
use Dudlewebs\WPMCS\Google\Cloud\Storage\StorageClient;

use Exception;

class GCloud {
    private $assets_url;
    private $version;
    private $token;

    protected $config;
    protected $bucketConfig;
    protected $settings;
    protected $credentials;
    protected $bucket_name;
    protected $bucket; // Object

    public $service         = 'gcloud';
    public $gcloudClient    = false;

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
     * Initialise Client
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
        $this->bucket_name  =  isset($this->bucketConfig['bucket_name']) && !empty($this->bucketConfig['bucket_name']) 
                                ? $this->bucketConfig['bucket_name']
                                : '';

        if (
            isset($this->config['config_json']) && !empty($this->config['config_json']) &&
            isset($this->config['config_json']['path']) && !empty($this->config['config_json']['path']) &&
            isset($this->bucket_name) && !empty($this->bucket_name)
        ) {
            if(file_exists($this->config['config_json']['path'])){
                // Set google client
                $this->gcloudClient = new StorageClient([
                    'keyFilePath' => $this->config['config_json']['path'],
                ]);
                // Set bucket object
                $this->bucket = $this->gcloudClient->bucket($this->bucket_name);
            } else {
                add_action('admin_notices', function (){
                    echo wp_kses_post(sprintf( "<div class='error'><p><strong>%s: </strong><br>Google Cloud Storage configuration file missing from the directory.
                                        It may break the media url's as well as media uploads.<br>
                                        <a href='%s'>Re-configure</a> plugin to fix the issue.
                                        </p></div>", 
                                        esc_html__('Media Cloud Sync', 'media-cloud-sync'),
                                        admin_url('admin.php?page='.$this->token . '-admin-ui#/configure')
                                    ));
                });
            }       
        }
    }

    /**
     * Verify Credentials
     * @since 1.0.0
     * @return boolean
     */
    public function verifyCredentials( $config_file ){
        if (
            isset($config_file) && !empty($config_file) &&
            isset($config_file['path']) && !empty($config_file['path']) &&
            file_exists($config_file['path'])
        ) {
            try {
                $googleClient = new StorageClient([
                    'keyFilePath' => $config_file['path'],
                ]);


                //Listing all google Buckets
                $buckets = $googleClient->buckets();

                $newBucketFormat = [];
                if(isset($buckets) && !empty($buckets)){
                    foreach($buckets as $bucket) {
                        $name = $bucket->name();
                        if(!empty($name)) {
                            // Fetch the bucket's metadata
                            $bucketInfo = $bucket->info();
                            $newBucketFormat[] = ['Name' => $name, 'CreationDate' => $bucketInfo['timeCreated']];
                        }
                    }
                }
                
                return array( 'message' => esc_html__('Credentials are valid', 'media-cloud-sync'), 'buckets' => $newBucketFormat, 'code' =>  200, 'success' => true);
            } catch (Exception $ex) {
                return array('message' => $ex->getMessage() ?? esc_html__('Please check the authorization details', 'media-cloud-sync'), 'code' => 200, 'success' => false);
            } catch (Exception $ex) {
                return array('message' => $ex->getMessage() ?? esc_html__('Please check the authorization details', 'media-cloud-sync'), 'code' => 200, 'success' => false);
            }
        }
        return array('message' => esc_html__('Insufficient Data. Please try again', 'media-cloud-sync'), 'code' => 200, 'success' => false);
    }


    /**
     * Verify Bucket
     * @since 1.0.0
     * @return boolean
     */
    public function verifyBucket( $config_file, $bucket_name ){
        if ( !( isset($config_file['path']) && !empty($config_file['path']) && file_exists($config_file['path']) && !empty($bucket_name) ) ) {
            return ['message' => esc_html__('Insufficient Data. Please try again', 'media-cloud-sync'), 'code' => 200, 'success' => false];
        }

        try {
            $googleClient = new StorageClient([
                'keyFilePath' => $config_file['path'],
            ]);

            $bucket = $googleClient->bucket($bucket_name);
            if ($bucket->exists()) {
                $bucket_found = true;
            } else {
                return ['message' => esc_html__('No Buckets found', 'media-cloud-sync'), 'code' => 200, 'success' => false];
            }
            if ($bucket_found) {
                $upload_dir     = wp_upload_dir();
                $file_dir       = $upload_dir['basedir'] . '/' . Schema::getConstant('UPLOADS') . '/';

                if (!is_dir($file_dir)) {
                    do_action(  $this->token.'_create_plugin_dir' );
                } 

                $fileName       = $this->token."_verify.txt";
                $localFileName  = $file_dir.$this->token."-local-verify.txt";

                $verify_file    = fopen($file_dir.$fileName, "w");
                $txt            = "We are verifying input/output operations in Google Cloud\n";
                fwrite($verify_file, $txt);
                fclose($verify_file);

                $upload = $bucket->upload(
                    fopen($file_dir . $fileName, 'r'),
                    [
                        'name' => $fileName,
                        'predefinedAcl' => 'publicRead',
                    ]
                );

                @unlink($file_dir . $fileName);

                $object = $bucket->object($fileName);
                if ($object->exists()) {
                    $object->downloadToFile($localFileName);
                    if (file_exists($localFileName)) {
                        @unlink($localFileName);
                        $object->delete();

                        if (!$object->exists()) {
                            return array('message' => esc_html__('Configuration for Google Cloud Storage verified successfully', 'media-cloud-sync'), 'code' => 200, 'success' => true);
                        } else {
                            return array('message' => esc_html__('Bucket has permission issues on deleting the object from bucket, Please check permission as well as policies', 'media-cloud-sync'), 'code' => 200, 'success' => false);
                        }
                    } else {
                        return array('message' => esc_html__('Bucket has permission issues on getting the object from bucket, Please check permission as well as policies', 'media-cloud-sync'), 'code' => 200, 'success' => false);
                    }
                } else {
                    return array('message' => esc_html__('Bucket has permission issues on putting object in to bucket, Please check permission as well as policies', 'media-cloud-sync'), 'code' => 200, 'success' => false);
                }
            } else {
                return ['message' => esc_html__('Bucket Name is incorrect', 'media-cloud-sync'), 'code' => 200, 'success' => false];
            }  
        } catch (Exception $ex) {
            return ['message' => $e->getMessage(), 'code' => 200, 'success' => false];
        } catch (Exception $ex) {
            return ['message' => $e->getMessage() ?? esc_html__('Please check the authorization details', 'media-cloud-sync'), 'code' => 200, 'success' => false];
        } catch (Exception $ex) {
            return ['message' => $ex->getMessage() ?? esc_html__('Please check the authorization details', 'media-cloud-sync'), 'code' => 200, 'success' => false];
        }
    }


    /**
     * Create Bucket
     * @since 1.0.0
     * @return boolean
     */
    public function createBucket( $config_file, $region, $bucket_name ){
        if ( !( isset($config_file['path']) && !empty($config_file['path']) && file_exists($config_file['path']) && !empty($region) && !empty($bucket_name) ) ) {
            return ['message' => esc_html__('Insufficient Data. Please try again', 'media-cloud-sync'), 'code' => 200, 'success' => false];
        }

        try {
            $googleClient = new StorageClient([
                'keyFilePath' => $config_file['path'],
            ]);

            // Create Bucket
            $googleClient->createBucket($bucket_name, [
                'location' => $region,
            ]);

            return [
                'message' => esc_html__('Bucket created successfully. Choose bucket from list to select the bucket.', 'media-cloud-sync'),
                'data'    => [
                    'Name'         => $bucket_name,
                    'CreationDate' => date('Y-m-d\TH:i:s\Z'),
                ],
                'code'    => 200,
                'success' => true,
            ];
               
        } catch (Exception $ex) {
            return ['message' => $e->getMessage(), 'code' => 200, 'success' => false];
        } catch (Exception $ex) {
            return ['message' => $e->getMessage() ?? esc_html__('Please check the authorization details', 'media-cloud-sync'), 'code' => 200, 'success' => false];
        } catch (Exception $ex) {
            return ['message' => $ex->getMessage() ?? esc_html__('Please check the authorization details', 'media-cloud-sync'), 'code' => 200, 'success' => false];
        }
    }

    /**
     * isConfigured Function To Identify the congfigurations are correct
     * @since 1.0.0
     */
    public function isConfigured(){
        if ($this->gcloudClient) {
            try {
                $buckets = $this->gcloudClient->buckets();
                if(!empty($buckets)){
                    foreach($buckets as $bucket) {
                        $name = $bucket->name();
                        if (!empty($name) && $name == $this->bucket_name) {
                            return true;
                        }
                    }
                } 
                return false;
            } catch (Exception $ex) {
                return false;
            }
        }
        return false;
    }

    /**
     * Make Object Private
     * @since 1.0.0
     * 
     */
    public function toPrivate($key) {
        if(!$key) return false;

        $object = $this->bucket->object($key);
        if ($object->exists()) {
            $object->update(['acl' => []], ['predefinedAcl' => 'private']);
            return true;
        }
        return false;
    }


    /**
     * Make Object Public
     * @since 1.0.0
     * 
     */
    public function toPublic($key) {
        if(!$key) return false;

        $object = $this->bucket->object($key);
        if ($object->exists()) {
            $object->update(['acl' => []], ['predefinedAcl' => 'publicRead']);
            return true;
        }
        return false;
    }


    /**
     * Check the object exist 
     * @since 1.1.8
     */
    public function exists($key) {
        if(!$key) return false;
        
        $object = $this->bucket->object($key);
        if ($object->exists()) {
            return true;
        }
        
        return false;
    }


    /**
     * Upload Single
     * @since 1.0.0
     * @return boolean
     */
    public function uploadSingle($media_absolute_path, $media_path, $prefix=''){
        $result = array();
        if (
            isset($media_absolute_path) && !empty($media_absolute_path) &&
            isset($media_path) && !empty($media_path)
        ) {
            $file_name = wp_basename( $media_path );
            if ($file_name) {
                $upload_path = Utils::generate_object_key($file_name, $prefix);

                // Decide Multipart upload or normal put object
                if (filesize($media_absolute_path) <= Schema::getConstant('GCLOUD_MULTIPART_MIN_FILE_SIZE')) {
                    // Upload a publicly accessible file. The file size and type are determined by the SDK.
                    try {

                        $upload = $this->bucket->upload(
                            fopen($media_absolute_path, 'r'),
                            [
                                'name' => $upload_path,
                                'predefinedAcl' => 'publicRead',
                            ]
                        );

                        $object = $this->bucket->object($upload_path);

                        if ($object->exists()) {
                            $result = array(
                                'success'   => true,
                                'code'      => 200,
                                'file_url'  => $this->generate_file_url($upload_path),
                                'key'       => $upload_path,
                                'message'   => esc_html__('File Uploaded Successfully', 'media-cloud-sync'),
                            );
                        } else {
                            $result = array(
                                'success'   => false,
                                'code'      => 200,
                                'message'   => esc_html__('Object not found at server.', 'media-cloud-sync'),
                            );
                        }
                    } catch (Exception $e) {
                        $result = array(
                            'success' => false,
                            'code' => 200,
                            'message' => $e->getMessage(),
                        );
                    }
                } else {
                    try {
                        $upload = $this->bucket->upload(
                            fopen($media_absolute_path, 'r'),
                            [
                                'name' => $upload_path,
                                'predefinedAcl' => 'publicRead',
                                'chunkSize' => 262144 * 2,
                            ]
                        );

                        $object = $this->bucket->object($upload_path);

                        if ($object->exists()) {
                            $result = array(
                                'success' => true,
                                'code' => 200,
                                'file_url' => $this->generate_file_url($upload_path),
                                'key' => $upload_path,
                                'message' => esc_html__('File Uploaded Successfully', 'media-cloud-sync'),
                            );
                        } else {
                            $result = array(
                                'success'   => false,
                                'code'      => 200,
                                'message'   => esc_html__('Something happened while uploading to server', 'media-cloud-sync'),
                            );
                        }
                    } catch (Exception $e) {
                        $result = array(
                            'success'   => false,
                            'code'      => 200,
                            'message'   => $e->getMessage(),
                        );
                    }
                }
            } else {
                $result = array(
                    'success'   => false,
                    'code'      => 200,
                    'message'   => esc_html__('Check the file you are trying to upload. Please try again', 'media-cloud-sync'),
                );
            }
        } else {
            $result = array(
                'success'   => false,
                'code'      => 200,
                'message'   => esc_html__('Insufficient Data. Please try again', 'media-cloud-sync'),
            );
        }
        return $result;
    }


    /**
     * Save object to server
     * @since 1.0.0
     */
    public function object_to_server($key, $save_path){
        try {
            $object = $this->bucket->object($key);
            if ($object->exists()) {
                $object->downloadToFile($save_path);
                if (file_exists($save_path)) {
                    return true;
                }
            }
        } catch (Exception $e) {
            return false;
        }
        return false;
    }


     /**
     * Delete Single
     * @since 1.0.0
     * @return boolean
     */
    public function deleteSingle($key){
        $result = array();
        if (isset($key) && !empty($key)) {
            try {
                $object = $this->bucket->object($key);
                $object->delete();

                if (!$object->exists()) {
                    $result = array(
                        'success'   => true,
                        'code'      => 200,
                        'message'   => esc_html__('Deleted Successfully', 'media-cloud-sync'),
                    );
                } else {
                    $result = array(
                        'success'   => false,
                        'code'      => 200,
                        'message'   => esc_html__('File not deleted', 'media-cloud-sync'),
                    );
                }
            } catch (Exception $e) {
                $result = array(
                    'success'   => false,
                    'code'      => 200,
                    'message'   => $e->getMessage(),
                );
            }
        } else {
            $result = array(
                'success'   => false,
                'code'      => 200,
                'message'   => esc_html__('Insufficient Data. Please try again', 'media-cloud-sync'),
            );
        }
        return $result;
    }


    /**
     * get presigned URL
     * @since 1.0.0
     * @return boolean
     */
    public function get_presigned_url($key) {
        $result = array();
        if (isset($key) && !empty($key)) {
            try {
                $object = $this->bucket->object($key);

                $expires = isset($this->settings['presigned_expire']) ? $this->settings['presigned_expire'] : 20;

                $presignedUrl =  $object->signedUrl(new \DateTime(sprintf('+%s  minutes', $expires)));

                if ($presignedUrl) {
                    $result = array(
                        'success'   => true,
                        'code'      => 200,
                        'file_url'  => $presignedUrl,
                        'message'   => esc_html__('Got Presigned URL Successfully', 'media-cloud-sync'),
                    );
                } else {
                    $result = array(
                        'success'   => false,
                        'code'      => 200,
                        'message'   => esc_html__('Error getting presigned URL', 'media-cloud-sync'),
                    );
                }
            } catch (Exception $e) {
                $result = array(
                    'success'   => false,
                    'code'      => 200,
                    'message'   => $e->getMessage(),
                );
            }
        } else {
            $result = array(
                'success'   => false,
                'code'      => 200,
                'message'   => esc_html__('Insufficient Data. Please try again', 'media-cloud-sync'),
            );
        }
        return $result;
    }


    /**
     * Generate file URL
     */
    private function generate_file_url($key){
        $domain = $this->get_domain();

        return apply_filters('wpmcs_generate_google_file_url',
            $domain . '/' . $this->bucket_name . '/' . $key,
            $domain, $key,
            $this->bucket_name
        );
    }


    /**
     * Get domain URL
     */
    public function get_domain() {
        $url_base = 'https://storage.googleapis.com';
        
        return $url_base;
    }
}