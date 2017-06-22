<?php

class Model_BBS extends PhalApi_Model_NotORM {

	public function getBBSList($pageflag,$pagesize) {
        return $this->getORM()
            ->select('post_id,post_title,post_type,post_keywords,post_createTime,post_createUserId,post_modifyTime,post_modifyUserId')
            ->order('post_id desc ')
			->limit($pageflag,$pagesize)
            ->fetchAll();
    }
    public function getByBBSId($postId) {
        return $this->getORM()
            ->select('*')
            ->where('post_id = ?', $postId)
            ->fetch();
    }
//添加文章
	public function add($input) {
		$this -> getORM() -> insert($input);
		return $this -> getORM() -> insert_id();
	}
    //编辑文章
    public function edit($input) {
        return $this -> getORM() -> where('post_id =?', $input['post_id'])-> update($input);
    }
    protected function getTableName($id) {
        return 'bbs';
    }
}
