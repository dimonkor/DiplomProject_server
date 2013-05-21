<?php
/**
 * Created by JetBrains PhpStorm.
 * User: dmitrykorotchenkov
 * Date: 23.12.12
 * Time: 19:58
 * To change this template use File | Settings | File Templates.
 */
include('Response.php');
include('Main.php');

$user = $_REQUEST['user'];
$password = $_REQUEST['password'];

$content = getUserInfo($user, $password);

if ($content) {
    sendContent($content);
} else {
    sendError("Не правильное имя пользователя или пароль");
}