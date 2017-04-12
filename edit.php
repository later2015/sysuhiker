<?php $navvar = "event";
include 'navigation.php'; ?>
<body>
<?php
$useremail=$_SESSION["currentUserEmail"];
$eventId=$_GET["eventId"];
//todo
 if(isset($_SESSION["currentUserEmail"])&&isset($_SESSION[$useremail."flag"])&& $_SESSION[$useremail."flag"] == TRUE)//确定用户已登录。
    {
    $db = new SaeMysql();
    $sql = "select * from event_joinlist where event_joinlist_eventid ='".$eventId."' and event_joinlist_useremail='".$useremail."'";
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
        
        $username = $result["event_joinlist_username"];
        $usernick = $result["event_joinlist_usernick"];
        $usergender = $result["event_joinlist_usergender"];
        $userphone = $result["event_joinlist_userphone"];
        $useremail = $result["event_joinlist_useremail"];
        $userqq = $result["event_joinlist_qq"];
        $weiboName = $result["event_joinlist_weiboName"];
        $weiboLink = $result["event_joinlist_weiboLink"];
        $userrole = $result["event_joinlist_userrole"];
        $useraddress = $result["event_joinlist_useraddress"];
        $userurgentname = $result["event_joinlist_userurgentname"];
        $userurgentphone = $result["event_joinlist_userurgentphone"];
        $usercamp = $result["event_joinlist_usercamp"];
        $usercamppad = $result["event_joinlist_usercamppad"];
        $usersleepingbag = $result["event_joinlist_usersleepingbag"];
        $userinterphone = $result["event_joinlist_userinterphone"];
        $userbag = $result["event_joinlist_userbag"];
        $userBurner = $result["event_joinlist_userBurner"];
        $userpot = $result["event_joinlist_userpot"];
        $comments = $result["event_joinlist_comments"];
        $insurance = $result["event_joinlist_insurance"];
        $declare = $result["event_joinlist_declare"];
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
    <form name="editform" method="post" action="updatehiker.php?eventId=<?php echo  $eventId?>">
        <h1>修改报名资料</h1>
        <br>
        <table>
            <tr>
                <td align="left" width="10%">真实姓名</td>
                <td><input class="input-xlarge" name="username" type="text" id="username"
                    size="80%" value="<?=$username?>"></input></td>
            </tr>
            <tr>
                <td align="left" width="10%">昵称</td>
                <td><input  class="input-xlarge" name="usernick" type="text" id="usernick"
                    size="80%" value="<?=$usernick?>"></input></td>
            </tr>
            <tr>
                <td align="left" width="10%">性别</td>
                <td><input name="usergender" type="radio" id="usergender" size="80%" value="gg" <?php if ($usergender=="gg") echo "checked";?>>gg
                <input name="usergender" type="radio" id="usergender" size="80%" value="mm" <?php if ($usergender=="mm") echo "checked";?>>mm</td>
            </tr>
                        <tr>
                <td align="left">住址</td>
                <td><input  class="input-xlarge" name="useraddress" type="text"
                    id="useraddress" size="80%"
                    value="<?=$useraddress?>"></input></td>
            </tr>
            <tr>
                <td align="left">电话号码</td>
                <td><input  class="input-xlarge" name="userphone" type="text" id="userphone"
                    size="80%" value="<?=$userphone?>"></input></td>
            </tr>
            <tr>
                <td align="left">Email</td>
                <td><input  class="input-xlarge" name="useremail" type="text" id="useremail"
                    size="80%" value="<?=$useremail?>" disabled></input></td>
            </tr>
<tr>
<td align="left">QQ</td>
<td><input class="input-xlarge" name="userqq" type="text" id="userqq" size="80%" value="<?=$userqq?>"></input></td>
</tr>
<tr>
<td align="left">微博名</td>
<td><input class="input-xlarge" name="weiboName" type="text" id="weiboName" size="80%" value="<?=$weiboName?>"></input></td>
</tr>
<tr>
<td align="left">微博地址</td>
<td><input class="input-xlarge" name="weiboLink" type="text" id="weiboLink" size="80%" value="<?=$weiboLink?>"></input></td>
</tr>
            <tr>
                <td align="left">紧急联系人</td>
                <td><input  class="input-xlarge" name="userurgentname" type="text"
                    id="userurgentname" size="80%"
                    value="<?=$userurgentname?>"></input></td>
            </tr>
            <tr>
                <td align="left">紧急联系人电话</td>
                <td><input  class="input-xlarge" name="userurgentphone" type="text"
                    id="userurgentphone" size="80%"
                    value="<?=$userurgentphone?>"></input></td>
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
<input name="declare[]" type="checkbox" id="declare" size="100%" value="Y" <?php if ($declare=="Y") echo "checked";?>>本人已经仔细阅读以上声明内容，认为完全符合本人意愿并同意签署.</td>
</tr>　
<?php 
    $eventType=$_GET["eventType"];
    if(similar_text($eventType,"露营")!=6){
       ?>
       <tr>
<td align="left">备注</td>
<td><textarea  name="comments"  id="comments"  class="input-sysuhiker"><?=$comments?></textarea></td>
</tr>
</table>
<input class="btn" name="update" type="submit" id="update" value="修改"></input>  <br>
</form>
       <?php
    }else{
?>           
            <tr>
                <td>装备情况：</td>
            </tr>
            <tr>
            <td align="left">登山包容量</td>
            <td><input class="input-xlarge" name="userbag" type="text" id="userbag" size="80%" value="<?=$userbag?>">L</input></td>
            </tr>
            <tr>
            <td align="left">睡袋温标</td>
            <td><input class="input-xlarge" name="usersleepingbag" type="text" id="usersleepingbag" size="80%" value="<?=$usersleepingbag?>"></input></td>
            </tr>            
            <tr>
                <td align="left">帐篷</td>
                <td><input name="usercamp[]" type="checkbox"
                    id="usercamp" size="10%" value="暂无"
                    <?php echo checkedstatus($usercamp,"暂无")?>>暂无<input
                    name="usercamp[]" type="checkbox" id="usercamp"
                    size="10%" value="单人帐篷 "
                    <?php echo checkedstatus($usercamp,"单人帐篷 ")?>>单人帐篷 <input
                    name="usercamp[]" type="checkbox" id="usercamp"
                    size="10%" value="双人帐篷"
                    <?php echo checkedstatus($usercamp,"双人帐篷")?>>双人帐篷<input
                    name="usercamp[]" type="checkbox" id="usercamp"
                    size="10%" value="三人帐篷"
                    <?php echo checkedstatus($usercamp,"三人帐篷")?>>三人帐篷<input
                    name="usercamp[]" type="checkbox" id="usercamp"
                    size="10%" value="other"
                    <?php echo checkedstatus($usercamp,"other")?>>其他情况请在备注说明</td>
            </tr>
            <tr>
                <td align="left">防潮垫</td>
                <td><input name="usercamppad[]" type="checkbox"
                    id="usercamppad" size="10%" value="暂无"
                    <?php echo checkedstatus($usercamppad,"暂无")?>>暂无 <input
                    name="usercamppad[]" type="checkbox"
                    id="usercamppad" size="10%" value="单人防潮垫"
                    <?php echo checkedstatus($usercamppad,"单人防潮垫")?>>单人防潮垫 <input
                    name="usercamppad[]" type="checkbox"
                    id="usercamppad" size="10%" value="双人防潮垫"
                    <?php echo checkedstatus($usercamppad,"双人防潮垫")?>>双人防潮垫<input
                    name="usercamppad[]" type="checkbox"
                    id="usercamppad" size="10%" value="三人防潮垫"
                    <?php echo checkedstatus($usercamppad,"三人防潮垫")?>>三人防潮垫<input
                    name="usercamppad[]" type="checkbox"
                    id="usercamppad" size="10%" value="other"
                    <?php echo checkedstatus($usercamppad,"other")?>>其他情况请在备注说明</td>
            </tr>
            <tr>
                <td align="left">对讲机</td>
                <td><input name="userinterphone[]" type="checkbox"
                    id="userinterphone" size="10%" value="暂无"
                    <?php echo checkedstatus($userinterphone,"暂无")?>>暂无<input
                    name="userinterphone[]" type="checkbox"
                    id="userinterphone" size="10%" value="V频段136-174MHz"
                    <?php echo checkedstatus($userinterphone,"V频段136-174MHz")?>>V频段136-174MHz
                    <input name="userinterphone[]" type="checkbox"
                    id="userinterphone" size="10%" value="U频段400-470MHz"
                    <?php echo checkedstatus($userinterphone,"U频段400-470MHz")?>>U频段400-470MHz<input
                    name="userinterphone[]" type="checkbox"
                    id="userinterphone" size="10%" value="U频段400-430MHz"
                    <?php echo checkedstatus($userinterphone,"U频段400-430MHz")?>>U频段400-430MHz
                    <input name="userinterphone[]" type="checkbox"
                    id="userinterphone" size="10%" value="U频段450-470"
                    <?php echo checkedstatus($userinterphone,"U频段450-470")?>>U频段450-470MHz<input
                    name="userinterphone[]" type="checkbox"
                    id="userinterphone" size="10%" value="other"
                    <?php echo checkedstatus($userinterphone,"other")?>>其他情况请在备注说明
                </td>
            </tr>
            <tr>
                <td align="left">炉头</td>
                <td><input name="userBurner[]" type="checkbox"
                    id="userBurner" size="10%" value="0"
                    <?php echo checkedstatus($userBurner,"0")?>>暂无<input
                    name="userBurner[]" type="checkbox" id="userBurner"
                    size="10%" value="扁气罐接口炉头"
                    <?php echo checkedstatus($userBurner,"扁气罐接口炉头")?>>扁气罐接口炉头
                    <input name="userBurner[]" type="checkbox"
                    id="userBurner" size="10%" value="长气罐接口炉头"
                    <?php echo checkedstatus($userBurner,"长气罐接口炉头")?>>长气罐接口炉头<input
                    name="userBurner[]" type="checkbox" id="userBurner"
                    size="10%" value="酒精炉头"
                    <?php echo checkedstatus($userBurner,"酒精炉头")?>>酒精炉头 <input
                    name="userBurner[]" type="checkbox" id="userBurner"
                    size="10%" value="other"
                    <?php echo checkedstatus($userBurner,"other")?>>其他请在备注说明</td>
            </tr>
            <tr>
                <td align="left">套锅</td>
                <td><input name="userpot[]" type="checkbox" id="userpot"
                    size="10%" value="暂无"
                    <?php echo checkedstatus($userpot,"暂无")?>>暂无<input
                    name="userpot[]" type="checkbox" id="userpot"
                    size="10%" value="3人以下小锅"
                    <?php echo checkedstatus($userpot,"3人以下小锅")?>>3人以下小锅 <input
                    name="userpot[]" type="checkbox" id="userpot"
                    size="10%" value="4-6人中锅"
                    <?php echo checkedstatus($userpot,"4-6人中锅")?>>4-6人中锅<input
                    name="userpot[]" type="checkbox" id="userpot"
                    size="10%" value="7人以上大锅"
                    <?php echo checkedstatus($userpot,"7人以上大锅")?>>7人以上大锅<input
                    name="userpot[]" type="checkbox" id="userpot"
                    size="10%" value="other"
                    <?php echo checkedstatus($userpot,"other")?>>其他请在备注说明</td>
            </tr>
            <tr>
                <td align="left">备注</td>
                <td><textarea name="comments" id="comments" class="input-sysuhiker"><?=$comments?></textarea></td>
            </tr>
            <tr>
                <td align="left">保险信息</td>
                <td><textarea name="insurance" id="insurance" class="input-sysuhiker"><?=$insurance?></textarea></td>
            </tr>
        </table>
        <input class="btn" name="update" type="submit" id="update" value="修改"></input><br>
    </form>			
<?php
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