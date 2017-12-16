<?php
$url = explode("?", $_SERVER['HTTP_REFERER']);
require_once(dirname(FILE) . '/../../../../wp-load.php');
 // Создаём объект записи
$page_id = $_POST['page-id'];
$page_name = $_POST['page-name'];
$user_ID=get_current_user_id();
$host = 'shevlyak.mysql.tools';
	$user = 'shevlyak_fxuser';
	$password = 'dsbda9ww';
	$conn = mysql_connect($host, $user, $password);	
	mysql_select_db('shevlyak_fxuser');
	$query = 'SELECT * FROM user_page WHERE (id_page=\''.$page_id.'\')';
	$q = mysql_query($query);
	$result = mysql_fetch_array ($q);
	$owner_page = $result['id_user'];
	mysql_close($conn);
	
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
		$host = 'shevlyak.mysql.tools';
	$user = 'shevlyak_fxuser';
	$password = 'dsbda9ww';
	$conn = mysql_connect($host, $user, $password);	
	mysql_select_db('shevlyak_fxuser');
	  $sql = "INSERT INTO user_page ".
				"(id_user, id_page, group_size, admin_title) ".
				"VALUES ('$user_ID', '$page_id', '$group_size', '$page_name') ";	
	  $retval = mysql_query( $sql );
	  
	  
	  $skills = $_POST['skills'];
	  $skills = array_reverse($skills);
	  foreach($skills as $skill){
		  if(!empty($skill)){
		  $sql = "INSERT INTO skills ".
				"(id_page, skill_meta) ".
				"VALUES ('$page_id', '$skill') ";
		  $retval = mysql_query( $sql );
		  }
	  }
			mysql_close($conn);  
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
	if($user_ID == $owner_page){
		  $my_post = array(
		 'ID' => $page_id,
		 'post_title' => $_POST['page-name']
	  );
	  wp_update_post( $my_post );
	  if($user_ID == '1'){
		$host = 'shevlyak.mysql.tools';
		$user = 'shevlyak_fxuser';
		$password = 'dsbda9ww';
		$conn = mysql_connect($host, $user, $password);	
		mysql_select_db('shevlyak_fxuser');
		$sql = "UPDATE user_page SET admin_title='$page_name' WHERE id_page='$page_id'";
		$retval = mysql_query( $sql );
		mysql_close($conn);
	  }
	}
	else{
		$host = 'shevlyak.mysql.tools';
		$user = 'shevlyak_fxuser';
		$password = 'dsbda9ww';
		$conn = mysql_connect($host, $user, $password);	
		mysql_select_db('shevlyak_fxuser');
		$sql = "UPDATE user_page SET admin_title='$page_name' WHERE id_page='$page_id'";
		$retval = mysql_query( $sql );
		mysql_close($conn);
	}
	  
	  $host = 'shevlyak.mysql.tools';
	$user = 'shevlyak_fxuser';
	$password = 'dsbda9ww';
	$conn = mysql_connect($host, $user, $password);	
	mysql_select_db('shevlyak_fxuser');
	
	
	  $sql = " DELETE FROM skills WHERE id_page='".$page_id."'; ";
	  $retval = mysql_query( $sql );
	  
	  
	  
	$skills = $_POST['skills'];
	  $skills = array_reverse($skills);
	  foreach($skills as $skill){
		  if(!empty($skill)){
		  $sql = "INSERT INTO skills ".
				"(id_page, skill_meta) ".
				"VALUES ('$page_id', '$skill') ";
		  $retval = mysql_query( $sql );
		  }
	  }
			mysql_close($conn);  
		$feedback = "<h3 class='feedback'>Update successful!</h3>";
}
update_user_meta( $user_ID, 'feedback', $feedback );
header('Location: /wp-admin/admin.php?page=reg-form');
  ?>