<?php
/**
 * $APP_NAME 统一入口
 */

require_once dirname(__FILE__) . '/init.php';

$HTTP_RAW_POST_DATA = isset($GLOBALS['HTTP_RAW_POST_DATA']) ? $GLOBALS['HTTP_RAW_POST_DATA'] : "{}";
DI()->request = new PhalApi_Request(array_merge($_GET,json_decode($HTTP_RAW_POST_DATA, true))); 
//装载你的接口
DI()->loader->addDirs('Demo');

/** ---------------- 响应接口请求 ---------------- **/

$api = new PhalApi();
$rs = $api->response();
$rs->output();

