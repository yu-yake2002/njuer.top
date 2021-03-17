<?php /*自动生成的模板文件_*/
if(!defined("IS_INCLUDED")) die('Access denied!'); ?>
<?php include template("app/common:header"); ?>
<style>
    html{
        padding: 12px;
    }
    .chat-main{
        position: absolute;
        top: 50%;
        left: 50%;
        z-index: 999;
        text-align: center;
        padding: 4% 2%;
        width: 60%;
        transform: translate(-50%,-50%);
        background: rgba(255,255,255,0.04);
        box-shadow: -1px 4px 28px 0px rgba(0,0,0,0.75);
    }

    .chat-subcontent{
        overflow-y: scroll;
        height: inherit;
        width: 100%;
    }
    .chat-subcontent::-webkit-scrollbar
    {
        border-radius: 10px;
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
        background-color: #ccc;
    }
    .chat-subcontent::-webkit-scrollbar-thumb
    {
        border-radius: 10px;
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
        background-color: #555;
    }

    .chat-bubble{
        position: relative;
        margin-right: 12px;
        color: #efdab7;
        font-weight: bold;
        background-color: #efdab7;
        border-color: #efdab7;
        display: block;
        border: 1px solid;
        border-radius: 4px;
        padding: 2px;
    }
    .chat-bubble::before{
        content: ' ';
        display: block;
        border-right:7px solid #efdab7;
        border-left:7px solid  transparent;
        border-top:7px solid  transparent;
        border-bottom: 7px solid transparent;
        width: 0px;
        height: 0px;
        position: absolute;
        top:4px;
        left:-14px;
        z-index: 3;
    }
    .chat-bubble::after{
        content: ' ';
        display: block;
        border-right:8px solid transparent;
        border-left:8px solid transparent;
        border-top:8px solid transparent;
        border-bottom: 8px solid transparent;
        width: 0px;
        height: 0px;
        position: absolute;
        top:3px;
        left:-16.5px;
        z-index: 2;
    }
    ::-webkit-scrollbar
    {
        border-radius: 10px;
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
        background-color: #ccc;
    }
    ::-webkit-scrollbar-thumb
    {
        border-radius: 10px;
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
        background-color: #555;
    }
    .usermenu{
        z-index:9999999;
        position: fixed;
        width: 80px;
        height: 100%;
        text-align: center;
        top: 0;
        left: 0;
        margin: 0 auto;
        color: white;
        border: 1px solid #000;
        background: rgba(14,14,14,0.75);
        line-height: 28px;
    }
    a{
        text-decoration:none;
        color: black;
    }
    @keyframes fade {
        from {
            opacity: 1.0;
        }
        50% {
            opacity: 0.4;
        }
        to {
            opacity: 1.0;
        }
    }

    @-webkit-keyframes fade {
        from {
            opacity: 1.0;
        }
        50% {
            opacity: 0.4;
        }
        to {
            opacity: 1.0;
        }
    }
    .headerBox {
        color: #fff;
        padding: 10px;
        font-size: 15px;
        animation: fade 800ms infinite;
        -webkit-animation: fade 800ms infinite;
    }
    .on_window{
        position: fixed;
        right: 5%;
        width: 25%;
        height: 90%;
        top:5%;
        z-index: 9999999999999;
        background-color: white;
        margin: 0 auto;
        border: 2px dashed #ccc;
    }
    .on_window1{
        position: fixed;
        right: 20%;
        width: 60%;
        height: 60%;
        top: 20%;
        z-index: 9999999999999;
        background-color: white;
        margin: 0 auto;
        border: 2px dashed #ccc;
    }
    .on_window2{
        position: fixed;
        right: 37.5%;
        width: 25%;
        height: 60%;
        top: 20%;
        z-index: 9999999999999;
        background-color: white;
        margin: 0 auto;
        border: 2px dashed #ccc;
    }
    .on_window3 {
        position: fixed;
        right: 37.5%;
        width: 25%;
        height: 96%;
        top: 2%;
        z-index: 9999999999999;
        background-color: white;
        margin: 0 auto;
        border: 2px dashed #ccc;
    }
    body{
        background-color: #fcf6ea;
    }
