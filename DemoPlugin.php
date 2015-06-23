<?php
/*
Plugin Name: DemoPlugin
Plugin URI:  http://wordpress.org/plugins/DemoPluginOrSomeThingLikeThat/
Description: Just a simple plugin which return the users or something.
Version:     1.0.1
Author:      duikb00t
License:     MIT
Text Domain: duikb00t-Demo-Plugin
Domain Path: /languages/
*/

class DemoPlugin {

  public function __construct() {


    /** Initialize ajax **/
    add_action( 'init', array( &$this, 'init' ) );

    /** Setup Text Domain **/
    load_plugin_textdomain('duikb00t-Demo-Plugin', false, basename( dirname( __FILE__ ) ) . '/languages' );

    /** Register Plugin Styles & Scripts */
    add_action( 'wp_enqueue_scripts', array( $this, 'register_plugin_styles' ) );
    add_action( 'wp_enqueue_scripts', array( $this, 'register_plugin_scripts' ) );

    /** Generate Shortcode **/
    add_shortcode( 'location_finder', array( $this, 'generate_form' ) );

    /** AJAX **/
    if ( is_admin() ) {
      add_action( 'wp_ajax_nopriv_ajax-example', array( &$this, 'ajax_call' ) );
      add_action( 'wp_ajax_ajax-example', array( &$this, 'ajax_call' ) );
    }
  }

  public function init() {
    wp_enqueue_script( 'ajax-example', plugin_dir_url( __FILE__ ) . 'js/ajax.js', array( 'jquery' ) );
  	wp_localize_script( 'ajax-example', 'AjaxExample', array(
  		'ajaxurl' => admin_url( 'admin-ajax.php' ),
  		'nonce' => wp_create_nonce( 'ajax-example-nonce' )
  	));
  }

  public function register_plugin_styles() {
    wp_register_style( 'DemoPlugin', plugins_url( 'DemoPlugin/css/plugin' ) );
    wp_enqueue_style( 'DembuoPlugin' );
  }

  public function register_plugin_scripts() {
    wp_deregister_script( 'jquery' );

    wp_register_script( 'bootstrap-js', ( 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js' ), false, null, true );
    wp_register_script( 'jquery', ( 'https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js' ), false, null, true );
    wp_register_script( 'DemoPlugin', plugins_url ( 'DemoPlugin/js/app.js' ), false, null, true);

    wp_enqueue_script('jquery');
    wp_enqueue_script('bootstrap-js');
    wp_enqueue_script('DemoPlugin');
  }

  public function generate_form( $content ) {
    $content = $this->fetch_html_content( dirname( __FILE__ ) . '/views/form.php');
    return $content;
  }

  public function ajax_call()
  {
    if ( ! isset( $_REQUEST['nonce'] ) || ! wp_verify_nonce( $_REQUEST['nonce'], 'ajax-example-nonce' ) )
    die ( 'Invalid Nonce' );
    header( "Content-Type: application/json" );
    echo json_encode( array(
      'success' => true,
      'time' => time()
    ));
    exit;
  }

  public function fetch_html_content( $file ) {
    ob_start();
    include_once( $file );
    $output = ob_get_clean();
    return $output;
  }
}

$demo = new DemoPlugin();
