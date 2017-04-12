<?php ob_start(); ?>
<?php $navvar = "event";
include 'navigation.php';?>
<body>
		<?php
// 设置使用北京时间
date_default_timezone_set('PRC');
// 用户填写活动申请以后的数据处理文件。需要先检查数据合法性，然后写入数据库
// 获取用户提交的数据
$currentUserId=$_SESSION["currentUserId"];
if(isset($_POST["eventname"])&&isset($_POST["eventType"])&&isset($_POST["eventDetail"])&&isset($_POST["eventStartTime"])&&isset($_POST["eventEndTime"])
        &&isset($_POST["joinStartTime"])&&isset($_POST["joinEndTime"])){
            $eventId=$_GET['eventId'];
$eventname= $_POST["eventname"]; // 活动名称
$eventType = $_POST["eventType"]; // 活动类型
$eventDetail = $_POST["eventDetail"]; // 活动详情
$eventStartTime = $_POST["eventStartTime"]; // 活动开始时间
$eventEndTime= $_POST["eventEndTime"]; // 活动结束时间
$joinStartTime = $_POST["joinStartTime"]; // 报名开始时间
$joinEndTime= $_POST["joinEndTime"]; // 报名截止时间
$eventMaxHiker = $_POST["eventMaxHiker"]; // 备注
$comments = $_POST["comments"]; // 备注
    $error = false;
}else{
    $error = true;
    echo "请认真填写活动信息，除了备注，任何一项都不可留空！请后退到上一页补充齐资料再提交。";
    echo "<br>";
}

// 如果数据检测都合法，则将活动信息写进数据库表
if ($error == false) // $error==false 表示没有错误
{
    
    $Datetime = date("Y-m-d H:i:s"); // 获取当前活动创建的时间，也就是数据写入到用户表的时间
    $db = new SaeMysql();
    //定义要数据库执行的sql语句 
    $sql = "update event_info set event_name='$eventname',
    event_type='$eventType',event_detail='$eventDetail',event_starttime='$eventStartTime',
    event_endtime='$eventEndTime',event_join_starttime='$joinStartTime',
    event_join_endtime='$joinEndTime',event_maxhiker='$eventMaxHiker',event_comments='$comments' 
    where event_id='$eventId'";
    
    $db->runSql($sql);
    if ($db->errno() != 0) {
        die("Error:" . $db->errmsg());
    }     

    else   
    {
        // 产生链接，链接到激活页面
        header('Location: eventlist.php');
        ?>
		活动更新成功！
    <?php
    }
    $db->closeDb();
}
?>

		<!-- 		$to=$useremail1;// 用户注册的邮箱
		$subject="报名成功";
		$message="恭喜你！你报名成功了！";
		$header="From:later.h.p@qq.com"."\r\n";// 邮件头信息
		if(mail($to,$subject,$message,$header))//php 中 mail() 函数用来发送邮件，需要更改 php.ini 文件，最好安装 SMTP 服务器
		{
		// 产生链接，链接到激活页面
		?> -->
</body>
<?php include 'foot.php'; ?>
</html>
