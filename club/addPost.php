<?php ob_start(); ?>
<?php $navvar = "club";
include '../navigation.php'; ?>
<body>
<?php
// 设置使用北京时间
date_default_timezone_set('PRC');
// 用户填写活动申请以后的数据处理文件。需要先检查数据合法性，然后写入数据库
// 获取用户提交的数据
$currentUserId=$_SESSION["currentUserId"];
if(isset($_POST["postTitle"])&&isset($_POST["postType"])&&isset($_POST["postDetail"])){
	$postTitle= $_POST["postTitle"]; // 活动名称
	$postType = $_POST["postType"]; // 活动类型
	$postDetail= $_POST["postDetail"]; // 活动详情
	$postKeywords = $_POST["postKeywords"]; // 活动开始时间
	$error = false;
}else{
    $error = true;
    echo "发帖请填写标题内容！";
    echo "<br>";
}

// 如果数据检测都合法，则将活动信息写进数据库表
if ($error == false) // $error==false 表示没有错误
{
    //now()
    //$Datetime = date("Y-m-d H:i:s"); // 获取当前活动创建的时间，也就是数据写入到用户表的时间
    $db = new SaeMysql();
    //定义要数据库执行的sql语句 
    $sql = "INSERT INTO event_bbs  (post_title,
    post_type,post_detail,post_keywords,
    post_createTime,post_createUserId,
    post_modifyTime,post_modifyUserId,post_permission,
    post_up,post_down,post_count,post_countRe) VALUES
    ('$postTitle','$postType',
    '$postDetail','$postKeywords',
    now(),'$currentUserId',
    now(),'$currentUserId','公开',
    0,0,0,0)";
    
    $db->runSql($sql);
    if ($db->errno() != 0) {
        die("Error:" . $db->errmsg());
    }     
    // 给报名成功的用户发送email通知
    else     // php 中 mail() 函数用来发送邮件，需要更改 php.ini 文件，最好安装 SMTP 服务器
    {
        // 产生链接，链接到激活页面
        header('Location: ' . 'postList.php');
        exit();
		?>
		发表成功！
    <a href="index.php">返回首页</a> <br>
    
	<?php
    }
    $db->closeDb();
}
?>
</body>

<?php include '../foot.php';?>
</html>
