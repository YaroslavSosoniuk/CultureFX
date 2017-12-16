<?php
/*
Plugin Name: Goo.gl Shortlinks
Plugin URI: http://christophercochran.me/googl-shortlinks
Description: Allows automatic url shortening of post links using goo.gl Services using the API recently provided by Google. Changes the output of the_shortlink(); to a goo.gl short URL.
Author: Christopher Cochran
Version: 1.1.2
Author URI: http://christophercochran.me
*/
add_action('admin_menu', 'cc_googl_short_it_settings');
function cc_googl_short_it_settings() {
   add_submenu_page('options-general.php', 'Goo.gl Shortlinks', 'Goo.gl Shortlinks', 'manage_options', 'gslsettings', 'cc_googl_short_it_settings_p');
}

add_action('admin_init', 'cc_googl_short_it_settings_init' );
function cc_googl_short_it_settings_init(){
	register_setting( 'cc_googl_short_it_options', 'gurl_api_key', 'cc_googl_short_it_options_validate' );
}

function cc_googl_short_it_options_validate($input) {
	$input['key_txt'] =  wp_filter_nohtml_kses($input['key_txt']);
	return $input;
}


function cc_googl_short_it_settings_p() {  
$google_auth_url = 'https://www.google.com/accounts/AuthSubRequest';
$google_session_url = 'https://www.google.com/accounts/AuthSubSessionToken';
$googl_scope_url = 'https://www.googleapis.com/auth/urlshortener';
$googl_api_url = 'https://www.googleapis.com/urlshortener/v1/url';

$cc_googl_oauth_token = get_option( 'cc_googl_oauth_token' );
	
if (!$cc_googl_oauth_token) {

	if ( isset( $_GET[ 'token' ] ) ) {
	
		$the_token = $_GET[ 'token' ];
		$body = '';
		$options = array('method' => 'GET', 'body' => $body);
				$options['headers'] = array(
				'Content-Type' => 'application/json',
				'Authorization' => 'AuthSub token="' . $the_token . '"' 
				);

		$result = wp_remote_retrieve_body(wp_remote_request( $google_session_url, $options ));

		$matches = array();
		preg_match( '/Token=(.+)/', $result, $matches );
		if ( count( $matches ) > 1 ) {
			$cc_googl_oauth_token = $matches[ 1 ];
			update_option( 'cc_googl_oauth_token', $cc_googl_oauth_token );
		}
		
	} else {
	
		$build_query_str = http_build_query( array(
			'next' => admin_url('options-general.php?page=gslsettings'),
			'scope' => $googl_scope_url,
			'session' => 1
		));
		$query_str = $build_query_str;
		$google_auth_url = $google_auth_url . '?' . $query_str;
	}
}
?>

<div class="wrap">
<h2><?php _e( 'Goo.gl Shortlinks Settings', 'cc_gsl' ); ?></h2>
<div class="metabox-holder has-right-sidebar" id="poststuff">
	<div class="inner-sidebar" id="side-info-column">
		<?php if (!$cc_googl_oauth_token) { ?>
		<div class="postbox">
		<h3>Authenticate?</h3>
		<div class="inside">
		<p class="description">Use the button below to authenticate your account with your site. Your short URL will be unique, and it will show up in your dashboard at <a href="http://goo.gl">goo.gl</a>.</p>
		<center><input type="button" value="Authenticate" class="button-primary" onclick="window.location = '<?php echo $google_auth_url; ?>';"/></center>
		</div>
		</div>
		<?php } ?>
	</div>
	<div id="post-body">
	<div id="post-body-content" style="margin-right: 315px;">

<?php if (!$cc_googl_oauth_token) { ?>
		<?php } else {
			$options = array('method' => 'GET', 'body' => $body);
				$options['headers'] = array(
				'Content-Type' => 'application/json',
				'Authorization' => 'AuthSub token="' . $cc_googl_oauth_token . '"' 
				);

		$result = wp_remote_retrieve_body(wp_remote_request( 'https://www.googleapis.com/urlshortener/v1/url/history', $options ));
		$user_hist = json_decode( $result );
		$user_hist = $user_hist->items;
		$i = 1;
		

		echo '<table class="widefat">
				<thead><tr class="column-title">
					<th style="width:150px" class="first">Short URL</th>
					<th style="">Long URL</th>
					<th style="width:75px">Created</th>
				</tr></thead>';
		
		foreach ($user_hist as $user_hist_item) {
			if ( $i % 2) { $alt = 'alternate'; } else{ $alt = ''; } 
				echo '<tr class="'.$alt.'"><td>';
				echo $user_hist_item->id;
				echo '</td><td>';
				echo $user_hist_item->longUrl;
				echo '</td><td>';
				echo human_time_diff( strtotime($user_hist_item->created) ) . ' ago'; 
				echo '</td></tr>';
			if (++$i == 10) break;
		}
		echo '</table>';
		 } ?>
		 <p>
		 <form method="post" action="options.php">
		 
			<?php settings_fields('cc_googl_short_it_options'); ?>
			<?php $settings = get_option('gurl_api_key'); ?>
	
			<lable>API Key: </lable><input type="text" size="50" name="gurl_api_key[key_txt]" value="<?php echo $settings['key_txt']; ?>" />
			<p class="description">Enter your <a href="https://code.google.com/apis/console/">Google API Key</a> above for the URL Shortener API. </p>
			<p class="description">*NOTE: Make sure to use only the characters after 'key='</p>
			<h4>Why you should get a key?</h4>
			<p class="description">Higher usage limits. Without an API key, we don’t know who you are, and we’re pretty shy. You’ll be subject to anonymous usage limits, and those are very, very low. Your requests will fail when you exceed your limits. With an API key, you’ll have very high usage limits — high enough to accommodate most applications’ needs.
			Traffic reports. With an API key, you also get access to fun graphs of your API usage on the APIs Console.
			</p>
			<p class="submit">
				<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
			</p>
		</form>
		</p>
	</div>
	</div>
</div>
<?php }


