<?php

namespace Dudlewebs\WPMCS;

defined('ABSPATH') || exit;

class Utils {
    /**
     * Check a variable is empty
     * @since 1.0.0
     * @param string|integer|array|float 
     * @return boolean
     */
    public static function is_empty($var){
        if (is_array($var)) {
            return empty($var);
        } else {
            return ($var === null || $var === false || $var === '');
        }
    }

    /**
     * Function To get Plugin Specific Wordpress Option
     * @since 1.0.0
     * @return array|boolean|string|integer|float|double
     */
    public static function get_option($key, $default = false, $meta_name = false, $expire = false){
        $data = Cache::get_object_cache( $key, false, $meta_name, $expire );
        return $data == false ? $default : $data;
    }

    /**
     * Function To update Plugin Specific Wordpress Option
     * @since 1.0.0
     * @return boolean
     */
    public static function update_option($key, $options, $meta_name = false, $expire = false){
        return Cache::set_object_cache( $key, $options, false, $meta_name, $expire );
    }

    /**
     * Function To delete Plugin Specific Wordpress Option
     * @since 1.0.0
     * @return boolean
     */
    public static function delete_option($key, $meta_name = false){
        return Cache::delete_object_cache( $key, false, $meta_name );
    }

    /**
     * Function To get Plugin Specific Wordpress post meta
     * @since 1.0.0
     * @return array|boolean|string|integer|float|double
     */
    public static function get_meta($post_id, $key, $default = false, $meta_name = false, $expire = false){
        $data = Cache::get_object_cache( $key, $post_id, $meta_name, $expire );
        return $data == false ? $default : $data;
    }

    /**
     * Function To update Plugin Specific Wordpress post meta
     * @since 1.0.0
     * @return boolean
     */
    public static function update_meta($post_id, $key, $options, $meta_name = false, $expire = false){
        return Cache::set_object_cache( $key, $options, $post_id, $meta_name, $expire );
    }

    /**
     * Function To delete Plugin Specific Wordpress post meta
     * @since 1.0.0
     * @return boolean
     */
    public static function delete_meta($post_id, $key, $meta_name = false){
        return Cache::delete_object_cache( $key, $post_id, $meta_name );
    }

    /**
     * Function To get Current credentials
     * @since 1.0.0
     * @return array|boolean|string|integer|float|double
     */
    public static function get_credentials($option='', $default=false){
        $current_setttings = self::get_option('credentials',[], Schema::getConstant('GLOBAL_SETTINGS_KEY'));
        if(isset($current_setttings) && !empty($current_setttings)){
            if(isset($option) && !empty($option)){
                if(isset($current_setttings[$option])) {
                    return $current_setttings[$option];
                } else {
                    return $default;
                }
            } else {
                return $current_setttings;
            }
        } else {
            return $default;
        }
    }

    /**
     * Function To get Current settings
     * @since 1.0.0
     * @return array|boolean|string|integer|float|double
     */
    public static function get_settings($option='', $default=false){
        $current_setttings = self::get_option('settings',[], Schema::getConstant('GLOBAL_SETTINGS_KEY'));
        if(isset($current_setttings) && !empty($current_setttings)){
            if(isset($option) && !empty($option)){
                if(isset($current_setttings[$option])) {
                    return $current_setttings[$option];
                } else {
                    return $default;
                }
            } else {
                return $current_setttings;
            }
        } else {
            return $default;
        }
    }

    /**
     * Function To get Current Service
     * @since 1.0.0
     * @return array|boolean|string|integer|float|double
     */
    public static function get_service(){
        $current_service = self::get_credentials('service', '');
        if(isset($current_service) && !empty($current_service)){
            return $current_service;
        } else {
            return false;
        }
    }

    /**
     * Function To get Current config
     * @since 1.0.0
     * @return array|boolean|string|integer|float|double
     */
    public static function get_config($option='', $default=false){
        $current_setttings = self::get_credentials('config',[]);
        if(isset($current_setttings) && !empty($current_setttings)){
            if(isset($option) && !empty($option)){
                if(isset($current_setttings[$option])) {
                    return $current_setttings[$option];
                } else {
                    return $default;
                }
            } else {
                return $current_setttings;
            }
        } else {
            return $default;
        }
    }

