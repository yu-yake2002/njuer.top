<?php /*自动生成的模板文件_*/
if(!defined("IS_INCLUDED")) die('Access denied!'); ?>
<?php include template("app/common:header"); ?>
<style>
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
        .search-bar{
            height: 30px;
            margin: 3px;
        }
    </style>
<title>南小宝 - 课程红榜</title>
<?php include template("app/rankList_class:common_header"); ?>
<div class="bg1-img">
    <div class="content">
        <div class="search-bar">
            <div class="weui-search-bar__form">
                <div class="weui-search-bar__box" style="background-color: #f7ecd8">
                    <input type="hidden" name="mod" value="ranklist" />
                    <input type="search" name="keyword" class="weui-search-bar__input" id="searchInput" value="<?php echo isset($_GET["keyword"])?($_GET["keyword"]):(""); ?>"
                           placeholder="输入课程名的关键词搜索您感兴趣的课程" oninput="dosearch(this.value, 0)"
                           style="background-color: #f7ecd8">
                    <a href="javascript:dosearch('');" class="weui-icon-clear" id="searchClear"
                       style="background-color: #f7ecd8"></a>
                    <i class="weui-icon-search"
                       style="background-color: #f7ecd8"></i>
                </div>
            </div>
        </div>
        <div class="classlist-select">
            <a herf="javascript:;" onclick="addtype(0)" class="classlist-select-cell" id="classlist-searchtype0">全部课程</a>　
            <a herf="javascript:;" onclick="addtype(1)" class="classlist-select-cell" id="classlist-searchtype1">通识</a>　
            <a herf="javascript:;" onclick="addtype(2)" class="classlist-select-cell" id="classlist-searchtype2">悦读</a>　
            <a herf="javascript:;" onclick="addtype(4)" class="classlist-select-cell" id="classlist-searchtype4">思政</a>　
            <a herf="javascript:;" onclick="addtype(5)" class="classlist-select-cell" id="classlist-searchtype5">英语</a>　
            <a herf="javascript:;" onclick="addtype(3)" class="classlist-select-cell" id="classlist-searchtype3">专业课</a>　
            <a herf="javascript:;" onclick="addtype(6)" class="classlist-select-cell" id="classlist-searchtype6">体育</a>　
            <a herf="javascript:;" onclick="addtype(7)" class="classlist-select-cell" id="classlist-searchtype7">公选</a>
        </div>
        <div class="subcontent" id="subcontent">
            <div class="classlist-subselect" style="display: none;" id="sub_type2">
                <a herf="javascript:;" id="sub_type20" onclick="subType2(0)" class="classlist-selected-cell">全部课程</a>
                <a herf="javascript:;" id="sub_type21" onclick="subType2(1)" class="classlist-subselect-cell">文学</a>
                <a herf="javascript:;" id="sub_type22" onclick="subType2(2)" class="classlist-subselect-cell">历史</a>
                <a herf="javascript:;" id="sub_type23" onclick="subType2(3)" class="classlist-subselect-cell">哲学</a>
                <a herf="javascript:;" id="sub_type24" onclick="subType2(4)" class="classlist-subselect-cell">经济</a>
                <a herf="javascript:;" id="sub_type25" onclick="subType2(5)" class="classlist-subselect-cell">自然</a>
                <a herf="javascript:;" id="sub_type26" onclick="subType2(6)" class="classlist-subselect-cell">全球</a>
            </div>
            <div class="classlist-subselect" style="display: none;" id="sub_type4">
                <a herf="javascript:;" id="sub_type40" onclick="subType4(0)" class="classlist-selected-cell">全部课程</a>
                <a herf="javascript:;" id="sub_type41" onclick="subType4(1)" class="classlist-subselect-cell">思修</a>
                <a herf="javascript:;" id="sub_type42" onclick="subType4(2)" class="classlist-subselect-cell">毛概</a>
                <a herf="javascript:;" id="sub_type43" onclick="subType4(3)" class="classlist-subselect-cell">马原</a>
                <a herf="javascript:;" id="sub_type44" onclick="subType4(4)" class="classlist-subselect-cell">史纲</a>
            </div>
            <div id="showcontents">

            </div>
            <div id="loadingmore">
                🚀南小宝正在为您加载更多课程...
            </div>
        </div>
    </div>
