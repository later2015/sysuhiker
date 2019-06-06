<?php $navvar = "index";
include 'navigation.php';
?>
<body>
<?php
// 设置使用北京时间
date_default_timezone_set('PRC');
// 用户填写报名申请以后的数据处理文件。需要先检查数据合法性，然后写入数据库
// 获取用户注册资料
if (isset($_POST["username"]) && isset($_POST["useremail"])) {
    $username = $_POST["username"]; // 参加者真实姓名
    $useremail = $_POST["useremail"]; // 邮箱
    $validCode = $_POST["validCode"];//安全码
} else {
    $error = true;
    echo "请认真填写Email、真实姓名。";
    echo "返回填写完整再提交。<br>";
    exit;
}
function checkValidCode($validCode)
{
    $dateTime = date("YYmmddHHiiss");
    $serverValidCode = substr(md5($dateTime), 0, 6);
    $validCodeResult = "true";
    if ($validCode != $serverValidCode) {
        $validCodeResult = "安全码错误";
    }
    return $validCodeResult;
}

// 判断用户名函数
function Check_username($UserName) // 参数为用户注册的用户名
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
    if (!preg_match("$UserNameChars", $UserName))     // 正则表达式匹配检查
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
function Check_Email($Email)
{
    $db = new SaeMysql();
    $getEmailSql = "select user_email from event_hiker where user_email='$Email'";
    $userEmail = $db->getVar($getEmailSql);
    $db->closeDb();
    if ($userEmail != $Email) {
        $EmailGood = " 邮箱不存在！ ";
        return $EmailGood;
    }
    $EmailChars = "/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*$/";
    // 正则表达式判断是否是合法邮箱地址
    $EmailGood = " 邮箱检测正确 ";
    if ($Email == "") {
        $EmailGood = " 邮箱不能为空 ";
        return $EmailGood;
    }
    if (!preg_match("$EmailChars", $Email))     // 正则表达式匹配检查
    {
        $EmailGood = " 邮箱格式不正确 ";
        return $EmailGood;
    }
    return $EmailGood;
}


// 调用函数，检测活动参加者输入的数据
$UserNameGood = Check_username($username);
$EmailGood = Check_Email($useremail);
$validCodeGood = checkValidCode($validCode);

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
if ($validCodeGood != "true") {
    $error = true;
    echo $validCodeGood;
    echo "<br>";
}
// 如果数据检测都合法，则重置密码并告诉用户新密码
if ($error == false) // $error==false 表示没有错误
{
    $db = new SaeMysql();
    $getUserSql = "select user_email,user_name from event_hiker where user_email='$useremail'";
    $result = $db->getData($getUserSql);
    $oldUserEmail = $result[0]['user_email'];
    $oldUserName = $result[0]['user_name'];
    if ($oldUserName == $username) {
        $userpsw = substr(md5($username), 0, 4) . rand(1000, 999999);
        $dbpsw = md5(crypt($userpsw, substr($userpsw, 0, 3)));//系统生成的新密码
        $passwordUpdateSql = "update event_hiker set user_psw='$dbpsw' where user_email='$useremail'";

        $db->runSql($passwordUpdateSql);
        if ($db->errno() != 0) {
            die("Error:" . $db->errmsg());
        } else {// 给用户发送新密码
            echo "新密码是：$userpsw     \r\n";
            ?>
            密码重置成功！<br>
            <a href="index.php" class="btn">登录</a>
            <?php
//    $to = $useremail;
//    // 用户注册的邮箱
//    $subject = "逸仙徒步用户 $username 的密码重置信息";
//    $URL = "http://sysuhiker.cc/";
//    $message = "尊敬的$username \r\n逸仙徒步活动平台提醒你，$oldUserEmail 的用户密码已经成功重置。 新密码是：$userpsw     \r\n请马上用新密码登录你的帐号，并修改更新密码。登录地址：" . $URL;
//    // 邮件头信息
//    $mail = new EmailUtil();
//    $ret = $mail -> sendEmail($to, $subject, $message);
//    if ($ret === TRUE) {
//        echo "<br>>>重置密码邮件已成功发送>>>如果无法收到邮件，请检查垃圾箱。遇到困难请联系later.h.p@qq.com";
//    } else {
//        echo "<br>邮件发送失败...<br>";
//        //var_dump($mail -> errno(), $mail -> errmsg());
//    }
        }
        $db->closeDb();

    } else {
        echo "用户真实姓名跟email地址不匹配。";
    }
}
?>
</body>
<?php
include 'foot.php';
?>
</html>
