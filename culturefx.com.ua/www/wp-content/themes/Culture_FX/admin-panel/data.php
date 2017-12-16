<?php
	$id_page = $_POST['id'];
	$data = $_POST['data'];
	$host = 'shevlyak.mysql.tools';
	$user = 'shevlyak_fxuser';
	$password = 'dsbda9ww';
	$conn = mysql_connect($host, $user, $password);	
	mysql_select_db('shevlyak_fxuser');
	if($data == 1){
		$sql = "UPDATE user_page SET csv_load='1' WHERE id_page='$id_page'";
		$retval = mysql_query( $sql );
	}
	else{
		$sql = "UPDATE user_page SET csv_load='0' WHERE id_page='$id_page'";
		$retval = mysql_query( $sql );
	}
	mysql_close($conn);
?>