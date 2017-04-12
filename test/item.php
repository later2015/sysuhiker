<?php $navvar = "test";
include '../navigation.php'; ?>

<form name="form1" method="post" action="addItem.php">
<script type="text/javascript" src="../1433ueditor/ueditor.config.js"></script>
<script type="text/javascript" src="../1433ueditor/ueditor.all.min.js"></script>
<link rel="stylesheet" href="../1433ueditor/themes/default/css/ueditor.min.css"/>
    <!-- 实例化编辑器 -->
    <script type="text/javascript">
        var ue = UE.getEditor('itemDetail');
    </script>

  <h1>新增测试题目</h1>
<h2>请认真填写题目描述</h2>
<table>
<td align="left">题目内容</td>
<tr>
<td><textarea  name="itemDetail"  id="itemDetail"  class="input-xxxlarge">请输入题目描述和选项内容</textarea></td>
</tr>
<td align="left" width="10%">选项数量</td>
<tr>
<td><input name="itemOptions" type="text" id="itemOptions" size="80%"></input></td>
</tr>
<td align="left" width="10%">正确答案</td>
<tr>
<td><input name="itemAnswer" type="text" id="itemAnswer" size="80%"></input></td>
</tr>
</table>
选项用字母标注，正确答案也只需要填写字母即可。<input name="Confirm" class="btn" type="submit" id="Confirm" value="提交"></input><br>
</form>
</body>
<?php include '../foot.php'; ?>
</html>