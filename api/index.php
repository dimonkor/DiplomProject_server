<?php
/**
 * Created by JetBrains PhpStorm.
 * User: dmitrykorotchenkov
 * Date: 24.12.12
 * Time: 17:24
 * To change this template use File | Settings | File Templates.
 */

header('Content-type: application/json');

if ($_REQUEST['method']) {
    if ($_REQUEST['method'] == 'login') {
        require('./login.php');
    } else if ($_REQUEST['method'] == 'save_image') {
        require('./save_image.php');
    } else if ($_REQUEST['method'] == 'register') {
        require('./register.php');
    } else if ($_REQUEST['method'] == 'update_user_info') {
        require('./update_user_info.php');
    } else if ($_REQUEST['method'] == 'get_home_content') {
        require('./get_home_content.php');
    } else if ($_REQUEST['method'] == 'get_friend_content') {
        require('./get_friend_content.php');
    } else if ($_REQUEST['method'] == 'get_friends_list') {
        require('./get_friends_list.php');
    } else if ($_REQUEST['method'] == 'get_friends_suggestions') {
        require('./friends_suggestions.php');
    } else if ($_REQUEST['method'] == 'find_user') {
        require('./find_user.php');
    } else if ($_REQUEST['method'] == 'add_friend') {
        require('./add_friend.php');
    } else if ($_REQUEST['method'] == 'delete_friend') {
        require('./delete_friend.php');
    } else if ($_REQUEST['method'] == 'get_comments') {
        require('./get_comments.php');
    } else if ($_REQUEST['method'] == 'add_comment') {
        require('./add_comment.php');
    } else if ($_REQUEST['method'] == 'get_listeners_list') {
        require('./get_listeners_list.php');
    }
} else {
    include "Response.php";
    sendError("Missing method name");
}
?>