<?php
require_once('../Db_connection.class.php');
$DB = new Db_connection();
$rating = $DB->db_select_where('rating', 'user_id', $_POST['user_id']);
$rating = $rating->fetch_assoc();
if(!empty($rating)) {
    $new_rating = ($rating['rating'] * $rating['count'] + $_POST['rating_value']) / ($rating['count'] + 1)
    $DB->db_update_2('rating', 'rating = "'.$new_rating.'", count = "'.($rating['count']+1).'"', 'user_id = "'.$_POST['user_id'].'"');
}
else{
    $DB->db_insert('rating', '`user_id`, `rating`, `count`', '"' . $_POST['$user_id'] . '", "' . $_POST['rating_value'] . '", "1"');
}
?>
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta http-equiv='X-UA-Compatible' content='ie=edge'>
    <title>Culture</title>
    <link rel='stylesheet' href='/wp-content/themes/Culture_FX/style.css'>
    <link rel='stylesheet' type='text/css' href='/wp-content/themes/Culture_FX/tooltipster-master/dist/css/tooltipster.bundle.min.css' />
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
    <script type='text/javascript' src='http://code.jquery.com/jquery-1.10.0.min.js'></script>
    <script type='text/javascript' src='/wp-content/themes/Culture_FX/tooltipster-master/dist/js/tooltipster.bundle.min.js'></script>
    <!-- <script src='//ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js'></script> -->
    <script type='text/javascript' src='/wp-content/themes/Culture_FX/script.js'></script>
    <script type='text/javascript'>
        $(document).ready(function(){
            $('.tooltip').tooltipster({
                //    animation: 'fade',
                //    delay: 200,
                //    theme: 'tooltipster-punk',
                trigger: 'click'
            });
        });
    </script>
</head>
<body>
<img class="thank_reg" src="/wp-content/uploads/2017/11/600_435691150.png">
<h2>Thanks for your feedback!</h2>
</body>
</html>
