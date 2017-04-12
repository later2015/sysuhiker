<?php $navvar = "event";
include 'navigation.php'; ?>

<body>
<hr/>

	<!-- add by diro 2016-08-02 20:39:33 -->
	<tr><td>火热进行中: </td></tr>
	<table class="table table-striped table-bordered table-condensed">
  	<tr class="title">
	    <td width="4%" >序号</td>
	    <td width="15%">活动名称</td>
	    <td width="8%" >活动类型</td>
	    <td width="15%">活动时间</td>
	    <td width="15%">报名截止时间</td>
	    <td width="20%">备注</td>
  	</tr>
	<?php
	$db=new SaeMysql();
	
	$tabname = 'event_info';
	$condExp = "order by event_join_endtime desc";
	$sql="select * from ".$tabname." ".$condExp." limit 0, 20";
	$result=$db->getData($sql);
    $now = time();

	
	if($result==NULL){
	    printf("暂时还没有进行的活动哦~！");
	}else{
		for($i=0;$i<count($result);$i++) {//显示结果 
		    if ($now < strtotime($result[$i]["event_endtime"])){
		?>

		  	<tr class="l_field">
			  	<td align="left"><?php echo $result[$i]["event_id"]?></td>
		        <td align="left"><a href="joinlist.php?eventId=<?php echo  $result[$i]["event_id"]?>"><?php echo $result[$i]["event_name"]?></td>
	            <td align="left"><?php echo $result[$i]["event_type"]?></td>
	            <td align="left">开始：<?php echo $result[$i]["event_starttime"]?><br>结束：<?php echo $result[$i]["event_endtime"]?></td>
	            <td align="left"><?php echo $result[$i]["event_join_endtime"]?></td>
			    <td align="left"><?php echo $result[$i]["event_comments"]?></td>    
		  	</tr>
		<?php 
			}
		}
	}
	?>
	</table>


	<br><br>
	<!-- add by diro 2016-08-02 20:39:33 -->



	<tr><td>活动列表： </td></tr>
    <table class="table table-striped table-bordered table-condensed">
  	<tr class="title">
	    <td width="4%" >序号</td>
	    <td width="15%">活动名称</td>
	    <td width="8%" >活动类型</td>
	    <td width="15%">活动时间</td>
	    <td width="15%">报名截止时间</td>
	    <td width="20%">备注</td>
  	</tr>
    
	<?php
	//$sql="select * from event_info order by event_createtime asc";
	//$result=$db->getData($sql);
	
	//added by helu-萝卜
	$tabname = event_info;
	$condExp = "order by event_createtime desc";
	include 'share/paging.php';
	
	if($result==NULL){
	    printf("暂时还没有活动哦~！");
	}else{
		for($i=0;$i<count($result);$i++) {//显示结果 
		?>
		  	<tr class="l_field">
			  	<td align="left"><?php echo $result[$i]["event_id"]?></td>
		        <td align="left"><a href="joinlist.php?eventId=<?php echo  $result[$i]["event_id"]?>"><?php echo $result[$i]["event_name"]?></td>
	            <td align="left"><?php echo $result[$i]["event_type"]?></td>
	            <td align="left">开始：<?php echo $result[$i]["event_starttime"]?><br>结束：<?php echo $result[$i]["event_endtime"]?></td>
	            <td align="left"><?php echo $result[$i]["event_join_endtime"]?></td>
			    <td align="left"><?php echo $result[$i]["event_comments"]?></td>    
		  	</tr>
		<?php 
		}
		$db->closeDb();
	}
	?>
	</table>
	<a class="btn"   href="event.php">我要发起活动</a> <br />
	
	<?php
	//added by helu-萝卜
	$dstHref = "eventlist.php?";
	include 'share/pageindex.php';
    ?>  

</body>

<?php include 'foot.php'; ?>
</html>