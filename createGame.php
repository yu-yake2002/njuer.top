
<?php
/*
 * Copyright By 南小宝
 * Last Edited: 20200902, By 张运筹
 */

const IS_INCLUDED = 1; # 定义该变量防止其他文件被直接打开

include_once 'source/core/core_header.php'; # 核心功能

if(!$_G['user']['loginned']){
    CORE_GOTOURL("index.php"); # 验证是否登录
}

$images = array(
        "ad/ad16ccdc-975e-4393-ae7b-8ac79c3795f2.png",
    "0c/0cbb3dbb-2a85-42a5-be21-9839611e5af7.png",
    "d0/d0c676e4-0956-4a03-90af-fee028cfabe4.png",
    "74/74237057-2880-4e1f-8a78-6d8ef00a1f5f.png",
    "13/132ded82-3e39-4e2e-bc34-fc934870f84c.png",
    "03/03c33f55-5932-4ff7-896b-814ba3a8edb8.png",
    "66/665a0ec9-6c43-4858-974c-025514f2a0e7.png",
    "84/84bc9d40-83d0-480c-b46a-3ef59e603e14.png",
    "5f/5fa0264d-acbf-4a7b-8923-c106ec3b9215.png",
    "56/564ba620-6a55-4cbe-a5a6-6fa3edd80151.png",
    "50/5035266c-8df3-4236-8d82-a375e97a0d9c.png");

$step = 0;

if(is_dir("hechengxigua/res_".$_G['user']['uid'])){
    $step = 1;
    $dir = "hechengxigua/res_".$_G['user']['uid'];
}

if(isset($_GET['step']) && $_GET['step'] == 1 && $step == 0){
    print "正在复制文件";
    dir_copy("hechengxigua/res_default", "hechengxigua/res_".$_G['user']['uid']);
    CORE_GOTOURL("createGame.php?step=2");
}
if(isset($_GET['step']) && $_GET['step'] == 3 && $step == 1){
    print "正在重置文件";
    dir_copy("hechengxigua/res_default", "hechengxigua/res_".$_G['user']['uid']);
    CORE_GOTOURL("createGame.php?step=2");
}
?>
<title>魔改合成大西瓜</title>
<meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"
/>
<script>
    var replace_image;
    function post_image() {
        document.getElementById("image_loading").innerHTML = "正在上传中";
        var DataSender=null;
        var formData = new FormData();
        formData.append("file", document.getElementById("file").files[0]);
        if (window.XMLHttpRequest)
        {
            DataSender=new XMLHttpRequest();
        }
        else if (window.ActiveXObject)
        {
            DataSender=new ActiveXObject("Microsoft.XMLHTTP");
        }
        if (DataSender!=null)
        {
            DataSender.onreadystatechange=function (){
                if (DataSender.readyState == 4)
                {
                    if (DataSender.status == 200)
                    {
                        replace_image.src = DataSender.responseText;
                        document.getElementById("image_loading").innerHTML = "";
                    }
                }
                return false;
            };
            DataSender.open("POST", "index.php?mod=php_api&action=common&func=replace_image&replace_url="
                + encodeURIComponent(replace_image.alt), true);
            DataSender.send(formData);
            return true;
        }else{
            return false;
        }
    }

</script>
<style>
    .link{
        color: white;
        background-color: #793c65;
        border-radius: 4px;
        border: 1px #793c65 solid;
        padding-top: 4px;
        padding-bottom: 4px;
        padding-right: 12px;
        padding-left: 12px;
        margin-top: 6px;
        margin-left: 12px;
        text-underline: none;
    }

    .link:hover {
        color: black;
        background-color: #fdfdfd;
        border-radius: 4px;
        border: 1px #fdfdfd solid;
        padding-top: 4px;
        padding-bottom: 4px;
        padding-right: 12px;
        padding-left: 12px;
    }
    .url{
        border-radius: 12px;
        border: 1px solid black;
        height: 36px;
        width: 100%;
    }
</style>
<?php
switch ($step){
    case 1:
        ?>
    <table width="100%" align="center">
        <tr>
            <td><input class="url" id="copy_url1" value="https://njuer.top/index.php?mod=game&action=hechengxigua&uid=<?php echo $_G['user']['uid']; ?>&name=<?php echo $_G['user']['name']; ?>"></td>
            <td><a href="javascript:share1();"><button class="link">复制链接（校内）</button></a></td>
        </tr>
    </table><br>
        <table width="100%" align="center">
            <tr>
                <td><input class="url" id="copy_url2" value="https://njuer.top/hechengxigua/?uid=<?php echo $_G['user']['uid']; ?>&name=<?php echo $_G['user']['name']; ?>"></td>
                <td><a href="javascript:share2();"><button class="link">复制链接（校外）</button></a></td>
            </tr>
        </table><br>
    <h2>合成自定义</h2>
        选项：<a href="index.php"><button class="link">返回南小宝</button></a>
        <a href="createGame.php?step=3"><button class="link">重置游戏</button></a>        <a href="https://njuer.top/index.php?mod=game&action=hechengxigua&uid=<?php echo $_G['user']['uid']; ?>&name=<?php echo $_G['user']['name']; ?>"><button class="link">体验游戏</button></a>
        <br>
        说明：该游戏的源代码来源于GitHub，经过二次创作后我们加入了任何人都可以修改图片生成新游戏的功能。该功能仅供娱乐，不用于任何商业用途，大家可以发挥创意，设计出各种各样的合成小游戏。点击下方的图片并上传新图片可以把他们替换成任何你想要的图片，复制上方的链接就可以分享游戏啦！<br>
        <br>
    校外链接限制每半小时最多访问75次。
        <div style="text-align: center; padding: 12px">
        <div id="image_loading"></div>
        <?php
        foreach ($images as $image_url){
            $image_url = $dir."/raw-assets/".$image_url;
        ?>
            <img alt="<?php echo $image_url; ?>" src="<?php echo $image_url."?r=".rand(0,99999); ?>" width="120px" height="120px" onclick="replace_image = this;document.getElementById('file').click();">
        <?php
        }
        ?>
    </div>
        <input type="file" id="file" hidden onchange="post_image()">
    <?php
        break;
    default:
        ?>
        <a href="createGame.php?step=1"><button class="link">创建游戏</button></a><br>
        <a href="index.php"><button class="link">返回南小宝</button></a>
        <?php
        break;
}
include_once 'source/core/core_footer.php'; # 收尾工作

?>
<script>
    function share1(){
        var copy_url = document.getElementById("copy_url1");
        copy_url.select();
        document.execCommand("copy");
        return;
    }
    function share2(){
        var copy_url = document.getElementById("copy_url2");
        copy_url.select();
        document.execCommand("copy");
        return;
    }
</script>
