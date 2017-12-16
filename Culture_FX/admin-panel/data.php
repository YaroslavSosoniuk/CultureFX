<?php
	$id_page = $_POST['id'];
	$data = $_POST['data'];
    require_once('../Db_connection.class.php');
    $DB = new Db_connection();
	if($data == 1){
        $DB->db_update('user_page', 'csv_load', '1', 'id_page', $id_page);
	}
	else{
        $DB->db_update('user_page', 'csv_load', '0', 'id_page', $id_page);
	}