</div>

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
<script>
    var dosearch_start = 0;
    var NoMoreClass = 0;
    var keywords;
    function loading_more_Class() {
        var Height = document.getElementById("subcontent").offsetHeight;
        var scrollHeight = document.getElementById("subcontent").scrollHeight;
        var scrollTop = document.getElementById("subcontent").scrollTop;
        if (Math.abs(scrollTop - scrollHeight + Height) <= 50 || Height == scrollHeight) {
            if (window.XMLHttpRequest) {
                xmlhttp_AskMessage_Only2 = new XMLHttpRequest();
            } else {
                xmlhttp_AskMessage_Only2 = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp_AskMessage_Only2.onreadystatechange = function () {
                if (xmlhttp_AskMessage_Only2.readyState == 4 && xmlhttp_AskMessage_Only2.status == 200) {
                    var newmessage = xmlhttp_AskMessage_Only2.responseText;
                    if (newmessage) {
                        document.getElementById("showcontents").innerHTML += newmessage;
                        dosearch_start += 15;
                        setTimeout(loading_more_Class, 1000);
                    } else {
                        NoMoreClass = 1;
                        document.getElementById("loadingmore").innerHTML = "😔啊这，找不到更多课程了";
                    }
                }
            };
            xmlhttp_AskMessage_Only2.open("GET", "index.php?mod=php_api&action=rankList_class&func=SearchClass&keyword=" + keywords + "&start=" + dosearch_start + "&SearchType=" + searchtype.join(""));
            xmlhttp_AskMessage_Only2.send();
        }else {
            setTimeout(loading_more_Class, 1000);
        }
    }
    
    function subType2(subtype) {
        if(subtype == 0){
            document.getElementById('searchInput').value = "";
            dosearch("");
        }else{
            document.getElementById('searchInput').value = "004" + subtype.toString();
            dosearch("004" + subtype.toString());
        }
        for(var i=0;i<7;i++)
        {
            document.getElementById("sub_type2" + i.toString()).className = "classlist-subselect-cell";
        }
        document.getElementById("sub_type2" + subtype.toString()).className = "classlist-selected-cell";
        return ;
    }
</script>
<script src="static/js/class_remark.js?r=283"></script>
<script src="static/js/class_join.js?r=283"></script>
<script src="static/js/rankList_openclass.js?r=283"></script>
<script>

    var searchtype = [0,0,0,0,0,0,0];
    function addtype(newtype) {
        if(newtype == 0)
        {
            for(var i=0;i<7;i++)
            {
                searchtype[i] = 1;
                document.getElementById('classlist-searchtype' + (i + 1).toString()).className = 'classlist-select-cell';
            }
        }else{
            document.getElementById('classlist-searchtype0').className = 'classlist-select-cell';
            for(var i=0;i<7;i++)
            {
                searchtype[i] = 0;
                document.getElementById('classlist-searchtype' + (i + 1).toString()).className = 'classlist-select-cell';
            }
            searchtype[newtype - 1] = 1;
        }
        document.getElementById('classlist-searchtype' + newtype.toString()).className = 'classlist-selected-cell';
        dosearch_start = 0;
        dosearch(document.getElementById('searchInput').value);
        if(newtype == 2){
            document.getElementById("sub_type2").style = "";
        }else{
            document.getElementById("sub_type2").style = "display: none";
        }
        if(newtype == 4){
            document.getElementById("sub_type4").style = "";
        }else{
            document.getElementById("sub_type4").style = "display: none";
        }
    }
    addtype(0);

    function subType4(subtype){
        var search_subtype;
        if(subtype == 0){
            search_subtype = "";
        }else if(subtype == 1){
            search_subtype = "00000020";
        }else if(subtype == 2){
            search_subtype = "00000030A";
        }else if(subtype == 3){
            search_subtype = "00000010";
        }else if(subtype == 4){
            search_subtype = "00000041";
        }

        document.getElementById('searchInput').value = search_subtype;
        dosearch(search_subtype);

        for(var i=0;i<5;i++)
        {
            document.getElementById("sub_type4" + i.toString()).className = "classlist-subselect-cell";
        }
        document.getElementById("sub_type4" + subtype.toString()).className = "classlist-selected-cell";
        return ;
    }

    function dosearch(keyword, start) {
        keywords = keyword;
        if (start == 0)
        {
            dosearch_start = 0;
        }
        if (window.XMLHttpRequest)
        {
            xmlhttp=new XMLHttpRequest();
        }
        else
        {
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange=function()
        {
            if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {
                if(xmlhttp.responseText != ''){
                    document.getElementById("loadingmore").innerHTML = "🚀南小宝正在为您加载更多课程...";
                    document.getElementById("showcontents").innerHTML = xmlhttp.responseText;
                    document.getElementById("subcontent").scrollTop = 0;
                    NoMoreClass = 1;
                    dosearch_start = 15;
                    loading_more_Class();
                }else{
                    document.getElementById("showcontents").innerHTML = '<div class="content2">没有搜索到相关课程</div>';
                }
            }
        };
        xmlhttp.open("GET", "index.php?mod=php_api&action=rankList_class&func=SearchClass&keyword=" + keyword + "&SearchType=" + searchtype.join(""));
        xmlhttp.send();
    }
    <?php if(isset($_GET['keyword'])){ ?>
        dosearch('<?php echo isset($_GET["keyword"])?($_GET["keyword"]):(""); ?>');
    <?php }else{ ?>
        dosearch('');
    <?php } ?>
</script>
<?php if(isset($add_chance)){ ?>
<script>
    $.alert("红黑榜的彩蛋砸中了你！恭喜您获得了<?php echo isset($add_chance)?($add_chance):(""); ?>次额外的积分抽奖机会！");
</script>
<?php } ?>