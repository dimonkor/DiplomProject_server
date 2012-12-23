<?php
/**
 * Created by JetBrains PhpStorm.
 * User: dmitrykorotchenkov
 * Date: 06.12.12
 * Time: 23:55
 * To change this template use File | Settings | File Templates.
 */
$uploaddir = './upload-files/decode/';
$file = basename($_FILES['userfile']['name']);
$uploadfile = $uploaddir . $file;

if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
    echo "http://www.imaladec.net/upload-files/decode/{$file}";
}
?>