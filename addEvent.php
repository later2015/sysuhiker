<?php ob_start(); ?>
<?php $navvar = "event";
    include 'navigation.php';
?>
<body>
    <?php
    // 设置使用北京时间
    date_default_timezone_set('PRC');
    // 用户填写活动申请以后的数据处理文件。需要先检查数据合法性，然后写入数据库
    // 获取用户提交的数据
    $currentUserId = $_SESSION["currentUserId"];
    $currentUserNick = $_SESSION["currentUserNick"];
    if (isset($_POST["eventname"]) && isset($_POST["eventType"]) && isset($_POST["eventDetail"]) && isset($_POST["eventStartTime"]) && isset($_POST["eventEndTime"]) && isset($_POST["joinStartTime"]) && isset($_POST["joinEndTime"])) {
        $eventname = $_POST["eventname"];
        // 活动名称
        $eventType = $_POST["eventType"];
        // 活动类型
        $eventDetail = $_POST["eventDetail"];
        // 活动详情
        $eventStartTime = $_POST["eventStartTime"];
        // 活动开始时间
        $eventEndTime = $_POST["eventEndTime"];
        // 活动结束时间
        $joinStartTime = $_POST["joinStartTime"];
        // 报名开始时间
        $joinEndTime = $_POST["joinEndTime"];
        // 报名截止时间
        $eventMaxHiker = $_POST["eventMaxHiker"];
        // 备注
        $comments = $_POST["comments"];
        // 备注
        $error = false;
    } else {
        $error = true;
        echo "请认真填写活动信息，除了备注，任何一项都不可留空！请后退到上一页补充齐资料再提交。";
        echo "<br>";
    }

    // 如果数据检测都合法，则将活动信息写进数据库表
    if ($error == false)// $error==false 表示没有错误
    {

        $Datetime = date("Y-m-d H:i:s");
        // 获取当前活动创建的时间，也就是数据写入到用户表的时间
        $db = new SaeMysql();
        //定义要数据库执行的sql语句
        $sql = "INSERT INTO event_info (event_name,
    event_type,event_detail,event_starttime,
    event_endtime,event_join_starttime,
    event_join_endtime,event_maxhiker,event_comments,
    event_createtime,event_createUserId) VALUES
    ('$eventname','$eventType',
    '$eventDetail','$eventStartTime',
    '$eventEndTime','$joinStartTime',
    '$joinEndTime','$eventMaxHiker','$comments',
    '$Datetime','$currentUserId')";

        $db -> runSql($sql);
        if ($db -> errno() != 0) {
            die("Error:" . $db -> errmsg());
        } else {
            //活动发起成功之后，调用微信借口，给认证队员发生活动通知。
            $eventId = $db -> lastId();
            $link = 'http://sysuhiker.cc/joinlist.php?eventId=' . $db -> lastId();
            $eventAbstract = substr(strip_tags(str_replace("<br />", "\n", $eventDetail)), 0, 1500) . "……\n";
            if (similar_text($eventType, '露营') === 6) {
                $wxTips = "";
            } else {
                $wxTips = "\n\n本次活动支持微信报名哦，已经在逸仙徒步活动平台上注册了帐号的朋友，可以直接回复“活动报名:活动id#昵称#电话#备注”报名参加活动！本次活动ID是：" . $db -> lastId();
            }
            $content = $currentUserNick . " 发起了活动啦！快来报名吧！\n" . $eventname . "\n\n活动时间：" . $eventStartTime . " 到 " . $eventEndTime . "\n\n" . $eventAbstract . "\n活动链接:" . $link . $wxTips;
            include ("user_remote.php");
            $wx = new user_remote();
            $wx -> sendWxNotice($content);
            //自动添加活动发起人到活动报名列表
            $userId = $_SESSION["currentUserId"];
            addOriginator($userId, $eventId, $eventname);
            // 跳转到活动列表
            header('Location: eventlist.php');
            echo ";活动发起成功！请密切关注报名情况，做好活动的后续安排。<a href=\"eventlist.php\">返回活动首页</a> <br>";
        }
        $db -> closeDb();
    }

    //自动添加活动发起人
    function addOriginator($userId, $eventId, $eventname) {
        $db = new SaeMysql();
        $getUserSql = "select * from event_hiker where user_id='" . $userId . "'";
        $result = $db -> getLine($getUserSql);
        // 获得数组格式的查询结果
        $username = $result["user_name"];
        $usernick = $result["user_nick"];
        $userrole = $result["user_interest"];
        $usergender = $result["user_gender"];
        $userphone = $result["user_phone"];
        $useremail = $result["user_email"];
        $userqq = $result["user_qq"];
        $weiboName = $result["user_weiboName"];
        $weiboLink = $result["user_weiboLink"];
        $useraddress = $result["user_address"];
        $userurgentname = $result["user_urgentName"];
        $userurgentphone = $result["user_urgentPhone"];
        $dbpsw = $result["user_psw"];

        //露营活动需要填写的装备信息
        $getUserToolsSql = "select * from event_joinlist where event_joinlist_userid='" . $userId . "' order  by event_joinlist_ID DESC";
        $result = $db -> getLine($getUserToolsSql);
        $usercamp = $result["event_joinlist_usercamp"];
        $usercamppad = $result["event_joinlist_usercamppad"];
        $usersleepingbag = $result["event_joinlist_usersleepingbag"];
        $userinterphone = $result["event_joinlist_userinterphone"];
        $userbag = $result["event_joinlist_userbag"];
        $userBurner = $result["event_joinlist_userBurner"];
        $userpot = $result["event_joinlist_userpot"];
        $comments = "请注意及时更新个人装备信息";
        $insurance = "待填写";
        $declare = "Y";
        // 获得第一个查询结果

        // 获取报名时间，也就是数据写入到用户表的时间
        $Datetime = date("Y-m-d H:i:s");
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
    '$eventname','$userId',
    '$username','$usernick',
    '$userrole','$dbpsw',
    '$usergender','$userphone',
    '$useremail','$userqq',
    '$weiboName','$weiboLink','$useraddress',
    '$userurgentname','$userurgentphone',
    '$usercamp','$usercamppad',
    '$usersleepingbag','$userinterphone',
    '$userbag','$userBurner',
    '$userpot','$Datetime',
    '$comments','$insurance',
    '$declare','60','活动发起人')";

        $db -> runSql($sql);
        if ($db -> errno() != 0) {
            die("Error:" . $db -> errmsg());
        }
        $db -> closeDb();

    }
    ?>
</body>
<?php
include 'foot.php';
?>
</html>
