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
    function db_select_where($table, $column, $description){
        $query = "SELECT * FROM  `".$table."` WHERE `".$column."` = ".$description;
        if($result = $this->db->query($query)) {
            return $result;
        } else {
            return "Error";
        }
    }
    function db_users_pair_check($user_id_1, $user_id_2){
        $query = "SELECT * FROM user_pairs WHERE (user_id_1='".$user_id_1."' AND user_id_2 = '".$user_id_2."') OR (user_id_2='".$user_id_1."' AND user_id_1 = '".$user_id_2."')";
        $result = $this->db->query($query) or die('   Запрос не удался: ' . mysql_error());
        return $result->fetch_assoc();
    }
    function db_insert($table, $columns, $values){
        $query = "INSERT INTO " . $table ." (" . $columns .") VALUES (" . $values .")";
        if($result = $this->db->query($query)) {
        } else {
            return "Error";
        }
    }
    function db_update($table, $column_set, $value_set, $column_where, $value_where){
        $query = "UPDATE " . $table . " SET " . $column_set . "='" . $value_set . "' WHERE " . $column_where . " = '" . $value_where . "'";
        if($result = $this->db->query($query)) {
        } else {
            return "Error";
        }
    }
    function db_update_2($table, $set, $where){
        $query = "UPDATE " . $table . " SET " . $set . " WHERE " . $where;
        if($result = $this->db->query($query)) {
        } else {
            return "Error";
        }
    }
    function db_delete($table, $column, $value){
        $query = " DELETE FROM " . $table . " WHERE " . $column . "='".$value."'";
        if($result = $this->db->query($query)) {
        } else {
            return "Error";
        }
    }
}