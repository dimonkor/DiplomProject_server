<?php
/**
 * Created by JetBrains PhpStorm.
 * User: dmitrykorotchenkov
 * Date: 06.12.12
 * Time: 23:55
 * To change this template use File | Settings | File Templates.
 */

$user = $_REQUEST["user"];
$password = $_REQUEST["password"];
$forFriends = $_REQUEST["for_friends"];

if (!$forFriends) {
    $forFriends = false;
}

if ($user != null && $password != null) {
    include_once('Response.php');
    require_once ('config.php');
    require_once ('Main.php');

    $userID = getUserID($user, $password);

    $uploaddir = './images/';
    $filename = "img" . time() . rand() . ".jpg";
    $path = $uploaddir . $filename;

    $good = false;
    if (move_uploaded_file($_FILES['image']['tmp_name'], $path)) {
        $size = getimagesize($path);
        $str_sql_query =
            "INSERT INTO `photos`(`user_id`, `name`, `width`, `height`, `for_friends`) VALUES ('$userID','$filename','$size[0]', '$size[1]', '$forFriends')";
        $result = mysql_query($str_sql_query);
        if ($result != false) {
            $good = true;
        }
    }

    $content = array();
    $content['url'] = $filename;

    if ($good) {
        sendContent($content);
    } else {
        sendError("Ошибка при сохранении изображения ");
    }
}


?>