<?php
/**
 * Created by JetBrains PhpStorm.
 * User: dmitrykorotchenkov
 * Date: 24.01.13
 * Time: 19:38
 * To change this template use File | Settings | File Templates.
 */

include_once("Response.php");
include_once("Main.php");
$user = $_REQUEST['user'];
$password = $_REQUEST['password'];
$user_id = $_REQUEST['user_id'];

$userID = false;
if ($user_id){
    $userID = $user_id;
} else{
    $userID = getUserID($user, $password);
}

if ($userID) {
    $str_sql_query =

        "SELECT users.id ,users.username, users.avatar_url FROM users
  WHERE users.id in
  (
    SELECT friends.friend_id FROM friends
    WHERE friends.user_id = '$userID'
    GROUP BY friends.friend_id
  )";

    $result = mysql_query($str_sql_query) or die(sendError("Error writing to database"));

    $array = array();
    while ($row = mysql_fetch_array($result)) {
        array_push($array,array(
            "user_id" => $row['id'],
            "username" => $row['username'],
            "avatar_url" => $row['avatar_url'],
        ));
    }
    if(count($array)>10){
        $content = array_rand($array,10);
    } else{
        $content = $array;
    }

    sendContentAndFields($content,array("count" => count($content)));
}
?>