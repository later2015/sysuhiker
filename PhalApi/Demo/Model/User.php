<?php

class Model_User extends PhalApi_Model_NotORM {

	public function getByUserId($userId) {
		return $this -> getORM() -> select('*') -> where('user_id = ?', $userId) -> fetch();
	}

	public function getExistPassword($email) {
		return $this -> getORM() -> select('user_psw,user_id') -> where('user_email = ?', $email) -> fetch();
	}

	public function add($input) {
		$this -> getORM() -> insert($input);
		return $this -> getORM() -> insert_id();
	}
	public function updateHiker($input) {
		return $this -> getORM() -> where('user_id =?', $input['user_id'])-> update($input);
	}
	public function getByUserIdWithCache($userId) {
		$key = 'userbaseinfo_' . $userId;
		$rs =  DI() -> cache -> get($key);
		if ($rs === NULL) {
			$rs = $this -> getByUserId($userId);
			DI() -> cache -> set($key, $rs, 600);
		}
		return $rs;
	}

	protected function getTableName($id) {
		return 'hiker';
	}

}
