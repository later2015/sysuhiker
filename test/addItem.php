<?php $navvar = "test";
include '../navigation.php'; ?>

<body>
		<?php
// 设置使用北京时间
date_default_timezone_set('PRC');
$userId=$_SESSION["currentUserId"];
$userNick=$_SESSION["currentUserNick"];

// 用户填写活动申请以后的数据处理文件。需要先检查数据合法性，然后写入数据库
// 获取用户提交的数据
if(isset($_POST["itemDetail"])&&isset($_POST["itemOptions"])&&isset($_POST["itemAnswer"])){
$itemDetail = $_POST["itemDetail"]; // 题目描述
$itemOptions = $_POST["itemOptions"]; // 题目选项数
$itemAnswer = $_POST["itemAnswer"]; // 题目答案
    $error = false;
}else{
    $error = true;
    echo "请认真填写题目信息，任何一项都不可留空！请后退到上一页补充齐资料再提交。";
    echo "<br>";
}

// 如果数据检测都合法，则将活动信息写进数据库表
if ($error == false) // $error==false 表示没有错误
{
    
    $Datetime = date("Y-m-d H:i:s"); // 获取当前活动创建的时间，也就是数据写入到用户表的时间
    $db = new SaeMysql();
    //定义要数据库执行的sql语句 
    $sql = "INSERT INTO event_itemPool  (item_detail,
    item_options,item_answer,item_ownerId,
    item_ownerNick,item_createtime,item_status) VALUES
    ('$itemDetail','$itemOptions',
    '$itemAnswer','$userId',
    '$userNick','$Datetime','待审核')";
    
    $db->runSql($sql);
    if ($db->errno() != 0) {
        die("Error:" . $db->errmsg());
    }     
    else     // php 中 mail() 函数用来发送邮件，需要更改 php.ini 文件，最好安装 SMTP 服务器
    {
        ?>
		提交成功！非常感谢你为丰富测试题库所作出的贡献。<br>
    <a href="itemlist.php" class="btn">返回测试首页</a> <br>
    <a href="item.php" class="btn">继续提交题目</a> <br>
    <?php
    }
    $db->closeDb();
}
?>
</body>
<?php include '../foot.php'; ?>
</html>
