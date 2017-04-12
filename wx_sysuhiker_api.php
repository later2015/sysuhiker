<?php
//----------------------------------------------
//-------暂时只支持文本消息的发送，随后会发布语音图片消息的发送
//-------@made by bingo---@czm
//-------我们致力于微信平台开发：http://binguo.me
//-------交流论坛：http://bbs.binguo.me/
//----------------------------------------------
//引入类文件
include ("snoopy.php");
//装载模板文件
include_once ("wx_tpl.php");
include("SAE/saemysql.class.php");
define("TOKEN", "sysuhiker");
// 微信公众账号
define("Account", "yan-sen-hiking@qq.com");
// 微信公众号登录密码  MD5加密
define("PassWord", md5("sysuhiker"));

$wechatObj = new wechatCallbackapiTest();
if (isset($_REQUEST['echostr']))
    $wechatObj -> valid();
//接口验证
elseif (isset($_REQUEST['signature'])) {
    //获取微信发送数据
    $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
    //返回回复数据
    if (!empty($postStr)) {

        //解析数据
        $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
        //发送消息方ID
        $fromUsername = $postObj -> FromUserName;
        //接收消息方ID
        $toUsername = $postObj -> ToUserName;
        //消息类型
        $fromMsgType = $postObj -> MsgType;
        //消息内容
        $fromMsgContent = trim($postObj -> Content);

        //事件消息
        if ($fromMsgType == "event") {
            //获取事件类型
            $fromEventType = $postObj -> Event;
            //订阅事件
            if ($fromEventType == "subscribe") {
                //给新关注者回复欢迎文字消息
                $msgType = "text";
                $contentStr = "Hi~我是小逸!\n欢迎关注逸仙徒步官方微信！[愉快]本微信有以下功能：\n\n1. 天气模式:发送城市名可以查询天气\n\n2.活动模式:参加过活动的认证用户会自动收到推送的最新活动消息，并且可以通过微信直接报名参加拉练活动。 \n\n3. 学习模式：通过\"芝麻开门:关键字#关键字对应的内容\"的格式发送消息，可以让小逸学会自动回复哦！\n\n4.对话模式：就是跟你随便聊啦！ \n\n 5.百科模式：通过发送“百科xxx”,可以强制查询到xxx对应的百科解释摘要，另外其他模式找不到答案的也会默认返回到百科模式。";
                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, time(), $msgType, $contentStr);
                echo $resultStr;
                exit ;
            }
        }
        //图片消息
        else if ($fromMsgType == "image") {
            //对图片信息进行专门回复
            $msgType = "text";
            $contentStr = "对不起，小逸还小，还不懂你发来的图片是什么意思::>_<::";
            $resultStr = sprintf($textTpl, $fromUsername, $toUsername, time(), $msgType, $contentStr);
            echo $resultStr;
            exit ;
        }
        //地理位置消息
        else if ($fromMsgType == "location") {
            //对地理位置信息进行专门回复
            $msgType = "text";
            $contentStr = "你好~小逸发现你送来了地理位置信息，请问你是遇到困难了需要帮助吗？有困难找警察，请拨110. \n蓝天救援队全国统一24小时公益救援热线：4006009958 \n广州蓝天救援队：020-61136119";
            $resultStr = sprintf($textTpl, $fromUsername, $toUsername, time(), $msgType, $contentStr);
            echo $resultStr;
            exit ;
        }
        //语音消息
        else if ($fromMsgType == "music") {
            //对语音信息进行专门回复
            $msgType = "text";
            $contentStr = "对不起，小逸还小，还不会说话，无法识别你发来的语音消息::>_<::";
            $resultStr = sprintf($textTpl, $fromUsername, $toUsername, time(), $msgType, $contentStr);
            echo $resultStr;
            exit ;
        }
        //文本消息
        else if ($fromMsgType == "text") {

            if (trim($fromMsgContent) === '' || similar_text($fromMsgContent, '寂寞') === 6 || similar_text($fromMsgContent, '空虚') === 6 || similar_text($fromMsgContent, '孤独') === 6) {
                //TODO
                $contentStr = "你空虚了麽?你寂寞了麽？出来参加活动呀！没活动？自己去活动平台 http://sysuhiker.cc/ 发起组织活动啊！";
            } else if (strncasecmp($fromMsgContent, "活动报名:", 13) === 0 || strncasecmp($fromMsgContent, "活动报名：", 15) === 0) {
                $contentStr = joinEvent($fromMsgContent);
            } else {
                //UTF-8下一个字长度是3
                if (strncasecmp($fromMsgContent, "芝麻开门:", 13) === 0 || strncasecmp($fromMsgContent, "芝麻开门：", 15) === 0) {
                    //机器学习,存储到kvdb中
                    if (strncasecmp($fromMsgContent, "芝麻开门:", 13) === 0)
                        $input = substr($fromMsgContent, 13);
                    else
                        $input = substr($fromMsgContent, 15);
                    $input = str_replace('＃', '#', $input);
                    if (similar_text($input, '#') != 1) {
                        $contentStr = "格式不对！请以\"芝麻开门:关键字#关键字对应的值\"的格式发送爆料信息";
                    } else {
                        $inputarr = explode('#', $input, 2);
                        //第一个#号划分key，value
                        $kvKey = $inputarr[0];
                        $kvValue = $inputarr[1];
                        $kv = new SaeKV();
                        $ret = $kv -> init();
                        if (!$kv -> add($kvKey, $kvValue)) {
                            $kvValue = $kvValue . "\nre:" . $kv -> get($kvKey);
                            $kv -> set($kvKey, $kvValue);
                        }
                        $contentStr = "多谢爆料！小逸有礼啦~";
                    }

                } else {
                    //从库里根据key找出对应的msg返回给用户，优先级，1.识别天气查询，2.从mysql数据库查询优质匹配结果。3. 从kvdb 查询机器学习的结果。
                    if (strlen($fromMsgContent) <= 30) {
                        $endStr = mb_substr($fromMsgContent, -2, 2, "UTF-8");
                        $citykey = rtrim($fromMsgContent, '天气');
                        if (strlen($citykey) > 6)
                            $citykey = rtrim($citykey, '区市');
                        $data = getWeather($citykey);
                        if (empty($data -> weatherinfo) && $endStr == '天气') {
                            $contentStr = "抱歉，没有查到\"" . $citykey . "\"的天气信息！";
                        } else if (!empty($data -> weatherinfo)) {
                            $contentStr = $data -> weatherinfo -> date_y . "\n" . $data -> weatherinfo -> city . "," . $data -> weatherinfo -> weather1 . " " . $data -> weatherinfo -> temp1 . " " . $data -> weatherinfo -> wind1 . "," . $data -> weatherinfo -> index_d . "\n\n明天\n" . $data -> weatherinfo -> weather2 . " " . $data -> weatherinfo -> temp2 . " " . $data -> weatherinfo -> wind2 . "\n\n后天\n" . $data -> weatherinfo -> weather3 . " " . $data -> weatherinfo -> temp3 . " " . $data -> weatherinfo -> wind3 . "\n\n大后天\n" . $data -> weatherinfo -> weather4 . " " . $data -> weatherinfo -> temp4 . " " . $data -> weatherinfo -> wind4;
                        } else {
                            //天气没结果，先去mysql查询
                            $contentStr = getReplyFromMySql($fromMsgContent);
                            //sql没结果则去kvdb查询
                            if (empty($contentStr)) {
                                $contentStr = getReplyFromKvdb($fromMsgContent);
                                // $kv = new SaeKV();
                                // $ret = $kv -> init();
                                // $ret = $kv -> pkrget($fromMsgContent, 1);
                                // if ($ret) {
                                // foreach ($ret as $key => $value)
                                // $contentStr = $value;
                                // } else
                                if (empty($contentStr)) {
                                    //kvdb没有匹配，去互动百科查询。
                                    $contentStr = getReplyFromWiki($fromMsgContent);
                                    if (empty($contentStr))
                                        $contentStr = "嗯嗯";
                                }
                            }
                        }
                    } else {
                        //字符串大于30的时候，表明不可能是查天气，先去mysql查询
                        $contentStr = getReplyFromMySql($fromMsgContent);
                        //sql没结果则去kvdb查询
                        if (empty($contentStr)) {
                            $contentStr = getReplyFromKvdb($fromMsgContent);
                            // $kv = new SaeKV();
                            // $ret = $kv -> init();
                            // $ret = $kv -> pkrget($fromMsgContent, 1);
                            // if ($ret) {
                            // foreach ($ret as $key => $value)
                            // $contentStr = $value;
                            // } else
                            if (empty($contentStr)) {
                                //kvdb没有匹配，去互动百科查询。
                                $contentStr = getReplyFromWiki($fromMsgContent);
                                if (empty($contentStr))
                                    $contentStr = "呵呵";
                            }
                        }
                    }
                }

            }
            //文本信息进行专门回复
            $msgType = "text";
            $resultStr = sprintf($textTpl, $fromUsername, $toUsername, time(), $msgType, $contentStr);
            echo $resultStr;
            exit ;
        } else {
            //TODO test code, need to remove
            //回复欢迎文字消息
            $msgType = "text";
            $contentStr = "我是机器人，别烦我！\n 机器人，懂不懂！";
            $resultStr = sprintf($textTpl, $fromUsername, $toUsername, time(), $msgType, $contentStr);
            echo $resultStr;
            exit ;
        }

    } else {
        echo "";
        exit ;
    }
}

