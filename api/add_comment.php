<?php
/**
 * Created by JetBrains PhpStorm.
 * User: dmitrykorotchenkov
 * Date: 08.02.13
 * Time: 0:43
 * To change this template use File | Settings | File Templates.
 */

include_once("Response.php");
include_once("Main.php");
$user = $_REQUEST['user'];
$password = $_REQUEST['password'];
$comment = $_REQUEST['comment'];
$photoId = $_REQUEST['photo_id'];

$userID = getUserID($user, $password);
if ($userID != false) {
    require_once ('config.php');
    $str_sql_query =

        "INSERT INTO comments (
        user ,comment , photo
        )
        VALUES ('$userID', '$comment', '$photoId')";

    $result = mysql_query($str_sql_query) or die(sendError("Error writing to database"));

    if ($result){
        sendOK();
    }
    else{
        sendError('Ошибка при сохранении комментария');
    }
} else {
    sendError("Неправильное имя пользователя или пароль");
}

?>