<?php
    //Copyright by nanxiaobao

    if (!defined("IS_INCLUDED"))
    {
        die('Access denied!');
    }

    $_DBCONNECT = new mysqli(
        $_CONFIG['db']['host'],
        $_CONFIG['db']['user'],
        $_CONFIG['db']['pwd'],
        $_CONFIG['db']['dbname']
    );
    //连接数据库

    if(mysqli_connect_error()){
        die(mysqli_connect_error());
    }

    function db_connect(){
        global $_DBCONNECT, $_CONFIG;

        $_DBCONNECT = new mysqli(
            $_CONFIG['db']['host'],
            $_CONFIG['db']['user'],
            $_CONFIG['db']['pwd'],
            $_CONFIG['db']['dbname']
        );

        if(mysqli_connect_error()){
            sleep(1);
            db_connect();
        }
    }

    function db_insert($tablename, $array)
    {
        global $_DBCONNECT;

        if(!$_DBCONNECT->ping()) {
            db_connect();
        }

        $keys = array();
        $values = array();
        $wenhaos = array();
        $strs = array();
        $i = 0;
        foreach($array as $key => $value)
        {
            $keys[] = "`$key`";
            $values[] = &$array[$key];
            $wenhaos[] = "?";
            $strs[] = "s";
        }

        //$sql = "insert into $tablename (".
        //    join(', ', $keys)
        //    .") values (".
        //    join(', ', $values)
        //    .")";

        $query = $_DBCONNECT->prepare("INSERT INTO $tablename (".join(', ', $keys).") values (".join(',', $wenhaos).")");
        if($query) {
            call_user_func_array(array($query, "bind_param"), array_merge(array(join("", $strs)), $values));

            try {
                $query->execute();
            }catch (Exception $error){

            }
                $query->close();
        }
        return 0;
        //print $sql;
        //return $_DBCONNECT->query($sql);
    }

    function db_delete($tablename, $where)
    {
        global $_DBCONNECT;

        if(!$_DBCONNECT->ping()) {
            db_connect();
        }

        $sql = "delete from $tablename where $where";
        return $_DBCONNECT->query($sql);
    }

    function db_update($tablename, $array, $where, $insert=false)
    {
        global $_DBCONNECT;

        if(!$_DBCONNECT->ping()) {
            db_connect();
        }

        if($insert){
            $where_arr = $where;
            $where = array();
            foreach ($where_arr as $key => $value){
                $where[] = "$key = '$value'";
            }
            $where = join(" AND ", $where);
        }

        $sets = array();
        foreach ($array as $key => $value)
        {
            $value = str_ireplace("'", "\'", $value);
            $sets[] = "`$key`='$value'";
        }

        $sql = "update `$tablename` set ".
            join(", ", $sets).
            " where $where";

        if($insert
            && !db_fetch(db_query("SELECT * FROM $tablename WHERE $where"))){
            return db_insert($tablename, array_merge($array, $where_arr));
        }

        //print $sql;

        return $_DBCONNECT->query($sql);
    }

    function db_add($tablename, $add_arr, $where, $is_arr=true, $keyword=""){
        global $_DBCONNECT;

        if(!$_DBCONNECT->ping()) {
            db_connect();
        }

        if($is_arr) {
            $where_arr = $where;
            $where = array();
            foreach ($where_arr as $key => $value) {
                $where[] = "$key = '$value'";
            }
            $where = join(" AND ", $where);
        }

        $add_keys = "`".join("`,`", array_keys($add_arr))."`";
        if(!$is_arr){
            $add_keys = $add_keys.",`$keyword`";
        }
        $query = db_query("SELECT $add_keys FROM $tablename WHERE $where");
        $result = db_fetch($query);

        if(!$result && $is_arr){
            return db_insert($tablename, array_merge($add_arr, $where_arr));
        } else {
            $count = db_count($query);
            while ($result) {
                $result_add = array();
                foreach ($add_arr as $key => $value){
                    $result_add[$key] = $result[$key] + $value;
                }
                if($count <= 1){
                    $update_condition = $where;
                }else{
                    $update_condition = "$keyword={$result[$keyword]}";
                }
                db_update($tablename, $result_add, $update_condition);
                if($count <= 1){
                    return;
                }
                $result = db_fetch($query);
            }
        }
        return;
    }

    function db_query($sql)
    {
        global $_DBCONNECT;

        if(!$_DBCONNECT->ping()) {
            db_connect();
        }

        if($sql == "") return 0;
        return $_DBCONNECT->query($sql);
    }

    function db_fetch($result)
    {
        return $result?mysqli_fetch_array($result):$result;
    }

    function db_count($result)
    {
        return $result?mysqli_num_rows($result):0;
    }

?>