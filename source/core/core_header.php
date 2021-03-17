<?php
    /*Copyright by nanxiaobao*/

    if(!defined("IS_INCLUDED"))
    {
        die('Access denied!');
    }
    include_once './source/core/core_config.php';
    include_once './source/core/core_settings.php';

    include_once './source/core/core_template.php';
    include_once './source/core/core_function.php';
    include_once './source/core/time/time_core.php';

    include_once './source/core/core_cache.php';

    include_once './source/core/core_db.php';
    include_once './source/core/core_db_function.php';

    include_once './source/core/core_credits.php';

    include_once './source/core/core_user.php';
    include_once './source/core/core_HMGet.php';
    include_once './source/core/core_class.php';
    include_once './source/core/core_square.php';

    include_once './source/core/core_loginverify.php';
    include_once './source/core/core_style.php';

    include_once './source/core/core_notice.php';

    $_G['FullScreen'] = false;

?>