<?php ob_start(); ?>
<?php $navvar = "event";
    include 'navigation.php';
    error_reporting(0);
 ?>
<?php
//  $_SESSION['join_jumpURL'] = "joinlist.php?eventId=".$eventId;
$_SESSION['join_jumpURL'] = $_SERVER['REQUEST_URI'];
//当前的地址。
$eventId = $_GET["eventId"];
$useremail = $_SESSION["currentUserEmail"];
$currentUserId = $_SESSION["currentUserId"];
$eventMenber = FALSE;
$db = new SaeMysql();
$listSql = "select * from event_joinlist where event_joinlist_eventid='$eventId' order by event_joinlist_joindate asc";
$infoSql = "select * from event_info where event_id='$eventId'";
$result = $db -> getData($listSql);
$infoResult = $db -> getData($infoSql);
$eventOwnerId = $infoResult[0]["event_createUserId"];
$statusSql = "select event_joinlist_status from event_joinlist where event_joinlist_eventid='$eventId' and event_joinlist_userid ='$currentUserId'";
$userStatus = $db -> getVar($statusSql);
$eventJoinEndTime = $infoResult[0]['event_join_endtime'];
?>
<script type="text/javascript" src="../1433ueditor/ueditor.config.js"></script>
<script type="text/javascript" src="../1433ueditor/ueditor.all.min.js"></script>
<link rel="stylesheet" href="../1433ueditor/themes/default/css/ueditor.min.css"/>
    <!-- 实例化编辑器 -->
    <script type="text/javascript">
        var ue = UE.getEditor('reDetail');
    </script>
<body>
	
<div class="">
<h4>活动名称：<?php $eventName = $infoResult[0]["event_name"];
    echo $eventName;
?></h4>
<p>活动类型：<?php $eventType = $infoResult[0]["event_type"];
    echo $eventType;
?></p>
<pre>
活动时间：<?php echo $infoResult[0]["event_starttime"]?> 到 <?php echo $infoResult[0]["event_endtime"]?>  
报名开放时间：<?php echo $infoResult[0]["event_join_starttime"]?> 到 <?php echo $infoResult[0]["event_join_endtime"]?><br>
活动介绍： <?php echo $infoResult[0]["event_detail"]?><br>
备注：<?php echo $infoResult[0]["event_comments"]?><br>
</pre>
</div>

