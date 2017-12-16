<?php
class Db_connection
{
    private $db;

    function __construct() {
        $this->db = new mysqli("shevlyak.mysql.ukraine.com.ua", "shevlyak_fxuser", "dsbda9ww", "shevlyak_fxuser");
    }

    function db_select($table){
        $query = "SELECT * FROM  `".$table."`";
        if($result = $this->db->query($query)) {
            return $result;
        } else {
            return "Error";
        }
    }
    function db_users_pair_check($user_id_1, $user_id_2){
        $query = "SELECT * FROM user_pairs WHERE (user_id_1='".$user_id_1."' AND user_id_2 = '".$user_id_2."') OR (user_id_2='".$user_id_1."' AND user_id_1 = '".$user_id_2."')";
        $result = $this->db->query($query) or die('   Запрос не удался: ' . mysql_error());
        return $result->fetch_array(MYSQLI_NUM);
    }
}
?> 