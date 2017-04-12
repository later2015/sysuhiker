<?php

class Api_Event extends PhalApi_Api {

    public function getRules() {
        return array(
            'getEventInfo' => array(
                'eventId' => array('name' => 'event_id', 'type' => 'int', 'min' => 1, 'require' => true, 'desc' => '活动ID'),
            ),
            'getEventList' => array(
                'pagesize' => array('name' => 'pagesize', 'type' => 'int', 'min' => 1, 'require' => FALSE, 'desc' => '每页活动数'),
                'page' => array('name' => 'page', 'type' => 'int', 'min' => 1, 'require' => FALSE, 'desc' => '页数'),
            ),
            'getEventJoinList' => array(
                'eventId' => array('name' => 'event_id', 'type' => 'int', 'min' => 1, 'require' => true, 'desc' => '活动ID'),
            ),//活动报名列表 
            'getEventReList' => array(
                'eventId' => array('name' => 'event_id', 'type' => 'int', 'min' => 1, 'require' => true, 'desc' => '活动ID'),
                'pagesize' => array('name' => 'pagesize', 'type' => 'int', 'min' => 1, 'require' => FALSE, 'desc' => '每页活动数'),
                'page' => array('name' => 'page', 'type' => 'int', 'min' => 1, 'require' => FALSE, 'desc' => '页数'),
            ),//活动评论列表 
            'joinEvent' => array(
                'eventId' => array('name' => 'event_joinlist_eventid', 'type' => 'int', 'min' => 1, 'require' => true, 'desc' => '活动ID'),
                'userId' => array('name' => 'event_joinlist_userid', 'type' => 'int', 'min' => 1, 'require' => true, 'desc' => '用户id'),
                'userPhone' => array('name' => 'event_joinlist_userphone', 'type' => 'string', 'min' => 1, 'require' => true, 'desc' => '电话'), 
                'qq' => array('name' => 'event_joinlist_qq', 'type' => 'string', 'min' => 0, 'require' => FALSE, 'desc' => 'qq'),    
                'userUrgentName' => array('name' => 'event_joinlist_userurgentname', 'type' => 'string', 'min' => 1, 'require' => true, 'desc' => '紧急联系人'),   
                'userUrgentPhone' => array('name' => 'event_joinlist_userurgentphone', 'type' => 'string', 'min' => 1, 'require' => true, 'desc' => '紧急联系人电话'), 
                'useraddress' => array('name' => 'event_joinlist_useraddress', 'type' => 'string', 'min' => 0, 'require' => FALSE, 'desc' => '地址'), 
                'userrole' => array('name' => 'event_joinlist_userrole', 'type' => 'string', 'min' => 0, 'require' => FALSE, 'desc' => '团队角色'),
                'userComments' => array('name' => 'event_joinlist_comments', 'type' => 'string', 'min' => 0, 'require' => FALSE, 'desc' => '备注'),
                'insurance' => array('name' => 'event_joinlist_insurance', 'type' => 'string', 'min' => 0, 'require' => FALSE, 'desc' => '保险信息'), 
                'usercamp' => array('name' => 'event_joinlist_usercamp', 'type' => 'string', 'min' => 0, 'require' => FALSE, 'desc' => '帐篷信息'), 
                'usercamppad' => array('name' => 'event_joinlist_usercamppad', 'type' => 'string', 'min' => 0, 'require' => FALSE, 'desc' => '防潮垫信息'), 
                'usersleepingbag' => array('name' => 'event_joinlist_usersleepingbag', 'type' => 'string', 'min' => 0, 'require' => FALSE, 'desc' => '睡袋信息'), 
                'userinterphone' => array('name' => 'event_joinlist_userinterphone', 'type' => 'string', 'min' => 0, 'require' => FALSE, 'desc' => '对讲机信息'), 
                'userbag' => array('name' => 'event_joinlist_userbag', 'type' => 'string', 'min' => 0, 'require' => FALSE, 'desc' => '登山包信息'), 
                'userBurner' => array('name' => 'event_joinlist_userBurner', 'type' => 'string', 'min' => 0, 'require' => FALSE, 'desc' => '炉头信息'),  
                'userpot' => array('name' => 'event_joinlist_userpot', 'type' => 'string', 'min' => 0, 'require' => FALSE, 'desc' => '套锅信息'),                   
            ),//报名参加活动
            'quit' => array(
                'eventId' => array('name' => 'event_joinlist_eventid', 'type' => 'int', 'min' => 1, 'require' => true, 'desc' => '活动ID'),
                'userId' => array('name' => 'event_joinlist_userid', 'type' => 'int', 'min' => 1, 'require' => true, 'desc' => '用户id'),
                'userComments' => array('name' => 'event_joinlist_comments', 'type' => 'string', 'min' => 1, 'require' => true, 'desc' => '备注'),
            ),//退出活动  
            'addEventRe' => array(
                'eventId' => array('name' => 'eventId', 'type' => 'int', 'min' => 1, 'require' => true, 'desc' => '活动ID'),
                'userId' => array('name' => 'userId', 'type' => 'int', 'min' => 1, 'require' => true, 'desc' => '用户id'),
                'userComments' => array('name' => 'userComments', 'type' => 'string', 'min' => 1, 'require' => true, 'desc' => '活动评论内容'),                   
            ),//评论活动                       
            'getMultiBaseInfo' => array(
                'userIds' => array('name' => 'user_ids', 'type' => 'array', 'format' => 'explode', 'require' => true, 'desc' => '用户ID，多个以逗号分割'),
            ),
        );
    }

