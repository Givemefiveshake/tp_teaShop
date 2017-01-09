<?php


namespace Admin\Controller;


use Think\Controller;

class MenuController extends BaseController
{
    private $_model;
    protected function _initialize(){
        $this->_model = D('Menu');
    }

    public function index(){
        $rows = $this->_model->order('lft')->select();
        $this->assign('lists',$rows);
        $this->display();
    }

    /**
     * 新增
     */
    public function add(){
        if(IS_POST){
            if(!$this->_model->create()){
                $this->error(get_errors($this->_model));
            }
            if(!$this->_model->addMenu()){
                $this->error(get_errors($this->_model));
            }
            $this->success('添加成功', U('index'));
        }else{
            $rows = $this->_model->order('lft')->select();
            $this->assign('menu',$rows);
            //获取所有权限展示在页面中
            $permissions = D('Permission')->getList();
            $this->assign('permissions', json_encode($permissions));
            $this->display();
        }
    }

    /**
     * 修改菜单
     * @param $id
     */
    public function edit($id){
        if(IS_POST){
            if(!$this->_model->create()){
                $this->error(get_errors($this->_model));
            }
            if(!$this->_model->editMenu($id)){
                $this->error(get_errors($this->_model));
            }
            $this->success('修改成功', U('index'));
        }else{
            //展示菜单分类列表
            $rows = $this->_model->order('lft')->select();
            $this->assign('menu',$rows);
            //获取基础信息以及权限信息
            $row = $this->_model->getMenuInfo($id);
            $this->assign('info',$row);
            //获取所有权限
            $permissions = D('Permission')->getList();
            $this->assign('permissions', json_encode($permissions));
            $this->display();
        }
    }

    /**
     * 删除菜单
     * @param $id
     */
    public function delete($id){
        if(!$this->_model->removeMenu($id)){
            $this->error(get_errors($this->_model));
        }
        $this->success('删除成功', U('index'));
    }
}