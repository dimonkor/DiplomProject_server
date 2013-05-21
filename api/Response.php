<?php
/**
 * Created by JetBrains PhpStorm.
 * User: dmitrykorotchenkov
 * Date: 23.12.12
 * Time: 21:01
 * To change this template use File | Settings | File Templates.
 */

function sendResponse($error = null, $content = null)
{
    sendResponseAndFields($error, $content, null);
}

function sendResponseAndFields($error = null, $content = null, $fields = null)
{
    $arr = array();
    if ($error != null) {
        $arr['error'] = $error;
    } else {
        $arr['success'] = 1;
    }
    if ($content != null) {
        $arr['content'] = $content;
    }
    if ($fields != null) {
        $arr = array_merge($arr, $fields);
    }

          echo  preg_replace_callback(
                '/\\\u([0-9a-fA-F]{4})/',
                create_function('$match', 'return mb_convert_encoding("&#" . intval($match[1], 16) . ";", "UTF-8", "HTML-ENTITIES");'),
                json_encode($arr)
            );

//    echo json_encode($arr);
    exit;
}

function sendOK()
{
    sendResponse();
}

function sendContent($content)
{
    sendResponse(null, $content);
}

function sendContentAndFields($content, $fields)
{
    sendResponseAndFields(null, $content, $fields);
}

function sendError($error)
{
    sendResponse($error);
}

?>