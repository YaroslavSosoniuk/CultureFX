<?php
$current_date = date("Y-m-d");
$str_current_date = strtotime($current_date);
require_once('../Db_connection.class.php');
$DB = new Db_connection();
require_once('Send_html.class.php');
$Send_html = new Send_html();
$result = $DB->db_select('user_pairs');
$check = 0;
while($pair = $result->fetch_assoc()){
    $strdate_now = strtotime($pair['date']);
    for($i = 1; $i < 3; $i++) {
        $user_info = $DB->db_select_where('wp_cultures', 'culture_id', $pair['user_id_' . $i]);
        $user_info = $user_info->fetch_assoc();
        if($i==1) {
            $user_id_2 = $pair['user_id_2'];
        }
        else{
            $user_id_2 = $pair['user_id_1'];
        }
        $user_2_info = $DB->db_select_where('wp_cultures', 'culture_id', $user_id_2);
        $user_2_info = $user_2_info->fetch_assoc();
        $full_name = $user_2_info['first_name'] . ' ' . $user_2_info['last_name'];
        $time_to_reach_out = array( 'Same Day' => '1',
            '2-3 Days' => '2',
            'That week' => '4',
            'Within 2 weeks' => '10',
            'Within 1 month' => '20',
            'Within 2 months' => '45',
            'Varies Wildly, I have a very busy schedule' => '0'
        );
        if($time_to_reach_out[$user_info['time_to_reach_out']] != '0' && $pair['result_offer1'] == '1' && $pair['result_offer2'] == '1'){
            if($str_current_date == ($strdate_now + $time_to_reach_out[$user_info['time_to_reach_out']] * 86400)){
                $Send_html->check_match_connection($full_name, $user_2_info['email'], $user_2_info['linkedin_profile'], $user_info['email'], $pair['user_id_' . $i], $pair['id'], $check);
                $check++;
                echo '1';
            }
        }

    }
}
$Send_html = new Send_html();
$result = $DB->db_select('mail_answers');
while($remind = $result->fetch_assoc()){
    $strdate_now = strtotime($remind['date']);
    $user_info = $DB->db_select_where('wp_cultures', 'culture_id', $remind['id_user']);
    $user_info = $user_info->fetch_assoc();

    $user_pair = $DB->db_select_where('user_pairs', 'id', $remind['id_pair']);
    $user_pair = $user_pair->fetch_assoc();

    if($user_pair['user_id_1'] == $remind['id_user']) $user_id_2 = $user_pair['user_id_2'];
    else $user_id_2 = $user_pair['user_id_1'];

    $user_2_info = $DB->db_select_where('wp_cultures', 'culture_id', $user_id_2);
    $user_2_info = $user_2_info->fetch_assoc();
    $full_name = $user_2_info['first_name'] . ' ' . $user_2_info['last_name'];
    $time_to_reach_out = array( 'Same Day' => '1',
        '2-4 days' => '3',
        '5-7 days' => '6',
        '9 days' => '9',
        '14 days' => '14',
        '30 days' => '30',
        'Do not check in with me.' => '0'
    );
    if($time_to_reach_out[$remind['remind']] != '0' && $remind['meet'] != '1'){
        if($str_current_date == ($strdate_now + $time_to_reach_out[$remind['remind']] * 86400)){
            $Send_html->check_match_connection($full_name, $user_2_info['email'], $user_2_info['linkedin_profile'], $user_info['email'], $remind['id_user'], $remind['id_pair'], $check);
            $check++;
            echo '1';
        }
    }
}