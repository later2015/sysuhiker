<?php $navvar = "test";
include '../navigation.php'; ?>

    <?php
    // 启动 Session
    session_start();
    $eventId = $_GET["eventId"];
    $db = new SaeMysql();
    $itemListSql = "select * from event_itemPool  ORDER BY RAND() LIMIT 5";

    $result = $db -> getData($itemListSql);
?>
    <body>
     <?php
if(isset($_SESSION['test_jumpURL']))
    echo "活动报名第一步：户外知识测试。";
      ?>       
        <form id="testForm" name="testForm" method="post" action="testResult.php">
            
                <table class="table table-striped">
                    <tbody>
                        <?php
if($result==NULL){
printf("题库内容为空！");
}else{
$answer=array();
$items=array();
for($i=0;$i<5;$i++) {//显示结果
$answer[$i]=$result[$i]["item_answer"];
$_SESSION['item_answer'][$i]=$answer[$i];
$_SESSION['item_detail'][$i]=$result[$i]["item_detail"];
                        ?>
                        <tr>
                            <td><?php echo ($i+1).".题目：";
echo str_replace("<P>","<P class=\"text-error\">",$result[$i]["item_detail"])
                            ?></td>
                        </tr>
                        <tr>
                            <td> 请勾选正确答案<br>
                            <?php
$options=array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
for ($j=0; $j< $result[$i]["item_options"]; $j++) {
?>
                            <input name="itemOptions[<?php echo $i?>][]" type="checkbox" size="50%" value="<?php echo $options[$j]?>">
                            <?php echo $options[$j]
                            ?>
                            <?php
                            }
                            ?></td>
                        </tr>
                        <?php }
                            $db->closeDb();
                            }
                        ?>
                    </tbody>
                </table>
                <input  class="btn" name="submit" type="submit" id="submit" value="提交">
            
</form>
<?php include '../foot.php'; ?>
    </body>
</html>

