<?php


namespace Home\Model;


use Think\Model;

class OrderModel extends Model
{
    /**
     * 使用事物
     * 创建订单表
     * 创建订单详情表
     * 判断库存是否足够,足够再删除库存
     * 清空购物车
     * @param $data
     * @return array|bool
     */
    public function createOrder($data){
        //开启事物
        $this->startTrans();

        $address_id = $data['address_id'];
        $payment_id = $data['payment_id'];
        $price = $data['price'];
        $user_id = getUserId();

        //获取地址信息
        $address = M('Address')->where(['id' => $address_id, 'user_id' => $user_id])->find();
        if(empty($address)){
            $this->error = '收货地址不存在';
            $this->rollback();
            return false;
        }
        //得到支付方式
        switch($payment_id){
            case 1:
                $payment_name = '微信支付';break;
            case 2:
                $payment_name = '支付宝';break;
            case 3:
                $payment_name = '银联支付';break;
            case 4:
                $payment_name = '货到付款';break;
        }
        //拼接订单表数据
        $data = [
            'user_id' => $user_id,
            'name' => $address['name'],
            'province_name' => $address['province_name'],
            'city_name' => $address['city_name'],
            'area_name' => $address['area_name'],
            'detail_address' => $address['detail_address'],
            'tel' => $address['tel'],
            'price' => $price,
            'payment_id' => $payment_id,
            'payment_name' => $payment_name,
            'create_time' => time(),
        ];
        //添加到订单表
        if(!$order_id = $this->add($data)){
            $this->error = '添加订单失败';
            $this->rollback();
            return false;
        }

        //获取购物车中的商品数据
        $cart = D('Cart')->getCartDetail();
        $cond = [];
        foreach($cart['goodsLists'] as $value){
            //拼接订单详情数据
            $cond[] = [
                'id' => $value['id'],
                'stock' => ['lt',$value['amount']],
            ];
        }
        $str = M('Goods')->where($cond)->getField('id,name');
        //判断库存
        if(count($str)){
            $this->error = implode(',',$str).'库存不足';
            $this->rollback();
            return false;
        }
        //准备订单详情数据
        $orderDetail = [];
        foreach($cart['goodsLists'] as $value){
            //商品表中减去库存
            if(M('Goods')->where(['id'=>$value['id']])->setDec('stock',$value['amount']) === false){
                $this->error = '删除库存失败';
                $this->rollback();
                return false;
            }
            //拼接订单详情数据
            $orderDetail[] = [
                'order_id' => $order_id,
                'goods_id' => $value['id'],
                'goods_name' => $value['name'],
                'goods_price' => $value['shop_price'],
                'amount' => $value['amount'],
                'logo' => $value['logo'],
                'sub_total' => $value['sub_total']
            ];
        }
        //添加到订单详情表
        if(!($orderDetail_id = M('OrderDetail')->addAll($orderDetail))){
            $this->error = '添加订单详情失败';
            $this->rollback();
            return false;
        }

        //清除购物车
        if(M('Cart')->where(['user_id' => $user_id,'goods_id'])->delete() === false){
            $this->error = '清空购物车失败';
            $this->rollback();
            return false;
        }

        //关闭事物
        $this->commit();
        return true;
    }
}