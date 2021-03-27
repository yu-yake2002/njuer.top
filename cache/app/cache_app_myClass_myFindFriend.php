<?php /*自动生成的模板文件_*/
if(!defined("IS_INCLUDED")) die('Access denied!'); ?>
<?php include template("app/common:header"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>南小宝 - 我的会友</title>
    <link rel="stylesheet" href="./template_app/css/love_reg.css?r=5179">
    <link rel="stylesheet" href="./template_app/css/rankList_class.css?r=5179">
</head>
<body>
<?php include template("app/rankList_class:common_header"); ?>
<div class="nav_row">
    <a href="index.php?mod=user&action=profile&uid=<?php echo isset($_G['user']['uid'])?($_G['user']['uid']):(""); ?>">
        <img src="<?php echo isset($_G['user']['profile']['avatar'])?($_G['user']['profile']['avatar']):(""); ?>" class="avatar_small">
    </a>
    <a href="index.php?mod=myClass&action=findFriend"
       class="nav_btn">
        会友广场
    </a>
    <a href="index.php?mod=myClass&action=addFindFriend"
       class="nav_btn">
        发起会友
    </a>
    <a href="index.php?mod=myClass&action=myFindFriend"
       class="nav_btn_chosen">
        我的会友
    </a>
</div>
<br>
<br>

<?php if(db_count($myFindFriendList) == 0){ ?>
<div class="card3">你还没有发起/参与会友</div>
<?php }else{ ?>
<?php while($myFindFriend = db_fetch($myFindFriendList)){ ?>
    <?php $classinfo = get_classinfo($myFindFriend['cid']); ?>
    <div class="card3" style="text-align: left" id="class_<?php echo isset($myFindFriend['ffid'])?($myFindFriend['ffid']):(""); ?>">
        <p class="classlist-titlenav">
            <span class="classlist-title"><?php echo isset($classinfo['name'])?($classinfo['name']):("var[classinfo['name']]"); ?></span>
        <hr size="1" color="#793c65">
        </p>
        <div class="classlist-introduction">
            <p>课程号: <?php echo isset($classinfo['num'])?($classinfo['num']):("var[classinfo['num']]"); ?></p>
            <table width="100%">
                <tr>
                    <td style="border-bottom: 1px dashed #793c65" align="center">
                        姓名
                    </td>
                    <td style="border-bottom: 1px dashed #793c65" align="center">
                        性别
                    </td>
                    <td style="border-bottom: 1px dashed #793c65" align="center">
                        年级
                    </td>
                    <td style="border-bottom: 1px dashed #793c65" align="center">
                        院系
                    </td>
                </tr>
                <div>
                    <tr>
                        <td style="border-bottom: 1px dashed #793c65" align="center">
                            <?php echo isset($myFindFriend['uname'])?($myFindFriend['uname']):(""); ?>
                        </td>
                        <td style="border-bottom: 1px dashed #793c65" align="center" >
                            <?php echo isset($mySex[$myFindFriend['gender']])?($mySex[$myFindFriend['gender']]):(""); ?>
                        </td>
                        <td style="border-bottom: 1px dashed #793c65" align="center" >
                            <?php echo isset($myFindFriend['grade'])?($myFindFriend['grade']):(""); ?>
                        </td>
                        <td style="border-bottom: 1px dashed #793c65" align="center" >
                            <?php echo isset($myFindFriend['department'])?($myFindFriend['department']):(""); ?>
                        </td>
                    </tr>
                </div>
                <div style="padding: 5px; border: 1px dashed #793c65">
                    <?php echo str_ireplace('\r\n', '<br>', $myFindFriend['intro']); ?>
                </div>
            </table>
        </div>
    </div>
<?php } ?>

<?php } ?>
<br>
<br>
<br>
<br>
</body>
</html>