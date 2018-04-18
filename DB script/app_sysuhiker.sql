-- phpMyAdmin SQL Dump
-- version 3.3.8.1
-- http://www.phpmyadmin.net
--
-- 主机: w.rdc.sae.sina.com.cn:3307
-- 生成日期: 2016 年 12 月 07 日 21:00
-- 服务器版本: 5.6.23
-- PHP 版本: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `app_sysuhiker`
--

-- --------------------------------------------------------

--
-- 表的结构 `event_bbs`
--

CREATE TABLE IF NOT EXISTS `event_bbs` (
  `post_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `post_title` varchar(100) NOT NULL DEFAULT '',
  `post_type` varchar(20) NOT NULL DEFAULT '',
  `post_detail` text NOT NULL,
  `post_keywords` varchar(100) NOT NULL,
  `post_createTime` datetime NOT NULL,
  `post_createUserId` varchar(20) NOT NULL DEFAULT '',
  `post_modifyTime` datetime NOT NULL,
  `post_modifyUserId` varchar(20) NOT NULL DEFAULT '',
  `post_permission` varchar(20) NOT NULL DEFAULT '',
  `post_up` bigint(20) unsigned NOT NULL,
  `post_down` bigint(20) unsigned NOT NULL,
  `post_count` bigint(20) unsigned NOT NULL,
  `post_countRe` bigint(20) unsigned NOT NULL,
  `post_other` varchar(1000) NOT NULL DEFAULT '',
  PRIMARY KEY (`post_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=71 ;

--
-- 转存表中的数据 `event_bbs`
--

INSERT INTO `event_bbs` (`post_id`, `post_title`, `post_type`, `post_detail`, `post_keywords`, `post_createTime`, `post_createUserId`, `post_modifyTime`, `post_modifyUserId`, `post_permission`, `post_up`, `post_down`, `post_count`, `post_countRe`, `post_other`) VALUES
(1, '系统bug反馈收集帖', '其他', '本人乃Java码农，第一次用php写东西，目测一定会有很多bug存在。麻烦大家如果在使用过程中遇到的问题，统一反馈到这里。描述清楚问题，直接回复在本帖下面即可。谢谢合作~', 'bug', '2013-01-17 22:20:14', '1', '2013-06-25 10:52:25', '91', '公开', 0, 0, 0, 11, ''),
(2, '新功能需求收集帖', '其他', '<div>现阶段只做了活动报名和一个简单的论坛功能。已经能满足我们平时发起活动和发布作业帖的大部分需求了。</div>大家觉得本平台还可以增加些什么有意思的功能的，直接回复本贴提出即可。', '需求', '2013-01-17 22:25:57', '1', '2016-11-08 18:03:04', '658', '公开', 0, 0, 0, 2, ''),
(4, '逸仙徒步活动平台使用帮助', '其他', '<div>FAQ 1.0 版本</div><div>0.请用你经常用的邮箱注册，登录名就是注册邮箱。注册需要验证邮箱。</div>1.所有注册用户都有发起活动的权限。<div>2.所有注册用户都能报名参加活动。</div><div>3.报名参加活动前必需做户外知识测试，答对五题中的三题才可以报名。</div><div>4.报名需要活动发起人的审核。</div><div>5.报名参加的活动在活动发起人审核通过之后会自动发邮件通知报名者。</div><div>6.测试可以随时去做，不报名参加活动也可以去做户外知识测试。</div>', 'FAQ', '2013-01-17 22:35:56', '1', '2016-06-25 13:48:59', '588', '公开', 0, 0, 0, 5, ''),
(5, '纯粹灌水贴', '其他', '感谢凉妹，逸仙徒步也有自己的bbs了', 'none', '2013-01-18 00:02:57', '5', '2014-03-07 00:52:20', '1', '公开', 0, 0, 0, 20, ''),
(6, '【拉练专贴】逸仙徒步2013年拉练记录及总结讨论专贴', '作业攻略', '新开一个拉练专贴，到了年末回顾的时候，一看就知道了。<div>麻烦以后大家带队出去拉练的时候，在拉练结束回来之后，回复一下这个帖子。总结一下路线的难度，交通情况，简单说下拉练过程中遇到的一些事情等等等，方便后人参考</div>', '拉练', '2013-01-19 19:40:12', '1', '2013-07-22 22:36:36', '1', '公开', 0, 0, 0, 33, ''),
(7, '2013.01.26-27.影古线+鸡枕山环线活动讨论', '活动讨论', '本帖仅供活动讨论使用，报名请到活动页面选择活动报名。', '露营活动', '2013-01-20 17:31:04', '1', '2013-01-24 00:18:50', '1', '公开', 0, 0, 0, 3, ''),
(8, '2013.01.26-27.影古线+鸡枕山环线活动作业记录', '其他', '<p>此次活动有如下时间流程：</p><p>1月26日 &nbsp; 10:50 &nbsp;15人小团队从影村集体出发；</p><p> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;14:07 &nbsp; 到达锦村毛坪生产队；</p><p> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;14:44 &nbsp; 到达锦村（中心村）；</p><p> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;15:15 &nbsp; 到达尧社；</p><p> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;16:30 &nbsp; 到达阿婆六，开始安营扎寨。</p><p><br /></p><p>1月27日 &nbsp; 8:00 &nbsp; &nbsp;从阿婆六出发；</p><p> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;9:50 &nbsp; &nbsp;到达溪头村；</p><p> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;11:30 &nbsp; 到达鸡枕山山脚，开始攀程；</p><p> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;14:30 &nbsp; 登上鸡枕山山顶（海拔1143m）；</p><p> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;16:52 &nbsp; 下到鸡枕山山脚（东星村）；</p><p> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;18:40 &nbsp; 徒步至流溪河森林公园，启程回家！ &nbsp; &nbsp;</p>', '', '2013-01-29 19:34:53', '32', '2013-01-29 19:47:10', '8', '公开', 0, 0, 0, 1, ''),
(9, '2013.1.26-27影古线+鸡枕山露营徒步流水账', '作业攻略', '<p style="text-indent:28px"><span style="font-family:宋体">八点四十左右从广州酒家出发，十点半左右到达影村。</span></p><p style="text-indent:28px"><span style="font-family:宋体">十点五十分左右，从影村出发。分岔路从左边上。跟一个名叫“洁超”的中学生队几乎同时，一路诸多欢乐。不过后来应该是被他们甩下了，看不到影了。</span></p><p style="text-indent:28px"><span style="font-family:宋体">十二点，到达水电站，午餐。有雨。</span></p><p style="text-indent:28px"><span style="font-family:宋体">一点一刻左右，穿过竹林，见各种花，我表示不大分得清，应该桃花梅花山茶花都有。东东说这里名叫梅林，那梅花我应该是没有认错的，虽然也有很多人说不是。山间因雨而一片雾朦胧。忽略掉淋雨的不舒服的话，还是很美的。之后又是一片蜿蜒的竹林，下来岔路往右。左有豌豆花和甘桔，一路梅花。（两天的行程下来，最喜欢的还是一片又一片青翠的竹林，太美了！）</span></p><p style="text-indent:28px"><span style="font-family:宋体">两点一刻，休息。貌似这个村子只有移动的信号，木有电信的。</span></p><p style="text-indent:28px"><span style="font-family:宋体">两点四十，到达影古线甘坑驿站。好多桔子，看起来很好吃的样子。村民热情指路。经过一户农家，上面写着“农家饭，豆腐花，番薯糖水”，住民也热情地招呼。可惜我们谁都没有停下来腐败的欲望。大概他们会很失望吧！顺着他们的指示，往前走不多远就到了“锦村”石碑。往右走。左侧有影古线徒步路线图。据路线看来，当天的路程已经走了约三分之二。（若不对请大家更正）</span></p><p style="text-indent:28px"><span style="font-family:宋体">三点一刻到尧社，发现我是来过的。民房前的打谷机还在。下面是一片农田，也是记忆犹新，因为我曾拍过。种了各种蔬菜。举头望去，山仍然笼罩在雨雾之中。我记得来这里时走的方向是相反的，于是以为自己之前走的是古影线，后来才想起来是星溪线（东星村—溪头村），有部分是重合的。</span></p><p style="text-indent:28px"><span style="font-family:宋体">四点半，到达阿婆六，当天的徒步行程已全部结束。阿婆六好多茶花，有些开得非常漂亮。还有一种长得挺高的树，上面开着白色花朵，当时不知道名字，后来无意中在微博看到辛夷的图片，又名紫玉兰，极像，应该是了。这里也有种熟悉的感觉。</span></p><p style="text-indent:28px"><span style="font-family:宋体">很幸运地找到一个祠堂露营。有一家的阿公阿婆，答应把厨房借给我们做晚餐和早餐。当阿公把一口大锅放到祠堂中间，用两块砖架好时，大家傻了眼：难道这就是给我们用的锅？一问之下才知道原来这是给我们烤火用的，并且很快给我们生好了火，柴随便用。天啊简直是太幸福了！感动到爆啊！这些要感谢柚子童鞋的翻译。这里民风淳朴，简直有点夜不闭户的感觉。这一次的晚餐极其腐败，紫菜咸蛋汤，西红柿炒鸡蛋，腊味饭，炒青菜，炒土鸡……值得一提的是，发现东东真是个居家好男人，神马都会。还有特意烤给木木的两个暖心暖胃的鸡蛋啊……还有，柚子也很贤惠！</span></p><p style="text-indent:28px"><span style="font-family:宋体">夜里露营，还是有点冷的，醒来过，把外套也穿上再睡。后来知道觉得冷的不止我一个。睡门口的四个（凉妹，行云流水，东东，波波）似乎反而不觉得冷，这是为什么呢？</span></p><p style="text-indent:28px"><span style="font-family:宋体">第二天，五点起床，洗漱，吃早餐，收拾。七点半出发。（过程貌似长了点）重装徒步。我的太大的包是个无奈，然后居然还忘记扣背负，汗一个。。然而居然也给我走下来了。被提醒后知道自己竟然没扣时，也不觉有点佩服自己。不过东东说扣背负会影响血液循环，所以其实也是需要不时解开的。重装的这一段路，累是很累，但风景也真的很美。那竹海，那梅花，那溪水和泉水、天空……哎，美死了！所以累也是值得的。</span></p><p style="text-indent:28px"><span style="font-family:宋体">九点五十，到达双水驿站。这也是我来过的地方，不仅来过，还在这里吃过饭。十点三十五，把行李扔车上，开始轻装徒步。没有很复杂的路吧，所以也没有特意去记。不过竟然不记得到达水库的时间，这个不是太好。。我还记得我问过的。</span></p><p style="text-indent:28px"><span style="font-family:宋体">从水库上鸡枕山，要经过一个竹梯。我走得小心翼翼，最后简直是趴下去过去的。小邓先过去了，在那头拍照。让坑爹笑一个时，坑爹说没时间；柚子最后一个过，很淡定地在快到时配合小邓的要求摆好</span>pose<span style="font-family:宋体">拍照——鲜明的对比啊！</span></p><p style="text-indent:28px"><span style="font-family:宋体">上鸡枕山不是一件太容易的事。感觉好多险的地方，我走得很慢很艰难（好吧我不讳言我是一个比较怕死的人），幸有各位的鼓励和帮助，得以顺利完成。然后就很担心，上去已经这么难，等下原路返回时要怎么办？下陡坡可是比上要难啊！还好这种情况最终没有发生，没想到下来时其实还好，甚至比上去时要轻松。有点奇怪了。也许是因为上去过，然后知道自己是可以的？上顶的过程中，跟那个三十几人下山的队伍狭路相逢时让我比较郁闷。不过都过去了，就不再说了。整个登山过程中，头驴尾驴不断变化，龙凤和蓝天体力相当了得。</span></p><p><span style="font-family:宋体">两点半左右到达山顶。稍事休息。合影时</span>GG<span style="font-family:宋体">们那叫一个豪迈。怎么个豪迈法，大家都懂的。合影后便开始下山，四点十分左右下到鸡枕山水库，电站休息。四点五十，下到马路（东星村），登山结束。然后从马路徒步走到返程上车地点，时间已是六点半。</span></p><p style="text-indent:28px"><span style="font-size:14px">回到家好像已经有九点了，一进门我的背包就把我姐我妹给惊着了。对于为什么好好的舒服日子不过，要跑去露营体验艰苦生活，我觉得当当的话说得很好：“徒步其实不是一种自虐行为，一直以来觉得特别的不理解这一群人，觉得是没事找事的那种，但只有你真正的参与其中了，你会发现这种活动的迷人之处了，接触大自然，释放压力，呼吸新鲜空气，锻炼身体，这些在钢筋混凝土的城市森林是无法体会到的。还有一种团队的凝聚力，头驴的号召力领导力，尾驴的责任心，各位队友的分工，队友的互相帮助，大家可以毫无忌讳的不论背景的偷橘子，一起篝火，一起喝酒，一种天然的人与人之间的联系，不会带着任何的猜忌与目的。内心平静的挺好，暖暖的。”以此作为结束。</span></p><p>&nbsp;</p><p><span style="font-size:14px">ps.这真的完全是流水账，还不是很完整的流水账，请大家继续补充。</span></p>', '', '2013-01-30 16:06:28', '8', '2013-01-31 23:24:42', '', '公开', 0, 0, 0, 11, ''),
(10, '01.26-27.影古线+鸡枕山环线乱记', '其他', '<div>算起来，也有一年没认认真真爬过山了，静极思动，我思忖着也该动动生锈的骨头了——于是便有了这篇游记的诞生。不过动力不足，姑且乱记一下，哈哈。</div><div><br /><br />关于烟雨<br /><br />从广州出发的时候，天已经阴沉沉了。我想着估计凉妹的雨神诅咒又重现了。果不其然，刚上山不久，天空便飘起了毛毛细雨——于是我们很苦逼地开始了第一天的雨中徒步。<br /><br />雨其实不大，细细绵绵的，颇有些沾衣不湿杏花雨的感觉，只是再小的雨下久了也是会湿身的~于是我很苦逼地重复湿了又干、干了又湿的过程。不过下雨倒也不是没有好处的，在行经一片片竹林的时候，无由来地，我想起藏龙卧虎中的那片竹林——一望无际的竹海笼罩在烟雨迷蒙中&nbsp;，连雾气都仿佛被染成碧绿一片，望不尽的前路，藏着朦胧的神秘。<br /><br />想起刚才在锦村看到的小楼，&nbsp;忽然感觉住在这里该是多幸福的一件事。<br /><br />白云绕山间，竹海听涛声&nbsp;，又是多么写意的生活。</div><div><br /><br />关于腐败<br /><br />我一直固执地认为真正的凉妹应该是被外星人绑架了，面前这个应该是替代品。证据是他竟然不当头驴了！他竟然愿意替我背包了！！而且他对michael提出腐败建议竟然不反对！！！本来我应该发挥我福尔摩斯般的推理能力戳穿面前这个冒牌货的，但想到正主的自虐倾向，我还是放弃了这个想法，让他在火星上当个上门女婿应该是不错的选择。<br /><br />当地的村民很淳朴，不仅借出祠堂供我们露营，阿婆阿伯还拿出了火盆给又冷又湿的我们烤火，并答应借厨房给我们煮晚饭，顿时感觉人间自有真情在。michael哥发挥他腐败的本色，自告奋勇去老乡那买了只土鸡和纯天然有机蔬菜，于是我们有幸在暖烘烘的火盆隔壁吃了顿热乎乎的晚饭。嗯，腊肠饭很香很可口，东东炒的土鸡也美味非常，连蔬菜也出乎意料地好吃。这是一顿无比满意的晚餐——在湿冷疲累的夜里吃上一顿这样的晚饭，幸福有时也很简单。<br /><br />饭毕，男人围着桌子喝酒畅谈，女人围着火盆窃窃低语，我很喜欢这种氛围，很温暖，很温馨。</div><div><br /><br />关于爬山<br /><br />其实没什么好说的，这座山既不是我爬过最高的，也不是最美的，更不是最难爬的，唯一可说的就是它的陡峭——没带手套的孩子表示手脚并用是件很苦逼的事，只是因为冒牌凉妹愿意背包，一路轻装对于我是个极大的利好。比较有趣的是上山路上有一个简易竹桥，哥很闲庭信步过去了，看着妹子们担惊受怕小心翼翼的样子很乐不可支。（好吧与各位体力超人比我只能在妹子身上找成就感了真对不起-_-#）<br /><br />我不在那段时间貌似逸仙群多了一个在山顶上拍裸照的传统，询众要求哥也决定卖肉一回给妹子饱饱眼福，展示下哥的胸肌与肱三头肌；至于腹肌……咳咳，咱能不提这茬么……<br /><br />总得来说这还算是一次很悠闲腐败的徒步，真心满足，以后必须以这个为底线啊，哥的老弱残躯实在经不起自虐的折腾了。<br /><br /><br /><br /><br />﻿</div><p>&nbsp;</p>', '', '2013-01-31 00:04:00', '13', '2013-01-31 13:45:46', '19', '公开', 0, 0, 0, 5, ''),
(11, '2013.01.26-27.影古线+鸡枕山环线活动总结及攻略', '作业攻略', '<ul style="list-style-type:square;" class=" list-paddingleft-2"><li><p><span style="font-family:tahoma;font-size:12px;line-height:18px;background-color:#f7f7f7;">活动总结：</span></p></li></ul><p><span style="font-family:tahoma;font-size:12px;line-height:18px;background-color:#f7f7f7;">报名人数：16人 （报名贴：<a href="http://sysuhiker.sinaapp.com/joinlist.php?eventId=2" target="_self">http://sysuhiker.sinaapp.com/joinlist.php?eventId=2</a> ， 系统上报名15人，另外坑坑由于报名比较晚，直接跟我报名。）</span><br style="font-family:tahoma;font-size:12px;line-height:18px;" /><span style="font-family:tahoma;font-size:12px;line-height:18px;background-color:#f7f7f7;">实际参加人数：16人在体育中心地铁站上车，小侠在到了影村出发点的时候由于肚子疼，跟司机车下撤回去。</span><br style="font-family:tahoma;font-size:12px;line-height:18px;" /><span style="font-family:tahoma;font-size:12px;line-height:18px;background-color:#f7f7f7;">活动起止时间：时间点请参考龙凤同学的作业帖 &nbsp;<a href="http://sysuhiker.sinaapp.com/club/postDetail.php?postId=8" target="_self">http://sysuhiker.sinaapp.com/club/postDetail.php?postId=8</a></span><br style="font-family:tahoma;font-size:12px;line-height:18px;" /><span style="font-family:tahoma;font-size:12px;line-height:18px;background-color:#f7f7f7;">天气状况：周六阴天，有小雨。周日天气晴朗，万里无云。不过有小小阴霾，天不够蓝~</span><br style="font-family:tahoma;font-size:12px;line-height:18px;" /><span style="font-family:tahoma;font-size:12px;line-height:18px;background-color:#f7f7f7;">活动线路有无更改：无。</span><br style="font-family:tahoma;font-size:12px;line-height:18px;" /><span style="font-family:tahoma;font-size:12px;line-height:18px;background-color:#f7f7f7;">有无安全意外(伤患、失踪、死亡）：无</span><br style="font-family:tahoma;font-size:12px;line-height:18px;" /><span style="font-family:tahoma;font-size:12px;line-height:18px;background-color:#f7f7f7;">队员是否均在市镇（非偏远区域）解散离队：是</span></p><ul style="list-style-type:square;" class=" list-paddingleft-2"><li><p><span style="font-family:tahoma;font-size:12px;line-height:18px;background-color:#f7f7f7;">线路攻略<br /></span></p></li></ul><p><span style="font-family:tahoma;font-size:12px;line-height:18px;background-color:#f7f7f7;">地图：请到 @<span class="name" style="margin:0px;padding:0px;text-decoration:initial;color:green;font-family:arial;font-size:12px;font-weight:bold;"><a class="name_link" href="http://weibo.com/yixiantubu" style="margin:0px;padding:0px;text-decoration:initial;color:#004499;font-family:arial;font-size:12px;">逸仙徒步</a> </span></span><span style="font-family:tahoma;font-size:12px;line-height:18px;background-color:#f7f7f7;">的微盘上面找。</span></p><p dir="ltr"><span style="font-family:tahoma;font-size:12px;line-height:18px;background-color:#f7f7f7;">线路难度：影古线全程基本上无难点，岔路口比较多，不过大多可以找到村民来问路。找不到人来问路的地方，基本上也条条大道通罗马的，因为只有那几条村子，有路的话，肯定就是通到另外一条村子的了。主要就是公路和小路的区别，走公路的话，需要多走许多路程。</span></p><p dir="ltr"><span style="font-family:tahoma;font-size:12px;line-height:18px;background-color:#f7f7f7;"> &nbsp; &nbsp;鸡枕山难度比我想象中的大点，考虑到登顶的那几百米比较陡，线路难度纠正为标准（之前预测是标准-）。不过也基本上是有惊无险。<br /></span></p><p dir="ltr"><span style="font-size:12px;">关于营地：阿婆六仍然为最佳营地，村民热情好客，民风非常淳朴，溪头村已经严重商业化，扎营估计不能尽兴。在鸡枕山的半山腰有一个水库，那里也可以凑合着扎营。</span></p><p dir="ltr"><span style="font-size:12px;">溪头村到流溪河公园有公路直通，不过路很小，中巴大巴拐弯都很困难。PS：东星村是个卖橘子的地方，全村都种橘子。</span></p><ul style="list-style-type:square;" class=" list-paddingleft-2"><li><p dir="ltr"><span style="font-size:12px;">GPS统计</span></p></li><li><p dir="ltr"><span style="font-size:12px;"></span></p><p><img src="http://sysuhiker.cc/upload/imgUpload/201301/D1.png13596432848401.png" style="float:none;" title="D1" /></p><p><img src="http://sysuhiker.cc/upload/imgUpload/201301/D2.png13596432845810.png" style="float:none;" title="D2" /></p><p dir="ltr"><span style="font-size:12px;"></span><br /></p><p dir="ltr"><br/></p><p dir="ltr"><span style="font-size:12px;"></span></p></li></ul>', '攻略', '2013-01-31 22:46:32', '1', '2013-02-02 12:30:47', '13', '公开', 0, 0, 0, 9, ''),
(12, 'later的2012年户外活动总结', '作业攻略', '<p>2012年已经过去一个多月了，忙事诸多，都来不及发总结帖了。以下是本人的户外活动总结，基本上都是在逸仙徒步上约伴的，所以，在很大程度上，这也可以算逸仙徒步的部分总结了吧~当然，由于种种原因，逸仙徒步的部分活动我是没有参与其中的，惭愧。欢迎其他同学也发发自己的年度户外总结~</p><p>************分界线****************</p><div style="margin:0px;padding:0px;color:#444444;font-family:tahoma, &#39;microsoft yahei&#39;;font-size:14px;line-height:22px;background-color:#ffffff;"><span style="margin:0px;padding:0px;">2012.01.08 路线：牛头山-天鹿湖郊野公园-凤凰山-沙东新村，全程13km。人数：2人。时间：9点半-2点。备注：除了沙东新村那一段不可行，其他都可行。</span><div style="margin:0px;padding:0px;"></div><div style="margin:0px;padding:0px;">2012.01.14 萝岗香雪。今年遇到好时机，梅花好多。</div><div style="margin:0px;padding:0px;">2012.01.15 牛木内线。10点走到下午3点。途中小迷路几次，全程下雨，全身都湿了，十几度的环境里湿着身走五个小时，好悲催……天气好的时候还是值得走的。</div><div style="margin:0px;padding:0px;">2012.02.4-5 广州S111珠海-拱北-G105-广州。骑行。比爬山还累。。。</div><div style="margin:0px;padding:0px;">2012.02.11 龙凤线</div><div style="margin:0px;padding:0px;">2012.02.19 黄山鲁森林公园-天后宫。赏樱花。</div><div style="margin:0px;padding:0px;">2012.02.25-26 影古线。赏李花。不过已经是花期的末期了。再早一个星期就好了。</div><div style="margin:0px;padding:0px;">2012.03.11-12. 磨房岭南登山节。惠州平安山。今年强度有所降低，不过难度仍然在，加上雨天，走得并不容易。我们二签居然是第一个队伍到的！</div><div style="margin:0px;padding:0px;">2012.03.17-18 深圳百公里。今年99.5km，比去年增加了5km。不过还是跟去年一样在3点半左右到终点了。而且没有大伤，走得比较轻松。前面几签休息得比较多。抓紧时间的话还能再提升一个小时的。</div><div style="margin:0px;padding:0px;">2012.03.24 牛凤线。禾雀花，还没开。对该路线很满意。以后作为替代火凤的常规拉练路线。</div><div style="margin:0px;padding:0px;">2012.04.08 跑大学城外环。16.5km，103min。第一次跑这么长，能跑完就满足了。</div><div style="margin:0px;padding:0px;">2012.04.14 猪龙线拉练。路线很好，全程无阶梯无补给点，强度适中，交通方便。可作为长期拉练路线发展。10人参加。<br /></div><div style="margin:0px;padding:0px;">2012.04.22 大学城骑行。来回70km。</div><div style="margin:0px;padding:0px;">2012.04.28 南沙骑行，4人，来回115km。一如既往的，南沙是个很适合骑车的地方。</div><div style="margin:0px;padding:0px;">2012.05.01 猪龙线。<span style="margin:0px;padding:0px;font-family:&#39;lucida grande&#39;, verdana;">本次活动实际参加人数8人，4男4女。全部顺利完成拉练。</span><br /></div><div style="margin:0px;padding:0px;">2012.05.05 猪龙线。大雨取消，最后只在火炉山溜达一下就回来了。</div><div style="margin:0px;padding:0px;">2012.05.06 大夫山-滴水岩-顺德-十八罗汉森林公园骑行。大夫山人多，滴水岩和十八罗汉森林公园找不到骑车的入口，路过的顺德工厂多。来回111km。</div><div style="margin:0px;padding:0px;">2012.05.12-13 广州-花都-广州骑行。来回共165km。</div><div style="margin:0px;padding:0px;">2012.05.19 沙湾古镇.宝墨园。严格来说，不算户外，纯休闲散步，凑数的。那个周末好像下雨，也不适合户外。</div><div style="margin:0px;padding:0px;">2012.06.01-06.17 丝绸之路骑行。 6月1日晚上在广州上火车，6月17晚回到广州。中间骑行13天，从兰州到敦煌再到柳园。全程骑行约1400km。</div><div style="margin:0px;padding:0px;">中间这段时间，是毕业季，到处和小朋友们毕业照，就木有什么户外活动啦。</div><div style="margin:0px;padding:0px;"><em style="margin:0px;padding:0px;font-style:normal;color:#777777;font-family:arial, helvetica, sans-serif;font-size:12px;text-align:-webkit-auto;"><span style="margin:0px;padding:0px;font-size:14px;">2012.07.07 逸仙徒步常规拉练活动之猪龙线。</span></em><br /></div><div style="margin:0px;padding:0px;"><span style="margin:0px;padding:0px;font-family:arial, helvetica, sans-serif;text-align:-webkit-auto;">2012.07.14 .逸仙徒步常规拉练之-牛龙线</span>。<br /></div>2012.07.21-22 夏日武功山。沈子村-明月山国家森林公园全程穿越。去年端午节计划三天全程穿越，因为天气原因在金顶下撤。今年总算在两天完成了全程穿越，弥补了遗憾。其实两天全程穿越强度并不是很大，跟低于船底顶新洞罗坑两天线。可惜没见到云海。<br /></div><div style="margin:0px;padding:0px;color:#444444;font-family:tahoma, &#39;microsoft yahei&#39;;font-size:14px;line-height:22px;background-color:#ffffff;">2012.08.04 猪龙线拉练。</div><div style="margin:0px;padding:0px;color:#444444;font-family:tahoma, &#39;microsoft yahei&#39;;font-size:14px;line-height:22px;background-color:#ffffff;">2012.09.01 牛头凤尾拉练。牛线的杂草长得很茂盛，路都认不出来了。被各种杂草割的伤痕累累，俺的快干裤经过此役，多了好多个洞，然后光荣牺牲了。此行最大的成就就是，俺在原定路线已经被水淹的情况下，成功根据等高线画出一条新路线，然后还顺利走通了。</div><div style="margin:0px;padding:0px;color:#444444;font-family:tahoma, &#39;microsoft yahei&#39;;font-size:14px;line-height:22px;background-color:#ffffff;">2012.09.15 猪龙线拉练。</div><div style="margin:0px;padding:0px;color:#444444;font-family:tahoma, &#39;microsoft yahei&#39;;font-size:14px;line-height:22px;background-color:#ffffff;">2012.09.22-23 蓬莱山庄-拔云寺营地-飞云顶（海拔最高1296米）-四方山-酥醪观。山顶的草丛和竹林非常茂密异常茂密，真想不明白怎么那么多人走的路线都还可以长的那么好。其他都在意料之中。</div><span style="color:#444444;font-family:tahoma, &#39;microsoft yahei&#39;;font-size:14px;line-height:22px;background-color:#ffffff;">2012.10.14 猪龙线拉练。没印象鸟~</span><br style="color:#444444;font-family:tahoma, &#39;microsoft yahei&#39;;font-size:14px;line-height:22px;background-color:#ffffff;" /><span style="margin:0px;padding:0px;color:#444444;font-family:tahoma, &#39;microsoft yahei&#39;;font-size:14px;line-height:22px;background-color:#ffffff;">2012.10.21 牛火线拉练。这个依稀记得在下火炉山的急升破的时候，刚刚好见到了很漂亮的日落~<br />2012.10.28 磨房·河源40km徒步。线路很给力，风景很美！我们包了一辆大巴去，去了三十多人<br />2012.11.03 猪龙线拉练。 <br /><span style="margin:0px;padding:0px;">2012.11.10 直版猪龙线拉练，走到龙眼洞森林公园那边的。<br /></span></span><p><span style="margin:0px;padding:0px;color:#444444;font-family:tahoma, &#39;microsoft yahei&#39;;font-size:14px;line-height:22px;background-color:#ffffff;"><span style="margin:0px;padding:0px;">2012.11.18 广州马拉松。人生中的第一次马拉松，全程，445，顺利完成。 </span></span></p><p><span style="margin:0px;padding:0px;color:#444444;font-family:tahoma, &#39;microsoft yahei&#39;;font-size:14px;line-height:22px;background-color:#ffffff;"><span style="margin:0px;padding:0px;">2012.11.24-25 杨梅坑骑单车+西冲腐败烧烤露营。</span></span></p><span style="margin:0px;padding:0px;color:#444444;font-family:tahoma, &#39;microsoft yahei&#39;;font-size:14px;line-height:22px;background-color:#ffffff;"><span style="margin:0px;padding:0px;"><span style="margin:0px;padding:0px;">2012.12.01 牛木外线。 当时下了好多天的雨，路好湿好滑，众人都不同程度的摔了。幸亏当时没有女生去。不过牛木外线的后半段，有杨桃吃！<br />2012.12.09 弯板猪龙线。走大源水库再上华南第一坡的坡顶。该拉练路线全程无补给，绝佳的拉练路线！<br /><span style="margin:0px;padding:0px;">2012.12.15-16. 大丹霞两天穿越。看别人的攻略好像都是三天穿越的，本以为会很辛苦，周五晚上到水江渡口扎营，周六早上七点开始走，下午五点半的时候就到达巴寨四百米左右的观景平台扎营（巴寨上面人太多了，营地不够）。第二天早上在巴寨逛，9点多才在巴寨开始出发徒步，中午还在五仙岩开锅煮面腐败了一个多钟。结果下午三点就到达大丹霞穿越的终点了~一个周末轻轻松松搞定。<br />2012.12.23 牛火线拉练。印象中朦胧记得四点多就可以上公交车回来了。然后那次我们走了黄蟮田水库这部分的新路线，很有意思。<br />2012.12.27-2013.01.01 &nbsp;28/29 南昌：鄱阳湖南矶山湿地保护区观鸟，露营。30/31安徽，徽杭古道穿越，大雪后登顶清凉峰。也算有半座雪山的经验了~</span></span></span></span><p><br /></p>', '年度总结', '2013-02-03 23:55:25', '1', '2013-07-18 00:15:28', '', '公开', 0, 0, 0, 5, ''),
(13, '2012，我的周末是这样度过的', '其他', '<p>1.2&nbsp;白云山<br />1.3&nbsp;佛山：祖庙，梁园，仁寿寺<br />1.14&nbsp;香雪公园赏梅<br />2.5&nbsp;黄埔古港游走<br />2.11&nbsp;闾丘露薇讲座<br />2.18&nbsp;珠江公园、红专厂游走<br />2.19&nbsp;黄山鲁森林公园看樱花、南沙看海<br />2.25-26&nbsp;阳江<br />3.17-18&nbsp;桂林<br />5.12&nbsp;广美毕业展<br />5.19&nbsp;宝墨园、沙湾古镇&nbsp;<br />5.20&nbsp;珠海<br />6.16-17&nbsp;厦门<br />6.23&nbsp;看龙舟<br />7.8&nbsp;磨房“发现广州”<br />7.14&nbsp;牛龙线拉练<br />7.21&nbsp;“深海奇珍”展，广东美术馆，广东省华侨博物馆<br />7.28&nbsp;琶·珠江游走<br />8.18&nbsp;南国书香节<br />8.19&nbsp;小洲村<br />8.26&nbsp;陈树人纪念馆，东山洋楼群，基督教东山堂<br />9.2&nbsp;扎西拉姆多多讲座<br />9.9&nbsp;纯阳观，广美，十香园，海珠湖<br />9.15&nbsp;猪龙线<br />9.22&nbsp;清晖园，顺峰山公园<br />9.23&nbsp;洛沥湖游走<br />10.7&nbsp;省博DIY发簪<br />10.19&nbsp;联合书店讲座<br />10.21&nbsp;牛火线拉练<br />10.28&nbsp;磨房河源40KM徒步<br />11.3&nbsp;寻宝龙导尾<br />11.10&nbsp;番禺博物馆<br />11.11&nbsp;西关寻宝，卓莹画展<br />11.25&nbsp;探寻民国中大遗风（华工、华农）<br />12.15&nbsp;中山<br />12.23&nbsp;牛火线<br />12.29&nbsp;省博</p><p>（省略与朋友聚会N次）</p><p>仿凉妹总结一下，拉练只有四次，还是其他活动多些。</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>', '', '2013-02-05 20:54:01', '8', '2013-10-16 10:47:28', '109', '公开', 0, 0, 0, 10, '');

-- --------------------------------------------------------

--
-- 表的结构 `event_bbs_re`
--

CREATE TABLE IF NOT EXISTS `event_bbs_re` (
  `re_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `re_postId` varchar(100) NOT NULL DEFAULT '',
  `re_orderId` varchar(20) NOT NULL DEFAULT '',
  `re_detail` text NOT NULL,
  `re_createTime` datetime NOT NULL,
  `re_createUserId` varchar(20) NOT NULL DEFAULT '',
  `re_modifyTime` datetime NOT NULL,
  `re_modifyUserId` varchar(20) NOT NULL DEFAULT '',
  `re_permission` varchar(20) NOT NULL DEFAULT '',
  `re_up` bigint(20) unsigned NOT NULL,
  `re_down` bigint(20) unsigned NOT NULL,
  `re_other` varchar(1000) NOT NULL DEFAULT '',
  PRIMARY KEY (`re_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=47487 ;

--
-- 转存表中的数据 `event_bbs_re`
--

INSERT INTO `event_bbs_re` (`re_id`, `re_postId`, `re_orderId`, `re_detail`, `re_createTime`, `re_createUserId`, `re_modifyTime`, `re_modifyUserId`, `re_permission`, `re_up`, `re_down`, `re_other`) VALUES
(1, '1', '1', '如果有安全漏洞的话。。大家不要攻击啊', '2013-01-17 22:38:34', '1', '2013-01-17 22:38:34', '1', '公开', 0, 0, ''),
(2, '5', '1', '客气客气~', '2013-01-18 00:03:47', '', '2013-01-18 00:03:47', '', '公开', 0, 0, ''),
(3, '2', '1', '1，希望在首页加入登录入口<BR>', '2013-01-18 10:01:42', '9', '2013-01-18 10:01:42', '9', '公开', 0, 0, ''),
(4, '5', '2', '回复页面好奇葩……<BR>', '2013-01-18 11:02:38', '13', '2013-01-18 11:02:38', '13', '公开', 0, 0, ''),
(5, '5', '3', '怎么个奇葩法?<br>', '2013-01-18 12:11:12', '', '2013-01-18 12:11:12', '', '公开', 0, 0, ''),
(6, '5', '4', '冒个泡', '2013-01-18 21:11:06', '15', '2013-01-18 21:11:06', '15', '公开', 0, 0, ''),
(7, '6', '1', '<div>2013.01.19.弯板猪龙线拉练</div><div>召集贴<br></div><div>http://sysuhiker.sinaapp.com/joinlist.php?eventId=1</div><div>实际参加人数：5人。 later，柚子，fago，leo，麦兜。下午两点在第二条机耕路处leo由于抽筋，fago陪同下撤。</div><div>早上实际出发时间：9点半</div><div>结束时到公交车站时间：下午5点</div><div>路线情况：今天天气好，最近又没下雨，所以路是相当的好走的。冬天因为要防火，防火带都清得很干净，没有茂密的草丛，真是拉练的绝佳时机 。</div><div>友情提醒：本路线全程无小卖部等各种补给，注意在出发时就要补充好吃的和喝的。</div>', '2013-01-19 19:47:32', '1', '2013-01-19 19:47:32', '1', '公开', 0, 0, ''),
(8, '6', '2', '补充一下，我今天测了一下下华南第一坡的时间，四分半钟~', '2013-01-19 20:43:05', '1', '2013-01-19 20:43:05', '1', '公开', 0, 0, ''),
(9, '6', '3', '哈哈，今天测试了一下中大北门到花都云山中学的时间（骑行），大约1小时55分钟，总长度39KM，来回一个早上搞定，适合平时锻炼~~', '2013-01-19 23:02:21', '', '2013-01-19 23:02:21', '', '公开', 0, 0, ''),
(10, '6', '4', '楼上居然匿名回复，是小百货麽', '2013-01-19 23:39:07', '1', '2013-01-19 23:39:07', '1', '公开', 0, 0, ''),
(11, '6', '5', '今天，要是把fago的干粮留下，我们的下午茶就不会少得那么可怜了。。。<br>以后，，还是多带点东西吃，不能偷懒啊啊', '2013-01-19 23:52:16', '7', '2013-01-19 23:52:16', '7', '公开', 0, 0, ''),
(12, '1', '2', 'http://sysuhiker.sinaapp.com/club/register.php ，有死链。。<br>', '2013-01-20 00:12:19', '', '2013-01-20 00:12:19', '', '公开', 0, 0, ''),
(13, '6', '6', '是我啊，，凉妹，浏览器一关就会自动退出登录，下次重启浏览器（我用chrome）又得重新登陆了，不太方便，直接回复就变成匿名了，你看看能不能授权浏览器记住账户呗，就不用老是重新登陆了？（还是只有我这样？）', '2013-01-20 09:22:05', '5', '2013-01-20 09:22:05', '5', '公开', 0, 0, ''),
(14, '5', '5', '不错。逸仙徒步越来越像好了，赞一个', '2013-01-20 11:08:10', '16', '2013-01-20 11:08:10', '16', '公开', 0, 0, ''),
(15, '5', '6', '不过我打错了字，发错了帖就没后悔的余地了。怎么删帖？', '2013-01-20 11:09:30', '16', '2013-01-20 11:09:30', '16', '公开', 0, 0, ''),
(16, '5', '7', '哈哈，删帖功能暂时还没写好', '2013-01-20 11:28:26', '1', '2013-01-20 11:28:26', '1', '公开', 0, 0, ''),
(17, '1', '3', '回2楼，已解决。', '2013-01-20 11:28:59', '1', '2013-01-20 11:28:59', '1', '公开', 0, 0, ''),
(18, '6', '7', '<p>中途沿着一条大路下撤，汽车可以开的大路。时不时有汽车经过，烟尘滚滚，宁愿绕远路走林间小道。现在凤凰山上似乎又在盘山公路，开通后必定会招来很多汽车。以后在路线选择上最好尽量避开这种汽车可以到达的地方，起点与终点除外。</p><p>出门时吃的只带够自己的份量，半路later收编了不带干粮的麦兜，我们都分了一些吃的给她。午餐后无多少余粮，只剩一块方包，即使把它留下也拯救不了你们可怜的下午茶。冬天喝的可以少带，夏天一般要2.5L水，冬天1.5升就够了，多带点吃的才是王道。</p>', '2013-01-20 17:29:44', '14', '2013-01-20 17:29:44', '14', '公开', 0, 0, ''),
(19, '5', '8', '先抢个沙发<BR>', '2013-01-20 18:33:12', '18', '2013-01-20 18:33:12', '18', '公开', 0, 0, ''),
(20, '7', '1', '有些人的报名信息缺紧急联系人信息没填，那样是不可以通过的。请大家报名的时候不要漏填紧急联系人信息。', '2013-01-21 00:12:53', '1', '2013-01-21 00:12:53', '1', '公开', 0, 0, ''),
(21, '6', '8', '回6楼小百货，现在新增了自动登陆的功能了，你登陆的时候选中勾上那个remember me前面的checkbox，如果没登出直接关闭浏览器的话，下次再打开浏览器的时候应该就会自动登陆了。', '2013-01-21 00:15:37', '1', '2013-01-21 00:15:37', '1', '公开', 0, 0, ''),
(22, '6', '9', '@3楼，求带……<div>云山中学貌似离我以前的医院不远……</div>', '2013-01-21 13:15:35', '23', '2013-01-21 13:15:35', '23', '公开', 0, 0, ''),
(23, '1', '4', '注册时激活码是一大串， &nbsp; 填写无效', '2013-01-21 13:18:32', '24', '2013-01-21 13:18:32', '24', '公开', 0, 0, ''),
(24, '6', '10', '@珊瑚，云山中学是在龙珠路那边，离花都区政府不远，旁边还有个漂亮的马鞍山公园，下次有兴趣过去的还可以一起踩车啊~~<div>另外：如果自己一个人去，上百度地图就行了，最好先做好路线的大致规划，不要中途老是停下来用手机查地图，非常浪费时间的，大致的路途为：</div><div>中大北门</div><div>-》滨江东路</div><div>-》解放桥</div><div>-》解放路（南，中，北）</div><div>-》越秀公园</div><div>-》解放北路转机场路</div><div>-》一路向北</div><div>-》机场路转广花一路（S114），看到黄石东路就差不多到这个路口</div><div>-》一路向北（偏西）</div><div>-》路过平沙立交后约1公里进入广花二路（S114）</div><div>-》一路向北（偏西）</div><div>-》新雅大桥</div><div>-》转入新华路</div><div>-》商业大道</div><div>-》凤凰北路</div><div>-》转西几百米就到云山中学</div><div><br></div><div>PS：S114路边有很多草莓园的，有人直接就在路边卖，也可以自己进去摘，如果你时间充分，可以去试试看，草莓又红又大颗，后悔上次赶时间没有买，路上补给基本上报亭就够了</div>', '2013-01-21 13:33:52', '5', '2013-01-21 13:33:52', '5', '公开', 0, 0, ''),
(25, '6', '11', '难道这个帖子的排序是按照ASCII一个个来的？！', '2013-01-21 13:34:55', '5', '2013-01-21 13:34:55', '5', '公开', 0, 0, ''),
(26, '6', '12', '果然啊，一位位比较下去的，@凉妹，改良一下~~', '2013-01-21 13:35:24', '5', '2013-01-21 13:35:24', '5', '公开', 0, 0, ''),
(27, '6', '13', '擦，应该来个11楼才能说明问题，想错了...', '2013-01-21 13:36:08', '5', '2013-01-21 13:36:08', '5', '公开', 0, 0, ''),
(28, '1', '5', '帖子的回复超过10的时候出现了错误的排序：<div>http://sysuhiker.sinaapp.com/club/postDetail.php?postId=6<br></div><div>怀疑使用了ASCII码的逐位比较算法，请查明，谢谢！</div>', '2013-01-21 13:39:51', '5', '2013-01-21 13:39:51', '5', '公开', 0, 0, ''),
(29, '5', '9', '测试一下', '2013-01-21 13:45:52', '19', '2013-01-21 13:45:52', '19', '公开', 0, 0, ''),
(30, '5', '10', '冒个泡。凉哥，这回复页面怎么这么窄？<BR>', '2013-01-21 17:28:20', '27', '2013-01-21 17:28:20', '27', '公开', 0, 0, ''),
(31, '5', '11', '咦，刚回复的不见鸟？<BR>', '2013-01-21 17:29:18', '27', '2013-01-21 17:29:18', '27', '公开', 0, 0, ''),
(32, '5', '12', '<BR>原来插楼了，大家忽视我吧，囧。', '2013-01-21 17:30:29', '27', '2013-01-21 17:30:29', '27', '公开', 0, 0, ''),
(33, '5', '13', '哈哈，刚刚有bug，现在已经修复鸟~', '2013-01-21 20:50:43', '1', '2013-01-21 20:50:43', '1', '公开', 0, 0, ''),
(34, '6', '14', '问题已修复~', '2013-01-21 20:51:20', '1', '2013-01-21 20:51:20', '1', '公开', 0, 0, ''),
(35, '1', '6', '回4楼，注册激活的程序改进了一下。现在应该比较直观了。<div>回5楼，排序问题已经解决。</div>', '2013-01-21 23:10:12', '1', '2013-01-21 23:10:12', '1', '公开', 0, 0, ''),
(36, '7', '2', '考虑到大家积极报名，组两队去。请有兴趣的抓紧时间报名，方便安排工作。', '2013-01-22 00:18:08', '1', '2013-01-22 00:18:08', '1', '公开', 0, 0, ''),
(37, '7', '3', '<div>&nbsp;活动安排已发出去到各人的报名邮箱，请各位查收邮件。&nbsp;</div>', '2013-01-24 00:18:50', '1', '2013-01-24 00:18:50', '1', '公开', 0, 0, ''),
(38, '8', '1', '<p>待充实</p>', '2013-01-29 19:47:10', '8', '2013-01-29 19:47:10', '8', '公开', 0, 0, ''),
(39, '9', '1', '<p><span style="font-size:14px">东东说一路上跟好多狗狗都有亲密关系，嗯，这个应该加上</span></p>', '2013-01-30 16:38:51', '8', '2013-01-30 16:38:51', '8', '公开', 0, 0, ''),
(40, '9', '2', '<p>到达鸡枕山水库时间：约一点</p><p>合影时不豪迈的GG：系风，CY，小邓</p>', '2013-01-30 16:47:46', '8', '2013-01-30 16:47:46', '8', '公开', 0, 0, ''),
(41, '9', '3', '<p>小邓太不给力了，，我在那么危险的路段摆了一个那么2的动作，也不帮我拍好点，哈哈！！<br />其实，走那所谓的独木桥，我是脚软的……<br />我在想，当当在我们上山期间的那一段睡眠，想必是相当舒服。枕着大地，望着蓝天，听着风声，享受着暖暖阳光，整个世界都是她的了。</p>', '2013-01-30 17:05:47', '7', '2013-01-30 17:05:47', '7', '公开', 0, 0, ''),
(42, '9', '4', '<p>我一直以为那中学生的队伍叫&quot;节操&quot;<img src="http://img.baidu.com/hi/jx2/j_0016.gif" />泪流满面!</p><p>记得当时是坑爹还是东东说,你们看那小姑娘走得多快!&nbsp;然后后面的几个小姑娘就笑了,&quot;她还小姑娘,都98年的老女人了(这句是俺加上去的哈)&quot;.&nbsp;然后咱队的MM们就泪流满面了</p>', '2013-01-30 17:20:25', '', '2013-01-30 17:20:25', '', '公开', 0, 0, ''),
(43, '9', '5', '<p>拍的还行吧，对焦因为时间太短没特别准。</p>', '2013-01-30 18:57:29', '', '2013-01-30 18:57:29', '', '公开', 0, 0, '');


-- --------------------------------------------------------

--
-- 表的结构 `event_hiker`
--

CREATE TABLE IF NOT EXISTS `event_hiker` (
  `user_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(100) NOT NULL DEFAULT '',
  `user_nick` varchar(100) NOT NULL DEFAULT '',
  `user_gender` enum('gg','mm') NOT NULL,
  `user_psw` varchar(100) NOT NULL DEFAULT '',
  `user_address` varchar(300) NOT NULL DEFAULT '',
  `user_phone` varchar(30) NOT NULL DEFAULT '',
  `user_email` varchar(100) NOT NULL DEFAULT '',
  `user_qq` varchar(30) NOT NULL DEFAULT '',
  `user_weiboName` varchar(100) NOT NULL DEFAULT '',
  `user_weiboLink` varchar(300) NOT NULL DEFAULT '',
  `user_urgentName` varchar(100) NOT NULL DEFAULT '',
  `user_urgentPhone` varchar(30) NOT NULL DEFAULT '',
  `user_interest` varchar(100) NOT NULL DEFAULT '',
  `user_experienceGrade` varchar(10) NOT NULL DEFAULT '',
  `user_knowledgeScore` varchar(100) NOT NULL,
  `user_comments` varchar(1000) NOT NULL DEFAULT '',
  `user_createtime` datetime NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=669 ;



-- --------------------------------------------------------

--
-- 表的结构 `event_info`
--

CREATE TABLE IF NOT EXISTS `event_info` (
  `event_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `event_name` varchar(100) NOT NULL DEFAULT '',
  `event_detail` longtext NOT NULL,
  `event_type` varchar(100) NOT NULL DEFAULT '',
  `event_starttime` datetime NOT NULL,
  `event_endtime` datetime NOT NULL,
  `event_join_starttime` datetime NOT NULL,
  `event_join_endtime` datetime NOT NULL,
  `event_comments` varchar(100) NOT NULL,
  `event_createtime` datetime NOT NULL,
  `event_createUserId` varchar(10) NOT NULL,
  `event_maxhiker` int(10) NOT NULL,
  PRIMARY KEY (`event_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=205 ;

--
-- 转存表中的数据 `event_info`
--

INSERT INTO `event_info` (`event_id`, `event_name`, `event_detail`, `event_type`, `event_starttime`, `event_endtime`, `event_join_starttime`, `event_join_endtime`, `event_comments`, `event_createtime`, `event_createUserId`, `event_maxhiker`) VALUES
(1, '2013.01.19.弯板猪龙线拉练', '<div>集合地点:<strong>龙发厂公交站</strong>（柯木朗医院的对面那个站）（车次：83路; 345路; 346路; 494路; 534路; 535路; 564路; 夜60路可达）</div><div>集合时间：2013年01月19日早上9点30 </div><div>领队/联系人：later 136-0242-1520</div><div>活动路线：龙发厂公交站-猪仔山-凤凰山-私立华联后山-山塘背-公鱼岭-大源水库-构麻山-华南第一坡-龙洞水库</div><div><br /></div><div>活动强度：标准（全程山路约15km，爬升约1100米，适合正常人参加。如果太久没参加过运动的话，完成会有些辛苦。本次适当增加一些有趣的路线，会稍长。）</div><div><br /></div><div>活动说明：</div><div>1.如果没有通知，活动都会正常举行。</div><div>2.如果报了名去不了的，请第一时间通知联系人。</div><div>3.全程无补给点，请在出发前准备好午餐和零食和2.5L以上的水。</div><div>4.请按要求按格式报名，请不要空降。</div><div><br /></div><div>报名说明：</div><div>新人报名请阅读：<a href="http://sysuhiker.sinaapp.com/club/postDetail.php?postId=4">逸仙徒步活动平台使用帮助</a></div><div>http://sysuhiker.sinaapp.com/club/postDetail.php?postId=4<br /></div><div><br /></div><div>分工安排：欢迎有经验的同学报名尾驴头驴</div><div>对讲机频率：409.925 （山里手机信号差，有的同学请都带上。）</div><div><br /></div><div>【交通指南】 地铁到天河客运站再转公交。（车次：83路; 345路; 346路; 494路; 534路; 535路; 564路; 夜60路可达）</div><div>【费用预算】 AA制。</div><div>【个人装备】</div><div><br /></div><div>建议装备：</div><div>&gt;登山鞋（运动鞋也行，垫上弹性好的鞋垫，可预防水泡，千里之行从鞋开始）；</div><div>&gt;厚袜子（防止脚掌起泡）；</div><div>&gt;护踝（防止脚踝扭伤）；</div><div>&gt;护膝（有助于保护膝盖）；</div><div>&gt;登山杖（因人而异，两条腿还是显得有些单薄了）；</div><div>&gt;头灯/手电（最好带上，防止需要走夜路）；</div><div>&gt;耐汗耐脏宽松的衣裤（人靠衣裳马靠鞍，可以降低回家途中的回头率。牛仔裤高跟鞋皮鞋裙子之类的直接劝退。）；</div><div>&gt;湿毛巾（是个好东西，好处多多，不多言）；</div><div>&gt;好的小背包（不是追求名牌，但专业性强一点地还是贴背）；</div><div>&gt;手套（山路行进攀登，荆刺野草，保护手部不被无谓划伤）；</div><div>&gt;雨具 </div><div><br /></div><div>食品安排：自带。水1.5L以上。外加午餐的干粮，和若干应急食品。 </div><div><br /></div><div>建议药物：凡士林（防擦伤）、活络油（防止脚扭伤和抽筋）、云南白药（防止关节疲劳损伤）、绿药膏（治无名虫蚁叮咬）、保济丸（突发性拉肚子），止血贴等。 </div><div><br /></div><div>免责声明：</div><div>1、本活动为非盈利性质的自助游活动并有一定的危险*，凡报名参加者均视为具有完全民事行为能力人，参加者须对自己的安全负责；凡报名者均视为已接受放弃损害赔偿 。</div><div>2、本次活动约伴人与同行驴友均为无偿提供活动的援助、支持者。如在活动中发生人身损害后果，赔偿责任领队不承担，由受损害人依据法律规定和本领队声明依法解决。</div><div>3、凡报名者均视为接受声明。代他人报名者，被代报名参加者如遭受人身损害，赔偿责任约伴人同样不承担。</div><div>4、本声明中关于免除领队赔偿责任之约定效力，同样及于同行的副领队.协助.财务。</div><div>5、启程后，本声明将自动生效并表明你接受本声明，否则，请在启程前退出本次活动。 </div><div><br /></div><div>【活动要求】 </div><div>1、听从领队的安排，遵守团队纪律，集体行动，不擅自离开穿越路线； </div><div>2、活动产生的垃圾一律带离，不采摘林中植物；</div><div>3、摒弃鄙视过度的个人主义； </div><div>4、新驴和路线不熟者不要离队伍太远，保持两人同行原则。有困难立即向领队提出。同时请大胆自我介绍，相互认识； </div><div>5. 中途会安排分享环节，分享环节分为深度自我介绍+活动装备准备情况分享+户外相关的技术分享经验分享。</div>', '正常拉练', '2013-01-19 09:30:00', '2013-01-19 17:00:00', '2013-01-17 22:48:00', '2013-01-18 23:30:00', '无', '2013-01-17 22:48:56', '1', 20),
(3, '2013.03.03.直版猪龙线拉练', '<pre style="font-size:13px;line-height:20px;font-family:monaco, menlo, consolas, &#39;courier new&#39;, monospace;padding:9.5px;border-top-left-radius:4px;border-top-right-radius:4px;border-bottom-right-radius:4px;border-bottom-left-radius:4px;border:1px solid ;color:#333333;word-break:break-all;word-wrap:break-word;background-color:#f5f5f5;margin-top:0px;margin-bottom:10px;"><p style="margin-top:0px;margin-bottom:10px;">集合地点:龙发厂公交站（柯木朗的下一站）（车次：83路; 345路; 346路; 494路; 534路; 535路; 564路; 夜60路可达）</p><p style="margin-top:0px;margin-bottom:10px;">集合时间：2013年03月03日早上9点30 </p><p style="margin-top:0px;margin-bottom:10px;">领队/联系人：later 136-0242-1520</p><p style="margin-top:0px;margin-bottom:10px;">活动路线：龙发厂公交站-猪仔山-凤凰山-龙洞水库-华南第一坡-日军碉堡-雷达站-龙眼洞森林公园</p><p style="margin-top:0px;margin-bottom:10px;"><br /></p><p style="margin-top:0px;margin-bottom:10px;">活动强度：标准（全程山路约17km，爬升约1100米，适合正常人参加。如果太久没参加过运动的话，完成会有些辛苦。本次适当增加一些有趣的路线，会稍长。）</p><p style="margin-top:0px;margin-bottom:10px;"><br /></p><p style="margin-top:0px;margin-bottom:10px;">活动说明：</p><p style="margin-top:0px;margin-bottom:10px;">1.如果没有通知，活动都会正常举行。</p><p style="margin-top:0px;margin-bottom:10px;">2.如果报了名去不了的，请第一时间通知联系人。</p><p style="margin-top:0px;margin-bottom:10px;">3.全程无补给点，请在出发前准备好午餐和零食和2.5L以上的水。</p><p style="margin-top:0px;margin-bottom:10px;">4.请按要求按格式报名，请不要空降。</p><p style="margin-top:0px;margin-bottom:10px;"><br /></p><p style="margin-top:0px;margin-bottom:10px;">报名说明：</p><p style="margin-top:0px;margin-bottom:10px;">新人报名请阅读：<a style="color:#2277bb;" href="http://sysuhiker.sinaapp.com/club/postDetail.php?postId=4" target="_blank">逸仙徒步活动平台使用帮助</a></p><p style="margin-top:0px;margin-bottom:10px;">活动报名页面：<a style="color:#2277bb;" href="http://sysuhiker.sinaapp.com/joinlist.php?eventId=3" target="_blank" textvalue="http://sysuhiker.sinaapp.com/joinlist.php?eventId=3">http://sysuhiker.sinaapp.com/joinlist.php?eventId=3</a></p><p style="margin-top:0px;margin-bottom:10px;">分工安排：欢迎有经验的同学报名尾驴头驴</p><p style="margin-top:0px;margin-bottom:10px;">对讲机频率：409.925 （山里手机信号差，有的同学请都带上。）</p><p style="margin-top:0px;margin-bottom:10px;"><br /></p><p style="margin-top:0px;margin-bottom:10px;">【交通指南】 地铁到天河客运站再转公交。（车次：83路; 345路; 346路; 494路; 534路; 535路; 564路; 夜60路可达）</p><p style="margin-top:0px;margin-bottom:10px;">【费用预算】 AA制。</p><p style="margin-top:0px;margin-bottom:10px;">【个人装备】</p><p style="margin-top:0px;margin-bottom:10px;"><br /></p><p style="margin-top:0px;margin-bottom:10px;">建议装备：</p><p style="margin-top:0px;margin-bottom:10px;">&gt;登山鞋（运动鞋也行，垫上弹性好的鞋垫，可预防水泡，千里之行从鞋开始）；</p><p style="margin-top:0px;margin-bottom:10px;">&gt;厚袜子（防止脚掌起泡）；</p><p style="margin-top:0px;margin-bottom:10px;">&gt;护踝（防止脚踝扭伤）；</p><p style="margin-top:0px;margin-bottom:10px;">&gt;护膝（有助于保护膝盖）；</p><p style="margin-top:0px;margin-bottom:10px;">&gt;登山杖（因人而异，两条腿还是显得有些单薄了）；</p><p style="margin-top:0px;margin-bottom:10px;">&gt;头灯/手电（最好带上，防止需要走夜路）；</p><p style="margin-top:0px;margin-bottom:10px;">&gt;耐汗耐脏宽松的衣裤（人靠衣裳马靠鞍，可以降低回家途中的回头率。牛仔裤高跟鞋皮鞋裙子之类的直接劝退。）；</p><p style="margin-top:0px;margin-bottom:10px;">&gt;湿毛巾（是个好东西，好处多多，不多言）；</p><p style="margin-top:0px;margin-bottom:10px;">&gt;好的小背包（不是追求名牌，但专业性强一点地还是贴背）；</p><p style="margin-top:0px;margin-bottom:10px;">&gt;手套（山路行进攀登，荆刺野草，保护手部不被无谓划伤）；</p><p style="margin-top:0px;margin-bottom:10px;">&gt;雨具 </p><p style="margin-top:0px;margin-bottom:10px;"><br /></p><p style="margin-top:0px;margin-bottom:10px;">食品安排：自带。水2L以上。外加午餐的干粮，和若干应急食品。 </p><p style="margin-top:0px;margin-bottom:10px;"><br /></p><p style="margin-top:0px;margin-bottom:10px;">建议药物：凡士林（防擦伤）、活络油（防止脚扭伤和抽筋）、云南白药（防止关节疲劳损伤）、绿药膏（治无名虫蚁叮咬）、保济丸（突发性拉肚子），止血贴等。 </p><p style="margin-top:0px;margin-bottom:10px;"><br /></p><p style="margin-top:0px;margin-bottom:10px;">免责声明：</p><p style="margin-top:0px;margin-bottom:10px;">1、本活动为非盈利性质的自助游活动并有一定的危险*，凡报名参加者均视为具有完全民事行为能力人，参加者须对自己的安全负责；凡报名者均视为已接受放弃损害赔偿 。</p><p style="margin-top:0px;margin-bottom:10px;">2、本次活动约伴人与同行驴友均为无偿提供活动的援助、支持者。如在活动中发生人身损害后果，赔偿责任领队不承担，由受损害人依据法律规定和本领队声明依法解决。</p><p style="margin-top:0px;margin-bottom:10px;">3、凡报名者均视为接受声明。代他人报名者，被代报名参加者如遭受人身损害，赔偿责任约伴人同样不承担。</p><p style="margin-top:0px;margin-bottom:10px;">4、本声明中关于免除领队赔偿责任之约定效力，同样及于同行的副领队.协助.财务。</p><p style="margin-top:0px;margin-bottom:10px;">5、启程后，本声明将自动生效并表明你接受本声明，否则，请在启程前退出本次活动。 </p><p style="margin-top:0px;margin-bottom:10px;"><br /></p><p style="margin-top:0px;margin-bottom:10px;">【活动要求】 </p><p style="margin-top:0px;margin-bottom:10px;">1、听从领队的安排，遵守团队纪律，集体行动，不擅自离开穿越路线； </p><p style="margin-top:0px;margin-bottom:10px;">2、活动产生的垃圾一律带离，不采摘林中植物；</p><p style="margin-top:0px;margin-bottom:10px;">3、摒弃鄙视过度的个人主义； </p><p style="margin-top:0px;margin-bottom:10px;">4、新驴和路线不熟者不要离队伍太远，保持两人同行原则。有困难立即向领队提出。同时请大胆自我介绍，相互认识</p><p style="margin-top:0px;margin-bottom:10px;">5. 中途会安排分享环节，分享环节分为深度自我介绍+活动装备准备情况分享+户外相关的技术分享经验分享。</p></pre>', '正常拉练', '2013-03-03 09:30:00', '2013-03-03 17:30:00', '2013-02-26 21:11:00', '2013-03-02 23:00:00', '拉练讨论帖：http://sysuhiker.sinaapp.com/club/postDetail.php?postId=6', '2013-02-26 21:26:14', '1', 20),
(6, '2013.05.18.逸仙徒步常规拉练之弯直版猪龙线', '<p>集合地点:龙发厂公交站（柯木朗的下一站）（车次：83路; 345路; 346路; 494路; 534路; 535路; 564路; 夜60路可达）</p><p>集合时间：2013年05月18日早上9点30 </p><p>领队/联系人：later 136-0242-1520</p><p>活动路线：龙发厂公交站-猪仔山-凤凰山-私立华联后山-涌泉山庄-筲箕窝-观音坐莲-构麻山-日军碉堡-雷达站-龙眼洞森林公园</p><p><br /></p><p>活动强度：标准（全程山路约17km，爬升约1200米，适合正常人参加。如果太久没参加过运动的话，完成会有些辛苦。本次适当增加一些有趣的路线，会稍长。）</p><p><br /></p><p>活动说明：</p><p>1.如果没有通知，活动都会正常举行。</p><p>2.如果报了名去不了的，请第一时间通知联系人。</p><p>3.全程无补给点，请在出发前准备好午餐和零食和2.5L以上的水。</p><p>4.请按要求按格式报名，请不要空降。</p><p><br /></p><p><br /></p><p>报名说明：</p><p>新人报名请阅读：<a href="http://sysuhiker.sinaapp.com/club/postDetail.php?postId=4" target="_self">逸仙徒步活动平台使用帮助</a></p><p>活动报名页面：http://sysuhiker.sinaapp.com/joinlist.php?eventId=6（要先注册才能报名）</p><p><br /></p><p>分工安排：欢迎有经验的同学报名尾驴头驴</p><p>对讲机频率：409.925 （山里手机信号差，有的同学请都带上。）</p><p><br /></p><p>【交通指南】 地铁到天河客运站再转公交。（车次：83路; 345路; 346路; 494路; 534路; 535路; 564路; 夜60路可达）</p><p>【费用预算】 AA制。</p><p>【个人装备】</p><p><br /></p><p>建议装备：</p><p>&gt;登山鞋（运动鞋也行，垫上弹性好的鞋垫，可预防水泡，千里之行从鞋开始）；</p><p>&gt;厚袜子（防止脚掌起泡）；</p><p>&gt;护踝（防止脚踝扭伤）；</p><p>&gt;护膝（有助于保护膝盖）；</p><p>&gt;登山杖（因人而异，两条腿还是显得有些单薄了）；</p><p>&gt;头灯/手电（最好带上，防止需要走夜路）；</p><p>&gt;耐汗耐脏宽松的衣裤（人靠衣裳马靠鞍，可以降低回家途中的回头率。牛仔裤高跟鞋皮鞋裙子之类的直接劝退。）；</p><p>&gt;湿毛巾（是个好东西，好处多多，不多言）；</p><p>&gt;好的小背包（不是追求名牌，但专业性强一点地还是贴背）；</p><p>&gt;手套（山路行进攀登，荆刺野草，保护手部不被无谓划伤）；</p><p>&gt;雨具 </p><p><br /></p><p>食品安排：自带。水2.5L以上。外加午餐的干粮，和若干应急食品。 </p><p><br /></p><p>建议药物：凡士林（防擦伤）、活络油（防止脚扭伤和抽筋）、云南白药（防止关节疲劳损伤）、绿药膏（治无名虫蚁叮咬）、保济丸（突发性拉肚子），止血贴等。 </p><p><br /></p><p>免责声明：</p><p>1、本活动为非盈利性质的自助游活动并有一定的危险*，凡报名参加者均视为具有完全民事行为能力人，参加者须对自己的安全负责；凡报名者均视为已接受放弃损害赔偿 。</p><p>2、本次活动约伴人与同行驴友均为无偿提供活动的援助、支持者。如在活动中发生人身损害后果，赔偿责任领队不承担，由受损害人依据法律规定和本领队声明依法解决。</p><p>3、凡报名者均视为接受声明。代他人报名者，被代报名参加者如遭受人身损害，赔偿责任约伴人同样不承担。</p><p>4、本声明中关于免除领队赔偿责任之约定效力，同样及于同行的副领队.协助.财务。</p><p>5、启程后，本声明将自动生效并表明你接受本声明，否则，请在启程前退出本次活动。 </p><p><br /></p><p>【活动要求】 </p><p>1、听从领队的安排，遵守团队纪律，集体行动，不擅自离开穿越路线； </p><p>2、活动产生的垃圾一律带离，不采摘林中植物；</p><p>3、摒弃鄙视过度的个人主义； </p><p>4、新驴和路线不熟者不要离队伍太远，保持两人同行原则。有困难立即向领队提出。同时请大胆自我介绍，相互认识</p><p>5. 中途会安排分享环节，分享环节分为深度自我介绍+活动装备准备情况分享+户外相关的技术分享经验分享。</p><p><br /></p>', '正常拉练', '2013-05-18 09:30:00', '2013-05-18 17:30:00', '2013-05-15 19:53:00', '2013-05-17 23:00:00', '拉练讨论帖http://sysuhiker.sinaapp.com/club/postDetail.php?postId=6', '2013-05-15 19:54:15', '1', 20);


-- --------------------------------------------------------

--
-- 表的结构 `event_itemPool`
--

CREATE TABLE IF NOT EXISTS `event_itemPool` (
  `item_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `item_detail` text NOT NULL,
  `item_options` int(10) NOT NULL,
  `item_answer` varchar(10) NOT NULL DEFAULT '',
  `item_ownerId` varchar(10) NOT NULL DEFAULT '',
  `item_ownerNick` varchar(100) NOT NULL DEFAULT '',
  `item_createtime` datetime NOT NULL,
  `item_status` varchar(20) NOT NULL,
  PRIMARY KEY (`item_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- 转存表中的数据 `event_itemPool`
--

INSERT INTO `event_itemPool` (`item_id`, `item_detail`, `item_options`, `item_answer`, `item_ownerId`, `item_ownerNick`, `item_createtime`, `item_status`) VALUES
(13, '请选出以下对逸仙徒步最正确的描述：\r\nA. 逸仙徒步是一个商业户外组织      B. 逸仙徒步是一个旅行社\r\nC. 逸仙徒步是一个AA户外组织        D. 逸仙徒步给所有参加活动的人提供保姆式的照顾', 4, 'C', '1', 'later', '2014-04-19 10:18:19', '待审核'),
(2, '（判断题）防止长时间徒步疲劳，一要步姿正确，二是不要心急，三是要会走路，走小路而不走平坦的公路，既使走公路也不走平坦的中心而是走高低不平的路边。<br>A正确&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; B错误', 2, 'A', '4', '测试', '2013-01-17 21:54:09', '待审核'),
(3, '<div>(判断题)攀登岩石峭壁时，身体重心一定要落在脚上，保持面向岩壁，三点固定支撑，直立于岩壁的攀登姿势。&nbsp;</div><div>A 正确 &nbsp;B &nbsp;错误</div>', 2, 'B', '4', '测试', '2013-01-17 21:56:15', '待审核'),
(4, '<div>(判断题)户外运动经常会出现一定程度的低血糖，当人体每 100 毫升血液中血糖低于 20 毫克时，就会出现深度昏迷，即低血糖性休克。&nbsp;</div><div>A正确 &nbsp; B 错误</div>', 2, 'A', '4', '测试', '2013-01-17 21:58:37', '待审核'),
(5, '<div>&nbsp;(判断题)搭建帐篷时应选择十分干燥的地面，最好不要有任何草的覆盖。&nbsp;</div><div>A 正确 &nbsp;B 错误</div>', 2, 'A', '4', '测试', '2013-01-17 21:59:01', '待审核'),
(6, '<div>(判断题)大蒜在野外也有妙用，既能解毒，又可防止晕车晕船。&nbsp;</div><div>A：正确 B:错误</div>', 2, 'A', '4', '测试', '2013-01-17 21:59:26', '待审核'),
(7, '<div>(判断题)户外运动中睡袋经常会比较脏，清洗羽绒睡袋时宜用碱性洗涤剂。&nbsp;</div><div>A：正确 B：错误</div>', 2, 'B', '4', '测试', '2013-01-17 22:00:58', '待审核'),
(8, '<div>&nbsp;(判断题)支持外帐时要注意拉紧牵绳，使外帐绷紧，同时地钉固定应倾斜 60 度左右。&nbsp;</div><div>A：正确 B：错误</div>', 2, 'B', '4', '测试', '2013-01-17 22:01:18', '待审核'),
(9, '<div>（单选题）人类首次徒步穿越世界最大峡谷—雅鲁藏布大峡谷是在（）？&nbsp;</div><div>A. 1998年10月17日 &nbsp;B. 1998年10月18日 &nbsp;C. 1998年10月19日 &nbsp;D. 1999年10月19日</div>', 4, 'C', '4', '测试', '2013-01-17 22:02:41', '待审核'),
(10, '<div>（单选题）徒步走时应选择哪类饮料？&nbsp;</div><div>A. 清茶加盐 B. 高糖类 C. 碳酸类 D. 果汁类</div>', 4, 'A', '4', '测试', '2013-01-17 22:05:51', '待审核'),
(11, '<div>（单选）户外旅行 , 尤其是在寒冷或温差较大的沙漠地带 , 选择适宜的睡袋填充材料是非常必要的 , 这些材料中 , 羽绒相对于化纤棉的优点不包括 ( )?&nbsp;</div><div>A. 具有一定抗水性 , 湿后保持一定保温性 , 晾干快 &nbsp; &nbsp; B. 使用寿命可达 10 余年 , 比化纤棉寿命长&nbsp;</div><div>C. 保温程度高 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;D. 同等保温程度下重量最重</div>', 4, 'D', '4', '测试', '2013-01-17 22:07:09', '待审核'),
(12, '<div>（单选题）户外运动一定要注意天气变化，以下那种现象不是天气转好的标志（）？&nbsp;</div><div>A. 白天时，谷风一般自上而下吹，在夜间则正好相反，一般从峰底吹向山谷上方&nbsp;</div><div>B. 白天时，谷风一般自下而上吹，在夜间则正好相反，一般从峰顶吹向山谷下方&nbsp;</div><div>C. 傍晚日落时，在西方山谷上空出现一片片橙色或玫瑰色晚霞 ( 火烧云 )&nbsp;</div><div>D. 傍晚时山下有雾，而且天气较凉 ( 入夜寒 )&nbsp;</div>', 4, 'A', '4', '测试', '2013-01-17 22:08:35', '待审核'),
(14, '<div>(双选题)以下哪两项活动不是磨房每年都会组织的活动？</div>\r\n<div>A. 深圳百公里                 B.广州50公里</div>\r\n<div>C.东莞50公里                 D.惠州60公里</div>\r\n<div>E.中珠55公里                 F.河源40公里</div>\r\n', 6, 'BE', '1', 'later', '2014-04-19 13:41:23', '待审核'),
(15, '<div>(单选题)以下哪条户外路线被称为广东的户外毕业路线？</div>\r\n<div>A.船底顶穿越                  B.大南山穿越</div>\r\n<div>C.影古线徒步                  D.东西冲穿越</div>\r\n<div>E.大丹霞穿越</div>', 5, 'A', '1', 'later', '2014-04-19 14:06:00', '待审核'),
(16, '<div>(单选题)以下哪个山在清明前后最适合去看杜鹃花？</div>\r\n<div>A.火炉山                  B.云髻山</div>\r\n<div>C.大南山                  D.白云山</div>\r\n<div>E.天露山</div>', 5, 'E', '1', 'later', '2014-04-19 14:06:25', '待审核'),
(17, '<div>(单选题)以下哪项对拉练路线的描述是错误的？</div>\r\n<div>A.火凤线是指从火炉山走到凤凰山   B.牛木线是指牛头山走到木强水库</div>\r\n<div>C.火龙线是指火炉山到龙头山          D.牛帽线是指牛头山走到帽峰山</div>', 4, 'C', '1', 'later', '2014-04-19 14:20:27', '待审核'),
(18, '<div>(单选题)以下哪个山不在中国国家地理曾经评出来的十大非著名山峰之列？</div>\r\n<div>A.船底顶   B.武功山</div>\r\n<div>C.韭菜岭   D.丹霞山</div>', 4, 'D', '1', 'later', '2014-04-19 14:27:02', '待审核'),
(19, '<div>(单选题)户外爬山常用的地图软件是哪个？</div>\r\n<div>A.Oruxmaps   B.google map</div>\r\n<div>C.百度地图    D.高德地图</div>', 4, 'A', '1', 'later', '2014-04-19 15:13:41', '待审核'),
(20, '<div>(单选题)逸仙徒步三大是哪一年哪一月举行的？</div>\r\n<div>A.2012年3月   B.2013年6月</div>\r\n<div>C.2013年12月  D.2014年3月</div>', 4, 'C', '1', 'later', '2014-04-19 15:17:37', '待审核'),
(21, '<div>(单选题)户外爬山露营哪种灯具最好用？</div>\r\n<div>A.白光手电      B.白光头灯</div>\r\n<div>C.黄光手电      D.黄光头灯</div>', 4, 'D', '1', 'later', '2014-04-19 15:20:20', '待审核'),
(22, '<div>(单选题)关于登山杖的作用，哪项说明是错误的？</div>\r\n<div>A.登山杖分担了一部分力量，能减轻腿部受力，保护膝盖</div>\r\n<div>B.野外爬山的时候可以用登山杖来“打草惊蛇”</div>\r\n<div>C.同伴掉沟里的时候可以用登山杖辅助拉同伴起来</div>\r\n<div>D.伸长登山杖时，不可以超过STOP处</div>', 4, 'C', '1', 'later', '2014-04-19 17:47:23', '待审核');

-- --------------------------------------------------------

--
-- 表的结构 `event_joinlist`
--

CREATE TABLE IF NOT EXISTS `event_joinlist` (
  `event_joinlist_ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `event_joinlist_eventid` varchar(10) NOT NULL DEFAULT '',
  `event_joinlist_eventname` varchar(100) NOT NULL DEFAULT '',
  `event_joinlist_userid` varchar(10) NOT NULL DEFAULT '',
  `event_joinlist_username` varchar(100) NOT NULL DEFAULT '',
  `event_joinlist_usernick` varchar(100) NOT NULL DEFAULT '',
  `event_joinlist_usergender` enum('gg','mm') NOT NULL,
  `event_joinlist_userrole` varchar(100) DEFAULT '',
  `event_joinlist_userpsw` varchar(100) DEFAULT '',
  `event_joinlist_userphone` varchar(30) NOT NULL DEFAULT '',
  `event_joinlist_useremail` varchar(100) NOT NULL DEFAULT '',
  `event_joinlist_qq` varchar(20) NOT NULL,
  `event_joinlist_weiboName` varchar(100) NOT NULL,
  `event_joinlist_weiboLink` varchar(100) NOT NULL,
  `event_joinlist_useraddress` varchar(300) NOT NULL DEFAULT '',
  `event_joinlist_userurgentname` varchar(100) NOT NULL DEFAULT '',
  `event_joinlist_userurgentphone` varchar(30) NOT NULL DEFAULT '',
  `event_joinlist_usercamp` varchar(100) NOT NULL DEFAULT '0',
  `event_joinlist_usercamppad` varchar(100) NOT NULL DEFAULT '0',
  `event_joinlist_usersleepingbag` varchar(100) NOT NULL DEFAULT 'N',
  `event_joinlist_userinterphone` varchar(100) NOT NULL DEFAULT 'N',
  `event_joinlist_userbag` varchar(100) NOT NULL DEFAULT '0',
  `event_joinlist_userBurner` varchar(100) NOT NULL DEFAULT 'N',
  `event_joinlist_userpot` varchar(100) NOT NULL DEFAULT '0',
  `event_joinlist_joindate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `event_joinlist_comments` varchar(300) NOT NULL DEFAULT 'no comments',
  `event_joinlist_insurance` varchar(300) NOT NULL DEFAULT '',
  `event_joinlist_declare` varchar(10) DEFAULT '',
  `event_joinlist_assessment` varchar(10) DEFAULT '',
  `event_joinlist_status` varchar(10) NOT NULL DEFAULT '待审核',
  PRIMARY KEY (`event_joinlist_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2371 ;

--
-- 转存表中的数据 `event_joinlist`
--
