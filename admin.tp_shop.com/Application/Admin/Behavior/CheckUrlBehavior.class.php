<?php
namespace Admin\Behavior;

use Think\Behavior;

class CheckUrlBehavior extends Behavior
{
    public function run(&$params)
    {
        $notCheck = C('NOT_CHECK.ANY');

        //当前访问路径
        $currentPath = MODULE_NAME.'/'.CONTROLLER_NAME.'/'.ACTION_NAME;

        if(in_array($currentPath,$notCheck)){
            return;
        }

        //判断是否登录
        $adminInfo = session('admin');
        if(!$adminInfo){
            //没有登录则检查cookie看是否有token(自动登录)
            $tokenInfo = cookie('admin');
            $adminInfo = M('Admin')
                ->where([
                    'token' => $tokenInfo['token'],
                    'token_create_time' => $tokenInfo['token_create_time']
                ])
                ->find();
            if(!$adminInfo){
                //如果cookie中也没有登录令牌,跳转到登录页面
                redirect(U('Login/login'),3,'请登录');exit;
            }
            //如果有登录令牌,将登录用户的信息保存到session中
            session('admin',$adminInfo);
            return;
        }

        //超级管理员有所有权限
        if($adminInfo['username'] === 'admin'){
            return;
        }

        //判断权限
        //已登录用户都可以看到的页面
        if(in_array($currentPath, C('NOT_CHECK.USER'))){
            return;
        }
        //从session中取出权限判断
        if(!in_array($currentPath, session('permission'))){
            //没有权限返回上一个页面
            echo '<script type="text/javascript">alert("无权访问");history.back();</script>';
            exit;
        }
    }
}