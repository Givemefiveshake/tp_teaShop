<?php


namespace Home\Controller;


use Think\Controller;

class CartController extends Controller
{
    /**
     * 展示购物车
     * 登录展示数据库中的购物车数据
     * 未登录则展示cookie中的数据
     */
    public function index(){
        $data = D('Cart')->getCartDetail();

        $this->assign('total_price',$data['total_price']);
        $this->assign('total_number',$data['total_number']);
        $this->assign('goodsLists',$data['goodsLists']);
        $this->display();
    }

    /**
     * @param $goods_id
     * @param $amount
     * 判断用户是否登录,没有登录则将商品信息保存到cookie,在用户登录时存入数据库
     * 用户已登录,则需将商品信息与数据库中的购物车数据做比较,如果有这件商品则数量+$amount
     * $cart = ['$goods_id'=>'$amount']
     *
     */
    public function addCart($goods_id,$amount){
        if(!session('userInfo')){
            //判断cookie中是否已有商品,有则再传过来的时候商品数增加,没有则显示商品并存入cookie
            $cart = cookie('cart');
            if(isset($cart[$goods_id])){
                $cart[$goods_id] += $amount;
            }else{
                $cart[$goods_id] = $amount;
            }
            cookie('cart',$cart,604800);
        }else{
            //已登录判断订单库中是否有该商品
            $count = M('Cart')->where(['user_id'=>session('userInfo.id'),'goods_id'=>$goods_id])->count();
            if($count){
                M('Cart')->where([['user_id'=>session('userInfo.id'),'goods_id'=>$goods_id]])->setInc('amount',$amount);
            }else{
                $data = [
                    'user_id' => session('userInfo.id'),
                    'goods_id' => $goods_id,
                    'amount' => $amount,
                ];
                M('Cart')->add($data);
            }
        }

        $this->success('添加成功',U('Cart/index'));
    }
}