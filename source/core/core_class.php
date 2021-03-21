<?php
/*Copyright by nanxiaobao*/

if(!defined("IS_INCLUDED"))
{
    die('Access denied!');
}

function add_class($num, $name, $credits, $teacher, $array=array())
{
    if(db_fetch(db_query(
        "select classid from class_common where name='$name' and num='$num' and credits='$credits' and teacher='$teacher'"
    ))){
        print("课程 $name 已被添加过！<br>");
        ob_flush();
        flush();
        return 1;
    }

    //课程号以002、003、004、005、37、500开头的课程，均计入14学分！
    $pattern ="/^(002|003|004|005|37|500)/";
    if(preg_match($pattern, $num)){
        $isgeneral = 1;
    }else{
        $isgeneral = 0;
    }
    db_insert("class_common", array(
        'name' => "$name",
        'num' => "$num",
        'credits' => "$credits",
        'teacher' => "$teacher",
        'isgeneral' => "$isgeneral"
    ));

    $classid = db_fetch(db_query("select classid from class_common order by classid desc"))['classid'];

    if($array) {
        mark_class($classid, 10000, $array);
    }

    print("课程 $name 添加成功！<br>");
    ob_flush();
    flush();
    return 1;
}


function class_total($array, $credits=0)
{
    $item = array(
        'knowledge' => 0.1053,
        'marks' => 0.3742,
        'costtime' => 0.2754,
        'gains' => 0.1448,
        'teacher' => 0.1002,
        'persons' => 0.01
    );
    $result = $credits * 0.2;
    foreach ($item as $key => $value)
    {
        $result += $value * $array[$key];
    }
    return $result;
}

function mark_class($classid, $uid, $array)
{
    //$array: *knowledge, *marks, *costtime, *gains, *teacher, *exam, special, other
    if(isset($array['knowledge'])
        && isset($array['marks'])
        && isset($array['costtime'])
        && isset($array['gains'])
        && isset($array['teacher'])
        && isset($array['exam']))
    {
        $classinfo_common = db_fetch(db_query("select * from class_common where classid = $classid"));
        $user_credits = db_fetch(db_query("select credits from user_credits where uid = $uid"));
        if($classinfo = db_fetch(db_query("select * from class_ext where classid = $classid"))) {
            if($history = db_fetch(db_query("select * from class_mark where cid=$classid and uid=$uid")))
            {
                db_update("class_mark", $array, "cid=$classid and uid=$uid");
                $persons = $classinfo['persons'];
                //file_put_contents("log.txt", "(".$classinfo['knowledge']." * ".$classinfo['persons']." + ".$array['knowledge']." - ".$history['knowledge'].") / $persons");
                $knowledge = ($classinfo['knowledge'] * $classinfo['persons'] + $array['knowledge'] - $history['knowledge']) / $persons;
                $marks = ($classinfo['marks'] * $classinfo['persons'] + $array['marks'] - $history['marks']) / $persons;
                $costtime = ($classinfo['costtime'] * $classinfo['persons'] + $array['costtime'] - $history['costtime']) / $persons;
                $gains = ($classinfo['gains'] * $classinfo['persons'] + $array['gains'] - $history['gains']) / $persons;
                $teacher = ($classinfo['teacher'] * $classinfo['persons'] + $array['teacher'] - $history['teacher']) / $persons;
            }else{
                db_insert("class_mark", array_merge($array,
                        array(
                            'uid' => $uid,
                            'cid' => $classid
                        ))
                );
                $persons = $classinfo['persons'] + 1;
                $knowledge = ($classinfo['knowledge'] * $classinfo['persons'] + $array['knowledge']) / $persons;
                $marks = ($classinfo['marks'] * $classinfo['persons'] + $array['marks']) / $persons;
                $costtime = ($classinfo['costtime'] * $classinfo['persons'] + $array['costtime']) / $persons;
                $gains = ($classinfo['gains'] * $classinfo['persons'] + $array['gains']) / $persons;
                $teacher = ($classinfo['teacher'] * $classinfo['persons'] + $array['teacher']) / $persons;
            }

            $updatearray = array(
                'knowledge' => max($knowledge, 0),
                'marks' => max($marks, 0),
                'costtime' => max($costtime, 0),
                'gains' => max($gains, 0),
                'teacher' => max($teacher, 0),
                'persons' => max($persons, 0)
            );

            db_update("class_ext", array_merge(
                $updatearray,
                array(
                    'total' => class_total($updatearray, $classinfo_common['credits']),
                    'exam' => $array['exam']
                )
            ), "classid = $classid");

            db_update("user_credits", array(
                "credits" => $user_credits['credits'] + 2
            ), "uid=$uid");
            db_insert("user_credits_log", array(
                "uid" => $uid,
                "credits" => 2,
                "time" => time(),
                "reason" => "评课"
            ));
            //echo 2;
        }else{
            db_insert("class_mark", array_merge($array,
                    array(
                        'uid' => $uid,
                        'cid' => $classid
                    ))
            );

            $updatearray = array(
                'persons' => 1,
                'knowledge' => $array['knowledge'],
                'marks' => $array['marks'],
                'costtime' => $array['costtime'],
                'gains' => $array['gains'],
                'teacher' => $array['teacher'],
            );

            db_insert("class_ext", array_merge(
                $updatearray,
                array(
                    'total' => 0,
                    'exam' => $array['exam'],
                    'classid' => $classid
                )
            ));

            db_update("user_credits", array(
                "credits" => $user_credits['credits'] + 5
            ), "uid=$uid");
            db_insert("user_credits_log", array(
                "uid" => $uid,
                "credits" => 5,
                "time" => time(),
                "reason" => "评课(第一个评价该课程的人，附加3分)"
            ));
            //echo 1;
        }
        db_update("class_common", array('total' => class_total($updatearray, $classinfo_common['credits'])), "classid=$classid");
        return true;
    }else{
        return false;
    }
}

function class_givemark($mark)
{
    if($mark <= 2){
        $ans = $mark * 10 + 60;
    }else{
        $k = 20 / 3;
        $ans = $mark * $k + $k * 10;
    }
    return $ans;
}

function class_discribe_costtime($mark)
{
    if($mark < 1) {
        $ans = "<strong>8小时及以上</strong>";
    }elseif($mark < 2){
        $ans = " <strong>".round(12 - 4 * $mark, 2)."</strong> 小时左右";
    }elseif($mark < 4){
        $ans = " <strong>".round(6 - $mark, 2)."</strong> 小时左右";
    }else{
        $ans = " <strong>".round(10 - 2 * $mark, 2)."</strong> 小时左右";
    }
    return $ans;
}

function class_discribe_costtime_int($mark)
{
    if($mark < 1) {
        $ans = 8;
    }elseif($mark < 2){
        $ans = round(12 - 4 * $mark, 2);
    }elseif($mark < 4){
        $ans = round(6 - $mark, 2);
    }else{
        $ans = round(10 - 2 * $mark, 2);
    }
    return $ans;
}

?>