<?php


namespace Admin\Controller;


use Think\Controller;

class RoleController extends BaseController
{
    private $_model;
    protected function _initialize(){
        $this->_model = D('Role');
    }

    /**
     * 展示角色列表
     */
    public function index(){
        $rows = $this->_model->DataPage(2);
        $this->assign('lists',$rows[0]);
        $this->assign('pages',$rows[1]);
        $this->display();
    }

    /**
     * 新增角色
     */
    public function add(){
        if(IS_POST){
            //收集数据
            if($this->_model->create() === false){
                $this->error(get_errors($this->_model));
            }
            //执行添加
            if($this->_model->addRole() === false){
                $this->error(get_errors($this->_model));
            }
            //完成跳转
            $this->success('添加成功',U('index'));
        }else{
            $lists = D('Permission')->getList();
            $this->assign('permissions',json_encode($lists));
            $this->display();
        }
    }

    /**
     * 修改角色
     * @param $id
     */
    public function edit($id){
        if(IS_POST){
            //收集数据
            if($this->_model->create() === false){
                $this->error(get_errors($this->_model));
            }
            //执行修改
            if($this->_model->editRole($id) === false){
                $this->error(get_errors($this->_model));
            }
            //完成跳转
            $this->success('修改成功',U('index'));
        }else{
            //取出当前角色所关联的权限
            $this->assign('list',$this->_model->getRoleInfo($id));
            $lists = D('Permission')->getList();
            $this->assign('permissions',json_encode($lists));
            $this->display();
        }
    }

    /**
     * 删除角色
     * @param $id
     */
    public function delete($id){
        if($this->_model->deleteRole($id) === false){
            $this->error(get_errors($this->_model));
        }else{
            $this->success('删除成功',U('index'));
        }
    }
}