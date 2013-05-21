<?php
/**
 * Created by JetBrains PhpStorm.
 * User: dmitrykorotchenkov
 * Date: 21.01.13
 * Time: 23:40
 * To change this template use File | Settings | File Templates.
 */


include_once("Response.php");
include_once("Main.php");
$user = $_REQUEST['user'];
$password = $_REQUEST['password'];
$friendID = $_REQUEST['user_id'];

if ($friendID != false) {
    require_once ('config.php');
    $userID = getUserID($user,$password);
    if ($userID == false){
        $userID = -1;
    }
    $str_sql_query =

        "SELECT photos.id AS photoID, photos.name, photos.width, photos.height,
    users.username,users.avatar_url, users.id
    FROM photos
    INNER JOIN users on users.id = photos.user_id
    WHERE (photos.for_friends = 0 AND photos.user_id = '$friendID') OR
          (photos.for_friends = 1 AND photos.user_id = '$friendID' AND
              ('$friendID' = '$userID' OR '$userID' in (SELECT friends.friend_id FROM friends
                           WHERE friends.user_id = '$friendID'))
          )
    ORDER BY photos.date DESC";

    $result = mysql_query($str_sql_query) or die(sendError("Error writing to database"));

    $content = array();
    while ($row = mysql_fetch_array($result)) {
        array_push($content, array(
            "photo_url" => $row['name'],
            "photo_width" => $row['width'],
            "photo_height" => $row['height'],
            "user_id" => $row['id'],
            "username" => $row['username'],
            "avatar_url" => $row['avatar_url'],
            "photo_id" => $row['photoID']
        ));
    }

    $user = $_REQUEST['user'];
    $password = $_REQUEST['password'];

    $userID = getUserID($user, $password);

    $canAddToFriends = false;
    if ($userID && ($userID != $friendID)) {
        $str_sql_query =

            "SELECT user_id FROM friends WHERE user_id = '$userID' AND friend_id = '$friendID'";
        $result = mysql_query($str_sql_query) or die(sendError("Error writing to database"));
        $canAddToFriends = true;
        while ($row = mysql_fetch_array($result)) {
            $canAddToFriends = false;
            break;
        }


    }
    sendContentAndFields($content, array(
        "count" => count($content),
        "canAddToFriends" => $canAddToFriends
    ));
} else {
    sendError("Неправильный идентификатор пользователя");
}

?>