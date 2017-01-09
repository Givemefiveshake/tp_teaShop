<?php
namespace Home\Model;

use Org\Util\String;
use Think\Model;

class UserModel extends Model
{
    /**
     * 自动验证,开启批量验证
     * @var bool
     */
    protected $patchValidate = true;
    protected $_validate = [
        ['username','require','用户名不能为空'],
        ['username','','用户名已被使用',0,'unique'],
        ['password','require','密码不能为空'],
        ['password','6,16','密码为6-16位',0,'length'],
        ['repassword','password','两次密码不一致',0,'confirm'],
        ['email','require','邮箱不能为空'],
        ['email','email','邮箱格式错误'],
        ['tel','require','手机号不能为空'],
        ['tel','/^1[34578]\d{9}/','手机号格式错误'],
        ['telcode','checkTelCode','手机验证码错误',0,'callback'],

    ];

    /**
     * 自动完成
     * @var array
     */
    protected $_auto = [
        ['create_time','time',1,'function'],
        ['salt','Org\Util\String::randString',1,'function']
    ];

    /**
     * 验证手机验证码
     * @param $code
     * @return bool
     */
    protected function checkTelCode($code){
        $s_code = session('telcode');
        session('telcode',null);
        return $s_code === $code;
    }

    /**
     * 添加用户
     */
    public function addReg(){
        //密码加盐加密保存
        $this->data['password'] = md5($this->data['password'].$this->data['salt']);
        //邮箱验证
        $address = $this->data['email'];
        $subject = '欢迎来到抖抖抖抖抖';
        $token = \Org\Util\String::randString(32);
        $url = U('User/active',['email' => $address,'token' => $token],true,true);
        $content = '<a href="'.$url.'">点击激活</a>';
        $this->data['email_active_token'] = $token;
        //发送邮件
        sendEmail($address,$subject,$content);
        //保存数据
        $this->add();
    }

    /**
     * 用户登录验证
     * @param $userInfo
     * @return bool
     */
    public function checkLogin($userInfo){
        if(!($info=$this->where(['username' => $userInfo['username']])->find())){
            $this->error = '账号或密码错误';
            return false;
        }
        $password = md5($userInfo['password'].$info['salt']);
        if($info['password'] !== $password){
            $this->error = '账号或密码错误';
            return false;
        }
        //登录成功,保存登录时间和登录ip
        $data = [
            'id' => $info['id'],
            'last_login_time' => time(),
            'last_login_ip' => get_client_ip()
        ];
        $this->save($data);
        //用户数据保存到session中
        session('userInfo',$info);

        //cookie中购物车数据保存到数据库中
        D('Cart')->cookie2db();

        //如果勾选了自动登录
        if(I('post.remember') == 1){
            $cookToken = [
                'token' => md5(\Org\Util\String::randString(32)),
                'token_create_time' =>time()
            ];
            //保存登录令牌到用户数据
            $this->where(['id'=>$info['id']])->save($cookToken);
            //保存登录令牌到cookie
            cookie('cookToken',$cookToken,3600);
        }
        return true;
    }
}