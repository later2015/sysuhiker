<?php

class Model_Event extends PhalApi_Model_NotORM {

    public function getByEventId($eventId) {
        return $this->getORM()
            ->select('*')
            ->where('event_id = ?', $eventId)
            ->fetch();
    }
    public function getEventList($pageflag,$pagesize) {
        return $this->getORM()
            ->select('event_id,event_name,event_type,event_starttime,event_join_endtime,event_comments')
            ->order('event_id desc')
			->limit($pageflag,$pagesize)
            ->fetchAll();
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

    protected function getTableName($id) {
        return 'info';//pre——fix defines in dbs.php
    }
}
