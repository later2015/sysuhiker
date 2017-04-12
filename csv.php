<?php
/**
 * 输出一个数据库中的表到一个CSV文件中
 *
 * @param string Mysql数据库的主机
 * @param string 数据库名称
 * @param string 数据库中的表名
 * @param string 数据库的连接用户名
 * @param string 数据库的连接密码
 * @param string 数据库的表名
 * @param string 数据库的
 * @param string 错误页面
 * @param string SQL语句
 *
 * @return text 返回CSV格式的内容
 *
 * @access public
 */
function PMA_exportData($filename, $table, $crlf, $error_url, $sql) {
	$what = "csv";
	$csv_terminated = "\n";
	$csv_separator = ",";
	$csv_enclosed = " ";
	$csv_escaped = "&nbsp;";
	
	$db = new SaeMysql();
	$result=$db->getData($sql);

	$fields_cnt = count($result);
	$cc = "";

	// 格式化数据
	for($i=0;$i<$fields_cnt;$i++) {
	    $row=$result[$i];
		$schema_insert = '';
		$schema_insert.=$row["event_joinlist_username"].",".$row["event_joinlist_usernick"].",".$row["event_joinlist_usergender"].",".$row["event_joinlist_userrole"].",".
		      		$row["event_joinlist_useremail"].",".$row["event_joinlist_userphone"].",".$row["event_joinlist_useraddress"].",".$row["event_joinlist_userurgentname"].",".$row["event_joinlist_userurgentphone"].",".
		      		$row["event_joinlist_usercamp"].",".$row["event_joinlist_usercamppad"].",".$row["event_joinlist_usersleepingbag"].",".$row["event_joinlist_userinterphone"].",".
		      		$row["event_joinlist_userbag"].",".$row["event_joinlist_userBurner"].",".$row["event_joinlist_userpot"].",".$row["event_joinlist_joindate"].",".
		      		$row["event_joinlist_assessment"].",".$row["event_joinlist_declare"].",".$row["event_joinlist_insurance"].",".$row["event_joinlist_comments"];

		$cc .= $schema_insert . $csv_terminated;
	}// end while
$db->closeDb();

	// fclose(fp);
	return $cc;
}
?>