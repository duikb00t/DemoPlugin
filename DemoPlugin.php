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
    load_plugin_textdomain('duikb00t-Demo-Plugin', false, basename( dirname( __FILE__ ) ) . '/languages' );

    add_action( 'wp_enqueue_scripts', array( $this, 'register_plugin_styles' ) );
    add_action( 'wp_enqueue_scripts', array( $this, 'register_plugin_scripts' ) );

    /** Add Ajax Hooks **/
    add_action( 'wp_ajax_get_local_weather', 'get_local_weather' );
    add_action( 'wp_ajax_nopriv_get_local_weather', 'get_local_weather' );

    add_shortcode( 'location_finder', array( $this, 'generate_form' ) );
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

  public function get_local_weather() {
    echo 'test';
  }

  public function fetch_html_content( $file ) {
    ob_start();
    include_once( $file );
    $output = ob_get_clean();
    return $output;
  }
}

$demo = new DemoPlugin();
