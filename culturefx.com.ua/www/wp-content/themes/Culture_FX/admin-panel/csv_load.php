	<?php
$url = explode("?", $_SERVER['HTTP_REFERER']);
require_once(dirname(FILE) . '/../../../../wp-load.php');
$id_page = $_POST['id'];
$page_title = get_the_title($id_page);
	$host = 'shevlyak.mysql.tools';
	$user = 'shevlyak_fxuser';
	$password = 'dsbda9ww';
	$conn = mysql_connect($host, $user, $password);	
	mysql_select_db('shevlyak_fxuser');
	  $page_users = mysql_query('SELECT email FROM wp_cultures WHERE (id_page=\''.$id_page.'\')');
	  while($cycle_mails = mysql_fetch_array ($page_users)) {
		$mails_array[] = $cycle_mails['email'];
	  }
	  $filepath = 'csv_tmp/' . $page_title . '.csv';
	  $fo = fopen ($filepath, 'w');
			if (fputcsv($fo, $mails_array) === false)
			{
				die ("Ошибка при записи в csv-файл");
			}
			
		fclose($fo);
		header ("Content-Type: application/octet-stream");
		header ("Accept-Ranges: bytes");
		header ("Content-Length: ".filesize($filepath));
		header ("Content-Disposition: attachment; filename=".$page_title.".csv");  
		readfile($filepath);
		
?>
