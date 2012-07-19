<?php

/**
 * Uses the wemonit API to retrieve and display monitoring data, recorded by http://wemonit.de
 *
 * @package Ixiter WordPress Plugins
 * @subpackage IX WeMonit
 * @version 1.0
 * @author Peter Liebetrau <ixiter@ixiter.com>
 * @license GPL 3 or greater
 */
class Ix_Wemonit {

    private $_optionsName = 'ix_wemonit';
    private $_textdomain = 'ix_wemonit';
    protected $options = array( );
    protected $default_options = array(
	'email' => '',
	'password' => '',
	'apikey' => ''
    );
    protected $wemonit_error = array( );
    protected $services = array( );
    protected $service_details = array( );

    public function __construct() {
	$this->options = get_option( $this->_optionsName, $this->default_options );
	update_option( $this->_optionsName, $this->options );
	if ( !$this->options[ 'apikey' ] ) {
	    if ( $this->options[ 'email' ] && $this->options[ 'password' ] ) {
		$result = json_decode( wp_remote_post( 'http://www.wemonit.de/api/login/', array( 'email' => $this->options[ 'email' ], 'password' => $this->options[ 'password' ], ) ), true );
		$this->options[ 'apikey' ] = !$result[ 'error' ] ? $result[ 'apikey' ] : '';
		update_option( $this->_optionsName, $this->options );
		$this->wemonit_error = $result[ 'message' ];
	    }
	}

	if ( $this->options[ 'apikey' ] ) {
	    $http = wp_remote_post( 'http://www.wemonit.de/api/service/list', array( 'body' => array( 'apikey' => $this->options[ 'apikey' ] ) ) );
	    $this->services = json_decode( $http[ 'body' ], true );
	}

	$this->init();
    }

    private function init() {

	if ( is_admin() ) {
	    add_action( 'admin_menu', array( $this, 'add_options_page' ) );
	    add_action( 'plugins_loaded', array( $this, 'manageRequest' ) );
	}

	require_once dirname( __FILE__ ) . '/Ix_Wemonit_Widget.php';
	add_action( 'widgets_init', create_function( '', 'register_widget( "Ix_Wemonit_Widget" );' ) );

	add_shortcode( 'ix_wemonit_getIp4LatencyImage', array( $this, 'getIp4LatencyImage' ) );
	add_shortcode( 'ix_wemonit_getIp4UptimeImage', array( $this, 'getIp4UptimeImage' ) );
	add_shortcode( 'ix_wemonit_getIp6LatencyImage', array( $this, 'getIp6LatencyImage' ) );
	add_shortcode( 'ix_wemonit_getIp6UptimeImage', array( $this, 'getIp6UptimeImage' ) );

	add_shortcode( 'ix_wemonit_getAge', array( $this, 'getAge' ) );
	add_shortcode( 'ix_wemonit_getTimespan', array( $this, 'getTimespan' ) );
	add_shortcode( 'ix_wemonit_getCurrentLatency', array( $this, 'getCurrentLatency' ) );

	add_shortcode( 'ix_wemonit_getIp4Downtime', array( $this, 'getIp4Downtime' ) );
	add_shortcode( 'ix_wemonit_getIp4DowntimePercent', array( $this, 'getIp4DowntimePercent' ) );
	add_shortcode( 'ix_wemonit_getIp4UptimePercent', array( $this, 'getIp4UptimePercent' ) );

	add_shortcode( 'ix_wemonit_getIp6Downtime', array( $this, 'getIp6Downtime' ) );
	add_shortcode( 'ix_wemonit_getIp6DowntimePercent', array( $this, 'getIp6DowntimePercent' ) );
	add_shortcode( 'ix_wemonit_getIp6UptimePercent', array( $this, 'getIp6UptimePercent' ) );

	if ( !has_filter( 'widget_text', 'do_shortcode' ) )
	    add_filter( 'widget_text', 'do_shortcode', 11 ); // AFTER wpautop()
    }

    public function add_options_page() {
	$page = add_options_page( __( 'IX WeMonit Options', $this->_textdomain ), 'IX WeMonit', 'administrator', 'ix_wemonit', array( $this, 'options_page' ) );
    }