</style>
<link rel="stylesheet" href="./template_app/css/rankList_class.css?r=1737">
<script src="static/js/class_remark.js?r=1737"></script>
<div class="weui-cell">
    <div class="weui-cell__bd" style="color: #793c65">
        <strong><?php echo isset($classinfo['name'])?($classinfo['name']):("var[classinfo['name']]"); ?></strong>
    </div>
</div>
<div class="weui-cell">
    <div class="weui-cell__bd">授课老师: <?php echo isset($classinfo['teacher'])?($classinfo['teacher']):("var[classinfo['teacher']]"); ?></div>
</div>
<div class="weui-cell">
    课程号: <?php echo isset($classinfo['num'])?($classinfo['num']):("var[classinfo['num']]"); ?> (学分: <?php echo isset($classinfo['credits'])?($classinfo['credits']):("var[classinfo['credits']]"); ?>，<?php echo $classinfo['isgeneral']?"计入14学分":"不计入14学分";?>)
</div>

<?php if(!$classinfo_ext){ ?>
<p align="left" style="font-size: 14px; padding: 16px; ">
    目前还没有人对这门课给出任何评价哦
</p>
<?php }else{ ?>
<h3 style="padding-left: 12px; line-height: 40px; color: #793c65">考核方式</h3>
<p align="left" style="padding-left: 24px">
    <?php echo (isset($classinfo_ext['exam']) && $classinfo_ext['exam'])?$classinfo_ext['exam']:"暂缺"; ?>
    （<a href="javascript:RemarkClass(<?php echo isset($_GET['ClassId'])?($_GET['ClassId']):("var[_GET['ClassId']]"); ?>);">点击参与评价</a>）
</p>


<h3 style="padding-left: 12px; line-height: 40px; color: #793c65">课程指标</h3>
<table width="100%" style="padding-left: 24px">
    <tr>
        <td>
            往年均分
        </td>
        <td width="70%">
            <div style="background: rgb(<?php echo round(min(102 * (5 - $classinfo_ext['marks']), 255) * 0.9, 0); ?>, <?php echo round(min(102 * $classinfo_ext['marks'], 255) * 0.9, 0); ?>, 0);width:<?php echo round(20 * $classinfo_ext['marks'], 0); ?>%;height: 16px;border-top-right-radius: 4px; border-bottom-right-radius: 4px; font-size: 12px;">
                <font color="#fff"><strong><?php echo round(class_givemark($classinfo_ext['marks']), 2); ?></strong></font>
            </div>
        </td>
    </tr>
    <tr>
        <td>
            课外耗时
        </td>
        <td>
            <div style="background: rgb(<?php echo round(min(102 * (5 - $classinfo_ext['costtime']) * 0.9, 255), 0); ?>, <?php echo round(min(102 * $classinfo_ext['costtime'], 255) * 0.9, 0); ?>, 0);width:<?php echo round(20 * $classinfo_ext['costtime'], 0); ?>%;height: 16px;border-top-right-radius: 4px; border-bottom-right-radius: 4px; font-size: 12px;">
                <font color="white"><?php echo class_discribe_costtime($classinfo_ext['costtime']); ?>/周</font>
            </div>
        </td>
    </tr>
    <tr>
        <td>
            知识难度
        </td>
        <td>
            <div style="background: rgb(<?php echo round(min(102 * (5 - $classinfo_ext['knowledge']), 255) * 0.9, 0); ?>, <?php echo round(min(102 * $classinfo_ext['knowledge'], 255) * 0.9, 0); ?>, 0);width:<?php echo round(20 * (5 - $classinfo_ext['knowledge']), 0); ?>%;height: 16px;border-top-right-radius: 4px; border-bottom-right-radius: 4px; font-size: 12px;"></div>
        </td>
    </tr>
    <tr>
        <td>
            老师讲课
        </td>
        <td>
            <div style="background: rgb(<?php echo round(min(102 * (5 - $classinfo_ext['teacher']), 255) * 0.9, 0); ?>, <?php echo round(min(102 * $classinfo_ext['teacher'], 255) * 0.9, 0); ?>, 0);width:<?php echo round(20 * $classinfo_ext['teacher'], 0); ?>%;height: 16px;border-top-right-radius: 4px; border-bottom-right-radius: 4px; font-size: 12px;"></div>
        </td>
    </tr>
    <tr>
        <td>
            课程收获
        </td>
        <td>
            <div style="background: rgb(<?php echo round(min(102 * (5 - $classinfo_ext['gains']), 255) * 0.9, 0); ?>, <?php echo round(min(102 * $classinfo_ext['gains'], 255) * 0.9, 0); ?>, 0);width:<?php echo round(20 * $classinfo_ext['gains'], 0); ?>%;height: 16px;border-top-right-radius: 4px; border-bottom-right-radius: 4px; font-size: 12px;"></div>
        </td>
    </tr>
</table>
<?php } ?>


