<?php
/**
 * Created by JetBrains PhpStorm.
 * User: dmitrykorotchenkov
 * Date: 26.01.13
 * Time: 16:35
 * To change this template use File | Settings | File Templates.
 */

include_once("Response.php");
include_once("Main.php");
require_once ('config.php');

$user = $_REQUEST['user'];
$password = $_REQUEST['password'];
$user_id = $_REQUEST['user_id'];

$userID = false;
if ($user_id){
    $userID = $user_id;
} else{
    $userID = getUserID($user, $password);
}
$searchString = $_REQUEST['search_string'];

if ($userID && $searchString){

    $str_sql_query =

        "SELECT username, id, avatar_url from users
          WHERE username LIKE '%$searchString%' AND id <>'$userID'";

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

sendError("Ошибка сервера");

?>