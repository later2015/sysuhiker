<?php
/**
 * 统一初始化
 */
 
/** ---------------- 根目录定义，自动加载 ---------------- **/

date_default_timezone_set('Asia/Shanghai');

defined('API_ROOT') || define('API_ROOT', dirname(__FILE__) . '/..');

require_once API_ROOT . '/PhalApi/PhalApi.php';
$loader = new PhalApi_Loader(API_ROOT, 'Library');
$loader->loadFile('../SAE/emailUtil.class.php');//引入了才能在api文件夹里对应的地方自动加载
//$loader->addDirs('Library'); //这句不用加，上面已经add了这个目录了。
/** ---------------- 注册&初始化 基本服务组件 ---------------- **/

//自动加载
DI()->loader = $loader;

//配置
DI()->config = new PhalApi_Config_File(API_ROOT . '/Config');

//调试模式，$_GET['__debug__']可自行改名
DI()->debug = !empty($_GET['__debug__']) ? true : DI()->config->get('sys.debug');

//日记纪录
DI()->logger = new PhalApi_Logger_File(API_ROOT . '/Runtime', PhalApi_Logger::LOG_LEVEL_DEBUG | PhalApi_Logger::LOG_LEVEL_INFO | PhalApi_Logger::LOG_LEVEL_ERROR);

//数据操作 - 基于NotORM，$_GET['__sql__']可自行改名
DI()->notorm = new PhalApi_DB_NotORM(DI()->config->get('dbs'), !empty($_GET['__sql__']));

//翻译语言包设定
SL('zh_cn');

//云存储，图片上传插件
DI()->ucloud = new UCloud_Lite();
/** ---------------- 定制注册 可选服务组件 ---------------- **/

DI()->filter = new PhalApi_Filter_SysuhikerMD5('sign');//自定义的签名组件
/**
//签名验证服务
DI()->filter = 'PhalApi_Filter_SimpleMD5';//系统默认

 *
 *
 *
 *
 */

/**
//缓存 - Memcache/Memcached
DI()->cache = function () {
    return new PhalApi_Cache_Memcache(DI()->config->get('sys.mc'));
};
 */

/**
//支持JsonP的返回
if (!empty($_GET['callback'])) {
    DI()->response = new PhalApi_Response_JsonP($_GET['callback']);
}
 */
