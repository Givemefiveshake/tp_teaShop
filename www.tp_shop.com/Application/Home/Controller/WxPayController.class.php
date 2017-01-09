<?php


namespace Home\Controller;


use Think\Controller;

class WxPayController extends Controller
{
    public function index(){
        vendor('wechat_sdk.include');
        $options = [
            'token'          => '', //填写你设定的token
            'appid'          => 'wx85abc8c943b8a477', //填写高级调用功能的app id, 请在微信开发模式后台查询
            'appsecret'      => '', //填写高级调用功能的密钥
            'encodingaeskey' => '', //填写加密用的EncodingAESKey（可选，传输加密时必需）
            'mch_id'         => '12285321002',  //微信支付，商户ID（可选）
            'partnerkey'     => 'a6877728a72a825812d34f307b630097b',  //微信支付，密钥（可选）
            'ssl_cer'        => '', //微信支付，双向证书（可选，操作退款或打款时必需）
            'ssl_key'        => '', //微信支付，双向证书（可选，操作退款或打款时必需）
            'cachepath'      => '', //设置SDK缓存目录（可选，默认在Wechat/Cache，需写权限）
        ];
        //在项目合适的地方向SDK注入配置参数
        \Wechat\Loader::config($options);

        //实例SDK相关的操作对象
        $pay = new \Wechat\WechatPay();
        $re = $pay->getPrepayId(null,'抖抖抖商品标题','111',1,U('Order/WxPayNotify','',true,true),'NATIVE');
//        dump($pay);
//        dump($re);die;

        //引入二维码文件
        vendor('qrcode.phpqrcode');
        \QRcode::png($re);

    }
}