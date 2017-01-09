<?php


namespace Home\Controller;


use Think\Controller;
use Think\Verify;

class CaptchaController extends Controller
{
    public function verify(){
        $config = [
//            'codeSet'   =>  '2345678abcdefhijkmnpqrstuvwxyzABCDEFGHJKLMNPQRTUVWXY',             // 验证码字符集合
            'codeSet'   =>  '1',             // 验证码字符集合
            'expire'    =>  1800,            // 验证码过期时间（s）
            'useCurve'  =>  true,            // 是否画混淆曲线
            'useNoise'  =>  true,            // 是否添加杂点
            'imageH'    =>  0,               // 验证码图片高度
            'imageW'    =>  0,               // 验证码图片宽度
            'length'    =>  5,               // 验证码位数
        ];
        $verify = new Verify($config);
        //生成验证码
        $verify->entry();
    }

    public function checkVerify($code){
        $verify = new Verify();
        $verify->check($code);
    }
}