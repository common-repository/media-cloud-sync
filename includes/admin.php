<?php
namespace Dudlewebs\WPMCS;

defined('ABSPATH') || exit;

class Admin {
    private static $instance = null;
    private $assets_url;
    private $version;
    private $token;
    private $script_suffix;

    protected $hook_suffix = [];
    /**
     * Admin constructor.
     * @since 1.0.0
     */
    public function __construct() {
        $this->assets_url       = WPMCS_ASSETS_URL;
        $this->version          = WPMCS_VERSION;
        $this->token            = WPMCS_TOKEN;
        $this->script_suffix    = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';

        $plugin = plugin_basename(WPMCS_FILE);

        // Create file directory on action do
        add_action( $this->token.'_create_plugin_dir', [ $this, 'create_plugin_dir' ] );

        // add action links to link to link list display on the plugins page.
        add_filter("plugin_action_links_$plugin", [$this, 'plugin_action_links']);

        // add our custom CSS classes to <body>
		add_filter( 'admin_body_class', [ $this, 'admin_body_class' ] );
        // Admin Init
        add_action('admin_init', [$this, 'adminInit']);

        add_action('admin_menu', [$this, 'add_menu'], 10);

        add_action('admin_enqueue_scripts', [$this, 'admin_enqueue_scripts'], 10, 1);
        add_action('admin_enqueue_scripts', [$this, 'admin_enqueue_styles'], 10, 1);
        // Load media scripts
        add_action( 'load-upload.php', [ $this, 'load_media_assets' ], 11 );
    }

    /**
     * Method that is used on plugin initialization time
     * @since 1.0.0
     */
    public function adminInit() {
        if(get_option( $this->token.'_db_version' ) !== WPMCS_DB_VERSION) {
            $database = Db::instance();
            $database->do_database_upgrade();
        }

        if (get_option($this->token.'_do_activation_redirect', false) && !Utils::get_service()) {
            delete_option($this->token.'_do_activation_redirect');
            wp_redirect(admin_url('admin.php?page=' . $this->token . '-admin-ui#/configure'));
        } else {
            delete_option($this->token.'_do_activation_redirect');
        }
    }

    /**
     * Installation. Runs on activation.
     *
     * @access  public
     * @return  void
     * @since   1.0.0
     */
    public function install(){
        $database = Db::instance();

        $database->create_table();

        // Redirection on activation
        add_option($this->token.'_do_activation_redirect', true);

        //Protect directories
        $this->_protect_upload_dir();
    }

    /**
     * Create plugin specific upload directory
     * @since 1.0.0
     */
    public function create_plugin_dir() {
        //Protect directories
        $this->_protect_upload_dir();
    }

    /**
     * Protect Directory from external access.
     *
     * @access  private
     * @return  void
     * @since   1.0.0
     */
    private function _protect_upload_dir(){
        $upload_dir = wp_upload_dir();

        $files = array(
            array(
                'base' => $upload_dir['basedir'] . '/' . Schema::getConstant('UPLOADS'),
                'file' => '.htaccess',
                'content' => 'Options -Indexes' . "\n"
                    . '<Files *.php>' . "\n"
                    . 'deny from all' . "\n"
                    . '</Files>'
            ),
            array(
                'base' => $upload_dir['basedir'] . '/' . Schema::getConstant('UPLOADS'),
                'file' => 'index.php',
                'content' => '<?php ' . "\n"
                    . '// Silence is golden.'
            )
        );

        foreach ($files as $file) {
            if ((wp_mkdir_p($file['base'])) && (!file_exists(trailingslashit($file['base']) . $file['file']))  // If file not exist
            ) {
                if ($file_handle = @fopen(trailingslashit($file['base']) . $file['file'], 'w')) {
                    fwrite($file_handle, $file['content']);
                    fclose($file_handle);
                }
            }
        }
    }

    /**
     * Deactivation hook
     */
    public function deactivation(){
    }

    /**
     * Load admin Javascript.
     * @access  public
     * @return  void
     * @since   1.0.0
     */
    public function admin_enqueue_scripts($hook = '') {
        if (!isset($this->hook_suffix) || empty($this->hook_suffix)) {
            return;
        }

        $screen = get_current_screen();

        if (in_array($screen->id, $this->hook_suffix, true)) {
            // Enqueue WordPress media scripts.
            if (!did_action('wp_enqueue_media')) {
                wp_enqueue_media();
            }

            // Enqueue custom backend script.
            wp_enqueue_script($this->token . '-backend', esc_url($this->assets_url) . 'js/backend.js', array('wp-i18n'), $this->version, true);

            // Localize a script.
            wp_localize_script(
                $this->token . '-backend',
                $this->token . '_object',
                array(
                    'api_nonce' => wp_create_nonce('wp_rest'),
                    'root' => rest_url($this->token . '/v1/'),
                    'assets_url' => $this->assets_url,
                )
            );
        }
    }



