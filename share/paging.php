<?php

//added by helu-萝卜
//$sql="select count(*) from event_bbs";
$sql="select count(*) from ".$tabname." ".$condExp;
$result=$db->getData($sql);
$ItemNum = $result[0]["count(*)"];
//设定每一页显示的记录数
$pagesize = 20;
//计算总页数
$pages=intval($ItemNum/$pagesize);
if($ItemNum % $pagesize)
	$pages++;
//设置页数
if(isset($_GET['page'])){
	$page = intval($_GET['page']);
}
else{
 	$page = 1; //没有页数则显示第一页；
}
//计算记录偏移量
$offset = ($page-1)*$pagesize;
//读取指定的记录数
$sql="select * from ".$tabname." ".$condExp." limit $offset, $pagesize";
$result=$db->getData($sql);
//echo $sql;


?>