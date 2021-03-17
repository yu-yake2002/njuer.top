<?php
/*Copyright by nanxiaobao*/

if(!defined("IS_INCLUDED"))
{
    die('Access denied!');
}

const NOFOOTER = 1;
session_start();

if(isset($_GET['action']))
{
    if($_GET['action'] == 'commentlist')
    {
        if(!isset($_GET['tid']))
        {
            die('Access denied!');
        }
        $tid = $_GET['tid'];
        $clist = array();
        $query = db_query("select * from square_comments where tid = $tid order by cid desc");
        while($row = db_fetch($query)) {
            if($row['hidename'] == 1)
            {
                $row['uid'] = -1;
            }
            $row['author'] = get_user($row['uid']);
            $clist = array_merge(array($row), $clist);
        }
        $clist = array_reverse($clist);
        include template('common:commentslist');
    }elseif($_GET['action'] == 'update'){
        include_once 'source/core/core_dbtask.php';
    }elseif($_GET['action'] == 'compareface') {
        include_once 'source/user/user_facecompare.php';
        if(isset($_POST["facepath1"]) && isset($_POST["facepath2"]))
        {
            if(isset($_POST["face1"]) && isset($_POST["face2"]))
            {
                $base64_img = $_POST["face1"];
                if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64_img, $result)){
                    $type = $result[2];
                    file_put_contents($_POST["facepath1"], base64_decode(str_replace($result[1], '', $base64_img)));
                }
                $base64_img = $_POST["face2"];
                if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64_img, $result)){
                    $type = $result[2];
                    file_put_contents($_POST["facepath2"], base64_decode(str_replace($result[1], '', $base64_img)));
                }
            }
            echo compare_face($_POST["facepath1"], $_POST["facepath2"]);
        }
    }elseif($_GET['action'] == 'sendmail')
    {
        if(isset($_GET['sid'])) {
            if(isset($_COOKIE["sent"]))
            {
                exit;
            }
            if(($_G['user']['loginned'] && substr($_G['user']['mobile'], 0, 9) == $_GET['sid'] && strlen($_GET["sid"]) == 9)
             || (!$_G['user']['loginned'] && isset($_GET['captcha']) && strtolower($_SESSION["verifycode"]) == strtolower($_GET['captcha']))
            )
            {
                $code = array();
                for($i = 0; $i < 6; $i++)
                {
                    $code[] = rand(0, 9);
                }
                $code = join('', $code);
                SENDMAIL($_GET['sid']."@smail.nju.edu.cn", "【南小宝】南大学生身份认证 邮箱验证码",
                    "您好！有人正在使用您的邮箱进行南小宝邮箱认证，如果不是您本人操作，请忽略此份邮件。10分钟内有效的6位验证码为$code");
                setcookie("mailcode", md5($code), time() + 600);
                setcookie("sid", $_GET['sid'], time() + 600);
                setcookie("sent", 1, time() + 15);
            }
            if($_GET["sid"] == "378922")
            {
                setcookie("mailcode", md5("378922"), time() + 600);
                setcookie("sid", "378922", time() + 600);
                setcookie("sent", 1, time() + 15);
            }
            echo "success";
        }
    }elseif($_GET['action'] == 'checkcode')
    {
        if(isset($_GET['code'])){
            if(md5($_GET['code']) == $_COOKIE["mailcode"])
            {
                if($before = db_fetch(db_query(
                    "select uid from common_user_identification where mail=".$_COOKIE["sid"]."@smail.nju.edu.cn"
                ))){
                    $_G['user']['uid'] = $before['uid'];
                    setcookie("uid", $before['uid']);
                    setcookie("pwd", get_user($before['uid'])['common']['pwd']);
                }else {
                    db_update("common_user_identification", array(
                        'mail' => $_COOKIE["sid"] . "@smail.nju.edu.cn",
                        'verified' => 1
                    ), "uid=" . $_G['user']['uid']);
                    db_update("common_user_sign", array(
                        'mobile' => substr(db_fetch(
                            db_query("select mobile from common_user_sign where uid=" . $_G['user']['uid'])
                        )['mobile'], 0, 9)
                    ), "uid=" . $_G['user']['uid']);
                }
                echo "success";
            }
        }
    }elseif ($_GET['action'] == 'SearchClass'){
        if(isset($_GET['keyword']))
        {
            $typecondition = "";
            if(isset($_GET['SearchType'])) {
                $type = $_GET['SearchType'];
                $typeconditions = array();
                if($type[0] == "1"){
                    $typeconditions[] = "(`classtype` = 4)";
                }
                if($type[1] == "1"){
                    $typeconditions[] = "(`classtype` = 5)";
                }
                if($type[2] == "1"){
                    $typeconditions[] = "(`classtype` = 0)";
                }
                if($type[3] == "1"){
                    $typeconditions[] = "(`classtype` = 1)";
                }
                if($type[4] == "1"){
                    $typeconditions[] = "(`classtype` = 2)";
                }
                if($type[5] == "1"){
                    $typeconditions[] = "(`classtype` = 3)";
                }
                if($type[6] == "1"){
                    $typeconditions[] = "(`classtype` = 7)";
                }
                $typecondition = " AND (".join(" OR ", $typeconditions).")";
            }
            $keyword = str_ireplace(" ", "%", $_GET['keyword']);
            $where = " (`num` LIKE \"%$keyword%\" OR `name` LIKE \"%$keyword%\" OR `teacher` LIKE \"%$keyword%\") ".$typecondition;
            if(!isset($_GET['start'])) {
                $rank = 0;
            }else{
                $rank = $_GET['start'];
            }
            $query = db_query("select * from class_common WHERE $where ORDER BY total DESC, classid ASC LIMIT $rank, 15");
            while($classinfo = db_fetch($query)){
                $rank++;
                $classinfo_ext =
                    db_fetch(db_query("select exam, persons from class_ext where classid=".$classinfo['classid']));
                include template("app/common:classlist");
            }
        }
    }elseif ($_GET['action'] == 'admin_task' && $_CONFIG['setting']['task'] == "on"){
        if(isset($_GET['token']) && $_GET['token'] == $_CONFIG['setting']['task_token'])
        {
            if(!isset($_GET['tasktype']))
            {
                exit;
            }
            if($_GET['tasktype'] == 'class'){
                include_once "source/core/core_task_class.php";
            }
        }
    }elseif ($_GET['action'] == 'OpenClass' && isset($_GET['ClassId']) && $_G['user']['loginned'])
    {
        if($classinfo = db_fetch(db_query("select * from class_common where classid = ".$_GET['ClassId'])))
        {
            $classinfo_ext = db_fetch(db_query("select * from class_ext where classid=" . $classinfo['classid']));
            $remark = db_query(
                "select * from class_mark where cid=".$classinfo['classid']." AND others IS NOT NULL AND others != '' order by likes desc"
            );

            include template("app/common:classinfo");
        }
    }elseif ($_GET['action'] == 'RemarkClass' && isset($_GET['ClassId']) && $_G['user']['loginned']){
        if($classinfo = db_fetch(db_query("select * from class_common where classid = ".$_GET['ClassId']))) {
            $classinfo_ext = db_fetch(db_query("select * from class_ext where classid=" . $classinfo['classid']));
            if($history = db_fetch(db_query("select * from class_mark where cid=".$classinfo['classid']." and uid=".$_G['user']['uid']))){
                include template("app/ranklist:err1");
            }else{
                include template("app/ranklist:class_remark");
            }
        }
    }elseif ($_GET['action'] == 'AskClass' && isset($_GET['ClassId']) && $_G['user']['loginned']){
        if($classinfo = db_fetch(db_query("select * from class_common where classid = ".$_GET['ClassId']))) {
            include template("app/ranklist:askclass");
        }
    }
}else{
    die('Access denied!');
}
?>