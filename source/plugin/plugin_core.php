<?php
//Copyright by nanxiaobao

if (!defined("IS_INCLUDED"))
{
    die('Access denied!');
}


if(isset($_GET['action']) && file_exists("./source/plugin/{$_GET['action']}/core.php"))
{
    include_once "./source/plugin/{$_GET['action']}/core.php";
}else{
    CORE_GOTOURL("index.php");
}

?>