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
<?php
$current_date = date("Y-m-d");
require_once('../Db_connection.class.php');
$DB = new Db_connection();
$check = $DB->db_select_where('user_pause', 'id_user', $_POST['user_id']);
$check = $check->fetch_assoc();
$attempt = '0';
if($check['off'] == '1'){
    echo '<h1 class="thank_for_reg">Receiving matches was stoped.</h1>';
    $attempt = '1';
}
else if($check['pause'] == '1'){
    echo '<h1 class="thank_for_reg">Receiving matches was paused.</h1>';
    $attempt = '1';
}
if($attempt == '0') {
    if (!empty($check)) {
        if ($_POST['selected'] == 'off') {
            $DB->db_update('user_pause', 'off', '1', 'id_user', $_POST['user_id']);
            echo '<h1 class="thank_for_reg">You stoped receiving matches.</h1>';
        } else if ($_POST['selected'] == 'pause') {
            $DB->db_update_2('user_pause', 'pause = "1", date_pause = "'.$current_date.'"', 'id_user = "'.$_POST['user_id'].'"');
            echo '<h1 class="thank_for_reg">You paused receiving matches.</h1>';
        }
    } else {
        if ($_POST['selected'] == 'off') {
            $DB->db_insert('`user_pause`', '`id_user`, `off`', '"' . $_POST['user_id'] . '", "1"');
            echo '<h1 class="thank_for_reg">You stoped receiving matches.</h1>';
        } else if ($_POST['selected'] == 'pause') {
            $DB->db_insert('`user_pause`', '`id_user`, `pause`, `date_pause`', '"' . $_POST['user_id'] . '", "1", "' . $current_date . '"');
            echo '<h1 class="thank_for_reg">You paused receiving matches.</h1>';
        }
    }
}
?>
</body>
</html>
