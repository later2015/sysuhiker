<?php ob_start(); ?>
<?php $navvar = "index";
include 'navigation.php'; ?>
<body>
<?php
$useremail = $_SESSION["currentUserEmail"];
$_SESSION[$useremail . "flag"] = FALSE;
session_destroy();
//setcookie(sha1('autoLogin'));//清cookie
setcookie(sha1('autoLogin'), $userId . '|' . sha1($userId . $useremail . 'sysuhiker'), time() - 1, NULL, NULL, NULL, TRUE);//清cookie,让cookie过期
echo "成功登出！";
?>
</body>
<?php include 'foot.php'; ?>
</html>