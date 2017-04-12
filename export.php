<?php session_start(); 
include("SAE/saemysql.class.php");?>
<?php
//require_once("csv.php");
function htmldecode($str) {
    if (empty($str))
        return;
    if ($str == "")
        return $str;
    //以下是过滤特殊字符串
    $str = str_replace("&", " ", $str);
    $str = str_replace(">", " ", $str);
    $str = str_replace("<", " ", $str);
    $str = str_replace("chr(32)", " ", $str);
    $str = str_replace("chr(9)", " ", $str);
    $str = str_replace("chr(34)", " ", $str);
    $str = str_replace("\"", " ", $str);
    $str = str_replace("chr(39)", " ", $str);
    $str = str_replace("", " ", $str);
    $str = str_replace("'", " ", $str);
    $str = str_replace("select", " ", $str);
    $str = str_replace("join", " ", $str);
    $str = str_replace("union", " ", $str);
    $str = str_replace("where", " ", $str);
    $str = str_replace("insert", " ", $str);
    $str = str_replace("delete", " ", $str);
    $str = str_replace("update", " ", $str);
    $str = str_replace("like", " ", $str);
    $str = str_replace("drop", " ", $str);
    $str = str_replace("create", " ", $str);
    $str = str_replace("modify", " ", $str);
    $str = str_replace("rename", " ", $str);
    $str = str_replace("alter", " ", $str);
    $str = str_replace("cas", " ", $str);
    $str = str_replace("replace", " ", $str);
    $str = str_replace("%", " ", $str);
    $str = str_replace("or", " ", $str);
    $str = str_replace("and", " ", $str);
    $str = str_replace("!", " ", $str);
    $str = str_replace("xor", " ", $str);
    $str = str_replace("not", " ", $str);
    $str = str_replace("user", " ", $str);
    $str = str_replace("||", " ", $str);
    $str = str_replace("<", " ", $str);
    $str = str_replace(">", " ", $str);
    return $str;
}

function PMA_exportData($filename, $table, $crlf, $error_url, $sql) {
    $what = "csv";
    $csv_terminated = "\n";
    $csv_separator = "\t";
    $csv_enclosed = " ";
    $csv_escaped = "&nbsp;";

    $db = new SaeMysql();
    $result = $db -> getData($sql);

    $fields_cnt = count($result);
    $cc = "";

    // 格式化数据
    for ($i = 0; $i < $fields_cnt; $i++) {
        $row = $result[$i];
        $schema_insert = '';
        $schema_insert .= $row["event_joinlist_username"] . "\t" . $row["event_joinlist_usernick"] . "\t" . $row["event_joinlist_usergender"] . "\t" . $row["event_joinlist_userrole"] . "\t" . $row["event_joinlist_useremail"] . "\t" . $row["event_joinlist_userphone"] . "\t" . $row["event_joinlist_useraddress"] . "\t" . $row["event_joinlist_userurgentname"] . "\t" . $row["event_joinlist_userurgentphone"] . "\t" . $row["event_joinlist_usercamp"] . "\t" . $row["event_joinlist_usercamppad"] . "\t" . $row["event_joinlist_usersleepingbag"] . "\t" . $row["event_joinlist_userinterphone"] . "\t" . $row["event_joinlist_userbag"] . "\t" . $row["event_joinlist_userBurner"] . "\t" . $row["event_joinlist_userpot"] . "\t" . $row["event_joinlist_joindate"] . "\t" . $row["event_joinlist_assessment"] . "\t" . $row["event_joinlist_declare"] . "\t" . $row["event_joinlist_insurance"] . "\t\"" . $row["event_joinlist_comments"] . "\"";

        $cc .= $schema_insert . $csv_terminated;
    }// end while
    $db -> closeDb();

    // fclose(fp);
    return $cc;
}

$eventId = $_GET["eventId"];
$currentUserId = $_SESSION["currentUserId"];
$db = new SaeMysql();
$infoSql = "select * from event_info where event_id='$eventId'";
$infoResult = $db -> getData($infoSql);
$eventOwnerId = $infoResult[0]["event_createUserId"];
$statusSql = "select event_joinlist_status from event_joinlist where event_joinlist_eventid='$eventId' and event_joinlist_userid ='$currentUserId'";
$userStatus = $db -> getVar($statusSql);

$filename = $eventId . '_joinlist.csv';
header("Cache-Control: public");
header("Pragma: public");
header("Content-type:application/vnd.ms-excel");
header("Content-Disposition:attachment;filename=$filename");
header('Content-Type:APPLICATION/OCTET-STREAM');
ob_start();
//$header_str =  iconv("utf-8",'gbk',"姓名,昵称,性别,角色,Email,电话,地址,紧急联系人,紧急联系人电话,帐篷,防潮垫,睡袋,对讲机,登山包,炉头,套锅,报名时间,测试结果,免责声明,保险信息,备注\n");
$header_str = "姓名\t昵称\t性别\t角色\tEmail\t电话\t地址\t紧急联系人\t紧急联系人电话\t帐篷\t防潮垫\t睡袋\t对讲机\t登山包\t炉头\t套锅\t报名时间\t测试结果\t免责声明\t保险信息\t\"备注\"\n";

$file_str = "";
if (empty($currentUserId)||empty($eventOwnerId) ||empty($userStatus)) {
	$cc = "对不起！当前登录用户的权限不允许下载所选择的活动报名列表！";
} else if ($currentUserId === $eventOwnerId || $userStatus === "活动协作") {
   $cc = PMA_exportData($filename, "event_joinlist", "", "index.html", "select * from event_joinlist where event_joinlist_eventid ='$eventId'");
} else {
    $cc ="你个二货，你妈没告诉你偷看别人的隐私是件很龌龊的事情麽？！";
}

$file_str = $cc;
ob_end_clean();
echo(chr(255) . chr(254));
echo(mb_convert_encoding($header_str . $file_str, "UTF-16LE", "UTF-8"));
?>
