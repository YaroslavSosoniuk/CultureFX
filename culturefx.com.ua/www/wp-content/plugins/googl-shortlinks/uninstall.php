<?php
if ( !defined('ABSPATH') && !defined('WP_UNINSTALL_PLUGIN') ) {
    exit();
}
	delete_option( 'cc_googl_oauth_token' );
	delete_option( 'gurl_api_key' );
?>