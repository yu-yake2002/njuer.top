<?php

/*
 * Copyright By 南小宝
 * Last Edited: 20200909, By 张运筹
 */

if(!defined("IS_INCLUDED"))
{
    die('Access denied!');
}
exit();
$nowtime = time();
for($i = 0; $i < 40; $i++)
{
    $nexttime = $nowtime - 600;
    print (date("Y-m-d H:i:s", $nowtime - 300)."[]");
    $query = db_query("SELECT COUNT(uid) FROM (SELECT uid FROM user_message WHERE time >= {$nexttime} AND time < {$nowtime} GROUP BY uid) as A");
    $user = db_fetch($query);
    print "{$user[0]}[]";
    $user = db_count(db_query("SELECT uid FROM user_message WHERE time >= {$nexttime} AND time < {$nowtime}"));
    print "{$user}<br>";
    $nowtime = $nexttime;
}

?>