//获取天气
function getWeather($cityName) {
    include ("w_data.php");
    $c_name = $w_data[$cityName];
    if (!empty($c_name)) {
        $json = file_get_contents("http://m.weather.com.cn/data/" . $c_name . ".html");
        return json_decode($json);
    } else {
        return null;
    }
}

//从kvdb中查找
function getReplyFromKvdb($key) {
    if (trim($key) === '' || empty($key)) {
        return null;
    }
    $kv = new SaeKV();
    $ret = $kv -> init();
    $ret = $kv -> pkrget($key, 1);
    if ($ret) {
        foreach ($ret as $key => $value)
            return $value;
    } else {
        //直接找不到，通过分词找
        $newkeys = filterAll($key);
        if (empty($newkeys))
            return null;
        foreach ($newkeys as $key => $value) {
            $ret = $kv -> pkrget($value, 1);
            if ($ret) {
                foreach ($ret as $key => $value)
                    return $value;
            }
        }
        return null;
    }
}

//查询mysqlDB获取答复语句 TODO
function getReplyFromMySql($key) {
    return null;
}

function getReplyFromWiki($key) {
    $key = str_replace('百科', '', $key);
    $url = "http://www.baike.com/wiki/" . urlencode($key);
    $meta = get_meta_tags($url);
    if (empty($meta['description'])) {
        //如果直接搜不到则分词再查
        $filterkeys = filter($key);
        foreach ($filterkeys as $key => $value) {
            $url = "http://www.baike.com/wiki/" . urlencode($value);
            $meta = get_meta_tags($url);
            if (!empty($meta['description']))
                return $meta['description'] . "...\n全文阅读:" . $url;
        }
        return $filterkeys;
    }
    return $meta['description'] . "...\n全文阅读:" . $url;
}

