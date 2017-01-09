<?php


namespace Admin\Controller;


use Think\Controller;

class BrandController extends BaseController
{
    private $_model;

    /**
     * 初始化操作
     * 1.标题变量,传给所有视图
     * 2.实例化所有方法都会用到的_model对象
     */
    public function _initialize(){
        $titles = [
            'index' => '品牌管理',
            'add' => '添加品牌'
        ];
        $title = isset($titles[ACTION_NAME])?$titles[ACTION_NAME]:'品牌管理';
        $this->assign('title',$title);
        //实例化_model对象
        $this->_model = D('Brand');
    }

    /**
     * 首页显示数据
     */
    public function index(){
        //获取数据
        $rows = $this->_model->getPageData();
        //传递数据
        $this->assign('rows',$rows);
        //显示页面
        $this->display('index');
    }

    /**
     * 添加数据
     */
    public function add(){
        if(IS_POST){
            if(!$this->_model->create()){
                //如果收集数据失败则返回
                $this->error(get_errors($this->_model));
            }
            //收集数据成功,则执行添加
            if(!$this->_model->add()){
                //如果添加数据失败则返回首页
                $this->error(get_errors($this->_model));
            }else{
                $this->success('添加成功',U('index'));
            }
        }else{
            //显示添加页面
            $this->display('add');
        }
    }

    /**
     * @param $id
     * 修改数据
     */
    public function edit($id) {
        if (IS_POST) {
            if ($this->_model->create() === false) {
                //收集数据失败返回错误信息
                $this->error(get_errors($this->_model));
            }

            if ($this->_model->save() === false) {
                //修改数据信息失败则返回错误信息
                $this->error(get_errors($this->_model));
            }else{
                //修改成功则返回首页
                $this->success('修改成功', U('index'));
            }
        } else {
            //获取品牌信息
            $row = $this->_model->find($id);
            //传递数据
            $this->assign('row', $row);
            //展示视图
            $this->display('add');
        }
    }

    /**
     * @param $id
     * 删除数据,即将status字段的值设置为-1
     */
    public function remove($id) {
        if ($this->_model->where(['id' => $id])->setField('status', -1) === false) {
            //通过id拿到要删除的数据,并进行修改,如果没拿到则返回错误信息
            $this->error(get_errors($this->_model));
        } else {
            $this->success('删除成功', U('index'));
        }
    }
}