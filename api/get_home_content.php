<?php
/**
 * Created by JetBrains PhpStorm.
 * User: dmitrykorotchenkov
 * Date: 20.01.13
 * Time: 19:36
 * To change this template use File | Settings | File Templates.
 */

include_once("Response.php");
include_once("Main.php");
$user = $_REQUEST['user'];
$password = $_REQUEST['password'];

$userID = getUserID($user, $password);
if ($userID != false) {
    require_once ('config.php');
    $str_sql_query =

        "SELECT photos.id AS photoID, photos.name, photos.width, photos.height,
 users.username,users.avatar_url, users.id
 FROM photos
INNER JOIN users on users.id = photos.user_id
WHERE
    users.id = '$userID'
    OR (users.id IN (
        SELECT friends.friend_id FROM friends WHERE friends.user_id = '$userID'
        GROUP BY friends.friend_id
        )
        AND photos.for_friends = 0)
    OR (photos.for_friends = 1 AND
        users.id IN (
            SELECT friends.friend_id FROM friends
            WHERE friends.user_id = '$userID' AND friends.friend_id in (
                SELECT friends.user_id FROM friends
                WHERE friends.friend_id = '$userID'
            )

            GROUP BY friends.friend_id
            )
        )
GROUP BY photos.id
ORDER BY photos.date DESC";

    $result = mysql_query($str_sql_query) or die(sendError("Error writing to database"));

    $content = array();
    while ($row = mysql_fetch_array($result)) {
        array_push($content,array(
            "photo_url" => $row['name'],
            "photo_width" => $row['width'],
            "photo_height" => $row['height'],
            "user_id" => $row['id'],
            "username" => $row['username'],
            "avatar_url" => $row['avatar_url'],
            "photo_id" => $row['photoID'],
        ));
    }
    sendContentAndFields($content,array("count" => count($content)));
} else {
    sendError("Неправильное имя пользователя или пароль");
}
?>