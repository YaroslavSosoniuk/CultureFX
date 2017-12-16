<?php
$url = explode("?", $_SERVER['HTTP_REFERER']);
require_once(dirname(FILE) . '/../../../../wp-load.php');
 // Создаём объект записи
$page_id = $_POST['page-id'];
$page_name = $_POST['page-name'];
$user_ID=get_current_user_id();
require_once('../Db_connection.class.php');
$DB = new Db_connection();
	
// Create new page
if(empty($page_id)){
	  $my_post = array(
		 'post_title' => $_POST['page-name'],
		 'post_content' => ' ',
		 'post_type' => 'page',
		 'post_status' => 'publish',
		 'post_author' => $user_ID,
		 'post_category' => array(8,39)
	  );
	// Вставляем запись в базу данных
		wp_insert_post( $my_post );

		$page = get_page_by_title( $_POST['page-name'] );
		$page_id = $page->ID;
		$group_size = $_POST['group-size'];
    $DB->db_insert('user_page', 'id_user, id_page, group_size, admin_title', "'".$user_ID."', '".$page_id."', '".$group_size."', '".$page_name."'");


	  $skills = $_POST['skills'];
	  $skills = array_reverse($skills);
	  foreach($skills as $skill){
		  if(!empty($skill)){
              $DB->db_insert('skills', 'id_page, skill_meta', "'".$page_id."', '".$skill."'");
		  }
	  }
$file = '../template_page.php';
$newfile = '../page-'.$page_id.'.php';
copy($file, $newfile);
$feedback = "<p>‘Success!’ Your new group has been created. </p>
<p>Your Group’s Name is : " . $_POST['page-name'] . ".</p>
<p>Your Unique Matching URL for this group is : <a href='" . cc_get_googl_short_it($page_id) . "'>" . cc_get_googl_short_it($page_id) . "</a></p>

<p>If you ever forget your group’s matching tool URL, log back in at culture-fx.com/matching-tool/, select your group, and you’ll see your URL.</p>
<p>Next steps are, we suggest you create an exciting post explaining how this tool works to your members, explaining the benefits to them by participating. </p>

<p>Make a post along with including this custom link and watch members sign up. Periodically post this link again in your group to remind all your members to signup for this tool so that their matches are the highest quality. Happy Posting! - The Culture-FX.com Team</p>
";
}
//Update page
else{
    $result = $DB->db_select_where('user_page', 'id_page', $page_id);
    $result = $result->fetch_assoc();
    $owner_page = $result['id_user'];
	if($user_ID == $owner_page){
		  $my_post = array(
		 'ID' => $page_id,
		 'post_title' => $_POST['page-name']
	  );
	  wp_update_post( $my_post );
	  if($user_ID == '1'){
          $DB->db_update('user_page', 'admin_title', $page_name, 'id_page', $page_id);
	  }
	}
	else{
        $DB->db_update('user_page', 'admin_title', $page_name, 'id_page', $page_id);
	}


    $DB->db_delete('skills', 'id_page', $page_id);


	$skills = $_POST['skills'];
	  $skills = array_reverse($skills);
	  foreach($skills as $skill){
		  if(!empty($skill)){
              $DB->db_insert('skills', 'id_page, skill_meta', "'".$page_id."', '".$skill."'");
		  }
	  }
		$feedback = "<h3 class='feedback'>Update successful!</h3>";
}
update_user_meta( $user_ID, 'feedback', $feedback );
header('Location: /wp-admin/admin.php?page=reg-form');
