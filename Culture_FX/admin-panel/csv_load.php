<?php
	require_once(dirname(FILE) . '/../../../../wp-load.php');
	$id_page = $_POST['id'];
	$page_title = get_the_title($id_page);
    require_once('../Db_connection.class.php');
    $DB = new Db_connection();
    $result = $DB->db_select('wp_cultures');
	while($cycle_mails = $result->fetch_assoc()) {
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

