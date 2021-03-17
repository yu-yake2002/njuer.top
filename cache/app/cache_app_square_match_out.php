<?php /*自动生成的模板文件_*/
if(!defined("IS_INCLUDED")) die('Access denied!'); ?>
<?php include template("app/common:header"); ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>南小宝 - 出游有约</title>
</head>
<body>
<?php include template("app/square:common_header"); ?>
<link rel="stylesheet" href="./template_app/css/square_match_out.css?r=9564">
<link rel="stylesheet" href="./template_app/css/HMGet.css?r=9564">
<div class="nav_row">
    <a href="index.php?mod=user&action=profile&uid=<?php echo isset($_G['user']['uid'])?($_G['user']['uid']):(""); ?>">
        <img src="<?php echo isset($_G['user']['profile']['avatar'])?($_G['user']['profile']['avatar']):(""); ?>" class="avatar_small">
    </a>
    <a href="index.php?mod=square&action=match&do=out"
       class="nav_btn_chosen">
        组队空间
    </a>
    <a href="index.php?mod=square&action=match&do=addOut"
       class="nav_btn">
        发起组队
    </a>
</div>
<br>
<br>
<br>
<?php if(isset($add_chance)){ ?>
<script>
    $.alert("组队广场的彩蛋砸中了你！恭喜您获得了一次额外的积分抽奖机会！");
</script>
<?php } ?>
<?php if($joinSuccess){ ?>
<script>
    $.alert("您已经报名成功！");
</script>
<?php } ?>
<?php if($joinFail){ ?>
<script>
    $.alert("该队已满员，报名失败！");
</script>
<?php } ?>
<?php if(isset($_GET['gid']) && $_GET['gid']){ ?>
<form action="index.php?mod=square&action=match&do=out" method="POST">
    <input type="hidden" name="gid" value="<?php echo isset($_GET['gid'])?($_GET['gid']):(""); ?>">
    <h1 class="addOut_title">
        组队报名表
    </h1>
    <p class="addOut_field">
        　　以下信息（除联系方式）将被公开展示给其他想组队的同学，如果您不愿意透露，均可以填保密，但那样会影响您的组队成功率。<br>
        　　您的联系方式只有在其他人加入组队以后才可以看到。<br>
        　　<font color="red"><strong>组队报名无法撤回，请大家报名后务必赴约。</strong></font>
    </p>
    <div class="addOut_field">
        <div class="addOut_field_label">队名</div>
        <input type="text" class="addOut_field_input" name="name" value="<?php echo isset($groupName)?($groupName):(""); ?>" disabled>
    </div>
    <div class="addOut_field">
        <div class="addOut_field_label">个人信息</div>
        <input type="text" class="addOut_field_input" name="uname"
               placeholder="格式示例：20硕 AI 张三，可填保密">
    </div>
    <div class="addOut_field">
        <div class="addOut_field_label">性别</div>
        <select class="addOut_field_input" name="sex">
            <option value="1">男</option>
            <option value="2">女</option>
            <option value="3">男(跨性别)</option>
            <option value="4">女(跨性别)</option>
            <option value="5" selected>保密</option>
        </select>
    </div>
    <div class="addOut_field">
        <div class="addOut_field_label">性取向</div>
        <select class="addOut_field_input" name="sexo">
            <option value="1">男</option>
            <option value="2">女</option>
            <option value="3" selected>保密</option>
        </select>
    </div>
    <div class="addOut_field">
        <div class="addOut_field_label">联系方式</div>
        <input type="text" class="addOut_field_input" name="mobile"
               placeholder="请输入您的手机号">
    </div>
    <div class="addOut_field">
        <div class="addOut_field_label">个人简介</div>
        <textarea class="addOut_field_text"
                  name="others"
                  placeholder="选填，简单介绍一下你自己"
                  oninput="document.getElementById('text_words_').innerHTML=this.value.length;
                  document.getElementById('text_wordsCount_').style.display='block';"
                  rows="5"></textarea>
        <span class="addOut_words_count" id="text_wordsCount_">
            <span id="text_words_">0</span>/100
        </span>
    </div>
    <div class="addOut_submit" onclick="document.getElementById('submit_match_out').click()">
        提交报名
        <input type="submit" hidden id="submit_match_out">
    </div>
</form>
<?php }else{ ?>
<?php while($group = db_fetch($query)){ ?>
    <div class="HMGet_content">
        <div class="HMGet_sub_content">
            <div class="title">
                <?php echo isset($group['name'])?($group['name']):(""); ?>
            </div>
            <p class="btn_comment">
                人数: <?php echo isset($group['people'])?($group['people']):(""); ?>/<?php echo isset($group['people_limit'])?($group['people_limit']):(""); ?>
            </p>
            <p class="btn_comment">
                队员名单(点击队员可以查看其个人简介)
            </p>
            <?php $group_query = db_query("SELECT * FROM square_match_out WHERE gid = ".$group['gid']." ORDER BY oid DESC"); ?> 
             <?php $isInGroup = db_fetch(db_query("SELECT * FROM square_match_out WHERE gid = ".$group['gid']." AND uid = ".$_G['user']['uid'])); ?>
            <table width="100%">
                <tr>
                    <td style="border-bottom: 1px dashed #793c65" align="center">
                        队员
                    </td>
                    <td style="border-bottom: 1px dashed #793c65" align="center">
                        性别
                    </td>
                    <td style="border-bottom: 1px dashed #793c65" align="center">
                        性取向
                    </td>
                    <td style="border-bottom: 1px dashed #793c65" align="center">
                        入队时间
                    </td>
                </tr>
                <?php while($group_persons = db_fetch($group_query)){ ?>
                    <div>
                    <tr>
                        <td style="border-bottom: 1px dashed #793c65" align="center">
                            <a href="javascript:;" onclick="show_intro('<?php echo isset($group_persons['others'])?($group_persons['others']):(""); ?><?php if($isInGroup){ ?>，联系方式: <?php echo isset($group_persons['mobile'])?($group_persons['mobile']):(""); ?><?php } ?>')"><?php echo isset($group_persons['name'])?($group_persons['name']):(""); ?></a>
                        </td>
                        <td style="border-bottom: 1px dashed #793c65" align="center" >
                            <?php echo isset($group_u_sex[$group_persons['sex']])?($group_u_sex[$group_persons['sex']]):(""); ?>
                        </td>
                        <td style="border-bottom: 1px dashed #793c65" align="center" >
                            <?php echo isset($group_u_sexo[$group_persons['sexo']])?($group_u_sexo[$group_persons['sexo']]):(""); ?>
                        </td>
                        <td style="border-bottom: 1px dashed #793c65" align="center" >
                            <?php echo formatTime($group_persons['time']); ?>
                        </td>
                    </tr>
                    </div>
                <?php } ?>
            </table>
            <div style="padding: 5px; border: 1px dashed #793c65">
                <p style="text-align: center; color: #793c65"><strong>队伍简介</strong></p>
                <?php echo str_ireplace('\r\n', '<br>', $group['contents']); ?>
            </div>
            <?php if($isInGroup){ ?>
            <button class="HMGet_btn"
                    onclick="location.href='index.php?mod=user&action=room&gid=<?php echo isset($group['gid'])?($group['gid']):(""); ?>'">
                进入队伍聊天室
            </button>
            <?php }else{ ?>
            <button class="HMGet_btn"
                    onclick="location.href='index.php?mod=square&action=match&do=out&gid=<?php echo isset($group['gid'])?($group['gid']):(""); ?>'">
                加入队伍
            </button>
            <?php } ?>
        </div>
    </div>
<?php } ?>
<?php } ?>
<br>
<br>
<br>
<br>
</body>
<script>
    function show_intro(text) {
        $.alert(
            {
                'title': '个人介绍',
                'text': text
            }
        );
    }
</script>
</html>