    /**
     * Function to check serving media environment is ok
     * @since 1.0.0
     * @return boolean
     */
    public static function is_ok_to_serve($attachment_id = false, $check_id = true){
        return (
            self::get_service() &&
            self::get_settings('rewrite_url') &&
            ( $check_id ? isset($attachment_id) && !empty($attachment_id) : true )    
        );
    }

    /**
     * Function to check uploading media environment is ok
     * @since 1.0.0
     * @return boolean
     */
    public static function is_ok_to_upload($attachment_id = false){
        return (
            self::get_service() &&
            self::get_settings('copy_to_bucket') &&
            isset($attachment_id) && !empty($attachment_id)
        );
    }

    /**
     * Function To check service is enabled
     * @since 1.0.0
     * @return array|boolean|string|integer|float|double
     */
    public static function is_service_enabled(){
        return !!self::get_service();
    }

    /**
     * Check whether a file exist in a list of files
     * @since 1.0.1
     * @return boolean
     */
    public static function check_existing_file_names( $filename, $files ) {
        $fname = pathinfo( $filename, PATHINFO_FILENAME );
        $ext   = pathinfo( $filename, PATHINFO_EXTENSION );
    
        // Edge case, file names like `.ext`.
        if ( empty( $fname ) ) {
            return false;
        }
    
        if ( $ext ) {
            $ext = ".$ext";
        }
    
        $regex = '/^' . preg_quote( $fname ) . '-(?:\d+x\d+|scaled|rotated)' . preg_quote( $ext ) . '$/i';
    
        foreach ( $files as $file ) {
            if ( 
                preg_match( $regex, wp_basename($file) ) || 
                $filename == $file
            ) {
                return true;
            }
        }
    
        return false;
    }

    /**
     * Get Post Meta Data By Query
     * @since 1.0.0
     * @return boolean
     */
    public static function get_post_meta($post_id, $key, $single=false, $db_query=false){
        global $wpdb;
        if(!(!empty($key) || $post_id)) return false;

        if($db_query) {
            $meta_data = $wpdb->get_row( "SELECT meta_value FROM $wpdb->postmeta WHERE post_id=$post_id AND meta_key='$key'" );
            if ($wpdb->last_error || null === $meta_data || !isset($meta_data)) {
                return false;
            }
            return $meta_data->meta_value;
        } else {
            return get_post_meta( $post_id, $key, $single );
        }
    }

    /**
     * Get Image URL and path from URL
     * Return Relative URL and Path of an attachment.
     * @since 1.0.0
     * 
     */
    public static function get_attachment_source_path($file) {
        if ( isset($file) && !empty($file) ) {
            $uploads            = wp_get_upload_dir();
            $file_path          = '';
            $site_url           = site_url('/');
            $server_base_path   = self::get_settings('base_path');
            if ( $uploads && false === $uploads['error'] ) {

                $uploadDir  = substr( $uploads['baseurl'], strpos( $uploads['baseurl'], $site_url ) + strlen($site_url)); 

                // Get URL and PATH
                if ( 0 === strpos( $file, $uploads['basedir'] ) ||  0 === strpos( $file, $uploads['baseurl'] ) ) {   // If URL is full link 
                    $file_path  = str_replace( $uploads['basedir'], '', $file );
                    $file_path  = str_replace( $uploads['baseurl'], '', $file_path ); // Replace if has URl
                } else if ( 
                    0 === strpos( $file, str_replace('/','\\', $uploads['basedir'] )) ||  
                    0 === strpos( $file, str_replace('\\','/', $uploads['baseurl'] )) 
                ) {   // If URL is full link and the url is slash unified (Like: str_replace('/','\\', $dir))
                    $file_path  = str_replace( str_replace('/','\\', $uploads['basedir'] ), '', $file );
                    $file_path  = str_replace( str_replace('\\','/', $uploads['baseurl'] ), '', $file_path ); // Replace if has URl
                    $file_path  = str_replace('\\','/', $file_path );
                } else if ( false !== strpos( $file, $uploadDir ) ) {   //If URL has sub Directory That matches end of base URL(eg: wp-content/uploads)
                    $fileDir    = dirname( $file );
                    $start_pos  = strpos( $fileDir, $uploadDir ) + strlen($uploadDir); 
                    $subDir     = substr( $fileDir, $start_pos, strlen($fileDir)); // Find Sub Directory
                    $file_name  = wp_basename( $file );

                    $file_path  = trailingslashit($subDir) . $file_name;
                } else if($server_base_path && false !== strpos( $file, trailingslashit($server_base_path))) {
                    $fileDir    = dirname( $file );
                    $start_pos  = strpos( $fileDir, $server_base_path) + strlen($server_base_path); 
                    $subDir     = substr( $fileDir, $start_pos, strlen($fileDir)); // Find Sub Directory
                    $file_name  = wp_basename( $file );

                    $file_path  = trailingslashit($subDir) . $file_name;
                } else if(filter_var($file, FILTER_VALIDATE_URL)) {
                    $parsed     = parse_url($file); 
                    $path       = isset($parsed["path"]) ? $parsed["path"] : '';
                    $query      = isset($parsed["query"]) ? '?'.$parsed["query"] : '';
                    $file_path  = $path. $query;
                } else {
                    $file_path  = $file;
                }

                return apply_filters( 'wpmcs_get_relative_file_path_from_upload_directory', untrailingslashit(ltrim( $file_path, '/\\' )), $file );
            } 
        } 
        return false;
    }

