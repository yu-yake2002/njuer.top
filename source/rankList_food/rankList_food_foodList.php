<?php
/*
 * Copyright By 南小宝
 * Last Edited: 20200919, By 张运筹
 */

if(!defined("IS_INCLUDED"))
{
    die('Access denied!');
}

$search = db_query("SELECT * FROM common_user_sign WHERE 1 ORDER BY uid DESC LIMIT 0, 100");

include template("app/rankList_food:foodList");
?>