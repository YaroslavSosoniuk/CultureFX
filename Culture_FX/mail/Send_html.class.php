<?php
class Send_html
{
    function send_letter($pairs_ready)
    {
        require_once(dirname(FILE) . '/../../../wp-load.php');
        add_filter('wp_mail_content_type', create_function('', 'return "text/html";'));

        add_filter( 'wp_mail_from', 'vortal_wp_mail_from' );
        function vortal_wp_mail_from( $email_address ){
            return 'info@culture-fx.com';
        }
        add_filter( 'wp_mail_from_name', 'vortal_wp_mail_from_name' );
        function vortal_wp_mail_from_name( $email_from ){
            return 'Culture FX';
        }
        $headers = 'Culture FX <info@culture-fx.com>' . "\r\n";

        require_once('Db_connection.class.php');
        $DB = new Db_connection();
        foreach ($pairs_ready as $current_group => $pairs_in_group) {
            foreach ($pairs_in_group as $pair_to_send) {
                for ($i = 1; $i < 3; $i++) {
                    $user_id = $pair_to_send['user_id_' . $i];
                    if($i==1) {
                        $user_id_2 = $pair_to_send['user_id_2'];
                    }
                    else{
                        $user_id_2 = $pair_to_send['user_id_1'];
                    }
                    $result = $DB->db_select_where('wp_cultures', 'culture_id', $user_id);
                    $result2 = $DB->db_select_where('wp_cultures', 'culture_id', $user_id_2);
                    $result = $result->fetch_assoc();
                    $result2 = $result2->fetch_assoc();
                    $email = $result['email'];
                    $procent = $pair_to_send['user' . $i . '_procent'];
                    $user_similarities = $pair_to_send['user' . $i . '_similarities'];
                    $array_want = array($result['w_value1'], $result['w_value2'], $result['w_value3']);
                    $array_want_2 = array($result2['w_value1'], $result2['w_value2'], $result2['w_value3']);
                    $linkedin = $result2['linkedin_profile'];
                    $full_name = $result2['first_name'] . ' ' . $result2['last_name'];
                    $multiple_to_recipients = array(
                        'yaryk.y.s.v@gmail.com',
                        'shevlyakov.dmitriy@gmail.com',
                        $email
                    );
                    $rating_user = $DB->db_select_where('rating', 'user_id', $user_id_2);
                    $rating_user = $rating_user->fetch_assoc();
                    if($rating_user['count'] < 10){
                        $rating = '0';
                    }
                    else{
                        $rating = $rating_user['rating'];
                    }
                    require_once('mail/View_mail.class.php');
                    $View_mail = new View_mail();
                    $message = $View_mail->mail_template($procent, $user_similarities, $array_want, $array_want_2, $linkedin, $full_name, '0', $user_id, $user_id_2, $i, $rating);
                    wp_mail($multiple_to_recipients, 'You Have A Match! - From Matching Tool', $message, $headers);
                }

                $DB->db_insert('`user_pairs`', '`id_page`, `user_id_1`, `user_id_2`, `date`', '"' . $current_group . '", "' . $pair_to_send["user_id_1"] . '", "' . $pair_to_send["user_id_2"] . '", "' . date("Y-m-d")  . '"');
                break 2;

            }
        }
    }
    function response_email($multiple_to_recipients, $subject, $message){
        require_once(dirname(FILE) . '/../../../../wp-load.php');

        add_filter('wp_mail_content_type', create_function('', 'return "text/html";'));

        add_filter( 'wp_mail_from', 'vortal_wp_mail_from' );
        function vortal_wp_mail_from( $email_address ){
            return 'info@culture-fx.com';
        }
        add_filter( 'wp_mail_from_name', 'vortal_wp_mail_from_name' );
        function vortal_wp_mail_from_name( $email_from ){
            return 'Culture FX';
        }
        $headers = 'Culture FX <info@culture-fx.com>' . "\r\n";

        require_once('View_mail.class.php');
        $View_mail = new View_mail();
        $message = $View_mail->small_mail_template($message);


        wp_mail($multiple_to_recipients, $subject, $message, $headers);
    }
    function send_more_contact($user_id, $user_id_2){
        require_once(dirname(FILE) . '/../../../../wp-load.php');

        add_filter('wp_mail_content_type', create_function('', 'return "text/html";'));

        $headers = 'Culture FX <info@culture-fx.com>' . "\r\n";

        require_once('Compare_for_mail.class.php');
        $Compare_for_mail = new Compare_for_mail();
        $info_to_send = $Compare_for_mail->compare_more_contact($user_id, $user_id_2);

        require_once('View_mail.class.php');
        $View_mail = new View_mail();
        $message = $View_mail->mail_template($info_to_send['procent'], $info_to_send['user_similarities'], $info_to_send['array_want'], $info_to_send['array_want_2'], $info_to_send['linkedin'], $info_to_send['full_name'], $info_to_send['email'], $user_id, $user_id_2, '0', $info_to_send['rating']);
        wp_mail($info_to_send['email_send'], 'You Have A Match! - From Matching Tool', $message, $headers);
    }
    function check_match_connection($full_name, $info_email, $linkedin, $email, $user_id, $pair_id, $check)
    {
        require_once(dirname(FILE) . '/../../../../wp-load.php');

        add_filter('wp_mail_content_type', create_function('', 'return "text/html";'));
        if ($check == 0) {

            add_filter('wp_mail_from', 'vortal_wp_mail_from');
            function vortal_wp_mail_from($email_address)
            {
                return 'info@culture-fx.com';
            }

            add_filter('wp_mail_from_name', 'vortal_wp_mail_from_name');
            function vortal_wp_mail_from_name($email_from)
            {
                return 'Culture FX';
            }
        }
        $headers = 'Culture FX <info@culture-fx.com>' . "\r\n";

        require_once('View_mail.class.php');
        $View_mail = new View_mail();
        $message = $View_mail->check_match_mail($full_name, $info_email, $linkedin, $user_id, $pair_id);
        wp_mail($email, 'Matching Tool - Have you connected with your match?', $message, $headers);
    }
    function after_match_questions($user_id, $pair_id){
        require_once(dirname(FILE) . '/../../../../wp-load.php');

        add_filter('wp_mail_content_type', create_function('', 'return "text/html";'));

        add_filter('wp_mail_from', 'vortal_wp_mail_from');
        function vortal_wp_mail_from($email_address)
        {
            return 'info@culture-fx.com';
        }

        add_filter('wp_mail_from_name', 'vortal_wp_mail_from_name');
        function vortal_wp_mail_from_name($email_from)
        {
            return 'Culture FX';
        }

        $headers = 'Culture FX <info@culture-fx.com>' . "\r\n";

        require_once('../Db_connection.class.php');
        $DB = new Db_connection();
        $user_info = $DB->db_select_where('wp_cultures', 'culture_id', $user_id);
        $user_info = $user_info->fetch_assoc();
        $user_name = $user_info['first_name'] . ' ' . $user_info['last_name'][0];

        $user_pair = $DB->db_select_where('user_pairs', 'id', $pair_id);
        $user_pair = $user_pair->fetch_assoc();
        if($user_pair['user_id_1'] == $user_id) $user_id_2 = $user_pair['user_id_2'];
        else $user_id_2 = $user_pair['user_id_1'];

        $user_info_2 = $DB->db_select_where('wp_cultures', 'culture_id', $user_id_2);
        $user_info_2 = $user_info_2->fetch_assoc();
        $user_name_2 = $user_info_2['first_name'] . ' ' . $user_info_2['last_name'][0];

        require_once('View_mail.class.php');
        $View_mail = new View_mail();
        $message = $View_mail->survey_letter($user_id, $pair_id, $user_name, $user_id_2, $user_name_2);
        wp_mail($user_info['email'], 'Matching Tool - You had a meeting! Tell us about it.', $message, $headers);
    }
}