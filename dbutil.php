<?php 
    /**
     * DB class
     */
    class dbutil {
        //通过id获取用户昵称，取不到返回“游客”
        function getNickByUserId($userId)
        {
            $db = new SaeMysql();
            $sql="select user_nick from event_hiker where user_id = ".$userId;
            return $db->getVar($sql)==''?'游客':$db->getVar($sql);
        }
        function getEmailByUserId($userId){
            $db = new SaeMysql();
            $sql="select user_email from event_hiker where user_id = ".$userId;
            return $db->getVar($sql)==''?'errorId':$db->getVar($sql);                            
        }
        function checkCookie($cookieValue){
            $cookies=explode('|', $cookieValue);
            $userId=$cookies[0];
            $localSha1Value=$cookies[1];
            $dbutil = new dbutil();
            $userEmail=$dbutil->getEmailByUserId($userId);
            $sha1Value=sha1($userId.$userEmail.'sysuhiker');
             return $localSha1Value==$sha1Value?$userId:'errorCookie';
        }
        function showNickByuserId($userId)
        {
            $db = new SaeMysql();
            $sql="select user_nick from event_hiker where user_id = ".$userId;
            return $db->getVar($sql);
        }
        function getBbsReCount($postId)
        {
            $db = new SaeMysql();
            $sql="select post_countRe from event_bbs where post_id = ".$postId;
            return $db->getVar($sql)==''?2:$db->getVar($sql);
        } 
        function getEventReCount($eventId)
        {
            $db = new SaeMysql();
            $sql="select count(re_id) from event_bbs_re where re_other='event' and re_postId = ".$eventId;
            return $db->getVar($sql);
        } 
            }
     

?>