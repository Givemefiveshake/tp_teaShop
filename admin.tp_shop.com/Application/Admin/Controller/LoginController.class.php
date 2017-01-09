<?php


namespace Admin\Controller;


use Think\Controller;
use Think\Verify;

class LoginController extends Controller
{
    private $_model;
    protected function _initialize(){
        $this->_model = D('Admin');
    }

    /**
     * 展示登录页面
     */
    public function login(){
        $this->display('login');
    }

    /**
     * 登录验证账号密码,保存登录ip和时间,勾选自动登录,生成登录令牌,保存登录用户的权限信息到session
     */
    public function check(){
        //验证验证码
        $this->checkVerify(I('post.verify'));

        //判断登录的账号密码
        $data = I('post.');
        if(!($re = $this->_model->where(['username' => $data['username']])->find())){
            $this->error('账号或密码错误');
        }
        $pass = md5($data['password'].$re['salt']);
        if($pass !== $re['password']){
            $this->error('账号或密码错误');
        }
        //登陆成功,保存登录ip和登录时间
        $login_info = [
            'last_login_time' => time(),
            'last_login_ip' => ip2long(get_client_ip()),
        ];
        if($this->_model->where(['id' => $re['id']])->setField($login_info) === false){
            $this->error(get_errors($this->_model));
        }
        //将登陆的用户信息存入cookie
        session('admin',$re);
        //如果勾选了保存登录信息自动登录
        if(!empty($data['remember']) && $data['remember'] == 1){
            //生成登录令牌和时间
            $token_create_time = time();
            $token = md5($token_create_time.'@!#$%^&*('. rand(0, 1000000));
            $tokenInfo = [
                'token' => $token,
                'token_create_time' => $token_create_time
            ];
            //存入用户数据,存入cookie;
            $this->_model->where(['id' => $re['id']])->setField($tokenInfo);
            cookie('admin',$tokenInfo,3600);
        }

        //取出登录用户的权限url保存到session中
        $permission = M('AdminRole')
            ->join('left join role_permission on admin_role.role_id = role_permission.role_id')
            ->join('left join Permission on role_permission.permission_id = permission.id')
            ->getField('id,path');
        session('permission',$permission);

        redirect(U('Index/index'));
    }

    /**
     * 退出
     */
    public function logout(){
        //清空登录令牌
        $admin_info = session('admin');
        M('Admin')->where(['id' => $admin_info['id']])->setField('token','');
        //清空session和cookie
        session(null);
        cookie(null);
        redirect(U('Login/login'));
    }

    /**
     * 验证码
     */
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

    public function checkVerify($captcha){
        $verify = new Verify();
        if(!$verify->check($captcha)){
            $this->error('验证码错误');
        }
    }
}