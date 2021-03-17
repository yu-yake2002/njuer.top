<?php /*自动生成的模板文件_*/
if(!defined("IS_INCLUDED")) die('Access denied!'); ?>
<?php include template("app/common:header"); ?>
<link rel="stylesheet" href="./template_app/css/AplusB.css?r=7504">
<body>
<h1 class="AplusB_title">计算器</h1>
<div class="calculator">
    <input type="text" id="A" value="0" oninput="AplusB()" class="AandB">
    <span class="plus">+</span>
    <input type="text" id="B" value="0" oninput="AplusB()" class="AandB">
    <br>
    <input type="submit" onclick="AplusB();" value="Calculate" class="calculator_submit">
</div>
<p align="right">
    =<span id="C">0</span>
</p>
你曾经计算过：<br>
<?php while($user = db_fetch($query)){ ?>
    <?php echo isset($user['A'])?($user['A']):(""); ?> + <?php echo isset($user['B'])?($user['B']):(""); ?><br>
<?php } ?>
</body>
<script>
    function AplusB() {
        var A = document.getElementById("A").value;
        var B = document.getElementById("B").value;
        var RequestList=new XMLHttpRequest();
        RequestList.onreadystatechange = function () {
            if (RequestList.readyState == 4 && RequestList.status == 200) {
                document.getElementById("C").innerHTML = RequestList.responseText;
            }
        };
        RequestList.open("GET","index.php?mod=php_api&action=AplusB&A=" + A + "&B=" + B, true);
        RequestList.send();
    }
</script>