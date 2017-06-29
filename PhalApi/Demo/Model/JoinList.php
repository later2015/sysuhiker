<?php

class Model_JoinList extends PhalApi_Model_NotORM {

    public function getEventJoinList($eventId) {
        return $this->getORM()
            ->select('event_joinlist_ID,event_joinlist_userid,event_joinlist_usernick,event_joinlist_useremail,event_joinlist_usergender,event_joinlist_userrole,event_joinlist_joindate,event_joinlist_comments,event_joinlist_status')
			->where('event_joinlist_eventid = ?', $eventId)
            ->order('event_joinlist_ID asc')
			//->limit($pageflag,$pagesize)
            ->fetchAll();
    }

    //TODO 该方法有问题
    public function getEventJoinCount($eventId) {
        return $this->getORM()
            ->count('event_joinlist_ID')
            ->where('event_joinlist_eventid = ?', $eventId);
    }

	public function check($input) {
        return $this->getORM()
            ->select('*')
			->where('event_joinlist_eventid =? and event_joinlist_userid =?', $input['event_joinlist_eventid'],$input['event_joinlist_userid'])
            ->fetchAll();
    }
	public function add($input) {
		$this -> getORM() -> insert($input);
		return $this -> getORM() -> insert_id();
	}
	public function quit($input) {
		return $this -> getORM() -> where('event_joinlist_eventid =? and event_joinlist_userid =?', $input['event_joinlist_eventid'],$input['event_joinlist_userid'])-> update($input);
	}
    public function updateJoinStatus($input) {
        return $this -> getORM() -> where('event_joinlist_eventid =? and event_joinlist_userid =?', $input['event_joinlist_eventid'],$input['event_joinlist_userid'])-> update($input);
    }
    protected function getTableName($id) {
        return 'joinlist';//pre——fix defines in dbs.php
    }
}
