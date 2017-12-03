<?php
/**
 *
 * - 签名的方案如下：
 *
 * + 1、排除签名参数（默认是sign）
 * + 2、将剩下的全部参数，按参数名字进行字典排序
 * + 3、将排序好的参数，全部用字符串拼接起来
 * + 4、用当前日期拼接在3计算出来的字符串前，进行md5运算。
 *
 * 注意：无任何参数时，不作验签
 */

class PhalApi_Filter_SysuhikerMD5 implements PhalApi_Filter {

    protected $signName;

    public function __construct($signName = 'sign') {
        $this->signName = $signName;
    }

    public function check() {
        $allParams = DI()->request->getAll();
        if (empty($allParams)) {
            return;
        }

        $sign = isset($allParams[$this->signName]) ? $allParams[$this->signName] : '';
        unset($allParams[$this->signName]);

        $expectSign = $this->encryptAppKey($allParams);

        if ($expectSign != $sign) {
            DI()->logger->debug('Wrong Sign', array('needSign' => $expectSign));
            throw new PhalApi_Exception_BadRequest(T('wrong sign'), 6);
        }
    }

    protected function encryptAppKey($params) {
        ksort($params);//对参数名进行排序

        $paramsStrExceptSign = '';
        foreach ($params as $val) {
            $paramsStrExceptSign .= $val;
        }
        $date=date('Ymd', time());
//加上日期作为salt
        //https://www.phalapi.net/wikis/1-22.html
        DI()->logger->debug('info:'.$date.$paramsStrExceptSign);
        return md5($date.$paramsStrExceptSign);
    }
}
