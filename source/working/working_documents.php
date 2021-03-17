<?php

/*
 * Copyright By 南小宝
 * Last Edited: 20200905, By 张运筹
 */

if(!defined("IS_INCLUDED"))
{
    die('Access denied!');
}
if(isset($_GET['father'])){
    if($_GET['father'] <= 0 || !is_numeric($_GET['father'])){
        $father = 14;
    }else{
        $father = $_GET['father'];
    }
}else{
    $father = 14;
}

$folder = db_fetch(db_query("SELECT * FROM docs_file WHERE id = '$father';"));

db_update("docs_file", array(
    'downloads' => $folder['downloads'] + 1
), "id='$father'");

if(isset($_POST["name"]) && isset($_POST["url"]) && $folder['allowPDF']){
    db_insert("docs_file", array(
        'uid' => $_G['user']['uid'],
        'father' => $father,
        'type' => 2,
        'url' => $_POST["url"],
        'name' => $_POST["name"],
        'private' => 1,
        'time' => time(),
        'updateTime' => time(),
        'downloads' => 0
    ));
}

$query = db_query("SELECT * FROM docs_file WHERE father = '$father' ORDER BY type ASC, time DESC;");

include template("app/working:documents");

?>