<html>
<head>
<title>逸仙徒步活动平台</title>
<meta content="text/html; charset=UTF-8" http-equiv="Content-Type">
    <!-- Bootstrap -->
     <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="../css/bootstrap-responsive.css" rel="stylesheet">
    <link href="../css/front.css" media="screen, projection" rel="stylesheet" type="text/css">
  
        <style type="text/css">
            p {
                margin: 0;
            }
        </style>
        
</head>
<body>
<?php
include("SAE/saemysql.class.php");
//tobe remove
$userId=$_GET["userId"];
    //取出用户在DB中的资料    
     $db = new SaeMysql();
    $sql = "select * from event_hiker where user_id ='".$userId."'";
    $result = $db->getLine($sql); // 获得查询结果
    if ($db->errno()!=0)
    {
        die("Error:".$db->errmsg());
    }
    $db->closeDb();
    
    if ($result==false)
    {
        printf("数据库异常，请联系管理员。");
        exit;
    }
    else
    {
        
        $username = $result["user_name"];
        $usernick = $result["user_nick"];
        $usergender = $result["user_gender"];
        $useraddress = $result["user_address"];
        $userphone = $result["user_phone"];     
        $useremail  = $result["user_email"];     
        $userqq = $result["user_qq"];
        $userWeiboName = $result["user_weiboName"];    
        $userWeiboLink = $result["user_weiboLink"];     
        $userurgentname = $result["user_urgentName"];
        $userurgentphone = $result["user_urgentPhone"];                           
        $userInterest = $result["user_interest"];
        $userComments = $result["user_comments"];
        $userCreatetime = $result["user_createtime"];
        $userExperienceGrade = $result["user_experienceGrade"];

       // echo "昵称:".$usernick."<br>";
         //echo "性别:".$usergender."<br>";
          //echo "Email(发邮件请把#换成@):".str_replace("@","#",$useremail)."<br>";
           //echo "微博名:".$userWeiboName."<br>";
            //echo "微博地址:".$userWeiboLink."<br>";
            //echo "兴趣领域:".str_replace("+",",",$userInterest)."<br>";
             //echo "自我介绍:".$userComments."<br>";
              //echo "帐号创建日期:".$userCreatetime."<br>";
               //echo "经验值:".$userExperienceGrade."<br>";
    }             
?>
              <table class="table table-striped table-bordered table-condensed">
                  <tr><td>Email</td><td><?php echo $useremail?></td><td>性别</td><td><?php echo $usergender?></td></tr>
                  <tr><td>微博名</td><td><?php echo $userWeiboName?></td><td>微博地址</td><td><?php echo $userWeiboLink?></td></tr>
                  <tr><td>兴趣领域</td><td><?php echo str_replace("+",",",$userInterest)?></td><td>帐号创建日期</td><td><?php echo $userCreatetime?></td></tr>
              </table> 
              自我介绍：<?php echo $userComments?>
</body>
</html>