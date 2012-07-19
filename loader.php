<?php

/*
  Plugin Name: IX WeMonit
  Description: Uses the wemonit API to retrieve and display monitoring data, recorded by http://wemonit.de
  Author: Ixiter IT - Peter Liebetrau <ixiter@ixiter.com>
  Version: 1.0
  Plugin-Uri: http://ixiter.com
  Author-Uri: https://plus.google.com/u/0/102408750978338972864/about
 */

if ( !defined( 'ABSPATH' ) )
    die( 'Fail' );

require_once dirname(__FILE__).'/plugin/Ix_Wemonit.php';

$ix_wemonit = new Ix_Wemonit();

require_once dirname(__FILE__).'/plugin/template_tags.php';