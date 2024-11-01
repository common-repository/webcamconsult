<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://www.webswing.nl
 * @since      1.0.0
 *
 * @package    Webcamconsult
 * @subpackage Webcamconsult/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Webcamconsult
 * @subpackage Webcamconsult/admin
 * @author     Sjoerd Handofsky <sjoerd@webswing.nl>
 */
class Webcamconsult_Admin {

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $plugin_name       The name of this plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($plugin_name, $version) {

        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_styles() {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Webcamconsult_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Webcamconsult_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */
        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/webcamconsult-admin.css', array(), $this->version, 'all');
    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts() {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Webcamconsult_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Webcamconsult_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */
        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/webcamconsult-admin.js', array('jquery'), $this->version, false);
    }

    /**
     * Add menu options to the Wordpress admin
     */
    public function register_menu() {
        add_menu_page('Webcamconsult', 'Webcamconsult', 'manage_options', 'webcamconsult-admin-display', function() {
            require_once('partials/webcamconsult-admin-display.php');
        });
		add_submenu_page('webcamconsult-admin-display', 'Inline widget', 'Inline widget', 'manage_options', 'webcamconsult-inline-widgets', function() {
            require_once('partials/webcamconsult-inline-widget.php');
		});
    }

    /**
     * register the widget
     */
    public function register_widget() {
        register_widget('Webcamconsult_Widget');
    }

    public function get_widgets() {
        $client_id = get_option('webcamconsult_client_id');
        $url = "https://app.webcamconsult.com/widgets/api/" . $client_id;
        $arrContextOptions = array(
            "ssl" => array(
                "verify_peer" => false,
                "verify_peer_name" => false,
            ),
        );
        $content = file_get_contents($url, FALSE, stream_context_create($arrContextOptions));
        echo $content;
        wp_die();
    }

    public function set_client_id() {
        if (!is_admin()) {
            wp_die();
        }
        $client_id = $_POST['client_id'];
        update_option('webcamconsult_client_id', $client_id);
        wp_die();
    }

}
