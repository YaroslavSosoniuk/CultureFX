<?php
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$tmp_name = $_FILES["image"]["tmp_name"];
    	$name     = basename($_FILES["image"]["name"]);
		$link1 = 'images/'.$name;
    	move_uploaded_file($tmp_name, $link1);
		$link2 = 'images/opt_'.$name;
		function optimize($old_img_url, $new_img_url, $qual) {

			$img_info = getimagesize($old_img_url);

			if ($img_info['mime'] == 'image/jpeg')
				$image = imagecreatefromjpeg($old_img_url);

			elseif ($img_info['mime'] == 'image/gif')
				$image = imagecreatefromgif($old_img_url);

			elseif ($img_info['mime'] == 'image/png')
				$image = imagecreatefrompng($old_img_url);

			imagejpeg($image, $new_img_url, $qual);
			return $new_img_url;
		}
	}
?>
<form action="test_create.php" method="POST" enctype="multipart/form-data">	
    <label>Картинка: </label><input type="file" accept=".xlsx,.xls,image/*,.doc, .docx,.ppt, .pptx,.txt,.pdf" name="image">
    <input type="submit" value="Test" class="credit_status">
</form>
<?php
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		echo optimize($link1, $link2, 50);
	}
?>
