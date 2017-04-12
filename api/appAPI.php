<?php
// require_once 'common.php';
// require_once 'init.php';
// require_once 'constant.php';
//require 'engine.php';
//require 'conn.php';
header('Content-Type:text/html;charset=utf-8');
include("SAE/saemysql.class.php");
include("SAE/saemail.class.php");

$action = $_GET['action'];
switch ($action) {
	    //查询用户信息
    case"gethikerinfo" :
        $res = $GLOBALS['HTTP_RAW_POST_DATA'];
        $reqDataArray = json_decode($res, TRUE);        //变成数组要加个true
        //$uid = lib_replace_end_tag($reqDataArray['user_id']);
		// $a=get_hiker_info($uid);
		// $b=url_encode($a);
        // $response = json_encode($b);
        // $response= urldecode($response) ;
        //exit($response);
        exit('33333');
        break;
    case"geteventlist" :
		$b=array('username' => 'later','email' => 'later.h.p@qq.com','user_id' => 1, 'key' => md5('sysuhiker'));
        $response = json_encode($b);
        $response= urldecode($response) ;
        exit($response);
        break; 
    case"geteventlist1" :
		$input=$_POST["action"];
		$b=array('username' => 'later1'.$input,'email' => 'later.h.p@qq.com','user_id' => 11, 'key' => md5('sysuhiker'));
        $response = json_encode($b);
        $response= urldecode($response) ;
        exit($response);
        break; 		  
    default :
        exit(json_encode(error));
}


//获取用户的详细信息
function get_hiker_info($uid){
        $db = new SaeMysql();
        $sql = "select * from event_hiker where user_id=$uid";
    	$list = $db->getLine($sql); // 获得查询结果
        return $list;
}

//HTML尾标签,为过滤服务
function lib_replace_end_tag($str) {
    if (empty($str))
        return false;
    $str = htmlspecialchars($str);
    $str = str_replace('/', "", $str);
    $str = str_replace("\\", "", $str);
    $str = str_replace(">", "", $str);
    $str = str_replace("<", "", $str);
    $str = str_replace("<SCRIPT>", "", $str);
    $str = str_replace("</SCRIPT>", "", $str);
    $str = str_replace("<script>", "", $str);
    $str = str_replace("</script>", "", $str);
    $str = str_replace("select", "select", $str);
    $str = str_replace("join", "join", $str);
    $str = str_replace("union", "union", $str);
    $str = str_replace("where", "where", $str);
    $str = str_replace("insert", "insert", $str);
    $str = str_replace("delete", "delete", $str);
    $str = str_replace("update", "update", $str);
    $str = str_replace("like", "like", $str);
    $str = str_replace("drop", "drop", $str);
    $str = str_replace("create", "create", $str);
    $str = str_replace("modify", "modify", $str);
    $str = str_replace("rename", "rename", $str);
    $str = str_replace("alter", "alter", $str);
    $str = str_replace("cas", "cast", $str);
    $str = str_replace("&", "&", $str);
    $str = str_replace(">", ">", $str);
    $str = str_replace("<", "<", $str);
    $str = str_replace(" ", chr(32), $str);
    $str = str_replace(" ", chr(9), $str);
    $str = str_replace("    ", chr(9), $str);
    $str = str_replace("&", chr(34), $str);
    $str = str_replace("'", chr(39), $str);
    $str = str_replace("<br />", chr(13), $str);
    $str = str_replace("''", "'", $str);
    $str = str_replace("css", "'", $str);
    $str = str_replace("CSS", "'", $str);
    return $str;
}

//数据过滤函数
//$_GET = stripslashes_array($_GET);
//$_POST = stripslashes_array($_POST);
function stripslashes_array(&$array) {
    while (list($key, $var) = each($array)) {
        if ($key != 'argc' && $key != 'argv' && (strtoupper($key) != $key || '' . intval($key) == "$key")) {
            if (is_string($var)) {
                $array[$key] = stripslashes($var);
            }
            if (is_array($var)) {
                $array[$key] = stripslashes_array($var);
            }
        }
    }
    return $array;
}
//处理中文，PHP5.3.3只能用这种方法
function url_encode($str) {  
    if(is_array($str)) {  
        foreach($str as $key=>$value) {  
            $str[urlencode($key)] = url_encode($value);  
        }  
    } else {  
        $str = urlencode($str);  
    }  
      
    return $str;  
}

?>
