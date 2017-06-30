<?php

/**
 * Created by IntelliJ IDEA.
 * 上传接口
 * User: liqiliang <later.h.p@qq.com>
 * Date: 2017/6/30
 * Time: 17:43
 */
class Api_Upload extends PhalApi_Api
{
    /**
     * 获取参数
     * @return array 参数信息
     */
    public function getRules()
    {
        return array(
            'upload' => array(
                'file' => array(
                    'name' => 'file',
                    'type' => 'file',
                    'min' => 0,
                    'max' => 1024 * 1024,
                    'range' => array('image/jpg', 'image/jpeg', 'image/png', 'image/gif', 'image/bmp'),
                    'ext' => array('jpg', 'jpeg', 'png', 'gif' , 'bmp')
                ),
            ),
        );
    }

    /**
     * 上传文件
     * @return string $url 绝对路径
     * @return string $file 相对路径，用于保存至数据库，按项目情况自己决定吧
     */
    public function upload()
    {

        //设置上传路径 设置方法参考3.2
        DI()->ucloud->set('save_path', date('Y/m/d'));

        //新增修改文件名设置上传的文件名称
        DI()->ucloud->set('file_name', 'avatar');//TODO 不设置则插件自动配置文件名

        //上传表单名
        $rs = DI()->ucloud->upfile($this->file);

        return $rs;
    }
}