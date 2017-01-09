<?php


namespace Admin\Controller;


use Think\Controller;

class GoodsCategoryController extends BaseController
{
    private $_model;

    protected function _initialize(){
        $this->_model = D('GoodsCategory');
    }

    /**
     * 首页展示分类数据
     */
    public function index(){
        //获取数据
        $rows = $this->_model->getAllData();
        //分配数据
        $this->assign('lists',$rows);
        //显示页面
        $this->display();
    }

    /**
     * 新增分类
     */
    public function add(){
        if(IS_POST){
            if(!$this->_model->create()){
                $this->error(get_errors($this->_model));
            }
            if(!$this->_model->addData()){
                $this->error(get_errors($this->_model));
            }
            $this->success('添加成功', U('index'));
        }else{
            //获取所有分类数据
            $rows = $this->_model->order('lft')->select();
            //分配数据
            $this->assign('category',$rows);
            //显示页面
            $this->display('add');
        }
    }

    /**
     * 删除一条分类
     * 如果分类下有数据则不能删除
     */
    public function delete($id){
        if(!$this->_model->deleteData($id)){
            $this->error(get_errors($this->_model));
        }
        $this->success('删除成功', U('index'));
    }

    /**
     * 编辑商品分类
     * @param $id
     */
    public function edit($id){
        if (IS_POST) {
            //收集数据
            if ($this->_model->create() === false) {
                $this->error(get_errors($this->_model));
            }
            //执行保存
            if ($this->_model->saveCategory() === false) {
                $this->error(get_errors($this->_model));
            }
            //完成跳转
            $this->success('编辑成功', U('index'));
        } else {
            //取出所有的商品分类
            //获取数据
            $rows = $this->_model->getAllData();
            //分配数据
            array_unshift($rows,['id'=>0,'name'=>'顶级分类']);
            $this->assign('category',$rows);
            $this->assign('info', $this->_model->find($id));
            $this->display('edit');
        }
    }
}