<?php

class Model_BBSre extends PhalApi_Model_NotORM {

	public function getEventReList($eventId,$pageflag,$pagesize) {
        return $this->getORM()
            ->select('re_id,re_orderId,re_detail,re_createTime,re_createUserId')
			->where('re_postId = ? and re_other = "event"', $eventId)//re_other 值为event时表示是活动的评论
            ->order('re_id asc ')
			->limit($pageflag,$pagesize)
            ->fetchAll();
    }
    //获取茶馆文章评论列表
    public function getBBSReList($postId,$pageflag,$pagesize) {
        return $this->getORM()
            ->select('re_id,re_postId,re_orderId,re_detail,re_createTime,re_createUserId')
            ->where('re_postId = ? and re_other != "event"', $postId)//re_other 值不为event时表示是茶馆文章的评论
            ->order('re_id asc ')
            ->limit($pageflag,$pagesize)
            ->fetchAll();
    }
    //获取某篇文章的评论ID列表,用以计算总数
    public function getReList($postId) {
        return $this->getORM()
            ->select('re_id')
            ->where('re_postId = ?', $postId)
            ->order('re_id asc ')
            ->fetchAll();
    }
	public function check($input) {
        return $this->getORM()
            ->select('*')
			->where('re_detail =? and re_createUserId =? and re_postId=? ', $input['re_detail'],$input['re_createUserId'],$input['re_postId'])
            ->fetchAll();
    }
	public function getEventReOrderId($eventId) {
		return $this -> getORM() -> select('re_orderId') -> where('re_postId = ? and re_other="event"', $eventId)->order('re_createTime desc')->limit(1) -> fetch();
	}
    public function getPostReOrderId($postId) {
        return $this -> getORM() -> select('re_orderId') -> where('re_postId = ? and re_other="event"', $postId)->order('re_createTime desc')->limit(1) -> fetch();
    }
	public function add($input) {
		$this -> getORM() -> insert($input);
		return $this -> getORM() -> insert_id();
	}
    //编辑文章评论/回复
    public function edit($input) {
        return $this -> getORM() -> where('re_id =?', $input['re_id'])-> update($input);
    }
    protected function getTableName($id) {
        return 'bbs_re';
    }
}
