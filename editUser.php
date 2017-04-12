<?php $navvar = "index";
include 'navigation.php'; ?>
<body>
 <?php
$useremail=$_SESSION["currentUserEmail"];
 if(isset($_SESSION["currentUserEmail"])&&isset($_SESSION[$useremail."flag"])&& $_SESSION[$useremail."flag"] == TRUE){
     $db=new SaeMysql();
     $infoSql ="select * from event_hiker  where user_email ='$useremail'";
     $infoResult=$db->getData($infoSql);
     $userrole = $infoResult[0]["user_interest"];
     
    function checkedstatus($array, $value)
    {
        $dbarray = explode("+", $array);
        foreach ( $dbarray as $dbary )
        {
            if ($dbary==$value)
            {
                return "checked";
            }
        }
        return "unchecked";
    }
?>   
<form name="editForm" method="post" action="updateUser.php">
<strong>个人资料</strong>
<table>
<tr>
<td align="left" width="10%">真实姓名 </td>
<td><input name="username" type="text" id="username" size="80%" value="<?php echo $infoResult[0]["user_name"]?>" required></input><span>*</span></td>
</tr>
<tr>
<td align="left"  width="10%">昵称 </td>
<td><input name="usernick" type="text" id="usernick" size="80%" value="<?php echo $infoResult[0]["user_nick"]?>" required></input><span>*</span></td>
</tr>
<tr>
<td align="left">性别</td>
<td><input name="usergender" type="radio" id="usergender" size="80%" value="gg" <?php if ($infoResult[0]["user_gender"]=="gg") echo "checked";?>>gg
        <input name="usergender" type="radio" id="usergender" size="80%" value="mm" <?php if ($infoResult[0]["user_gender"]=="mm") echo "checked";?>>mm</td>
</tr>
<tr>
<td align="left">原密码</td>
<td><input name="userpsw0" type="password" id="userpsw" size="80%" ></input><span>如果不修改密码请留空</span></td>
</tr>
<tr>
<td align="left">登录新密码</td>
<td><input name="userpsw" type="password" id="userpsw" size="80%" ></input><span>密码最短长度为6位，如果不修改密码请留空</span></td>
</tr>
<tr>
<td align="left">确认新密码</td>
<td><input name="userpsw2" type="password" id="userpsw2" size="80%" ></input><span>密码最短长度为6位，如果不修改密码请留空</span></td>
</tr>
<tr>
<td align="left">住址</td>
<td><input name="useraddress" type="text" id="useraddress" size="80%" value="<?php echo $infoResult[0]["user_address"]?>" required></input><span>*</span></td>
</tr>
<tr>
<td align="left">电话号码</td>
<td><input name="userphone" type="text" id="userphone" size="80%" value="<?php echo $infoResult[0]["user_phone"]?>" required></input><span>*</span></td>
</tr>
<tr>
<td align="left">Email</td>
<td><input name="useremail" type="email" id="useremail" size="80%" value="<?php echo $infoResult[0]["user_email"]?>" disabled></input><span>* email为登录凭证，不可修改</span></td>
</tr>
<tr>
<td align="left">QQ</td>
<td><input name="userqq" type="text" id="userqq" size="80%" value="<?php echo $infoResult[0]["user_qq"]?>" ></input></td>
</tr>
<tr>
<td align="left">微博名</td>
<td><input name="weiboName" type="text" id="weiboName" size="80%" value="<?php echo $infoResult[0]["user_weiboName"]?>" ></input></td>
</tr>
<tr>
<td align="left">微博地址</td>
<td><input name="weiboLink" type="text" id="weiboLink" size="80%" value="<?php echo $infoResult[0]["user_weiboLink"]?>" ></input></td>
</tr>
<tr>
<td align="left">紧急联系人</td>
<td><input name="userurgentname" type="text" id="userurgentname" size="80%" value="<?php echo $infoResult[0]["user_urgentName"]?>" required></input><span>*</span></td>
</tr>
<tr>
<td align="left">紧急联系人电话</td>
<td><input name="userurgentphone" type="text" id="userurgentphone" size="80%" value="<?php echo $infoResult[0]["user_urgentPhone"]?>" required></input><span>*</span></td>
</tr>
           <tr>
                <td align="left">团队角色</td>
                <td><input name="userrole[]" type="checkbox"
                    id="userrole" size="10%" value="领队"
                    <?php echo checkedstatus($userrole,"领队")?>>领队 <input
                    name="userrole[]" type="checkbox" id="userrole"
                    size="10%" value="协作"
                    <?php echo checkedstatus($userrole,"协作")?>>协作 <input
                    name="userrole[]" type="checkbox" id="userrole"
                    size="10%" value="头驴"
                    <?php echo checkedstatus($userrole,"头驴")?>>头驴 <input
                    name="userrole[]" type="checkbox" id="userrole"
                    size="10%" value="尾驴"
                    <?php echo checkedstatus($userrole,"尾驴")?>>尾驴 <input
                    name="userrole[]" type="checkbox" id="userrole"
                    size="10%" value="财务"
                    <?php echo checkedstatus($userrole,"财务")?>>财务 <input
                    name="userrole[]" type="checkbox" id="userrole"
                    size="10%" value="后勤"
                    <?php echo checkedstatus($userrole,"后勤")?>>后勤 <input
                    name="userrole[]" type="checkbox" id="userrole"
                    size="10%" value="环保"
                    <?php echo checkedstatus($userrole,"环保")?>>环保
                    <input name="userrole[]" type="checkbox"
                    id="userrole" size="10%" value="作业"
                    <?php echo checkedstatus($userrole,"作业")?>>作业 <input
                    name="userrole[]" type="checkbox" id="userrole"
                    size="10%" value="摄影"
                    <?php echo checkedstatus($userrole,"摄影")?>>摄影 <input
                    name="userrole[]" type="checkbox" id="userrole"
                    size="10%" value="医护"
                    <?php echo checkedstatus($userrole,"医护")?>>医护<input
                    name="userrole[]" type="checkbox" id="userrole"
                    size="10%" value="厨师"
                    <?php echo checkedstatus($userrole,"厨师")?>>厨师<input
                    name="userrole[]" type="checkbox" id="userrole"
                    size="10%" value="无线通讯"
                    <?php echo checkedstatus($userrole,"无线通讯")?>>无线通讯<input
                    name="userrole[]" type="checkbox" id="userrole"
                    size="10%" value="骑行"
                    <?php echo checkedstatus($userrole,"骑行")?>>骑行<input
                    name="userrole[]" type="checkbox" id="userrole"
                    size="10%" value="游泳"
                    <?php echo checkedstatus($userrole,"游泳")?>>游泳<input
                    name="userrole[]" type="checkbox" id="userrole"
                    size="10%" value="跑步"
                    <?php echo checkedstatus($userrole,"跑步")?>>跑步<input
                    name="userrole[]" type="checkbox" id="userrole"
                    size="10%" value="定向"
                    <?php echo checkedstatus($userrole,"定向")?>>定向<input
                    name="userrole[]" type="checkbox" id="userrole"
                    size="10%" value="攀岩"
                    <?php echo checkedstatus($userrole,"攀岩")?>>攀岩<input
                    name="userrole[]" type="checkbox" id="userrole"
                    size="10%" value="奢靡腐败"
                    <?php echo checkedstatus($userrole,"奢靡腐败")?>>奢靡腐败</td>
            </tr>
<tr>
<td align="left">自我介绍</td>
<td><textarea  name="comments"  id="comments"  cols="85%" rows="5%"><?php echo $infoResult[0]["user_comments"]?></textarea></td>
</tr>
</table>
<input class="btn btn-primary" name="register" type="submit" id="register" value="修改"><br>
</form>
<?php } else{?>    
    <form method="post" action="../loginCheck.php">
      <label for="username">Email</label>
      <input id="username" name="useremail" value="" title="username" tabindex="4" type="text" placeholder="邮件">
      </p>
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