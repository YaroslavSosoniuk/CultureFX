<?php
	require_once(dirname(FILE) . '/../../../../wp-load.php');
	$id_page = $_POST['id'];
	$suspend = $_POST['suspend'];
	if($suspend == 1){
		$my_posts['ID'] = $id_page;
		$my_posts['post_status']  = 'private';
		$my_posts['post_type'] = 'page';
	}
	else{
		$my_posts['ID'] = $id_page;
		$my_posts['post_status']  = 'publish';
		$my_posts['post_type'] = 'page';
	}
	wp_update_post( $my_posts );
?>