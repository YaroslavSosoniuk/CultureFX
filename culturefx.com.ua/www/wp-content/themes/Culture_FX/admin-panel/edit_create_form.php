<?php 
	$id_page = $_POST['id'];
	if(!empty($id_page)){
	$url = explode("?", $_SERVER['HTTP_REFERER']);
	require_once(dirname(FILE) . '/../../../../wp-load.php');
	
	$host = 'shevlyak.mysql.tools';
	$user = 'shevlyak_fxuser';
	$password = 'dsbda9ww';
	$conn = mysql_connect($host, $user, $password);	
	mysql_select_db('shevlyak_fxuser');
	
	$link = cc_get_googl_short_it($id_page);
	$page_title = get_the_title($id_page);

	$skills_sql = 'SELECT skill_meta FROM skills WHERE (id_page=\''.$id_page.'\')';
	$skill_query = mysql_query($skills_sql);
	while($skill_array = mysql_fetch_array ($skill_query)) {
      $skills[] = $skill_array['skill_meta'];
	}
	?>
<form method="POST" action="/wp-content/themes/Culture_FX/admin-panel/create-page.php">
		<label>Group name</label>
		<input type="text" name="page-name" value="<?php echo $page_title; ?>">
		<p>Your own link: <?php echo '<a href="' . $link . '">' . $link . '</a></p>'; ?>
		<table>
		<thead>
			<th>Skills</th>
		</thead>
		<?php for($i=0; $i<45; $i++){ ?>
			<tr>
				<td><input type="text" name="skills[]" value="<?php echo $skills[$i]; ?>"></td>
			</tr>
		<?php } ?>
		</table>
		<input type="text" name="page-id" value="<?php echo $id_page; ?>" hidden>
		<input type="submit" value="Update your reg form">
		</form>
	<?php } 
	else{
	?>
	<form method="POST" action="/wp-content/themes/Culture_FX/admin-panel/create-page.php">
		<label>Enter group name ( You can change this later )</label>
		<input type="text" name="page-name" value="">
		<label>Please enter an approximate number of total members you have in this group ( For example, 1,000 )</label>
		<input type="text" name="group-size" value="">
		<table>
		<thead>
			<th>Skills</th>
		</thead>
		<?php for($i=0; $i<45; $i++){ ?>
			<tr>
				<td><input type="text" name="skills[]" value="<?php echo $skills[$i]; ?>"></td>
			</tr>
		<?php } ?>
		</table>
		<input type="text" name="page-id" value="" hidden>
		<input type="submit" value="Create your reg form">
		</form>
	<?php
	}
	?>