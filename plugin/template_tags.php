<?php

if ( !defined( 'ABSPATH' ) )
    die( 'Fail' );

if ( isset( $ix_wemonit ) ):

    function ix_wemonit_getServices() {
	global $ix_wemonit;
	return $ix_wemonit->getServices();
    }

    function ix_wemonit_getService( $id ) {
	global $ix_wemonit;
	return $ix_wemonit->getService( $id );
    }

    function ix_wemonit_getIp4LatencyImage( $id ) {
	global $ix_wemonit;
	return $ix_wemonit->getIp4LatencyImage( array( 'id' => $id ) );
    }

    function ix_wemonit_getIp4UptimeImage( $id ) {
	global $ix_wemonit;
	return $ix_wemonit->getIp4UptimeImage( array( 'id' => $id ) );
    }

    function ix_wemonit_getIp6LatencyImage( $id ) {
	global $ix_wemonit;
	return $ix_wemonit->getIp6LatencyImage( array( 'id' => $id ) );
    }

    function ix_wemonit_getIp6UptimeImage( $id ) {
	global $ix_wemonit;
	return $ix_wemonit->getIp6UptimeImage( array( 'id' => $id ) );
    }

    function ix_wemonit_getAge( $id ) {
	global $ix_wemonit;
	return $ix_wemonit->getAge( array( 'id' => $id ) );
    }
    
    function ix_wemonit_getTimespan($id){
	global $ix_wemonit;
	return $ix_wemonit->getTimespan( array( 'id' => $id ) );	
    }

    function ix_wemonit_getCurrentLatency( $id ) {
	global $ix_wemonit;
	return $ix_wemonit->getCurrentLatency( array( 'id' => $id ) );
    }

    function ix_wemonit_getIp4Downtime( $id ) {
	global $ix_wemonit;
	return $ix_wemonit->getIp4Downtime( array( 'id' => $id ) );
    }

    function ix_wemonit_getIp4DowntimePercent( $id ) {
	global $ix_wemonit;
	return $ix_wemonit->getIp4DowntimePercent( array( 'id' => $id ) );
    }

    function ix_wemonit_getIp4UptimePercent( $id ) {
	global $ix_wemonit;
	return $ix_wemonit->getIp4UptimePercent( array( 'id' => $id ) );
    }

    function ix_wemonit_getIp6Downtime( $id ) {
	global $ix_wemonit;
	return $ix_wemonit->getIp6Downtime( array( 'id' => $id ) );
    }

    function ix_wemonit_getIp6DowntimePercent( $id ) {
	global $ix_wemonit;
	return $ix_wemonit->getIp6DowntimePercent( array( 'id' => $id ) );
    }

    function ix_wemonit_getIp6UptimePercent( $id ) {
	global $ix_wemonit;
	return $ix_wemonit->getIp6UptimePercent( array( 'id' => $id ) );
    }




endif;