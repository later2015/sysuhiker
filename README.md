# sysuhiker
逸仙徒步

## 接口说明
全部接口说明见地址
http://sysuhiker.cc/PhalApi/Public/demo/listAllApis.php

活动列表
http://sysuhiker.cc/PhalApi/Public/?service=Event.GetEventList

>获取用户基础信息
http://sysuhiker.cc/PhalApi/Public/?service=User.GetBaseInfo&user_id=1
service的值为接口名称。之后&拼接起来的为参数名，可以GET方法在URL传参，也可以POST的方式传参。
GET方法获取，user_id=1是参数，表示获取user_id为1的用户信息。返回的是JSON格式的用户信息。如下：
{"ret":200,"data":{"code":0,"msg":"","info":{"user_id":"1","user_name":"\u674e\u542f\u6881","user_nick":"later","user_gender":"gg","user_psw":"ssss","user_address":"\u756a\u79ba\u5927\u77f3","user_phone":"xxxxx","user_email":"xxxx.h.p@qq.com","user_qq":"2222222","user_weiboName":"ssss","user_weiboLink":"http:\/\/weibo.com\/xxxx","user_urgentName":"\u674e\u542f\u65fa","user_urgentPhone":"xxxxx","user_interest":"\u9886\u961f+\u6444\u5f71","user_experienceGrade":"0","user_knowledgeScore":"0","user_comments":"\u6211\u662flater~","user_createtime":"2013-01-17 20:44:38"}},"msg":""}

# 修订历史

## 2017-06-12
1. 用户表增加存储用户头像地址、发起活动次数统计、参加活动次数统计、飞机活动次数统计的字段
2. 活动表增加集合地点、集合时间、出发地、目的地字段。
3. 增加发起活动和编辑活动接口。

## 2017-06-25
1. 增加茶馆相关接口。
2. 增加了审核用户报名的操作接口。
3. 增加评论回复的编辑接口。
4. 增加接口签名校验代码。（需要在init.php中去除备注启用）

## 2017.06.28
1. 给文章列表，活动评论文章评论列表增加头像和email信息返回。

TODO 初始化活动统计信息。
TODO 发起活动or报名or退出的时候，自动给个人活动情况增减。
TODO 给接口层的活动状态加齐邮件发送功能。
TODO 数据库自动备份脚本。
TODO 增加接口层的登陆状态控制。