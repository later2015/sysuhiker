<?php
// include("class.phpmailer.php"); //下载phpmailer并include两个文件
// include("class.smtp.php");
//
// $mail = new PHPMailer();     //得到一个PHPMailer实例
// $mail->CharSet = "utf-8"; //设置采用utf-8中文编码(内容不会乱码)
// $mail->IsSMTP();                    //设置采用SMTP方式发送邮件
// $mail->Host = "smtp.qq.com ";    //设置邮件服务器的地址(若为163邮箱，则是smtp.163.com)
// $mail->Port = 25;                           //设置邮件服务器的端口，默认为25
// $mail->From     = "hiker_cc@qq.com"; //设置发件人的邮箱地址
// $mail->FromName = "收件人姓名";           //设置发件人的姓名(可随意)
// $mail->SMTPAuth = true;                   //设置SMTP是否需要密码验证，true表示需要
//
// $mail->Username=" 发件人 ";
//
// $mail->Password = "iqnvaesayjqeecih";
// $mail->Subject = "你好啊";    //主题
// $mail->AltBody = "text/html";                                // optional, comment out and test
// $mail->Body = "你的邮件的内容";      //内容
// $mail->IsHTML(true);
// //$mail->WordWrap = 50;                                 //设置每行的字符数
// $mail->AddReplyTo(" 回复地址 ","from");     //设置回复的收件人的地址(from可随意)
// $mail->AddAddress("448273866@qq.com","to");     //设置收件的地址(to可随意)
//
// echo $mail->Send();

require_once ('class.phpmailer.php');
include("class.smtp.php");
//载入PHPMailer类

$mail = new PHPMailer();
//实例化
$mail -> IsSMTP();
// 启用SMTP
$mail -> Host = "smtp.163.com";
//SMTP服务器 以163邮箱为例子
$mail -> Port = 25;
//邮件发送端口
$mail -> SMTPAuth = true;
//启用SMTP认证

$mail -> CharSet = "UTF-8";
//字符集
$mail -> Encoding = "base64";
//编码方式

$mail -> Username = "sysuhiker@163.com";
//你的邮箱
$mail -> Password = "sysuhiker2017";
//你的密码
$mail -> Subject = "你好";
//邮件标题

$mail -> From = "sysuhiker@163.com";
//发件人地址（也就是你的邮箱）
$mail -> FromName = "月光光";
//发件人姓名

$address = "448273866@qq.com";
//收件人email
$mail -> AddAddress($address, "亲");
//添加收件人（地址，昵称）

//$mail -> AddAttachment('xx.xls', '我的附件.xls');
// 添加附件,并指定名称
$mail -> IsHTML(true);
//支持html格式内容
//$mail -> AddEmbeddedImage("logo.jpg", "my-attach", "logo.jpg");
//设置邮件中的图片
$mail -> Body = 'testttttttttttt';
//邮件主体内容
    $msp = array("sina.com" => array("smtp.sina.com", 25, 0), "sina.cn" => array("smtp.sina.cn", 25, 0), "163.com" => array("smtp.163.com", 25, 0), "263.com" => array("smtp.263.com", 25, 0), "gmail.com" => array("smtp.gmail.com", 587, 1), "sohu.com" => array("smtp.sohu.com", 25, 0), "qq.com" => array("smtp.qq.com", 25, 0), "vip.qq.com" => array("smtp.qq.com", 25, 0), "126.com" => array("smtp.126.com", 25, 0), );
      
      $domain="sina.com";
echo "Message sent!".$msp[$domain][0];
//发送
// if (!$mail -> Send()) {
    // echo "Mailer Error: " . $mail -> ErrorInfo;
// } else {
    // echo "Message sent!".strstr( 'abc@jb51.net', '@'+1);
//     
// }
?>