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
$user_id = $_POST['user_id'];
$pair_id = $_POST['pair_id'];
$time_to_reach_out = array( 'Same Day' => '1',
    '2-4 days' => '3',
    '5-7 days' => '6',
    '9 days' => '9',
    '14 days' => '14',
    '30 days' => '30',
    'Do not check in with me.' => '0'
);
$DB = new Db_connection();
$check = $DB->db_select_where('mail_answers', 'id_user` = '.$_POST['user_id'].' AND `id_pair', $pair_id);
$check = $check->fetch_assoc();
$attempt = '0';
if($check['meet'] == '1'){
    echo '<h1 class="thank_for_reg">Match was closed.</h1>';
    $attempt = '1';
}
else if(strtotime($current_date) < (strtotime($check['date']) + 86400 * $time_to_reach_out[$check['remind']])){
    echo '<h1 class="thank_for_reg">Match  was already postponed.</h1>';
    $attempt = '1';
}
if($attempt == '0') {
    require_once('Send_html.class.php');
    $Send_html = new Send_html();
    if (!empty($check)) {
        if ($_POST['meet'] == '1') {
            $DB->db_update_2('mail_answers', 'meet = "1", date = "' . $current_date . '"', 'id_user = "' . $user_id . '" AND id_pair = "' . $pair_id . '"');
            echo '<h1 class="thank_for_reg">Watch out for an email we’ll be sending soon...</h1>';
            $Send_html->after_match_questions($user_id, $pair_id);
        } else if ($_POST['meet'] == '0') {
            $DB->db_update_2('mail_answers', 'meet = "0", date = "' . $current_date . '", remind = "' . $_POST['continiou_some_days'] . '"', 'id_user = "' . $user_id . '" AND id_pair = "' . $pair_id . '"');
            echo '<h1 class="thank_for_reg">Ok, we’ll write to you later.</h1>';
        }
    } else {
        if ($_POST['meet'] == '1') {
            $DB->db_insert('mail_answers', '`id_user`, `id_pair`, `date`, `meet`', '"' . $user_id . '", "' . $pair_id . '", "' . $current_date . '", "1"');
            echo '<h1 class="thank_for_reg">Watch out for an email we’ll be sending soon...</h1>';
            $Send_html->after_match_questions($user_id, $pair_id);
        } else if ($_POST['meet'] == '0') {
            $DB->db_insert('mail_answers', '`id_user`, `id_pair`, `date`, `remind`, `meet`', '"' . $user_id . '", "' . $pair_id . '", "' . $current_date . '", "' . $_POST['continiou_some_days'] . '", "0"');
            echo '<h1 class="thank_for_reg">Ok, we’ll write to you later.</h1>';
        }
    }
}
?>
</body>
</html>
