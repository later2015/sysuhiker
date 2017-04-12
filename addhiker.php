<?php ob_start(); ?>
<?php $navvar = "index";
    include 'navigation.php';
?>
<body>
    <?php
    // 设置使用北京时间
    date_default_timezone_set('PRC');
    // 用户填写报名申请以后的数据处理文件。需要先检查数据合法性，然后写入数据库
    // 获取报名用户提交的数据
    $eventId = $_GET["eventId"];
    $eventName = $_GET["eventName"];
    $useremail = $_SESSION["currentUserEmail"];
    $eventType = $_GET["eventType"];
    if (isset($_POST["userrole"]) && isset($_POST["username"]) && isset($_POST["usernick"]) && isset($_POST["userphone"]) && isset($_POST["useraddress"]) && isset($_POST["userurgentname"]) && isset($_POST["userurgentphone"])) {
        if (similar_text($eventType, "露营") == 6) {
            if (isset($_POST["declare"]) && isset($_POST["usercamp"]) && isset($_POST["usersleepingbag"]) && isset($_POST["usercamppad"]) && isset($_POST["insurance"]) && isset($_POST["userinterphone"]) && isset($_POST["userbag"]) && isset($_POST["userBurner"]) && isset($_POST["userpot"])) {

            } else {
                echo "请认真填写个人装备信息，除了备注，任何一项都不可留空！请后退到上一页补充齐资料再提交。";
                exit ;
            }
        }
        $username1 = $_POST["username"];
        // 参加者真实姓名
        $usernick1 = $_POST["usernick"];
        // 昵称
        $usergender1 = $_POST["usergender"];
        // 性别
        $userqq = $_POST["userqq"];
        // QQ
        $weiboName = $_POST["weiboName"];
        // weibo
        $weiboLink = $_POST["weiboLink"];
        // weibo

        $userphone = $_POST["userphone"];
        // 电话
        $useraddress = $_POST["useraddress"];
        // 地址
        $userurgentname = $_POST["userurgentname"];
        // 紧急联系人
        $userurgentphone = $_POST["userurgentphone"];
        // 紧急联系人电话

        $comments = $_POST["comments"];
        // 备注
        $insurance = $_POST["insurance"];
        // 保险信息

        $declare = implode("+", $_POST["declare"]);
        // 免责声明
        $usercamparray = $_POST["usercamp"];
        // 帐篷
        $usercamp = implode("+", $usercamparray);
        $usersleepingbag = $_POST["usersleepingbag"];
        // 睡袋
        $usercamppad = implode("+", $_POST["usercamppad"]);
        // 防潮垫
        $userinterphone = implode("+", $_POST["userinterphone"]);
        // 对讲机
        $userbag = $_POST["userbag"];
        // 登山包
        $userBurner = implode("+", $_POST["userBurner"]);
        // 炉头
        $userpot = implode("+", $_POST["userpot"]);
        // 套锅
        $userrolearray = $_POST["userrole"];
        // 用户角色
        $userrole = implode("+", $userrolearray);
    } else {
        $error = true;
        echo "请认真填写报名信息，除了备注，任何一项都不可留空！请后退到上一页补充齐资料再提交。";
        echo "<br>";
        exit ;
    }
    //检查check box的值
    function Check_checkbox($checkbox) {
        if ($checkbox == "")
            return FALSE;
        return TRUE;
    }

    // 判断用户名函数
    function Check_username($UserName)// 参数为用户注册的用户名
    {
        // 用户名三个方面检查
        // 是否为空 字符串检测 长度检测
        $Max_Strlen_UserName = 16;
        // 用户名最大长度
        $Min_Strlen_UserName = 2;
        // 用户名最短长度
        $UserNameChars = "/[\x{4e00}-\x{9fa5}]/u";
        // UTF8环境下中文检测的正则表达式
        $UserNameGood = " 用户名检测正确 ";
        // 定义返回的字符串变量
        if ($UserName == "") {
            $UserNameGood = " 用户名不能为空 ";
            return $UserNameGood;
        }
        if (!preg_match("$UserNameChars", $UserName))// 正则表达式匹配检查
        {
            $UserNameGood = " 用户名字符串检测不正确 ";
            return $UserNameGood;
        }
        if (strlen($UserName) < $Min_Strlen_UserName || strlen($UserName) > $Max_Strlen_UserName) {
            $UserNameGood = " 用户名字长度检测不正确 ";
            return $UserNameGood;
        }
        return $UserNameGood;
    }

    // 调用函数，检测活动参加者输入的数据
    $UserNameGood = Check_username($username1);
    //$EmailGood = Check_Email($useremail1);
    //$PasswordGood = Check_Password($userpsw);
    //$ConfirmPasswordGood = Check_ConfirmPassword($userpsw, $userpsw2);
    $CheckboxGood = Check_checkbox($userrolearray);
    //用户角色
    //$userpotGood = Check_checkbox($userpot);
    $error = false;
    // 定义变量判断注册数据是否出现错误
    if ($UserNameGood != " 用户名检测正确 ") {
        $error = true;
        // 改变 error 的值表示出现了错误
        echo $UserNameGood;
        // 输出错误信息
        echo "<br>";
    }

    if (!$CheckboxGood) {
        $error = true;
        echo "请选择用户角色！";
        echo "<br>";
    }
    // 如果数据检测都合法，则将活动报名者填写的资料写进数据库表
    if ($error == false)// $error==false 表示没有错误
    {

        $Datetime = date("Y-m-d H:i:s");
        // 获取报名时间，也就是数据写入到用户表的时间
        //$dbpsw = md5(crypt($userpsw, substr($userpsw, 0, 3)));
        $dbpsw = "NONE";
        $userId = $_SESSION["currentUserId"];
        $db = new SaeMysql();
        //定义要数据库执行的sql语句
        $sql = "INSERT INTO event_joinlist (event_joinlist_eventid,
    event_joinlist_eventname,event_joinlist_userid,
    event_joinlist_username,event_joinlist_usernick,
    event_joinlist_userrole,event_joinlist_userpsw,
    event_joinlist_usergender,event_joinlist_userphone,
    event_joinlist_useremail,event_joinlist_qq,
    event_joinlist_weiboName,event_joinlist_weiboLink,event_joinlist_useraddress,
    event_joinlist_userurgentname,event_joinlist_userurgentphone,
    event_joinlist_usercamp,event_joinlist_usercamppad,
    event_joinlist_usersleepingbag,event_joinlist_userinterphone,
    event_joinlist_userbag,event_joinlist_userBurner,
    event_joinlist_userpot,event_joinlist_joindate,
    event_joinlist_comments,event_joinlist_insurance,
    event_joinlist_declare,event_joinlist_assessment,event_joinlist_status) VALUES
    ('$eventId',
    '$eventName','$userId',
    '$username1','$usernick1',
    '$userrole','$dbpsw',
    '$usergender1','$userphone',
    '$useremail','$userqq',
    '$weiboName','$weiboLink','$useraddress',
    '$userurgentname','$userurgentphone',
    '$usercamp','$usercamppad',
    '$usersleepingbag','$userinterphone',
    '$userbag','$userBurner',
    '$userpot','$Datetime',
    '$comments','$insurance',
    '$declare','60','待审核')";

        $db -> runSql($sql);
        if ($db -> errno() != 0) {
            die("Error:" . $db -> errmsg());
        } else// php 中 mail() 函数用来发送邮件，需要更改 php.ini 文件，最好安装 SMTP 服务器
        {
            $_SESSION["testPassed"]=FALSE; //加上此举让每次测试只能填写一个活动的报名表格。
            echo "成功报名";
            echo "跳转" . $_SESSION['join_jumpURL'];
            if (!empty($_SESSION['join_jumpURL'])) {
                echo "跳转";
                header('Location: ' . $_SESSION['join_jumpURL']);
            }
        }
        $db -> closeDb();
    }
?>
</body>
<?php
    include 'foot.php';
 ?>
</html>
