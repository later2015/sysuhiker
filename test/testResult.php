<?php $navvar = "test";
include '../navigation.php'; ?>

<?php
// 启动 Session 
session_start();
date_default_timezone_set('PRC');
$eventId=$_GET["eventId"];
$answer=$_SESSION['item_answer'];
$detail=$_SESSION['item_detail'];
?>
<body>
<?php
if(isset($_POST["submit"])&&$_POST["submit"])
{

    $item=$_POST["itemOptions"];
    $testResult=0;
    for($i=0;$i<count($item);$i++) {
        if($item[$i]!=NULL)
        $values=implode("",$item[$i]);
        if($answer[$i]==$values)
        $testResult+=1;
    }
echo "你答对了5题中的".$testResult."题<br>";
    if($testResult>=3 && isset($_SESSION['test_jumpURL'])) 
        {
            $_SESSION["testPassed"]=  TRUE;
            echo " 恭喜你！通过测试。请点";
            echo "<a class='btn btn-warning' href='".$_SESSION['test_jumpURL']."'>下一步</a>继续报名。";
        }else if(isset($_SESSION['test_jumpURL']))
            {
                echo " 同学，你不及格呀，再做一次测试题吧。";
                echo "<a class='btn btn-warning' href='itemlist.php'>再测一次</a>";
            }else{
                 echo "<a class='btn btn-warning' href='itemlist.php'>再测一次</a>";
            }
            
} 
?>
<form id="testForm" name="testForm" method="post" action="#">	
    <table class="table table-striped">
        <tbody>
<?php
for($i=0;$i<5;$i++) {//显示结果 
?>
<tr>
  <td align="left">
              <?php echo ($i+1).".题目："; 
         echo str_replace("<P>","<P>",$detail[$i])?>
  <br>
  </td></tr><tr><td>
正确答案<?php echo $answer[$i]?>
</td>
</tr>
<?php }
?>
</tbody>
</table>
</form>
</body>
<?php include '../foot.php'; ?>
</html>