<table width="100%" style="padding: 24px 0">
    <tr>
        <td>
            <a style="background-color: #793c65" href="javascript:RemarkClass(<?php echo isset($_GET['ClassId'])?($_GET['ClassId']):("var[_GET['ClassId']]"); ?>);" class="weui-btn weui-btn_primary">参与评价</a>
        </td>
        <td>
            <a style="background-color: #efdab7" href="javascript:history.back();" class="weui-btn weui-btn_default">返回列表</a>
        </td>
    </tr>
</table>


<h3 style="padding-left: 12px; line-height: 40px; color: #793c65">课程评价</h3>
<?php while($row = db_fetch($remark)){ ?>
<table style="padding-left: 12px">
    <tr>
        <?php             $user_profile = get_user($row['uid']);
        ?>
        <td align="center" width="48" rowspan="2" style="vertical-align: top;">
            <a href="index.php?mod=user&action=profile&uid=<?php echo isset($user_profile['common']['uid'])?($user_profile['common']['uid']):(""); ?>">
            <img src="<?php echo isset($user_profile['profile']['avatar'])?($user_profile['profile']['avatar']):(""); ?>" width="48" height="48" style="border-radius: 4px; "></a>
        </td>
        <td style="padding-left: 12px" width="100%">
            <p align="left" style="font-size: 12px"><?php echo isset($user_profile['common']['name'])?($user_profile['common']['name']):(""); ?></p>
        </td>
    </tr>
    <tr>
        <td style="padding-left: 12px">
            <div class="chat-bubble" style="padding: 6px">
                <?php                     $row['others'] = str_ireplace("\n", "</br>", $row['others']);
                ?>
                <p align="left" style="color: #793c65"><?php echo isset($row['others'])?($row['others']):(""); ?></p>
            </div>
        </td>
    </tr>
    <tr>
        <td align="right" style="padding-right: 12px"
            colspan="2" onclick="like(<?php echo isset($row['mid'])?($row['mid']):(""); ?>)">
            👍 <span id="likes_m<?php echo isset($row['mid'])?($row['mid']):(""); ?>"><?php echo isset($row['likes'])?($row['likes']):(""); ?></span>
        </td>
    </tr>
</table>
<?php } ?>
<script>
    function like(mid) {
        if (window.XMLHttpRequest)
        {
            xmlhttp_like=new XMLHttpRequest();
        }
        else
        {
            xmlhttp_like=new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp_like.onreadystatechange=function()
        {
            if (xmlhttp_like.readyState==4 && xmlhttp_like.status==200)
            {
                document.getElementById("likes_m" + mid).innerHTML = xmlhttp_like.responseText;
                $.toptip('操作成功', 'success');
            }
        };
        xmlhttp_like.open("GET", "index.php?mod=php_api&action=rankList_class&func=like&mid=" + mid);
        xmlhttp_like.send();
    }
</script>
<div class="classlist-onwindow" id="window">
    <table id="window_contents" class="classlist-window_contents" height="100%" width="100%">
        <tr>
            <td class="classlist-window_header" id="window_contents_header" height="15%" colspan="2">

            </td>
        </tr>
        <tr>
            <td class="classlist-window_p" id="window_contents_p" height="75%" align="center" colspan="2">

            </td>
        </tr>
        <tr class="classlist-window_btn">
            <td height="10%" align="center" width="50%" class="classlist-window_btn1">
                <a href="javascript:;" onclick="CloseClassWindow();" id="classlist-window_btn1" class="classlist-window_btn1_font">取消</a>
            </td>
            <td align="center" width="50%" class="classlist-window_btn2">
                <a href="javascript:;" onclick="CloseClassWindow();" id="classlist-window_btn2" class="classlist-window_btn2_font">确认</a>
            </td>
        </tr>
    </table>
</div>