<?php ob_start(); ?>
<?php $navvar = "event";
include 'navigation.php'; ?>
<body>
<?php
$useremail=$_SESSION["currentUserEmail"];
 if(isset($_SESSION["currentUserEmail"])&&isset($_SESSION[$useremail."flag"])&& $_SESSION[$useremail."flag"] == TRUE){
$eventId=$_GET["eventId"];
$eventName=$_GET["eventName"];
$eventType=$_GET["eventType"];
if((isset($_SESSION["testPassed"])&&$_SESSION["testPassed"]==TRUE)||($eventType=="非户外活动AA约伴")||($eventType=="休闲户外"))
    {
        $_SESSION['test_jumpURL'] =NULL;
    //取出用户在DB中的资料    
     $db = new SaeMysql();
    $sql = "select * from event_hiker where user_email ='".$useremail."'";
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
        $userqq = $result["user_qq"];
        $userWeiboName = $result["user_weiboName"];    
        $userWeiboLink = $result["user_weiboLink"];     
        $userurgentname = $result["user_urgentName"];
        $userurgentphone = $result["user_urgentPhone"];                           
        $userrole = $result["user_interest"];
    }
        
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
<form name="form1" method="post" action="addhiker.php?eventId=<?php echo  $eventId?>&eventName=<?php echo  $eventName?>&eventType=<?php echo  $eventType?>">
<h3>请认真填写报名资料</h3><br>
<span>请认真填写个人信息及装备情况，除了备注，任何一项都不可留空。</span>
<table>
<tr>
<td align="left" width="10%">真实姓名 </td>
<td><input class="input-xlarge" name="username" type="text" id="username" size="80%" value="<?=$username?>" required></input></td>
</tr>
<tr>
<td align="left"  width="10%">昵称 </td>
<td><input class="input-xlarge" name="usernick" type="text" id="usernick" size="80%" value="<?=$usernick?>" required></input></td>
</tr>
<tr>
<td align="left">性别</td>
<td><input name="usergender" type="radio" id="usergender" size="80%" value="gg" <?php if ($usergender=="gg") echo "checked";?>>gg
        <input name="usergender" type="radio" id="usergender" size="80%" value="mm" <?php if ($usergender=="mm") echo "checked";?>>mm</td>
</tr>
<tr>
<td align="left">住址</td>
<td><input class="input-xlarge" name="useraddress" type="text" id="useraddress" size="80%" value="<?=$useraddress?>" required></input></td>
</tr>
<tr>
<td align="left">电话号码</td>
<td><input class="input-xlarge" name="userphone" type="text" id="userphone" size="80%" value="<?=$userphone?>" required></input></td>
</tr>
<tr>
<td align="left">Email</td>
<td><input name="useremail" type="text" id="useremail" size="80%" class="input-xlarge disabled" disabled value="<?=$useremail?>"></input></td>
</tr>
<tr>
<td align="left">QQ</td>
<td><input class="input-xlarge" name="userqq" type="text" id="userqq" size="80%" value="<?=$userqq?>"></input></td>
</tr>
<tr>
<td align="left">微博名</td>
<td><input class="input-xlarge" name="weiboName" type="text" id="weiboName" size="80%" value="<?=$userWeiboName?>"></input></td>
</tr>
<tr>
<td align="left">微博地址</td>
<td><input class="input-xlarge" name="weiboLink" type="text" id="weiboLink" size="80%" value="<?=$userWeiboLink?>"></input></td>
</tr>
<tr>
<td align="left">紧急联系人</td>
<td><input class="input-xlarge" name="userurgentname" type="text" id="userurgentname" size="80%" value="<?=$userurgentname?>" required></input></td>
</tr>
<tr>
<td align="left">紧急联系人电话</td>
<td><input class="input-xlarge" name="userurgentphone" type="text" id="userurgentphone" size="80%" value="<?=$userurgentphone?>" required></input></td>
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
                    <?php echo checkedstatus($userrole,"厨师")?>>厨师</td>
            </tr>
<tr><td>免责声明</td>
<td width="80%">1. 认同“安全、环保、自助”的磨房户外理念。遵从《磨房告示》户外活动规则。<br>
2. 服从统一指挥，发扬团队协作精神，倡导自助与必要的互助相结合的户外理念。不擅自离开活动路线。<br>
3. 注意安全，不作无保护、无必要的攀爬、冒险。注意保持队伍行进紧凑，严防迷路和被打劫。<br>
4. 不乱丢垃圾，不破坏植被。注意环保，鼓励拾捡垃圾。做到“只留下你的脚印，只带走你的回忆”。<br>
5. 自行购买保险。出发前请把组织人的联系方式留给紧急联系人。<br>
6. 如果在活动中遇到异常情况，领队有权决定修改线路。 （转帖磨房免责声明，在此表示感谢）<br>
<input name="declare[]" type="checkbox" id="declare" size="100%" value="Y">本人已经仔细阅读以上声明内容，认为完全符合本人意愿并同意签署.</td>
</tr>　
<?php 
    if(similar_text($eventType,"露营")!=6){
       ?>
       <tr>
<td align="left">备注</td>
<td><textarea  name="comments"  id="comments"  cols="65%" rows="5%" class="input-sysuhiker"></textarea></td>
</tr>
</table>
<input class="btn" name="SignUp" type="submit" id="SignUp" value="报名"></input>
</form>
       <?php
    }else{
?>
<tr><td>装备情况：</td></tr>
<tr>
<td align="left">登山包容量</td>
<td><input class="input-xlarge" name="userbag" type="text" id="userbag" size="80%" placeholder="请输入你的登山包的体积" required>L</input></td>
</tr>
<tr>
<td align="left">睡袋温标</td>
<td><input class="input-xlarge" name="usersleepingbag" type="text" id="usersleepingbag" size="80%" placeholder="请输入你的睡袋的舒适温标范围" required></input></td>
</tr>
<tr>
<td align="left">帐篷</td>
<td><input name="usercamp[]" type="checkbox" id="usercamp" size="10%" value="暂无">暂无<input name="usercamp[]" type="checkbox" id="usercamp" size="10%" value="单人帐篷">单人帐篷
<input name="usercamp[]" type="checkbox" id="usercamp" size="10%" value="双人帐篷">双人帐篷<input name="usercamp[]" type="checkbox" id="usercamp" size="10%" value="三人帐篷">三人帐篷
<input name="usercamp[]" type="checkbox" id="usercamp" size="10%" value="other">其他请在备注说明
</td>
</tr>
<tr>
<td align="left">防潮垫</td>
<td><input name="usercamppad[]" type="checkbox" id="usercamppad" size="10%" value="暂无">暂无<input name="usercamppad[]" type="checkbox" id="usercamppad" size="10%" value="单人防潮垫">单人防潮垫
<input name="usercamppad[]" type="checkbox" id="usercamppad" size="10%" value="双人防潮垫">双人防潮垫<input name="usercamppad[]" type="checkbox" id="usercamppad" size="10%" value="三人防潮垫">三人防潮垫
<input name="usercamppad[]" type="checkbox" id="usercamppad" size="10%" value="other">其他请在备注说明
</td>
</tr>
<tr>
<td align="left">对讲机</td>
<td><input name="userinterphone[]" type="checkbox" id="userinterphone" size="10%" value="暂无">暂无<input name="userinterphone[]" type="checkbox" id="userinterphone" size="10%" value="V频段136-174MHz">V频段136-174MHz
<input name="userinterphone[]" type="checkbox" id="userinterphone" size="10%" value="U频段400-470MHz">U频段400-470MHz<input name="userinterphone[]" type="checkbox" id="userinterphone" size="10%" value="U频段400-430MHz">U频段400-430MHz
<input name="userinterphone[]" type="checkbox" id="userinterphone" size="10%" value="U频段450-470MHz">U频段450-470MHz<input name="userinterphone[]" type="checkbox" id="userinterphone" size="10%" value="other">其他情况请在备注说明
</td>
</tr>
<tr>
<td align="left">炉头</td>
<td><input name="userBurner[]" type="checkbox" id="userBurner" size="10%" value="暂无">暂无<input name="userBurner[]" type="checkbox" id="userBurner" size="10%" value="扁气罐接口炉头">扁气罐接口炉头
<input name="userBurner[]" type="checkbox" id="userBurner" size="10%" value="长气罐接口炉头">长气罐接口炉头<input name="userBurner[]" type="checkbox" id="userBurner" size="10%" value="酒精炉头">酒精炉头
<input name="userBurner[]" type="checkbox" id="userBurner" size="10%" value="other">其他请在备注说明
</td>
</tr>
<tr>
<td align="left">套锅</td>
<td><input name="userpot[]" type="checkbox" id="userpot" size="10%" value="暂无">暂无<input name="userpot[]" type="checkbox" id="userpot" size="10%" value="3人及以下小锅">3人及以下小锅
<input name="userpot[]" type="checkbox" id="userpot" size="10%" value="4-6人中锅">4-6人中锅<input name="userpot[]" type="checkbox" id="userpot" size="10%" value="7人以上大锅">7人以上大锅
<input name="userpot[]" type="checkbox" id="userpot" size="10%" value="other">其他请在备注说明
</td>
</tr>
<tr>
<td align="left">备注</td>
<td><textarea  name="comments"  id="comments"  cols="65%" rows="5%" class="input-sysuhiker"></textarea></td>
</tr>
<tr>
<td align="left">保险信息</td>
<td><textarea name="insurance" id="insurance" cols="65%" rows="5%" class="input-sysuhiker"></textarea></td>
</tr>

</table>
<input class="btn" name="SignUp" type="submit" id="SignUp" value="报名"></input>
</form>
<?php                
        }
    } else {
        $_SESSION['test_jumpURL'] = $_SERVER['REQUEST_URI'];//设置测试之后的返回页面为当前页面
        header('Location: ../test/itemlist.php');//跳转去测试页面
    }   
} else{?>    
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