<?php
/**
 * Created by JetBrains PhpStorm.
 * User: dmitrykorotchenkov
 * Date: 19.01.13
 * Time: 20:32
 * To change this template use File | Settings | File Templates.
 */

$user = $_REQUEST['user'];
$password = $_REQUEST['password'];
$newUsername = $_REQUEST['new_username'];

include_once("Main.php");
include_once("Response.php");

$uploaddir = './images/';
$filename = "avt" . time() . rand() . ".jpg";
$path = $uploaddir . $filename;


require_once ('config.php');

$array = getUserIDAndAvatarUrl($user, $password);

if ($array == false) {
    sendError("Пожалуйста войдите в приложение повторно");
} else {
    $userID = $array["id"];
    $avatar_url = $array["avatar_url"];

    if ($_FILES['image']['tmp_name']){
        if (move_uploaded_file($_FILES['image']['tmp_name'], $path)) {
            $good = true;
            if (strlen($avatar_url)>1){
                if (file_exists($uploaddir.$avatar_url)){
                    unlink($uploaddir.$avatar_url);
                }
            }
            $avatar_url = $filename;
        } else {
            sendError("Ошибка при сохранении изображения");
        }
    }

    $str_sql_query =
        "UPDATE `users` SET `username`='$newUsername',`avatar_url`='$avatar_url' WHERE `id`='$userID'";

    $good = mysql_query($str_sql_query) or die(sendError("Error writing to database"));

    $content = array();

    $content['username'] = $newUsername;
    $content['avatar_url'] = $avatar_url;
    $content['user_id'] = $userID;
    if ($good){
        sendContent($content);
    }    else{
        sendError("Ошибка сервера");
    }
}

?>