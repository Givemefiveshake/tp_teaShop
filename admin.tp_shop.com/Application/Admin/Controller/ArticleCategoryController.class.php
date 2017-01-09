<?php


namespace Admin\Controller;


use Think\Controller;

class ArticleCategoryController extends BaseController
{
    private $_category;

    protected function _initialize(){
        $this->_category = D('article_category');
    }
    /**
     * 显示文章分类列表
     */
    public function index(){
        //获取数据
        $data = $this->_category->where(['category_status' => ['gt',-1]])->order('category_sort')->select();
        //分配数据
        $this->assign('lists',$data);
        //展示页面
        $this->display();
    }

    /**
     * 新增分类
     */
    public function add(){
        if(IS_POST){
            if(!$this->_category->create()){
                $this->error(get_errors($this->_category));
            }
            if(!$this->_category->add()){
                $this->error(get_errors($this->_category));
            }else{
                $this->success('新增成功',U('index'));
            }

        }else{
            //展示页面
            $this->display('add');
        }
    }

    /**
     * @param $category_id
     * 根据id编辑分类
     */
    public function edit($category_id){
        if(IS_POST){
            if(!$this->_category->create()){
                $this->error(get_errors($this->_category));
            }
            if($this->_category->save() === false){
                $this->error(get_errors($this->_category));
            }else{
                $this->success('修改成功',U('index'));
            }
        }else{
            //获取数据
            $row = $this->_category->find($category_id);
            //分配数据
            $this->assign('info',$row);
            //显示页面
            $this->display('edit');
        }
    }

    /**
     * @param $category_id
     * 根据id删除分类
     */
    public function delete($category_id){
        if($this->_category->where(['category_id' => $category_id])->setField('category_status',-1) === false){
            //如果删除文章分类失败
            $this->error(get_errors($this->_category));
        }else{
            //成功返回首页
            $this->success('删除成功',U('index'));
        }
    }
}