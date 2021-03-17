<?php /*自动生成的模板文件_*/
if(!defined("IS_INCLUDED")) die('Access denied!'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta
            name="viewport"
            content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"
    />
    <title>南小宝 - 登录界面</title>
    <link rel="stylesheet" href="./template_app/css<?php echo isset($_CORE['style_css'])?($_CORE['style_css']):("var[_CORE['style_css']]"); ?>/jquery-weui.min.css?r=4725">
    <link rel="stylesheet" href="./template_app/css<?php echo isset($_CORE['style_css'])?($_CORE['style_css']):("var[_CORE['style_css']]"); ?>/weui.min.css?r=4725">
    <link rel="stylesheet" href="./template_app/css<?php echo isset($_CORE['style_css'])?($_CORE['style_css']):("var[_CORE['style_css']]"); ?>/user_login.css?r=4725">
    <link rel="stylesheet" href="./template_app/css<?php echo isset($_CORE['style_css'])?($_CORE['style_css']):("var[_CORE['style_css']]"); ?>/common.css?r=4725">
</head>
<body class="bg1-img">
<form action="<?php echo isset($_CORE['url'])?($_CORE['url']):(""); ?>" method="post" onsubmit="return check_sid(this);" autocomplete="off">
    <table width="100%" height="100%">
        <tr>
            <td colspan="2" height="20%" class="header_logo">
                <img src="static/img/logo.png" class="header_logo_img">
            </td>
        </tr>
        <tr>
            <td colspan="2" class="login_explain">
                我们已经向您的南大邮箱 <strong><?php echo isset($_G['user']['mobile'])?($_G['user']['mobile']):(""); ?>@smail.nju.edu.cn</strong>
                (<a href="index.php?mod=user&action=exit">修改</a>)<br>
                发送了一封邮件，请输入其中的6位数字验证码
            </td>
        </tr>
        <tr>
            <td colspan="2" class="login_pass"></td>
        </tr>
        <tr>
            <td colspan="2" align="center">
                <input id="code1" oninput="code1input();" class="code_square" maxlength="6">
                <input id="code2" oninput="document.getElementById('code3').focus()" class="code_square" maxlength="1">
                <input id="code3" oninput="document.getElementById('code4').focus()" class="code_square" maxlength="1">
                <input id="code4" oninput="document.getElementById('code5').focus()" class="code_square" maxlength="1">
                <input id="code5" oninput="document.getElementById('code6').focus()" class="code_square" maxlength="1">
                <input id="code6" oninput="checkcode();" class="code_square" maxlength="1">
            </td>
        </tr>
        <tr>
            <td colspan="2" class="login_pass"></td>
        </tr>
        <tr>
            <td colspan="2" align="center">
                <input type="button" value="重 新 发 送" class="login_submit" onclick="location.href='index.php?mod=user&action=login'">
            </td>
        </tr>
        <?php if(time() <= 1599926400){ ?>
        <tr>
            <td colspan="2" align="center">
                <br>
                由于网络拥堵，邮件可能无法发出。
                如果您长时间没有收到邮件，您可以带着校园卡实体卡照片私戳QQ群195959801管理员可以获得验证码。
            </td>
        </tr>
        <?php } ?>
    </table>
</form>
</body>
<script src="./static/js/jquery.min.js?r=4725"></script>
<script src="./static/js/jquery-weui.min.js?r=4725"></script>
<script src="./static/js/weui.min.js?r=4725"></script>
<script>
    document.getElementById("code1").focus();
    function code1input() {
        if(document.getElementById('code1').value.length == 1)
        {
            document.getElementById('code2').focus();
            return true;
        }else if(document.getElementById('code1').value.length == 6)
        {
            var code = document.getElementById('code1').value;
            document.getElementById('code1').value = code[0];
            document.getElementById('code2').value = code[1];
            document.getElementById('code3').value = code[2];
            document.getElementById('code4').value = code[3];
            document.getElementById('code5').value = code[4];
            document.getElementById('code6').value = code[5];
            document.getElementById('code6').focus();
            checkcode();
            return true;
        }else if(document.getElementById('code1').value.length == 0)
        {
            return true;
        }else{
            var code = document.getElementById('code1').value;
            document.getElementById('code1').value = code[0];
            document.getElementById('code2').focus();
            return true;
        }
    }
    function checkcode() {
        var code = document.getElementById('code1').value
            + document.getElementById('code2').value
            + document.getElementById('code3').value
            + document.getElementById('code4').value
            + document.getElementById('code5').value
            + document.getElementById('code6').value;
        if(code.length < 6)
        {
            return false;
        }
        xmlhttp=new XMLHttpRequest();
        if (xmlhttp!=null){
            xmlhttp.onreadystatechange=function () {
                if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                    if(xmlhttp.responseText == "1"){
                        $.alert({text:"密码修改成功！",
                        onOK:function () {
                            location.href="index.php";
                        }});
                    }else{
                        $.alert({text:"验证码输入错误！",onOK:function () {
                                document.getElementById('code1').value = '';
                                document.getElementById('code2').value = '';
                                document.getElementById('code3').value = '';
                                document.getElementById('code4').value = '';
                                document.getElementById('code5').value = '';
                                document.getElementById('code6').value = '';
                                document.getElementById('code1').focus();
                            }});
                    }
                }
            };
            xmlhttp.open("GET","index.php?mod=php_api&action=checkMailCode&code="+code,true);
            xmlhttp.send(null);
        }else
        {
            $.alert("Your browser does not support XMLHTTP.");
        }
    }
</script>
</html>