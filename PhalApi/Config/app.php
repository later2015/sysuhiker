<?php
/**
 * 请在下面放置任何您需要的应用配置
 */

return array(

    /**
     * 应用接口层的统一参数
     */
    'apiCommonRules' => array(
        //'sign' => array('name' => 'sign', 'require' => true),//TODO 需增加签名字段必填选项。
    ),

    /**
     * 云上传引擎,支持local,oss,upyun，其他配置参考UCloud里的readme文件
     */
    'UCloudEngine' => 'local',

    /**
     * 本地存储相关配置（UCloudEngine为local时的配置）
     */
    'UCloud' => array(
        //对应的文件host根路径,子目录在lite.php里配置
        'host' => 'http://sysuhiker.cc/'
    ),
);
