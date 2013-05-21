<?php
/**
 * Created by JetBrains PhpStorm.
 * User: dmitrykorotchenkov
 * Date: 26.01.13
 * Time: 21:38
 * To change this template use File | Settings | File Templates.
 */

include_once("Response.php");
include_once("Main.php");
$friendID = $_REQUEST['friend_id'];
$user = $_REQUEST['user'];
$password = $_REQUEST['password'];

$user_id = $_REQUEST['user_id'];

$userID = false;
if ($user_id){
    $userID = $user_id;
} else{
    $userID = getUserID($user, $password);
}

if ($userID && $friendID) {
    $str_sql_query =

        "INSERT INTO friends (
        user_id ,friend_id
        )
        VALUES ('$userID', '$friendID')";

    $result = mysql_query($str_sql_query) or die(sendError("Error writing to database"));

    if ($result){
        sendOK();
    }
    else{
        sendError('Не удалось добавить в друзья');
    }
} else{
    sendError("Недостаточно переметров");
}

?>