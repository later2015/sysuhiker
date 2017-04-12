<?php $navvar = "club";
include '../navigation.php'; ?>
<link rel="stylesheet" type="text/css" href="css/jquery-ui.css" /> 
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript" src="../1433ueditor/ueditor.config.js"></script>
<script type="text/javascript" src="../1433ueditor/ueditor.all.min.js"></script>
<link rel="stylesheet" href="../1433ueditor/themes/default/css/ueditor.min.css"/>
    <!-- 实例化编辑器 -->
    <script type="text/javascript">
        var ue = UE.getEditor('reDetail');
    </script>

<body>
	<?php
	require_once ('../dbutil.php');
	$dbutil = new dbutil();
	//$postId=$_GET['postId'];
	
	//added by helu-萝卜
	if(isset($_GET['postId']))
	{
		$postId = $_GET['postId'];
		$_SESSION["postId"] = $postId;
	}
	else {
		$postId = $_SESSION["postId"];
	}
	
	$db=new SaeMysql();
	$sql="select * from event_bbs where post_id =".$postId;
	$result1=$db->getLine($sql);
	//echo $sql;
	
	if($result1==NULL){
	    printf("不知道为啥找不到内容呀~！");
	}else{?>
		
		<table class="table table-striped table-bordered table-condensed">
		<thead>
			<tr class="title">
		    	<td width="10%" ></td>
		    	<th width="60%" >标题：<?php echo $result1["post_title"]?></th>
		  	</tr>
	    </thead>
	    
	    <tbody>
	    	
		  	<?php
		  	
			$reOrderId=0;
			//added by helu-萝卜
			$tabname = event_bbs_re;
			$condExp = "where re_other != 'event' and re_postId =".$postId." order by re_createTime asc";
			include '../share/paging.php';
		  	?>
	    	
			<?php
			if($page ==1){
			?>
			   	<tr>
			    	<td width="10%"><?php echo '楼主 '.$dbutil->getNickByUserId($result1["post_createUserId"]).' 发表于<br>'.$result1["post_createTime"]?></td>
			    	<td width="60%"><?php echo $result1["post_detail"]?><br>关键字：<?php echo $result["post_keywords"]?></td>
			  	</tr>
		  	<?php
			}
		  	?>
		
		  	<?php for($i=0;$i<count($result);$i++) {  $reOrderId =$result[$i]["re_orderId"];?>
		    <tr>
		    	<td width="10%"><?php echo $reOrderId.' 楼 '.$dbutil->getNickByUserId($result[$i]["re_createUserId"]).' 回复于<br>'.$result[$i]["re_createTime"]?></td>
		    	<td width="60%"><?php echo $result[$i]["re_detail"]?></td>
		  	</tr>
		  	
	    <?php } ?>
	    </tbody>
	    </table>    
	    
		<?php
		//added by helu-萝卜
		$dstHref = "postDetail.php?postId=".$postId;
		include '../share/pageindex.php';
		?>
		
	<?php
		$db->closeDb();
	}
	?>
	
	<form name="form1" method="post" action="addRePost.php?postId=<?php echo $postId;?>">
	<span>回复帖子</span><br>
	<tr>
	<td><textarea  name="reDetail"  id="reDetail"></textarea></td>
	<td><input name="Confirm" class="btn btn-large btn-primary" type="submit" id="Confirm" value="回复"></input></td>
	</tr>
	</form> 

</body>
<?php include '../foot.php'; ?>
</html>