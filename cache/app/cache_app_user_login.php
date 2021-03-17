<?php /*自动生成的模板文件_*/
if(!defined("IS_INCLUDED")) die('Access denied!'); ?>
<!DOCTYPE html>
<?php include template("app/common:header"); ?>
<html lang="en">
<head>
    <title>南小宝 - 登录界面</title>
    <link rel="stylesheet" href="./template_app/css<?php echo isset($_CORE['style_css'])?($_CORE['style_css']):("var[_CORE['style_css']]"); ?>/user_login.css?r=7991">
</head>
<body class="bg1-img">
<form action="<?php echo isset($_CORE['url'])?($_CORE['url']):(""); ?>" method="post" onsubmit="return check_sid(this);">
    <table width="100%" height="100%">
        <tr>
            <td colspan="2" height="20%" class="header_logo">
                <img src="static/img/logo.png" class="header_logo_img">
            </td>
        </tr>
        <tr>
            <td align="center">
                <span class="login_label_ch">学 号</span>
                <br/>
                <span class="login_label_en">Student ID</span>
            </td>
            <td align="center">
                <input type="text" class="login_field" name="uid" required />
            </td>
        </tr>
        <tr>
            <td colspan="2" class="login_pass"></td>
        </tr>
        <tr>
            <td align="center">
                <span class="login_label_ch">密 码</span>
                <br/>
                <span class="login_label_en">Password</span>
            </td>
            <td align="center">
                <input type="password" class="login_field" name="pwd" required />
            </td>
        </tr>
        <tr>
            <td colspan="2" class="login_pass"></td>
        </tr>
        <tr>
            <td colspan="2" align="center">
                <input type="submit" value="登 录" class="login_submit">
            </td>
        </tr>
        <tr>
            <td colspan="2" class="login_pass"></td>
        </tr>
        <tr>
            <td colspan="2" class="login_explain">
                提示
                <hr size="1" color="<?php echo isset($_CORE['style_color1'])?($_CORE['style_color1']):(""); ?>">
            </td>
        </tr>
        <tr>
            <td colspan="2" style="color: <?php echo isset($_CORE['style_color1'])?($_CORE['style_color1']):(""); ?>; font-family: 'Times New Roman', '宋体'">
                1.如果您没有设置密码或者忘记密码，请输入任意密码登录；<br>
                2.通过学生邮箱验证后，密码将被更改为您输入的密码。
            </td>
        </tr>
    </table>
</form>
</body>
<script>
function check_sid(thisForm) {
    with(thisForm){
        with(uid){
            if (uid.value.length != 9 && uid.value.length != 10)
            {
                $.alert("请输入正确格式的学号！");
                return false;
            }else {
                return true;
            }
        }
    }
}
</script>
</html>