<?php


namespace Admin\Controller;


use Think\Controller;

class GoodsGalleryController extends BaseController
{
    private $_model;
    protected function _initialize(){
        $this->_model = D('GoodsGallery');
    }

    /**
     * 展示相册图片
     * @param $id
     */
    public function index($id){
        $rows = $this->_model->where(['goods_id' => $id])->select();
        $this->assign('id',$id);
        $this->assign('urls',$rows);
        $this->display();
    }

    /**
     * 新增图片
     * @return bool
     */
    public function add(){
        $data = $this->_model->create();
        $goods_id = array_shift($data);
        $urls = array_pop($data);
        $info = [];
        foreach($urls as $path){
            $info = ['goods_id' => $goods_id,'path' => $path];
            if(!$this->_model->add($info)){
                $this->error(get_errors($this->_model));
                return false;
            }
        }
        $this->success('添加成功');exit;
    }

    /**
     * 删除图片
     * @param $id
     */
    public function delete($id){
        if(!$this->_model->delete($id)){
            $this->error(get_errors($this->_model));
        }
        $this->success('删除成功',U('Goods/index'));
    }
}