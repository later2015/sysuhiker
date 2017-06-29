<?php

class Domain_BBS {

    //获取文章详情
    //把各种用户的ID编号转换为用户的具体名字之类的
	public function getBBSInfo($postId) {
		$rs = array();

		$postId = intval($postId);
		if ($postId <= 0) {
			return $rs;
		}

		// 版本1：简单的获取
		$model = new Model_BBS();
		$rs = $model -> getByBBSId($postId);

		//把userID转换成昵称
		$modelUser = new Model_User();
		$u = $modelUser -> getByUserId($rs['post_createUserId']);
		$rs['post_createUserNick']=$u['user_nick'];//增加返回用户昵称信息
		$rs['post_createUserEmail']=$u['user_email'];
		$rs['post_createUserAvatarUrl']=$u['user_avatar_url'];
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
			$pagesize = 20;
		}
		$page = intval($page);
		if ($page <= 0) {
			$page = 1;
		}
		// 版本1：简单的获取
		$model = new Model_BBS();
		$rs = $model -> getBBSList($pagesize * ($page - 1), $pagesize);
		//第一个参数是偏移量

        //把userID转换成昵称
        $model2 = new Model_User();
        foreach ($rs as $key=>$item) {
            $u = $model2 -> getByUserId($item['post_createUserId']);
            //$item['re_createUserId']=$u['user_nick'];
            $rs[$key]['post_createUserNick']=$u['user_nick'];//增加返回用户昵称信息
			$rs[$key]['post_createUserEmail']=$u['user_email'];
			$rs[$key]['post_createUserAvatarUrl']=$u['user_avatar_url'];
        }
		return $rs;
	}

	//获取文章评论列表
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
		$rs = $model -> getBBSReList($postid, $pagesize * ($page - 1), $pagesize);
		$model2 = new Model_User();
		foreach ($rs as $key=>$item) {
			$u = $model2 -> getByUserId($item['re_createUserId']);
			//$item['re_createUserId']=$u['user_nick'];
			$rs[$key]['re_createUserNick']=$u['user_nick'];
			$rs[$key]['re_createUserEmail']=$u['user_email'];
			$rs[$key]['re_createUserAvatarUrl']=$u['user_avatar_url'];
		}

		return $rs;
	}

	//评论文章
	public function addPostRe($input) {
		$result = null;
		$model_bbsre = new Model_BBSre();
		$re_order_id = $model_bbsre -> getPostReOrderId($input['re_postId']);

		$input['re_orderId'] = $re_order_id['re_orderId'] + 1;
		$input['re_createTime'] = date('Y-m-d H:i:s', time());
		//大写H是24进制
		$input['re_modifyTime'] = date('Y-m-d H:i:s', time());
		$input['re_permission'] = '公开';
		$input['re_up'] = 0;
		$input['re_down'] = 0;
		$input['re_other'] = '';

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
    //编辑文章评论
    public function editPostRe($input) {
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
	//发表文章
	public function addPost($input) {
		$result = null;
		$model_bbs = new Model_BBS();
		$input['post_createTime']=date("Y-m-d H:i:s", time());
        $input['post_modifyTime']=date("Y-m-d H:i:s", time());
        $input['post_up']=0;
        $input['post_down']=0;
        $input['post_count']=0;
        $input['post_countRe']=0;
        $input['post_other']='';
		$result = $model_bbs -> add($input);

		if (empty($result)) {
			$result = "发表文章失败！";
		} else {
			$result = "success";
		}
		return $result;
	}
	//编辑文章
	public function editPost($input) {
		$result = null;
		$model_bbs = new Model_BBS();
        $input['post_modifyTime']=date("Y-m-d H:i:s", time());
		$result = $model_bbs -> edit($input);

		if (empty($result)) {
			$result = "编辑文章失败！";
		} else {
			$result = "success";
		}
		return $result;
	}
    //删除文章，将删除标志更新为Y
    public function deletePost($input) {
        $result = null;
        $model_bbs = new Model_BBS();
        $input['post_modifyTime']=date("Y-m-d H:i:s", time());
        $input['post_deleteFlag']="Y";
        $result = $model_bbs -> edit($input);

        if (empty($result)) {
            $result = "删除文章失败！";
        } else {
            $result = "success";
        }
        return $result;
    }
}
