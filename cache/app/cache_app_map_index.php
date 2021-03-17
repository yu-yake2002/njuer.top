<?php /*自动生成的模板文件_*/
if(!defined("IS_INCLUDED")) die('Access denied!'); ?>
<?php include template("app/common:header"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>南小宝 - 地图</title>
</head>
<link rel="stylesheet" href="./template_app/css<?php echo isset($_CORE['style_css'])?($_CORE['style_css']):("var[_CORE['style_css']]"); ?>/map.css?r=2526">
<body>
<div class="nav_row">
    <span class="nav_btn_chosen_small">
        室内地图
    </span>
</div>
<br>
<br>
<?php if($action != "index"){ ?>
<img src="static/img/map/<?php echo isset($location)?($location):(""); ?><?php echo isset($floor)?($floor):(""); ?>F.jpg" class="map"
     onclick="document.getElementById('bigmap').style.display='';">
<div id="bigmap" style="display: none; position: absolute; z-index: 100000000000; top: 0" onclick="this.style.display='none';">
    <img src="static/img/map/<?php echo isset($location)?($location):(""); ?><?php echo isset($floor)?($floor):(""); ?>F.jpg" width="1024px">
</div>

<?php }else{ ?>
<div class="btn_list">
    <div class="btn_item" onclick="location.href='index.php?mod=map&action=ifLow&floor=1';">
        <h3 class="btn_title">逸夫楼</h3>
        <p class="btn_comment">逸夫楼又称国际学院、左涤江楼，是南门进门以后左手边的第一栋楼，从宿舍出发去逸夫楼可走如下路线：骑车经过一组团主干道，到基础实验楼面前左转，直行到“左涤江楼”门口。</p>
    </div>
    <div class="btn_item" onclick="location.href='index.php?mod=map&action=xian1&floor=1';">
        <h3 class="btn_title">仙I（择善楼）</h3>
        <p class="btn_comment">仙I又称择善楼，在逸夫楼对面。逸夫楼位于仙I的南边，仙II位于仙I的北边。</p>
    </div>
    <div class="btn_item" onclick="location.href='index.php?mod=map&action=xian2&floor=1';">
        <h3 class="btn_title">仙II（思源楼）</h3>
        <p class="btn_comment">仙II又称思源楼，在图书馆对面。仙II有绿地毯的门为北门，和仙I相连通的那道桥是南门。</p>
    </div>
</div>
<?php } ?>
<table class="footmenu_list">
    <tr>
        <td width="50%">
            <select name="floor" onchange="location.href='index.php?mod=map&action=' + this.value + '&floor=<?php echo isset($floor)?($floor):(""); ?>';" class="footmenu_select">
                <option value="ifLow" <?php if($location == 'ifLow'){ ?>selected<?php } ?>>逸夫楼</option>
                <option value="xian1" <?php if($location == 'xian1'){ ?>selected<?php } ?>>仙I</option>
                <option value="xian2" <?php if($location == 'xian2'){ ?>selected<?php } ?>>仙II</option>
            </select>
        </td>
        <td width="50%">
            <select name="floor" onchange="location.href='index.php?mod=map&action=<?php echo isset($action)?($action):(""); ?>&floor=' + this.value;" class="footmenu_select">
                <option value="1" <?php if($floor == 1){ ?>selected<?php } ?>>1楼</option>
                <option value="2" <?php if($floor == 2){ ?>selected<?php } ?>>2楼</option>
                <option value="3" <?php if($floor == 3){ ?>selected<?php } ?>>3楼</option>
                <option value="4" <?php if($floor == 4){ ?>selected<?php } ?>>4楼</option>
                <option value="5" <?php if($floor == 5){ ?>selected<?php } ?>>5楼</option>
            </select>
        </td>
    </tr>
</table>
</body>
</html>