    /**
     * Check extension is compatible
     * @since 1.0.0
     * @return boolean
     */
    public static function is_extension_available($path){
        $settings   = self::get_settings();
        $path_parts = pathinfo($path);

        if(!isset($path_parts['basename']) || !isset($path_parts['extension'])) return false;

        $alowed         = isset($settings['extensions_include']) ? $settings['extensions_include'] : [];
        $not_allowed    = isset($settings['extensions_exclude']) ? $settings['extensions_exclude'] : [];

        if(
            (in_array($path_parts['extension'], $not_allowed)) || 
            (!empty($alowed) && !in_array($path_parts['extension'], $alowed))
        ) {
            return false;
        }
        
        $type_and_ext   = wp_check_filetype_and_ext($path, $path_parts['basename']);
        $ext            = empty( $type_and_ext['ext'] ) ? '' : $type_and_ext['ext'];
		$type           = empty( $type_and_ext['type'] ) ? '' : $type_and_ext['type'];

		if ( ( ! $type || ! $ext ) && ! current_user_can( 'unfiltered_upload' ) ) {
			return false;
		}
        
        return true;
    }

    /**
     * Generate prefix for object versioning
     * @since 1.0.0
     * @return string
     */
    public static function generate_object_versioning_prefix(){
        $year_month     = self::get_settings('year_month');
        $date_format    = $year_month ? 'dHis' : 'YmdHis';

        // Use current time so that object version is unique
        $time = current_time('timestamp');

        $object_version = date($date_format, $time) . '/';
        $object_version = apply_filters('wpmcs_object_version_prefix', $object_version);

        return $object_version;
    }

    /**
     * Generate Key for Objects
     * @since 1.0.0
     */
    public static function generate_object_key($file_name, $prefix) {
        $upload_path    = '';
        $base_path      = self::get_settings('base_path');
        $year_month     = self::get_settings('year_month');

        if(isset($base_path) && !empty($base_path)) {
            $upload_path.= preg_replace('~/+~', '/', 
                                    str_replace('\\', '/', 
                                        trim($base_path," \n\r\t\v\x00\/ ")
                                    )
                                );
        }
        if(isset($year_month) && $year_month) {
            $upload_path.= '/'.date("Y/m");
        }

        return ltrim($upload_path.'/'.$prefix.$file_name, '/');
    }

