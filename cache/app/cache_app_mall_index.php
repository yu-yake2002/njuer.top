<?php /*自动生成的模板文件_*/
if(!defined("IS_INCLUDED")) die('Access denied!'); ?>
<?php include template("app/common:header"); ?>
<?php include template("app/mall:header"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>南小宝 - 积分商城</title>
</head>
<body>
<div class="card_bg">
<h1 align="center" style="color: <?php echo isset($_CORE['style_color1'])?($_CORE['style_color1']):(""); ?>">积分商城</h1>
<table width="100%">
    <tr>
        <td width="50%" valign="top" id="left">
        </td>
        <td valign="top" id="right">
        </td>
    </tr>
</table>
</div>
</body>
<?php $i = 0;
while($goods = db_fetch($query)){
$i++;
?>
<script>
    document.getElementById("<?php echo ($i % 2 == 1)?'left':'right'; ?>").innerHTML += "<div class=\"card\">\n" +
        "                <div class=\"card_image_container\">\n" +
        "                    <img src=\"<?php echo isset($goods['image'])?($goods['image']):(""); ?>\" class=\"card_image\" align=\"center\">\n" +
        "                </div>\n" +
        "                <div class=\"card_title\">\n" +
        "                    <?php echo isset($goods['gname'])?($goods['gname']):(""); ?>\n" +
        "                </div>\n" +
        "<div class='card_contents'>库存: <?php echo isset($goods['num'])?($goods['num']):(""); ?>件</div>" +
        "<div class='card_contents'>售价: <?php echo isset($goods['credits'])?($goods['credits']):(""); ?>积分</div>" +
        "<div class='card_btn' onclick='BuyGoods(<?php echo isset($goods['num'])?($goods['num']):(""); ?>, <?php echo isset($_G['user']['credits']['credits'])?($_G['user']['credits']['credits']):(""); ?>, <?php echo isset($goods['credits'])?($goods['credits']):(""); ?>, <?php echo isset($goods['gid'])?($goods['gid']):(""); ?>);'>购买</div>" +
        "</div>";
</script>
<?php }
?>
<div class="FullScreen" id="loading">正在处理交易</div>
<script src="static/js/mall_BuyGoods.js?r=4121"></script>
</html>