<?php ob_start(); ?>
<?php
// 启动 Session
session_start();
include("SAE/saemysql.class.php");
include("SAE/saemail.class.php");
?>
<html>
<head>
<title>退出活动</title>
<meta content="text/html; charset=UTF-8" http-equiv="Content-Type">
</head>
<body>
<?php
$eventId=$_GET["eventId"];
$useremail=$_SESSION["currentUserEmail"];
$joinStatus="已退出";
$comments="(如需重新报名请联系活动发起人修改报名状态)";
 if(isset($_SESSION["currentUserEmail"])&&isset($_SESSION[$useremail."flag"])&& $_SESSION[$useremail."flag"] == TRUE)
{
    $db = new SaeMysql();
    //$sql="UPDATE event_joinlist SET event_joinlist_status ='$joinStatus' WHERE event_joinlist_ID='$joinListId'";
    $sql="UPDATE event_joinlist SET event_joinlist_status ='$joinStatus',event_joinlist_comments='$comments' WHERE event_joinlist_eventid='$eventId' and event_joinlist_useremail ='$useremail'";
    $db->runSql($sql);
    if ($db->errno() != 0) {
        die("Error:" . $db->errmsg());
    }else{
        $db->closeDb();
        echo "退出成功！<br>";
        header('Location: joinlist.php?eventId='.$eventId); 
 }     
}       
?>
</body>
<?php include 'foot.php'; ?>
</html>