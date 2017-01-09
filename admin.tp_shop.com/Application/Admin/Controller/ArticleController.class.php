<?php


namespace Admin\Controller;


use Think\Controller;

class ArticleController extends BaseController
{
    private $_model;


    protected function _initialize(){
        $this->_model = D('article');
    }

    /**
     * 显示文章首页,做分页
     */
    public function index(){
        //获取数据
        $data = $this->_model->getPageResult(5);
        //分配数据
        $this->assign('lists',$data[1]);
        $this->assign('pages',$data[0]);
        //展示页面
        $this->display();
    }

    /**
     * 添加文章
     */
    public function add(){
        if(IS_POST){
            //接收数据
            $data = $this->_model->create();
            if(!$data){
                //如果接受的数据错误
                $this->error(get_errors($this->_model));
            }
            if($id = $this->_model->add($data)){
                //执行添加数据成功,则将数据中的content内容存到article_detail表中
                $content = [
                    'article_id' => $id,
                    'content' => $_POST['content']
                ];
                $info = M('article_detail')->add($content);
                if(!$info){
                    //如果添加文章内容失败
                    $this->error(get_errors($this->_model));
                }
                //成功返回首页
                $this->success('添加成功',U('index'));
            }else{
                //如果添加文章失败
                $this->error(get_errors($this->_model));
            }
        }else{
            //获取分类数据
            $category = M('article_category')->select();
            //分配分类数据
            $this->assign('category',$category);
            //展示页面
            $this->display('add');
        }
    }

    /**
     * @param $id
     * 根据id修改文章
     */
    public function edit($id){
        if(IS_POST){
            //接收数据
            $data = $this->_model->create();
            if(!$data) {
                //如果接受的数据错误
                $this->error(get_errors($this->_model));
            }
            if($this->_model->save($data) === false){
                //如果修改文章失败
                $this->error(get_errors($this->_model));
            }else{
                //执行修改数据成功,则将数据中的content内容存到article_detail表中
                $content = [
                    'article_id' => $data['id'],
                    'content' => $_POST['content']
                ];
                $info = M('article_detail')->save($content);
                if(!$info){
                    //如果修改文章内容失败
                    $this->error(get_errors($this->_model));
                }
                //成功返回首页
                $this->success('修改成功',U('index'));
            }
        }else{
            //获取数据
            $info = $this->_model->getArticleData($id);
            $category = M('article_category')->select();
            //分配数据
            $this->assign('info',$info);
            $this->assign('category',$category);
            //显示页面
            $this->display('edit');
        }
    }

    /**
     * @param $id
     * 根据id删除文章,即修改status字段为-1,不让其显示
     */
    public function delete($id){
        if($this->_model->where(['id' => $id])->setField('status',-1) === false){
            //如果删除文章内容失败
            $this->error(get_errors($this->_model));
        }else{
            //成功返回首页
            $this->success('删除成功',U('index'));
        }
    }
}