<?php

class Domain_Event {

	public function getEventInfo($eventId) {
		$rs = array();

		$eventId = intval($eventId);
		if ($eventId <= 0) {
			return $rs;
		}

		// 版本1：简单的获取
		$model = new Model_Event();
		$rs = $model -> getByEventId($eventId);

        //给返回结果加上领队的详细信息
        $modelUser = new Model_User();
        $modelJoinList = new Model_JoinList();
        $u = $modelUser -> getByUserId($rs['event_createUserId']);
        $rs['event_createUserNick']=$u['user_nick'];
        $rs['event_createUserEmail']=$u['user_email'];
        $rs['event_createUserAvatarUrl']=$u['user_avatar_url'];

        //$rs2 = $modelJoinList -> getEventJoinList($eventId);
        //$rs['event_memberNum']=count($rs2);//已报名人数

        $num = $modelJoinList->getEventJoinCount($eventId);
        $rs['event_memberNum']=$num;//已报名人数
		// 版本2：使用单点缓存/多级缓存 (应该移至Model层中)
		/**
		 $model = new Model_User();
		 $rs = $model->getByUserIdWithCache($userId);
		 */

		// 版本3：缓存 + 代理
		/**
		 $query = new PhalApi_ModelQuery();
		 $query->id = $userId;
		 $modelProxy = new ModelProxy_UserBaseInfo();
		 $rs = $modelProxy->getData($query);
		 */

		return $rs;
	}

	//获取活动列表
	public function getEventList($page, $pagesize) {
		$rs = array();

		$pagesize = intval($pagesize);
		if ($pagesize <= 0) {
			$pagesize = 10;
		}
		$page = intval($page);
		if ($page <= 0) {
			$page = 1;
		}
		// 版本1：简单的获取
		$model = new Model_Event();
		$rs = $model -> getEventList($pagesize * ($page - 1), $pagesize);
		//第一个参数是偏移量

        $modelUser = new Model_User();
        $modelJoinList = new Model_JoinList();
        foreach ($rs as $key=>$item) {
            //给返回结果加上领队的详细信息
            $u = $modelUser -> getByUserId($item['event_createUserId']);
            $rs[$key]['event_createUserNick']=$u['user_nick'];
            $rs[$key]['event_createUserEmail']=$u['user_email'];
            $rs[$key]['event_createUserAvatarUrl']=$u['user_avatar_url'];
            //$rs2 = $modelJoinList -> getEventJoinList($item['event_id']);
            //$rs[$key]['event_memberNum']=count($rs2);//已报名人数

            $num = $modelJoinList->getEventJoinCount($item['event_id']);//该方法暂时不可用
            $rs[$key]['event_memberNum']=$num;//已报名人数
        }
		return $rs;
	}
    //查询活动总数
    public function getEventCount() {
        // 版本1：简单的获取
        $model = new Model_Event();
        $rs = $model -> getEventCount();
        return $rs;
    }
	//获取活动报名名单
	public function getEventJoinList($eventid) {
		$rs = array();

		$eventid = intval($eventid);
		if ($eventid <= 0) {
			return $rs;
		}
		// 版本1：简单的获取
		$model = new Model_JoinList();
		$rs = $model -> getEventJoinList($eventid);
		$modelUser = new Model_User();
		foreach ($rs as $key=>$item) {
			//给返回结果加上队员的详细信息
			$u = $modelUser -> getByUserId($item['event_joinlist_userid']);
			$rs[$key]['event_joinlist_userAvatarUrl']=$u['user_avatar_url'];
		}
		return $rs;
	}

