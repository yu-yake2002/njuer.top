<?php /*自动生成的模板文件_*/
if(!defined("IS_INCLUDED")) die('Access denied!'); ?>
<?php include template("app/common:header"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>南小宝 - <?php echo isset($user['common']['name'])?($user['common']['name']):("var[user['common']['name']]"); ?> - <?php echo isset($user['profile']['words'])?($user['profile']['words']):("var[user['profile']['words']]"); ?></title>
    <link href="https://cdn.bootcss.com/magnific-popup.js/1.1.0/magnific-popup.min.css" rel="stylesheet" />
    <link href="template_app/css/home.css?r=1036" rel="stylesheet" />
    <script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.bootcss.com/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
</head>
<body>

<div class="gallery-section">
    <div class="home-cover" id="home-cover" onclick="this.style.display='none';">
        <div class="home-cover-inner">
            <table style="margin: auto; text-align: center">
                <tr>
                    <td>
                        <div class="round_icon">
                            <img src="<?php echo isset($user['profile']['avatar'])?($user['profile']['avatar']):("var[user['profile']['avatar']]"); ?>" width="100" height="100">
                        </div>
                    </td>
                </tr>
            </table>
            <br>
            <div>
                <h1><?php echo isset($user['common']['name'])?($user['common']['name']):("var[user['common']['name']]"); ?></h1>
            </div>
            <h3 align="center"><?php echo isset($user['attention']['fans'])?($user['attention']['fans']):(""); ?>人已关注</h3>
        </div>
    </div>
    <div class="inner-width">
        <table style="margin: auto; text-align: center">
            <tr>
                <td rowspan="2">
                    <a href="javascript:;" onclick="document.getElementById('file').click();">
                        <div class="round_icon">
                            <img src="<?php echo isset($user['profile']['avatar'])?($user['profile']['avatar']):("var[user['profile']['avatar']]"); ?>" width="100" height="100" id="avatar">
                        </div>
                    </a>
                    <!--<?php if($_G['user']['uid'] == $user['common']['uid']){ ?>-->
                    <input type="file" id="file" hidden onchange="post_avatar()">
                    <!--<?php } ?>-->
                </td>
                <td>
                    <h1><?php echo isset($user['common']['name'])?($user['common']['name']):("var[user['common']['name']]"); ?></h1>
                </td>
            </tr>
            <tr>
                <td>
                    <h3 align="center"><?php echo isset($user['profile']['words'])?($user['profile']['words']):("var[user['profile']['words']]"); ?></h3><div class="border"></div>
                </td>
            </tr>
        </table>

        <?php if($_G['user']['uid'] != 0){ ?>
        <br>
        <table width="100%">
            <tr>
                <td width="21%" align="center">
                    <strong>关注</strong>
                </td>
                <td width="21%" align="center">
                    <strong>粉丝</strong>
                </td>
                <td align="center" width="21%">
                    <strong>积分</strong>
                </td>
                <td align="center" width="21%">
                    <strong>访客</strong>
                </td>
                <td align="center" rowspan="2">
                    <img src="static/img/2021/follow<?php if($Following){ ?>ed<?php } ?>.png" width="100%" onclick="attention(this, <?php echo isset($user['common']['uid'])?($user['common']['uid']):(""); ?>);">
                </td>
            </tr>
            <tr>
                <td align="center" class="home-num">
                    <?php echo isset($user['attention']['attens'])?($user['attention']['attens']):(""); ?>
                </td>
                <td align="center" class="home-num">
                    <?php echo isset($user['attention']['fans'])?($user['attention']['fans']):(""); ?>
                </td>
                <td align="center" class="home-num">
                    <?php echo isset($user['credits']['credits'])?($user['credits']['credits']):(""); ?>
                </td>
                <td align="center" class="home-num">
                    <?php echo isset($user['attention']['visitors'])?($user['attention']['visitors']):(""); ?>
                </td>
            </tr>
        </table>
        <hr size="1">
        <?php } ?>
        <br>
        <?php if(time() <= 1613059199){ ?>
        <a href="index.php?mod=user&action=gift&giftid=1">
            <img src="static/img/2021/banner.jpg" width="100%" style="border-radius: 16px">
        </a>
        <br>
        <br>
        <?php } ?>
        <div class="home_profile">
            <h4 style="position: absolute">个人信息</h4>
            <div style="text-align: right; margin-right: 12px;">
                <p>
                    <!--<?php if($_G['user']['uid'] == $user['common']['uid']){ ?>-->
                    <a href="javascript:;" onclick="edit()">
                        <font color="#ff7f50" id="btn">修改个人信息</font>
                    </a>
                    <!--<?php }else{ ?>-->
                    <a href="javascript:;"
                       onclick="location.href='index.php?mod=user&action=message&uid=<?php echo isset($user['common']['uid'])?($user['common']['uid']):(""); ?>'">
                        <font color="#ff7f50">发起会话</font>
                    </a>
                    <!--<?php } ?>-->
                </p>
            </div>

            <hr size="1">
            <table style="padding-top: 12px; padding-left: 6px; font-size: 14px; color: #5f646e; z-index: 9999;">
                    <tr>
                        <td width="100px">
                            用户名
                        </td>
                        <td id="name" width="200px"><?php echo isset($user['common']['name'])?($user['common']['name']):("var[user['common']['name']]"); ?></td>
                    </tr>
                    <tr>
                        <td width="100px">
                            帐号(UID)
                        </td>
                        <td>
                            <?php echo isset($user['common']['uid'])?($user['common']['uid']):("var[user['common']['uid']]"); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            南大学生
                        </td>
                        <td>
                            已认证✅
                        </td>
                    </tr>
                    <!--<?php if($_G['user']['identification']['verified'] > 5 && isset($user['verify']['mail'])){ ?>-->
                    <tr>
                        <td>
                            邮箱
                        </td>
                        <td>
                            <?php echo isset($user['verify']['mail'])?($user['verify']['mail']):(""); ?>
                        </td>
                    </tr>
                    <!--<?php } ?>-->
                    <!--<?php if($private <= $user['private']['mySid']){ ?>-->
                    <tr>
                        <td>
                            学号
                        </td>
                        <td>
                            <?php echo isset($user['common']['mobile'])?($user['common']['mobile']):(""); ?>
                        </td>
                    </tr>
                    <!--<?php } ?>-->
                    <tr>
                        <td>
                            故乡
                        </td>
                        <td id="guxiang">
                            <?php if($user['profile']['guxiang']){ ?>
                            <?php echo isset($user['profile']['guxiang'])?($user['profile']['guxiang']):("var[user['profile']['guxiang']]"); ?>
                            <?php }else{ ?>
                            暂未填写
                            <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            院系专业
                        </td>
                        <td id="yuanxi">
                            <?php if($user['profile']['yuanxi']){ ?>
                            <?php echo isset($user['profile']['yuanxi'])?($user['profile']['yuanxi']):("var[user['profile']['yuanxi']]"); ?>
                            <?php }else{ ?>
                            暂未填写
                            <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            生日
                        </td>
                        <td id="birthday">
                            <?php if($user['profile']['birthday']){ ?>
                            <?php echo isset($user['profile']['birthday'])?($user['profile']['birthday']):("var[user['profile']['birthday']]"); ?>
                            <?php }else{ ?>
                            暂未填写
                            <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            爱好
                        </td>
                        <td id="favorite">
                            <?php if($user['profile']['favorite']){ ?>
                            <?php echo isset($user['profile']['favorite'])?($user['profile']['favorite']):("var[user['profile']['favorite']]"); ?>
                            <?php }else{ ?>
                            暂未填写
                            <?php } ?>
                        </td>
                    </tr>
                    <tr hidden>
                        <td width="100px">
                            性别
                        </td>
                        <td id="sex">
                            <?php if($user['profile']['sex']){ ?>
                            <?php echo isset($user['profile']['sex'])?($user['profile']['sex']):("var[user['profile']['sex']]"); ?>
                            <?php }else{ ?>
                            暂未填写
                            <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <td width="100px">
                            性别
                        </td>
                        <td id="gender">
                            <?php if($user['profile']['gender'] == 2){ ?>
                            男
                            <?php if($user['common']['uid'] == $_G['user']['uid']){ ?>
                            <a href="index.php?mod=user&action=profile&uid=<?php echo isset($user['common']['uid'])?($user['common']['uid']):(""); ?>&setgender=1">
                                <font color="#ff7f50">修改</font>
                            </a>
                            <?php } ?>
                            <?php }elseif($user['profile']['gender'] == 1){ ?>
                            女
                            <?php if($user['common']['uid'] == $_G['user']['uid']){ ?>
                            <a href="index.php?mod=user&action=profile&uid=<?php echo isset($user['common']['uid'])?($user['common']['uid']):(""); ?>&setgender=2">
                                <font color="#ff7f50">修改</font>
                            </a>
                            <?php } ?>
                            <?php }else{ ?>
                            暂未设置
                            <?php if($user['common']['uid'] == $_G['user']['uid']){ ?>(
                            <a href="index.php?mod=user&action=profile&uid=<?php echo isset($user['common']['uid'])?($user['common']['uid']):(""); ?>&setgender=2">
                                <font color="#ff7f50">男</font>
                            </a>/
                            <a href="index.php?mod=user&action=profile&uid=<?php echo isset($user['common']['uid'])?($user['common']['uid']):(""); ?>&setgender=1">
                                <font color="#ff7f50">女</font>
                            </a>)
                            <?php } ?>
                            <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            个性签名
                        </td>
                        <td id="words">
                            <?php if($user['profile']['words']){ ?>
                            <?php echo isset($user['profile']['words'])?($user['profile']['words']):("var[user['profile']['words']]"); ?>
                            <?php }else{ ?>
                            暂未填写
                            <?php } ?>
                        </td>
                    </tr>
                <!--<?php if($private <= $user['private']['myOnline']){ ?>-->
                    <tr>
                        <td>
                            在线时间
                        </td>
                        <td>
                            <?php echo isset($user['online']['hours'])?($user['online']['hours']):(""); ?>小时
                        </td>
                    </tr>
                    <tr>
                        <td>
                            上次在线
                        </td>
                        <td>
                            <?php echo isset($user['online']['last_online'])?($user['online']['last_online']):(""); ?>
                        </td>
                    </tr>
                <!--<?php } ?>--->
                </table>
        </div>
        <br><br>
        <?php if($_G['user']['uid'] == $user['common']['uid']){ ?>
        <div class="home_profile">
            <h4>个性设置</h4>
            <hr size="1">
            <table style="padding-top: 12px; padding-left: 6px; font-size: 14px; color: #5f646e; z-index: 9999;">
                <tr>
                    <td width="100px" class="set_menu_header">
                        我的皮肤
                    </td>
                    <td width="200px">
                        <select class="set_menu" id="set_style" onchange="settings('style', this.value)">
                            <option value="1" <?php if($_G['user']['style'] == "nju2021" || $_G['user']['style'] == "day"){ ?>selected<?php } ?>>诚朴紫</option>
                            <option value="2" <?php if($_G['user']['style'] == "NewYear2021"){ ?>selected<?php } ?>>贺岁牛</option>
                            <option value="3" <?php if($_G['user']['style'] == "day2021"){ ?>selected<?php } ?>>阳间人</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td colspan="2" class="set_menu_header">
                        <table width="100%">
                            <tr>
                                <td width="20%" align="center" onclick="settings('style', '1')">
                                    <img src="static/img/2021/nju2021.jpg" class="usermenu_item" style="border: 1px dashed #793c65">
                                </td>
                                <td width="20%" align="center" onclick="settings('style', '2')">
                                    <img src="static/img/2021/NewYear2021.jpg" class="usermenu_item" style="border: 1px dashed #c30000">
                                </td>
                                <td width="20%" align="center" onclick="settings('style', '3')">
                                    <img src="static/img/2021/day2021.png" class="usermenu_item" style="border: 1px dashed #cccccc">
                                </td>
                                <td width="20%" align="center">
                                    <img src="static/img/2021/eve2021.jpg" class="usermenu_item" style="border: 1px dashed black">
                                </td>
                                <td width="20%" align="center">
                                    <img src="static/img/2021/Cat2021.jpg" class="usermenu_item" style="border: 1px dashed #e1bbff">
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <tr>
                    <td colspan="2" class="set_menu_header">
                        主页照片墙(最多展示<?php echo isset($_G['user']['ext']['photos'])?($_G['user']['ext']['photos']):(""); ?>张)
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <div id="photo_wall">
                            <?php foreach($photo_wall as $key => $value){ ?>
                                <a>
                                    <img src="<?php echo isset($value)?($value):(""); ?>" alt="" width="100%" />
                                </a><br><br>
                            <?php } ?>
                        </div>
                        <a href="javascript:document.getElementById('files').click();">
                            <div class="home_btn">
                                新增主页照片
                                <input type="file" id="files" hidden onchange="post_IndexPhoto();">
                            </div>
                        </a>
                    </td>
                </tr>

                <!--
                <tr>
                    <td width="100px" class="set_menu_header">
                        允许关注
                    </td>
                    <td width="200px">
                        <select class="set_menu" onchange="set_private('allowFollow', this.value)">
                            <option value="0" <?php if($user['private']['allowFollow'] == 0){ ?>selected<?php } ?>>所有人</option>
                            <option value="1" <?php if($user['private']['allowFollow'] == 1){ ?>selected<?php } ?>>仅可通过推荐关注我</option>
                            <option value="2" <?php if($user['private']['allowFollow'] == 2){ ?>selected<?php } ?>>禁止关注</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td width="100px" class="set_menu_header">
                        允许被推荐
                    </td>
                    <td width="200px">
                        <select class="set_menu" onchange="set_private('allowRecommend', this.value)">
                            <option value="0" <?php if($user['private']['allowRecommend'] == 0){ ?>selected<?php } ?>>任何人(含系统)</option>
                            <option value="1" <?php if($user['private']['allowRecommend'] == 1){ ?>selected<?php } ?>>双向关注</option>
                            <option value="2" <?php if($user['private']['allowRecommend'] == 2){ ?>selected<?php } ?>>仅自己可以</option>
                        </select>
                    </td>
                </tr>-->
            </table>
        </div>
        <br><br>
        <div class="home_profile">
            <h4>隐私设置</h4>
            <hr size="1">
            <table style="padding-top: 12px; padding-left: 6px; font-size: 14px; color: #5f646e; z-index: 9999;">
                <!--<tr>
                    <td width="100px" class="set_menu_header">
                        关注名单
                    </td>
                    <td width="200px">
                        <select class="set_menu" onchange="set_private('myFollow', this.value)">
                            <option value="0" <?php if($user['private']['myFollow'] == 0){ ?>selected<?php } ?>>仅自己可见</option>
                            <option value="1" <?php if($user['private']['myFollow'] == 1){ ?>selected<?php } ?>>双向关注可见</option>
                            <option value="2" <?php if($user['private']['myFollow'] == 2){ ?>selected<?php } ?>>公开</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td width="100px" class="set_menu_header">
                        粉丝名单
                    </td>
                    <td width="200px">
                        <select class="set_menu" onchange="set_private('myFans', this.value)">
                            <option value="0" <?php if($user['private']['myFans'] == 0){ ?>selected<?php } ?>>仅自己可见</option>
                            <option value="1" <?php if($user['private']['myFans'] == 1){ ?>selected<?php } ?>>双向关注可见</option>
                            <option value="2" <?php if($user['private']['myFans'] == 2){ ?>selected<?php } ?>>公开</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td width="100px" class="set_menu_header">
                        访客名单
                    </td>
                    <td width="200px">
                        <select class="set_menu" onchange="set_private('myVisitors', this.value)">
                            <option value="0" <?php if($user['private']['myVisitors'] == 0){ ?>selected<?php } ?>>仅自己可见</option>
                            <option value="1" <?php if($user['private']['myVisitors'] == 1){ ?>selected<?php } ?>>双向关注可见</option>
                            <option value="2" <?php if($user['private']['myVisitors'] == 2){ ?>selected<?php } ?>>公开</option>
                        </select>
                    </td>
                </tr>-->

                <tr>
                    <td width="100px" class="set_menu_header">
                        在线信息
                    </td>
                    <td width="200px">
                        <select class="set_menu" onchange="set_private('myOnline', this.value)">
                            <option value="0" <?php if($user['private']['myOnline'] == 0){ ?>selected<?php } ?>>仅自己可见</option>
                            <option value="1" <?php if($user['private']['myOnline'] == 1){ ?>selected<?php } ?>>双向关注可见</option>
                            <option value="2" <?php if($user['private']['myOnline'] == 2){ ?>selected<?php } ?>>公开</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td width="100px" class="set_menu_header">
                        我的学号
                    </td>
                    <td width="200px">
                        <select class="set_menu" onchange="set_private('mySid', this.value)">
                            <option value="0" <?php if($user['private']['mySid'] == 0){ ?>selected<?php } ?>>仅自己可见</option>
                            <option value="1" <?php if($user['private']['mySid'] == 1){ ?>selected<?php } ?>>双向关注可见</option>
                            <option value="2" <?php if($user['private']['mySid'] == 2){ ?>selected<?php } ?>>公开</option>
                        </select>
                    </td>
                </tr>

                <!--
                <tr>
                    <td width="100px" class="set_menu_header">
                        允许关注
                    </td>
                    <td width="200px">
                        <select class="set_menu" onchange="set_private('allowFollow', this.value)">
                            <option value="0" <?php if($user['private']['allowFollow'] == 0){ ?>selected<?php } ?>>所有人</option>
                            <option value="1" <?php if($user['private']['allowFollow'] == 1){ ?>selected<?php } ?>>仅可通过推荐关注我</option>
                            <option value="2" <?php if($user['private']['allowFollow'] == 2){ ?>selected<?php } ?>>禁止关注</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td width="100px" class="set_menu_header">
                        允许被推荐
                    </td>
                    <td width="200px">
                        <select class="set_menu" onchange="set_private('allowRecommend', this.value)">
                            <option value="0" <?php if($user['private']['allowRecommend'] == 0){ ?>selected<?php } ?>>任何人(含系统)</option>
                            <option value="1" <?php if($user['private']['allowRecommend'] == 1){ ?>selected<?php } ?>>双向关注</option>
                            <option value="2" <?php if($user['private']['allowRecommend'] == 2){ ?>selected<?php } ?>>仅自己可以</option>
                        </select>
                    </td>
                </tr>-->
            </table>
        </div>
        <br><br>
        <?php } ?>
        <?php if($show_photos == 0){ ?>
        <?php for($i = 0; $i < 1; $i++){ ?>
        <a>
            <img src="static/img/profile_img/<?php echo isset($img[$i])?($img[$i]):("var[img[$i]]"); ?>.jpg" alt="" width="100%" style="border-radius: 12px" />
        </a>
        <?php } ?>
        <?php }else{ ?>
        <?php foreach($photo_wall as $key => $value){ ?>
        <a>
            <img src="<?php echo isset($value)?($value):(""); ?>" alt="" width="100%" style="border-radius: 12px" />
        </a><br><br>
        <?php } ?>
        <?php } ?>
        <br>
        <!--<?php if($_G['user']['identification']['verified'] > 5){ ?>-->
        <br>
        <div class="home_profile">
            <h4>🔒管理菜单</h4>
            <table width="100%">
                <tr>
                    <td>
                        <a href="index.php?mod=square&action=match&do=admin_Love&uid=<?php echo isset($user['common']['uid'])?($user['common']['uid']):(""); ?>">
                            <div class="home_btn">
                                七日情侣
                            </div>
                        </a>
                    </td>
                    <td>
                        <a href="javascript:alert('先私戳ycc，这个功能等ycc肝完再说。');">
                            <div class="home_btn">
                                封禁用户
                            </div>
                        </a>
                    </td>
                </tr>
            </table>
        </div>
        <!--<?php } ?>-->
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
    </div>
</div>
<?php if($_G['user']['uid'] == $user['common']['uid']){ ?>
<div style="background: rgba(255,255,255,0.6); padding: 12px; position: fixed; bottom: 12px; left: 20px; border-radius: 16px; width: calc(100% - 40px);">

    <table width="100%">
        <tr>
            <td align="center">
                <a href="index.php?mod=square&r=<?php echo rand(1,10000); ?> "><div class="usermenu_item">
                    <img src="static/img/logo_cat.png" width="48px" height="48px">
                </div></a>
            </td>
            <td align="center">
                <a href="index.php?mod=rankList_class&r=<?php echo rand(1,10000); ?>">
                    <img src="static/img/class_logo.png" class="usermenu_item">
                </a>
            </td>
            <td align="center">
                <a href="index.php?mod=working&r=<?php echo rand(1,10000); ?>">
                    <div class="usermenu_item">
                        💼
                    </div>
                </a>
            </td>
        </tr>
        <tr>
            <td align="center" class="menu_title">
                <a href="index.php?mod=square&r=<?php echo rand(1,10000); ?>">
                    <font color="#793c65">社交广场</font>
                </a>
            </td>
            <td align="center" class="menu_title">
                <a href="index.php?mod=rankList_class&r=<?php echo rand(1,10000); ?>"><font color="#793c65">课程红榜</font></a>
            </td>
            <td align="center" class="menu_title">
                <a href="index.php?mod=working&r= <?php echo rand(1,10000); ?>">
                    <font color="#793c65">工作台</font>
                </a>
            </td>
        </tr>
    </table>
</div>
<?php } ?>
</body>
<script src="static/js/common_post_image.js?r=1036"></script>
<script src="static/js/home_attention.js?r=1036"></script>
<script src="static/js/home_settings.js?r=1036"></script>
<script>
    $('.gallery').magnificPopup({
        delegate: 'a',
        type: 'image',
        gallery: {
            enabled: true
        }
    })
</script>
<script>
    var post = 0;
    function edit() {
        var xmlhttp_Edit;
        var name_post;
        var name_init;

        var guxiang_post;
        var guxiang_init;

        var yuanxi_post;
        var yuanxi_init;

        var birthday_post;
        var birthday_init;

        var favorite_post;
        var favorite_init;

        var sex_post;
        var sex_init;

        var words_post;
        var words_init;

        if (post == 0) {
            post = 1;
            document.getElementById('btn').innerHTML = '　保存设置　';

            name_init = document.getElementById('name').innerHTML.replace(/^\s+|\s+$/g, '');
            if (name_init == '暂未填写') {
                document.getElementById('name').innerHTML = "<input id='name_input' class='inputtext' placeholder='暂未填写'>";
            } else {
                document.getElementById('name').innerHTML = "<input id='name_input' class='inputtext' value='" + name_init +"'>";
            }

            guxiang_init = document.getElementById('guxiang').innerHTML.replace(/^\s+|\s+$/g, '');
            if (guxiang_init == '暂未填写') {
                document.getElementById('guxiang').innerHTML = "<input id='guxiang_input' class='inputtext' placeholder='暂未填写'>";
            } else {
                document.getElementById('guxiang').innerHTML = "<input id='guxiang_input' class='inputtext' value='" + guxiang_init +"'>";
            }

            yuanxi_init = document.getElementById('yuanxi').innerHTML.replace(/^\s+|\s+$/g, '');
            if (yuanxi_init == '暂未填写') {
                document.getElementById('yuanxi').innerHTML = "<input id='yuanxi_input' class='inputtext' placeholder='暂未填写'>";
            } else {
                document.getElementById('yuanxi').innerHTML = "<input id='yuanxi_input' class='inputtext' value='" + yuanxi_init +"'>";
            }

            birthday_init = document.getElementById('birthday').innerHTML.replace(/^\s+|\s+$/g, '');
            if (birthday_init == '暂未填写') {
                document.getElementById('birthday').innerHTML = "<input id='birthday_input' class='inputtext' placeholder='暂未填写'>";
            } else {
                document.getElementById('birthday').innerHTML = "<input id='birthday_input' class='inputtext' value='" + birthday_init +"'>";
            }

            favorite_init = document.getElementById('favorite').innerHTML.replace(/^\s+|\s+$/g, '');
            if (favorite_init == '暂未填写') {
                document.getElementById('favorite').innerHTML = "<input id='favorite_input' class='inputtext' placeholder='暂未填写'>";
            } else {
                document.getElementById('favorite').innerHTML = "<input id='favorite_input' class='inputtext' value='" + favorite_init +"'>";
            }

            sex_init = document.getElementById('sex').innerHTML.replace(/^\s+|\s+$/g, '');
            if (sex_init == '暂未填写') {
                document.getElementById('sex').innerHTML = "<input id='sex_input' class='inputtext' placeholder='暂未填写'>";
            } else {
                document.getElementById('sex').innerHTML = "<input id='sex_input' class='inputtext' value='" + sex_init +"'>";
            }

            words_init = document.getElementById('words').innerHTML.replace(/^\s+|\s+$/g, '');
            if (words_init == '暂未填写') {
                document.getElementById('words').innerHTML = "<input id='words_input' class='inputtext' placeholder='暂未填写'>";
            } else {
                document.getElementById('words').innerHTML = "<input id='words_input' class='inputtext' value='" + words_init +"'>";
            }

        } else {
            post = 0;
            document.getElementById('btn').innerHTML = '修改个人信息';
            if (document.getElementById('name_input').value) {
                name_post = document.getElementById('name_input').value;
                document.getElementById('name').innerHTML = name_post;
            } else {
                name_post = '';
                document.getElementById('name').innerHTML = '暂未填写';
            }

            if (document.getElementById('guxiang_input').value) {
                guxiang_post = document.getElementById('guxiang_input').value;
                document.getElementById('guxiang').innerHTML = guxiang_post;
            } else {
                guxiang_post = '';
                document.getElementById('guxiang').innerHTML = '暂未填写';
            }

            if (document.getElementById('yuanxi_input').value) {
                yuanxi_post = document.getElementById('yuanxi_input').value;
                document.getElementById('yuanxi').innerHTML = yuanxi_post;
            } else {
                yuanxi_post = '';
                document.getElementById('yuanxi').innerHTML = '暂未填写';
            }

            if (document.getElementById('birthday_input').value) {
                birthday_post = document.getElementById('birthday_input').value;
                document.getElementById('birthday').innerHTML = birthday_post;
            } else {
                birthday_post = '';
                document.getElementById('birthday').innerHTML = '暂未填写';
            }

            if (document.getElementById('favorite_input').value) {
                favorite_post = document.getElementById('favorite_input').value;
                document.getElementById('favorite').innerHTML = favorite_post;
            } else {
                favorite_post = '';
                document.getElementById('favorite').innerHTML = '暂未填写';
            }

            if (document.getElementById('sex_input').value) {
                sex_post = document.getElementById('sex_input').value;
                document.getElementById('sex').innerHTML = sex_post;
            } else {
                sex_post = '';
                document.getElementById('sex').innerHTML = '暂未填写';
            }

            if (document.getElementById('words_input').value) {
                words_post = document.getElementById('words_input').value;
                document.getElementById('words').innerHTML = words_post;
            } else {
                words_post = '';
                document.getElementById('words').innerHTML = '暂未填写';
            }

            if (window.XMLHttpRequest) {
                xmlhttp_Edit = new XMLHttpRequest();
            } else {
                xmlhttp_Edit = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp_Edit.onreadystatechange = function () {
                return;
            };
            xmlhttp_Edit.open("GET",
                "index.php?mod=php_api&action=user_profile&func=update"
                + "&name=" + name_post
                + "&guxiang=" + guxiang_post
                + "&yuanxi=" + yuanxi_post
                + "&birthday=" + birthday_post
                + "&favorite=" + favorite_post
                + "&sex=" + sex_post
                + "&words=" + words_post);
            xmlhttp_Edit.send();
        }
    }
</script>
<script>
    setTimeout(function () {
        document.getElementById("home-cover").style.display = "none";
    }, 2000);
</script>
</html>
