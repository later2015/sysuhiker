<?php $navvar = "club";
include '../navigation.php'; ?>

<link rel="stylesheet" type="text/css" href="css/jquery-ui.css" /> 
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript" src="../1433ueditor/ueditor.config.js"></script>
<script type="text/javascript" src="../1433ueditor/ueditor.all.min.js"></script>
<link rel="stylesheet" href="../1433ueditor/themes/default/css/ueditor.min.css"/>

<body>
<?php
$useremail=$_SESSION["currentUserEmail"];
 if(isset($_SESSION["currentUserEmail"])&&isset($_SESSION[$useremail."flag"])&& $_SESSION[$useremail."flag"] == TRUE){
?>
	<form name="form1" method="post" action="addPost.php">
		<h1>发表新话题</h1><br>
		<table>
		<tr>
		<td align="left" width="10%">标题</td>
		<td><input name="postTitle" type="text" id="postTitle" class="input-sysuhiker"></input></td>
		</tr>
		<tr>
		<td align="left">分类</td>
		<td><input name="postType" type="radio" id="postType" size="80%" value="作业攻略">作业攻略<input name="postType" type="radio" id="postType" size="80%" value="技术讨论">技术讨论 <input name="postType" type="radio" id="postType" size="80%" value="活动讨论">活动讨论
		<input name="postType" type="radio" id="postType" size="80%" value="户外安全">户外安全<input name="postType" type="radio" id="postType" size="80%" value="其他" checked>其他</td>
		</tr>
		<tr>
		<td align="left">内容</td>
		<td><textarea  name="postDetail"  id="postDetail"></textarea>
		<script type="text/javascript">UE.getEditor('postDetail',{initialFrameHeight:500,initialFrameWidth:null})</script>
		</td>
		</tr>
		<tr>
		<td align="left">关键字</td>
		<td><input  name="postKeywords"  id="postKeywords"  class="input-sysuhiker"></input></td>
		</tr>
		</table>
		<input name="Confirm" class="btn btn-large btn-primary" type="submit" id="Confirm" value="发布"></input><br>
	</form>
<?php } else{?>    
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