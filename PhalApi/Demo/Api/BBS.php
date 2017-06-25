<?php

/**
 * 默认接口服务类
 *
 * @author: dogstar <chanzonghuang@gmail.com> 2014-10-04
 */
class Api_BBS extends PhalApi_Api
{

    public function getRules()
    {
        return array(
            'getBBSList' => array(
                'pagesize' => array('name' => 'pagesize', 'type' => 'int', 'min' => 1, 'require' => FALSE, 'desc' => '每页文章数'),
                'page' => array('name' => 'page', 'type' => 'int', 'min' => 1, 'require' => FALSE, 'desc' => '页数'),
            ),
            'getBBSReList' => array(
                'postId' => array('name' => 'post_id', 'type' => 'int', 'min' => 1, 'require' => true, 'desc' => '文章ID'),
                'pagesize' => array('name' => 'pagesize', 'type' => 'int', 'min' => 1, 'require' => FALSE, 'desc' => '每页回复数'),
                'page' => array('name' => 'page', 'type' => 'int', 'min' => 1, 'require' => FALSE, 'desc' => '页数'),
            ),
            'getBBSInfo' => array(
                'postId' => array('name' => 'post_id', 'type' => 'int', 'min' => 1, 'require' => true, 'desc' => '文章ID'),
            ),
            'addPost' => array(
                'postTitle' => array('name' => 'post_title', 'type' => 'string', 'min' => 1, 'require' => true, 'desc' => '文章标题'),
                'postType' => array('name' => 'post_type', 'type' => 'string', 'min' => 1, 'require' => true, 'desc' => '文章类型'),
                'postDetail' => array('name' => 'post_detail', 'type' => 'string', 'min' => 1, 'require' => true, 'desc' => '文章内容'),
                'postKeywords' => array('name' => 'post_keywords', 'type' => 'string', 'min' => 1, 'require' => true, 'desc' => '文章关键字'),
                'userId' => array('name' => 'user_id', 'type' => 'string', 'min' => 1, 'require' => true, 'desc' => '当前登陆用户ID'),
            ),
            'editPost' => array(
                'postId' => array('name' => 'post_id', 'type' => 'string', 'min' => 1, 'require' => true, 'desc' => '文章ID'),
                'postTitle' => array('name' => 'post_title', 'type' => 'string', 'min' => 1, 'require' => true, 'desc' => '文章标题'),
                'postType' => array('name' => 'post_type', 'type' => 'string', 'min' => 1, 'require' => true, 'desc' => '文章类型'),
                'postDetail' => array('name' => 'post_detail', 'type' => 'string', 'min' => 1, 'require' => true, 'desc' => '文章内容'),
                'postKeywords' => array('name' => 'post_keywords', 'type' => 'string', 'min' => 1, 'require' => true, 'desc' => '文章关键字'),
                'userId' => array('name' => 'user_id', 'type' => 'string', 'min' => 1, 'require' => true, 'desc' => '当前登陆用户ID'),
            ),
            'deletePost' => array(
                'postId' => array('name' => 'post_id', 'type' => 'string', 'min' => 1, 'require' => true, 'desc' => '文章ID'),
                'userId' => array('name' => 'user_id', 'type' => 'string', 'min' => 1, 'require' => true, 'desc' => '当前登陆用户ID'),
            ),
            'addPostRe' => array(
                'postId' => array('name' => 'post_id', 'type' => 'string', 'min' => 1, 'require' => true, 'desc' => '文章ID'),
                'userComments' => array('name' => 'userComments', 'type' => 'string', 'min' => 1, 'require' => true, 'desc' => '评论内容'),
                'userId' => array('name' => 'user_id', 'type' => 'string', 'min' => 1, 'require' => true, 'desc' => '当前登陆用户ID'),
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
     * @return string list[].post_createUserNick 文章发表用户昵称
     * @return string list[].post_modifyTime 文章修改时间
     * @return string list[].post_modifyUserId 文章修改用户id
     * @return string msg 提示信息
     * ,,
     */
    public function getBBSList()
    {
        DI()->logger->info('BBS.getBBSList api is call.');
        $rs = array('code' => 0, 'msg' => '', 'list' => array());

        $domain = new Domain_BBS();
        $list = $domain->getBBSList($this->page, $this->pagesize);

        if (empty($list)) {
            DI()->logger->info('event list not found');

            $rs['code'] = 1;
            $rs['msg'] = T('event not exists');
            return $rs;
        }

        $rs['list'] = $list;

        return $rs;
    }

    /**
     * 获取文章评论列表
     * @desc 用于获取文章回复评论列表
     * @return int code 操作码，0表示成功，1表示获取失败
     * @return array list 文章评论回复列表
     * @return int list[].re_postId 文章的id
     * @return string list[].re_orderId 评论的排序id
     * @return string list[].re_detail 评论内容
     * @return string list[].re_createTime 评论时间
     * @return string list[].re_createUserId 评论作者ID
     * @return string list[].re_createUserNick 评论作者nick
     * @return string msg 提示信息
     * ,,
     */
    public function getBBSReList()
    {
        DI()->logger->info('BBS.getBBSList api is call.');
        $rs = array('code' => 0, 'msg' => '', 'list' => array());

        $domain = new Domain_BBS();
        $list = $domain->getBBSReList($this->postId, $this->page, $this->pagesize);

        if (empty($list)) {
            DI()->logger->info('BBS re list not found');

            $rs['code'] = 1;
            $rs['msg'] = T('BBS post not exists');
            return $rs;
        }

        $rs['list'] = $list;

        return $rs;
    }

    /**
     * 获取文章详情
     * @desc 用于获取文章详情
     * @return int code 操作码，0表示成功，1表示获取失败
     * @return object info 文章详情
     * @return int info.post_id 文章ID
     * @return string info.post_title 文章标题
     * @return string info.post_detail 文章内容
     * @return string info.post_type 文章类型
     * @return string info.post_keywords 文章关键字
     * @return string info.post_createTime 文章发表时间
     * @return string info.post_createUserId 文章发表用户ID
     * @return string info.post_modifyTime 文章修改时间
     * @return string info.post_modifyUserId 文章修改用户id
     * @return string msg 提示信息
     * ,,
     */
    public function getBBSInfo()
    {
        DI()->logger->info('BBS.getBBSInfo api is call.');
        $rs = array('code' => 0, 'msg' => '', 'list' => array());

        $domain = new Domain_BBS();
        $info = $domain->getBBSInfo($this->postId);

        if (empty($info)) {
            DI()->logger->info('bbs info not found');

            $rs['code'] = 1;
            $rs['msg'] = T('bbs post not exists');
            return $rs;
        }

        $rs['info'] = $info;

        return $rs;
    }

    /**
     * 发表文章
     * @desc 发表文章
     * @return int code 操作码，0表示成功，1表示失败
     * @return string msg 提示信息
     * ,,
     */
    public function addPost()
    {
        $rs = array('code' => 0, 'msg' => '');
        //发表文章的处理逻辑
        $input = array('post_title' => $this->postTitle,
            'post_type' => $this->postType,
            'post_detail' => $this->postDetail,
            'post_keywords' => $this->postKeywords,
            'post_createUserId' => $this->userId,
            'post_modifyUserId' => $this->userId,
            'post_permission' => '公开');
        DI()->logger->info('Event.addPost api is call.', $input);

        $domain = new Domain_BBS();
        $result = $domain->addPost($input);

        if ($result != 'success') {
            DI()->logger->info('fail to add BBS.');

            $rs['code'] = 1;
            $rs['msg'] = 'fail to add BBS.' . $result;
            return $rs;
        }

        $rs['msg'] = "success";

        return $rs;
    }

    /**
     * 修改文章
     * @desc 修改文章
     * @return int code 操作码，0表示成功，1表示失败
     * @return string msg 提示信息
     * ,,
     */
    public function editPost()
    {
        $rs = array('code' => 0, 'msg' => '');
        //修改活动信息的处理逻辑 post_id
        $input = array('post_id' => $this->postId,
            'post_title' => $this->postTitle,
            'post_type' => $this->postType,
            'post_detail' => $this->postDetail,
            'post_keywords' => $this->postKeywords,
            'post_modifyUserId' => $this->userId);
        DI()->logger->info('Event.editPost api is call.', $input);

        $domain = new Domain_BBS();
        $result = $domain->editPost($input);

        if ($result != 'success') {
            DI()->logger->info('fail to edit post.');

            $rs['code'] = 1;
            $rs['msg'] = 'fail to edit post.' . $result;
            return $rs;
        }
        $rs['msg'] = "success";
        return $rs;
    }
    /**
     * 删除文章
     * @desc 删除文章
     * @return int code 操作码，0表示成功，1表示失败
     * @return string msg 提示信息
     * ,,
     */
    public function deletePost()
    {
        $rs = array('code' => 0, 'msg' => '');
        //修改活动信息的处理逻辑 post_id
        $input = array('post_id' => $this->postId,
            'post_modifyUserId' => $this->userId);
        DI()->logger->info('Event.deletePost api is call.', $input);

        $domain = new Domain_BBS();
        $result = $domain->deletePost($input);

        if ($result != 'success') {
            DI()->logger->info('fail to delete post.');

            $rs['code'] = 1;
            $rs['msg'] = 'fail to delete post.' . $result;
            return $rs;
        }
        $rs['msg'] = "success";
        return $rs;
    }
    /**
     * 评论文章
     * @desc 评论文章
     * @return int code 操作码，0表示成功，1表示失败
     * @return string msg 提示信息
     * ,,
     */
    public function addPostRe()
    {
        $rs = array('code' => 0, 'msg' => '');
        $re_orderId = '';//TODO 该排序值需要加上去
        $input = array('re_postId' => $this->postId, 're_createUserId' => $this->userId, 're_modifyUserId' => $this->userId, 're_detail' => $this->userComments);
        DI()->logger->info('Event.addPostRe api is call.',$input);

        $domain = new Domain_BBS();
        $result = $domain->addPostRe($input);

        if ($result != 'success') {
            DI()->logger->debug('fail to comment.');
            $rs['code'] = 1;
            $rs['msg'] = 'fail to comment.' . $result;
            return $rs;
        }

        $rs['msg'] = "success";
        return $rs;
    }
}
