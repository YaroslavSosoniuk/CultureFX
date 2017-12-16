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
<?php
$num_user = $_POST['num_user'];
require_once('../Db_connection.class.php');
$DB = new Db_connection();
require_once('Send_html.class.php');
$Send_html = new Send_html();
$result = $DB->db_users_pair_check($_POST['user_id'], $_POST['user_pair_id']);
if($num_user == 1) {
    $num_pair_user = 2;
}
else {
    $num_pair_user = 1;
}
if(($result['result_offer1'] == NULL && $result['result_offer2'] == NULL)){
    $DB->db_update('user_pairs', 'result_offer'.$num_user, '1', 'id', $result['id']);
    $user_info = $DB->db_select_where('wp_cultures', 'culture_id', $_POST['user_id']);
    $user_info = $user_info->fetch_assoc();
    $Send_html->response_email($user_info['email'], 'Matching Tool', 'Ok! We are waiting on your match to accept. If they do you can reach out to them immediately. Watch out for an email we’ll be sending soon that contains the next steps in our matching process...');
    echo '
<img class="thank_reg" src="/wp-content/uploads/2017/11/600_435691150.png">
<h1 class="thank_for_reg">You accepted this match</h1>';
}
else if($result['result_offer'.$num_pair_user] == '1'){
    $DB->db_update('user_pairs', 'result_offer'.$num_user, '1', 'id', $result['id']);
    $user_info = $DB->db_select_where('wp_cultures', 'culture_id', $_POST['user_id']);
    $user_info = $user_info->fetch_assoc();
    $user_pair_info = $DB->db_select_where('wp_cultures', 'culture_id', $_POST['user_pair_id']);
    $user_pair_info = $user_pair_info->fetch_assoc();
    $multiple_to_recipients = array($user_info['email'],
        $user_pair_info['email']
        );
    $Send_html->response_email($multiple_to_recipients, 'Matching tool - Your Match is Accepted And Wants You to Contact Them', 'Congrats! Both of you Accepted each other and told us you want to connect. Here is their Contact info again. Now it’s time to reach out! Contact them now. Once you’ve connected, you’ll be sent a survey. Complete our survey and keep getting matches! - Go get um’ - The Culture-FX.com Team');
    sleep(3);
    $Send_html->send_more_contact($_POST['user_id'], $_POST['user_pair_id']);
    $Send_html->send_more_contact($_POST['user_pair_id'], $_POST['user_id']);
    $DB->db_update('user_pairs', 'date', date('Y-m-d'), 'id', $result['id']);
    echo '
<img class="thank_reg" src="/wp-content/uploads/2017/11/600_435691150.png">
<h1 class="thank_for_reg">You accepted this match</h1>';
}
else if($result['result_offer'.$num_user] == '1'){
    echo '
<img class="thank_reg" src="/wp-content/uploads/2017/11/600_435691150.png">
<h1 class="thank_for_reg">Match was accepted</h1>';
}
else if($result['result_offer1'] == '0' || $result['result_offer2'] == '0'){
    echo '
<img class="thank_reg" src="/wp-content/uploads/2017/11/600_435691150.png">
<h1 class="thank_for_reg">Match was passed</h1>';
}
?>

</body>
</html>