<?php
if($result==NULL){
	printf("暂时还没有人报名活动哦~！");
    //echo "<a class=\"btn\" href=\"join.php?eventId=".$eventId."&eventName=".$eventName."\">报名</a>";
}else{
?>
	<tr><td>已报名列表： </td></tr>
	<table class="table table-striped table-bordered table-condensed">
  	<tr class="title">
    <td width="4%">序号</td>
    <td width="10%">昵称</td>
    <td width="4%">性别</td>
    <td width="15%">角色</td>
    <td width="15%">报名时间</td>
    <td width="30%">备注</td>
    <td width="6%">审核状态</td>
  	</tr>
  
	
	<?php for($i=0;$i<count($result);$i++) {//显示结果 
	    if($useremail==$result[$i]["event_joinlist_useremail"]){
	        $eventMenber=TRUE;
	    }?>
	    
	  	<tr class="l_field">
	  	<td align="left"><?php echo $i+1?></td>
	    <td align="left">
		    <?php if($currentUserId==$eventOwnerId&& $_SESSION[$useremail."flag"] == TRUE){?>
		  		<a class="btn-link" data-toggle="modal" data-target="#hikerInfoDetail<?php echo $i?>"><?php echo $result[$i]["event_joinlist_usernick"]?></a>     
			<?php }else  { ?> 
		    	<a  class="btn-link" data-toggle="modal" data-target="#hikerInfo<?php echo $i?>"><?php echo $result[$i]["event_joinlist_usernick"]?></a>   
		    <?php } ?> 
	    
	        <div id="hikerInfo<?php echo $i?>" class="modal hide fade">
	            <div class="modal-header">
	            	<a class="close" data-dismiss="modal" >&times;</a>
	            	<h3><?php echo $result[$i]["event_joinlist_usernick"]?></h3>
	            </div>
	            <div class="modal-body">
	            	<Iframe src="hikerInfo.php?userId=<?php echo $result[$i]["event_joinlist_userid"]; ?>";  width="645"  height="300" scrolling="Y"frameborder="0"></iframe>
	            </div>
	            <div class="modal-footer">
	          		<a href="#" class="btn" data-dismiss="modal" >关闭</a>
	            </div>
	      	</div>        
	      	 
	       	<div id="hikerInfoDetail<?php echo $i?>" class="modal hide fade">
	            <div class="modal-header">
					<a class="close" data-dismiss="modal" >&times;</a>
		          	<h3><?php echo $result[$i]["event_joinlist_usernick"]?>的报名信息</h3>
	            </div>
	            <div class="modal-body">
	                <?php if($currentUserId==$eventOwnerId&& $_SESSION[$useremail."flag"] == TRUE){?>
		          	<h4>报名信息</h4>
					<table class="table table-striped table-bordered table-condensed">
					  	<tr><td>真实姓名</td><td><?php echo $result[$i]["event_joinlist_username"]?></td><td>QQ</td><td><?php echo $result[$i]["event_joinlist_qq"]?></td></tr>
					  	<tr><td>住址</td><td><?php echo $result[$i]["event_joinlist_useraddress"]?></td><td>电话</td><td><?php echo $result[$i]["event_joinlist_userphone"]?></td></tr>
					  	<tr><td>紧急联系人</td><td><?php echo $result[$i]["event_joinlist_userurgentname"]?></td><td>紧急联系人电话</td><td><?php echo $result[$i]["event_joinlist_userurgentphone"]?></td></tr>
					  	<tr><td>登山包容量</td><td><?php echo $result[$i]["event_joinlist_userbag"]?></td><td>睡袋温标</td><td><?php echo $result[$i]["event_joinlist_usersleepingbag"]?></td></tr>
					  	<tr><td>帐篷</td><td><?php echo $result[$i]["event_joinlist_usercamp"]?></td><td>防潮垫</td><td><?php echo $result[$i]["event_joinlist_usercamppad"]?></td></tr>
					  	<tr><td>对讲机</td><td><?php echo $result[$i]["event_joinlist_userinterphone"]?></td><td>保险信息</td><td><?php echo $result[$i]["event_joinlist_insurance"]?></td></tr>
					  	<tr><td>炉头</td><td><?php echo $result[$i]["event_joinlist_userBurner"]?></td><td>套锅</td><td><?php echo $result[$i]["event_joinlist_userpot"]?></td></tr>
		          	</table> 
		          	备注:<?php echo $result[$i]["event_joinlist_comments"]?>
		          	<?php } ?> 
		            <h4>个人信息</h4>
					<Iframe src="hikerInfo.php?userId=<?php echo $result[$i]["event_joinlist_userid"]; ?>";  width="645"  height="300" scrolling="Y" frameborder="0"></iframe>
	            </div>
	            <div class="modal-footer">
	          		<a href="#" class="btn" data-dismiss="modal" >关闭</a>
	            </div>
	      	</div>
	    </td>
	     
        <td align="left"><?php echo $result[$i]["event_joinlist_usergender"]?></td>
        <td align="left"><?php echo $result[$i]["event_joinlist_userrole"]?></td>
        <td align="left"><?php echo $result[$i]["event_joinlist_joindate"]?></td>
	    <td align="left"><?php echo $result[$i]["event_joinlist_comments"]?></td>    
	    <td align="left"><?php 
		    if($currentUserId==$eventOwnerId&& $_SESSION[$useremail."flag"] == TRUE){
		  	?>
	          	<div class="btn-group">
		          	<button class="btn btn-small" data-toggle="dropdown"><?php echo $result[$i]["event_joinlist_status"]; ?> <span class="caret"></span></button>
		          	<ul class="dropdown-menu">
			            <li><a href="updateJoinStatus.php?joinListId=<?php echo $result[$i]["event_joinlist_ID"]?>&joinListUserEmail=<?php echo $result[$i]["event_joinlist_useremail"]?>&joinStatus=活动协作">活动协作</a></li>
			            <li><a href="updateJoinStatus.php?joinListId=<?php echo $result[$i]["event_joinlist_ID"]?>&joinListUserEmail=<?php echo $result[$i]["event_joinlist_useremail"]?>&joinStatus=活动成员">活动成员</a></li>
			            <li><a href="updateJoinStatus.php?joinListId=<?php echo $result[$i]["event_joinlist_ID"]?>&joinListUserEmail=<?php echo $result[$i]["event_joinlist_useremail"]?>&joinStatus=候补成员">候补队员</a></li>
			            <li><a href="updateJoinStatus.php?joinListId=<?php echo $result[$i]["event_joinlist_ID"]?>&joinListUserEmail=<?php echo $result[$i]["event_joinlist_useremail"]?>&joinStatus=已退出">已退出</a></li>
			            <li><a href="updateJoinStatus.php?joinListId=<?php echo $result[$i]["event_joinlist_ID"]?>&joinListUserEmail=<?php echo $result[$i]["event_joinlist_useremail"]?>&joinStatus=资料不全，驳回">资料不全，驳回</a></li>
			            <li><a href="updateJoinStatus.php?joinListId=<?php echo $result[$i]["event_joinlist_ID"]?>&joinListUserEmail=<?php echo $result[$i]["event_joinlist_useremail"]?>&joinStatus=条件不合，拒绝">条件不合，拒绝</a></li>
			            <li><a href="updateJoinStatus.php?joinListId=<?php echo $result[$i]["event_joinlist_ID"]?>&joinListUserEmail=<?php echo $result[$i]["event_joinlist_useremail"]?>&joinStatus=飞机队员">飞机队员</a></li>
		          	</ul>
		        </div>
			<?php
            }else{
            echo $result[$i]["event_joinlist_status"];
            }
	        ?>
		</td>  
		</tr>
	
	<?php
        }
	?>
	</table>

	<?php
    $db -> closeDb();
    }
    $now = time();
    if ($now > strtotime($eventJoinEndTime)) {
    echo "<a class='btn btn-info disabled'>活动已经截止报名啦~！</a>";
    if($currentUserId==$eventOwnerId || $userStatus=="活动协作") {
    echo "<a class=\"btn\" href=\"editEvent.php?eventId=".$eventId."\">编辑活动信息</a>";
    echo "<a href=\"export.php?eventId=".$eventId."\"> 导出报名列表</a>";
    }
    } else if($eventMenber && isset($_SESSION["currentUserEmail"])&&isset($_SESSION[$useremail."flag"])&& $_SESSION[$useremail."flag"] == TRUE)
    {
?>
	<a class="btn" href="edit.php?eventId=<?php echo  $eventId?>&eventType=<?php echo  $eventType?>">修改报名资料</a> 
	<a class="btn" href="delete.php?eventId=<?php echo  $eventId?>">退出活动</a>
	<?php
        if ($currentUserId == $eventOwnerId || $userStatus == "活动协作") {
            echo "<a class=\"btn\" href=\"editEvent.php?eventId=" . $eventId . "\">编辑活动信息</a>";
            echo "<a href=\"export.php?eventId=" . $eventId . "\"> 导出报名列表</a>";
        }
        } else{
        echo "<a href=\"join.php?eventId=".$eventId."&eventName=".$eventName."&eventType=".$eventType."\" class=\"btn\">报名</a>";
        }
    ?>
                <br>
            <h3>活动评论：</h3>
