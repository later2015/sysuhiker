<?php

class Api_Event extends PhalApi_Api
{

    public function getRules()
    {
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
            'updateJoinStatus' => array(
                'eventId' => array('name' => 'event_joinlist_eventid', 'type' => 'int', 'min' => 1, 'require' => true, 'desc' => '活动ID'),
                'userId' => array('name' => 'event_joinlist_userid', 'type' => 'int', 'min' => 1, 'require' => true, 'desc' => '用户id'),
                'status' => array('name' => 'event_joinlist_status', 'type' => 'string', 'min' => 1, 'require' => true, 'desc' => '报名状态，活动成员/活动协作/已退出'),
            ),//审核报名队员的状态
            'addEventRe' => array(
                'eventId' => array('name' => 'eventId', 'type' => 'int', 'min' => 1, 'require' => true, 'desc' => '活动ID'),
                'userId' => array('name' => 'userId', 'type' => 'int', 'min' => 1, 'require' => true, 'desc' => '用户id'),
                'userComments' => array('name' => 'userComments', 'type' => 'string', 'min' => 1, 'require' => true, 'desc' => '活动评论内容'),
            ),//评论活动
            'editEventRe' => array(
                'reId' => array('name' => 're_id', 'type' => 'string', 'min' => 1, 'require' => true, 'desc' => '活动评论的ID'),
                'userComments' => array('name' => 'userComments', 'type' => 'string', 'min' => 1, 'require' => true, 'desc' => '评论内容'),
                'userId' => array('name' => 'user_id', 'type' => 'string', 'min' => 1, 'require' => true, 'desc' => '当前登陆用户ID'),
            ),//编辑活动评论内容
            'addEvent' => array(
                'eventName' => array('name' => 'event_name', 'type' => 'string', 'min' => 1, 'require' => true, 'desc' => '活动名称'),
                'eventType' => array('name' => 'event_type', 'type' => 'string', 'min' => 1, 'require' => true, 'desc' => '活动类型'),
                'eventDetail' => array('name' => 'event_detail', 'type' => 'string', 'min' => 1, 'require' => true, 'desc' => '活动详情'),
                'eventStarttime' => array('name' => 'event_starttime', 'type' => 'string', 'min' => 1, 'require' => true, 'desc' => '活动开始时间'),
                'eventEndtime' => array('name' => 'event_endtime', 'type' => 'string', 'min' => 1, 'require' => true, 'desc' => '活动结束时间'),
                'eventJoinStarttime' => array('name' => 'event_join_starttime', 'type' => 'string', 'min' => 1, 'require' => true, 'desc' => '活动报名开始时间'),
                'eventJoinEndtime' => array('name' => 'event_join_endtime', 'type' => 'string', 'min' => 1, 'require' => true, 'desc' => '活动报名结束时间'),
                'eventComments' => array('name' => 'event_comments', 'type' => 'string', 'min' => 0, 'require' => false, 'desc' => '活动备注'),
                'eventCreateUserId' => array('name' => 'event_createUserId', 'type' => 'string', 'min' => 1, 'require' => true, 'desc' => '活动创建者'),
                'eventMaxhiker' => array('name' => 'event_maxhiker', 'type' => 'string', 'min' => 0, 'require' => false, 'desc' => '活动最大人数'),
                'eventGatherLocation' => array('name' => 'event_gather_location', 'type' => 'string', 'min' => 0, 'require' => false, 'desc' => '集合地点'),
                'eventGatherTime' => array('name' => 'event_gather_time', 'type' => 'string', 'min' => 0, 'require' => false, 'desc' => '集合时间'),
                'eventPlaceOfDeparture' => array('name' => 'event_place_of_departure', 'type' => 'string', 'min' => 0, 'require' => false, 'desc' => '出发地'),
                'eventDestination' => array('name' => 'event_destination', 'type' => 'string', 'min' => 0, 'require' => false, 'desc' => '目的地'),
            ),//发起活动
            'editEvent' => array(
                'eventId' => array('name' => 'event_id', 'type' => 'int', 'min' => 1, 'require' => true, 'desc' => '活动ID'),
                'userId' => array('name' => 'userId', 'type' => 'int', 'min' => 1, 'require' => true, 'desc' => '用户id'),
                'eventName' => array('name' => 'event_name', 'type' => 'string', 'min' => 1, 'require' => true, 'desc' => '活动名称'),
                'eventType' => array('name' => 'event_type', 'type' => 'string', 'min' => 1, 'require' => true, 'desc' => '活动类型'),
                'eventDetail' => array('name' => 'event_detail', 'type' => 'string', 'min' => 1, 'require' => true, 'desc' => '活动详情'),
                'eventStarttime' => array('name' => 'event_starttime', 'type' => 'string', 'min' => 1, 'require' => true, 'desc' => '活动开始时间'),
                'eventEndtime' => array('name' => 'event_endtime', 'type' => 'string', 'min' => 1, 'require' => true, 'desc' => '活动结束时间'),
                'eventJoinStarttime' => array('name' => 'event_join_starttime', 'type' => 'string', 'min' => 1, 'require' => true, 'desc' => '活动报名开始时间'),
                'eventJoinEndtime' => array('name' => 'event_join_endtime', 'type' => 'string', 'min' => 1, 'require' => true, 'desc' => '活动报名结束时间'),
                'eventComments' => array('name' => 'event_comments', 'type' => 'string', 'min' => 0, 'require' => false, 'desc' => '活动备注'),
                'eventCreateUserId' => array('name' => 'event_createUserId', 'type' => 'string', 'min' => 1, 'require' => true, 'desc' => '活动创建者'),
                'eventMaxhiker' => array('name' => 'event_maxhiker', 'type' => 'string', 'min' => 0, 'require' => false, 'desc' => '活动最大人数'),
                'eventGatherLocation' => array('name' => 'event_gather_location', 'type' => 'string', 'min' => 1, 'require' => true, 'desc' => '集合地点'),
                'eventGatherTime' => array('name' => 'event_gather_time', 'type' => 'string', 'min' => 1, 'require' => true, 'desc' => '集合时间'),
                'eventPlaceOfDeparture' => array('name' => 'event_place_of_departure', 'type' => 'string', 'min' => 1, 'require' => true, 'desc' => '出发地'),
                'eventDestination' => array('name' => 'event_destination', 'type' => 'string', 'min' => 1, 'require' => true, 'desc' => '目的地'),
            ),//修改活动
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
     * @return string info.event_createUserId 活动创建者/活动领队的ID
     * @return string info.event_createUserNick 活动领队的昵称
     * @return string info.event_createUserEmail 活动领队的邮件
     * @return string info.event_createUserAvatarUrl  活动领队的头像
     * @return string info.event_maxhiker 活动最大人数限制
     * @return string info.event_memberNum 活动已报名人数
     * @return string msg 提示信息
     */
    public function getEventInfo()
    {
        DI()->logger->info('Event.getEventInfo api is call.');
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
     * @return string list[].event_endtime 活动结束时间
     * @return string list[].event_join_endtime 活动报名截止时间
     * @return string list[].event_createUserId 活动领队的id
     * @return string list[].event_createUserNick 活动领队的昵称
     * @return string list[].event_createUserEmail 活动领队的邮件
     * @return string list[].event_createUserAvatarUrl  活动领队的头像
     * @return string list[].event_maxhiker 活动最大人数限制
     * @return string list[].event_memberNum 活动已报名人数
     * @return string list[].event_comments 活动备注
     * @return string msg 提示信息
     * ,,
     */
    public function getEventList()
    {
        DI()->logger->info('Event.getEventList api is call.');
        $rs = array('code' => 0, 'msg' => '', 'list' => array());

        $domain = new Domain_Event();
        $list = $domain->getEventList($this->page, $this->pagesize);

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
    public function getEventJoinList()
    {
        DI()->logger->info('Event.getEventJoinList api is call.');
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
     * @return array list 活动评论列表
     * @return int list[].re_id 活动评论的id
     * @return int list[].re_postId 活动的id或者文章的id
     * @return string list[].re_orderId 评论的排序id
     * @return string list[].re_detail 评论内容
     * @return string list[].re_createTime 评论时间
     * @return string list[].re_createUserId 评论作者id
     * @return string list[].re_createUserNick 评论作者昵称
     * @return string msg 提示信息
     * ,,
     */
    public function getEventReList()
    {
        DI()->logger->info('Event.getEventReList api is call.');
        $rs = array('code' => 0, 'msg' => '', 'list' => array());

        $domain = new Domain_Event();
        $list = $domain->getEventReList($this->eventId, $this->page, $this->pagesize);

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
    public function joinEvent()
    {
        $rs = array('code' => 0, 'msg' => '');
        $input = array('event_joinlist_eventid' => $this->eventId, 'event_joinlist_userid' => $this->userId, 'event_joinlist_userphone' => $this->userPhone, 'event_joinlist_qq' => $this->qq,
            'event_joinlist_userurgentname' => $this->userUrgentName, 'event_joinlist_userurgentphone' => $this->userUrgentPhone, 'event_joinlist_comments' => $this->userComments, 'event_joinlist_useraddress' => $this->useraddress,
            'event_joinlist_insurance' => $this->insurance, 'event_joinlist_usercamp' => $this->usercamp, 'event_joinlist_usercamppad' => $this->usercamppad,
            'event_joinlist_usersleepingbag' => $this->usersleepingbag, 'event_joinlist_userinterphone' => $this->userinterphone, 'event_joinlist_userbag' => $this->userbag,
            'event_joinlist_userBurner' => $this->userBurner, 'event_joinlist_userpot' => $this->userpot, 'event_joinlist_userrole' => $this->userrole);
        DI()->logger->info('Event.joinEvent api is call.',$input);

        $domain = new Domain_Event();
        $result = $domain->joinEvent($input);

        if ($result != 'success') {
            DI()->logger->debug('fail to join.');

            $rs['code'] = 1;
            $rs['msg'] = T('fail to join.' . $result);
            return $rs;
        }

        $rs['msg'] = "success";

        return $rs;
    }

    /**
     * 退出活动
     * @desc 退出活动
     * @return int code 操作码，0表示成功，1表示操作失败
     * @return string msg 提示信息
     * ,,
     */
    public function quit()
    {
        $rs = array('code' => 0, 'msg' => '');
        $input = array('event_joinlist_eventid' => $this->eventId, 'event_joinlist_userid' => $this->userId, 'event_joinlist_comments' => $this->userComments);
        DI()->logger->info('Event.quit api is call.',$input);
        $domain = new Domain_Event();
        $result = $domain->quit($input);

        if ($result != 'success') {
            DI()->logger->info('fail to quit.');

            $rs['code'] = 1;
            $rs['msg'] = T('fail to quit.');
            return $rs;
        }
        $rs['msg'] = "success";
        return $rs;
    }
    /**
     * 审核活动报名状态
     * @desc 领导审核活动成员的报名状态，通过 or 不通过
     * @return int code 操作码，0表示成功，1表示操作失败
     * @return string msg 提示信息
     * ,,
     */
    public function updateJoinStatus()
    {
        $rs = array('code' => 0, 'msg' => '');
        $input = array('event_joinlist_eventid' => $this->eventId, 'event_joinlist_userid' => $this->userId, 'event_joinlist_status' => $this->status);
        DI()->logger->info('Event.updateJoinStatus api is call.',$input);
        $domain = new Domain_Event();
        $result = $domain->updateJoinStatus($input);

        if ($result != 'success') {
            DI()->logger->info('fail to updateJoinStatus.');

            $rs['code'] = 1;
            $rs['msg'] = T('fail to updateJoinStatus.');
            return $rs;
        }
        //TODO 发Email通知用户审核结果
        $rs['msg'] = "success";
        return $rs;
    }
    /**
     * 评论活动
     * @desc 评论活动
     * @return int code 操作码，0表示成功，1表示失败
     * @return string msg 提示信息
     * ,,
     */
    public function addEventRe()
    {
        $rs = array('code' => 0, 'msg' => '');
        $input = array('re_postId' => $this->eventId, 're_createUserId' => $this->userId, 're_modifyUserId' => $this->userId, 're_detail' => $this->userComments);
        DI()->logger->info('Event.addEventRe api is call.',$input);

        $domain = new Domain_Event();
        $result = $domain->addEventRe($input);

        if ($result != 'success') {
            DI()->logger->debug('fail to comment.');

            $rs['code'] = 1;
            $rs['msg'] = 'fail to comment.' . $result;
            return $rs;
        }

        $rs['msg'] = "success";

        return $rs;
    }
    /**
     * 编辑活动评论/回复内容
     * @desc 编辑活动评论/回复内容
     * @return int code 操作码，0表示成功，1表示失败
     * @return string msg 提示信息
     * ,,
     */
    public function editEventRe()
    {
        $rs = array('code' => 0, 'msg' => '');
        $input = array('re_id' => $this->reId,
            're_modifyUserId' => $this->userId,
            're_detail' => $this->userComments);
        DI()->logger->info('Event.editEventRe api is call.',$input);

        $domain = new Domain_Event();
        $result = $domain->editEventRe($input);

        if ($result != 'success') {
            DI()->logger->debug('fail to edit comment.');
            $rs['code'] = 1;
            $rs['msg'] = 'fail to edit comment.' . $result;
            return $rs;
        }
        $rs['msg'] = "success";
        return $rs;
    }
    /**
     * 发起活动
     * @desc 发起活动
     * @return int code 操作码，0表示成功，1表示失败
     * @return string msg 提示信息
     * ,,
     */
    public function addEvent()
    {
        $rs = array('code' => 0, 'msg' => '');
        //发起活动的处理逻辑
        $input = array('event_name' => $this->eventName,
            'event_type' => $this->eventType,
            'event_detail' => $this->eventDetail,
            'event_starttime' => $this->eventStarttime,
            'event_endtime' => $this->eventEndtime,
            'event_join_starttime' => $this->eventJoinStarttime,
            'event_join_endtime' => $this->eventJoinEndtime,
            'event_comments' => $this->eventComments,
            'event_createUserId' => $this->eventCreateUserId,
            'event_maxhiker' => $this->eventMaxhiker,
            'event_gather_location' => $this->eventGatherLocation,
            'event_gather_time' => $this->eventGatherTime,
            'event_place_of_departure' => $this->eventPlaceOfDeparture,
            'event_destination' => $this->eventDestination);
        DI()->logger->info('Event.addEvent api is call.',$input);

        $domain = new Domain_Event();
        $result = $domain->addEvent($input);

        if ($result != 'success') {
            DI()->logger->debug('fail to add event.');

            $rs['code'] = 1;
            $rs['msg'] = 'fail to add event.' . $result;
            return $rs;
        }

        $rs['msg'] = "success";

        return $rs;
    }

    /**
     * 修改活动
     * @desc 修改活动
     * @return int code 操作码，0表示成功，1表示失败
     * @return string msg 提示信息
     * ,,
     */
    public function editEvent()
    {
        $rs = array('code' => 0, 'msg' => '');
        //修改活动信息的处理逻辑
        $input = array('eventId' => $this->eventId,
            'event_name' => $this->eventName,
            'event_type' => $this->eventType,
            'event_detail' => $this->eventDetail,
            'event_starttime' => $this->eventStarttime,
            'event_endtime' => $this->eventEndtime,
            'event_join_starttime' => $this->eventJoinStarttime,
            'event_join_endtime' => $this->eventJoinEndtime,
            'event_comments' => $this->eventComments,
            'event_createUserId' => $this->eventCreateUserId,
            'event_maxhiker' => $this->eventMaxhiker,
            'event_gather_location' => $this->eventGatherLocation,
            'event_gather_time' => $this->eventGatherTime,
            'event_place_of_departure' => $this->eventPlaceOfDeparture,
            'event_destination' => $this->eventDestination);
        DI()->logger->info('Event.editEvent api is call.',$input);

        $domain = new Domain_Event();
        $result = $domain->editEvent($input);

        if ($result != 'success') {
            DI()->logger->debug('fail to edit event.');

            $rs['code'] = 1;
            $rs['msg'] = 'fail to edit event.' . $result;
            return $rs;
        }

        $rs['msg'] = "success";

        return $rs;
    }
}
