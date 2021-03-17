<?php
    /*Copyright by nanxiaobao*/

    if(!defined("IS_INCLUDED"))
    {
        die('Access denied!');
    }

    $_CONFIG=array(
        'api' => array(
            'face_api_key' => "3TdcGvUHCy5sUsFtW54eemmq4SroPX_U",
            'face_api_secret' => "inCznOhLNi1cinNp13LEBtN0DVk4ur-S",
            'face_api_compare_host' => "https://api-cn.faceplusplus.com/facepp/v3/compare",
            'face_api_iw_host' => "https://api-cn.faceplusplus.com/imagepp/v1/recognizetext"
        ),
        //api的key和secret

        'db' => array(
            'host' => "hdm721902126.my3w.com", //请填写数据库地址
            'user' => "hdm721902126", //请填写数据库用户名
            'pwd' => "DC7F66-5c07462a", //请填写数据库密码
            'dbname' => "hdm721902126_db" //请填写数据库名
        ),
        //数据库的相关配置

        'setting' => array(
            'lang' => "./lang/lang_",
            'task' => "off",
            'task_token' => "hc81eyh923hcdj19"
        ),

        'mail' => array(
            array(
                'smtp' => 'smtp.163.com',
                'from' => 'nxbclassno1@163.com',
                'pwd' => 'DPNXEYKBXWRRSJIW'
            ),
            array(
                'smtp' => 'smtp.163.com',
                'from' => 'nxbclassno1@163.com',
                'pwd' => 'DPNXEYKBXWRRSJIW'
            ),
            array(
                'smtp' => 'smtp.exmail.qq.com',
                'from' => '191300080@smail.nju.edu.cn',
                'pwd' => 'Zyc73021116'
            ),
            array(
                'smtp' => 'smtp.exmail.qq.com',
                'from' => '191300080@smail.nju.edu.cn',
                'pwd' => 'Zyc73021116'
            ),
            array(
                'smtp' => 'smtp.exmail.qq.com',
                'from' => '191300080@smail.nju.edu.cn',
                'pwd' => 'Zyc73021116'
            ),
            array(
                'smtp' => 'smtp.qq.com',
                'from' => '1340709767@qq.com',
                'pwd' => 'pkhpzsiwgdlkfjfj'
            ),
            array(
                'smtp' => 'smtp.qq.com',
                'from' => '869285333@qq.com',
                'pwd' => 'cnwlnuvccoytbcbi'
            )
        ),

        'mail_num' => 6
        //邮箱的相关配置
    );

    date_default_timezone_set("PRC");
    if($_CONFIG['setting']['task'] == 'on')
    {
        set_time_limit(0);
    }
    //时区设置
?>