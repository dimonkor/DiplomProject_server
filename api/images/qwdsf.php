<?php
/**
 * Created by JetBrains PhpStorm.
 * User: dmitrykorotchenkov
 * Date: 13.01.13
 * Time: 15:45
 * To change this template use File | Settings | File Templates.
 */

$size = $_REQUEST["size"];
$name = $_REQUEST["name"];

if ($size != null && $name != null) {

    if ($size == "original") {
        header('Content-type: image/jpg');
        echo(implode("", file($name)));
    } else {
        include "lib/WideImage.php";
        if ($size == "thumbnail") {
            $size = getimagesize($name);
            $width = $size[0];
            $height = $size[1];
            WideImage::load($name)->resize(280, $height * 280 / $width)->output("jpg");
//        $image->output();
        }
    }
}




?>