<?php $navvar = "event";
include 'navigation.php'; ?>

<body>

<form class="well form-search">
 	Email<input name="email" type="text"  class="span3" placeholder="请输入注册邮箱" value="<?php echo $_GET["email"];?>">
  	激活码<input name="key" type="text"  class="span3" placeholder="请输入激活码" value="<?php echo $_GET["key"];?>">
	<button type="submit" class="btn">激活</button>
</form>

<?php
if (isset($_GET["key"])&&isset($_GET["email"]))
{
    $key = $_GET["key"];
    $email = $_GET["email"];
}else if(isset($_POST["submit"])&&$_POST["submit"])
{
	$key=$_POST["key"];
	$email=$_POST["email"];
}

if($key==''||$email=='') {
    echo "请输入email和激活码再点击激活！";
    exit;    
}else{
	$db=new SaeMysql();
	$getKeySql="select user_knowledgeScore from event_hiker where user_email = '".$email."'";
	$dbkey=$db->getVar($getKeySql);
    if ($db->errno()!=0)
    {
        die("Error:".$db->errmsg());
    }else{
        if($dbkey==NULL) 
            echo "该email地址未注册。";
        else if (strlen($dbkey)<30)
            echo "该email地址已经被激活。无须重复激活。";
        else if($dbkey!=$key)
            echo "激活码不正确！";    
        else if($dbkey==$key){
            $db=new SaeMysql();
            $sql="UPDATE event_hiker SET user_experienceGrade ='0',
            user_knowledgeScore ='0' WHERE user_knowledgeScore='".$key."'";
			$db->runSql($sql);
			if ($db->errno()!=0){
				die("Error:".$db->errmsg());
			}else{        
                echo "恭喜你!成功激活邮箱！<br>";
             	echo "<a class=\"btn btn-large\" href=\"index.php\">点击此处到首页登录</a>";
            }
        }
    }
    $db->closeDb();
}
?>
</body>

<?php include 'foot.php'; ?>
</html>