    /**
     * Load admin CSS.
     * @access  public
     * @return  void
     * @since   1.0.0
     */
    public function admin_enqueue_styles($hook = '') {
        if ( ! isset($this->hook_suffix) || empty($this->hook_suffix)) {
            return;
        } 
        $screen = get_current_screen();
        if (in_array($screen->id, $this->hook_suffix)) {
            wp_register_style($this->token.'-backend',
                esc_url($this->assets_url).'css/backend.css?nocache='.rand(0, 10000), array(), $this->version);
            wp_enqueue_style($this->token.'-backend');
        }
    }

    /**
     * Show action links on the plugin screen.
     *
     * @param mixed $links Plugin Action links.
     *
     * @return array
     */
    public function plugin_action_links($links){
        $action_links = array(
            'getstarted' => '<a href="' . admin_url('admin.php?page=' . $this->token . '-admin-ui#/configure') . '">' . esc_html__('Get Started', 'media-cloud-sync') . '</a>',
            'settings' => '<a href="' . admin_url('admin.php?page=' . $this->token . '-admin-ui/') . '">' . esc_html__('Settings', 'media-cloud-sync') . '</a>',
        );

        return array_merge($action_links, $links);
    }




    /**
     * Add Admin Menu
     */
    public function add_menu() {
        $this->hook_suffix[] = add_menu_page(
            esc_html__('Media Cloud Sync', 'media-cloud-sync'),
            esc_html__('Media Cloud Sync', 'media-cloud-sync'),
            'manage_options',
            $this->token.'-admin-ui',
            array($this, 'adminUi'),
            'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iOTAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA5MCA2MCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZD0iTTcwLjMwODYgMjMuMDM1N0w3MC42MDQxIDI0LjUzOUw3Mi4xMzI0IDI0LjY0NTJDODAuODA4NiAyNS4yNDgzIDg3LjYzODYgMzIuNDE0MyA4Ny42Mzg2IDQxLjI1Qzg3LjYzODYgNTAuNTAzIDgwLjE2MDEgNTggNzAuOTYzOSA1OEgyMi40MDk2QzExLjE1OTEgNTggMiA0OC44MTU1IDIgMzcuNVYzNy40OTk4QzEuOTk5NDIgMzIuNDQ3IDMuODU4NjYgMjcuNTczNSA3LjIxODQ4IDIzLjgxNTVDMTAuNTc4MSAyMC4wNTc3IDE1LjIwMDggMTcuNjgwNSAyMC4xOTc3IDE3LjEzODNMMjEuMjYzNiAxNy4wMjI3TDIxLjc1NzMgMTYuMDcwOUMyNi4wOTc2IDcuNzAzOTEgMzQuODA1MyAyIDQ0LjgxOTMgMkg0NC44MTk3QzUwLjgzNDggMS45OTg2MyA1Ni42NjQ3IDQuMDk0MDEgNjEuMzEzOCA3LjkyOTg2QzY1Ljk2MyAxMS43NjU4IDY5LjE0MyAxNy4xMDQ4IDcwLjMwODYgMjMuMDM1N1oiIHN0cm9rZT0iIzAyMDQ0QSIgc3Ryb2tlLXdpZHRoPSI0Ii8+CjxjaXJjbGUgY3g9IjQ1IiBjeT0iMzMiIHI9IjEyIiBzdHJva2U9IiMwMjA0NEEiIHN0cm9rZS13aWR0aD0iNCIvPgo8ZyBmaWx0ZXI9InVybCgjZmlsdGVyMF9kXzE4MV80OTgpIj4KPHBhdGggZD0iTTQ4LjA4NyAzMC41VjQwLjYyNzFMNDYuMTk1NyA0MlYyNEw1Mi41IDMwLjVINDguMDg3WiIgZmlsbD0iIzAyMDQ0QSIvPgo8cGF0aCBkPSJNNDIuNDEzIDM1LjVWMjUuMzcyOUw0NC4zMDQ0IDI0VjQyTDM4IDM1LjVINDIuNDEzWiIgZmlsbD0iIzAyMDQ0QSIvPgo8L2c+CjxkZWZzPgo8ZmlsdGVyIGlkPSJmaWx0ZXIwX2RfMTgxXzQ5OCIgeD0iMzAiIHk9IjE2IiB3aWR0aD0iMzAuNSIgaGVpZ2h0PSIzNCIgZmlsdGVyVW5pdHM9InVzZXJTcGFjZU9uVXNlIiBjb2xvci1pbnRlcnBvbGF0aW9uLWZpbHRlcnM9InNSR0IiPgo8ZmVGbG9vZCBmbG9vZC1vcGFjaXR5PSIwIiByZXN1bHQ9IkJhY2tncm91bmRJbWFnZUZpeCIvPgo8ZmVDb2xvck1hdHJpeCBpbj0iU291cmNlQWxwaGEiIHR5cGU9Im1hdHJpeCIgdmFsdWVzPSIwIDAgMCAwIDAgMCAwIDAgMCAwIDAgMCAwIDAgMCAwIDAgMCAxMjcgMCIgcmVzdWx0PSJoYXJkQWxwaGEiLz4KPGZlT2Zmc2V0Lz4KPGZlR2F1c3NpYW5CbHVyIHN0ZERldmlhdGlvbj0iNCIvPgo8ZmVDb21wb3NpdGUgaW4yPSJoYXJkQWxwaGEiIG9wZXJhdG9yPSJvdXQiLz4KPGZlQ29sb3JNYXRyaXggdHlwZT0ibWF0cml4IiB2YWx1ZXM9IjAgMCAwIDAgMC4wMDc4NDMxNCAwIDAgMCAwIDAuMDE1Njg2MyAwIDAgMCAwIDAuMjkwMTk2IDAgMCAwIDAuMTYgMCIvPgo8ZmVCbGVuZCBtb2RlPSJub3JtYWwiIGluMj0iQmFja2dyb3VuZEltYWdlRml4IiByZXN1bHQ9ImVmZmVjdDFfZHJvcFNoYWRvd18xODFfNDk4Ii8+CjxmZUJsZW5kIG1vZGU9Im5vcm1hbCIgaW49IlNvdXJjZUdyYXBoaWMiIGluMj0iZWZmZWN0MV9kcm9wU2hhZG93XzE4MV80OTgiIHJlc3VsdD0ic2hhcGUiLz4KPC9maWx0ZXI+CjwvZGVmcz4KPC9zdmc+Cg==',
            25
        );
     
        $this->hook_suffix[] = add_submenu_page(
            $this->token . '-admin-ui', 
            esc_html__('Dashboard', 'media-cloud-sync'), 
            esc_html__('Dashboard', 'media-cloud-sync'), 
            'manage_options', 
            $this->token . '-admin-ui' ,
            array($this, 'adminUi')
        );

        if(Utils::is_service_enabled()) {
            $this->hook_suffix[] = add_submenu_page(
                $this->token . '-admin-ui', 
                esc_html__('Settings', 'media-cloud-sync'), 
                esc_html__('Settings', 'media-cloud-sync'), 
                'manage_options', 
                $this->token . '-admin-ui#/settings' ,
                array($this, 'adminUi')
            );
        } else {
            $this->hook_suffix[] = add_submenu_page(
                $this->token . '-admin-ui', 
                esc_html__('Configure', 'media-cloud-sync'), 
                esc_html__('Configure', 'media-cloud-sync'), 
                'manage_options', 
                $this->token . '-admin-ui#/configure' ,
                array($this, 'adminUi')
            );
        }
    }

