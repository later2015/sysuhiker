<?php 
//----------------------------------------------
//---主动向用户推送消息
//----------------------------------------------
//引入类文件
    $kv = new SaeKV();
    // 初始化KVClient对象
    $ret = $kv->init();
        // 循环获取所有key-values       
    $ret = $kv->pkrget('', 100);     
    while (true) {                    
        var_dump($ret);                       
        end($ret);                                
        $start_key = key($ret);
        $i = count($ret);
        if ($i < 100) break;
        $ret = $kv->pkrget('', 100, $start_key);
    }
    
    echo "<br>+++++";
    $input='上个厕所';
    $output=filterAll($input);
    var_dump($output);
    
    function getReplyFromKvdb($key) {
    $kv = new SaeKV();
    $ret = $kv -> init();
    $ret = $kv -> pkrget($fromMsgContent, 1);
    if ($ret) {
        foreach ($ret as $key => $value)
            return $value;
    } else {
        return 'this is the else part';
        //直接找不到，通过分词找
        $newkeys = filterAll($key);
        if(empty($newkeys))
            return '分词是没问题的！';
        //TODO
        foreach ($newkeys as $key => $value) {
            $ret = $kv -> get($value, 1);
            if ($ret) {
                foreach ($ret as $key => $value)
                    return $value;
            }
        }
        return null;
    }
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