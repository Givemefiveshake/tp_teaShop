<?php


namespace Home\Controller;


use Think\Controller;

class QrcodeController extends Controller
{
    /**
     * 生成二维码
     * @param $text
     */
    public function index($text){
        $text = base64_decode($text);
        //引入二维码文件
        vendor('qrcode.phpqrcode');
        \QRcode::png($text);
    }
}