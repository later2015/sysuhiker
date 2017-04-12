<?php
require_once ('class.phpmailer.php');
include ("class.smtp.php");
/**
 * sysuhiker邮件发送服务
 *
 * @package sae
 * @version 0.0.1
 * @author later
 */
/**
 *
 */
class EmailUtil {

    function __construct($argument) {

    }


    function sendEmail($to, $subject, $msg) {
        $emailList = "filter";//邮件帐号密码
        $result = FALSE;
        for ($i = 0; $i < 5; $i++) {
            $j = rand(0, 4);
            $ret = $this -> quickSend($to, $subject, $msg, $emailList["$j"]["emailAddress"], $emailList["$j"]["psw"]);
            if ($ret === TRUE) {
                $result = TRUE;
                break;
            } else {
                //echo "password:" . $emailList["$j"]["psw"];
                //echo "try sendmail with " . $emailList["$j"]["emailAddress"] . "</br>";
                //var_dump($mail -> errno(), $mail -> errmsg());
                continue;
            }
        }
        return $result;
    }

    public function quickSend($to, $subject, $msg, $from, $psw) {
        $msp = array("sina.com" => array("smtp.sina.com", 25, 0), "sina.cn" => array("smtp.sina.cn", 25, 0), "163.com" => array("smtp.163.com", 25, 0), "263.com" => array("smtp.263.com", 25, 0), "gmail.com" => array("smtp.gmail.com", 587, 1), "sohu.com" => array("smtp.sohu.com", 25, 0), "qq.com" => array("smtp.qq.com", 25, 0), "vip.qq.com" => array("smtp.qq.com", 25, 0), "126.com" => array("smtp.126.com", 25, 0), );
        $mail = new PHPMailer();
        //实例化
        $mail -> IsSMTP();
        // 启用SMTP
        $domain = str_replace("@","",strstr($from, "@"));
        
//        $mail -> Host = "smtp.163.com";
        $mail -> Host = $msp[$domain][0];
        //SMTP服务器 以163邮箱为例子
        $mail -> Port = $msp[$domain][1];
        //邮件发送端口
        $mail -> SMTPAuth = true;
        //启用SMTP认证

        $mail -> CharSet = "UTF-8";
        //字符集
        $mail -> Encoding = "base64";
        //编码方式

        $mail -> Username = $from;
        //你的邮箱
        $mail -> Password = $psw;
        //你的密码
        $mail -> Subject = $subject;
        //邮件标题

        $mail -> From = $from;
        //发件人地址（也就是你的邮箱）
        
        $mail -> FromName = "逸仙徒步";
        //发件人姓名

        $mail -> AddAddress($to, "亲");
        //添加收件人（地址，昵称）

        //$mail -> AddAttachment('xx.xls', '我的附件.xls');
        // 添加附件,并指定名称
        
        $mail -> IsHTML(true);
        //支持html格式内容
        
        //$mail -> AddEmbeddedImage("logo.jpg", "my-attach", "logo.jpg");
        //设置邮件中的图片
        
        $mail -> Body = $msg;
        //邮件主体内容

        //发送
        if (!$mail -> Send()) {
            echo "Mailer Error: " . $mail -> ErrorInfo;
            return false;
        } else {
            //echo "Message sent!";
            return TRUE;
        }

    }

}
