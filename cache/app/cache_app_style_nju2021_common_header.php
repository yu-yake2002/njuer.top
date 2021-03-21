<?php /*自动生成的模板文件_*/
if(!defined("IS_INCLUDED")) die('Access denied!'); ?>
<link rel="stylesheet" href="./template_app/css/jquery-weui.min.css?r=201">
<link rel="stylesheet" href="./template_app/css/weui.min.css?r=201">
<link rel="stylesheet" href="./template_app/style/nju2021/css/common.css?r=201">
<link rel="stylesheet" href="./template_app/style/nju2021/css/common_card.css?r=201">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
<script src="./static/js/jquery.min.js?r=201"></script>
<script src="./static/js/jquery-weui.min.js?r=201"></script>
<script src="./static/js/weui.min.js?r=201"></script>
<script src="./static/js/common.js?r=201"></script>
<script src="./static/js/common_credits.js?r=201"></script>
<meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"
/>

<?php if(time() <= 1607875200){ ?>
<style>
    html{
        FILTER: gray;
        -webkit-filter: grayscale(100%);
    }
    .xuanfu{
        width: 100px;
        position: fixed;
        z-index: 9999999999999999999;
        border-radius: 12px;
        right: 12px;
        bottom: 100px;
    }
</style>
<img src="static/img/njdts.png" class="xuanfu">
<?php } ?>

