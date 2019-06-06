<?php $navvar = "index";
include 'navigation.php'; ?>
<body>
<form name="getPasswordform" method="post" action="sendNewPassword.php">
    <h1>忘记密码-取回密码</h1><br>
    <table>
        <tr>
            <td align="left" width="10%">真实姓名</td>
            <td><input name="username" type="text" id="username" size="80%" required></input><span>*请填写你注册时的真实姓名</span>
            </td>
        </tr>
        <tr>
            <td align="left">Email</td>
            <td><input name="useremail" type="email" id="useremail" size="80%" required></input><span>* 请填写你注册帐号时的email地址（即是登录的email地址）。</span>
            </td>
        </tr>
        <tr>
            <td align="left">安全码</td>
            <td><input name="validCode" type="text" id="validCode" size="80%" required></input><span>* 请联系管理员later（QQ：448273866 微信：liangges）获取。</span>
            </td>
        </tr>
    </table>
    <input class="btn btn-primary" name="register" type="submit" id="register" value="提交"><br>
</form>
</body>
<?php include 'foot.php'; ?>
</html>