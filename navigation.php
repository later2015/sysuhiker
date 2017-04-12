<?php
session_start();
error_reporting(E_COMPILE_ERROR||E_RECOVERABLE_ERROR||E_ERROR||E_CORE_ERROR);
include("SAE/saemysql.class.php");
include("SAE/saemail.class.php");
include("SAE/emailUtil.class.php");
?>
<!DOCTYPE html>
<html>
<head>
<title>逸仙徒步活动平台</title>
<meta content="text/html; charset=UTF-8" http-equiv="Content-Type">
    <!-- Bootstrap -->
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="../css/bootstrap-responsive.css" rel="stylesheet">
    <link href="../css/front.css" media="screen, projection" rel="stylesheet" type="text/css">
<script src="../js/jquery.js"></script>    
<script src="../js/bootstrap.min.js"></script>        
<script type="text/javascript">
        $(document).ready(function() {

            $(".signin").click(function(e) {          
                e.preventDefault();
                $("fieldset#signin_menu").toggle();
                $(".signin").toggleClass("menu-open");
            });
            
            $("fieldset#signin_menu").mouseup(function() {
                return false
            });
            $(document).mouseup(function(e) {
                if($(e.target).parent("a.signin").length==0) {
                    $(".signin").removeClass("menu-open");
                    $("fieldset#signin_menu").hide();
                }
            });         
            
        });
</script>
<script src="../js/jquery.tipsy.js" type="text/javascript"></script>
<script src="../js/jquery.pop.js" type="text/javascript"></script>
<script type='text/javascript'>
    $(function() {
      $('#forgot_username_link').tipsy({gravity: 'w'});   
    });
  </script>
  
        <style type="text/css">
            p {
                margin: 0;
            }
        </style>

<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "https://hm.baidu.com/hm.js?47faf78ba85e2dd4178ee02acddce7f5";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>
       
</head>
<body>

<?php 
  //读取cookie自动登录
  $cookieValue = $_COOKIE[sha1('autoLogin')];
  if($cookieValue != ''){
  
    require_once ('dbutil.php');
    $dbutil = new dbutil();
    $currentUserId = $dbutil->checkCookie($cookieValue);
    if($currentUserId != 'errorCookie'){
      $_SESSION["currentUserId"] = $currentUserId;
      $useremail = $dbutil-> getEmailByUserId($currentUserId);
      if($useremail != 'errorId'){
        $_SESSION["currentUserEmail"] = $useremail;
        $_SESSION[$useremail."flag"] = TRUE;
        $_SESSION["currentUserNick"] = $dbutil-> getNickByUserId($currentUserId);   
      }             
    }
  }
  
  $currentUser = $_SESSION["currentUserEmail"];
  $loginStatus = $_SESSION[$currentUser."flag"];
  $_SESSION['jumpURL'] = $_SERVER['HTTP_REFERER'];
?>

<div id="container">
	<table class="table table-striped table-condensed">
		<thead>
		  	<tr class="title">
		  		
			    <td width="15%">
			    	<div></div>
			    	<p></p>
			    	<a href="http://sysuhiker.cc"><img  src="/img/logo_s.png"></a>
			    </td>
			    
			    <td width="85%">
			    	
					<?php if($loginStatus==TRUE) {
						echo "<div id=\"topnav\" class=\"topnav\">欢迎".$currentUser;?> 来到逸仙徒步活动平台！
							<a href="../logout.php" class="btn btn-small">登出</a>
						    <a href="../editUser.php" class="btn btn-small">个人资料</a>
					<?php 
						echo "</div>";
					} else{ ?> 
						<div id="topnav" class="topnav">欢迎来到逸仙徒步活动平台！<a href = "login.php" class="signin"> <span>登录</span></a> 
						</div>
					<?php } ?>
					
				  	<fieldset id="signin_menu">
					    <form method="post" id="signin" action="../loginCheck.php">
					      <label for="username">Email</label>
					      <input id="username" name="useremail" value="" title="username" tabindex="4" type="text" placeholder="邮件"/>
					      
					      <p>
					        <label for="password">Password</label>
					        <input id="password" name="userpsw" value="" title="password" tabindex="5" type="password" placeholder="密码"/>
					      </p>
					      <p class="remember">
					        <input value="登录" tabindex="7" type="submit" class="btn btn-primary"/><input id ="remember" name="remember" tabindex="6" type="checkbox"/><a class="help-inlin">记住</>
					        <a href="register.php" class="btn">注册</a><a href="forgetPassword.php">忘记密码</a>
					      </p>
					    </form>
				  	</fieldset>
				  	
			  		<ul class="nav nav-tabs">
					    <li <?php if($navvar == "index") echo "class=\"active\"";?> ><a href="../index.php">首页</a></li>
					    <li <?php if($navvar == "event") echo "class=\"active\"";?> ><a href="../eventlist.php">活动</a></li>
					    <li <?php if($navvar == "test") echo "class=\"active\"";?> ><a href="../test/itemlist.php" >户外知识测试</a></li>
					    <li <?php if($navvar == "club") echo "class=\"active\"";?> ><a href="../club/postList.php">逸仙茶馆</a></li>
					    <li <?php if($navvar == "about") echo "class=\"active\"";?> ><a href="../about.php">关于我们</a></li>
				  	</ul>
				  	
			    </td>
		  	</tr>
		</thead>
	</table>
		
		

</span>

</body>
</html>
        
        