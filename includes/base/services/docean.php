<?php
namespace Dudlewebs\WPMCS;

defined('ABSPATH') || exit;

// Libraries
use Dudlewebs\WPMCS\s3\Aws\S3\S3Client;
use Dudlewebs\WPMCS\s3\Aws\Exception\AwsException;
use Dudlewebs\WPMCS\s3\Aws\S3\Exception\S3Exception;
use Dudlewebs\WPMCS\s3\Aws\S3\MultipartUploader;
use Dudlewebs\WPMCS\s3\Aws\Exception\MultipartUploadException;
use Exception;

class DOcean {
    private $assets_url;
    private $version;
    private $token;

    protected $config;
    protected $bucketConfig;
    protected $settings;
    protected $credentials;
    protected $bucket_name;

    public $service     = 'docean';
    public $DOClient    = false;

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
            isset($this->config['region']) && !empty($this->config['region']) &&
            isset($this->config['access_key']) && !empty($this->config['access_key']) &&
            isset($this->config['secret_key']) && !empty($this->config['secret_key'])
        ) {
            $endpoint = $this->get_domain();

            $this->DOClient = new S3Client([
                'version'     => '2006-03-01',
                'region'      => $this->config['region'],
                'endpoint'    => $endpoint, // DigitalOcean Spaces requires a custom endpoint
                'use_accelerate_endpoint' => isset($this->bucketConfig['transfer_acceleration'])
                                                ? $this->bucketConfig['transfer_acceleration'] : false,
                'use_path_style_endpoint' => true, // DigitalOcean Spaces often requires path-style endpoints
                'use_aws_shared_config_files' => false,
                'credentials' => [
                    'key'    => $this->config['access_key'],
                    'secret' => $this->config['secret_key'],
                ],
            ]);
        }

    }


    /**
     * Verify Credentials
     * @since 1.0.0
     * @return boolean
     */
    public function verifyCredentials($access_key, $secret_key, $region){
        if (
            isset($region) && !empty($region) &&
            isset($access_key) && !empty($access_key) &&
            isset($secret_key) && !empty($secret_key) 
        ) {
            try {
                $endpoint = $this->get_domain($region);

                $DOClient = new S3Client([
                    'version'                       => '2006-03-01',
                    'region'                        => $region,
                    'endpoint'                      => $endpoint,
                    'use_path_style_endpoint'       => true, // Required for DigitalOcean Spaces
                    'use_aws_shared_config_files'   => false,
                    'credentials'                   => [
                        'key'    => $access_key,
                        'secret' => $secret_key,
                    ],
                ]);

                //Listing all Digital Ocean Buckets
                $buckets = $DOClient->listBuckets();

                $newBucketFormat = [];
                if(isset($buckets['Buckets']) && !empty($buckets['Buckets'])){
                    foreach($buckets['Buckets'] as $bucket) {
                        if(isset($bucket['Name'])) {
                            $newBucketFormat[] = ['Name' => $bucket['Name'], 'CreationDate' => $bucket['CreationDate']];
                        }
                    }
                }
                
                return array( 'message' => esc_html__('Credentials are valid', 'media-cloud-sync'), 'buckets' => $newBucketFormat, 'code' =>  200, 'success' => true);
            } 
            catch (S3Exception $ex) {
                return array('message' => $ex->getAwsErrorMessage() ?? esc_html__('Please check the authorization details', 'media-cloud-sync'), 'code' => 200, 'success' => false);
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
    public function verifyBucket($access_key, $secret_key, $region, $bucket_name, $transfer_acceleration=false){
        if (
            isset($region) && !empty($region) &&
            isset($access_key) && !empty($access_key) &&
            isset($secret_key) && !empty($secret_key) &&
            isset($bucket_name) && !empty($bucket_name) 
        ) {
            try {
                $endpoint = $this->get_domain($region);

                $DOClient = new S3Client([
                    'version'                       => '2006-03-01',
                    'region'                        => $region,
                    'endpoint'                      => $endpoint,
                    'use_path_style_endpoint'       => true, // Required for DigitalOcean Spaces
                    'use_accelerate_endpoint'       => $transfer_acceleration, // Transfer acceleration for DigitalOcean Spaces
                    'use_aws_shared_config_files'   => false,
                    'credentials'                   => [
                        'key'    => $access_key,
                        'secret' => $secret_key,
                    ],
                ]);

                //Listing all Digital Ocean Buckets
                $buckets = $DOClient->listBuckets();
                $bucket_found = false;
                $region_correct = false;
                if ($buckets) {
                    foreach ($buckets['Buckets'] as $bucket) {
                        if ($bucket['Name']==$bucket_name) {
                            $bucket_found = true;
                        }
                    }
                } else {
                    return array('message' => esc_html__('No matching bucket found', 'media-cloud-sync'), 'code' => 200, 'success' => false);
                }
                if ($bucket_found) {
                    $upload_dir     = wp_upload_dir();
                    $file_dir       = $upload_dir['basedir'] . '/' . Schema::getConstant('UPLOADS') . '/';

                    if (!is_dir($file_dir)) {
                        do_action(  $this->token.'_create_plugin_dir' );
                    } 

                    $fileName       = $this->token."_verify.txt";
                    $localFile      = $file_dir.$this->token."-local-verify.txt";

                    $verify_file    = fopen($file_dir.$fileName, "w");
                    $txt            = "We are verifying input/output operations in Digital Ocean\n";
                    fwrite($verify_file, $txt);
                    fclose($verify_file);

                    $upload = $DOClient->putObject([
                        'Bucket' => $bucket_name,
                        'Key'    => $fileName,
                        'Body'   => fopen($file_dir.$fileName, "r"),
                        'ACL'    => 'public-read', // make file 'public'
                    ]);
                    
                    @unlink($file_dir.$fileName);
                    if ($upload->get('ObjectURL')) {
                        try {
                            $getObject = $DOClient->GetObject([
                                'Bucket' => $bucket_name,
                                'Key'    => $fileName,
                                'SaveAs' => $localFile
                            ]);

                            if (file_exists($localFile)) {
                                @unlink($localFile);
                                $DOClient->deleteObject([
                                    'Bucket' => $bucket_name,
                                    'Key'    => $fileName,
                                ]);
                
                                if (!$DOClient->doesObjectExist($bucket_name, $fileName)) {
                                    return array('message' => esc_html__('Configuration for Digital Ocean has verified successfully', 'media-cloud-sync'), 'code' => 200, 'success' => true);
                                } else {
                                    return array('message' => esc_html__('Bucket has permission issues on deleting the object from bucket, Please check ACL permission as well as policies', 'media-cloud-sync'), 'code' => 200, 'success' => false);
                                }
                            } else {
                                return array('message' => esc_html__('Bucket has permission issues on getting the object from bucket, Please check ACL permission as well as policies', 'media-cloud-sync'), 'code' => 200, 'success' => false);
                            }
                        } catch (S3Exception $ex) {
                            return array('message' => $ex->getAwsErrorMessage(), 'code' => $ex->getAwsErrorCode(), 'success' => false);
                        }
                    } else {
                        return array('message' => esc_html__('Bucket has permission issues on putting object in to bucket, Please check ACL permission as well as policies', 'media-cloud-sync'), 'code' => 200, 'success' => false);
                    }
                } else {
                    return array('message' => esc_html__('Bucket Name is incorrect', 'media-cloud-sync'), 'code' => 200, 'success' => false);
                }
            } 
            catch (S3Exception $ex) {
                return array('message' => $ex->getAwsErrorMessage() ?? esc_html__('Please check the authorization details', 'media-cloud-sync'), 'code' => 200, 'success' => false);
            } catch (Exception $ex) {
                return array('message' => $ex->getMessage() ?? esc_html__('Please check the authorization details', 'media-cloud-sync'), 'code' => 200, 'success' => false);
            }
        }
        return array('message' => esc_html__('Insufficient Data. Please try again', 'media-cloud-sync'), 'code' => 200, 'success' => false);
    }

    /**
     * Create Bucket
     * @since 1.0.0
     * @return boolean
     */
    public function createBucket($access_key, $secret_key, $region, $bucket_name, $transfer_acceleration = false){
        if (empty($region) || empty($access_key) || empty($secret_key) || empty($bucket_name)) {
            return ['message' => esc_html__('Insufficient Data. Please try again', 'media-cloud-sync'), 'code' => 200, 'success' => false];
        }

        try {
            $endpoint = $this->get_domain($region);

            $DOClient = new S3Client([
                'version'                       => '2006-03-01',
                'region'                        => $region,
                'endpoint'                      => $endpoint,
                'use_path_style_endpoint'       => true, // Required for DigitalOcean Spaces
                'use_aws_shared_config_files'   => false,
                'credentials'                   => [
                    'key'    => $access_key,
                    'secret' => $secret_key,
                ],
            ]);

            // Create Bucket
            $DOClient->createBucket(['Bucket' => $bucket_name]);
            try {
                $this->enablBucketPublicAccess($bucket_name, $DOClient);
                $this->putBucketPolicy($bucket_name, $DOClient);
                $this->changeBucketOwnership($bucket_name, $DOClient);
                try {

                    $this->changeTransferAccilaration($bucket_name, $DOClient, $transfer_acceleration);

                    return [
                        'message' => esc_html__('Bucket created successfully. Choose bucket from list to select the bucket.', 'media-cloud-sync'),
                        'data'    => [
                            'Name'         => $bucket_name,
                            'CreationDate' => date('Y-m-d\TH:i:s\Z'),
                        ],
                        'code'    => 200,
                        'success' => true,
                    ];
                }  catch (AwsException $ex) {
                    return ['message' => esc_html__('Bucket created and made public. But the following error happened while setting the transfer accilaration,', 'media-cloud-sync') . ' ' . $ex->getAwsErrorMessage(), 'code' => 200, 'success' => false];
                }
            } catch (AwsException $ex) {
                return ['message' => esc_html__('Bucket created. But the following error happened while setting the public access,', 'media-cloud-sync') . ' ' . $ex->getAwsErrorMessage(), 'code' => 200, 'success' => false];
            }
        } catch (AwsException $ex) {
            return ['message' => $ex->getAwsErrorMessage(), 'code' => 200, 'success' => false];
        } catch (S3Exception $ex) {
            return ['message' => $ex->getAwsErrorMessage() ?? esc_html__('Please check the authorization details', 'media-cloud-sync'), 'code' => 200, 'success' => false];
        } catch (Exception $ex) {
            return ['message' => $ex->getMessage() ?? esc_html__('Please check the authorization details', 'media-cloud-sync'), 'code' => 200, 'success' => false];
        }
    }
    /**
     * Make Public Access Block Settings Enable
     * @since 1.0.0
     */

    private function enablBucketPublicAccess($bucket, $DOClient = false) {
        if($DOClient == false) {
            $DOClient = $this->DOClient;
        }

        if(empty($bucket)) return false;

        $DOClient->putPublicAccessBlock([
            'Bucket'                            => $bucket,
            'PublicAccessBlockConfiguration'    => [
                'BlockPublicPolicy'     => false,
                'BlockPublicAcls'       => false,
                'IgnorePublicAcls'      => false,
                'RestrictPublicBuckets' => false,
            ]
        ]);

        return true;
    }

    /**
     * Add Bucket Policy
     */
    private function putBucketPolicy($bucket, $DOClient = false) {
        if($DOClient == false) {
            $DOClient = $this->DOClient;
        }

        if(empty($bucket)) return false;

        $policy = '{
            "Version": "2012-10-17",
            "Statement": [
                {
                    "Effect": "Allow",
                    "Principal": "*",
                    "Action": [
                        "s3:DeleteObjectTagging",
                        "s3:ListBucketMultipartUploads",
                        "s3:DeleteObjectVersion",
                        "s3:ListBucket",
                        "s3:DeleteObjectVersionTagging",
                        "s3:GetBucketAcl",
                        "s3:ListMultipartUploadParts",
                        "s3:PutObject",
                        "s3:GetObjectAcl",
                        "s3:GetObject",
                        "s3:AbortMultipartUpload",
                        "s3:DeleteObject",
                        "s3:GetBucketLocation",
                        "s3:PutObjectAcl",
                        "s3:putBucketOwnershipControls",
                        "s3:putBucketPolicy"
                    ],
                    "Resource": [
                        "arn:aws:s3:::' . $bucket . '/*",
                        "arn:aws:s3:::' . $bucket . '"
                    ]
                }
            ]
        }';

        // Add bucket policy
        $DOClient->putBucketPolicy(['Bucket' => $bucket, 'Policy' => $policy]);

        return true;
    }

    /**
     * Add Bucket Ownership
     */
    private function changeBucketOwnership($bucket, $DOClient = false, $ownership = 'BucketOwnerPreferred') {
        if($DOClient == false) {
            $DOClient = $this->DOClient;
        }

        if(empty($bucket)) return false;

        // Change object ownership ACL enabled
        $DOClient->putBucketOwnershipControls([
            'Bucket'           => $bucket,
            'OwnershipControls' => [
                'Rules' => [['ObjectOwnership' => $ownership]],
            ],
        ]);

        return true;
    }

    /**
     * Change transfer accilaration
     */
    private function changeTransferAccilaration($bucket, $DOClient = false, $enable=false, $force = false) {
        if($DOClient == false) {
            $DOClient = $this->DOClient;
        }

        if(empty($bucket)) return false;
        if(!$force && !$enable) return true;

        $DOClient->putBucketAccelerateConfiguration([ 
            'Bucket'                    => $bucket,
            'AccelerateConfiguration'   => [
                'Status' => $enable ? 'Enabled' : 'Suspended'
            ] 
        ]);

        return true;
    }

    /**
     * isConfigured Function To Identify the congfigurations are correct
     * @since 1.0.0
     */
    public function isConfigured(){
        if ($this->DOClient) {
            try {
                $buckets = $DOClient->listBuckets();
                if(!empty($buckets)){
                    foreach($buckets as $bucket) {
                        if ($bucket['Name']==$this->bucket_name) {
                            return true;
                        }
                    }
                } 
                return false;
            } catch (AwsException $ex) {
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
        try {
            $this->DOClient->putObjectAcl([
                'Bucket'    => $this->bucket_name,
                'Key'       => $key,
                'ACL'       => 'private'
            ]); 
            return true;
        } catch (AwsException $ex) {
            return false;
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
        try {
            $this->DOClient->putObjectAcl([
                'Bucket'    => $this->bucket_name,
                'Key'       => $key,
                'ACL'       => 'public-read'
            ]); 
            return true;
        } catch (AwsException $ex) {
            return false;
        }
        return false;
    }



    /**
     * Check the object exist 
     * @since 1.1.8
     */
    public function exists($key) {
        if(!$key) return false;

        if($this->DOClient->doesObjectExist($this->bucket_name, $key)) {
            return true;
        }
        
        return false;
    }

    /**
     * Upload Single
     * @since 1.0.0
     * @return boolean
     */
    public function uploadSingle($media_absolute_path, $media_path, $prefix='') {
        $result = array();
        if (
            isset($media_absolute_path) && !empty($media_absolute_path) &&
            isset($media_path) && !empty($media_path)
        ) {
            $file_name = wp_basename( $media_path );
            if ($file_name) {
                $upload_path = Utils::generate_object_key($file_name, $prefix);
               
                // Decide Multipart upload or normal put object
                if (filesize($media_absolute_path) <= Schema::getConstant('DOCEAN_MULTIPART_MIN_FILE_SIZE')) {
                    // Upload a publicly accessible file. The file size and type are determined by the SDK.
                    try {
                        $upload = $this->DOClient->putObject([
                            'Bucket' => $this->bucket_name,
                            'Key'    => $upload_path,
                            'Body'   => fopen($media_absolute_path, 'r'),
                            'ACL'    => 'public-read', // make file 'public'
                        ]);

                        $result = array(
                            'success'   => true,
                            'code'      => 200,
                            'file_url'  => $upload->get('ObjectURL'),
                            'key'       => $upload_path,
                            'message'   => esc_html__('File Uploaded Successfully', 'media-cloud-sync')
                        );
                    } catch (AwsException $e) {
                        $result = array(
                            'success' => false,
                            'code'    => 200,
                            'message' => $e->getMessage()
                        );
                    }
                } else {
                    $multiUploader = new MultipartUploader($this->DOClient, $media_absolute_path, [
                        'bucket'    => $this->bucket_name,
                        'key'       => $upload_path,
                        'acl'       => 'public-read', // make file 'public'
                    ]);
                    
                    try {
                        do {
                            try {
                                $uploaded = $multiUploader->upload();
                            } catch (MultipartUploadException $e) {
                                $multiUploader = new MultipartUploader($this->DOClient, $media_absolute_path, [
                                    'state' => $e->getState(),
                                ]);
                            }
                        } while (!isset($uploaded));

                        if (isset($uploaded['ObjectURL']) && !empty($uploaded['ObjectURL'])) {
                            $result = array(
                                'success' => true,
                                'code'    => 200,
                                'file_url' => urldecode($uploaded['ObjectURL']),
                                'key'     => $upload_path,
                                'message' => esc_html__('File Uploaded Successfully', 'media-cloud-sync')
                            );
                        } else {
                            $result = array(
                                'success' => false,
                                'code'    => 200,
                                'message' => esc_html__('Something happened while uploading to server', 'media-cloud-sync')
                            );
                        }
                    } catch (MultipartUploadException $e) {
                        $result = array(
                            'success' => false,
                            'code'    => 200,
                            'message' => $e->getMessage()
                        );
                    }
                }
            } else {
                $result = array(
                    'success' => false,
                    'code'    => 200,
                    'message' => esc_html__('Check the file you are trying to upload. Please try again', 'media-cloud-sync')
                );
            }
        } else {
            $result = array(
                'success' => false,
                'code'    => 200,
                'message' => esc_html__('Insufficient Data. Please try again', 'media-cloud-sync')
            );
        }
        return $result;
    }

    /**
     * Save object to server
     * @since 1.0.0
     */
    public function object_to_server($key, $save_path) {
        try {
            $getObject = $this->DOClient->GetObject([
                'Bucket' => $this->bucket_name,
                'Key'    => $key,
                'SaveAs' => $save_path
            ]);
            if (file_exists($save_path)) {
                return true;
            }
        } catch (AwsException $e) {
            return false;
        }
        return false;
    }


    /**
     * Delete Single
     * @since 1.0.0
     * @return boolean
     */
    public function deleteSingle($key) {
        $result = array();
        if (isset($key) && !empty($key)) {
            try {
                $this->DOClient->deleteObject([
                    'Bucket' => $this->bucket_name,
                    'Key'    => $key
                ]);

                if (!$this->DOClient->doesObjectExist($this->bucket_name, $key)) {  
                    $result = array(
                        'success' => true,
                        'code'    => 200,
                        'message' => esc_html__('Deleted Successfully', 'media-cloud-sync')
                    );
                } else {
                    $result = array(
                        'success' => false,
                        'code'    => 200,
                        'message' => esc_html__('File not deleted', 'media-cloud-sync')
                    );
                }
            } catch (AwsException $e) {
                $result = array(
                    'success' => false,
                    'code'    => 200,
                    'message' => $e->getMessage()
                );
            }
        } else {
            $result = array(
                'success' => false,
                'code'    => 200,
                'message' => esc_html__('Insufficient Data. Please try again', 'media-cloud-sync')
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
                $cmd = $this->DOClient->getCommand('GetObject', [
                    'Bucket' => $this->bucket_name,
                    'Key'    => $key
                ]);

                $expires = isset($this->settings['presigned_expire']) ? $this->settings['presigned_expire'] : 20;

                $request = $this->DOClient->createPresignedRequest($cmd, sprintf('+%s  minutes', $expires));

                if ($presignedUrl = (string)$request->getUri()) {
                    $result = array(
                        'success'   => true,
                        'code'      => 200,
                        'file_url'  => $presignedUrl,
                        'message'   => esc_html__('Got Presigned URL Successfully', 'media-cloud-sync')
                    );
                } else {
                    $result = array(
                        'success' => false,
                        'code'    => 200,
                        'message' => esc_html__('Error getting presigned URL', 'media-cloud-sync')
                    );
                }
            } catch (AwsException $e) {
                $result = array(
                    'success' => false,
                    'code'    => 200,
                    'message' => $e->getMessage()
                );
            }
        } else {
            $result = array(
                'success' => false,
                'code'    => 200,
                'message' => esc_html__('Insufficient Data. Please try again', 'media-cloud-sync')
            );
        }
        return $result;
    }

    /**
     * Get domain URL
     */
    public function get_domain($region = '') {
        if(empty($region)) {
            $region = isset($this->config['region']) ? $this->config['region'] : '';
        }
        return "https://{$region}.digitaloceanspaces.com";
    }

}