    /**
     * Calling view function for admin page components
     */
    public function adminUi() {
        echo wp_kses_post(sprintf(
            '<div id="%s_ui_root">
                <div class="%s_loader">
                    <h1>%s</h1>
                    <p>%s</p>
                </div>
            </div>', 
            $this->token,
            $this->token,
            esc_html__('Media Cloud Sync By Dudlewebs','media-cloud-sync'),
            esc_html__('Plugin is loading Please wait for a while..', 'media-cloud-sync')
        ));
       
    }


    /**
	 * Load the media assets
	 */
	public function load_media_assets() {
        /** CSS */
        wp_enqueue_style($this->token . '-media', esc_url($this->assets_url) . 'css/media.css', array(), $this->version);
        
        /** JS */
        wp_enqueue_script(
            $this->token . '-media', 
            esc_url($this->assets_url) . 'js/media.js', 
            array(
                'jquery',
                'media-views',
                'media-grid',
                'wp-util'
            ),
            $this->version, 
            true
        );

        // Localize a script.
        wp_localize_script(
            $this->token . '-media',
            $this->token . '_media_object',
            array(
                'file_details_nonce'    => wp_create_nonce('get_media_provider_details'),
                'admin_ajax_url'        => admin_url('admin-ajax.php'),
                'strings'               => array(
                    'provider'          => esc_html__("Provider: ", "media-cloud-sync"),
                    'region'            => esc_html__("Region: ", "media-cloud-sync"),
                    'access'            => esc_html__("Access: ", "media-cloud-sync"),
                    'access_private'    => esc_html__("Private", "media-cloud-sync"),
                    'access_public'     => esc_html__("Public", "media-cloud-sync"),
                )      
            )
        );
    }


    /**
	 * Add custom classes to the HTML body tag
	 *
	 * @param string $classes
	 *
	 * @return string
	 */
	public function admin_body_class( $classes ) {
		if ( ! $classes ) {
			$classes = array();
		} else {
			$classes = explode( ' ', $classes );
		}
		$classes[] = $this->token.'_page';
		/**
         *  Recommended way to target WP 3.8+
         *  http://make.wordpress.org/ui/2013/11/19/targeting-the-new-dashboard-design-in-a-post-mp6-world/
         * 
         */
		if ( version_compare( $GLOBALS['wp_version'], '3.8-alpha', '>' ) ) {
			if ( ! in_array( 'mp6', $classes ) ) {
				$classes[] = 'mp6';
			}
		}
		return implode( ' ', $classes );
	}
    

    /**
     * Ensures only one instance of Class is loaded or can be loaded.
     *
     * @return Main Class instance
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