//分词功能
function filter($str) {
    //$str = "我喜欢吃柚子和雪梨";
    $seg = new SaeSegment();
    $ret = $seg -> segment($str, 1);
    // 分词失败则不分词
    if ($ret === false)
        return $str;
    //key word过滤条件
    $filter = array(95, 96, 97, 98, 99, 100, 101, 102, 110, 113, 133, 171, 190, 191, 192, 193, 194, 195, 196, 200, 211);
    foreach ($ret as $key => $value) {
        //211-名形词(具有名词功能的形容词)  95-名词 101-名处词 102-地名 96-人名 97-机构团体 99-机构团体名("北大") 100-其他专名 113-货币 200-不及物谓词(主谓结构“腰酸”“头疼”)
        //133-时间专指(“唐代”“西周”)  171-不及物谓词(谓宾结构“剃头”)  190-6  -语素字
        if (in_array($value['word_tag'], $filter)) {
            if ($value['word'] === '百科') {
                continue;
            }
            $outputArray[] = $value['word_tag'] . '=>' . $value['word'];
        }
    }
    array_multisort($outputArray, SORT_ASC, SORT_NUMERIC);
    //输出
    foreach ($outputArray as $key => $value) {
        $newArray[] = substr($value, stripos($value, '=>') + 2);
    }
    return $newArray;
    //返回一个 排好序的关键字数组

}

//分词功能
function filterAll($str) {
    //$str = "我喜欢吃柚子和雪梨";
    $seg = new SaeSegment();
    $ret = $seg -> segment($str, 1);
    // 分词失败则不分词
    if ($ret === false)
        return $str;
    //key word过滤条件
    foreach ($ret as $key => $value) {
        //211-名形词(具有名词功能的形容词)  95-名词 101-名处词 102-地名 96-人名 97-机构团体 99-机构团体名("北大") 100-其他专名 113-货币 200-不及物谓词(主谓结构“腰酸”“头疼”)
        //133-时间专指(“唐代”“西周”)  171-不及物谓词(谓宾结构“剃头”)  190-6  -语素字
        if ($value['word'] === '百科') {
            return null;
        }
        $outputArray[] = $value['word_tag'] . '=>' . $value['word'];
    }
    array_multisort($outputArray, SORT_ASC, SORT_NUMERIC);
    //输出
    foreach ($outputArray as $key => $value) {
        $newArray[] = substr($value, stripos($value, '=>') + 2);
    }
    return $newArray;
    //返回一个 排好序的关键字数组
}

