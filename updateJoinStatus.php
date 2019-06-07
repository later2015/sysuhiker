<?php ob_start(); ?>
<?php $navvar = "index";
    include 'navigation.php';
?>
<body>
	<?php
    $joinListId = $_GET["joinListId"];
    $joinStatus = $_GET["joinStatus"];
    $joinListUserEmail = $_GET["joinListUserEmail"];
    $db = new SaeMysql();
    $sql = "UPDATE event_joinlist SET event_joinlist_status ='$joinStatus' WHERE event_joinlist_ID='$joinListId'";
    $db -> runSql($sql);
    if ($db -> errno() != 0) {
        die("Error:" . $db -> errmsg());
    } else {
//        $to = $joinListUserEmail;
//        // 用户注册的邮箱
//        $subject = "$joinListUserEmail 被领队审核为 $joinStatus";
//        $URL = "http://sysuhiker.cc" . $_SESSION['join_jumpURL'];
//        $message = "尊敬的用户:$joinListUserEmail  \r\n你在逸仙徒步活动平台报名的活动已经被领队审核，审核结果是：$joinStatus \r\n   本邮件是系统通知邮件，有什么疑问请咨询领队，请勿咨询本邮箱。 \r\n活动详情：" . $URL;
//
//        $mail = new EmailUtil();
//        $ret = $mail -> sendEmail($to, $subject, $message);
//        if ($ret === TRUE)//php 中 mail() 函数用来发送邮件，需要更改 php.ini 文件，最好安装 SMTP 服务器
//        {
//            // 产生链接，链接到激活页面
//            echo "审核结果通知邮件已发送。如果无法收到邮件，请检查垃圾箱。遇到困难请联系later.h.p@qq.com";
//        } else {
//            //发送失败时输出错误码和错误信息
//            var_dump($mail -> errno(), $mail -> errmsg());
//        }
//
//        $mail -> clean();
        // 重用此对象
        if (!empty($_SESSION['join_jumpURL'])) {
            header('Location: ' . $_SESSION['join_jumpURL']);
            //调到joinlist的页面
        }
    }
?>

	<?php
    $db -> closeDb();
	?>
</body>
<?php
    include 'foot.php';
?>
</html>