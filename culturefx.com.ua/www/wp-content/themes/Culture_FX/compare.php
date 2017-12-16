<?php
require_once('Db_connection.class.php');
$DB = new Db_connection();
function cmp($a, $b)
			{
				if ($a['procent'] == $b['procent']) {
					return 0;
				}
				return ($a['procent'] < $b['procent']) ? -1 : 1;
			}

function get_users_array(){
    global $DB;
    $result = $DB->db_select('wp_cultures');
	global $groups;
	while ($d = $result->fetch_assoc()) {	
		$array_want = array($d['w_value1'], $d['w_value2'], $d['w_value3']);
		$array_have = array($d['h_value1'], $d['h_value2'], $d['h_value3']);
		$user_id = $d['culture_id'];
		$id_page = $d['id_page'];
		$groups[$id_page][$user_id] = array (
				'skills_want' => $array_want,
				'skills_have' => $array_have
			);
	}
	ksort($groups);
}



function pair_creator($groups){
    global $DB;
	foreach ($groups as $current_group => $users_in_group){
		foreach($users_in_group as $user1_id => $user1_skills){
			foreach($users_in_group as $user2_id => $user2_skills){
				if($user1_id != $user2_id && empty($DB->db_users_pair_check($user1_id, $user2_id))){
				$users_similarities = array_intersect($user1_skills['skills_want'], $user2_skills['skills_have']);
				$similar_procent = array('0', '33', '66', '100');
				$users_pair[$current_group][] = array('user_want_id' => $user1_id, 'user_have_id' => $user2_id, 'similarities' => $users_similarities, 'procent' => $similar_procent[count($users_similarities)]);
				}
			}
		}

	}
	return $users_pair;
}




function pair_provider($users_pair){
	$compare_users = array();
	foreach ($users_pair as $current_group => $pairs_in_group){	
		foreach($pairs_in_group as $user1_pair){
			foreach($pairs_in_group as $user2_pair){
				if($user1_pair['user_want_id'] == $user2_pair['user_have_id'] && $user1_pair['user_have_id'] == $user2_pair['user_want_id'] ){
                    $procent_all = (int)$user1_pair['procent'] + (int)$user2_pair['procent'];
                    $compare_users[$current_group][] = array('user_id_1' => $user1_pair['user_want_id'], 'user_id_2' => $user2_pair['user_want_id'], 'procent' => $procent_all);
				}
			}
		}
		usort($compare_users[$current_group], "cmp");
		$compare_users[$current_group] = array_reverse($compare_users[$current_group]);
	}
	return $compare_users;
}


function pairs_to_send($compare_users){
    $user_choosed = array();
    $pairs_ready = array();
    foreach ($compare_users as $current_group => $pairs_in_group){
        foreach($pairs_in_group as $user_pair) {
            if(!(in_array($user_pair['user_id_1'], $user_choosed) || in_array($user_pair['user_id_2'], $user_choosed))){
                array_push($user_choosed, $user_pair['user_id_1'], $user_pair['user_id_2']);
                $pairs_ready[$current_group][] = $user_pair;
                }
        }
    }

    return $pairs_ready;
}

function send($pairs_ready){

}

$groups = array();
get_users_array();
$users_pair = pair_creator($groups);
$compare_users = pair_provider($users_pair);
$pairs_ready = pairs_to_send($compare_users);
send($pairs_ready);
var_dump($pairs_ready);

?>