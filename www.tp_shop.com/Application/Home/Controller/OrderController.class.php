<?php


namespace Home\Controller;


use Think\Controller;

class OrderController extends Controller
{
    public function create(){
        if(IS_POST){
            //生成订单,传过来了地址address_id,支付方式payment_id
            $data = D('Order')->createOrder(I('post.'));
            if($data === false){
                $this->error(get_errors(D('Order')),U('Cart/index'));
            }
            $this->success('创建订单成功',U('User/order'));
        }else{
            //获取购物车中商品信息
            $data = D('cart')->getCartDetail();

            $this->assign('total_price',$data['total_price']);
            $this->assign('total_number',$data['total_number']);
            $this->assign('goodsLists',$data['goodsLists']);

            //获取地址信息
            $address = D('Address')->getAddress();
            $this->assign('addresses',$address);

            $this->display();
        }
    }

    /**
     * 根据选择的支付方式支付订单
     * @param $id
     */
    public function pay($id){
        //获取订单基本信息
        $order = M('Order')->where(['user_id' => getUserId(),'status' => 1])->find($id);
        if(empty($order)){
            $this->error('查无此订单');
        }
        switch($order['payment_id']){
            case 1:
                //微信支付
                $this->_wxPay($order);
                break;
            case 2:
                //支付宝支付
                break;
        }
    }

    /**
     * 微信支付
     * @param $order
     */
    private function _wxPay($order){
        vendor('wechat_sdk.include');
        $options = [
            'token'          => '', //填写你设定的token
            'appid'          => 'wx85adc8c943b8a477', //填写高级调用功能的app id, 请在微信开发模式后台查询
            'appsecret'      => '', //填写高级调用功能的密钥
            'encodingaeskey' => '', //填写加密用的EncodingAESKey（可选，传输加密时必需）
            'mch_id'         => '1228531002',  //微信支付，商户ID（可选）
            'partnerkey'     => 'a687728a72a825812d34f307b630097b',  //微信支付，密钥（可选）
            'ssl_cer'        => '', //微信支付，双向证书（可选，操作退款或打款时必需）
            'ssl_key'        => '', //微信支付，双向证书（可选，操作退款或打款时必需）
            'cachepath'      => '', //设置SDK缓存目录（可选，默认在Wechat/Cache，需写权限）
        ];
        //在项目合适的地方向SDK注入配置参数
        \Wechat\Loader::config($options);

        $price = $order['price']*100;

        //实例SDK相关的操作对象
        $pay = new \Wechat\WechatPay();
        $re = $pay->getPrepayId(null,'抖抖抖商品标题','12285321002'.$order['id'],$price,U('Order/WxPayNotify','',true,true),'NATIVE');
//        dump($pay);
//        dump($re);die;
        if(empty($re)){
            $this->display('wxpay_error');
        }else{
            $this->assign('text',base64_encode($re));
            $this->display('wxpay');
        }
    }

    /**
     * 删除超时订单
     * php index.php Order/clearTimeoutOrder
     * contab -e
     * 0 0 0 * * script
     */
    public function clearTimeoutOrder(){
        while(true){
            //删除状态为待支付,已超时15分钟的订单
            $cond = [
                'status' =>1,
                'create_time' => ['lt', time()-900]
            ];
            $order_model = D('Order');
            $count = $order_model->where($cond)->setField('status',0);

            //回收库存
            $oids = $order_model->where($cond)->getField('id',true);
            if($oids){
                //从订单详情表中取出该订单中商品信息
                $goodses = M('OrderDetail')->where(['order_id' => ['in',$oids]])->select();
                $goods_model = M('Goods');
                foreach($goodses as $goods){
                    $goods_model->where(['id'=>$goods['goods_id']])->setInc('stock',$goods['amount']);
                }
            }

            echo 'has closed '.$count.' orders';
            sleep(10);
        }


    }
}