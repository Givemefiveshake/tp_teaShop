<?php


namespace Admin\Controller;


use Think\Controller;

class BaseController extends Controller
{
    /**
     * 根据菜单表,传入基础模版展示数据
     */
    public function __construct(){
        parent::__construct();
        $menus = D('Menu')->getMenuList();
        $this->assign('nav_menus',$menus);
    }
}