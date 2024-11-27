<?php
/**
 * Plugin Name: Scan QR Code to Redirect URL
 * Plugin URI: https://github.com/sahabuddinsgr/scan-qr-code-to-redirect-url
 * Description: This plugin allows you to scan a QR code and redirect to a specific URL.
 * Version: 1.0.0
 * Author: Sahabuddin
 * Author URI: https://github.com/sahabuddinsgr
 * License: GPL-2.0+
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: scan-qr-code-to-redirect-url
 */


class Scan_QR_Code_To_Redirect_URL {

    private static $instance;

    private function __construct() {
        add_filter('the_content', array($this, 'add_qr_code_to_content'));
        add_action('wp_footer', array( $this, 'add_qr_code_to_footer' ));
    }

    public static function get_instance() {
        if (self::$instance) {
            return self::$instance;
        }
        self::$instance = new self();
        return self::$instance;
    }

    public function add_qr_code_to_content($content) {
        $url = get_permalink();
        $image = '<p> <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=' . $url . '" alt="QR Code" /> </p>';
        $content .= $image;
        return $content;
    }

    public function add_qr_code_to_footer() {
        $url = home_url();
        $image = '<p> <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=' . $url . '" alt="QR Code" /> </p>';
        echo $image;
    }
}

Scan_QR_Code_To_Redirect_URL::get_instance();