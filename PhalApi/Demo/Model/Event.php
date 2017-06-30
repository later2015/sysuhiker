<?php

class Model_Event extends PhalApi_Model_NotORM {

    public function getByEventId($eventId) {
        return $this->getORM()
            ->select('*')
            ->where('event_id = ?', $eventId)
            ->fetch();
    }
    //TODO 改成关联查询？
    //参考 https://www.phalapi.net/wikis/1-15.html
    //https://www.phalapi.net/wikis/1-20.html
    public function getEventList($pageflag,$pagesize) {
        return $this->getORM()
            ->select('event_id,event_name,event_type,event_starttime,event_endtime,event_join_endtime,event_createUserId,event_maxhiker,event_comments')
            ->order('event_id desc')
			->limit($pageflag,$pagesize)
            ->fetchAll();
    }
    //查询活动总数
    public function getEventCount() {
        return $this->getORM()
            ->count('*');
    }
    public function getByEventIdWithCache($eventId) {
        $key = 'userbaseinfo_' . $eventId;
        $rs = DI()->cache->get($key);
        if ($rs === NULL) {
            $rs = $this->getByEventId($eventId);
            DI()->cache->set($key, $rs, 600);
        }
        return $rs;
    }
    //添加活动
    //返回ID
    public function add($input) {
        $this -> getORM() -> insert($input);
        return $this -> getORM() -> insert_id();
    }
    //编辑活动
    public function edit($input) {
        return $this -> getORM() -> where('event_id =?', $input['event_id'])-> update($input);
    }


    protected function getTableName($id) {
        return 'info';//pre——fix defines in dbs.php
    }
}
