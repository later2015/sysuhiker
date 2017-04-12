<?php ob_start(); ?>
<?php $navvar = "event";
include 'navigation.php';?>
<body>
		<?php
$eventId=$_GET["eventId"];
$useremail=$_SESSION["currentUserEmail"];
//设置使用北京时间
date_default_timezone_set('PRC');
// 用户填写报名申请以后的数据处理文件。需要先检查数据合法性，然后写入数据库
// 获取报名用户提交的数据
$username1 = $_POST["username"];// 参加者真实姓名
$usernick1 = $_POST["usernick"];// 昵称
$usergender1 = $_POST["usergender"];// 性别
// $useremail1 = $_POST["useremail"];// 邮箱
// $userpsw = $_POST["userpsw"]; // 安全口令
// $userpsw2 = $_POST["userpsw2"]; // 确认安全口令rray = $_POST["userrole"]; // 用户角色
$userrolearray = $_POST["userrole"]; // 用户角色
$userrole=implode("+",$userrolearray);
//$useremail1=$_SESSION["currentUserEmail"];
$userphone = $_POST["userphone"]; // 电话
$userqq = $_POST["userqq"]; // QQ
$weiboName = $_POST["weiboName"]; // weibo
$weiboLink= $_POST["weiboLink"]; // weibo
$useraddress = $_POST["useraddress"]; // 地址
$userurgentname = $_POST["userurgentname"]; // 紧急联系人
$userurgentphone = $_POST["userurgentphone"]; // 紧急联系人电话
if(isset($_POST["usercamp"])&&isset($_POST["usercamppad"])&&isset($_POST["userinterphone"])&&isset($_POST["userBurner"])&&isset($_POST["userpot"])){
$usercamparray = $_POST["usercamp"]; // 帐篷
$usercamp=implode("+",$usercamparray);    
$usercamppad =implode("+", $_POST["usercamppad"]); // 防潮垫
$userinterphone=implode("+",$_POST["userinterphone"]) ; // 对讲机
$userBurner =implode("+", $_POST["userBurner"]) ; // 炉头
$userpot = implode("+",$_POST["userpot"]); // 套锅
}

$usersleepingbag=$_POST["usersleepingbag"]; // 睡袋
$userbag =$_POST["userbag"]; // 登山包
$comments = $_POST["comments"]; // 备注
$insurance = $_POST["insurance"]; // 保险信息
if(isset($_POST["declare"])){
$declare =implode("+",$_POST["declare"]) ; // 免责声明    
}else{
    echo "请勾选免责声明！";
    exit();
}


// 判断用户名函数
function Check_username($UserName) // 参数为用户注册的用户名
{
    // 用户名三个方面检查
    // 是否为空 字符串检测 长度检测
    $Max_Strlen_UserName = 16; // 用户名最大长度
    $Min_Strlen_UserName = 2;// 用户名最短长度
    $UserNameChars = "/[\x{4e00}-\x{9fa5}]/u";// 字符串检测的正则表达式
    $UserNameGood = " 用户名检测正确 ";// 定义返回的字符串变量
    if ($UserName=="")
    {
        $UserNameGood = " 用户名不能为空 ";
        return $UserNameGood;
    }
    if (!preg_match("$UserNameChars", $UserName)) // 正则表达式匹配检查
    {
        $UserNameGood = " 用户名字符串检测不正确 ";
        return $UserNameGood;
    }
    if (strlen($UserName)<$Min_Strlen_UserName||strlen($UserName)>$Max_Strlen_UserName)
    {
        $UserNameGood = " 用户名字长度检测不正确 ";
        return $UserNameGood;
    }
    return $UserNameGood;
}


// 调用函数，检测活动参加者输入的数据
$UserNameGood = Check_username($username1);
$error = false; // 定义变量判断注册数据是否出现错误

if ($UserNameGood!=" 用户名检测正确 ")
{
    $error = true; // 改变 error 的值表示出现了错误
    echo $UserNameGood; // 输出错误信息
    echo "<br>";
}

// 如果数据检测都合法，则将活动报名者填写的资料写进数据库表
//if($_SESSION["psw.$id.flag"]==TRUE){
 if($error==FALSE && isset($_SESSION["currentUserEmail"])&&isset($_SESSION[$useremail."flag"])&& $_SESSION[$useremail."flag"] == TRUE)//确定用户已登录。
{
    
    $Datetime = date("Y-m-d H:i:s"); // 获取报名时间，也就是数据写入到用户表的时间
    $db = new SaeMysql();
    /*第五步：定义要数据库执行的sql语句*/
    $sql = "update event_joinlist set 
    event_joinlist_username='$username1',event_joinlist_usernick='$usernick1',event_joinlist_usergender='$usergender1',
    event_joinlist_userrole='$userrole',event_joinlist_userphone='$userphone',
    event_joinlist_useraddress='$useraddress',event_joinlist_userurgentname='$userurgentname',event_joinlist_userurgentphone='$userurgentphone',
    event_joinlist_usercamp='$usercamp',event_joinlist_usercamppad='$usercamppad',event_joinlist_usersleepingbag='$usersleepingbag',
    event_joinlist_userinterphone='$userinterphone',event_joinlist_userbag='$userbag',event_joinlist_userBurner='$userBurner',
    event_joinlist_userpot='$userpot',event_joinlist_comments='$comments',event_joinlist_insurance='$insurance',
    event_joinlist_declare='$declare',event_joinlist_qq='$userqq',event_joinlist_weiboName='$weiboName',event_joinlist_weiboLink='$weiboLink' 
    where event_joinlist_eventid='$eventId' and event_joinlist_useremail ='$useremail'";
    $db->runSql($sql);
    $db->closeDb();
    if ($db->errno()!=0)
    {
        die("Error:".$db->errmsg());
        echo "error update";
    }
    else
    {
        // 更新资料成功回到活动列表页面
        header('Location: ../joinlist.php?eventId='.$eventId);
    }
}
?>
</body>
<?php include 'foot.php'; ?>
</html>
