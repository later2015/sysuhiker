<?php ob_start(); ?>
<?php $navvar = "index";
include 'navigation.php';?>
<body>
<?php
 if(isset($_POST["useremail"])&&isset($_POST["userpsw"]))
{
     $useremail=$_POST["useremail"];
     $userpsw=$_POST["userpsw"];
     $remember=$_POST["remember"];
     $db=new SaeMysql();
    $checksql="select user_psw,user_id,user_nick  from event_hiker where user_email='".$useremail."'";
    $result = $db->getLine($checksql);// 获得数组格式的查询结果
    $dbpsw = $result["user_psw"];// 获得第一个查询结果
    $userId = $result["user_id"];// 获得第一个查询结果
    $userNick = $result["user_nick"];// 获得第一个查询结果
    //$userid = $db->getVar($checksql);
       if ($db->errno()!=0)
    {
        die("Error:".$db->errmsg());
    }else{
         if($dbpsw==false) {
        echo "对不起，该email地址尚未注册！";
        }else {
                    $db->closeDb();
                    $inputpsw = md5(crypt($userpsw, substr($userpsw, 0, 3)));
                            if ($dbpsw==$inputpsw)
                                {
                                    $_SESSION["currentUserEmail"] = $useremail;
                                    $_SESSION[$useremail."flag"] = TRUE;
                                    $_SESSION["currentUserId"]=$userId;
                                    $_SESSION["currentUserNick"]=$userNick;
                                    if($remember=='1'){
                                        setcookie(sha1('autoLogin'),$userId.'|'.sha1($userId.$useremail.'sysuhiker'),time()+3600*24*90, NULL, NULL, NULL, TRUE);//cookie有效期90天
                                        echo "setcookie";
                                    }
                                     echo "成功登录！";
                                     if (!empty($_SESSION['jumpURL'])) {
                                           header('Location: ' . $_SESSION['jumpURL']);  
                                         exit();
                                    }
                                    //echo "pass!你是个诚实的孩子，页面自动跳转中...";
                                    //$url = "Edit.php";
                                    //echo "<script language='javascript' type='text/javascript'>";
                                    //echo "window.location.href='$url'";
                                    //echo "</script>";
                                }else{
                                    echo "用户名和密码不匹配！";
                                }
        }
        
    }           
}else{
    echo "请输入邮箱和密码！";
}
?>
</body>
<?php include 'foot.php'; ?>
</html>