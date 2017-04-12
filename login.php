<?php $navvar = "index";
include 'navigation.php'; ?>
<body>
<form class="well form-inline" method="post" action="loginCheck.php">
  Email <input name="useremail" type="text" class="input-small" placeholder="邮件">
  Password <input name="userpsw" type="password" class="input-small" placeholder="密码">
  <label class="checkbox">
    <input  NAME="remember" TYPE="checkbox" VALUE="1"> 记住我
  </label>
  <button type="submit" class="btn">登录</button>
  <a href="forgetPassword.php">忘记密码？</a>
</form>
</body>
<?php include 'foot.php'; 
$_SESSION['jumpURL']='index.php';
?>
</html>