<!--
<?php if($_GET['mod'] == 'rankList_class'){ ?>
<a href="index.php?mod=HMGet" class="usermenu_btn"></a>
<?php } ?>
<?php if($_GET['mod'] == 'HMGet'){ ?>
<a href="index.php?mod=rankList_class" class="usermenu_btn"></a>
<?php } ?>-->
<?php if($_G['user']['loginned'] && !$_G['FullScreen']){ ?>
<a href="javascript:;" style="display: none" onclick="document.getElementById('usermenu').style.display='';">
    <img src="static/img/logo.png" class="usermenu_btn">
</a>
<div id="usermenu" style="display: none" class="usermenu_list">
    <table width="100%">
        <tr>
            <td colspan="4" class="menu_title">
                <table width="100%" style="border-bottom: 1px solid #793c65">
                    <tr>
                        <td>
                            　
                        </td>
                        <td>
                            <img src="static/img/logo.png" class="logo_icon">
                        </td>
                        <td class="menu_title" width="100%">
                            当前UID: <?php echo isset($_G['user']['uid'])?($_G['user']['uid']):(""); ?>
                            <?php if($_G['user']['style'] != "eve"){ ?>
                            <a href="<?php echo isset($_CORE['uri'])?($_CORE['uri']):(""); ?>&style=eve"><font color="#793c65">🌙夜间</font></a>
                            <?php } ?>
                            <?php if($_G['user']['style'] != "day"){ ?>
                            <a href="<?php echo isset($_CORE['uri'])?($_CORE['uri']):(""); ?>&style=day"><font color="#793c65">☀日间</font></a>
                            <?php } ?>
                            <a href="index.php?mod=user&action=exit"><font color="#793c65">退出</font></a>
                        </td>
                        <td class="menu_title" onclick="document.getElementById('usermenu').style.display='none';">
                            —　
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td align="center">
                <a href="index.php?mod=square&r=<?php echo rand(1,10000); ?> "><div class="usermenu_item">
                    <img src="static/img/logo_cat.png" width="44px" height="44px">
                </div></a>
            </td>
            <td align="center">
                <a href="index.php?mod=HMGet&r=<?php echo rand(1,10000); ?>"><div class="usermenu_item">
                    🖐
                </div></a>
            </td>
            <td align="center">
                <a href="index.php?mod=rankList_class&r=<?php echo rand(1,10000); ?>"><div class="usermenu_item">
                    📚
                </div></a>
            </td>
            <td align="center">
                <a href="index.php?mod=map&r=<?php echo rand(1,10000); ?>"><div class="usermenu_item">
                    🗺
                </div></a>
            </td>
        </tr>
        <tr>
            <td align="center" class="menu_title">
                <a href="index.php?mod=square&r=<?php echo rand(1,10000); ?>">
                    <font color="#793c65">社交广场</font>
                </a>
            </td>
            <td align="center" class="menu_title">
                <a href="index.php?mod=HMGet&r=<?php echo rand(1,10000); ?>"><font color="#793c65">帮捎一件</font></a>
            </td>
            <td align="center" class="menu_title">
                <a href="index.php?mod=rankList_class&r=<?php echo rand(1,10000); ?>"><font color="#793c65">课程红榜</font></a>
            </td>
            <td align="center" class="menu_title">
                <a href="index.php?mod=map&r=<?php echo rand(1,10000); ?>"><font color="#793c65">南哪地图</font></a>
            </td>
        </tr>
        <tr>
            <td align="center">
                <a href="index.php?mod=working&r=<?php echo rand(1,10000); ?>">
                    <div class="usermenu_item">
                        💼
                    </div>
                </a>
            </td>
            <td align="center">
                <a href="index.php?mod=mall&r=<?php echo rand(1,10000); ?>">
                    <div class="usermenu_item">
                        🛒
                    </div>
                </a>
            </td>
            <td align="center">
                <a href="index.php?mod=nju_docs&r=<?php echo rand(1,10000); ?>">
                    <div class="usermenu_item">
                        南
                    </div>
                </a>
            </td>
            <td align="center">
                <div class="usermenu_item">
                    ？
                </div>
            </td>
        </tr>
        <tr>
            <td align="center" class="menu_title">
                <a href="index.php?mod=working&r=<?php echo rand(1,10000); ?>">
                    <font color="#793c65">工作台</font>
                </a>
            </td>
            <td align="center" class="menu_title">
                <a href="index.php?mod=mall&r=<?php echo rand(1,10000); ?>">
                    <font color="#793c65">积分商城</font>
                </a>
            </td>
            <td align="center" class="menu_title">
                <a href="index.php?mod=nju_docs&r= <?php echo rand(1,10000); ?>">
                    <font color="#793c65">传承南大</font>
                </a>
            </td>
            <td align="center" class="menu_title">
                敬请期待
            </td>
        </tr>
        <tr>
            <td align="center">
                <div class="usermenu_item">
                    ？
                </div>
            </td>
            <td align="center">
                <div class="usermenu_item">
                    ？
                </div>
            </td>
            <td align="center">
                <div class="usermenu_item">
                    ？
                </div>
            </td>
            <td align="center">
                <div class="usermenu_item">
                    ？
                </div>
            </td>
        </tr>
        <tr>
            <td align="center" class="menu_title">
                敬请期待
            </td>
            <td align="center" class="menu_title">
                敬请期待
            </td>
            <td align="center" class="menu_title">
                敬请期待
            </td>
            <td align="center" class="menu_title">
                敬请期待
            </td>
        </tr>
    </table>
</div>
<?php } ?>
<?php if(isset($ban) && $ban && time() < $ban['ban']){ ?>
<script>
    function ban() {
        $.alert({
            text: "<font color=\"red\">您的帐号已被封停，<?php echo formatTime($ban['ban']); ?>后解封。</font>封号理由: <?php echo isset($ban['reason'])?($ban['reason']):(""); ?>",
            onOK: function () {
                location.href = "index.php?mod=user&action=exit";
            }
        });
        return;
    }
    ban();
</script>
<?php exit(); ?>
<?php } ?>
<?php if($_G['user']['loginned']){ ?>
<script>
    function Android_getUid() {
        return "<?php echo isset($_G['user']['uid'])?($_G['user']['uid']):(""); ?>,-2,<?php echo isset($Android_msg_token)?($Android_msg_token):(""); ?>";
    }
</script>
<?php }else{ ?>
<script>
    function Android_getUid() {
        return "NotLoginned!";
    }
</script>
<?php } ?>