    /**
     * 获取活动基本信息
     * @desc 用于获取某个活动的基本信息
     * @return int code 操作码，0表示成功，1表示用户不存在
     * @return object info 活动信息对象
     * @return int info.event_id 活动ID
     * @return string info.event_name 活动名字
     * @return string info.event_type 活动类型
	 * @return string info.event_detail 活动详情
     * @return date info.event_starttime 活动开始时间
	 * @return date info.event_endtime 活动结束时间
     * @return date info.event_join_starttime 活动报名开始时间
	 * @return date info.event_join_endtime 活动报名结束时间
     * @return string info.event_comments 活动备注
	 * @return date info.event_createtime 活动创建时间
	 * @return string info.event_createUserId 活动创建者
	 * @return int info.event_maxhiker 活动最大人数
	 * @return string msg 提示信息
     */
    public function getEventInfo() {
        $rs = array('code' => 0, 'msg' => '', 'info' => array());

        $domain = new Domain_Event();
        $info = $domain->getEventInfo($this->eventId);

        if (empty($info)) {
            DI()->logger->debug('event not found', $this->eventId);

            $rs['code'] = 1;
            $rs['msg'] = T('event not exists');
            return $rs;
        }

        $rs['info'] = $info;

        return $rs;
    }
    /**
     * 获取活动列表
     * @desc 用于获取活动列表
     * @return int code 操作码，0表示成功，1表示获取失败
     * @return array list 活动列表
     * @return int list[].event_id 活动ID
     * @return string list[].event_name 活动名字
     * @return string list[].event_type 活动类型
	 * @return string list[].event_starttime 活动开始时间
	 * @return string list[].event_join_endtime 活动报名截止时间
	 * @return string list[].event_comments 活动备注
     * @return string msg 提示信息
	 * ,,
     */
    public function getEventList() {
        $rs = array('code' => 0, 'msg' => '', 'list' => array());

        $domain = new Domain_Event();
        $list = $domain->getEventList($this->page,$this->pagesize);

        if (empty($list)) {
            DI()->logger->debug('event list not found');

            $rs['code'] = 1;
            $rs['msg'] = T('event not exists');
            return $rs;
        }

        $rs['list'] = $list;

        return $rs;
    }
	/**
     * 获取活动报名列表
     * @desc 用于获取活动报名名单列表
     * @return int code 操作码，0表示成功，1表示获取失败
     * @return array list 活动报名列表
     * @return int list[].event_id 活动ID
     * @return string list[].event_joinlist_usernick 报名者昵称
     * @return string list[].event_joinlist_usergender 性别
	 * @return string list[].event_joinlist_userrole 角色
	 * @return string list[].event_joinlist_joindate 活动报名时间
	 * @return string list[].event_joinlist_comments 报名备注
     * @return string msg 提示信息
	 * ,,
     */
    public function getEventJoinList() {
        $rs = array('code' => 0, 'msg' => '', 'list' => array());

        $domain = new Domain_Event();
        $list = $domain->getEventJoinList($this->eventId);

        if (empty($list)) {
            DI()->logger->debug('event join list not found');

            $rs['code'] = 1;
            $rs['msg'] = T('event not exists');
            return $rs;
        }

        $rs['list'] = $list;

        return $rs;
    }
	/**
     * 获取活动评论列表
     * @desc 用于获取活动评论列表
     * @return int code 操作码，0表示成功，1表示获取失败
     * @return array list 活动列表
     * @return int list[].re_postId 活动的id或者文章的id
     * @return string list[].re_orderId 评论的排序id
     * @return string list[].re_detail 评论内容
	 * @return string list[].re_createTime 评论时间
	 * @return string list[].re_createUserId 评论作者
     * @return string msg 提示信息
	 * ,,
     */
    public function getEventReList() {
        $rs = array('code' => 0, 'msg' => '', 'list' => array());

        $domain = new Domain_Event();
        $list = $domain->getEventReList($this->eventId,$this->page,$this->pagesize);

        if (empty($list)) {
            DI()->logger->debug('event list not found');

            $rs['code'] = 1;
            $rs['msg'] = T('event not exists');
            return $rs;
        }

        $rs['list'] = $list;

        return $rs;
    }
	/**
     * 报名活动
     * @desc 报名活动
     * @return int code 操作码，0表示成功，1表示失败
     * @return string msg 提示信息
	 * ,,
     */
    public function joinEvent() {
        $rs = array('code' => 0, 'msg' => '');
		$input = array('event_joinlist_eventid' => $this->eventId, 'event_joinlist_userid' => $this->userId, 'event_joinlist_userphone' => $this->userPhone,'event_joinlist_qq' => $this->qq,
		'event_joinlist_userurgentname' => $this->userUrgentName, 'event_joinlist_userurgentphone' => $this->userUrgentPhone, 'event_joinlist_comments' => $this->userComments,'event_joinlist_useraddress' => $this->useraddress,
		'event_joinlist_insurance' => $this->insurance, 'event_joinlist_usercamp' => $this->usercamp, 'event_joinlist_usercamppad' => $this->usercamppad,
		'event_joinlist_usersleepingbag' => $this->usersleepingbag, 'event_joinlist_userinterphone' => $this->userinterphone, 'event_joinlist_userbag' => $this->userbag,
		'event_joinlist_userBurner' => $this->userBurner, 'event_joinlist_userpot' => $this->userpot,'event_joinlist_userrole' => $this->userrole);
		
        $domain = new Domain_Event();
        $result = $domain->joinEvent($input);

        if ($result!='success') {
            DI()->logger->debug('fail to join.');

            $rs['code'] = 1;
            $rs['msg'] = T('fail to join.'.$result);
            return $rs;
        }

        $rs['msg'] = "success";

        return $rs;
    }//TODO	
	/**
     * 退出活动
     * @desc 退出活动
     * @return int code 操作码，0表示成功，1表示获取失败
     * @return string msg 提示信息
	 * ,,
     */
    public function quit() {
        $rs = array('code' => 0, 'msg' => '');
		$input = array('event_joinlist_eventid' => $this->eventId, 'event_joinlist_userid' => $this->userId, 'event_joinlist_comments' => $this->userComments);
		
        $domain = new Domain_Event();
        $result = $domain->quit($input);

        if ($result!='success') {
            DI()->logger->debug('fail to quit.');

            $rs['code'] = 1;
            $rs['msg'] = T('fail to quit.');
            return $rs;
        }

        $rs['msg'] = "success";

        return $rs;
    }//TODO	    
	/**
     * 评论活动
     * @desc 评论活动
     * @return int code 操作码，0表示成功，1表示失败
     * @return string msg 提示信息
	 * ,,
     */
    public function addEventRe() {//TODO
        $rs = array('code' => 0, 'msg' => '');
		$re_orderId='';
		$input = array('re_postId' => $this->eventId, 're_createUserId' => $this->userId, 're_modifyUserId' => $this->userId,'re_detail' => $this->userComments);
		
        $domain = new Domain_Event();
        $result = $domain->addEventRe($input);

        if ($result!='success') {
            DI()->logger->debug('fail to comment.');

            $rs['code'] = 1;
//            $rs['msg'] = T('fail to comment.'.$result);
			$rs['msg'] = 'fail to comment.'.$result;
            return $rs;
        }

        $rs['msg'] = "success";

        return $rs;
    }
    /**
     * 批量获取用户基本信息
     * @desc 用于获取多个用户基本信息
     * @return int code 操作码，0表示成功
     * @return array list 用户列表
     * @return int list[].id 用户ID
     * @return string list[].name 用户名字
     * @return string list[].note 用户来源
     * @return string msg 提示信息
     */
    public function getMultiBaseInfo() {
        $rs = array('code' => 0, 'msg' => '', 'list' => array());

        $domain = new Domain_User();
        foreach ($this->userIds as $userId) {
            $rs['list'][] = $domain->getEventInfo($userId);
        }

        return $rs;
    }
}
