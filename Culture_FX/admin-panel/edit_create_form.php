<?php 
	$id_page = $_POST['id'];
	if(!empty($id_page)){
	require_once(dirname(FILE) . '/../../../../wp-load.php');
    require_once('../Db_connection.class.php');
    $DB = new Db_connection();
	$link = cc_get_googl_short_it($id_page);
	$page_title = get_the_title($id_page);
	$result = $DB->db_select_where('skills', 'id_page', $id_page);
	while($skill_array = $result->fetch_assoc()) {
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
				<td><input type="text" name="skills[]" value=""></td>
			</tr>
		<?php } ?>
		</table>
		<input type="text" name="page-id" value="" hidden>
		<input type="submit" value="Create your reg form">
		</form>
	<?php
	}
	?>