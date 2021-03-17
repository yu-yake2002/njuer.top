<?php
/*Copyright by nanxiaobao*/

if(!defined("IS_INCLUDED"))
{
    die('Access denied!');
}

function CORE_CACHE_DELETE($max=86400)
{
    $temp = scandir('./data/cache');
    foreach($temp as $v)
    {
        if(
            !isdir("./data/cache/$v")
            && time() - fileatime("./data/cache/$v") >= $max
        )
        {
            unlink("./data/cache/$v");
        }
    }
    return ;
}

?>