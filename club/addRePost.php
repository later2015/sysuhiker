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
$useremail=$_SESSION["currentUserEmail"];
 if(isset($_SESSION["currentUserEmail"])&&isset($_SESSION[$useremail."flag"])&& $_SESSION[$useremail."flag"] == TRUE){
if(isset($_POST["reDetail"])){
$postId= $_GET["postId"]; // 帖子ID
//$orderId= $_GET["orderId"]+1; // 回复帖子ID
//$orderId= 0; // 回复帖子ID
$reDetail= $_POST["reDetail"]; // 回复内容详情
    $error = false;
}else{
    $error = true;
    echo "不能回复空内容！";
    echo "<br>";
}

// 如果数据检测都合法，则将回复信息写进数据库表
if ($error == false) // $error==false 表示没有错误
{
            require_once ('../dbutil.php');
            $dbutil = new dbutil();
            $orderId=$dbutil->getBbsReCount($postId)+1;
    //now()
    //$Datetime = date("Y-m-d H:i:s"); // 获取当前活动创建的时间，也就是数据写入到用户表的时间
    $db = new SaeMysql();
    //定义要数据库执行的sql语句 
    $sql = "INSERT INTO event_bbs_re  (re_postId,
    re_orderId,re_detail,
    re_createTime,re_createUserId,
    re_modifyTime,re_modifyUserId,re_permission,
    re_up,re_down) VALUES
    ('$postId','$orderId',
    '$reDetail',
    now(),'$currentUserId',
    now(),'$currentUserId','公开',
    0,0)";
        
    $db->runSql($sql);
    
    if ($db->errno() != 0) {
        die("Error:" . $db->errmsg());
    }     
    else      
    {
        $updateReCountSql="update event_bbs set post_countRe='$orderId',post_modifyUserId='$currentUserId',post_modifyTime =now() where post_id ='$postId'";
        //$updatePostSql="update event_bbs set post_countRe,post_modifyUserId,post_modifyTime values('$orderId','$currentUserId',now()) where post_id=".$postId;
        $db->runSql($updateReCountSql);
            if ($db->errno() != 0) {
                die("Error:" . $db->errmsg());
            } 
            else{
                header('Location: postDetail.php?postId='.$postId); 
            }
    }
    $db->closeDb();
}     
} else{?>    
    <form method="post" action="../loginCheck.php">
        <label for="username">Email</label>
        <input id="username" name="useremail" value="" title="username" tabindex="4" type="text" placeholder="邮件">
        <p>
        <label for="password">Password</label>
        <input id="password" name="userpsw" value="" title="password" tabindex="5" type="password" placeholder="密码">
        </p>
        
        <input value="登录" tabindex="6" type="submit" class="btn btn-primary"><input id="remember0" name="remember0" value="1" tabindex="7" type="checkbox"><a class="help-inlin">记住我</a>
        <a href="register.php" class="btn">注册</a><a href="forgetPassword.php">忘记密码？</a>
    </form>
<?php }?>
</body>
<?php include '../foot.php'; ?>
</html>
