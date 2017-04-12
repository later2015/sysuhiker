<?php $navvar = "event";
include 'navigation.php'; ?>
<link rel="stylesheet" type="text/css" href="css/jquery-ui.css" /> 
<script type="text/javascript" src="../1433ueditor/ueditor.config.js"></script>
<script type="text/javascript" src="../1433ueditor/ueditor.all.min.js"></script>
<link rel="stylesheet" href="../1433ueditor/themes/default/css/ueditor.min.css"/>

<body>
<?php
$useremail=$_SESSION["currentUserEmail"];
if(isset($_SESSION["currentUserEmail"])&&isset($_SESSION[$useremail."flag"])&& $_SESSION[$useremail."flag"] == TRUE){?>
	<form name="form1" method="post" action="addEvent.php">
		<h1>请认真填写活动详情</h1><br>
		<table>
			<tr>
				<td align="left" width="10%">活动名称</td>
				<td><input name="eventname" type="text" id="eventname" class="input-sysuhiker"></input></td>
			</tr>
			
			<tr>
				<td align="left" width="10%">活动类型</td>
				<td>
					<input name="eventType" type="radio" id="eventType" size="80%" value="休闲拉练">休闲拉练
					<input name="eventType" type="radio" id="eventType" size="80%" value="正常拉练">正常拉练
					<input name="eventType" type="radio" id="eventType" size="80%" value="极限拉练">极限拉练
					<input name="eventType" type="radio" id="eventType" size="80%" value="休闲露营">休闲露营
					<input name="eventType" type="radio" id="eventType" size="80%" value="长线露营">长线露营
					<input name="eventType" type="radio" id="eventType" size="80%" value="休闲户外">休闲户外
					<input name="eventType" type="radio" id="eventType" size="80%" value="非户外活动AA约伴">非户外活动AA约伴
				</td>
			</tr>
			
			<tr>
				<td align="left">活动内容</td>
				<td><textarea  name="eventDetail"  id="eventDetail" >请输入内容</textarea>
					<script type="text/javascript">UE.getEditor('eventDetail',{initialFrameHeight:400,initialFrameWidth:null })</script>
				</td>
			</tr>
			
			<tr>
				<td align="left" width="10%">活动开始时间</td>
				<td><input name="eventStartTime" type='datetime' id="datetimepicker" size="80%"/></td>
			</tr>
			
			<tr>
				<td align="left" width="10%">活动结束时间</td>
				<td><input name="eventEndTime" type='datetime'  id="datetimepicker1" size="80%"/></td>
			</tr>
			
			<tr>
				<td align="left" width="10%">报名开始时间</td>
				<td><input name="joinStartTime" type="datetime" id="datetimepicker2" size="80%"/></td>
			</tr>
			
			<tr>
				<td align="left" width="10%">报名结束时间</td>
				<td><input name="joinEndTime" type="datetime" id="datetimepicker3" size="80%"/></td>
			</tr>
			
			<tr>
				<td align="left" width="10%">活动人数上限</td>
				<td><input name="eventMaxHiker" type="text" id="eventMaxHiker" size="80%"></input></td>
			</tr>
			
			<tr>
				<td align="left">备注</td>
				<td><textarea  name="comments"  id="comments"  cols="80%" rows="5%" class="input-sysuhiker"></textarea></td>
			</tr>
		</table>
		作为领队，请认真填写活动信息。
		<input name="Confirm" type="submit" id="Confirm" value="确定"></input><br>
	</form>
<?php } else{?>    
    <form method="post" action="../loginCheck.php">
      	<label for="username">Email</label>
      	<input id="username" name="useremail" value="" title="username" tabindex="4" type="text" placeholder="邮件">
      	<p>
        	<label for="password">Password</label>
        	<input id="password" name="userpsw" value="" title="password" tabindex="5" type="password" placeholder="密码">
      	</p>
        <input value="登录" tabindex="6" type="submit" class="btn btn-primary">
        <input id="remember" name="remember" value="1" tabindex="7" type="checkbox"><a class="help-inlin">记住我</a>
        <a href="register.php" class="btn">注册</a><a href="forgetPassword.php">忘记密码？</a>
    </form>
<?php }?>
</body>
<?php include 'foot.php'; ?>
</html>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery-ui.js"></script>
<script type="text/javascript" src="js/jquery-ui-slide.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-timepicker-addon.js"></script>
<script type="text/javascript">
$(function(){
    $('#datetimepicker').datetimepicker();
    $('#datetimepicker1').datetimepicker();
    $('#datetimepicker2').datetimepicker();
    $('#datetimepicker3').datetimepicker();
});
</script>


