<?php

/*
 * Copyright By 南小宝
 * Last Edited: 20200905, By 张运筹
 */

if(!defined("IS_INCLUDED"))
{
    die('Access denied!');
}

$query = db_query("SELECT * FROM class_common WHERE classId in (SELECT classId FROM docs_class_folder WHERE fid = 1)");

include template("app/nju_docs:index");

?>