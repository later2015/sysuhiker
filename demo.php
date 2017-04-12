<?php 
//----------------------------------------------
//-------暂时只支持文本消息的发送，随后会发布语音图片消息的发送
//-------@made by bingo---@czm
//-------我们致力于微信平台开发：http://binguo.me
//-------交流论坛：http://bbs.binguo.me/
//----------------------------------------------
//引入类文件
include("snoopy.php");
// 微信公众账号
 define("Account", "yat-sen-hiking@qq.com");
// 微信公众号登录密码  MD5加密
 define("PassWord", md5("sysuhiker"));
 //实例化
	$moni = new user_remote();
	$moni ->login();   
	//$fakeId标识了你给谁发消息
	$fakeId =  $moni->getFakeId(101);
	$content = "这是我主动发的消息哦";
    foreach($fakeId as $obj){
         $res = $moni->sendTextMsg($obj->fakeId,$content);
         print_r($res);
    }
	//$res = $moni->sendTextMsg($obj->fakeId,$content);
	//print_r($res);
class user_remote{
	
	//每次登录都的token值
	protected $token = "sysuhiker";
	// 模拟登录
	public function login(){
		$snoopy = new Snoopy(); 
		$submit = "http://mp.weixin.qq.com/cgi-bin/login?lang=zh_CN";
		$post["username"] = Account;
		$post["pwd"] = PassWord;
		$post["f"] = "json";
		$snoopy->submit($submit,$post);
		//取出token
		$rs = json_decode($snoopy->results);
		
		$this->token = str_replace('=','',substr($rs->ErrMsg,-10));		//根据返回消息取得10位的token
		
		$cookie = '';
		foreach ($snoopy->headers as $key => $value) {
			$value = trim($value);
			if(strpos($value,'Set-Cookie: ') || strpos($value,'Set-Cookie: ') === 0){
				$tmp = str_replace("Set-Cookie: ","",$value);
				$tmp = str_replace("Path=/","",$tmp);
				$cookie .= $tmp.';';
			}
		}
		if(!$cookie){
			$this->login();
		}else{
			$this->write("cookie.log",$cookie);
			return $cookie;
		}
	}
	// 主动推送信息
	public function sendTextMsg($fakeId,$content){
	    //echo "fakeID:".$fakeId;
		$cookie = $this->read('cookie.log');
		$send_snoopy = new Snoopy(); 
		$send_snoopy->agent = "(Mozilla/5.0 (Windows NT 5.1; rv:19.0) Gecko/20100101 Firefox/19.0)"; //伪装浏览器  
		$send_snoopy->referer = "http://mp.weixin.qq.com/cgi-bin/singlemsgpage?token=".$this->token."&fromfakeid=".$fakeId."&msgid=&source=&count=20&t=wxm-singlechat&lang=zh_CN"; //伪装来源页地址 http_referer  
		$send_snoopy->rawheaders['Cookie'] = $cookie;
		$send_snoopy->rawheaders["Pragma"] = "no-cache"; //cache 的http头信息  
		$send_snoopy->rawheaders["Host"] = "mp.weixin.qq.com"; 
		$post = array();
		$post['tofakeid'] = $fakeId;
		$post['type'] = 1;
		$post['content'] = $content;
		$post['token'] = $this->token;
		$post['error'] = false;
		$post['ajax'] = 1;
		$submit = "http://mp.weixin.qq.com/cgi-bin/singlesend?t=ajax-response";
		$r1 = $send_snoopy->submit($submit,$post);
		var_dump($r1);
		
		$result = $send_snoopy->results;
		// echo "\r\ntoken2:".$this->token;
        //echo "\r\ncookie2:".$cookie;
        //echo "\r\nsubmit2:".$submit;
		if($result['ret'] != 0){
			$cookie = $this->login();
			$this->sendTextMsg($fakeId,$content);
		}else{
			return $result;
		}
	}
	//写文件
	public function write($filename,$content){
		//SAE 协调
		$prefix='saemc://';
		
		$fp = file_put_contents($prefix.$filename,$content);
	}
	// 读文件
	public function read($filename){
		$filename='saemc://'.$filename;
		if(file_exists($filename)){
		$data = '';
		$data = file_get_contents($filename);
		if($data){
			$send_snoopy = new Snoopy(); 
			$send_snoopy->rawheaders['Cookie'] = $data;
			$submit = "http://mp.weixin.qq.com/cgi-bin/getcontactinfo?t=ajax-getcontactinfo&lang=zh_CN&fakeid=";
			$send_snoopy->submit($submit,array());
			$result = json_decode($send_snoopy->results,1);
			if(!$result){
				return $this->login();
			}else{
				return $data;
			}
			
		 }
		}
	}
	
	//采集fakeId 取出好友信息(fakeid)
	//$groupid是分组的ID 未分组对应0
	//=============
	//  未分组 ----  0
	//  黑名单 ----  1
	//  星标组 ----  2
	//  自己建立的组从---100开始
	//=============
	public function getFakeId($groupid = 0){
		$snoopy = new Snoopy(); 
		$get = array();
		$cookie = $this->read('cookie.log');
		$submit="http://mp.weixin.qq.com/cgi-bin/contactmanagepage?t=wxm-friend&token=".$this->token."&lang=zh_CN&pagesize=100&pageidx=0&type=0&groupid=".$groupid;
		$snoopy->rawheaders['Cookie'] = $cookie;
		$snoopy->rawheaders["Pragma"] = "no-cache"; //cache 的http头信息  
		$snoopy->rawheaders["Host"] = "mp.weixin.qq.com"; 
		$snoopy->fetch($submit);
		//$snoopy->results   就是取到的返回页面HTML 对其进行处理
		$nfd[0]	=	'|<\!DOCTYPE\s+HTML>.*?<script\s+id=\"json-friendList\"\s+type=\"json\/text\">|Uis';
		$nfd[1]	=	'|<script\s+type=\"text\/javascript\">.*?<\/script>|Uis';
		$nfd[2]	=	'|<\/script>|Uis';
		$nfd[3]	=	'|\[|Uis';
		$nfd[4]	=	'|\]|Uis';	
		$nrt[0]	=	'';
		$nrt[1]	=	'';
		$nrt[2]	=	'';
		$nrt[3]	=	'[';
		$nrt[4]	=	']';
		$res = preg_replace($nfd, $nrt, $snoopy->results);
		//
		$res = strip_tags($res);
		$arr = json_decode(trim($res));
		//echo "该分组共".count($arr)."个好友";
		//echo "\r\ntoken:".$this->token;
		//echo "\r\ncookie:".$cookie;
		//echo "\r\nsubmit:".$submit;
		//对json对象进行格式化
		//echo "<pre>" ;
		print_r($arr);
		//echo "</pre>";
		//$arr=get_object_vars($arr);
		return $arr;
		
	}
	
}
