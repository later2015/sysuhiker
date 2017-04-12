<?php $navvar = "index";
include 'navigation.php'; ?>
<body>
欢迎来到逸仙徒步活动平台！<br>
新人不知道怎么使用？请点击 <a class="btn btn-large" href="http://sysuhiker.cc/club/postDetail.php?postId=4">使用帮助</a> <br>
系统有bug？ 请点击 <a class="btn btn-large" href="http://sysuhiker.cc/club/postDetail.php?postId=1">bug反馈</a> <br>
有新功能提出？ 请点击 <a class="btn btn-large" href="http://sysuhiker.cc/club/postDetail.php?postId=2">需求反馈</a> <br>    
还没有注册帐号？快快去注册-->>><a class="btn btn-large" href="register.php">新人注册</a> <br>
要组队出去玩？ 请猛击->>><a class="btn btn-large" href="event.php">发起活动</a><br>
想跟队出去玩？请猛击->>><a class="btn btn-large" href="eventlist.php">参加活动</a> <br>
想了解下自己的户外知识储备情况？来这里：<a class="btn btn-large" href="../test/itemlist.php">户外知识测试</a><br>
想灌水想发布攻略想寻求其他帮助？去讨论区吧-->><a class="btn btn-large" href="../club/postList.php">逸仙茶馆</a> <br>
    <?php  $useremail=$_SESSION["currentUserEmail"];
     if(!(isset($_SESSION["currentUserEmail"])&&isset($_SESSION[$useremail."flag"])&& $_SESSION[$useremail."flag"] == TRUE)){ ?>
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
        <?php } ?>
</body>
<?php include 'foot.php'; ?>
</html>