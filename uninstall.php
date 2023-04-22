<?php
// If uninstall is not called from WordPress, exit
if ( !defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    exit();
} 
 
// Drop a custom db table
global $wpdb;
$contacto   = $wpdb->prefix . 'fp_contacformpost';
$fpphpmailer    = $wpdb->prefix . 'fp_phpmailer';
$fpstyleform    = $wpdb->prefix . 'fp_styleform';

$wpdb->query( "DROP TABLE IF EXISTS {$contacto}" );
$wpdb->query( "DROP TABLE IF EXISTS {$fpphpmailer}" );
$wpdb->query( "DROP TABLE IF EXISTS {$fpstyleform}" );

