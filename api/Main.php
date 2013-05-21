<?php
/**
 * Created by JetBrains PhpStorm.
 * User: dmitrykorotchenkov
 * Date: 19.01.13
 * Time: 14:57
 * To change this template use File | Settings | File Templates.
 */

// return 'false' if user not found or user info array

function getUserID($user, $password)
{
    require_once ('config.php');
    $str_sql_query =
        "SELECT `id` FROM `users` WHERE `user` = '$user' AND `password` = '$password'";

    $result = mysql_query($str_sql_query) or die(sendError("Error writing to database"));

    $good = false;
    $id = -1;
    while ($row = mysql_fetch_array($result)) {
        $good = true;
        $id = $row['id'];
        break;
    }
    if ($good)
        return $id;
    else
        return false;
}

function getUserIDAndAvatarUrl($user, $password)
{
    require_once ('config.php');
    $str_sql_query =
        "SELECT `id`,`avatar_url` FROM `users` WHERE `user` = '$user' AND `password` = '$password'";

    $result = mysql_query($str_sql_query) or die(sendError("Error writing to database"));

    $good = false;
    $id = -1;
    $avatar_url = "";
    while ($row = mysql_fetch_array($result)) {
        $good = true;
        $id = $row['id'];
        $avatar_url = $row['avatar_url'];
        break;
    }
    if ($good)
       return array("id" => $id,
            "avatar_url" => $avatar_url);
    else
        return false;
}

function getUserInfo($user, $password)
{
    require_once ('config.php');
    $str_sql_query =
        "SELECT `username`,`avatar_url`,`id` FROM `users` WHERE `user` = '$user' AND `password` = '$password'";

    $result = mysql_query($str_sql_query) or die(sendError("Error writing to database"));

    $good = false;
    $content = array();
    while ($row = mysql_fetch_array($result)) {
        $good = true;
        $content['username'] = $row['username'];
        $content['avatar_url'] = $row['avatar_url'];
        $content['user_id'] = $row['id'];
        break;
    }
    if ($good)
        return $content;
    else
        return false;
}

function getUserInformationForID($userID){
	// do nothing
}

?>
