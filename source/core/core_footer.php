<?php
/*Copyright by nanxiaobao*/

if(!defined("IS_INCLUDED"))
{
    die('Access denied!');
}

if(!defined("IS_SERVER")) {
    include_once 'source/core/core_online_data.php';
    include template("app/HMGet:debt");
    include template("app/common:footer");
}

$_DBCONNECT->close();

?>