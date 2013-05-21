<?php

/**
 * Created by JetBrains PhpStorm.
 * User: dmitrykorotchenkov
 * Date: 23.12.12
 * Time: 20:20
 * To change this template use File | Settings | File Templates.
 */

include('Response.php');
include('Main.php');
require_once ('config.php');

function validateUsername($user)
{

    $str_sql_query =
        "SELECT `id` FROM `users` WHERE `user` = '$user'";

    $result = mysql_query($str_sql_query) or die(sendError("Error writing to database"));

    $good = true;
    while ($row = mysql_fetch_array($result)) {
        $good = false;
        break;
    }

    return $good;
}

function validatePassword($password)
{
    return strlen($password) > 3;
}

$user = $_REQUEST['user'];
$password = $_REQUEST['password'];

if (!validateUsername($user)) {
   sendError("Пользователь с таким именем уже зарегистрирован");
} else if (!validatePassword($password)) {
    sendError("Слишком короткий пароль");
} else {
    $str_sql_query =
        "INSERT INTO `users`(`user`, `password`) VALUES ('$user', '$password')";

    $result = mysql_query($str_sql_query) or die(sendError("Error writing to database"));

    if ($result) {
        $content = getUserInfo($user, $password);
        if ($content) {
            sendContent($content);
            exit;
        }
    }
    sendError("Ошибка сервера");
}

?>
