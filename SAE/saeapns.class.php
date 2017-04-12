<?php
   /**
    * Apple 应用消息推送服务
    *
    * <code>
    * <?php
    * $cert_id = 1;
    * $device_token = "xxxxxxxx xxxxxxxx xxxxxxxx xxxxxxxx xxxxxxxx xxxxxxxx xxxxxxxx xxxxxxxx";
    * 
   * $message = "测试消息";
   * $body = array(
   *     'aps' => array( 'alert' => $message , 'badge' => 1, 'sound' => 'in.caf')
   * );
   * $apns = new SaeAPNS();
   * $result = $apns->push( $cert_id , $body , $device_token );
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
  class SaeAPNS extends SaeObject
  {
      private $_accesskey = "";    
      private $_secretkey = "";
      private $_errno = SAE_Success;
      private $_errmsg = "OK";
  
      /**
       * @ignore
       */
      const baseurl = "http://push.sae.sina.com.cn";
  
      /**
       * 构造对象
       *
       */
      function __construct() {
          $this->_accesskey = SAE_ACCESSKEY;
          $this->_secretkey = SAE_SECRETKEY;
          $this->request = new SaeRequest(self::baseurl);
      }
  
      /**
       * 推送消息
       * 
       * @param int $cert_id  证书序号
       * @param array $body 消息体（包括消息、提醒声音等等），格式请参考Apple官方文档}
       * @param string $device_token 设备令牌
       * @return bool 成功返回true，失败返回false
       */
      function push($cert_id, $body, $device_token) {
          if(!is_array($body) || !isset($body['aps']['alert'])){
              $this->_errmsg = 'body must be an array';
              $this->_errno  = -1;
              return false;
          }
          $params = array();
          $params['certid'] = intval($cert_id);
          $params['token'] = trim($device_token);
          $params['ak'] = $this->_accesskey;
  
          $post = array();
          $encodings = array( 'UTF-8', 'GBK', 'BIG5' );
          if (is_string($body['aps']['alert'])) {
              $charset = mb_detect_encoding( $body['aps']['alert'] , $encodings);
              if ( $charset !='UTF-8' ) {
                  $body['aps']['alert'] = mb_convert_encoding( $body['aps']['alert'], "UTF-8", $charset);
              }
          } else if (is_array($body['aps']['alert'])) {
              if (isset($body['aps']['alert']['body'])) {
                  $charset = mb_detect_encoding( $body['aps']['alert']['body'] , $encodings);
                  if ( $charset !='UTF-8' ) {
                      $body['aps']['alert']['body'] = mb_convert_encoding( $body['aps']['alert']['body'], "UTF-8", $charset);
                  }
              }
          }
          $post['body'] = json_encode($body);
  
          return $this->postData("apple/message/push", $params, $post);
      }
  
      /**
       * 查看当天推送汇总信息
      * 
      * @param int $cert_id  证书序号
      * @return mix 成功json格式汇总信息，失败返回false
      */
     function getInfo($cert_id) {
         return $this->postData('apple/log/info', Array(
                   'certid' => intval($cert_id),
                   'ak'     => $this->_accesskey));
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
 
     private function postData($path, $args=null, $body=null) {
         try {
             $this->request->post($path, $args, $body);
         } catch (Exception $e) {
             $this->_errmsg = $e->getMessage();
             if ($e->getCode() == SaeRequest::NET_ERROR ||
                     $e->getCode() == SaeRequest::SERVER_ERROR) {
                 $this->_errno = SAE_ErrInternal;
             } else {
                 $this->_errno = SAE_ErrUnknown;
             }
 
             return False;
         }
         return True;
     }
 }