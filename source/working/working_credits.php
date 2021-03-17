<?php

/*
 * Copyright By 南小宝
 * Last Edited: 20200905, By 张运筹
 */

if(!defined("IS_INCLUDED"))
{
    die('Access denied!');
}

$query = db_query("SELECT * FROM org_user_credits WHERE uoid = {$OrgUser['uoid']} ORDER BY logid DESC");

include template("app/working:credits");

?>