<?php $navvar = "index";
include 'navigation.php'; ?>
<body>
<?php
// 设置使用北京时间
date_default_timezone_set('PRC');
// 用户填写报名申请以后的数据处理文件。需要先检查数据合法性，然后写入数据库
// 获取用户注册资料
if (isset($_POST["username"]) && isset($_POST["useremail"]) && isset($_POST["userpsw"])
    && isset($_POST["userpsw2"]) && isset($_POST["userphone"]) && isset($_POST["userrole"])) {
    $username1 = $_POST["username"]; // 参加者真实姓名
    $usernick1 = $_POST["usernick"]; // 昵称
    $usergender1 = $_POST["usergender"]; // 性别
    $userpsw = $_POST["userpsw"]; // 安全口令
    $userpsw2 = $_POST["userpsw2"]; // 确认安全口令
    $useraddress = $_POST["useraddress"]; // 地址
    $userphone = $_POST["userphone"]; // 电话
    $useremail1 = $_POST["useremail"]; // 邮箱
    $userqq = $_POST["userqq"]; // QQ
    $weiboName = $_POST["weiboName"]; // 微博名
    $weiboLink = $_POST["weiboLink"]; // 微博地址
    $userurgentname = $_POST["userurgentname"]; // 紧急联系人
    $userurgentphone = $_POST["userurgentphone"]; // 紧急联系人电话
    $userrolearray = $_POST["userrole"]; // 兴趣领域&用户角色
    $userrole = implode("+", $userrolearray);
    $comments = $_POST["comments"]; // 个人介绍
} else {
    $error = true;
    echo "请认真填写注册信息，Email、密码、电话、真实姓名是必填项。";
    echo "返回填写完整再提交。<br>";
    exit;
}
//检查check box的值
function Check_checkbox($checkbox)
{
    if ($checkbox == "")
        return FALSE;
    return TRUE;
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
    if ($userEmail == $Email) {
        $EmailGood = " 邮箱已注册，请使用注册邮箱和密码登录。 ";
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

// 判断密码是否合法函数
function Check_Password($Password)
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
    if (!preg_match("$PasswordChars", $Password)) {
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
function Check_ConfirmPassword($Password, $ConfirmPassword)
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
if ($PasswordGood != " 密码检测正确 ") {
    $error = true;
    echo $PasswordGood;
    echo "<br>";
}
if ($ConfirmPasswordGood != " 两次密码输入一致 ") {
    $error = true;
    echo $ConfirmPasswordGood;
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

    $Datetime = date("Y-m-d H:i:s"); // 获取报名时间，也就是数据写入到用户表的时间
    $dbpsw = md5(crypt($userpsw, substr($userpsw, 0, 3)));
    $key = md5($useremail1 . $Datetime);
    $db = new SaeMysql();
    //定义要数据库执行的sql语句 
    $sql = "INSERT INTO event_hiker  (user_name,
    user_nick,user_gender,
    user_psw,user_address,
    user_phone,user_email,
    user_qq,user_weiboName,
    user_weiboLink,user_urgentName,
    user_urgentPhone,user_interest,
    user_experienceGrade,user_knowledgeScore,
    user_comments,user_createtime) VALUES
    ('$username1',
    '$usernick1','$usergender1',
    '$dbpsw','$useraddress',
    '$userphone','$useremail1',
    '$userqq','$weiboName',
    '$weiboLink','$userurgentname',
    '$userurgentphone','$userrole',
    '邮箱未激活','$key',
    '$comments','$Datetime')";

    $db->runSql($sql);
    if ($db->errno() != 0) {
        die("Error:" . $db->errmsg());
    } // 给报名成功的用户发送email通知
    else     // php 中 mail() 函数用来发送邮件，需要更改 php.ini 文件，最好安装 SMTP 服务器
    {
        // 产生链接，链接到激活页面
        ?>
        注册成功！欢迎加入逸仙徒步大家庭，马上来参加活动吧。<br>
        微信搜索并关注“逸仙徒步”公众号，可以第一时间收到逸仙徒步的活动推送哦！<br>
        <?php
        //发送激活邮件地址
//        $to = $useremail1;// 用户注册的邮箱
//        $subject = "逸仙徒步新驴友 $username1 的激活信息";
//        $activeURL = "http://sysuhiker.cc/active.php?key=" . $key . "&email=" . $to;
//        $message = "$username1 \r\n你好，逸仙徒步活动平台提醒你，你的注册信息已经提交成功。\r\n 为了验证邮箱地址的正确性，请在激活页面输入激活码，或者点击以下地址激活你的邮箱。 \r\n激活码：" . $key . "     激活地址：" . $activeURL;
//        //$from="SYSU_Hiker@126.com";// 邮件头信息
//        //$from="sysuhiker@sina.com";
//        //$mail = new SaeMail();
//        //$mail->setAttach( array( 'my_photo' => '照片的二进制数据' ) );
//        //$ret = $mail->quickSend( $to,$subject,$message,$from , '303201239' );
//        $mail = new EmailUtil();
//        $ret = $mail->sendEmail($to, $subject, $message);
//        if ($ret === TRUE)//php 中 mail() 函数用来发送邮件，需要更改 php.ini 文件，最好安装 SMTP 服务器
//        {
//            echo "激活邮件已发送。如果无法收到邮件，请检查垃圾箱。遇到困难请联系later.h.p@qq.com";
//        } else {
//            //发送失败时输出错误码和错误信息
//            echo "果然邮件好像真的发生失败了...<br>";
//            //var_dump($mail->errno(), $mail->errmsg());
//        }
//
//        $mail->clean();
    }
    $db->closeDb();
}
?>
</body>
<?php include 'foot.php'; ?>
</html>
