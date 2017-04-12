<?php $navvar = "club";
include '../navigation.php'; ?>
<body>
 <tr><td>逸仙茶馆</td></tr>
	<table class="table table-striped table-condensed">
	    <thead>
		  	<tr class="title">
			    <td width="5%">序号</td>
			    <td width="5%">分类</td>    
			    <td width="55%">标题</td>
		        <td width="5%">作者</td>
		        <td width="7%">关键字</td>
		        <td width="5%">回复</td>
		        <td width="15%">最后更新</td>
		  </tr>
	    </thead>
	    
		<tbody>
			<?php
			require_once ('../dbutil.php');
			$dbutil = new dbutil();
			$db=new SaeMysql();
			
			//added by helu-萝卜
			$tabname = event_bbs;
			$condExp = "order by post_id desc";
			include '../share/paging.php';
    
			if($result==NULL){
			    printf("不知道为啥找不到内容呀~！");
			}else{
				
				for($i=0;$i<count($result);$i++) {//显示结果 
				?>
				    <tr class="l_field">
				    <td align="left"><?php echo $result[$i]["post_id"]?></td>
				    <td align="left"><?php echo $result[$i]["post_type"]?></td>
				    <td align="left"><a href="postDetail.php?postId=<?php echo  $result[$i]["post_id"]?>"><?php echo $result[$i]["post_title"]?></a></td>
				    <td align="left"><?php echo $dbutil->getNickByUserId($result[$i]["post_createUserId"])?></td>
				    <td align="left"><?php echo $result[$i]["post_keywords"]?></td>
				    <td align="left"><?php echo $result[$i]["post_countRe"]?></td>
				    <td align="left"><?php echo $dbutil->getNickByUserId($result[$i]["post_modifyUserId"])?> 发表于<?php echo $result[$i]["post_modifyTime"]?></td>    
				    </tr>
				<?php }
				$db->closeDb();
			}
			?>
		<tbody>
	</table>
	
	<?php
	//added by helu-萝卜
	$dstHref = "postList.php?";
	include '../share/pageindex.php';
    ?>  

<a class="btn" href="post.php">发布新帖</a> 
</body>
<?php include '../foot.php'; ?>
</html>