function cc_googl_get_data($args = array(), $api_key = '' ) {
	if ( !class_exists("Services_JSON")) {
		require_once(ABSPATH . '/wp-includes/class-json.php');
	}
	$wp_json = new Services_JSON();
	$options = get_option('gurl_api_key');
	$googl_api_url = 'https://www.googleapis.com/urlshortener/v1/url';
	$shortlink = '';
	if ( $api_key )
		$googl_api_url .= '?key='. $api_key;
	$body = $wp_json->encodeUnsafe($args);
	$options = array('method' => 'POST', 'body' => $body);
			if ( get_option( 'cc_googl_oauth_token' ) ) {
			$options['headers'] = array(
					'Content-Type' => 'application/json',
					'Authorization' => 'AuthSub token="' . get_option( 'cc_googl_oauth_token' ) . '"' 
			);
			} else {
			$options['headers'] = array(
					'Content-Type' => 'application/json',
			);
			}
	$result = wp_remote_retrieve_body(wp_remote_request( $googl_api_url, $options ));
	if ( $result ) {
		$googdata = json_decode( $result );
		$shortlink = $googdata->id;
	}
	return $shortlink; 
} //end cc_googl_get_data

add_filter('get_shortlink','cc_get_googl_short_it');
function cc_get_googl_short_it($id) {	
	$settings = get_option('gurl_api_key'); 
	$shortlink = '';
	$post = get_post($id);
	$post_id = $post->ID;
	
	$args = array(
		'longUrl' => get_permalink( $post_id )
	);
	
	//Retrieve cached short URL
	$shortlink = get_post_meta( $post->ID, '_google_short_url', true );
	if ( $shortlink ) 
		return $shortlink;
}
add_action('publish_post', 'cc_googl_post_save');
add_action('publish_page', 'cc_googl_post_save');
function cc_googl_post_save( $post_id ) {
	global $post;
		//Retrieve the post object - If a revision, get the original post ID
		$revision = wp_is_post_revision( $post_id );
		if ( $revision )	
			$post_id = $revision;
		$post = get_post( $post_id );
		$post_id = $post->ID;
		$args = array(
			'longUrl' => get_permalink( $post_id )
			);
		$settings = get_option('gurl_api_key');
		$goog_url = cc_googl_get_data($args, $settings['key_txt']);
		update_post_meta( $post_id, '_google_short_url', $goog_url );

} //end post_save