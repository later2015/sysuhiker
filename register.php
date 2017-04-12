<?php $navvar = "index";
include 'navigation.php'; ?>
<body>
<form name="registerform" method="post" action="adduser.php">
<h1>请认真填写个人注册资料</h1><br>
<table>
<tr>
<td align="left" width="10%">真实姓名 </td>
<td><input name="username" type="text" id="username" size="80%" required></input><span>*</span></td>
</tr>
<tr>
<td align="left"  width="10%">昵称 </td>
<td><input name="usernick" type="text" id="usernick" size="80%" required></input><span>*</span></td>
</tr>
<tr>
<td align="left">性别</td>
<td><input name="usergender" type="radio" id="usergender" size="80%" value="gg" checked>gg<input name="usergender" type="radio" id="usergender" size="80%" value="mm">mm</td>
</tr>
<tr>
<td align="left">登录密码</td>
<td><input name="userpsw" type="password" id="userpsw" size="80%" required></input><span>* 密码最短长度为6位</span></td>
</tr>
<tr>
<td align="left">确认密码</td>
<td><input name="userpsw2" type="password" id="userpsw2" size="80%" required></input><span>* 密码最短长度为6位</span></td>
</tr>
<tr>
<td align="left">住址</td>
<td><input name="useraddress" type="text" id="useraddress" size="80%" required></input><span>*</span></td>
</tr>
<tr>
<td align="left">电话号码</td>
<td><input name="userphone" type="text" id="userphone" size="80%" required></input><span>*</span></td>
</tr>
<tr>
<td align="left">Email</td>
<td><input name="useremail" type="email" id="useremail" size="80%" required></input><span>* 请填写常用email，email将用来接收报名确认信息等各种活动通知</span></td>
</tr>
<tr>
<td align="left">QQ</td>
<td><input name="userqq" type="text" id="userqq" size="80%"></input></td>
</tr>
<tr>
<td align="left">微博名</td>
<td><input name="weiboName" type="text" id="weiboName" size="80%"></input></td>
</tr>
<tr>
<td align="left">微博地址</td>
<td><input name="weiboLink" type="text" id="weiboLink" size="80%"></input></td>
</tr>
<tr>
<td align="left">紧急联系人</td>
<td><input name="userurgentname" type="text" id="userurgentname" size="80%" required></input><span>*</span></td>
</tr>
<tr>
<td align="left">紧急联系人电话</td>
<td><input name="userurgentphone" type="text" id="userurgentphone" size="80%" required></input><span>*</span></td>
</tr>
<tr>
<td align="left">兴趣领域</td>
<td><input name="userrole[]" type="checkbox" id="userrole" size="10%" value="领队">领队<input name="userrole[]" type="checkbox" id="userrole" size="10%" value="协作">协作
<input name="userrole[]" type="checkbox" id="userrole" size="10%" value="头驴">头驴<input name="userrole[]" type="checkbox" id="userrole" size="10%" value="尾驴">尾驴
<input name="userrole[]" type="checkbox" id="userrole" size="10%" value="财务">财务<input name="userrole[]" type="checkbox" id="userrole" size="10%" value="后勤">后勤
<input name="userrole[]" type="checkbox" id="userrole" size="10%" value="环保">环保<input name="userrole[]" type="checkbox" id="userrole" size="10%" value="作业">作业
<input name="userrole[]" type="checkbox" id="userrole" size="10%" value="摄影">摄影<input name="userrole[]" type="checkbox" id="userrole" size="10%" value="医护">医护
<input name="userrole[]" type="checkbox" id="userrole" size="10%" value="厨师">厨师
<input name="userrole[]" type="checkbox" id="userrole" size="10%" value="无线通讯">无线通讯<input name="userrole[]" type="checkbox" id="userrole" size="10%" value="骑行">骑行
<input name="userrole[]" type="checkbox" id="userrole" size="10%" value="游泳">游泳<input name="userrole[]" type="checkbox" id="userrole" size="10%" value="跑步">跑步
<input name="userrole[]" type="checkbox" id="userrole" size="10%" value="定向">定向<input name="userrole[]" type="checkbox" id="userrole" size="10%" value="攀岩">攀岩
<input name="userrole[]" type="checkbox" id="userrole" size="10%" value="奢靡腐败" checked>奢靡腐败
</td>
</tr>
<tr>
<td align="left">自我介绍</td>
<td><textarea  name="comments"  id="comments"  cols="65%" rows="5%"></textarea></td>
</tr>
</table>
<input class="btn btn-primary" name="register" type="submit" id="register" value="注册"><br>
</form>
</body>
<?php include 'foot.php'; ?>
</html>