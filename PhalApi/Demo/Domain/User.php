<?php

class Domain_User {

	public function getBaseInfo($userId) {
		$rs = array();

		$userId = intval($userId);
		if ($userId <= 0) {
			return $rs;
		}

		// 版本1：简单的获取
		$model = new Model_User();
		$rs = $model -> getByUserId($userId);

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

	public function login($email, $password) {
		$rs = array();
		$model = new Model_User();
		$rs = $model -> getExistPassword($email);

		if (empty($rs)) {
			return NULL;
		}

		$existMD5psw = $rs['user_psw'];
		$userid = $rs['user_id'];
		// 版本1：简单的获取

		$inputMD5psw = md5(crypt($password, substr($password, 0, 3)));

		if ($existMD5psw == $inputMD5psw) {
			return $userid;
		} else {
			return NULL;
		}

	}

	public function register($input) {
		$rs = array();
		$model = new Model_User();
		$rs = $model -> getExistPassword($input['user_email']);

		if (!empty($rs)) {
			$rs['error'] = "email already register.";
			return $rs;
		}
		$input['user_psw'] = md5(crypt($input['user_psw'], substr($input['user_psw'], 0, 3)));
		$input['user_createtime']= date("Y-m-d H:i:s");

		$userid = $model -> add($input);
		if (empty($userid)) {
			$rs['error'] = "fail to insert";
		}
		$rs['userid'] = $userid;
		return $rs;
	}

	public function update($input) {
		if (!empty($input['user_psw'])) {
			$input['user_psw'] = md5(crypt($input['user_psw'], substr($input['user_psw'], 0, 3)));
		}else{
			unset($input['user_psw']);
		}

		$model = new Model_User();
		$rs = $model -> updateHiker($input);
		return $rs;
	}

}
