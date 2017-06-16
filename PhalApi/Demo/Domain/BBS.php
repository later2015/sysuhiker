<?php

class Domain_BBS {

    //获取文章详情
    //TODO　此处应该把各种用户的ID编号转换为用户的具体名字之类的
	public function getBBSInfo($postId) {
		$rs = array();

		$postId = intval($postId);
		if ($postId <= 0) {
			return $rs;
		}

		// 版本1：简单的获取
		$model = new Model_Event();
		$rs = $model -> getByEventId($postId);

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

	public function getBBSList($page, $pagesize) {
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
		$model = new Model_BBS();
		$rs = $model -> getEventList($pagesize * ($page - 1), $pagesize);
		//第一个参数是偏移量

		return $rs;
	}

	//获取文章评论列表 TODO
	public function getBBSReList($postid, $page, $pagesize) {
		$rs = array();

		$postid = intval($postid);
		if ($postid <= 0) {
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
		$rs = $model -> getEventReList($postid, $pagesize * ($page - 1), $pagesize);
		$model2 = new Model_User();
		foreach ($rs as $key=>$item) {
			$u = $model2 -> getByUserId($item['re_createUserId']);
			//$item['re_createUserId']=$u['user_nick'];
			$rs[$key]['re_createUserId']=$u['user_nick'];
		}

		return $rs;
	}

	//评论文章 TODO
	public function addBBSRe($input) {
		$result = null;
		$model_bbsre = new Model_BBSre();
		$re_order_id = $model_bbsre -> getEventReOrderId($input['re_postId']);

		$input['re_postId'] = $input['re_postId'];
		$input['re_orderId'] = $re_order_id['re_orderId'] + 1;
		$input['re_detail'] = $input['re_detail'];
		$input['re_createTime'] = date('y-m-d H:i:s', time());
		//大写H是24进制
		$input['re_createUserId'] = $input['re_createUserId'];
		$input['re_modifyTime'] = date('y-m-d H:i:s', time());
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
	//发表文章
	public function addBBS($input) {
		$result = null;
		$model_bbs = new Model_BBS();
		$input['post_createTime']=date("Y-m-d H:i:s");
		$result = $model_bbs -> add($input);

		if (empty($result)) {
			$result = "发表文章失败！";
		} else {
			$result = "success";
		}
		return $result;
	}
	//编辑文章
	public function editBBS($input) {
		$result = null;
		$model_bbs = new Model_BBS();
		$result = $model_bbs -> edit($input);

		if (empty($result)) {
			$result = "编辑文章失败！";
		} else {
			$result = "success";
		}
		return $result;
	}
}
