<?php
class Compare_for_mail{
    function compare_more_contact($user_id, $user_id_2){
        require_once('../Db_connection.class.php');
        $DB = new Db_connection();
        $user_info = $DB->db_select_where('wp_cultures', 'culture_id', $user_id);
        $user_info = $user_info->fetch_assoc();
        $user_pair_info = $DB->db_select_where('wp_cultures', 'culture_id', $user_id_2);
        $user_pair_info = $user_pair_info->fetch_assoc();
        $array_want = array($user_info['w_value1'], $user_info['w_value2'], $user_info['w_value3']);
        $array_want_2 = array($user_pair_info['w_value1'], $user_pair_info['w_value2'], $user_pair_info['w_value3']);
        $array_have_2 = array($user_pair_info['h_value1'], $user_pair_info['h_value2'], $user_pair_info['h_value3']);
        $user_similarities = array_intersect($array_want, $array_have_2);
        $similar_procent = array('0', '33', '66', '100');
        $full_name = $user_pair_info['first_name'] . ' ' . $user_pair_info['last_name'];
        $rating_user = $DB->db_select_where('rating', 'user_id', $user_id_2);
        $rating_user = $rating_user->fetch_assoc();
        if($rating_user['count'] < 10){
            $rating = '0';
        }
        else{
            $rating = $rating_user['rating'];
        }
        $info_to_send = array( 'procent' => $similar_procent[count($user_similarities)],
            'user_similarities' => $user_similarities,
            'array_want' => $array_want,
            'array_want_2' => $array_want_2,
            'linkedin' => $user_pair_info['linkedin_profile'],
            'full_name' => $full_name,
            'email' => $user_pair_info['email'],
            'email_send' => $user_info['email'],
            'rating' => $rating
        );
        return $info_to_send;
    }

}