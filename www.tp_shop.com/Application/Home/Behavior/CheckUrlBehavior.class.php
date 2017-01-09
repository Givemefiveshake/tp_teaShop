<?php
namespace Home\Behavior;

use Think\Behavior;

class CheckUrlBehavior extends Behavior
{
    /**
     * 有些页面需要登录才可看到所以配置一个数组,如果当前访问的URL地址在这个数组中就跳转到登录页面
     * 为了用户体验,检查如果要跳转,记录一个cookie,
     * @param mixed $params
     */
    public function run(&$params)
    {
        //当前路径
        $currentPath = MODULE_NAME .'/'.CONTROLLER_NAME.'/'.ACTION_NAME;

        //设置需要登录才能看到的路径
        $check = C('CHECK');

        //如果是需要登录的页面,并且session没有用户数据
        if(in_array($currentPath,$check) && empty(session('userInfo'))){
            cookie('REF',$currentPath);
            redirect(U('User/login'));
            exit;
        }

        //用户登录
        //尝试从session取出用户数据
        $userInfo = session('userInfo');
        if(!$userInfo){
            //如果session中没有用户数据,则从cookie中取登录令牌
            $cookToken = cookie('cookToken');
            //有登录令牌,根据登录令牌取出用户信息保存到session
            $userInfo = M('User')->where(['token'=>$cookToken['token'],'token_create_time'=>$cookToken['token_create_time']])->find();
            session('userInfo',$userInfo);
        }
    }

}