<?php $navvar = "index";
include 'navigation.php'; ?>
<body>
		<?php
// 设置使用北京时间
date_default_timezone_set('PRC');
// 用户填写报名申请以后的数据处理文件。需要先检查数据合法性，然后写入数据库
// 获取用户注册资料
if(isset($_POST["username"])&&isset($_POST["userphone"])&&isset($_POST["userrole"])){
$username1 = $_POST["username"]; // 参加者真实姓名
$usernick1 = $_POST["usernick"]; // 昵称
$usergender1 = $_POST["usergender"]; // 性别
$userpsw0 = $_POST["userpsw0"]; // 旧密码
$userpsw = $_POST["userpsw"]; // 新密码
$userpsw2 = $_POST["userpsw2"]; // 确认新密码
$useraddress = $_POST["useraddress"]; // 地址
$userphone = $_POST["userphone"]; // 电话
//$useremail1 = $_POST["useremail"]; // 邮箱
$useremail1=$_SESSION["currentUserEmail"];
$userqq = $_POST["userqq"]; // QQ
$weiboName = $_POST["weiboName"]; // 微博名
$weiboLink = $_POST["weiboLink"]; // 微博地址
$userurgentname = $_POST["userurgentname"]; // 紧急联系人
$userurgentphone = $_POST["userurgentphone"]; // 紧急联系人电话
$userrolearray = $_POST["userrole"]; // 兴趣领域&用户角色
$userrole=implode("+",$userrolearray);
$comments = $_POST["comments"]; // 个人介绍

}else{
    $error = true;
    echo "请认真填写个人资料，Email、电话、真实姓名是必填项。";
    echo "返回填写完整再提交。<br>";
    exit;
}
//检查check box的值
function Check_checkbox($checkbox){
    if ($checkbox=="")
        return FALSE;
    return TRUE;
}
// 判断用户名函数
function Check_username ($UserName) // 参数为用户注册的用户名
{
    // 用户名三个方面检查
    // 是否为空 字符串检测 长度检测
    $Max_Strlen_UserName = 16;// 用户名最大长度
    $Min_Strlen_UserName = 2;// 用户名最短长度
    $UserNameChars = "/[\x{4e00}-\x{9fa5}]/u";// UTF8环境下中文检测的正则表达式
    $UserNameGood = " 用户名检测正确 ";
    // 定义返回的字符串变量
    if ($UserName == "") {
        $UserNameGood = " 真实姓名不能为空 ";
        return $UserNameGood;
    }
    if (! preg_match("$UserNameChars", $UserName))     // 正则表达式匹配检查
    {
        $UserNameGood = "真实姓名必需为中文 ";
        return $UserNameGood;
    }
    if (strlen($UserName) < $Min_Strlen_UserName ||
             strlen($UserName) > $Max_Strlen_UserName) {
        $UserNameGood = " 真实姓名长度不合理";
        return $UserNameGood;
    }
    return $UserNameGood;
}


// 判断邮箱是否合法函数
function Check_Email ($Email)
{
    $EmailChars = "/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*$/";
    // 正则表达式判断是否是合法邮箱地址
    $EmailGood = " 邮箱检测正确 ";
    if ($Email == "") {
        $EmailGood = " 邮箱不能为空 ";
        return $EmailGood;
    }
    if (! preg_match("$EmailChars", $Email))     // 正则表达式匹配检查
    {
        $EmailGood = " 邮箱格式不正确 ";
        return $EmailGood;
    }
    return $EmailGood;
}
// 判断密码是否合法函数
function Check_Password ($Password)
{
    // 是否为空 字符串检测 长度检测
    $Max_Strlen_Password = 16; // 密码最大长度
    $Min_Strlen_Password = 6; // 密码最短长度
    $PasswordChars = "/^[A-Za-z0-9_-]/"; // 密码字符串检测正则表达式
    $PasswordGood = " 密码检测正确 "; // 定义返回的字符串变量
    if ($Password == "") {
        $PasswordGood = " 密码不能为空 ";
        return $PasswordGood;
    }
    if (! preg_match("$PasswordChars", $Password)) {
        $PasswordGood = " 密码字符串检测不正确 ";
        return $PasswordGood;
    }
    if (strlen($Password) < $Min_Strlen_Password ||
             strlen($Password) > $Max_Strlen_Password) {
        $PasswordGood = " 密码长度检测不正确 ";
        return $PasswordGood;
    }
    return $PasswordGood;
}

// 判断两次密码输入是否一致
function Check_ConfirmPassword ($Password, $ConfirmPassword)
{
    $ConfirmPasswordGood = " 两次密码输入一致 ";
    if ($Password != $ConfirmPassword) {
        $ConfirmPasswordGood = " 两次密码输入不一致 ";
        return $ConfirmPasswordGood;
    } else
        return $ConfirmPasswordGood;
}

// 调用函数，检测活动参加者输入的数据
$UserNameGood = Check_username($username1);
$EmailGood = Check_Email($useremail1);
$PasswordGood = Check_Password($userpsw);
$ConfirmPasswordGood = Check_ConfirmPassword($userpsw, $userpsw2);
$error = false; // 定义变量判断注册数据是否出现错误
if ($UserNameGood != " 用户名检测正确 ") {
    $error = true; // 改变 error 的值表示出现了错误
    echo $UserNameGood; // 输出错误信息
    echo "<br>";
}

if ($EmailGood != " 邮箱检测正确 ") {
    $error = true;
    echo $EmailGood;
    echo "<br>";
}

// 如果数据检测都合法，则将活动报名者填写的资料写进数据库表
if ($error == false) // $error==false 表示没有错误
{
     $db = new SaeMysql();
     
    $oldpsw=md5(crypt($userpsw0, substr($userpsw0, 0, 3)));//输入的旧密码
    $checksql="select user_psw from event_hiker where user_email='".$useremail1."'";
    $olddbpsw=$db->getVar($checksql);//DB的旧密码
    $dbpsw = md5(crypt($userpsw, substr($userpsw, 0, 3)));//输入的新密码
    if($userpsw0=="" && $userpsw2==""&& $userpsw =="")
        {
            $dbpsw=$olddbpsw;
            $oldpsw=$olddbpsw;
        }else{
            if ($PasswordGood != " 密码检测正确 ") {
                $error = true;
                echo $PasswordGood;
                echo "<br>";
                exit;
            }
            if ($ConfirmPasswordGood != " 两次密码输入一致 ") {
                $error = true;
                echo $ConfirmPasswordGood;
                echo "<br>";
                exit;
            }
        }
    if($oldpsw==$olddbpsw){
    //$Datetime = date("Y-m-d H:i:s"); // 获取时间，也就是数据写入到用户表的时间

    $key=md5($useremail1.$Datetime);
    
    //定义要数据库执行的sql语句 
    $sql = "update event_hiker set user_name='$username1',
    user_nick='$usernick1',user_gender='$usergender1',
    user_psw='$dbpsw',user_address='$useraddress',
    user_phone='$userphone',
    user_qq='$userqq',user_weiboName='$weiboName',
    user_weiboLink='$weiboLink',user_urgentName='$userurgentname',
    user_urgentPhone='$userurgentphone',user_interest='$userrole',user_comments='$comments' where user_email='$useremail1'";
    
    $db->runSql($sql);
    if ($db->errno() != 0) {
        die("Error:" . $db->errmsg());
    }     
    else      
    {
		echo "修改成功！";
    }
    $db->closeDb();
            
    }else{
        echo "旧密码错误。";
        exit;
    }
}
?> 
</body>
<?php include 'foot.php'; ?>
</html>