//活动报名
function joinEvent($fromMsgContent) {
    //微信报名活动
    if (strncasecmp($fromMsgContent, "活动报名:", 13) === 0)
        $input = substr($fromMsgContent, 13);
    else
        $input = substr($fromMsgContent, 15);
    $input = str_replace('＃', '#', $input);
    //0-活动id，1-昵称，2-电话，3-备注
    $inputArray = explode('#', $input, 4);
    if (empty($inputArray[0]) || empty($inputArray[1]) || empty($inputArray[2])) {
        $contentStr = "请按照“活动报名:活动id#昵称#电话#备注”的格式输入活动ID和昵称和备注来进行报名！";
        return $contentStr;
    }
    $eventSql = "select event_name,event_type,event_join_endtime from event_info where event_id=$inputArray[0]";
    $db = new SaeMysql();
    $eventInfo = $db -> getLine($eventSql);
    if ($db -> errno() != 0) {
        die("Error:" . $db -> errmsg());
        $contentStr = "系统异常！暂时无法微信报名。";
    } elseif (empty($eventInfo)) {
        $contentStr = "活动ID错误。请按照 “活动报名:活动id#昵称#电话#备注” 的格式发送报名信息。";
    } else {
        $eventType = $eventInfo['event_type'];
        $eventName = $eventInfo['event_name'];
        $eventJoinEndTime = $eventInfo['event_join_endtime'];
        $now = time();
        if (similar_text($eventType, '露营') === 6) {
            $contentStr = "露营活动不允许微信报名！";
        } elseif ($now > strtotime($eventJoinEndTime)) {
            $contentStr = "活动已经截止报名了！下次请早啦！";
        } elseif (similar_text($eventType, '非户外') === 9) {
            //TODO
            $contentStr = "恭喜！活动报名成功！请准时参加活动，如不能按时参加活动，请通知活动组织者！谢谢合作！";
        } else {
            $userSql = "select * from event_hiker where user_nick='$inputArray[1]' and user_phone='$inputArray[2]'";
            $userInfo = $db -> getLine($userSql);
            if (empty($userInfo))
                $contentStr = "用户昵称和电话不匹配！请确保你已经在逸仙徒步活动平台上注册，并且确保输入的数据正确！";
            else {
                $userId = $userInfo["user_id"];
                $username = $userInfo["user_name"];
                $usernick = $userInfo["user_nick"];
                $usergender = $userInfo["user_gender"];
                $useraddress = $userInfo["user_address"];
                $userphone = $userInfo["user_phone"];
                $useremail = $userInfo["user_email"];
                $userqq = $userInfo["user_qq"];
                $userWeiboName = $userInfo["user_weiboName"];
                $userWeiboLink = $userInfo["user_weiboLink"];
                $userurgentname = $userInfo["user_urgentName"];
                $userurgentphone = $userInfo["user_urgentPhone"];
                $userrole = $userInfo["user_interest"];
                $Datetime = date("Y-m-d H:i:s");
                $comments = "(微信报名用户)" . $inputArray[3];

                $joinSql = "INSERT INTO event_joinlist (event_joinlist_eventid,
                        event_joinlist_eventname,event_joinlist_userid,
                        event_joinlist_username,event_joinlist_usernick,
                        event_joinlist_userrole,
                        event_joinlist_usergender,event_joinlist_userphone,
                        event_joinlist_useremail,event_joinlist_qq,
                        event_joinlist_weiboName,event_joinlist_weiboLink,event_joinlist_useraddress,
                        event_joinlist_userurgentname,event_joinlist_userurgentphone,
                        event_joinlist_joindate,
                        event_joinlist_comments,event_joinlist_assessment,event_joinlist_status) VALUES
                        ('$inputArray[0]',
                        '$eventName','$userId',
                        '$username','$usernick',
                        '$userrole',
                        '$usergender','$userphone',
                        '$useremail','$userqq',
                        '$userWeiboName','$userWeiboLink','$useraddress',
                        '$userurgentname','$userurgentphone',
                        '$Datetime',
                        '$comments','60','待审核')";

                $ret = $db -> runSql($joinSql);
                if ($db -> errno() != 0 || !$ret)
                    die("Error:" . $db -> errmsg());
                else
                    $contentStr = "恭喜！活动报名成功！请准时参加活动，如不能按时参加活动，请通知活动组织者！谢谢合作！";

            }

        }
    }

    return $contentStr;
}

// private function weather($n){
// include("w_data.php");
// $c_name=$w_data[$n];
// if(!empty($c_name)){
// $json=file_get_contents("http://m.weather.com.cn/data/".$c_name.".html");
// return json_decode($json);
// } else {
// return null;
// }
// }
//验证签名
class wechatCallbackapiTest {
    public function valid() {
        $echoStr = $_GET["echostr"];

        //valid signature , option
        if ($this -> checkSignature()) {
            echo $echoStr;
            exit ;
        }
    }

    private function checkSignature() {
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];

        $token = TOKEN;
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr);
        $tmpStr = implode($tmpArr);
        $tmpStr = sha1($tmpStr);

        if ($tmpStr == $signature) {
            return true;
        } else {
            return false;
        }
    }

}
