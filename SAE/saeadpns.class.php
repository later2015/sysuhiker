<?php
   /**
    * Android 应用消息推送服务
    *
    * <code>
    * <?php
    * $appid=20001;
    * $token='BYfkQcUYULUB';
    * $title='title';
   * $msg='hello wolrd';
   * $acts="[\"2,sina.Apns,sina.Apns.MainActivity\"]";
   * $extra=array(
   *     'handle_by_app'=>'0'
   *  );
   * $adpns = new SaeADPNS();
   * $result = $adpns->push($appid, $token, $title, $msg, $acts, $extra);
   * 
   * if( $result && is_array($result) ){
   *     echo '发送成功！';
   *     var_dump( $result );
   * }
   * else {
   *     echo '发送失败。';
   *     var_dump($apns->errno(), $apns->errmsg());
   * }
   * ?>
   * </code>
   *
   * 错误码参考：
   *  - errno: 0         成功
   *  - errno: -1        信息内容为空
   *  - errno: -2        连接server http请求错误
   *  - errno: -3        server端错误
   *
   * @package sae
   *
   */
  
  class SaeADPNS extends SaeObject
  {
      private $_accesskey = "";    
      private $_secretkey = "";
      private $_errno = SAE_Success;
      private $_errmsg = "OK";
  
      /**
       * @ignore
       */
      const baseurl = "http://push.sae.sina.com.cn/android/android.php";
  
      /**
       * 构造对象
       *
       */
      function __construct() {
          $this->_accesskey = SAE_ACCESSKEY;
          $this->_secretkey = SAE_SECRETKEY;
      }
  
      /**
       * 推送消息
       * 
       * @param int $appid  SAE分配的应用序号
       * @param string $token 设备令牌
       * @param string $title 消息标题
       * @param string $msg 消息体
       * @param string $acts 跳转行为参数
       *  - ["2,app包名,Activity类名"]：跳转到APP的Activity。例如：["2,com.sina.news,com.sina.news.ui.NewContentActivity"]
       *  - ["4,URL地址"]：跳转到浏览器。例如：["4,http://www.sina.com"]
       *  - ["5,Scheme"]：通过Scheme跳转。例如：["5,sinaweibo://sendweibo"]
       * @param array  $extra 额外的传递信息 
       *  - $extra = array(
       *      'handle_by_app'=>'1'  // "1"，表示消息交由App处理。
       *    )
       * @return bool 成功返回true，失败返回false
       */
      function push($appid, $token, $title, $msg, $acts, $extra=array()) {
          $params = array();
          
          if (is_string($title) === false) {
              $this->_errmsg = 'title must be string';
              $this->_errno = -1;
              return false;
          }
          if (is_string($msg) === false) {
              $this->_errmsg = 'msg must be string';
              $this->_errno = -1;
              return false;
          }
          if (is_array($extra) === false) {
              $this->_errmsg = 'extra must be array';
              $this->_errno = -1;
              return false;
          }
          
          $params['act'] = "push";
          $params['appid'] = intval($appid);
          $params['token'] = trim($token);
          $params['ak'] = $this->_accesskey;
         $params['title'] = trim($title);
         $params['msg'] = trim($msg);
         $params['acts'] = trim($acts);
 
         if (empty($extra) === false) {
             $extra = json_encode($extra);
             $params['extra'] = $extra;
         }
 
         $ret = $this->postData($params);
         return $ret;
     }
 
     /**
      * 取得错误码
      *
      * @return int 
      * @author Elmer Zhang
      */
     public function errno() {
         return $this->_errno;
     }
 
     /**
      * 取得错误信息
      *
      * @return string 
      * @author Elmer Zhang
      */
     public function errmsg() {
         return $this->_errmsg;
     }
 
     private function postData($post) {
         $url = self::baseurl;
         $s = curl_init();
         if (is_array($post)) {
             $post = http_build_query($post);
         }
         curl_setopt($s,CURLOPT_URL,$url);
         curl_setopt($s,CURLOPT_HTTP_VERSION,CURL_HTTP_VERSION_1_0);
         curl_setopt($s,CURLOPT_TIMEOUT,5);
         curl_setopt($s,CURLOPT_RETURNTRANSFER,true);
         curl_setopt($s,CURLINFO_HEADER_OUT, true);
         curl_setopt($s,CURLOPT_POST,true);
         curl_setopt($s,CURLOPT_POSTFIELDS,$post); 
         $ret = curl_exec($s);
         $info = curl_getinfo($s);
         curl_close($s);
 
         if (empty($info['http_code'])) {
             $this->_errno = -2;
             $this->_errmsg = "can not reach push service server";
         } else if ($info['http_code'] != 200) {
             $code = $info['http_code'];
             $this->_errno = -2;
             $this->_errmsg = "httpd code: $code";
         } else {
             if ($info['size_download'] == 0) { // get MailError header
                 $this->_errno = -2;
                 $this->_errmsg = "apple push service internal error";
             } else {
                 $array = json_decode(trim($ret), true);
                 if (is_array($array) && is_int($array['code']) && $array['code'] < 0) {
                     $this->_errno = -3;
                     $this->_errmsg = $array['message'];
                     return false;
                 } else if (is_array($array) && is_int($array['code'])) {
                     $this->_errno = SAE_Success;
                     $this->_errmsg = 'OK';
                     return $array;
                 } else {
                     $this->_errno = -3;
                     $this->errmsg = "service response error";
                     return false;
                 }
             }
         }
         return false;
     }
 }
 ?>