<table class="table table-striped table-bordered table-condensed">
            <?php
            require_once ('dbutil.php');
            $dbutil = new dbutil();
            $reOrderId=0;
            $tabname = "event_bbs_re";
            $condExp = "where re_other = 'event' and re_postId =".$eventId." order by re_createTime asc";
            include 'share/paging.php';
            ?>

            <?php for($i=0;$i<count($result);$i++) {  $reOrderId =$result[$i]["re_orderId"];?>
            <tr>
                <td width="10%"><?php echo $reOrderId.' 楼 '.$dbutil->getNickByUserId($result[$i]["re_createUserId"]).' 发表于<br>'.$result[$i]["re_createTime"]?></td>
                <td width="60%"><?php echo $result[$i]["re_detail"]?></td>
            </tr>
            
        <?php } ?>
        </table>    
        <?php
        //added by helu-萝卜
        $dstHref = "joinlist.php?eventId=".$eventId;
        include 'share/pageindex.php';
        ?>
    <form name="form1" method="post" action="addReEvent.php?reType=event&eventId=<?php echo $eventId;?>">
    <tr>
    <td><textarea  name="reDetail"  id="reDetail"></textarea></td>
    <td><input name="Confirm" class="btn btn-large btn-primary" type="submit" id="Confirm" value="快速评论"></input></td>
    </tr>
    </form> 
</body>

<?php
    include 'foot.php';
 ?>
</html>
