<?php
/*Copyright by nanxiaobao*/

if(!defined("IS_INCLUDED"))
{
    die('Access denied!');
}

$_SETTINGS=array(
    'upload_allowedExt' => array(
        'image' => array("gif", "jpeg", "jpg", "png"),
        'pdf' => array("pdf")
    ),
    'upload_FileType' => array(
        'image' => array("image/gif", "image/jpeg", "image/jpg", "image/pjpeg", "image/x-png", "image/png"),
        'pdf' => array("application/pdf")
    ),
    'upload_FileSize' => array(
        'image' => 20971520,
        'pdf' => 20971520
    ),
    'open_time' => array(
        'nju_docs1' => 1505326400
    ),
    'year' => '20'
);

?>