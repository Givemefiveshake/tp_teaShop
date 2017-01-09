<?php


namespace Admin\Controller;


use Think\Controller;

class GoodsController extends BaseController
{
    private $_model;

    protected function _initialize(){
        $this->_model = D('Goods');
    }

    /**
     * 展示活动数据
     */
    private function _promotion(){
        $this->assign('promotions',M('GoodsPromotion')->select());
    }

    /**
     * 展示商品分类数据
     */
    private function _category(){
        $this->assign('categories',M('GoodsCategory')->select());
    }

    /**
     * 展示商品品牌数据
     */
    private function _brand(){
        $this->assign('brands',M('Brand')->select());
    }

    /**
     * 首页展示商品数据
     */
    public function index(){
        //搜索功能,拼接where条件语句
        $where = [];
        //只显示未被删除的数据
        $where['goods.status'] = 1;
        if(!empty($_GET)) {
            if ($name = I('get.name')) {
                $where['goods.name'] = ['LIKE', "%$name%"];
            }
            // 获取价格区间的值
            $min = I('get.min', 0, 'strip_tags');
            $max = I('get.max', 0, 'strip_tags');
            if (($min && $max) && $min > $max) {
                list($min, $max) = [$max, $min];
            }
            if ($min) {
                $where['goods.shop_price'][] = ['EGT', $min];
            }
            if ($max) {
                $where['goods.shop_price'][] = ['ELT', $max];
            }
            //是否上架的条件查询
            if($is_on_sale = I('get.is_on_sale')){
                $where['goods.is_on_sale'] = $is_on_sale;
            }
        }
        //搜索促销条件
        $where2 = [];
        if(!empty($_GET)){
            if($prom_id = I('get.prom_id')){
                $where2['prom_id'] = $prom_id;
            }
        }
        //传入搜索条件以及每页条数
        $rows = $this->_model->selectAllData($where,$where2,2);
        $this->_promotion();
        $this->assign('lists',$rows[0]);
        $this->assign('proms',$rows[1]);
        $this->assign('pages',$rows[2]);
        $this->display();
    }

    /**
     * 新增商品
     */
    public function add(){
        if(IS_POST){
            if(!$this->_model->create()){
                $this->error(get_errors($this->_model));
            }
            if(!($id = $this->_model->add())){
                $this->error(get_errors($this->_model));
            }
            //商品详细信息存入另一张GoodsDetail表中,拼接数据
            $data = [
                'goods_id' => $id,
                'content' => $_POST['content']
            ];
            if(!(M('GoodsDetail')->add($data))){
                $this->error(get_errors($this->_model));
            }
            //商品促销活动,使用复选框传过来的是个数组,需遍历分别存入GoodsToProm表中
            $prom_data = $_POST['prom_id'];
            foreach($prom_data as $prom_id){
                $prom_info = ['goods_id' => $id,'prom_id' => $prom_id];
                if(!(M('GoodsToProm')->add($prom_info))){
                    $this->error(get_errors($this->_model));
                    exit;
                }
            }
            $this->success('添加成功',U('index'));
        }else{
            $this->_promotion();
            $this->_category();
            $this->_brand();
            $this->display();
        }
    }

    /**
     * 修改商品信息
     * @param $id
     */
    public function edit($id){
        if(IS_POST){
            if(!($info = $this->_model->create())){
                $this->error(get_errors($this->_model));
            }
            if($this->_model->save($info) === false){
                $this->error(get_errors($this->_model));
            }
            $data = [
                'goods_id' => $info['id'],
                'content' => $_POST['content']
            ];
            if(M('GoodsDetail')->save($data) === false){
                $this->error(get_errors($this->_model));
            }
            $prom_data = $_POST['prom_id'];
            //先根据商品id删除原来的促销活动数据,再重新添加
            M('GoodsToProm')->where(['goods_id' => $id])->delete();
            foreach($prom_data as $prom_id){
                $prom_info = ['goods_id' => $id,'prom_id' => $prom_id];
                if(!(M('GoodsToProm')->add($prom_info))){
                    $this->error(get_errors($this->_model));
                    exit;
                }
            }
            $this->success('修改成功',U('index'));
        }else{
            $this->_promotion();
            $this->_category();
            $this->_brand();
            $rows = $this->_model->find($id);
            //从GoodsDetail取得商品详细信息
            $content = M('GoodsDetail')->where(['goods_id' => $id])->getField('content');
            //从GoodsToProm取出活动数据
            $prom = M('GoodsToProm')->where(['goods_id' => $id])->select();
            $prom_id = array_column($prom,'prom_id');
            //拼接数据
            $rows['content'] = $content;
            $rows['prom_id'] = $prom_id;
            //编辑回显
            $this->assign('rows',$rows);
            $this->display();
        }
    }

    /**
     * 删除商品信息
     * @param $id
     */
    public function delete($id){
        if(!$this->_model->where(['id' => $id])->setField('status',0)){
            $this->error(get_errors($this->_model));
        }
        $this->success('删除成功',U('index'));
    }
}