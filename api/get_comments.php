<?php
/**
 * Created by JetBrains PhpStorm.
 * User: dmitrykorotchenkov
 * Date: 07.02.13
 * Time: 23:24
 * To change this template use File | Settings | File Templates.
 */

include_once("Response.php");
include_once("Main.php");
$photoID = $_REQUEST['photo_id'];


    require_once ('config.php');
    $str_sql_query =

        "SELECT comments.comment, users.username FROM comments
        INNER JOIN users on users.id = comments.user
        WHERE comments.photo = '$photoID'
        ORDER BY comments.date ASC";

    $result = mysql_query($str_sql_query) or die(sendError("Error writing to database"));

    $content = array();
    while ($row = mysql_fetch_array($result)) {
        array_push($content,array(
            "comment" => $row['comment'],
            "username" => $row['username']
        ));
    }
    sendContentAndFields($content,array("count" => count($content)));

?>