<?php /*自动生成的模板文件_*/
if(!defined("IS_INCLUDED")) die('Access denied!'); ?>
<?php include template("app/common:header"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>南小宝 - 例会</title>
    <link rel="stylesheet" href="./template_app/css<?php echo isset($_CORE['style_css'])?($_CORE['style_css']):("var[_CORE['style_css']]"); ?>/love_reg.css?r=4679">
    <link rel="stylesheet" href="./template_app/css<?php echo isset($_CORE['style_css'])?($_CORE['style_css']):("var[_CORE['style_css']]"); ?>/square_match_out.css?r=4679">
</head>
<body>
<?php include template("app/working:common_header"); ?>
<div class="working">
    <h1 class="Reg_title">
        会议通知
    </h1>
    <div class="working_group_list">
        <?php $i = 0; ?> 
        <?php while($Umeet = db_fetch($query)){ ?>
            <?php $Meet = get_meet($Umeet['meetid']); ?>
            <?php $Meet['intro'] = str_ireplace("\n", "<br>", $Meet['intro']); ?>
            <?php if($Meet){ ?>
            <?php $i++; ?>
            <div class="working_group_cell">
                <h2 align="center"><?php echo isset($Meet['name'])?($Meet['name']):(""); ?></h2>
                时间：<?php echo formatTime($Meet['time']); ?><br>
                地点：<?php echo isset($Meet['place'])?($Meet['place']):(""); ?><br>
                奖励积分：<?php echo isset($Meet['credits'])?($Meet['credits']):(""); ?>点<br>
                <?php echo isset($Meet['intro'])?($Meet['intro']):(""); ?>
                <?php if($Meet['state'] == 3){ ?>
                <br>
                签到已经结束。
                <?php } ?>
                <?php if($Meet['state'] == 2 && $Umeet['state'] == 0){ ?>
                <br><font color="red">请将下面的签到码告知需要签到的同学。</font>
                <form action="index.php?mod=working&action=index&oid=<?php echo isset($org['oid'])?($org['oid']):(""); ?>&sign=<?php echo isset($Meet['meetid'])?($Meet['meetid']):(""); ?>" method="post">
                    <div class="addOut_field">
                        <div class="addOut_field_label">签到码</div>
                        <input type="text" class="addOut_field_input"
                               name="key" placeholder="请输入签到码"<?php if($Meet['uid'] == $_G['user']['uid']){ ?> value="<?php echo isset($Meet['key'])?($Meet['key']):(""); ?>"<?php } ?>>
                    </div>
                    <div class="post_submit"
                         onclick="document.getElementById('sign<?php echo isset($Meet['meetid'])?($Meet['meetid']):(""); ?>').click();">
                        例会签到
                    </div>
                    <input hidden type="submit" id="sign<?php echo isset($Meet['meetid'])?($Meet['meetid']):(""); ?>">
                </form>
                <?php }elseif($Meet['state'] == 2 && $Umeet['state'] == 2){ ?>
                <br><font color="red">请将下面的签到码告知需要签到的同学。</font>
                <br>签到码: <?php echo isset($Meet['key'])?($Meet['key']):(""); ?>
                <?php } ?>
                <?php if($Meet['uid'] == $_G['user']['uid']){ ?>
                <?php if($Meet['state'] == 0){ ?>
                <a href="index.php?mod=working&action=index&oid=<?php echo isset($org['oid'])?($org['oid']):(""); ?>&notice=<?php echo isset($Meet['meetid'])?($Meet['meetid']):(""); ?>">
                    <div class="post_submit">
                        发布通知
                    </div>
                </a>
                <?php } ?>
                <?php if($Meet['state'] == 1){ ?>
                <a href="index.php?mod=working&action=index&oid=<?php echo isset($org['oid'])?($org['oid']):(""); ?>&beginSign=<?php echo isset($Meet['meetid'])?($Meet['meetid']):(""); ?>">
                    <div class="post_submit">
                        开始签到
                    </div>
                </a>
                <?php } ?>
                <?php if($Meet['state'] == 2){ ?>
                <a href="index.php?mod=working&action=index&oid=<?php echo isset($org['oid'])?($org['oid']):(""); ?>&endSign=<?php echo isset($Meet['meetid'])?($Meet['meetid']):(""); ?>">
                    <div class="post_submit">
                        结束签到
                    </div>
                </a>
                <?php } ?>
                <?php if($Meet['state'] == 3){ ?>
                <br>
                <?php $persons1 = db_count(db_query("SELECT uid FROM org_meeting_sign WHERE meetid = ".$Meet['meetid'])); ?>
                <?php $person_query = db_query("SELECT name FROM org_meeting_sign WHERE state = 0 AND meetid = ".$Meet['meetid']); ?>
                 <?php $persons2 = $persons1 - db_count($person_query); ?>
                签到结果：应到<?php echo isset($persons1)?($persons1):(""); ?>人，实到<?php echo isset($persons2)?($persons2):(""); ?>人。
                <br>未签到名单：
                <?php                 $absenses = array();
                while($absense = db_fetch($person_query)){
                    $absenses[] = $absense['name'];
                }
                print(join("，", $absenses));
                ?>。
                <a href="index.php?mod=working&action=index&oid=<?php echo isset($org['oid'])?($org['oid']):(""); ?>&beginSign=<?php echo isset($Meet['meetid'])?($Meet['meetid']):(""); ?>">
                    <div class="post_submit">
                        重新开始签到
                    </div>
                </a>
                <?php } ?>
                <?php } ?>

            </div>
            <?php } ?>
        <?php } ?>
        <?php if($i == 0){ ?>
            暂时没有例会通知~
        <?php } ?>
    </div>
</div>
</body>
</html>