    public function manageRequest() {
	if ( isset( $_POST[ 'ix_wemonit_submit' ] ) ) {
	    foreach ( $this->options as $key => $val ) {
		$this->options[ $key ] = $_POST[ $key ];
	    }
	    update_option( $this->_optionsName, $this->options );
	    wp_redirect( admin_url() . 'options-general.php?page=ix_wemonit&updated=updated' );
	}
    }

    public function options_page() {
	extract( $this->options );
	$services = $this->services;
	require_once dirname( __FILE__ ) . '/admin/options-page.phtml';
    }

    public function getOptions() {
	return $this->options;
    }

    public function getServices() {
	return $this->services;
    }

    public function getService( $id ) {
	if ( !isset( $this->service_details[ $id ] ) ) {
	    $http = wp_remote_post( 'http://www.wemonit.de/api/service/view/', array( 'body' => array( 'apikey' => $this->options[ 'apikey' ], 'id' => $id ) ) );
	    $jsonarray = json_decode( $http[ 'body' ], true );
	    $this->service_details[ $id ] = $jsonarray[ 0 ];
	}
	return $this->service_details[ $id ];
    }

    private function getStatsImage( $atts, $type, $ip4_6 ) {
	extract( shortcode_atts( array(
		    'id' => '',
			), $atts ) );

	$statsImage = 'IP' . $ip4_6 . ' ' . $type . ' image for WeMonit Service ID ' . $id . ' not found';
	$service = $this->getService( $id );
	if ( $service ) {
	    $statsImage = '<img src="https://wemonit.de' . $service[ 'images' ][ $type . $ip4_6 ] . '" class="wp-image-ix_wemonit_' . $type . $ip4_6 . '" alt="' . $service[ 'name' ] . ' ' . $type . ' ' . $ip4_6 . '" />';
	}
	return $statsImage;
    }

    public function getIp4LatencyImage( $atts ) {
	return $this->getStatsImage( $atts, 'latency', '4' );
    }

    public function getIp4UptimeImage( $atts ) {
	return $this->getStatsImage( $atts, 'uptime', '4' );
    }

    public function getIp6LatencyImage( $atts ) {
	return $this->getStatsImage( $atts, 'latency', '6' );
    }

    public function getIp6UptimeImage( $atts ) {
	return $this->getStatsImage( $atts, 'uptime', '6' );
    }

    public function getCurrentLatency( $atts ) {
	$currentLatency = 'n/a';
	$service = $this->getService( $atts[ 'id' ] );
	if ( $service )
	    $currentLatency = $service[ 'current' ];

	return $currentLatency;
    }

    public function getAge( $atts ) {
	$age = 'n/a';
	$service = $this->getService( $atts[ 'id' ] );
	if ( $service )
	    $age = $service[ 'stats' ][ 'age' ];

	return $age;
    }

    public function getTimespan( $atts ) {
	$age = $this->getAge( $atts );
	return sprintf( "%d " . __( 'days', 'ix_wemonit' ) . " %02d " . __( 'hours', 'ix_wemonit' ) . " %02d " . __( 'minutes', 'ix_wemonit' ) . " %02d " . __( 'seconds', 'ix_wemonit' ), $age / 60 / 60 / 24, ($age / 60 / 60) % 24, ($age / 60) % 60, $age % 60 );
    }

    private function getStats( $atts, $type, $ip4_6, $percent = '' ) {
	extract( shortcode_atts( array(
		    'id' => '',
			), $atts ) );
	$stats = 'n/a';
	$service = $this->getService( $id );
	if ( $service ) {
	    $key = $type . ucfirst( $percent ) . $ip4_6;
	    $stats = $service[ 'stats' ][ $type . ucfirst( $percent ) . $ip4_6 ];
	}
	return $stats;
    }

    public function getIp4Downtime( $atts ) {
	return $this->getStats( $atts, 'downtime', '4' );
    }

    public function getIp4DowntimePercent( $atts ) {
	return $this->getStats( $atts, 'downtime', '4', 'Percent' );
    }

    public function getIp4UptimePercent( $atts ) {
	return $this->getStats( $atts, 'uptime', '4', 'Percent' );
    }

    public function getIp6Downtime( $atts ) {
	return $this->getStats( $atts, 'downtime', '6' );
    }

    public function getIp6DowntimePercent( $atts ) {
	return $this->getStats( $atts, 'downtime', '6', 'Percent' );
    }

    public function getIp6UptimePercent( $atts ) {
	return $this->getStats( $atts, 'uptime', '6', 'Percent' );
    }

}
