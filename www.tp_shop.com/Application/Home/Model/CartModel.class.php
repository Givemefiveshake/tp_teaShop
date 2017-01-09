<?php


namespace Home\Model;


use Think\Model;

class CartModel extends Model
{
    /**
     * 获取购物车表中的商品详细信息
     */
    public function getCartDetail(){
        //查询购物车中商品数量
        if(!session('userInfo')){
            $cart = cookie('cart');
        }else{
            $cart = M('Cart')->where(['user_id'=>session('userInfo.id')])->getField('goods_id,amount');
        }
        //查询商品详情
        $goods_ids = array_keys($cart);
        //如果没有商品
        if(empty($goods_ids)){
            return [
                'total_price' => 0,
                'total_number' => 0,
                'goodsLists' => '',
            ];
        }
        $goodsLists = M('Goods')->where(['id'=>['in',$goods_ids],'is_on_sale'=>1,'status'=>1])->select();
        //添加小计和数量
        $total_price = 0;
        foreach($goodsLists as $key=>$value){
            //添加一件商品的数量字段
            $value['amount'] = $cart[$value['id']];
            //添加一件商品的小计字段,number_format函数,处理数字保留小数点后几位
            $value['sub_total'] = number_format($value['shop_price']*$value['amount'],2,'.','');
            $goodsLists[$key] = $value;
            //计算所有购物车商品总价
            $total_price += $value['sub_total'];
        }
        $total_price = number_format($total_price,2,'.','');
        //计算购物车中商品总数,array_sum数组中键值相加
        $total_number = array_sum($cart);

        return [
            'total_price' => $total_price,
            'total_number' => $total_number,
            'goodsLists' => $goodsLists,
        ];
    }

    /**
     * 将cookie中的购物车数据保存到数据库中,用户登录时调用
     * 如果cookie中没有数据,则可直接返回
     * 如果有数据,如果数据库中有相同的商品数据,则覆盖数据库中的数据
     * 如果数据库中没有相同的商品,则执行添加操作
     */
    public function cookie2db(){
        if(!cookie('cart')){
            return true;
        }else{
            $cart = cookie('cart');
            $goods_ids = array_keys($cart);
            $data = [];
            foreach($cart as $goods_id=>$amount){
                $data[] = [
                    'user_id' => session('userInfo.id'),
                    'goods_id' => $goods_id,
                    'amount' => $amount
                ];
            }
            cookie('cart',null);
            if($this->where(['user_id' => session('userInfo.id'),'goods_id' => ['in',$goods_ids]])->count()){
                $this->where(['user_id' => session('userInfo.id'),'goods_id' => ['in',$goods_ids]])->delete();
                $this->addAll($data);
            }
            $this->addAll($data);
        }
        return true;
    }
}