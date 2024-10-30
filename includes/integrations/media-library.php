<?php
namespace Dudlewebs\WPMCS;

defined('ABSPATH') || exit;

class MediaLibrary {
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
        $this->registerActions();
    }

    /**
     * Register integration access
     */
    public function registerActions() {
        /** IMAGE EDITOR COMPATIBILITY */
        add_action( 'attachment_submitbox_misc_actions', array( $this, 'attachment_submitbox_metadata'),99 );
        //Media Modal Ajax
		add_action( 'wp_ajax_wpmcs_get_attachment_details', array( $this, 'ajax_get_attachment_details' ) );
    }


    /**
	 * Edit Image Meta In View Image
	 * @since 1.0.0
	 */
	function attachment_submitbox_metadata( ) {
        global $wpmcsItem;
        $post          = get_post();
	    $attachment_id = $post->ID;

        if (!Utils::is_ok_to_serve($attachment_id)) {
            return;
        }

        $item = $wpmcsItem->get($attachment_id);

        if (Utils::is_empty($item)) {
            return;
        }
        
        $provider = $wpmcsItem->get_field($attachment_id, 'provider');
        if($provider) { 
            $label = Schema::getServiceLabels($provider); ?>
            <div class="misc-pub-section misc-pub-provider">
                <?php esc_html_e( 'Provider :', 'media-cloud-sync' ); ?> <strong><?php echo esc_textarea(!empty($label) ? $label : $provider); ?></strong></a>
            </div>
        <?php
        }

        $region = $wpmcsItem->get_field($attachment_id, 'region');
        if($region) { ?>
            <div class="misc-pub-section misc-pub-provider">
                <?php esc_html_e( 'Region :', 'media-cloud-sync' ); ?> <strong><?php echo esc_textarea($region); ?></strong></a>
            </div>
        <?php
        }
        $private = (int)$wpmcsItem->get_field($attachment_id, 'is_private');
        ?>
            <div class="misc-pub-section misc-pub-provider">
                <?php esc_html_e( 'Access :', 'media-cloud-sync' ); ?> <strong><?php $private ? esc_html_e( 'Private', 'media-cloud-sync' ) : esc_html_e( 'Public', 'media-cloud-sync' ); ?></strong></a>
            </div>
        <?php
	}


    /**
     * Function to get attachment details by ID
     */
    public function ajax_get_attachment_details() {
        $result = array(
            'status'    => false,
            'data'      => array(),
            'exclude'   => false
        );

        if ( ! isset( $_POST['id'] ) ) {
            wp_send_json_success( $result );
		}

		check_ajax_referer( 'get_media_provider_details', '_nonce' );

		$id= intval( sanitize_text_field( $_POST['id'] ) );
        global $wpmcsItem;

        // Return if extension not allowed
        $path = get_attached_file( $id );
        if(!Utils::is_extension_available($path)) {
            $result['exclude'] = true;
            wp_send_json_success( $result );
        }

        if (!Utils::is_ok_to_serve($id)) {
            wp_send_json_success( $result );
        }

        $item = $wpmcsItem->get($id);

        if (Utils::is_empty($item)) {
            wp_send_json_success( $result );
        }

        $provider = $wpmcsItem->get_field($id, 'provider');
        if($provider){
            $label = Schema::getServiceLabels($provider);
            $item['provider'] = !empty($label) ? $label : $provider;
        }
        $region = $wpmcsItem->get_field($id, 'region');
        if($region){
            $item['region'] = $region;
        }
        $item['private'] = $wpmcsItem->get_field($id, 'private');
        if($item) {
            $result= array(
                'status' => true,
                'data' => $item
            );
        }
        
        wp_send_json_success( $result );
    }

    
    public static function instance(){
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}