<?php
/**
 * Created by JetBrains PhpStorm.
 * User: dmitrykorotchenkov
 * Date: 23.12.12
 * Time: 19:06
 * To change this template use File | Settings | File Templates.
 */

$dblocation = "localhost";
$dbuser = "user";
$dbpasswd = "jV3cTBTFUnLCtEBf";
$dbname = "diplomdb";
//------------------------------------------------------------------------------
$connection = mysql_connect($dblocation, $dbuser, $dbpasswd) or die("Error mysql_connect");
$query = mysql_query("SET NAMES 'utf8' COLLATE 'utf8_general_ci'") or die("Error mysql_query");
$db = mysql_select_db($dbname, $connection) or die("Error mysql_select_db");

?>