<?php
// 启动 Session 
session_start();
include("SAE/saemysql.class.php");
include("SAE/saemail.class.php");
?>
<html>
<head>
<title>安全口令验证</title>
<meta content="text/html; charset=UTF-8" http-equiv="Content-Type">
</head>
<?php 
$event_id = "";
if (isset($_GET["id"]))
{
    $id = $_GET["id"];
    $_SESSION["event_id"] = $id;
}
if (isset($_SESSION["event_id"]))
{
    $event_id = $_SESSION["event_id"];
    $_SESSION["psw.$event_id.flag"] = FALSE;
}
if ($event_id=="")
{
    echo "无法获取用户ID！非法操作者请自重!自动返回活动首页中....";
    $url = "joinlist.php";
    echo "<script language='javascript' type='text/javascript'>";
    echo "window.location.href='$url'";
    echo "</script>";
}
else if (isset($_POST["submit"]))
{
    $userpsw = $_POST["userpsw"];
    if ($_POST["submit"]=="确认"&&$userpsw!="")
    {
        $db = new SaeMysql();
        $sql = "select event_joinlist_userpsw from event_joinlist where event_joinlist_ID='$event_id'";
        $dbpsw = $db->getVar($sql);
        if ($db->errno() != 0) {
            die("Error:" . $db->errmsg());
        }else{
        $db->closeDb();
        $inputpsw = md5(crypt($userpsw, substr($userpsw, 0, 3)));
        if ($dbpsw==$inputpsw)
        {
            $_SESSION["psw.$event_id.flag"] = TRUE;
            echo "pass!你是个诚实的孩子，页面自动跳转中...";
            $url = "Edit.php";
            echo "<script language='javascript' type='text/javascript'>";
            echo "window.location.href='$url'";
            echo "</script>";
        }
        else
        {
            $_SESSION["psw.$event_id.flag"] = FALSE;
            echo "fail!安全口令不正确！";
        }
        }
    }
    else
    {
        echo "请输入安全口令！";
    }
}
?>
<body>
    <form action="checkpsw.php" method="post" name="checkpswform">
        <tr>
            <td align="center">请输入安全口令</td>
            <td><input name="userpsw" type="password" id="userpsw"
                size="100"></input></td>
        </tr>
        <input type="submit" name="submit" value="确认" />
    </form>
</body>
</html>