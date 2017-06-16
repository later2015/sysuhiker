<?php
/**
 * 默认接口服务类
 *
 * @author: dogstar <chanzonghuang@gmail.com> 2014-10-04
 */

class Api_BBS extends PhalApi_Api {

	public function getRules() {
        return array(
            'getBBSList' => array(
                'pagesize' => array('name' => 'pagesize', 'type' => 'int', 'min' => 1, 'require' => FALSE, 'desc' => '每页活动数'),
                'page' => array('name' => 'page', 'type' => 'int', 'min' => 1, 'require' => FALSE, 'desc' => '页数'),
            ),
        );
	}

    /**
     * 获取文章列表
     * @desc 用于获取文章列表
     * @return int code 操作码，0表示成功，1表示获取失败
     * @return array list 文章列表
     * @return int list[].post_id 文章ID
     * @return string list[].post_title 文章标题
     * @return string list[].post_type 文章类型
     * @return string list[].post_keywords 文章关键字
     * @return string list[].post_createTime 文章发表时间
     * @return string list[].post_createUserId 文章发表用户ID
     * @return string list[].post_modifyTime 文章修改时间
     * @return string list[].post_modifyUserId 文章修改用户id
     * @return string msg 提示信息
     * ,,
     */
	public function getBBSList() {
        DI()->logger->info('BBS.getBBSList api is call.');
        $rs = array('code' => 0, 'msg' => '', 'list' => array());

        $domain = new Domain_BBS();
        $list = $domain->getBBSList($this->page, $this->pagesize);

        if (empty($list)) {
            DI()->logger->debug('event list not found');

            $rs['code'] = 1;
            $rs['msg'] = T('event not exists');
            return $rs;
        }

        $rs['list'] = $list;

        return $rs;
	}
}
