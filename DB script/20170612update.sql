ALTER TABLE event_hiker
ADD user_avatar_url varchar(200) NULL DEFAULT null COMMENT '用户头像' ,
ADD user_start_event_count INT(10) NULL DEFAULT '0' COMMENT '发起活动次数统计' ,
ADD user_join_event_count INT(10) NULL DEFAULT '0' COMMENT '参加活动次数统计' ,
ADD user_fly_event_count INT(10) NULL DEFAULT '0' COMMENT '飞机活动次数统计' ;

ALTER TABLE event_info
  ADD event_gather_localtion varchar(200) NULL DEFAULT null COMMENT '集合地点' ,
  ADD event_gather_time varchar(200) NULL DEFAULT null COMMENT '集合时间' ,
  ADD event_place_of_departure varchar(200) NULL DEFAULT null COMMENT '出发地' ,
  ADD event_destination varchar(200) NULL DEFAULT null COMMENT '目的地'  ;