	//获取活动评论列表
	public function getEventReList($eventid, $page, $pagesize) {
		$rs = array();

		$eventid = intval($eventid);
		if ($eventid <= 0) {
			return $rs;
		}
		$pagesize = intval($pagesize);
		if ($pagesize <= 0) {
			$pagesize = 10;
		}
		$page = intval($page);
		if ($page <= 0) {
			$page = 1;
		}
		// 版本1：简单的获取
		$model = new Model_BBSre();
		$rs = $model -> getEventReList($eventid, $pagesize * ($page - 1), $pagesize);
		$model2 = new Model_User();
		foreach ($rs as $key=>$item) {
			$u = $model2 -> getByUserId($item['re_createUserId']);
			$rs[$key]['re_createUserNick']=$u['user_nick'];
			$rs[$key]['re_createUserEmail']=$u['user_email'];
			$rs[$key]['re_createUserAvatarUrl']=$u['user_avatar_url'];
		}

		return $rs;
	}
    //获取活动评论总数
    public function getEventReCount($eventid) {
        $rs = array();
        $eventid = intval($eventid);
        if ($eventid <= 0) {
            return $rs;
        }
        // 版本1：简单的获取
        $model = new Model_BBSre();
        $rs = $model -> getReList($eventid);
        return count($rs);
    }
	public function joinEvent($input) {
		$result = null;
		$model = new Model_User();
		$model_event = new Model_Event();
		$eventinfo = $model_event -> getByEventId($input['event_joinlist_eventid']);
		$userinfo = $model -> getByUserId($input['event_joinlist_userid']);
		$input['event_joinlist_username'] = $userinfo['user_name'];
		$input['event_joinlist_usernick'] = $userinfo['user_nick'];
		$input['event_joinlist_eventname'] = $eventinfo['event_name'];
		if ($input['event_joinlist_userrole'] == null)
			$input['event_joinlist_userrole'] = $userinfo['user_interest'];
		$input['event_joinlist_userpsw'] = 'NONE';
		$input['event_joinlist_useremail'] = $userinfo['user_email'];
		if ($input['event_joinlist_qq'] == null)
			$input['event_joinlist_qq'] = $userinfo['user_qq'];
		$input['event_joinlist_weiboName'] = $userinfo['user_weiboName'];
		$input['event_joinlist_weiboLink'] = $userinfo['user_weiboLink'];
		if ($input['event_joinlist_useraddress'] == null)
			$input['event_joinlist_useraddress'] = $userinfo['user_address'];
		if ($input['event_joinlist_insurance'] == null)
			$input['event_joinlist_insurance'] = '';
		$input['event_joinlist_declare'] = 'Y';
		$input['event_joinlist_assessment'] = '60';

		$input['event_joinlist_joindate'] = date('Y-m-d H:i:s', time());
		//大写H是24进制
		if ($input['event_joinlist_usercamp'] == null)
			$input['event_joinlist_usercamp'] = '0';
		if ($input['event_joinlist_usercamppad'] == null)
			$input['event_joinlist_usercamppad'] = '0';
		if ($input['event_joinlist_usersleepingbag'] == null)
			$input['event_joinlist_usersleepingbag'] = 'N';
		if ($input['event_joinlist_userinterphone'] == null)
			$input['event_joinlist_userinterphone'] = 'N';
		if ($input['event_joinlist_userbag'] == null)
			$input['event_joinlist_userbag'] = '0';
		if ($input['event_joinlist_userBurner'] == null)
			$input['event_joinlist_userBurner'] = 'N';
		if ($input['event_joinlist_userpot'] == null)
			$input['event_joinlist_userpot'] = '0';
		if ($input['event_joinlist_comments'] == null)
			$input['event_joinlist_comments'] = '无';
		if (empty($userinfo)) {
			$result = "wrong user id";
			return $result;
		}
		$model_joinlist = new Model_JoinList();
		$check = $model_joinlist -> check($input);
		if (empty($check)) {
			$result = $model_joinlist -> add($input);
		} else {
			return $result = "already join";
		}

		if (empty($result)) {
			$result = "fail to insert";
		} else {
			$result = "success";
		}
		return $result;
	}

	//退出活动
	public function quit($input) {
		$result = "";
		$model_joinlist = new Model_JoinList();
		$input['event_joinlist_status'] = '已退出';
		$input['event_joinlist_comments'] = $input['event_joinlist_comments'] . '(如需重新报名请联系活动发起人修改报名状态)';
		$result = $model_joinlist -> quit($input);
		if (empty($result)) {
			$rs['error'] = "fail to quit";
		} else {
			$result = "success";
		}
		return $result;
	}
    //审核活动报名队员状态
    public function updateJoinStatus($input) {
        $result = "";
        $model_joinlist = new Model_JoinList();
        $result = $model_joinlist -> updateJoinStatus($input);
        if (empty($result)) {
            $rs['error'] = "fail to updateJoinStatus";
        } else {
            $result = "success";
        }
        return $result;
    }
	//评论活动
	public function addEventRe($input) {
		$result = null;
		$model_bbsre = new Model_BBSre();
		$re_order_id = $model_bbsre -> getEventReOrderId($input['re_postId']);

		$input['re_postId'] = $input['re_postId'];
		$input['re_orderId'] = $re_order_id['re_orderId'] + 1;
		$input['re_detail'] = $input['re_detail'];
		$input['re_createTime'] = date('Y-m-d H:i:s', time());
		//大写H是24进制
		$input['re_createUserId'] = $input['re_createUserId'];
		$input['re_modifyTime'] = date('Y-m-d H:i:s', time());
		$input['re_modifyUserId'] = $input['re_modifyUserId'];
		$input['re_permission'] = '公开';
		$input['re_up'] = 0;
		$input['re_down'] = 0;
		$input['re_other'] = 'event';

		$check = $model_bbsre -> check($input);
		if (empty($check)) {
			$result = $model_bbsre -> add($input);
		} else {
			return $result = "don't post the same comment.";
		}

		if (empty($result)) {
			$result = "fail to insert";
		} else {
			$result = "success";
		}
		return $result;
	}
    //编辑活动评论内容
    public function editEventRe($input) {
        $result = null;
        $model_bbsRe = new Model_BBSre();
        $input['re_modifyTime']=date("Y-m-d H:i:s", time());
        $result = $model_bbsRe -> edit($input);

        if (empty($result)) {
            $result = "编辑文章评论失败！";
        } else {
            $result = "success";
        }
        return $result;
    }
	//发起活动
	public function addEvent($input) {
		$result = null;
		$model_event = new Model_Event();
		$input['event_createtime']=date("Y-m-d H:i:s");
		$result = $model_event -> add($input);

		if (empty($result)) {
			$result = "发起活动失败！";
		} else {
			$result = "success";
		}
		return $result;
	}
	//编辑活动
	public function editEvent($input) {
		$result = null;
		$model_event = new Model_Event();
		$result = $model_event -> edit($input);

		if (empty($result)) {
			$result = "编辑活动失败！";
		} else {
			$result = "success";
		}
		return $result;
	}
}
