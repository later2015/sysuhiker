<?php

header('Content-Type:text/html;charset=utf-8');
//避免输出乱码

function httpPost($url, $parms, $jsonpostData) {
    $url = $url . $parms;
    if (($ch = curl_init($url)) == false) {
        throw new Exception(sprintf("curl_init error for url %s.", $url));
    }
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    //curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 600); SAE 不支持这个参数
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonpostData);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($ch, CURLOPT_POST, 1);
    //set post的值
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8'));

    $postResult = @curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if ($postResult === false || $http_code != 200 || curl_errno($ch)) {
        $error = curl_error($ch);
        curl_close($ch);
        throw new Exception("HTTP POST FAILED:$error");
    } else {
        // $postResult=str_replace("\xEF\xBB\xBF", '', $postResult);
        switch (curl_getinfo($ch, CURLINFO_CONTENT_TYPE)) {
            case 'application/json' :
                $postResult = json_decode($postResult);
                break;
        }
        curl_close($ch);
        return $postResult;
    }
    
}


$test=array("gethikerinfo","hikerlogin");
foreach ($test as $key => $value) {
	runtest($value);
}


function runtest($p){
   //$postUrl = "http://localhost/sysuhiker/1/api/appAPI.php";
   $postUrl = "http://sysuhiker.cc/api/appAPI.php";
   //   $postUrl = "http://120.24.69.76/api/appAPI.php"; //prod
    switch ($p) {
    case 'gethikerinfo':        //获取用户信息
        echo "<br><h1>获取用户的详细信息:</h1><br>";
        $jsonpostData = json_encode(array('username' => 'later','email' => 'later.h.p@qq.com','user_id' => 1, 'key' => md5('sysuhiker')));
    	$parms = "?action=gethikerinfo";
        break;
    case 'geteventlist':        //获取用户信息
	    echo "<br><h1>获取活动列表信息:</h1><br>";
		$parms = "?action=geteventlist";
	    break;
    case 'hikerlogin':
        echo "<br><h1>用户登录:</h1><br>";
        //获取用户信息
        $jsonpostData = json_encode(array('username' => 'admin', 'password' => md5('admin')));
    $parms = "?action=hikerlogin";
        break;                
    default:
        
        break;
}

echo "request:<br>";
echo "URL:".$postUrl.$parms."<br>";
print_r(urldecode($jsonpostData));
$res = httpPost($postUrl, $parms, $jsonpostData);
echo "<br>respone:<br>";
print_r(urldecode($res));
}

?>