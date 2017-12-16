<?php
	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	require_once(dirname(FILE) . '/../../../../wp-load.php');
	require_once('../Db_connection.class.php');
	}
	else{
        require_once('../wp-content/themes/Culture_FX/Db_connection.class.php');
    }
	$user_ID=get_current_user_id();
    $DB = new Db_connection();
	if($user_ID == 1){
	    $q = $DB->db_select('user_page');
		while($result = $q->fetch_assoc()) {
			$pages[] = $result;
			$group_size += $result['group_size'];
			$page_users = $DB->db_select_where('wp_cultures', 'id_page', $result['id_page']);
			$count_users = 0;
			while($cycle_users = $page_users->fetch_assoc()) {
				$count_users++;
			}
			$quantity_users[] = $count_users;

			$count_matched = 0;
            $page_matched = $DB->db_select_where('user_pairs', 'id_page', $result['id_page']);
            while($cycle_matched = $page_matched->fetch_assoc()) {
                $count_matched++;
            }
            $quantity_matched[] = $count_matched;
		}
		?>
		<table>
	<thead>
		<th><button id="create_new_group">Create a new group</button></th>
		<th>Organizer</th>
		<th>
			<p>Total size</p>
			<p class="total_num"><?php echo $group_size; ?></p>
			<p>Approx group size</p>
		</th>
		<th>
			<p>Total # Matched</p>
			<p class="total_num"><?php echo array_sum($quantity_matched); ?></p>
			<p># Matched</p>
		</th>
		<th>
			<p>Total in system</p>
			<p class="total_num"><?php echo array_sum($quantity_users); ?></p>
			<p># in system</p>
		</th>
	</thead>
	<tbody>
		<?php
		$i = 1;
		$qu = 0;
			foreach($pages as $page){
				$page_title = $page['admin_title'];
				$current_user = get_userdata($page['id_user']);	
				$avtor = $current_user->user_firstname . ' ' . $current_user->user_lastname;
				$page_status = get_post_status($page['id_page']);
		?>
		<tr>
			<td><p><?php echo $i . '. ' . $page_title; ?></p><p><span class="edit_admin">Edit </span><input class="id_page_input" type="text" value="<?php echo $page['id_page']; ?>" hidden><input type="checkbox" class="suspend" id="suspend_<?php echo $page['id_page']; ?>" <?php if($page_status == 'private'){ echo 'checked value="1"'; } else{ echo 'value="0"'; } ?> name="suspend"><label for="suspend_<?php echo $page['id_page']; ?>">Suspend </label><input type="checkbox" class="data_csv" id="data_<?php echo $page['id_page']; ?>" <?php if($page['csv_load'] == '1'){ echo 'checked value="1"'; } else{ echo 'value="0"'; } ?> name="data"><label for="data_<?php echo $page['id_page']; ?>">Data</label></p></td>
			<td><a href="<?php echo get_edit_user_link( $page['id_user']); ?>"><?php echo $avtor; ?></a></td>
			<td><?php echo $page['group_size']; ?></td>
			<td><?php echo $quantity_matched[$qu]; ?></td>
			<td><?php echo $quantity_users[$qu]; ?></td>
		</tr>
		<?php
		$i++;
		$qu++;
			}
		?>
	</tbody>
</table>
		
		
		
		
		
		
		
		
		
		
<?php	}
	else{
	$q = $DB->db_select_where('user_page', 'id_user', $user_ID);
	if(empty($q->num_rows)){ ?>
	<table>
	<thead>
		<th>
		<button id="create_new_group" class="<?php if(count($pages) == 5) echo 'new_group'; ?>">Create a new group</button>
		</th>
		</thead>
	</table>
	<?php
	exit;
	}	
	while($result = $q->fetch_assoc()) {
      $pages[] = $result;
      $group_size += $result['group_size'];
      $page_users = $DB->db_select_where('wp_cultures', 'id_page', $result['id_page']);
	  $count_users = 0;
	  while($cycle_users = $page_users->fetch_assoc()) {
		$count_users++;
	  }
	  $quantity_users[] = $count_users;

        $count_matched = 0;
        $page_matched = $DB->db_select_where('user_pairs', 'id_page', $result['id_page']);
        while($cycle_matched = $page_matched->fetch_assoc()) {
            $count_matched++;
        }
        $quantity_matched[] = $count_matched;
	}
?>
<table>
	<thead>
		<th><button id="create_new_group" class="<?php if(count($pages) == 5) echo 'new_group'; ?>">Create a new group</button></th>
		<th>Organizer</th>
		<th>
			<p>Total size</p>
			<p class="total_num"><?php echo $group_size; ?></p>
			<p>Approx group size</p>
		</th>
		<th>
			<p>Total # Matched</p>
			<p class="total_num"><?php echo array_sum($quantity_matched); ?></p>
			<p># Matched</p>
		</th>
		<th>
			<p>Total in system</p>
			<p class="total_num"><?php echo array_sum($quantity_users); ?></p>
			<p># in system</p>
		</th>
	</thead>
	<tbody>
		<?php
		$i = 1;
		$qu = 0;
			foreach($pages as $page){
				$page_title = get_the_title($page['id_page']);
				$current_user = wp_get_current_user();
				$avtor = $current_user->user_firstname . ' ' . $current_user->user_lastname;
		?>
		<tr>
			<td><p><?php echo $i . '. ' . $page_title; ?></p><p><span class="edit_admin">Edit </span><input type="text" value="<?php echo $page['id_page']; ?>" hidden><?php if($page['csv_load'] == 1) echo '<form method="POST" action="/wp-content/themes/Culture_FX/csv_load.php"><input name="id" type="text" value="'.$page['id_page'].'" hidden><button class="data_admin">Data</button></form>'; ?></p></td>
			<td><?php echo $avtor; ?></td>
			<td><?php echo $page['group_size']; ?></td>
			<td><?php echo $quantity_matched[$qu]; ?></td>
			<td><?php echo $quantity_users[$qu]; ?></td>
		</tr>
		<?php
		$i++;
		$qu++;
			}
		?>
	</tbody>
</table>
	<?php } ?>