    /**
     * Maybe convert size to string
     *
     * @param int   $attachment_id
     * @param mixed $size
     *
     * @return null|string
     */
    public static function maybe_convert_size_to_string( $attachment_id, $size ) {
        if ( is_array( $size ) ) {
            $width  = ( isset( $size[0] ) && $size[0] > 0 ) ? $size[0] : 1;
			$height = ( isset( $size[1] ) && $size[1] > 0 ) ? $size[1] : 1;
			$original_aspect_ratio = $width / $height;
			$meta   = wp_get_attachment_metadata( $attachment_id );

			if ( ! isset( $meta['sizes'] ) || empty( $meta['sizes'] ) ) {
				return false;
			}

			$sizes = $meta['sizes'];
			uasort( $sizes, function ( $a, $b ) {
				// Order by image area
				return ( $a['width'] * $a['height'] ) - ( $b['width'] * $b['height'] );
			} );

			$near_matches = array();

			foreach ( $sizes as $size => $value ) {
				if ( $width > $value['width'] || $height > $value['height'] ) {
					continue;
				}
				$aspect_ratio = $value['width'] / $value['height'];
				if ( $aspect_ratio === $original_aspect_ratio ) {
					return $size;
				}
				$near_matches[] = $size;
			}
			// Return nearest match
			if ( ! empty( $near_matches ) ) {
				return $near_matches[0];
			}
        }

        return $size;
    }

    /**
     * Reduce the given URL down to the simplest version of itself.
     *
     * Useful for matching against the full version of the URL in a full-text search
     * or saving as a key for dictionary type lookup.
     *
     * @param string $url
     *
     * @return string
     */
    public static function reduce_url( $url ) {
        $parts = static::parse_url( $url );
        $host  = isset( $parts['host'] ) ? $parts['host'] : '';
        $port  = isset( $parts['port'] ) ? ":{$parts['port']}" : '';
        $path  = isset( $parts['path'] ) ? $parts['path'] : '';

        return '//' . $host . $port . $path;
    }

    /**
     * Remove scheme from URL.
     * 
     * @param string $url
     * @return string
     */
    public static function remove_scheme( $url ) {
        return preg_replace( '/^(?:http|https):/', '', $url );
    }

    /**
     * Remove size from filename (image[-100x100].jpeg).
     *
     * @param string $url
     * @param bool   $remove_extension
     *
     * @return string
     */
    public static function remove_size_from_filename( $url, $remove_extension = false ) {
        $url = preg_replace( '/^(\S+)-[0-9]{1,4}x[0-9]{1,4}(\.[a-zA-Z0-9\.]{2,})?/', '$1$2', $url );

        $url = apply_filters( 'wpmcs_remove_size_from_filename', $url );

        if ( $remove_extension ) {
            $ext = pathinfo( $url, PATHINFO_EXTENSION );
            $url = str_replace( ".$ext", '', $url );
        }

        return $url;
    }

    /**
     * Is the string a URL?
     *
     * @param mixed $string
     *
     * @return bool
     */
    public static function is_url( $string ): bool {
        if ( empty( $string ) || ! is_string( $string ) ) {
            return false;
        }

        if ( preg_match( '@^(?:https?:)?//[a-zA-Z0-9\-]+@', $string ) ) {
            return true;
        }

        return false;
    }

    /**
     * Parses a URL into its components. Compatible with PHP < 5.4.7.
     *
     * @param string $url       The URL to parse.
     *
     * @param int    $component PHP_URL_ constant for URL component to return.
     *
     * @return mixed An array of the parsed components, mixed for a requested component, or false on error.
     */
    public static function parse_url( $url, $component = -1 ) {
        $url       = trim( $url );
        $no_scheme = 0 === strpos( $url, '//' );

        if ( $no_scheme ) {
            $url = 'http:' . $url;
        }

        $parts = parse_url( $url, $component );

        if ( 0 < $component ) {
            return $parts;
        }

        if ( $no_scheme && is_array( $parts ) ) {
            unset( $parts['scheme'] );
        }

        return $parts;
    }

    /**
     * Is the given string a usable URL?
     *
     * We need URLs that include at least a domain and filename with extension
     * for URL rewriting in either direction.
     *
     * @param mixed $url
     *
     * @return bool
     */
    public static function is_file_url( $url ): bool {
        if ( ! static::is_url( $url ) ) {
            return false;
        }

        $parts = static::parse_url( $url );

        if (
            empty( $parts['host'] ) ||
            empty( $parts['path'] ) ||
            ! pathinfo( $parts['path'], PATHINFO_EXTENSION )
        ) {
            return false;
        }

        return true;
    }

}
