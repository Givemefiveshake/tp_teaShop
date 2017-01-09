<?php


namespace Admin\Controller;


use Think\Controller;

class AdminController extends BaseController
{
    private $_model;
    protected function _initialize(){
        $this->_model = D('Admin');
    }

    /**
     * 首页展示,分页
     */
    public function index(){
        $rows = $this->_model->selectAdmin(2);
        $this->assign('pages',$rows[1]);
        $this->assign('lists',$rows[0]);
        $this->display();
    }

    /**
     * 新增管理员
     */
    public function add(){
        if(IS_POST){
            if(!$this->_model->create()){
                $this->error(get_errors($this->_model));
            }
            if(!$this->_model->addAdmin()){
                $this->error(get_errors($this->_model));
            }
            $this->success('添加成功',U('index'));
        }else{
            //展示角色列表使用ztree插件
            $rows = M('Role')->order('sort')->select();
            $this->assign('roles',json_encode($rows));
            $this->display();
        }
    }

    /**
     * 删除管理员
     * @param $id
     */
    public function delete($id){
        M('AdminRole')->where(['admin_id' => $id])->delete();
        if($this->_model->delete($id) === false){
            $this->error(get_errors($this->_model));
        }else{
            $this->success('删除成功',U('index'));
        }
    }

    /**
     * 修改管理员信息
     * @param $id
     */
    public function edit($id){
        if(IS_POST){
            if(!$this->_model->create()){
                $this->error(get_errors($this->_model));
            }
            if($this->_model->saveAdmin($id) === false){
                $this->error(get_errors($this->_model));
            }
            $this->success('修改成功',U('index'));
        }else{
            //修改页面回显,基础admin数据和ztree展示角色数据
            $data = $this->_model->findAdmin($id);
            $rows = M('Role')->order('sort')->select();
            $this->assign('roles',json_encode($rows));
            $this->assign('rows',$data);
            $this->display();
        }
    }

    /**
     * 修改密码
     * @param $id
     */
    public function repass($id){
        if(IS_POST){
            if(!$this->_model->create()){
                $this->error(get_errors($this->_model));
            }
            if($this->_model->savePass($id) === false){
                $this->error(get_errors($this->_model));
            }
            $this->success('修改成功',U('index'));
        }else{
            $this->display();
        }
    }
}