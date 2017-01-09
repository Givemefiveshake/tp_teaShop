<?php


namespace Admin\Controller;



use Think\Controller;

class PermissionController extends BaseController
{
    private $_model;
    protected function _initialize(){
        $this->_model = D('Permission');
    }

    /**
     * 展示权限列表
     */
    public function index(){
        $rows = $this->_model->order('lft')->select();
        $this->assign('lists',$rows);
        $this->display();
    }

    /**
     * 添加权限
     */
    public function add(){
        if(IS_POST){
            if(!$this->_model->create()){
                $this->error(get_errors($this->_model));
            }
            if(!$this->_model->addPermission()){
                $this->error(get_errors($this->_model));
            }
            $this->success('添加成功', U('index'));
        }else{
            $rows = $this->_model->order('lft')->select();
            $this->assign('permission',$rows);
            $this->display();
        }
    }

    /**
     * 编辑权限
     * @param $id
     */
    public function edit($id){
        if(IS_POST){
            if(!$this->_model->create()){
                $this->error(get_errors($this->_model));
            }
            if(!$this->_model->editPermission()){
                $this->error(get_errors($this->_model));
            }
            $this->success('修改成功', U('index'));
        }else{
            $rows = $this->_model->order('lft')->select();
            $this->assign('permission',$rows);
            $this->assign('info',$this->_model->find($id));
            $this->display();
        }
    }

    /**
     * 删除权限
     * @param $id
     */
    public function delete($id){
        if(!$this->_model->removePermission($id)){
            $this->error(get_errors($this->_model));
        }
        $this->success('删除成功', U('index'));
    }
}