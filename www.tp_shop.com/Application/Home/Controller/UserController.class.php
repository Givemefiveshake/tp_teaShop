<?php


namespace Home\Controller;


use Org\Util\String;
use Think\Controller;
use Think\Verify;

class UserController extends Controller
{
    private $_model;
    protected function _initialize(){
        $this->_model = D('User');
    }

    /**
     * 短信验证
     * @param $tel
     * @param $verify
     */
    public function sms($tel,$verify){
        //验证验证码
        $verifyObj = new Verify();
        if(!$verifyObj->check($verify)){
            $data = [
                'status' => 0,
                'msg' => '验证码错误',
            ];
            $this->ajaxReturn($data);
        }else{
            //验证码通过,可以发短信进行验证
            $dataSms = [
                'company' => 'my_tp_shop',
                'number' => String::randNumber(1000,9999)
            ];
            //将数据存入session,用于判断用户输入的手机验证码是否正确
            session('telcode',$dataSms['number']);
            //传入手机号和短信模版内容(来源和短信验证码)
            $data = sendSms($tel,$dataSms);
            $this->ajaxReturn($data);
        }
    }

    /**
     * 邮箱激活
     * @param $email
     * @param $token
     */
    public function active($email,$token){
        $condition = [
            'email' => $email,
            'email_active_token' => $token,
            'status' => 0,
        ];
        if($this->_model->where($condition)->setField('status',1)){
            $this->success('激活账号成功',U('Index/index'));
        }else{
            $this->error('激活账号失败',U('Index/index'));
        }
    }

    /**
     * 用户注册
     */
    public function register(){
        if(IS_POST){
            if($this->_model->create() === false){
                $this->error(get_errors($this->_model));
            }
            if($this->_model->addReg() === false){
                $this->error(get_errors($this->_model));
            }
            $this->success('注册成功',U('Index/index'));
        }else{
            $this->display('register');
        }
    }

    /**
     * 用户登录
     */
    public function login(){
        if(IS_POST){
            if($this->_model->checkLogin(I('post.')) === false){
                $this->error(get_errors($this->_model));
            }
            //登录后跳转到之前页面
            if(cookie('REF')){
                $url = U(cookie('REF'));
                cookie('REF',null);
            }else{
                $url = U('Index/index');
            }
            $this->success('登录成功',$url);
        }else{
            $this->display('login');
        }
    }

    /**
     * 用户退出登录
     */
    public function logout(){
        $id = session('userInfo.id');
        $this->_model->where(['id'=>$id])->setField('token','');
        session('userInfo',null);
        cookie('cookToken',null);
        $this->success('退出成功',U('Index/index'));
    }

    /**
     * 展示订单页面
     */
    public function order(){
        //订单数据展示
        $orders = D('Order')->where(['user_id' => getUserId()])->select();
        $this->assign('orders',$orders);
        //订单详情数据展示
        $orderDetails = M('OrderDetail')->select();
        $this->assign('orderDetails',$orderDetails);
        $this->display();
    }
}