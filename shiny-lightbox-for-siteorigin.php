<?php

/**
 *
 * @link              http://grell.es
 * @since             1.0.0
 * @package           ShinyLightboxForSiteorigin
 *
 * @wordpress-plugin
 * Plugin Name:       Shiny Lightbox for Siteorigin
 * Plugin URI:        http://plugins.grell.es
 * GitHub Plugin URI: boquiabierto/shiny-lightbox-for-siteorigin
 * GitHub Plugin URI: https://github.com/boquiabierto/shiny-lightbox-for-siteorigin
 * Description:       Open linked images in a lightbox.
 * Version:           1.1
 * Author:            Adrián Ortiz Arandes
 * Author URI:        http://grell.es
 * License:           GPL-3.0+
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain:       shiny-lightbox-for-siteorigin
 * Domain Path:       /languages
 */


class ShinyLightboxForSiteorigin {
	
	private $plugin_data;
	
	private $text_domain;
	
	function __construct() {
		
		add_action( 'init', array( $this, 'init' ) );
		add_action( 'init', array( $this, 'load_textdomain' ) );
		
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_assets' ) );
		add_filter( 'siteorigin_panels_widget_style_fields', array( $this, 'style_fields' ) );
		add_filter( 'siteorigin_panels_widget_style_attributes', array( $this, 'style_attributes' ), 10, 2);

	}
	
	public function init() {
		
		$this->plugin_data = get_plugin_data( __FILE__ );
		$this->text_domain = $this->plugin_data['TextDomain'];
		$this->lightbox_class = 'lightbox';
		$this->assets_path = plugin_dir_url( __FILE__ ) .'assets/';

	}
	
	public function load_textdomain() {
		load_plugin_textdomain(
			$this->text_domain,
			false,
			dirname( plugin_basename(__FILE__) ) . '/languages/'
		);
	}
	
	public function enqueue_assets() {
		
		wp_enqueue_style( 'shinybox', $this->assets_path . 'vendor/shinybox-master/source/shinybox.css', array(), false, 'all' );
		wp_enqueue_script( 'shinybox', $this->assets_path . 'vendor/shinybox-master/source/jquery.shinybox.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'shinybox-lightbox', $this->assets_path . 'js/shiny-lightbox.js', array( 'jquery', 'shinybox' ), false, true );

	}

	public function style_fields( $fields ) {

		$fields[$this->lightbox_class] = array(
			'name'        => '<span class="dashicons dashicons-format-gallery"></span> ' . __( 'Open links in lightbox', $this->text_domain ),
			'type'        => 'checkbox',
			'group'       => 'attributes',
			'priority'    => 20,
		);
		
		return $fields;
		
	}
	
	public function style_attributes( $attributes, $args ) {
		
		
		if( ! empty( $args[$this->lightbox_class] ) ) {
		
			array_push( $attributes['class'], $this->lightbox_class );
		
		}

		return $attributes;
	
	}
	
}

new ShinyLightboxForSiteorigin();
